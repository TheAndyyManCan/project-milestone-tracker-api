<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserSearchResource;
use App\Models\Project;
use App\Models\ProjectPermission;
use App\Models\User;
use Illuminate\Http\Request;

class UserSearchController extends Controller
{
    public function search(Project $project, ?string $email = '') {
        if($email != ''){
            $userSearch = '%' . $email . '%';
            $users = User::where('email', 'like', $userSearch)
                ->get();

            foreach($users as $key => $user){
                if(ProjectPermission::where('project_id', $project->id)->where('user_id', $user->id)->first()){
                    $users->forget($key);
                }
            }

            return UserSearchResource::collection($users);
        }
    }
}
