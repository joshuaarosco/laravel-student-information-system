<?php

namespace App\Laravel\Controllers\Api\Auth;

use App\Laravel\Controllers\Controller;
use App\Laravel\Events\UserAction;
use App\Laravel\Models\PasswordReset;
use App\Laravel\Models\User;
use App\Laravel\Requests\Api\ResetPasswordRequest;
use App\Laravel\Transformers\TransformerManager;
use App\Laravel\Transformers\UserTransformer;
use DB, JWTAuth, Helper, Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller {

	protected $data = array();

	public function __construct() {
		$this->response = array(
			"msg" => "Bad Request.",
			"status" => FALSE,
			'status_code' => "BAD_REQUEST"
			);
		$this->response_code = 400;
		$this->transformer = new TransformerManager;
	}

	public function reset_password(ResetPasswordRequest $request, $format = '') {

		$token = $request->get('token');
		$password_reset = PasswordReset::where('token', $token)->first();

		$user = User::where('email', $password_reset->email)->first();
		$user->password = bcrypt($request->get('password'));
		$user->save();

		PasswordReset::where('token', $token)->delete();

		$this->response['msg'] = Helper::get_response_message("LOGIN_SUCCESS", ['name' => $user->name]);
		$this->response['status'] = TRUE;
		$this->response['status_code'] = "LOGIN_SUCCESS";
		$this->response['token'] = JWTAuth::fromUser($user, ['did' => $request->get('device_id')]);
		$this->response['first_login'] = FALSE;
		$this->response['data'] = $this->transformer->transform($user, new UserTransformer,'item');
		$this->response_code = 200;

		event( new UserAction($user, ['login']) );

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