<?php namespace App\Laravel\Requests\Backoffice;

use Session,Auth, Input;
use App\Laravel\Requests\RequestManager;

class NewsRequest extends RequestManager{

	public function rules(){

		$rules = [
			'title' => "required",
			'author' => "required",
			'content' => "required",
			// 'sort' => "required",
			'file' => "required|image",
		];

		return $rules;
	}

	public function messages(){
		return [
			'required' => "This field is required.",
		];
	}
}