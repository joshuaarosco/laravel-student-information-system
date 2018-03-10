<?php 

namespace App\Laravel\Controllers\Backoffice;

/*
*
* Models used for this controller
*/
use App\Laravel\Models\Article;
use App\Laravel\Models\User;

/*
*
* Requests used for validating inputs
*/


/*
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str, DB;

class AdvisoryClassController extends Controller{

	/*
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		$this->data = [];
		parent::__construct();
		array_merge($this->data, parent::get_data());
	}

	public function index () {
		dd('im here');
		return view('backoffice.class_record.index',$this->data);
	}

}