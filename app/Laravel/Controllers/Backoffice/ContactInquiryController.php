<?php namespace App\Laravel\Controllers\Backoffice;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\ContactInquiry;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Backoffice\AdvertisementRequest;

/**
*
* Classes used for this controller
*/
use App\Http\Requests\Request;
use Input, Helper, Carbon, Session, Str, File, Image, ImageUploader;

class ContactInquiryController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		parent::__construct();
		$view = Input::get('view','table');
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "Contact Inquiries";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "contact_inquiry";
	}

	public function index () {
		$this->data['contact_inquiries'] = ContactInquiry::orderBy('created_at',"DESC")->get();
		return view('backoffice.'.$this->data['route_file'].'.index',$this->data);
	}

}