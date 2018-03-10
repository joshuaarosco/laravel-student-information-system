<?php 

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\User;
use App\Laravel\Requests\Api\SearchRequest;
use App\Laravel\Transformers\TransformerManager;
use App\Laravel\Transformers\UserTransformer;
use Illuminate\Http\Request;
use Helper, Str;

class UserController extends Controller{

	protected $response = array();

	public function __construct(){
		$this->response = array(
			"msg" => "Bad Request.",
			"status" => FALSE,
			'status_code' => "BAD_REQUEST"
			);
		$this->response_code = 400;
		$this->transformer = new TransformerManager;
	}

	public function show(Request $request, $format = '') {
		
		$user = $request->get('user_data');

		$this->response['msg'] = Helper::get_response_message("USER_INFO");
		$this->response['status'] = TRUE;
		$this->response['status_code'] = "USER_INFO";
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

	public function search(SearchRequest $request, $format = '') {

        $per_page = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $keyword = $request->get('keyword');

        $users = User::where('type',"user")->keyword($keyword)->paginate($per_page);

        $this->response['msg'] = Helper::get_response_message("USER_SEARCH_DATA", ['keyword' => $keyword]);
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "USER_SEARCH_DATA";
        $this->response['has_morepages'] = $users->hasMorePages();
        $this->response['data'] = $this->transformer->transform($users, new UserTransformer, 'collection');
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