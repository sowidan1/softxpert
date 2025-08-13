<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case CREATE_TASKS = 'create tasks';
    case UPDATE_TASKS = 'update tasks';
    case ASSIGN_TASKS = 'assign tasks';
    case VIEW_OWN_TASKS = 'view own tasks';
    case UPDATE_TASK_STATUS = 'update task status';

    public static function viewPermissions(): array
    {
        return [
            self::VIEW_OWN_TASKS->value,
            self::CREATE_TASKS->value,
            self::UPDATE_TASKS->value,
            self::ASSIGN_TASKS->value,
        ];
    }

    public static function createPermissions(): array
    {
        return [self::CREATE_TASKS->value, self::ASSIGN_TASKS->value];
    }

    public static function updatePermissions(): array
    {
        return [self::UPDATE_TASKS->value, self::UPDATE_TASK_STATUS->value, self::ASSIGN_TASKS->value];
    }
}
