<?php

namespace App\Http\Resources;

use App\Models\ProjectPermission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $spectatorPermissions = ProjectPermission::where('user_id', $this->id)
                                                ->where('permission_level', 1)
                                                ->get();
        $spectatorProjects = [];
        foreach($spectatorPermissions as $permission){
            array_push($spectatorProjects, $permission->project);
        }

        $teamMemberPermissions = ProjectPermission::where('user_id', $this->id)
                                                ->where('permission_level', 2)
                                                ->get();
        $teamMemberProjects = [];
        foreach($teamMemberPermissions as $permission){
            array_push($teamMemberProjects, $permission->project);
        }

        $adminPermissions = ProjectPermission::where('user_id', $this->id)
                                                ->where('permission_level', 3)
                                                ->get();
        $adminProjects = [];
        foreach($adminPermissions as $permission){
            array_push($adminProjects, $permission->project);
        }

        $authorPermissions = ProjectPermission::where('user_id', $this->id)
                                                ->where('permission_level', 4)
                                                ->get();
        $authorProjects = [];
        foreach($authorPermissions as $permission){
            array_push($authorProjects, $permission->project);
        }


        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'projects' => [
                'spectator' => ProjectResource::collection($spectatorProjects),
                'team_member' => ProjectResource::collection($teamMemberProjects),
                'admin' => ProjectResource::collection($adminProjects),
                'author' => ProjectResource::collection($authorProjects)
            ]
        ];
    }
}
