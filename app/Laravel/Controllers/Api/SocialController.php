<?php

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\Follower;
use App\Laravel\Models\User;
use App\Laravel\Models\Wishlist;
use App\Laravel\Notifications\Social\FollowedNotification;
use App\Laravel\Notifications\Social\UnfollowedNotification;
use App\Laravel\Notifications\Self\Social\FollowedNotification as SelfFollowedNotification;
use App\Laravel\Notifications\Self\Social\UnfollowedNotification as SelfUnfollowedNotification;
use App\Laravel\Transformers\TransformerManager;
use App\Laravel\Transformers\UserTransformer;
use App\Laravel\Transformers\WishlistTransformer;
use Illuminate\Http\Request;
use ImageUploader, Str, DB, Helper, Cache;

class SocialController extends Controller
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

    public function feed(Request $request, $format = '') {

        // $key = $request->user()->id . "|" .
        //         $request->get('page', 1)  . "|" .
        //         $request->get('per_page', 10)  . "|" .
        //         $request->get('keyword');

        // $wishlist = Cache::remember($key, 5, function() use($request) {

        //     $user = $request->user();
        //     $per_page = $request->get('per_page', 10);
        //     $page = $request->get('page', 1);
        //     $keyword = $request->get('keyword');

        //     if($per_page > 50) {
        //         $per_page = 50;
        //     }

        //     return Wishlist::keyword($keyword)
        //         ->whereIn('user_id', function($query) use($user) {
        //             $query->select('user_id')
        //                 ->from(with(new Follower)->getTable())
        //                 ->where('follower_id', $user->id);
        //         })
        //         ->has('owner')
        //         ->orderBy('created_at', "DESC")
        //         ->where('status', '<>', "completed")
        //         ->paginate($per_page);
        // });

        $user = $request->user();
        $per_page = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $keyword = $request->get('keyword');

        if($per_page > 50) {
            $per_page = 50;
        }

        $wishlist = Wishlist::keyword($keyword)
                ->whereIn('user_id', function($query) use($user) {
                    $query->select('user_id')
                        ->from(with(new Follower)->getTable())
                        ->where('follower_id', $user->id);
                })
                ->has('owner')
                ->with('owner', 'transaction')
                ->orderBy('created_at', "DESC")
                ->where('status', '<>', "completed")
                ->paginate($per_page);

        $this->response['msg'] = Helper::get_response_message("FEED_DATA");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "FEED_DATA";
        $this->response['has_morepages'] = $wishlist->hasMorePages();
        $this->response['data'] = $this->transformer->transform($wishlist, new WishlistTransformer, 'collection');
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

    public function suggestions(Request $request, $format = '') {

        $user = $request->user();
        $per_page = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $keyword = $request->get('keyword',0);
        
        $users = User::where('type', "user")
                    ->where('id', '<>', $user->id)
                    ->whereNotIn('id', function($query) use($user) {
                        $query->select('user_id')
                            ->from(with(new Follower)->getTable())
                            ->where('follower_id', $user->id);
                    })->paginate($per_page);

        // $users = User::keyword($keyword)->where('type', "user")->where('id', '<>', $user->id)->paginate($per_page);

        $this->response['msg'] = Helper::get_response_message("SUGGESTIONS_DATA");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "SUGGESTIONS_DATA";
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

    public function followers(Request $request, $format = '') {

        $user = $request->get('user_data');
        $per_page = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $keyword = $request->get('keyword',0);

        $followers = User::keyword($keyword)->whereIn('id', function($query) use($user) {
                        $query->select('follower_id')
                            ->from(with(new Follower)->getTable())
                            ->where('user_id', $user->id);
                    })->paginate($per_page);

        $this->response['msg'] = Helper::get_response_message("FOLLOWERS_DATA", ['name' => Helper::str_contract($user->name)]);
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "FOLLOWERS_DATA";
        $this->response['has_morepages'] = $followers->hasMorePages();
        $this->response['data'] = $this->transformer->transform($followers, new UserTransformer, 'collection');
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

    public function following(Request $request, $format = '') {

        $user = $request->get('user_data');
        $per_page = $request->get('per_page', 10);
        $page = $request->get('page', 1);
        $keyword = $request->get('keyword',0);
        
        $following = User::keyword($keyword)->whereIn('id', function($query) use ($user) {
                        $query->select('user_id')
                            ->from(with(new Follower)->getTable())
                            ->where('follower_id', $user->id);
                    })->paginate($per_page);

        $this->response['msg'] = Helper::get_response_message("FOLLOWING_DATA", ['name' => $user->name]);
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "FOLLOWING_DATA";
        $this->response['has_morepages'] = $following->hasMorePages();
        $this->response['data'] = $this->transformer->transform($following, new UserTransformer, 'collection');
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

    public function follow(Request $request, $format = '') {

        $user = $request->user();
        $following = $request->get('user_data');

        $existing_follower = Follower::where('user_id', $following->id)->where('follower_id', $user->id)->first();

        if($user->id == $following->id) {
            $this->response['msg'] = Helper::get_response_message("CANNOT_FOLLOW_SELF");
            $this->response['status'] = FALSE;
            $this->response['status_code'] = "CANNOT_FOLLOW_SELF";
            $this->response_code = 409;
            goto callback;
        }

        if($existing_follower) {
            $this->response['msg'] = Helper::get_response_message("ALREADY_FOLLOWING", ['name' => $following->name]);
            $this->response['status'] = FALSE;
            $this->response['status_code'] = "ALREADY_FOLLOWING";
            $this->response_code = 409;
            goto callback;
        }

        $follower = new Follower;
        $follower->user_id = $following->id;
        $follower->follower_id = $user->id;
        $follower->save();

        $this->response['msg'] = Helper::get_response_message("FOLLOW_SUCCESS", ['name' => $following->name]);
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "FOLLOW_SUCCESS";
        $this->response['data'] = $this->transformer->transform($following, new UserTransformer, 'item');
        $this->response_code = 200;

        $following->notify( new FollowedNotification($user) );
        $user->notify( new SelfFollowedNotification($following) );

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

    public function unfollow(Request $request, $format = '') {

        $user = $request->user();
        $following = $request->get('user_data');

        $existing_follower = Follower::where('user_id', $following->id)->where('follower_id', $user->id)->first();

        if($user->id == $following->id) {
            $this->response['msg'] = Helper::get_response_message("CANNOT_UNFOLLOW_SELF");
            $this->response['status'] = FALSE;
            $this->response['status_code'] = "CANNOT_UNFOLLOW_SELF";
            $this->response_code = 409;
            goto callback;
        }


        if(!$existing_follower) {
            $this->response['msg'] = Helper::get_response_message("NOT_FOLLOWED_YET", ['name' => $following->name]);
            $this->response['status'] = FALSE;
            $this->response['status_code'] = "NOT_FOLLOWED_YET";
            $this->response_code = 404;
            goto callback;
        }

        $existing_follower->delete();

        $this->response['msg'] = Helper::get_response_message("UNFOLLOW_SUCCESS", ['name' => $following->name]);
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "UNFOLLOW_SUCCESS";
        $this->response['data'] = $this->transformer->transform($following, new UserTransformer, 'item');
        $this->response_code = 200;

        // $following->notify( new UnfollowedNotification($user) );
        // $user->notify( new SelfUnfollowedNotification($following) );

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
