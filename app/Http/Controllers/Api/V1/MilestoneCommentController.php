<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMilestoneCommentRequest;
use App\Http\Requests\UpdateMilestoneCommentRequest;
use App\Http\Resources\MilestoneCommentResource;
use App\Http\Resources\MilestoneResource;
use App\Models\Milestone;
use App\Models\MilestoneComments;
use Illuminate\Support\Facades\Auth;

class MilestoneCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return MilestoneCommentResource::collection(MilestoneComments::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMilestoneCommentRequest $request) {
        $comment = MilestoneComments::create($request->validated());
        return MilestoneResource::make(Milestone::all()->where('id', $comment->milestone_id)->first());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMilestoneCommentRequest $request, MilestoneComments $milestonecomment) {
        $milestonecomment->update($request->validated());
        return MilestoneResource::make(Milestone::all()->where('id', $milestonecomment->milestone_id)->first());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MilestoneComments $milestonecomment) {

        $authPermission = Auth::user()->permissions->where('project_id', $milestonecomment->project_id)->first();

        // Check if the currently logged in user is the comment author or is at least admin level
        if(Auth::user()->id == $milestonecomment->user_id || $authPermission >= 3){
            $milestone = Milestone::all()->where('id', $milestonecomment->milestone_id)->first();
            $milestonecomment->delete();
            return MilestoneResource::make($milestone);
        } else {
            return response(status: 403);
        }
    }
}
