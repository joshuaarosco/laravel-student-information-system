<?php

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\VersionControl;
use App\Laravel\Transformers\MasterTransformer;
use App\Laravel\Transformers\TransformerManager;
use Illuminate\Http\Request;
use Str, Carbon, DB, Helper;

class AppSettingController extends Controller
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

    public function index(Request $request, $format = '') {

        $data = [
            'latest_version' => VersionControl::orderBy('created_at', "DESC")->first() ? : new VersionControl,
        ];

        $this->response['msg'] = "App Settings";
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "APP_SETTINGS";
        $this->response['data'] = $this->transformer->transform($data, new MasterTransformer, 'item');
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


}
