<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePermissionLevelRequest;
use App\Http\Resources\ProjectResource;
use App\Models\ProjectPermission;
use Illuminate\Http\Request;

class PermissionLevelController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdatePermissionLevelRequest $request, ProjectPermission $permission)
    {
        $newPermission = $request->validated();
        $permission->permission_level = $newPermission['permission_level'];
        $permission->save();

        return ProjectResource::make($permission->project);
    }
}
