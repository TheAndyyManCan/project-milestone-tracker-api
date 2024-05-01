<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMilestoneRequest;
use App\Http\Requests\UpdateMilestoneRequest;
use App\Http\Resources\MilestoneResource;
use App\Models\Milestone;

class MilestoneController extends Controller
{
    public function index(){
        return MilestoneResource::collection(Milestone::all());
    }

    public function store(StoreMilestoneRequest $request){
        $milestone = Milestone::create($request->validated());
        return MilestoneResource::make($milestone);
    }

    public function show(Milestone $milestone){
        return MilestoneResource::make($milestone);
    }

    public function update(UpdateMilestoneRequest $request, Milestone $milestone){
        $milestone->update($request->validated());
        return MilestoneResource::make($milestone);
    }

    public function destroy(Milestone $milestone){
        $milestone->delete();
        return response()->noContent();
    }
}
