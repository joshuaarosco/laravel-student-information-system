<?php

namespace App\Laravel\Controllers\Api\Auth;

use App\Laravel\Models\User;
use Illuminate\Http\Request;
use App\Laravel\Events\UserAction;
use Helper, JWTAuth, Str, Validator;
use App\Laravel\Controllers\Controller;
use App\Laravel\Requests\Api\RegisterRequest;
use App\Laravel\Transformers\UserTransformer;
use App\Laravel\Transformers\TransformerManager;

class RegisterController extends Controller {

	protected $response = array();

	public function __construct() {
		$this->response = array(
			"msg" => "Bad Request.",
			"status" => FALSE,
			'status_code' => "BAD_REQUEST"
			);
		$this->response_code = 400;
		$this->transformer = new TransformerManager;
	}

	public function store(RegisterRequest $request, $format = '') {

		$user = new User;
		$user->fill($request->all());

		$username = substr(Str::slug($user->name, ""), 0, 20);
		$user->username = Helper::create_username($user->name, User::where('username', 'like', "%" . $username . "%")->count());

		$user->password = bcrypt($request->password);
		$user->save();

		$this->response['msg'] = Helper::get_response_message("REGISTER_SUCCESS");
		$this->response['status'] = TRUE;
		$this->response['status_code'] = "REGISTER_SUCCESS";
		$this->response['token'] = JWTAuth::fromUser($user, ['did' => $request->get('device_id')]);
		$this->response['first_login'] = TRUE;
		$this->response['data'] = $this->transformer->transform($user, new UserTransformer,'item');
		$this->response_code = 200;

		// event( new UserAction($user, ['register']) );

		callback:
		switch(Str::lower($format)){
			case 'json' :
				return response()->json($this->response, $this->response_code);
			break;
			case 'xml' :
				return response()->xml($this->response, $this->response_code);
			break;
		}
	}
}