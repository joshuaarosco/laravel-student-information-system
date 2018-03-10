<?php namespace App\Laravel\Events;


use App\Laravel\Models\ContactInfo;
use Illuminate\Queue\SerializesModels;
use Mail,Str;
// use App\Constech\Models\GeneralSetting;

class SendEmail extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(array $form_data)
	{
		$this->data['input'] = $form_data['input'];
	}

	public function job(){	
		$data = ['name' => $this->data['input']['name'],'email' => $this->data['input']['email'],];

		Mail::send('emails.subscribe', $data, function($message){
			$message->from('no_reply@asean-bac.org',"ASEAN BAC");
			$message->to($this->data['input']['email']);
			$message->subject("ABAC Subscription.");
		});
	}
}
