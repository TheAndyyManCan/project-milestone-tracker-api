<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MilestoneResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'deadline' => $this->deadline,
            'time_left' => Carbon::createFromDate($this->deadline)->diffForHumans(),
            'project' => $this->project->id,
            'author' => $this->user->id
        ];
    }
}
