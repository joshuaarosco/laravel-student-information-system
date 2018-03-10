<?php namespace App\Laravel\Controllers\Backoffice;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\News;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Backoffice\NewsRequest;
use App\Laravel\Requests\Backoffice\EditNewsRequest;

/**
*
* Classes used for this controller
*/
use App\Http\Requests\Request;
use Input, Helper, Carbon, Session, Str, File, Image, ImageUploader;

class NewsController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		parent::__construct();
		$view = Input::get('view','table');
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "News";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "news";
		$this->data['featureds'] = ['no'=>"No",'yes'=>"Yes"];
	}

	public function index () {
		$this->data['news'] = News::orderBy('created_at',"DESC")->get();
		return view('backoffice.'.$this->data['route_file'].'.index',$this->data);
	}

	public function create () {
		return view('backoffice.'.$this->data['route_file'].'.create',$this->data);
	}

	public function store (NewsRequest $request) {
		try {
			$new_news = new News;
			$new_news->fill($request->all());

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/news');
				$new_news->path = $upload["path"];
				$new_news->directory = $upload["directory"];
				$new_news->filename = $upload["filename"];
			}

			if($new_news->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"New news has been added.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			Session::flash('notification-status','failed');
			Session::flash('notification-msg','Something went wrong.');

			return redirect()->back();
		} catch (Exception $e) {
			Session::flash('notification-status','failed');
			Session::flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}
	}

	public function edit ($id = NULL) {
		$news = News::find($id);

		if (!$news) {
			Session::flash('notification-status',"failed");
			Session::flash('notification-msg',"Record not found.");
			return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
		}

		$this->data['news'] = $news;
		return view('backoffice.'.$this->data['route_file'].'.edit',$this->data);
	}

	public function update (EditNewsRequest $request, $id = NULL) {
		try {
			$news = News::find($id);

			if (!$news) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			$news->fill($request->all());

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/news');
				if($upload){	
					if (File::exists("{$news->directory}/{$news->filename}")){
						File::delete("{$news->directory}/{$news->filename}");
					}
					if (File::exists("{$news->directory}/resized/{$news->filename}")){
						File::delete("{$news->directory}/resized/{$news->filename}");
					}
					if (File::exists("{$news->directory}/thumbnails/{$news->filename}")){
						File::delete("{$news->directory}/thumbnails/{$news->filename}");
					}
				}
				
				$news->path = $upload["path"];
				$news->directory = $upload["directory"];
				$news->filename = $upload["filename"];
			}

			if($news->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"A news has been updated.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			Session::flash('notification-status','failed');
			Session::flash('notification-msg','Something went wrong.');

		} catch (Exception $e) {
			Session::flash('notification-status','failed');
			Session::flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}
	}

	public function destroy ($id = NULL) {
		try {
			$news = News::find($id);

			if (!$news) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			if (File::exists("{$news->directory}/{$news->filename}")){
				File::delete("{$news->directory}/{$news->filename}");
			}
			if (File::exists("{$news->directory}/resized/{$news->filename}")){
				File::delete("{$news->directory}/resized/{$news->filename}");
			}
			if (File::exists("{$news->directory}/thumbnails/{$news->filename}")){
				File::delete("{$news->directory}/thumbnails/{$news->filename}");
			}

			if($news->save() AND $news->delete()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"A news has been deleted.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			Session::flash('notification-status','failed');
			Session::flash('notification-msg','Something went wrong.');

		} catch (Exception $e) {
			Session::flash('notification-status','failed');
			Session::flash('notification-msg',$e->getMessage());
			return redirect()->back();
		}
	}

}