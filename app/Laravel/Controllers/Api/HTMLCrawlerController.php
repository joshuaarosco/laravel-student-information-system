<?php

namespace App\Laravel\Controllers\Api;

use Str;
use Helper;
use Validator;
use Preview;
use Goutte\Client as GoutteClient;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use App\Laravel\Transformers\MasterTransformer;
use App\Laravel\Transformers\TransformerManager;

class HTMLCrawlerController extends Controller
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

    public function link_preview(Request $request, $format = '') {
        
        $request->merge(['url' => Helper::clean_url($request->get('url'))]);

        $validator = Validator::make($request->all(), [
            'url' => "required|url",
        ]);

        if($validator->fails()) {
            $this->response['msg'] = Helper::get_response_message("INVALID_DATA");
            $this->response['status_code'] = "INVALID_DATA";
            $this->response['errors'] = $validator->errors();
            $this->response_code = 422;
            goto callback;
        }

        try {

            $url = $request->get('url');
            $parse_url = parse_url($url);
            $preview = Preview::setUrl($url)->getPreview('general')->toArray();
            $preview['cover'] = Helper::clean_url($preview['cover']);
            $preview['images'] = array_flatten($preview['images']);

            $this->response['msg'] = Helper::get_response_message("PAGE_INFO");
            $this->response['status'] = TRUE;
            $this->response['status_code'] = "PAGE_INFO";
            $this->response['data'] = $this->transformer->transform($preview, new MasterTransformer, 'item');
            $this->response_code = 200;

        } catch (ConnectionErrorException $e) {

            $this->response['msg'] = "Connection error, please try again.";
            $this->response['status'] = TRUE;
            $this->response['status_code'] = "CONNECTION_ERROR";
            $this->response_code = 503;
        }

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

    public function link_preview_v2(Request $request, $format = '') {

        $request->merge(['url' => Helper::clean_url($request->get('url'))]);

        $validator = Validator::make($request->all(), [
            'url' => "required|url",
        ]);

        if($validator->fails()) {
            $this->response['msg'] = Helper::get_response_message("INVALID_DATA");
            $this->response['status_code'] = "INVALID_DATA";
            $this->response['errors'] = $validator->errors();
            $this->response_code = 422;
            goto callback;
        }
        
        $url = $request->get('url');
        $hostname = parse_url($url, PHP_URL_HOST);

        $preview = [
            'title' => "",
            'description' => "",
            'url' => $url,
            'cover' => "",
            'images' => array(),
            'metas' => array(),
        ];

        switch ($hostname) {
            case 'www.amazon.com':
                $jar = new CookieJar();
                $goutte = new GoutteClient();
                $guzzle = new GuzzleClient([
                    'allow_redirects' => ['max' => 10],
                    'connect_timeout' => 15,
                    'cookies' => $jar,
                ]);

                $crawler = $goutte->setClient($guzzle)->request('GET', $url);
                
                $preview['title'] = $crawler->filter('title')->text();

                $cover = $crawler->filterXpath("//div[@id='imgTagWrapperId']/img")->first();
                if(count($cover)) {
                    $preview['description'] = $cover->attr('alt');
                    $preview['cover'] = $cover->attr('data-old-hires');
                    $preview['images'] = array($preview['cover']);
                    $preview['metas'] = [
                        array(
                            'name' => "cover", 
                            'property' => "og:image", 
                            'content' => $preview['cover']
                        ),
                    ];
                }
            break;
            
            default:
                $preview = array_replace($preview, Preview::setUrl($url)->getPreview('general')->toArray());
                $preview['images'] = [$preview['cover']];
                $preview['metas'] += [
                    [
                        'name' => "cover", 
                        'property' => "og:image", 
                        'content' => $preview['cover'],
                    ]
                ];
                if(count($preview['images']) == 0) {
                    $preview['images'] += array_flatten($preview['images']);
                }
            break;
        }

        // switch($hostname){
        //     case 'ebay.sg':
        //     case 'ebay.com.sg':
        //     case 'ebay.ph':
        //     case 'ebay.com.ph':
        //     case 'ebay.com':
        //         $path = parse_url($url, PHP_URL_PATH);
        //         $segments = explode("/", $path);
        //         $item_code = end($segments);
        //         $url = "http://www.ebay.com/itm/{$item_code}";
        //     break;
        //     default : 

        //         $url = str_replace("http://m.", "http://", $url);
        //         $url = str_replace("https://m.", "https://", $url);
        // }

        $this->response['msg'] = Helper::get_response_message("PAGE_INFO");
        $this->response['status'] = TRUE;
        $this->response['status_code'] = "PAGE_INFO";
        $this->response['data'] = $this->transformer->transform($preview, new MasterTransformer, 'item');
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
