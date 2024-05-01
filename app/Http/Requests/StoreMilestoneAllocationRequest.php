<?php

namespace App\Http\Requests;

use App\Models\Milestone;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreMilestoneAllocationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Check if currently logged in user has permissions to add an allocation for themselves or another user
        $milestone = Milestone::all()->where('id', $this->milestone_id)->first();
        $authPermission = Auth::user()->permissions->where('project_id', $milestone->project_id)->first();

        return $authPermission >= 3 || ($authPermission >= 2 && Auth::user()->id == $this->user_id);
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
            'milestone_id' => 'required|exists:milestones,id'
        ];
    }
}
