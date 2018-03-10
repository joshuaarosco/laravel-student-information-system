<?php 

namespace App\Laravel\Transformers;

use App\Laravel\Models\User;

use Illuminate\Support\Collection;
use App\Laravel\Transformers\MasterTransformer;
use League\Fractal\TransformerAbstract;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserTransformer extends TransformerAbstract{

	protected $availableIncludes = [
        'info', 'statistics', 'social'
    ];

	public function transform(User $user) {
	     return [
	     	'id' => $user->id ?:0,
	     	'fname' => $user->fname,
	     	'lname' => $user->lname,
	     	'username' => $user->username,
			'email' => $user->email,
			'fb_id' => $user->facebook ? $user->facebook->provider_user_id : NULL,
			'image' => "{$user->directory}/resized/{$user->filename}",
	     ];
	}

	public function includeSocial(User $user) {
		try {
			$auth = JWTAuth::authenticate();
			$is_follower = $auth->followers()->where('follower_id', $user->id)->first() ? 'yes' : 'no';
			$is_following = $user->followers()->where('follower_id', $auth->id)->first() ? 'yes' : 'no';

			$collection = Collection::make([
				'is_follower' => $is_follower,
				'is_following' => $is_following,
				'is_my_account' => ($auth->id == $user->id) ? 'yes' : 'no',
			]);
			return $this->item($collection, new MasterTransformer);

		} catch (JWTException $e) {
			$collection = Collection::make([
				'is_follower' => 'no',
				'is_following' => 'no',
				'is_my_account' => 'yes',
			]);
			return $this->item($collection, new MasterTransformer);
		}
	}

	public function includeInfo(User $user) {
		$collection = Collection::make([
			'gender' => $user->gender,
			'birthdate' => $user->birthdate,
			'address' => "{$user->street_address}, {$user->city}, {$user->state}",
			'street_address' => $user->street_address,
			'city' => $user->city,
			'state' => $user->state,
			'contact_number' => $user->contact_number,
			'member_since' => [
				'date_db' => $user->date_db($user->created_at,env("MASTER_DB_DRIVER","mysql")),
				'month_year' => $user->month_year($user->created_at),
				'time_passed' => $user->time_passed($user->created_at),
				'timestamp' => $user->created_at
			],
			'last_activity' => [
				'date_db' => $user->date_db($user->last_activity,env("MASTER_DB_DRIVER","mysql")),
				'month_year' => $user->month_year($user->last_activity),
				'time_passed' => $user->time_passed($user->last_activity),
				'timestamp' => $user->last_activity
			],
	     	'last_login' => [
				'date_db' => $user->date_db($user->last_login,env("MASTER_DB_DRIVER","mysql")),
				'month_year' => $user->month_year($user->last_login),
				'time_passed' => $user->time_passed($user->last_login),
				'timestamp' => $user->last_login
			],
			'avatar' => [
				'path' => $user->directory,
	 			'filename' => $user->filename,
	 			'path' => $user->path,
	 			'directory' => $user->directory,
	 			'full_path' => "{$user->directory}/resized/{$user->filename}",
	 			'thumb_path' => "{$user->directory}/thumbnails/{$user->filename}",
			],
		]);
		return $this->item($collection, new MasterTransformer);
	}

	public function includeStatistics(User $user) {
		$collection = Collection::make([
			'total_wishlist' => $user->wishlist()->count(),
			'sent_gifts' => $user->sent_gifts()->count(),
			'received_gifts' => $user->received_gifts()->count(),
			'followers' => $user->followers()->count(),
			'following' => $user->following()->count(),
		]);
		return $this->item($collection, new MasterTransformer);
	}
}