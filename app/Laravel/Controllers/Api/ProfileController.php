<?php

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\User;
use App\Laravel\Models\UserDevice;
use App\Laravel\Requests\Api\FacebookLoginRequest;
use App\Laravel\Requests\Api\PasswordRequest;
use App\Laravel\Requests\Api\ProfileRequest;
use App\Laravel\Transformers\TransformerManager;
use App\Laravel\Transformers\UserTransformer;
use Illuminate\Http\Request;
use ImageUploader, Helper, JWTAuth, Str;

class ProfileController extends Controller
{

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

    public function show(Request $request, $format = '') {

    	$user = $request->user();

        $this->response['msg'] = Helper::get_response_message("PROFILE_INFO");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "PROFILE_INFO";
        $this->response['data'] = $this->transformer->transform($user, new UserTransformer, 'item');
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

    public function fb_connect(FacebookLoginRequest $request, $format = '') {

        $user = $request->user();
        $email = $request->get('email') ?: $request->get('fb_id')."@facebook.com";

        $user->fb_id = $request->get('fb_id');
        $user->save();

        $this->response['msg'] = Helper::get_response_message("FACEBOOK_CONNECT_SUCCESS");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "FACEBOOK_CONNECT_SUCCESS";
        $this->response['data'] = $this->transformer->transform($user, new UserTransformer,'item');
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

    public function update_profile(ProfileRequest $request, $format = '') {

        $user = $request->user();
        $user->fill($request->except('password'));

        if($request->hasFile('file')) {
            $image = ImageUploader::upload($request->file('file'), "uploads/images/users");
            $user->path = $image['path'];
            $user->directory = $image['directory'];
            $user->filename = $image['filename'];
        }

        $user->save();

        $this->response['msg'] = Helper::get_response_message("PROFILE_UPDATED");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "PROFILE_UPDATED";
        $this->response_code = 200;
        $this->response['data'] = $this->transformer->transform($user, new UserTransformer, 'item');

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
    
    public function update_password(PasswordRequest $request, $format = '') {
        
    	$user = $request->user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        
        $this->response['msg'] = Helper::get_response_message("PASSWORD_UPDATED");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "PASSWORD_UPDATED";
        $this->response_code = 200;
        $this->response['data'] = $this->transformer->transform($user, new UserTransformer, 'item');

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

    public function update_device(Request $request, $format = '') {

        $user = $request->user();
        
        if($request->has('device_id')){

            $device = UserDevice::where('user_id', $user->id)->where('device_id',  $request->get('device_id'))->first();

            UserDevice::where('device_id', $request->get('device_id'))
                        ->where('user_id','<>',$user->id)
                        ->update(['is_login' => "0"]);
                        
            if(!$device){
                $new_device = new UserDevice;
                $new_device->user_id = $user->id;
                $new_device->reg_id =  $request->get('device_reg_id');
                $new_device->device_id =  $request->get('device_id')?:'';
                $new_device->device_name =  $request->get('device_name');
                $new_device->is_login = 1;
                $new_device->save();
            }else{
                $device->reg_id =  $request->get('device_reg_id')?:$device->reg_id;
                $device->device_name =  $request->get('device_name');
                $device->is_login = 1;
                $device->save();
            }
        }
        
        $this->response['msg'] = Helper::get_response_message("DEVICE_UPDATED");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "DEVICE_UPDATED";
        $this->response_code = 200;
        $this->response['data'] = $this->transformer->transform($user, new UserTransformer, 'item');

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
