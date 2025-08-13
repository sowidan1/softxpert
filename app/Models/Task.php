<?php

namespace App\Models;

use App\Enums\PermissionEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status',
        'due_date',
        'assignee_id',
        'created_by_id',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function assignee(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function dependencies(): BelongsToMany
    {
        return $this->belongsToMany(Task::class, 'task_dependencies', 'task_id', 'dependency_id');
    }

    public function scopeForUser($query, $user)
    {
        if ($user->hasPermissionTo(PermissionEnum::VIEW_OWN_TASKS->value) &&
            ! $user->hasAnyPermission([
                PermissionEnum::CREATE_TASKS->value,
                PermissionEnum::UPDATE_TASKS->value,
                PermissionEnum::ASSIGN_TASKS->value,
            ])) {
            $query->where('assignee_id', $user->id);
        }
    }
}
