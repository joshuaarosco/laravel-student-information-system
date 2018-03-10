<?php

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\User;
use App\Laravel\Requests\Api\PasswordRequest;
use App\Laravel\Requests\Api\ProfileRequest;
use App\Laravel\Transformers\NotificationTransformer;
use App\Laravel\Transformers\TransformerManager;
use App\Laravel\Transformers\UserTransformer;
use Illuminate\Http\Request;
use ImageUploader, Helper, JWTAuth, Str, Carbon, DB;

class NotificationController extends Controller
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

    public function unread_count(Request $request, $format = '') {
        $user = $request->user();
        $unread = $user->unreadNotifications()
                    ->where(function($query) use($user) {
                        if($user->last_notification_check) {
                            $date = Helper::datetime_db($user->last_notification_check);
                            $query->where('created_at', '>=', $date);
                        }
                    })
                    ->count();

        $this->response['msg'] = Helper::get_response_message("UNREAD_NOTIFICATION_COUNT");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "UNREAD_NOTIFICATION_COUNT";
        $this->response['unread'] = $unread;
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

    public function index(Request $request, $format = '') {

    	$user = $request->user();
        $user->last_notification_check = Helper::datetime_db(Carbon::now());
        $user->save();

        $per_page = $request->get('per_page', 10);
        $page = $request->get('page', 1);

        $notifications = $user->notifications()->paginate($per_page);

        $this->response['msg'] = Helper::get_response_message("NOTIFICATION_DATA");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "NOTIFICATION_DATA";
        $this->response['has_morepages'] = $notifications->hasMorePages();
        $this->response['data'] = $this->transformer->transform($notifications, new NotificationTransformer, 'collection');
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

    public function show(Request $request, $format = '') {

        $notification = $request->get('notification_data');

        $this->response['msg'] = Helper::get_response_message("NOTIFICATION_INFO");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "NOTIFICATION_INFO";
        $this->response['data'] = $this->transformer->transform($notification, new NotificationTransformer, 'item');
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

    public function read(Request $request, $format = '') {

        $notification = $request->get('notification_data');
        $notification->markAsRead();

        $this->response['msg'] = Helper::get_response_message("NOTIFICATION_MARKED_AS_READ");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "NOTIFICATION_MARKED_AS_READ";
        $this->response['data'] = $this->transformer->transform($notification, new NotificationTransformer, 'item');
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

    public function unread(Request $request, $format = '') {

        $notification = $request->get('notification_data');
        $notification->update(['read_at' => NULL]);

        $this->response['msg'] = Helper::get_response_message("NOTIFICATION_MARKED_AS_UNREAD");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "NOTIFICATION_MARKED_AS_UNREAD";
        $this->response['data'] = $this->transformer->transform($notification, new NotificationTransformer, 'item');
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

    public function destroy(Request $request, $format = '') {

        $notification = $request->get('notification_data');
        $notification->delete();

        $this->response['msg'] = Helper::get_response_message("NOTIFICATION_DELETED");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "NOTIFICATION_DELETED";
        $this->response['data'] = $this->transformer->transform($notification, new NotificationTransformer, 'item');
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

    public function read_all(Request $request, $format = '') {

        $user = $request->user();
        $user->notifications()->update(['read_at' => Carbon::now()]);

        $this->response['msg'] = Helper::get_response_message("ALL_NOTIFICATIONS_MARKED_AS_READ");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "ALL_NOTIFICATIONS_MARKED_AS_READ";
        $this->response['data'] = $this->transformer->transform($user->notifications, new NotificationTransformer, 'collection');
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

    public function unread_all(Request $request, $format = '') {

        $user = $request->user();
        $user->notifications()->update(['read_at' => NULL]);

        $this->response['msg'] = Helper::get_response_message("ALL_NOTIFICATIONS_MARKED_AS_UNREAD");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "ALL_NOTIFICATIONS_MARKED_AS_UNREAD";
        $this->response['data'] = $this->transformer->transform($user->notifications, new NotificationTransformer, 'collection');
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

    public function delete_all(Request $request, $format = '') {

        $user = $request->user();
        $user->notifications()->delete();

        $this->response['msg'] = Helper::get_response_message("ALL_NOTIFICATIONS_DELETED");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "ALL_NOTIFICATIONS_DELETED";
        $this->response['data'] = $this->transformer->transform($user->notifications, new NotificationTransformer, 'collection');
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
