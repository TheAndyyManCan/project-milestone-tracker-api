<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'permission_level' => $this->permission_level,
           'project' => [
                'id' => $this->project->id,
                'title' => $this->project->title,
                'author' => $this->project->user->id,
                'deadline' => $this->project->deadline,
                'description' => $this->project->description,
                'time_left' => Carbon::createFromDate($this->project->deadline)->diffForHumans()
            ]
        ];
    }
}
