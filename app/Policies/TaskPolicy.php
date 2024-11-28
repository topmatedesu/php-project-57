<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TaskStatus;

class TaskPolicy
{
    public function view(User $user, TaskStatus $taskStatus): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user): bool
    {
        return true;
    }

    public function edit(User $user): bool
    {
        return true;
    }

    public function delete(User $user, TaskStatus $taskStatus): bool
    {
        return true;
    }
}
