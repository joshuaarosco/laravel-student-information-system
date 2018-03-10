<?php

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\WishlistTransaction;
use App\Laravel\Models\WishlistViewer;
use App\Laravel\Notifications\PusherNotification;
use App\Laravel\Transformers\GeneralRequestTransformer;
use App\Laravel\Transformers\MasterTransformer;
use App\Laravel\Transformers\TransformerManager;
use App\Laravel\Transformers\WishlistTransactionTransformer;
use App\Laravel\Transformers\WishlistViewerTransformer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Str, Carbon, DB, Helper;

class PusherController extends Controller
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

    public function notify(Request $request, $format = '') {

    	$user = $request->user();
        $data = ['message' => $request->get('message')];

        $this->response['msg'] = "You have a new message!";
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "NEW_MESSAGE";
        $this->response['data'] = $this->transformer->transform($data, new MasterTransformer, 'item');
        $this->response_code = 200;

        $user->notify(new PusherNotification($data));

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
