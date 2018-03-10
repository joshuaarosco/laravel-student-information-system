<?php 

namespace App\Laravel\Controllers\Frontend;

use App\Laravel\Models\User;

use Illuminate\Support\Collection;
use App\Http\Controllers\Controller as MainController;
use Auth, Session,Carbon, Helper,Route,DNS2D;

class Controller extends MainController{

	protected $data;

	public function __construct(){
	}

	public function get_data(){
		return $this->data;
	}
}