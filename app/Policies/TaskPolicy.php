<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(
        User $user = null,
        Task $task,
        string $guestToken = null
    ): bool {
        return $this->doCheck($user, $task, $guestToken);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(
        User $user = null,
        Task $task,
        string $guestToken = null
    ): bool {
        return $this->doCheck($user, $task, $guestToken);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(
        User $user = null,
        Task $task,
        string $guestToken = null
    ): bool {
        return $this->doCheck($user, $task, $guestToken);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(
        User $user = null,
        Task $task,
        string $guestToken = null
    ): bool {
        return $this->doCheck($user, $task, $guestToken);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(
        User $user = null,
        Task $task,
        string $guestToken = null
    ): bool {
        return $this->doCheck($user, $task, $guestToken);
    }

    private function doCheck(
        User $user = null,
        Task $task,
        string $guestToken = null
    ): bool {
        if ($user) {
            return $user->id === $task->user_id;
        }

        return $guestToken !== null && $task->guest_token === $guestToken;
    }
}
