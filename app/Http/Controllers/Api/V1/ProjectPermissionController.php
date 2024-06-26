<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Http\Resources\UserPermissionResource;
use App\Models\Project;
use App\Models\ProjectPermission;
use Illuminate\Http\Request;

class ProjectPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePermissionRequest $request)
    {
        $permission = ProjectPermission::create($request->validated());
        return ProjectResource::make($permission->project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, ProjectPermission $projectPermission)
    {
        $projectPermission->update($request->validated());
        return ProjectResource::make($projectPermission->project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectPermission $permission)
    {
        $projectId = $permission->project->id;
        $permission->delete();
        $project = Project::find($projectId);
        return ProjectResource::make($project);
    }
}
