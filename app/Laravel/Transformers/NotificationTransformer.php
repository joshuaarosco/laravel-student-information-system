<?php 

namespace App\Laravel\Transformers;

use App\Laravel\Models\User;
use League\Fractal\TransformerAbstract;
use Helper;

class NotificationTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'user'
    ];

	public function transform($notification){
		$payload =  [
			'id' => $notification->id ?:0,
			'event'=> $notification->type,
			'is_read' => $notification->read_at != NULL ? "yes" : "no",
			'time_passed' => Helper::time_passed($notification->created_at),
			'reference_id' => isset($notification->data['reference_id']) ? $notification->data['reference_id'] : '',
			'type' => isset($notification->data['type']) ? $notification->data['type'] : '',
			'title' => isset($notification->data['title']) ? $notification->data['title'] : '',
			'content' => isset($notification->data['content']) ? $notification->data['content'] : '',
			'thumbnail' => isset($notification->data['thumbnail']) ? $notification->data['thumbnail'] : '',
		];

		return $payload;
	}

	public function includeUser($notification) {
		return $this->item(User::findOrNew($notification->notifiable_id), new UserTransformer);
	}

}