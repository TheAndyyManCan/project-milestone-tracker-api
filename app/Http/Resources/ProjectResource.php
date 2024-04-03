<?php

namespace App\Http\Resources;

use App\Models\ProjectPermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->user->id,
            'deadline' => $this->deadline,
            'description' => $this->description,
            'time_left' => Carbon::createFromDate($this->deadline)->diffForHumans(),
            'auth_permission' => $this->permissions()
                                    ->where('user_id', auth()->user()->id)
                                    ->where('project_id', $this->id)
                                    ->first()
                                    ->permission_level,
            'users_permissions' => [
                'spectator' => UserPermissionResource::collection($this->permissions->where('permission_level', 1)),
                'team_member' => UserPermissionResource::collection($this->permissions->where('permission_level', 2)),
                'admin' => UserPermissionResource::collection($this->permissions->where('permission_level', 3)),
                'author' => UserPermissionResource::collection($this->permissions->where('permission_level', 4))
            ],
            'milestones' => MilestoneResource::collection($this->milestones)
        ];
    }
}
