<?php

namespace App\Policies;

use App\Models\Milestone;
use App\Models\MilestoneComments;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class MilestoneCommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MilestoneComments $milestoneComments)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, int $milestoneId)
    {
        $milestone = Milestone::all()->where('id', $milestoneId)->first();
        $authPermission = $user->permissions->where('project_id', $milestone->project->id)->first();

        return $authPermission->permission_level >= 2;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MilestoneComments $milestoneComments)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MilestoneComments $milestoneComments)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, MilestoneComments $milestoneComments)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, MilestoneComments $milestoneComments)
    {
        //
    }
}
