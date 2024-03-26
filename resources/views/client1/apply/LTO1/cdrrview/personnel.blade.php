@if (session()->exists('employee_login'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	<body>
		<div class="container-fluid pb-3 mt-5">
			@if($tag)
			<div class="container display-4 mb-3 text-center">Pharmacist Tagging</div>
			<div class="container text-center mb-3 font-weight-bold">Current User Logged In: <u>{{($currentUser['fullname'] ?? 'NOT SET')}}</u></div>
			@endif
			<div class="container-fluid">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
		      				@if($tag)
		      				<th>Connected with other hf?</th>
		      				@endif
							<th>Name</th>
							<th>Designation/Position</th>
							<th>Qualification</th>
							<th>TIN</th>
							<th>Email</th>
							<th>Area of Assignment</th>
							<th>Date of Birth</th>
							<th>PRC Registration Number</th>
							<th>Validity</th>
							<th>PRC</th>							
							<th>Certificate of Training</th>
							@if($tag)
		      				<th>Option</th>
		      				@endif
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cdrrpersonnel as $personnel)
							<tr>
								@if($tag)
			      				<th>{!!$personnel->isTag == 1 ? '<span class="text-danger">Yes</span>' : '<span class="text-dark">No</span>'!!}</th>
			      				@endif
								<td>{{$personnel->name}}</td>
								<td>{{$personnel->designation}}</td>
								<td>
								@php 
									$personel_professions = json_decode($personnel->profession);

									if($personel_professions != NULL){
										foreach($personel_professions as $personel_profession){
											if(isset($profession[$personel_profession.'-Pharmacy'])){
												echo $profession[$personel_profession.'-Pharmacy'].'<br>';
											}
										}
									}

									@endphp
								</td>
								<td>{{$personnel->tin}}</td>
								<td>{{$personnel->email}}</td>
								<td>{{$personnel->area}}</td>
								<td>{{$personnel->dob}}</td>
								<td>{{$personnel->prcno}}</td>
								<td>{{$personnel->validity}}</td>
								<td class="text-center"><a target="_blank" href="{{ route('OpenFile', $personnel->prc)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
								<td class="text-center"><a target="_blank" href="{{ route('OpenFile', $personnel->coe)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
								@if($tag)
				      				@switch($personnel->isTag)
				      					@case(1)
				      						<td><button class="btn btn-primary" onclick="procesTag(0,'{{$personnel->id}}')"><i class="fa fa-times" aria-hidden="true"></i> Un-tag</button></td>
				      					@break;
				      					@default
				      						<td><button class="btn btn-danger" onclick="procesTag(1,'{{$personnel->id}}')"><i class="fa fa-tag" aria-hidden="true"></i> Tag</button></td>
				      					@break
				      				@endswitch
			      				@endif
							</tr>
							@endforeach
		      		</tbody>
		      	</table>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>

		<script>
			$(function(){
				$("#tApp").dataTable();
			})

			function procesTag(choice,id){
				let r;
				switch (choice) {
					case 0:
						r = confirm('Are you sure you want to Untag this Personnel?');
						break;
					case 1:
						r = confirm('Are you sure you want to tag this Personnel?');
						break;
				}
				if(r){
					$.ajax({
						method: 'POST',
						data: {action : choice,id: id, _token: '{{csrf_token()}}'},
						success: function(a){
							if(a == 'DONE'){
								alert('Selected Operation successful');
								location.reload();
							} else {
								console.log(a);
							}
						}
					})
				}
			}
			
		</script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif