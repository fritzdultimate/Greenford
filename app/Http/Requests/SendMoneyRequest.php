<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class SendMoneyRequest extends FormRequest {

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
        'amount' => 'required|numeric', 
        'account_number' => 'required|numeric|digits:10',
        'routing' => 'required|numeric|digits:9'
        ];
    }

    /**
     * Get error messages for the defined validation rules.
     * 
     * @return array
     */

    public function messages() {
        return [
            'amount.required' => 'How much do you want to send?',
            'amount.numeric' => 'Invalid amount!',
            'account_number.required' => 'Account number is required!',
            'account_number.numeric' => 'Invalid account number! n',
            'account_number.digits' => 'Invalid account number!',
            'routing.digits' => 'Invalid routing number'
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
