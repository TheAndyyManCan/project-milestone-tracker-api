<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;

class UpdateMilestoneCommentRequest extends StoreMilestoneCommentRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if(Auth::user()->id == $this->milestonecomment->user_id){
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
            'content' => 'required|string'
        ];
    }
}
