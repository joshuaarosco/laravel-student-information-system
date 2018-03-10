<?php namespace App\Laravel\Requests\Backoffice;

use Session,Auth, Input;
use App\Laravel\Requests\RequestManager;

class VersionRequest extends RequestManager{

	public function rules(){

		$rules = [
			'version_name' => "required",
			'major_version' => "required",
			'minor_version' => "required",
			'changelogs' => "required",
		];

		return $rules;
	}

	public function messages(){
		return [
			'required' => "This field is required.",
		];
	}
}