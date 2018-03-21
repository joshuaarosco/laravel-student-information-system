<html>
<head>
</head>
<body>
	<table>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;" rowspan="5"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;" rowspan="5">LRN</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"><strong>GRADE SHEET</strong></td>
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">SCHOOL YEAR: 2017-2018</td>
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">CURRICULUM YEAR: </td>
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">ADVISER: </td>
		</tr>
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;"></td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">NAME OF STUDENTS/PUPILS </td>
		</tr>
		@foreach($students as $index => $student)
		<tr>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">{{$index+1}}</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">{{$student->lrn}}</td>
			<td style="border: 3px solid #000; font-size: 12px; padding: 10px;">{{"{$student->lname}, {$student->fname} {$student->mname}"}}</td>
		</tr>
		@endforeach
	</table>
</body>
</html>