<?php namespace App\Laravel\Controllers\Backoffice;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\Section;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Backoffice\SectionRequest;

/**
*
* Classes used for this controller
*/
use App\Laravel\Models\User;
use App\Http\Requests\Request;
use Input, Helper, Carbon, Session, Str, File, Image, ImageUploader, DB;

class SectionController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		parent::__construct();
		$view = Input::get('view','table');
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "Section";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "sections";
		$this->data['featureds'] = ['no'=>"No",'yes'=>"Yes"];
		$this->data['teachers'] = ['' => "Choose A Teacher"] + User::select(DB::raw('CONCAT(lname, ", ", fname) AS full_name'), 'id')
		->where('type','teacher')
		->orderBy('lname')
		->pluck('full_name','id')->toArray();
	}

	public function index () {
		$this->data['sections'] = Section::orderBy('created_at',"DESC")->get();
		return view('backoffice.'.$this->data['route_file'].'.index',$this->data);
	}

	public function create () {
		return view('backoffice.'.$this->data['route_file'].'.create',$this->data);
	}

	public function store (SectionRequest $request) {
		try {
			$new_section = new Section;
			$new_section->fill($request->all());

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/sections');
				$new_section->path = $upload["path"];
				$new_section->directory = $upload["directory"];
				$new_section->filename = $upload["filename"];
			}

			if($new_section->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"New data has been added.");
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
		$section = Section::find($id);

		if (!$section) {
			Session::flash('notification-status',"failed");
			Session::flash('notification-msg',"Record not found.");
			return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
		}

		$this->data['sections'] = $section;
		return view('backoffice.'.$this->data['route_file'].'.edit',$this->data);
	}

	public function update (SectionRequest $request, $id = NULL) {
		try {
			$section = Section::find($id);

			if (!$section) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			$section->fill($request->all());

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/sections');
				if($upload){	
					if (File::exists("{$section->directory}/{$section->filename}")){
						File::delete("{$section->directory}/{$section->filename}");
					}
					if (File::exists("{$section->directory}/resized/{$section->filename}")){
						File::delete("{$section->directory}/resized/{$section->filename}");
					}
					if (File::exists("{$section->directory}/thumbnails/{$section->filename}")){
						File::delete("{$section->directory}/thumbnails/{$section->filename}");
					}
				}
				
				$section->path = $upload["path"];
				$section->directory = $upload["directory"];
				$section->filename = $upload["filename"];
			}

			if($section->save()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"A data has been updated.");
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
			$section = Section::find($id);

			if (!$section) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			if (File::exists("{$section->directory}/{$section->filename}")){
				File::delete("{$section->directory}/{$section->filename}");
			}
			if (File::exists("{$section->directory}/resized/{$section->filename}")){
				File::delete("{$section->directory}/resized/{$section->filename}");
			}
			if (File::exists("{$section->directory}/thumbnails/{$section->filename}")){
				File::delete("{$section->directory}/thumbnails/{$section->filename}");
			}

			if($section->save() AND $section->delete()) {
				Session::flash('notification-status','success');
				Session::flash('notification-msg',"A data has been deleted.");
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