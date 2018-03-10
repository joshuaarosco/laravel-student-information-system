<?php 

namespace App\Laravel\Controllers\Frontend;

/*
*
* Models used for this controller
*/
use App\User;
use App\Laravel\Models\Member;
use App\Laravel\Models\ContactInquiry;
use App\Laravel\Models\Subscriber;

/*
*
* Requests used for validating inputs
*/

use App\Laravel\Requests\Frontend\ContactInquiryRequest;
use App\Laravel\Events\SendEmail;

/*
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str, DB, Input, Event;

class PageController extends Controller{

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
		return redirect()->route('backoffice.auth.login');
		return view('frontend.index',$this->data);
	}

	public function aba () {
		return view('frontend._pages.aba',$this->data);
	}

	public function abis () {
		return view('frontend._pages.abis',$this->data);
	}

	public function asean_bac () {
		return view('frontend._pages.asean-bac',$this->data);
	}

	public function members () {
		$this->data['members'] = Member::orderBy('created_at','DESC')->get();
		return view('frontend._pages.members',$this->data);
	}

	public function activities () {
		return view('frontend._pages.activities',$this->data);
	}

	public function partners () {
		return view('frontend._pages.partners',$this->data);
	}

	public function publication () {
		return view('frontend._pages.publication',$this->data);
	}

	public function contact () {
		return view('frontend._pages.contact',$this->data);
	}

	public function sent(ContactInquiryRequest $request){
		$contact = new ContactInquiry;

		$contact->fill(Input::all());

		if($contact->save()){
			Session::flash('notification-status','success');
			Session::flash('notification-msg',"Your contact inquiry has been successfully sent.");
			return redirect()->back();
		}
	}

	public function subscribe(){
		$check = Subscriber::where('email',Input::get('email'))->first();
		if($check){
			$check->is_subscribe = 'yes';
			if($check->save()){
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"You're already subscribe to our news and updates.");

				$notification_data = new SendEmail(['input' => Input::all(),'type' => "subscribe"]);
				Event::fire('send_email', $notification_data);

				return redirect()->back();
			}
		}else{
			$new_subscribers = new Subscriber;
			$new_subscribers->fill(Input::all());

			$new_subscribers->is_subscribe = 'yes';

			if($new_subscribers->save()){
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"You're subscription is successfull.");

				$notification_data = new SendEmail(['input' => Input::all(),'type' => "subscribe"]);
				Event::fire('send_email', $notification_data);

				return redirect()->back();
			}
		}
	}

	public function unsubscribe($email = NULL){
		$unsubscribe = Subscriber::where('email',$email)->first();

		$unsubscribe->is_subscribe = 'no';

		if($unsubscribe->save()){
			Session::flash('notification-status','success');
			Session::flash('notification-msg',"You're unsubscription is successfull.");

			return redirect()->route('frontend.index');
		}
	}
}