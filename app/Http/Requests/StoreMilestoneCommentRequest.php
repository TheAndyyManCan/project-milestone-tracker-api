<?php

namespace App\Http\Requests;

use App\Models\Milestone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMilestoneCommentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check if the currently logged in user has sufficient permissions to create a new comment
        $milestone = Milestone::all()->where('id', $this->milestone_id)->first();
        $authPermission = Auth::user()->permissions->where('project_id', $milestone->project_id)->first();

        if($authPermission->permission_level >= 2){
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'milestone_id' => 'required|exists:milestones,id',
            'content' => 'required|string'
        ];
    }
}
