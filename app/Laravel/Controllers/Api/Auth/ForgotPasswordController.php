<?php

namespace App\Laravel\Controllers\Api\Auth;

use App\Laravel\Controllers\Controller;
use App\Laravel\Models\PasswordReset;
use App\Laravel\Models\User;
use App\Laravel\Notifications\SendResetToken;
use Illuminate\Http\Request;
use Carbon, Helper, Str, Validator;

class ForgotPasswordController extends Controller {

	protected $data = array();

	public function __construct() {
		$this->response = array(
			"msg" => "Bad Request.",
			"status" => FALSE,
			'status_code' => "BAD_REQUEST"
			);
		$this->response_code = 400;
	}

	public function forgot_password(Request $request, $format = '') {

		$validator = Validator::make($request->all(), [
			'email' => 'required|email|exists:user,email'
		]);

		if($validator->fails()) {
			$this->response['msg'] = Helper::get_response_message("INVALID_DATA");
			$this->response['status_code'] = "INVALID_DATA";
			$this->response['errors'] = $validator->errors();
			$this->response_code = 422;
			goto callback;
		}

		$email = $request->get('email');
		$token = $this->_generateResetToken();

		$user = User::where('email', $email)->first();
		$user->notify(new SendResetToken($token, "api") );
		$this->_saveResetToken($user, $token);

		$this->response['msg'] = Helper::get_response_message("RESET_TOKEN_SENT");
		$this->response['status'] = TRUE;
		$this->response['status_code'] = "RESET_TOKEN_SENT";
		$this->response_code = 200;

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

	private function _generateResetToken() {
		$key = config('app.key');
        if (Str::startsWith($key, 'base64:')) {
            $key = base64_decode(substr($key, 7));
        }
        // return hash_hmac('sha256', Str::random(40), $key);
		return Str::random(6);
	}

	private function _saveResetToken(User $user, $token) {
		PasswordReset::where('email', $user->email)->delete();

		$password_reset = new PasswordReset;
		$password_reset->email = $user->email;
		$password_reset->token = $token;
		$password_reset->created_at = Carbon::now();
		$password_reset->save();
	}
}