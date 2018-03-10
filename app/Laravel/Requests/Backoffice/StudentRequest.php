<?php 

namespace App\Laravel\Requests\Backoffice;

use App\Laravel\Requests\RequestManager;
use Auth;

class StudentRequest extends RequestManager
{
    public function rules() {

        $user = Auth::user();

        $rules = [
            'lrn'  => "required",
            'fname'  => "required",
            'lname'  => "required",
        ];


        return $rules;
    }

    public function messages() {
        return [
            'required'  => "Field is required.",
        ];
    }
}