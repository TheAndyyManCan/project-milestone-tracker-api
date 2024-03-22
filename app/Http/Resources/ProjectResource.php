<?php

namespace App\Http\Resources;

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
            'name' => $this->name,
            'author' => $this->user->name,
            'deadline' => $this->deadline,
            'time_left' => Carbon::createFromDate($this->deadline)->diffForHumans(),
            'milestones' => MilestoneResource::collection($this->milestones)
        ];
    }
}
