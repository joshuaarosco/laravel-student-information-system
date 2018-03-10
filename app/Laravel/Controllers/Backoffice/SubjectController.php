<?php namespace App\Laravel\Controllers\Backoffice;

/**
*
* Models used for this controller
*/
use App\Laravel\Models\Subject;

/**
*
* Requests used for validating inputs
*/
use App\Laravel\Requests\Backoffice\SubjectRequest;

/**
*
* Classes used for this controller
*/
use App\Laravel\Models\User;
use App\Http\Requests\Request;
use Input, Helper, Carbon, Session, Str, File, Image, ImageUploader, DB;

class SubjectController extends Controller{

	/**
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		parent::__construct();
		$view = Input::get('view','table');
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "Subject";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "subjects";
		$this->data['featureds'] = ['no'=>"No",'yes'=>"Yes"];
		$this->data['teachers'] = ['' => "Choose A Teacher"] + User::select(DB::raw('CONCAT(lname, ", ", fname) AS full_name'), 'id')
		->where('type','teacher')
		->orderBy('lname')
		->pluck('full_name','id')->toArray();
	}

	public function index () {
		$this->data['subjects'] = Subject::orderBy('created_at',"DESC")->get();
		return view('backoffice.'.$this->data['route_file'].'.index',$this->data);
	}

	public function create () {
		return view('backoffice.'.$this->data['route_file'].'.create',$this->data);
	}

	public function store (SubjectRequest $request) {
		try {
			$new_subject = new Subject;
			$new_subject->fill($request->all());

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/subjects');
				$new_subject->path = $upload["path"];
				$new_subject->directory = $upload["directory"];
				$new_subject->filename = $upload["filename"];
			}

			if($new_subject->save()) {
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
		$subjects = Subject::find($id);

		if (!$subjects) {
			Session::flash('notification-status',"failed");
			Session::flash('notification-msg',"Record not found.");
			return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
		}

		$this->data['subject'] = $subjects;
		return view('backoffice.'.$this->data['route_file'].'.edit',$this->data);
	}

	public function update (SubjectRequest $request, $id = NULL) {
		try {
			$subjects = Subject::find($id);

			if (!$subjects) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			$subjects->fill($request->all());

			if($request->hasFile('file')){
				$upload = ImageUploader::upload($request->file,'storage/subjects');
				if($upload){	
					if (File::exists("{$subjects->directory}/{$subjects->filename}")){
						File::delete("{$subjects->directory}/{$subjects->filename}");
					}
					if (File::exists("{$subjects->directory}/resized/{$subjects->filename}")){
						File::delete("{$subjects->directory}/resized/{$subjects->filename}");
					}
					if (File::exists("{$subjects->directory}/thumbnails/{$subjects->filename}")){
						File::delete("{$subjects->directory}/thumbnails/{$subjects->filename}");
					}
				}
				
				$subjects->path = $upload["path"];
				$subjects->directory = $upload["directory"];
				$subjects->filename = $upload["filename"];
			}

			if($subjects->save()) {
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
			$subjects = Subject::find($id);

			if (!$subjects) {
				Session::flash('notification-status',"failed");
				Session::flash('notification-msg',"Record not found.");
				return redirect()->route('backoffice.'.$this->data['route_file'].'.index');
			}

			if (File::exists("{$subjects->directory}/{$subjects->filename}")){
				File::delete("{$subjects->directory}/{$subjects->filename}");
			}
			if (File::exists("{$subjects->directory}/resized/{$subjects->filename}")){
				File::delete("{$subjects->directory}/resized/{$subjects->filename}");
			}
			if (File::exists("{$subjects->directory}/thumbnails/{$subjects->filename}")){
				File::delete("{$subjects->directory}/thumbnails/{$subjects->filename}");
			}

			if($subjects->save() AND $subjects->delete()) {
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