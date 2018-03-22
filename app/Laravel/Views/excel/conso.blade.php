<html>
<head>
</head>
<body>
	<table>
		<tr>
			<td>&nbsp;</td>
		</tr>
	</table>
	<table>
		<tr>
			<td style="border: 3px solid #000;" rowspan="5"></td>
			<td style="border: 3px solid #000;" rowspan="5"><center style="text-align: center;" >LRN</center></td>
			<td style="border: 3px solid #000;" colspan="21"><strong style="text-align: center;">GRADE SHEET</strong></td>
		</tr>
		<tr>
			<td style="border: 3px solid #000;"></td>
			<td style="border: 3px solid #000;"></td>
			<td style="border: 3px solid #000;">SCHOOL YEAR: {{$section->school_year}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border: 3px solid #000; text-align: center;" colspan="5"><span style="text-align: center;">TCHR: {{"{$subject->teacher->lname}, {$subject->teacher->fname}"}}</span></td>
			@endforeach
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="10">
				<strong style="text-align: center;">QUARTERLY RANKING AND AVERAGE WITH DECIMAL PLACE</strong>
			</td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="10">
				<strong style="text-align: center;">QUARTERLY RANKING AND AVERAGE WHOLE NUMBERS</strong>
			</td>
		</tr>
		<tr>
			<td style="border: 3px solid #000;"></td>
			<td style="border: 3px solid #000;"></td>
			<td style="border: 3px solid #000;">CURRICULUM YEAR: {{$section->section_name}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="5"></td>
			@endforeach
			@foreach(range(1, 2) as $value)
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="2"><strong style="text-align: center;">FIRST</strong></td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="2"><strong style="text-align: center;">SECOND</strong></td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="2"><strong style="text-align: center;">THIRD</strong></td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="2"><strong style="text-align: center;">FOURTH</strong></td>
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="2"><strong style="text-align: center;">FINAL</strong></td>
			@endforeach
		</tr>
		<tr>
			<td style="border: 3px solid #000;"></td>
			<td style="border: 3px solid #000;"></td>
			<td style="border: 3px solid #000;">ADVISER: {{"{$section->adviser->fname} {$section->adviser->lname}"}}</td>
			@foreach($subjects as $index => $subject)
			<td style="border-bottom: 3px solid #000; border-right: 3px solid #000;" colspan="5"><center style="text-align: center;">SUBJ: {{Str::upper($subject->subject_title)}}</center></td>
			@endforeach
			@foreach(range(1, 2) as $value)
			@foreach(range(1,4) as $data)
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="2"><strong style="text-align: center;">GRADING</strong></td>
			@endforeach
			<td style="border-top: 3px solid #000; border-right: 3px solid #000; text-align: center;" colspan="2"><strong style="text-align: center;">RATING</strong></td>
			@endforeach
		</tr>
		<tr>
			<td style="border: 3px solid #000;"></td>
			<td style="border: 3px solid #000;"></td>
			<td style="border: 3px solid #000;">NAME OF STUDENTS/PUPILS </td>
			@foreach($subjects as $index => $subject)
			<td style="border: 3px solid #000; text-align: center;">1</td>
			<td style="border: 3px solid #000; text-align: center;">2</td>
			<td style="border: 3px solid #000; text-align: center;">3</td>
			<td style="border: 3px solid #000; text-align: center;">4</td>
			<td style="border: 3px solid #000; text-align: center;">AVE</td>
			@endforeach
			@foreach(range(1, 10) as $value)
			<td style="border: 3px solid #000; text-align: center;">AVE</td>
			<td style="border: 3px solid #000; text-align: center;">RANK</td>
			@endforeach
		</tr>
		@foreach($students as $index => $student)
		<tr>
			<td style="border: 3px solid #000;">{{$index+1}}</td>
			<td style="border: 3px solid #000; text-align: center;">{{$student->lrn}}</td>
			<td style="border: 3px solid #000;">{{"{$student->lname}, {$student->fname} {$student->mname}"}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>