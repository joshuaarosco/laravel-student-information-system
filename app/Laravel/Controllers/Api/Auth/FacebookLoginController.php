<?php

namespace App\Laravel\Controllers\Api\Auth;

use App\Laravel\Controllers\Controller;
use App\Laravel\Events\UserAction;
use App\Laravel\Models\User;
use App\Laravel\Models\UserSocial;
use App\Laravel\Requests\Api\FacebookLoginRequest;
use App\Laravel\Transformers\TransformerManager;
use App\Laravel\Transformers\UserTransformer;
use Auth, JWTAuth, Helper, Str, Socialite;
use GuzzleHttp\Exception\RequestException;

class FacebookLoginController extends Controller {

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

	public function authenticate(FacebookLoginRequest $request, $format = '') {

		try {
			$facebook_account = Socialite::driver('facebook')->userFromToken($request->get('access_token'));
		} catch (RequestException $e) {
			$facebook_account = NULL;
		}

		if(!$facebook_account) {
			$this->response['msg'] = Helper::get_response_message("FACEBOOK_LOGIN_FAILED");
			$this->response['status_code'] = "FACEBOOK_LOGIN_FAILED";
			$this->response_code = 409;
			goto callback;
		}

		$user_social = UserSocial::where('provider', "facebook")
						->where('provider_user_id', $facebook_account->getId())
						->first();

		if($user_social) {

			$user = $user_social->user;

			$this->response['msg'] = Helper::get_response_message("FACEBOOK_LOGIN_SUCCESS", ['name' => $user->name]);
			$this->response['status'] = TRUE;
			$this->response['status_code'] = "FACEBOOK_LOGIN_SUCCESS";
			$this->response['token'] = JWTAuth::fromUser($user, ['did' => $request->get('device_id')]);
			$this->response['first_login'] = FALSE;
			$this->response['data'] = $this->transformer->transform($user, new UserTransformer,'item');
			$this->response_code = 200;

			event( new UserAction($user, ['login']) );
			goto callback;
		}

		$email = $facebook_account->getEmail() ? : ( $facebook_account->getId() . "@facebook.com" );
		$existing_email = User::where('email', $email)->where('type', 'user')->first();

		if($existing_email) {
			
			$existing_email->fb_id = $request->get('fb_id');
			$existing_email->save();

			UserSocial::firstOrCreate([
				'provider' => "facebook", 
				'provider_user_id' => $facebook_account->getId(), 
				'user_id' => $existing_email->id,
			]);

			$this->response['msg'] = Helper::get_response_message("FACEBOOK_CONNECT_SUCCESS");
			$this->response['status'] = TRUE;
			$this->response['status_code'] = "FACEBOOK_CONNECT_SUCCESS";
			$this->response['token'] = JWTAuth::fromUser($existing_email, ['did' => $request->get('device_id')]);
			$this->response['first_login'] = FALSE;
			$this->response['data'] = $this->transformer->transform($existing_email, new UserTransformer,'item');
			$this->response_code = 200;

			event( new UserAction($existing_email, ['login']) );

		} else {

			$facebook_autofill = [
				'email' => $email,
				'name' => $facebook_account->getName(),
			];

			$user = new User;
			$user->fill($facebook_autofill);
			$user->email = $request->get('email') ?: $request->get('fb_id')."@facebook.com";

			$username = substr(Str::slug($user->name, ""), 0, 20);
			$user->username = Helper::create_username($user->name, User::where('username', 'like', "%" . $username . "%")->count());

			$user->password = NULL;
			$user->fb_id = $facebook_account->getId();
			$user->save();

			UserSocial::firstOrCreate([
				'provider' => "facebook", 
				'provider_user_id' => $facebook_account->getId(), 
				'user_id' => $user->id,
			]);

			$this->response['msg'] = Helper::get_response_message("FACEBOOK_REGISTER_SUCCESS");
			$this->response['status'] = TRUE;
			$this->response['status_code'] = "FACEBOOK_REGISTER_SUCCESS";
			$this->response['token'] = JWTAuth::fromUser($user, ['did' => $request->get('device_id')]);
			$this->response['first_login'] = TRUE;
			$this->response['data'] = $this->transformer->transform($user, new UserTransformer,'item');
			$this->response_code = 200;

			event( new UserAction($user, ['register']) );
		}

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