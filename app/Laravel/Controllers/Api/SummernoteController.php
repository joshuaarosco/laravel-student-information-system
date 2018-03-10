<?php 

namespace App\Laravel\Controllers\Api;

/**
*
* Models used for this controller
*/

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Api\SummernoteRequest;

/**
*
* Classes used for this controller
*/
use App\Http\Requests\Request;
use Helper, ImageUploader, Carbon, Session, Str;

class SummernoteController extends Controller{

	/**
	*
	* @var array
	*/
	protected $response;

	public function __construct(){
		$this->response = array(
				"msg" => "Bad Request.",
				"status" => FALSE,
				'status_code' => "UNAUTHORIZED"
			);
		$this->response_code = 401;
	}

	public function upload(SummernoteRequest $request, $format = ""){
		try {
			switch(Str::lower($format)){
				case 'json' :
					$this->response["msg"] = "File not found.";
					$this->response["status_code"] = "FILE_NOT_FOUND";
					$this->response_code = 404;

					if($request->hasFile('file')){
						$upload = ImageUploader::upload($request,"uploads/summernote","file");
						$this->response["image"] = asset($upload["directory"] . '/resized/' . $upload["filename"]);
						$this->response["msg"] = "Upload successful.";
						$this->response['status'] = TRUE;
						$this->response["status_code"] = "UPLOAD_SUCCESS";
						$this->response_code = 201;
					}

				break;

				default :
					$this->response['msg'] = "Invalid return data format.";
					$this->response['status_code'] = "INVALID_FORMAT";
					$this->response['status'] = FALSE;
					$this->response_code = 403;
			}

			return response()->json($this->response,$this->response_code);

		} catch (Exception $e) {
			$this->response["msg"] = "Error Exception";
			$this->response["errors"] = $e->getMessage();
			return response()->json($this->response);
		}
		
	}

	

}