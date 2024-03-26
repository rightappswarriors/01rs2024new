@if (session()->exists('employee_login'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')

	<body>
		<div class="container pt-3 pb-3">
			<div class="container">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
							<th>Full Name</th>
							<th>Designation/Position</th>
							<th>Facility Assignment</th>
							<th>Qualification</th>
							<th>PRC License Number</th>
							<th>Validity Period</th>
							<th>PRC ID</th>
							<th>Board Certificate</th>
							<th>Contract of Employment</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cdrrhrpersonnel as $personnel)
							<tr>
								<td>{{$personnel->name}}</td>
								<td>{{$personnel->designation}}</td>
								<td>{{$personnel->faciassign}}</td>
								<td>
									
								@php 

										$personel_professions = json_decode($personnel->profession);

										if($personel_professions != NULL){
											foreach($personel_professions as $personel_profession){
												if(isset($profession[$personel_profession.'-Radiology'])){
													echo $profession[$personel_profession.'-Radiology'].'<br>';
												}
												
											}
										}
										
								@endphp
								</td>
								<td>{{$personnel->prcno}}</td>
								<td>{{$personnel->validity}}</td>
								<td class="text-center"><a target="_blank" href="{{ route('OpenFile', $personnel->prc)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
								<td class="text-center"><a target="_blank" href="{{ route('OpenFile', $personnel->bc)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
								<td class="text-center"><a target="_blank" href="{{ route('OpenFile', $personnel->coe)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
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
		</script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif