<?php namespace App\Laravel\Requests\Backoffice;

use Session,Auth;
use App\Laravel\Requests\RequestManager;

class ClassRequest extends RequestManager{

	public function rules(){

		$id = $this->segment(3)?:0;

		$rules = [
			'section_id' => "required",
			'subject_ids' => "required",
			'student_ids' => "required",
		];

		return $rules;
	}

	public function messages(){
		return [
			'required' => "Field is required.",
		];
	}
}