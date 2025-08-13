<?php

namespace App\Http\Requests\Api\V1\Task;

use App\Enums\PermissionEnum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = auth()->user();
        $task = $this->route('task');

        return $user->hasPermissionTo(PermissionEnum::UPDATE_TASKS->value) ||
            ($user->hasPermissionTo(PermissionEnum::UPDATE_TASK_STATUS->value) &&
                $task->assignee_id === $user->id &&
                $this->only('status'));
    }

    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'string', 'max:1000'],
            'status' => ['sometimes', 'in:pending,in_progress,completed'],
            'due_date' => ['sometimes', 'date', 'after:now'],
            'assignee_id' => ['sometimes', 'exists:users,id'],
            'dependencies' => ['sometimes', 'array'],
            'dependencies.*' => ['exists:tasks,id'],
        ];
    }
}
