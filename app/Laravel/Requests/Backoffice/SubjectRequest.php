<?php namespace App\Laravel\Requests\Backoffice;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class SubjectRequest extends RequestManager{

	public function rules(){

		$id = $this->segment(3)?:0;

		$rules = [
			'teacher_id' => "required",
			'school_year' => "required",
			'subject_title' => "required",
		];

		return $rules;
	}

	public function messages(){
		return [
			'required' => "Field is required.",
		];
	}
}