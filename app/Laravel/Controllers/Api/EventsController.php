<?php 

namespace App\Laravel\Controllers\Api;

use Illuminate\Contracts\Auth\Guard;

use App\Laravel\Models\Event;

use App\Laravel\Transformers\TransformerManager;
use App\Laravel\Transformers\UserTransformer;
use App\Laravel\Transformers\EventsTransformer;

use App\Laravel\Requests\Api\UserRequest;
use App\Laravel\Requests\Api\FbInfoRequest;

// use Event;
use App\Laravel\Events\LogUserAction;

use Helper,ImageUploader,Carbon,Session,Input,Str,Auth,URL,DB;
use Agent,Request;

// use App\Knowheretogo\Events\PushNotification;



class EventsController extends Controller{

	/*
	|--------------------------------------------------------------------------
	| Authenticator Controller
	|--------------------------------------------------------------------------
	|
	|
	*/

	protected $response;

	public function __construct(Guard $auth){
		$this->auth = $auth;
		$this->response = array(
			"msg" => "Bad Request.",
			"status" => FALSE,
			'status_code' => "UNAUTHORIZED"
			);
		$this->response_code = 401;
		$this->transformer = new TransformerManager;
	}

	/**
	 * Login
	 * @format return data format
	 * @return Response
	 */
	public function all($format = ""){
		try{
			$this->response['msg'] = "Event Lists";
			$this->response['status_code'] = "EVENT_LISTS";
			$this->response['status'] = TRUE;
			$this->response_code = 200;
			$event = Event::all();
			$this->response['data'] = $this->transformer->transform($event,new EventsTransformer,'collection');

			callback:

			switch(Str::lower($format)){
				case 'json' :
				
				return response()->json($this->response,$this->response_code);

				break;

				default :
				$this->response['msg'] = "Invalid return data format.";
				$this->response['status_code'] = "INVALID_FORMAT";
				$this->response['status'] = FALSE;
				$this->response_code = 406;
				return response()->json($this->response,$this->response_code);
			}


		}catch(Exception $e){
			$this->response_code = 500;
			$this->response['msg']	= $e->getMessage();
			$this->response['status_code'] = "ERROR_EXCEPTION";
			return response()->json($this->response,$this->response_code);
		}
	}

	public function show($format = ""){
		try{
			$id = Input::get('id'); 
			$this->response['msg'] = "Event Lists";
			$this->response['status_code'] = "EVENT_LISTS";
			$this->response['status'] = TRUE;
			$this->response_code = 200;
			$event_item = Event::find($id);
			if($event_item){
				$this->response['data'] = $this->transformer->transform($event_item,new EventsTransformer,'item');
			}

			// dd($this->response['data']);

			callback:

			switch(Str::lower($format)){
				case 'json' :
				
				return response()->json($this->response,$this->response_code);

				break;

				default :
				$this->response['msg'] = "Invalid return data format.";
				$this->response['status_code'] = "INVALID_FORMAT";
				$this->response['status'] = FALSE;
				$this->response_code = 406;
				return response()->json($this->response,$this->response_code);
			}


		}catch(Exception $e){
			$this->response_code = 500;
			$this->response['msg']	= $e->getMessage();
			$this->response['status_code'] = "ERROR_EXCEPTION";
			return response()->json($this->response,$this->response_code);
		}
	}


}