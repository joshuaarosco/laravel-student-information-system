<?php 
namespace App\Laravel\Requests\Frontend;

use Session,Auth, Input;
use App\Laravel\Requests\RequestManager;

class ContactInquiryRequest extends RequestManager{

	public function rules(){

		$rules = [
			'name' => "required",
			'email' => "required",
			'contact' => "required",
			'subject' => "required",
			'message' => "required",
		];

		return $rules;
	}

	public function messages(){
		return [
			'required' => "This field is required.",
		];
	}
}