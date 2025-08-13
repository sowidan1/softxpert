<?php
    namespace App\Http\Controllers\Api\V1;

    use App\Enums\PermissionEnum;
    use App\Http\Controllers\Controller;
    use App\Http\Requests\Api\V1\Task\CreateTaskRequest;
    use App\Http\Requests\Api\V1\Task\UpdateTaskRequest;
    use App\Http\Resources\TaskResource;
    use App\Models\Task;
    use Illuminate\Http\Request;

    class TaskController extends Controller
    {
        protected function isRestrictedToOwnTasks(): bool
        {
            return auth()->user()->hasPermissionTo(PermissionEnum::VIEW_OWN_TASKS->value) &&
                !auth()->user()->hasAnyPermission([
                    PermissionEnum::CREATE_TASKS->value,
                    PermissionEnum::UPDATE_TASKS->value,
                    PermissionEnum::ASSIGN_TASKS->value,
                ]);
        }

        public function index(Request $request)
        {
            $query = Task::forUser(auth()->user());
            if ($request->has('status')) {
                $query->where('status', $request->input('status'));
            }
            if ($request->has('due_date_start') && $request->has('due_date_end')) {
                $query->whereBetween('due_date', [$request->input('due_date_start'), $request->input('due_date_end')]);
            }
            if ($request->has('assignee_id') && auth()->user()->hasPermissionTo(PermissionEnum::ASSIGN_TASKS->value)) {
                $query->where('assignee_id', $request->input('assignee_id'));
            }
            return TaskResource::collection($query->with(['assignee', 'creator', 'dependencies'])->get());
        }

        public function show(Task $task)
        {
            if ($this->isRestrictedToOwnTasks() && $task->assignee_id !== auth()->user()->id) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
            return new TaskResource($task->load(['assignee', 'creator', 'dependencies']));
        }

        public function store(CreateTaskRequest $request)
        {
            $task = Task::create([
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'assignee_id' => $request->assignee_id,
                'created_by_id' => $request->user()->id,
            ]);

            if ($request->has('dependencies')) {
                $task->dependencies()->sync($request->dependencies);
            }

            return new TaskResource($task->load(['assignee', 'creator', 'dependencies']));
        }

        public function update(UpdateTaskRequest $request, Task $task)
        {
            $task->update($request->only(['title', 'description', 'status', 'due_date', 'assignee_id']));

            if ($request->has('dependencies') && auth()->user()->hasPermissionTo(PermissionEnum::ASSIGN_TASKS->value)) {
                $task->dependencies()->sync($request->dependencies);
            }

            return new TaskResource($task->load(['assignee', 'creator', 'dependencies']));
        }
    }
