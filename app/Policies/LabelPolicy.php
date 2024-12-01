<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Label;

class LabelPolicy
{
    public function view(User $user, Label $label): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Label $label): bool
    {
        return true;
    }

    public function delete(User $user, Label $label): bool
    {
        return true;
    }
}
