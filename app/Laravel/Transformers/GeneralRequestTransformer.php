<?php 

namespace App\Laravel\Transformers;

use App\Laravel\Models\User;
use App\Laravel\Models\Wishlist;
use App\Laravel\Models\WishlistTransaction;
use App\Laravel\Models\WishlistViewer;
use App\Laravel\Transformers\MasterTransformer;
use App\Laravel\Transformers\UserTransformer;
use App\Laravel\Transformers\WishlistTransformer;
use Helper;
use Illuminate\Support\Collection;
use League\Fractal\TransformerAbstract;

class GeneralRequestTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'wishlist', 'other_user', 'owner'
    ];

	public function transform($general_request) {

		$wishlist = Wishlist::findOrNew($general_request->wishlist_id)->title ?: '';
		$other_user = User::findOrNew($general_request->other_user_id)->name ?: '';
		
		$content = "";
		switch ($general_request->type) {
			case 'wishlist_viewer': $content = "{$other_user} would like to view the details of your wishlist, {$wishlist}"; break;
			case 'wishlist_transaction' : $content = "{$other_user} just sent you a {$wishlist}"; break;
		}

	    return [
	     	'id' => $general_request->id ?:0,
	     	// 'wishlist_id' => $general_request->wishlist_id,
	     	'owner_id' => $general_request->owner_id ?:0,
	     	'other_user_id' => $general_request->other_user_id,
	     	'content' => $content,
	     	'type' => $general_request->type,
			'status' => $general_request->status,
			'time_passed' => Helper::time_passed($general_request->created_at),
	    ];
	}

	public function includeOtherUser($general_request) {
		return $this->item(User::findOrNew($general_request->other_user_id), new UserTransformer);
	}

	public function includeOwner($general_request) {
		return $this->item(User::findOrNew($general_request->owner_id), new UserTransformer);
	}

	public function includeWishlist($general_request) {
		return $this->item(Wishlist::findOrNew($general_request->wishlist_id), new WishlistTransformer);
	}
}