<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class CreateSavingsGoalRequest extends FormRequest {

    /**
     * Indicates if the validator should stop on the first rule failure.
     * 
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
        'target' => 'required|numeric', 
        'name' => 'required|string|max:12|min:3',
        'agree' => 'accepted',
        'description' => 'nullable|max:20'
        ];
    }

    /**
     * Get error messages for the defined validation rules.
     * 
     * @return array
     */

    public function messages() {
        return [
            'target.required' => 'Set a valid target?',
            'target.numeric' => 'Set a valid target?',
            'name.required' => 'Set goal name',
            'name.string' => 'Choose a valid name',
            'agree.accepted' => 'Please accept our terms & conditions'
        ];
    }

    /**
     * Prepare the request data for validation
     * 
     * @return void
     */

    public function prepareForValidation() {
        $this->merge([

        ]);
    }
}
