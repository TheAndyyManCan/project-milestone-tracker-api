<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateProjectRequest extends StoreProjectRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $authPermission = Auth::user()->permissions->where('project_id', $this->project_id)->first();

        if($authPermission->permission_level >= 3){
            return true;
        } else {
            return false;
        }
    }

}
