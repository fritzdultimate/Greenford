<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequet extends FormRequest {

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
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'fullname' => 'required|regex:/^[\pL\s\-]+$/u|min:6',
            'email' => 'required|unique:users,email,except,id|email:filter',
            'dob' => 'required|before:01/01/2010',
            'father_name' => 'required',
            'marital_status' => 'required',
            'nationality' => 'required',
            'monthly_income' => 'required',
            'address_1' => 'required',
            'address_2' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'mobile_number' => 'required',
            'account_type' => 'required',
            'gender' => 'required',
            'mother_maiden_name' => 'required',
            'spouse_name' => 'required',
            'occupation' => 'required',
            'source_of_income' => 'required',
            'state' => 'required',
            'country' => 'required',
            'password' => 'required|min:6',
            'repassword' => 'required|same:password',
            // 'terms' => 'required'
        ];
    }

    /**
     * Get error messages for the defined validation rules.
     * 
     * @return array
     */

    public function messages() {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Please provide a valid email',
            'email.unique' => 'Email already registered',
            'fullname.required' => 'Your fullname is required for registration',
            'password.required' => 'Please enter your password',
            'password.min' => 'Password too short',
            'repassword.required' => 'Password does not match',
            'repassword.same' => 'Password does not match',
            'dob.required' => 'Your date of birth is rquired',
            'dob.before' => 'You must be at least 13 years to register',
            // 'terms.required' => 'You must accept our terms and conditions'
        ];
    }
}
