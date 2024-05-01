<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMilestoneAllocationRequest;
use App\Http\Requests\UpdateMilestoneAllocationRequest;
use App\Http\Resources\MilestoneAllocationResource;
use App\Http\Resources\MilestoneResource;
use App\Models\MilestoneAllocation;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class MilestoneAllocationController extends Controller {

    public function index(): AnonymousResourceCollection {
        return MilestoneAllocationResource::collection(MilestoneAllocation::all());
    }

    public function store(StoreMilestoneAllocationRequest $request): MilestoneResource {
        $allocation = MilestoneAllocation::create($request->validated());
        return MilestoneResource::make($allocation->milestone);
    }

    public function show(MilestoneAllocation $milestoneAllocation): MilestoneAllocationResource {
        return MilestoneAllocationResource::make($milestoneAllocation);
    }

    public function update(UpdateMilestoneAllocationRequest $request, MilestoneAllocation $milestoneAllocation): MilestoneResource {
        $milestoneAllocation->update($request->validated());
        return MilestoneResource::make($milestoneAllocation->milestone);
    }

    public function destroy(MilestoneAllocation $milestoneAllocation): MilestoneResource|Response {
        // Check if the currently logged in user has permissions to delete the allocation
        $authPermission = Auth::user()->permissions->where('project_id', $milestoneAllocation->milestone->project_id)->first();

        if($authPermission >= 3 || Auth::user()->id == $milestoneAllocation->user->id){
            $milestone = $milestoneAllocation->milestone;
            $milestoneAllocation->delete();
            return MilestoneResource::make($milestone);
        } else {
            return response(status: 403);
        }
    }
}
