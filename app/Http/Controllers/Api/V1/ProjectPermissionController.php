<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Resources\ProjectResource;
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
     * Display the specified resource.
     */
    public function show(Project $project, ProjectPermission $projectPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectPermission $projectPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectPermission $projectPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectPermission $projectPermission)
    {
        //
    }
}
