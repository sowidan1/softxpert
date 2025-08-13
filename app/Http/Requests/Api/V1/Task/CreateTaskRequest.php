<?php

namespace App\Http\Requests\Api\V1\Task;

use App\Enums\PermissionEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->user()->hasPermissionTo(PermissionEnum::CREATE_TASKS->value);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'due_date' => ['required', 'date', 'after:now'],
            'assignee_id' => ['required', 'exists:users,id'],
            'dependencies' => ['nullable', 'array'],
            'dependencies.*' => [
                'exists:tasks,id',
                Rule::notIn([$this->route('task')?->id ?? 0]),
            ],
        ];
    }
}
