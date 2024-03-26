<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
</head>
<body>

	@if(Session::has('status'))
		{{session()->get('status')}}
		@if(session()->get('status') == 'Success!')
			@foreach($data[1] as $form_labels)
				Remarks : {{$form_labels['remarks']}}<br>
				Complied: {{($form_labels['complied'] == 1 ? "Yes":"No")}}<br>
			@endforeach
		@endif
	@endif

	<form action="{{asset('/employee/upload')}}" method="POST" enctype="multipart/form-data">
	    {{ csrf_field() }}
	    Item:
	    <br />
	    <input type="file" name="logo" />
	    <br /><br />
	    <input type="submit" value=" Save " />
	</form>

</body>
</html>



