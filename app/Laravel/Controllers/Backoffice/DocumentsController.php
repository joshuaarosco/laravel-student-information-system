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
use Helper, Carbon, Session, Str, DB, Auth, PDF, Excel;

class DocumentsController extends Controller{

	/*
	*
	* @var Array $data
	*/
	protected $data;

	public function __construct () {
		$this->data = [];
		parent::__construct();
		array_merge($this->data, parent::get_data());
		$this->data['page_title'] = "School Documents";
		$this->data['page_description'] = "This is the general information about ".$this->data['page_title'].".";
		$this->data['route_file'] = "documents";
	}

	public function sf1 () {
		$this->data['page_title'] = "School Form 1 (SF1)";
		$this->data['students'] = Student::orderBy('lname')->get();
		return view('backoffice.documents.sf1',$this->data);
	}

	public function sf1_view ($id = 0) {
		$this->data['student'] = Student::find($id);

		$pdf = PDF::loadView('dompdf.stud_info', $this->data);
		return $pdf->stream('dompdf.stud_info');
	}

	public function conso(){
		$this->data['page_title'] = "Consolidated";
		$this->data['students'] = Student::orderBy('lname')->get();
		return view('backoffice.documents.conso',$this->data);
	}

	public function school_data($id = 0){
		$date = Carbon::now();

		$ext = "xls";

		$class = ClassList::where('section_id',$id)->first()? : new ClassList;

		$students_ids = explode(', ',$class->students_ids);
		$subject_ids = explode(', ',$class->subject_ids);

		$this->data['students'] = Student::whereIn('id',$students_ids)->orderBy('lname')->get();
		$this->data['subjects'] = Subject::whereIn('id',$subject_ids)->get();

        $filename = "School Data-".Helper::date_format(Carbon::now(),'Y-m-d');

        Excel::create($filename, function($excel) {

            $excel->sheet('SF1', function($sheet) {
                $sheet->loadView('excel.sf1', $this->data);

            });

            $excel->sheet('CONSO', function($sheet) {
                $sheet->loadView('excel.conso', $this->data);

            });

        })->export($ext);
	}

	public function school_document(){
		$this->data['sections'] = Section::orderBy('created_at',"DESC")->get();
		return view('backoffice.documents.sections',$this-> data);
	}

}