<?php

namespace App\Laravel\Controllers\Api;

use App\Laravel\Models\WishlistTransaction;
use App\Laravel\Models\WishlistViewer;
use App\Laravel\Transformers\GeneralRequestTransformer;
use App\Laravel\Transformers\TransformerManager;
use App\Laravel\Transformers\WishlistTransactionTransformer;
use App\Laravel\Transformers\WishlistViewerTransformer;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Str, Carbon, DB, Helper;

class GeneralRequestController extends Controller
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

    public function index(Request $request, $format = '') {

    	$user = $request->user();
        $filter = $request->get('filter', 'all');
        $per_page = $request->get('per_page') ?: 10;
        $page = $request->get('page') ?: 1;

        $wishlist_viewers = WishlistViewer::select(
                                    "id", "owner_id", "wishlist_id",
                                    "viewer_id AS other_user_id",
                                    DB::raw("'wishlist_viewer' AS type"),
                                    "status", "created_at"
                                )
                                ->has('wishlist')
                                ->has('viewer')
                                ->where('owner_id', $user->id)
                                ->where('status', "pending");

        $wishlist_transactions = WishlistTransaction::select(
                                    "id", "owner_id", "wishlist_id",
                                    "sender_id AS other_user_id",
                                    DB::raw("'wishlist_transaction' AS type"),
                                    "status", "created_at"
                                )
                                ->has('wishlist')
                                ->has('sender')
                                ->where('owner_id', $user->id)
                                ->where('status', "pending");

        switch (Str::lower($filter)) {
            case 'wishlist_viewer': $union = $wishlist_viewers->orderBy('created_at', "DESC")->get(); break;
            case 'wishlist_transaction': $union = $wishlist_transactions->orderBy('created_at', "DESC")->get(); break;
            default: $union = $wishlist_transactions->union($wishlist_viewers)->orderBy('created_at', "DESC")->get(); break;
        }

        $general_requests = new LengthAwarePaginator($union->forPage($page, $per_page), $union->count(), $per_page, $page);

        $this->response['msg'] = Helper::get_response_message("GENERAL_REQUEST_DATA");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "GENERAL_REQUEST_DATA";
        $this->response['has_morepages'] = $general_requests->hasMorePages();
        $this->response['data'] = $this->transformer->transform($general_requests, new GeneralRequestTransformer, 'collection');
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

    public function compact(Request $request, $format = '') {

        $user = $request->user();

        $wishlist_viewers = WishlistViewer::with(['owner','viewer','wishlist'])
                                ->has('wishlist')->has('viewer')->has('owner')
                                ->where('owner_id', $user->id)->where('status', "pending")
                                ->orderBy('created_at', "DESC")->take(3)
                                ->get();

        $wishlist_transactions = WishlistTransaction::with(['sender', 'wishlist'])
                                    ->has('sender')->has('wishlist')
                                    ->where('owner_id', $user->id)->where('status', "pending")
                                    ->orderBy('created_at', "DESC")->take(3)
                                    ->get();

        $owned_wishlist_viewers = WishlistViewer::with(['owner','viewer','wishlist'])
                                    ->has('wishlist')->has('viewer')->has('owner')
                                    ->where('viewer_id', $user->id)->where('status', "pending")
                                    ->orderBy('created_at', "DESC")->take(3)
                                    ->get();

        $this->response['msg'] = Helper::get_response_message("GENERAL_REQUEST_DATA");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "GENERAL_REQUEST_DATA";
        $this->response['data'] = [
            'wishlist_viewer' => $this->transformer->transform($wishlist_viewers, new WishlistViewerTransformer, 'collection'),
            'wishlist_transaction' => $this->transformer->transform($wishlist_transactions, new WishlistTransactionTransformer, 'collection'),
            'owned_wishlist_viewer' => $this->transformer->transform($owned_wishlist_viewers, new WishlistViewerTransformer, 'collection'),
        ];

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
