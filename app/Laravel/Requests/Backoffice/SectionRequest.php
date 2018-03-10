<?php namespace App\Laravel\Requests\Backoffice;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class SectionRequest extends RequestManager{

	public function rules(){

		$id = $this->segment(3)?:0;

		$rules = [
			'adviser_id' => "required",
			'section_name' => "required",
		];

		return $rules;
	}

	public function messages(){
		return [
			'required' => "Field is required.",
		];
	}
}