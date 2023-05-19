<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class CreateSavingsRequest extends FormRequest {

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
        'amount' => 'required|numeric|min:5',
        ];
    }

    /**
     * Get error messages for the defined validation rules.
     * 
     * @return array
     */

    public function messages() {
        return [
            'amount.required' => 'Set a valid amount?',
            'amount.numeric' => 'Set a valid amount?',
            'amount.min' => 'Minimum amount to save is £5'
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
