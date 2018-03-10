<?php

namespace App\Laravel\Requests\Api;

use App\Laravel\Requests\ApiRequestManager;
// use JWTAuth;

class RegisterRequest extends ApiRequestManager
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'fname' => "required",
            'lname' => "required",
            'email' => "required|email|unique:user,email",
            'password' => "required|confirmed",
        ];

        if($this->has('birthdate')) {
            $rules['birthdate'] = "date";
        }

        if($this->has('contact_number')) {
            $rules['contact_number'] = "phone:PH,mobile";
            // $rules['country'] = "required_with:contact_number";
        }

        return $rules;
    }

    public function messages() {
        return [
            'email.unique' => "This email address is already taken.",
            'contact_number.phone' => "This mobile number is in incorrect format.",
        ];
    }
}
