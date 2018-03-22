<html>
<head>

</head>
<body>
	<table>
		<tr>
			<td rowspan="2" style="border: 2px solid #000; text-align: center;"></td>
			<td rowspan="2" style="border: 2px solid #000;  text-align: center;">LRN</td>
			<td rowspan="2" style="border: 2px solid #000; text-align: center;">NAME <br>(Last Name, First Name, Middle Name)</td>
			<td rowspan="2" style="border: 2px solid #000; text-align: center;">Sex <br>(M/F)</td>
			<td rowspan="2" style="border: 2px solid #000; text-align: center;">BIRTHDATE <br> (mm/dd/yyyy)</td>
			<td rowspan="2" style="border: 2px solid #000; text-align: center;">AGE as of 1st Friday June</td>
			<td rowspan="2" style="border: 2px solid #000; text-align: center;">MOTHER TONGUE <br>(Grade 1 to 3 Only)</td>
			<td rowspan="2" style="border: 2px solid #000; text-align: center;">IP <br>(Ethnic Group)</td>
			<td rowspan="2" style="border: 2px solid #000; text-align: center;">Religion</td>
			<td colspan="4" style="border: 2px solid #000; text-align: center;">Address</td>
			<td colspan="2" style="border: 2px solid #000;  text-align: center;">Parents</td>
			<td colspan="2" style="border: 2px solid #000; text-align: center;">Guardian <br>(if Not Parent)</td>
			<td rowspan="2" style="border: 2px solid #000; text-align: center;">Contact Number of Parent or Guardian</td>
			<td style="text-align: center;">Remarks</td>
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td style="border: 2px solid #000; text-align: center;">House #/ Street/ Sitio/ Purok</td>
			<td style="border: 2px solid #000; text-align: center;">Barangay</td>
			<td style="border: 2px solid #000; text-align: center;">Municipality/ City</td>
			<td style="border: 2px solid #000; text-align: center;">Province</td>
			<td style="border: 2px solid #000; text-align: center;">Father's Name (Last Name, First Name, Middle Name)</td>
			<td style="border: 2px solid #000; text-align: center;">Mother's Maiden Name (Last Name, First Name, Middle </td>
			<td style="border: 2px solid #000; text-align: center;">Name</td>
			<td style="border: 2px solid #000; text-align: center;">Relationship</td>
			<td></td>
			<td style="border: 2px solid #000; text-align: center;">(Please refer to the legend on last page)</td>
		</tr>
		@foreach($students as $index => $student)
		<tr>
			<td style="border: 2px solid #000;">{{$index+1}}</td>
			<td style="border: 2px solid #000;">{{$student->lrn}}</td>
			<td style="border: 2px solid #000;">{{"{$student->lname}, {$student->fname} {$student->mname}"}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->gender:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->birthdate:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->age_of_first_friday_june:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->mother_tounge:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->ip:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->religion:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->house_street:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->barangay:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->municipality:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->province:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->fathers_name:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->mothers_name:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->guardian_name:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->relationship:'---'}}</td>
			<td style="border: 2px solid #000;">{{$student->contact_number}}</td>
			<td style="border: 2px solid #000;">{{$student->additional_info? $student->additional_info->remarks:'---'}}</td>
		</tr>
		@endforeach
	</table>	
</body>
</html>