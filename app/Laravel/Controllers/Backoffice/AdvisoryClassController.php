<?php 

namespace App\Laravel\Controllers\Backoffice;

/*
*
* Models used for this controller
*/
use App\Laravel\Models\User;
use App\Laravel\Models\Student;
use App\Laravel\Models\Section;
use App\Laravel\Models\ClassList;

/*
*
* Requests used for validating inputs
*/


/*
*
* Classes used for this controller
*/
use Helper, Carbon, Session, Str, DB, Auth, PDF;

class AdvisoryClassController extends Controller{

	/*
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		$this->data = [];
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "Advisory Classes";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "advisory_class";
	}

	public function index () {
		$advisory_classes = Section::where('adviser_id',Auth::user()->id)->orderBy('school_year')->get();

		$this->data['advisory_classes'] = $advisory_classes;
		return view('backoffice.advisory_class.index',$this->data);
	}

	public function students($id){
		$section = Section::find($id);
		$class = ClassList::where('section_id',$id)->first();

		if(!$class){
			Session::flash('notification-status','failed');
			Session::flash('notification-msg',"Class not found.");
			return redirect()->back();
		}

		$student_ids = explode(', ',$class->student_ids);
		$this->data['students'] = Student::whereIn('id',$student_ids)->orderBy('lname')->get();
		$this->data['section'] = $section;
		return view('backoffice.advisory_class.students',$this->data);
	}

	public function student_info($id = 0){
		$this->data['student'] = Student::find($id);
		$pdf = PDF::loadView('dompdf.stud_info', $this->data);
		return $pdf->stream('dompdf.stud_info');
	}
}