<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateMilestoneStatusRequest;
use App\Http\Resources\MilestoneResource;
use App\Models\Milestone;
use Illuminate\Http\Request;

class MilestoneStatusController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateMilestoneStatusRequest $request, Milestone $milestone)
    {
        $newMilestone = $request->validated();
        $milestone->status = $newMilestone['status'];
        $milestone->save();

        return MilestoneResource::make($milestone);
    }
}
