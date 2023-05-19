<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class AddCardRequest extends FormRequest {

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
        'pin' => 'required|numeric',
        'type' => 'required',
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
            'amount.min' => 'Minimum amount is £5',
            'pin.required' => 'Choose a 4 digit pin for this card',
            'pin.numeric' => 'Choose a valid 4 digit pin for this card',
            'type.required' => 'Please choose a card type' 
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
