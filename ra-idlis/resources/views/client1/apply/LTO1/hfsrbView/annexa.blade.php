	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	{{-- @include('client1.cmp.nav') --}}
		{{-- @include('client1.cmp.breadcrumb') --}}
		@include('client1.cmp.msg')

	<style>
		a:hover { text-decoration: none; }
	</style>

	<body>
		{{-- @include('client1.cmp.__wizard') --}}
		<div class="container text-center font-weight-bold mt-5">List of Personnel Annex A </div>
		<div class="container table-responsive pb-3">

			{{-- counting part --}}

			@php 
			$prof = $profCountAr = $area = $areaCount = array();
			$totalPer = $activePer = $inActivePer = $existPer = $expiredProf = $nearExpired = $profCount = 0;
			@endphp
			<table class="table table-hover" id="tApp">
	      		<thead style="background-color: #428bca; color: white" id="theadapp">
	      			<tr>
	      				<th>Exist In Other Facility?</th>
	      				<th>Option</th>
	      				<th>Prefix</th>
						<th>Surname</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Suffix</th>
						<th>Profession</th>
						<th>PRC Reg. Number</th>
						<th>Validity Period Until</th>
						{{-- <th>Speciality</th> --}}
						<th>Date of Birth</th>
						<th>Sex</th>
						<th>Email</th>
						<th>Employment</th>
						<th>Position/Designation</th>
						<th>Qualification</th>
						{{-- <th>Area</th> --}}
						<th>Work Status</th>
						{{-- <th>TIN</th> --}}
						<th>Status</th>
					</tr>
	      		</thead>
	      		<tbody id="loadHere">
	      			@foreach($hfsrbannexa as $personnel)
	      				<?php $appid = []; ?>
	      				@php 
	      					if(!in_array(trim($personnel->posname),$prof)){
	      						array_push($prof,$personnel->posname);
	      						array_push($profCountAr, 1);
	      					} else {
	      						$ind = array_search(trim($personnel->posname),$prof);
	      						$profCountAr[$ind] += 1;
	      					}

	      					if(!in_array(trim($personnel->area),$area)){
	      						array_push($area,$personnel->area);
	      						array_push($areaCount, 1);
	      					} /*else {
	      						$ind = array_search(trim($personnel->posname),$prof);
	      						$areaCount[$ind] += 1;
	      					}*/
	      					$totalPer++;
	      					$exist = AjaxController::isExistonDB('hfsrbannexa','appid',$personnel->appid,array('surname','firstname'),array(strtolower($personnel->surname), strtolower($personnel->firstname)),true);
	      					$trigger = count($exist) > 1 ? true : false;
	      					$_trColor = 'white';
	      					$_stat = array('Active');

							if($personnel->validityPeriodTo != ''){
								if(strtotime($personnel->validityPeriodTo) <= strtotime('now')){
									$_trColor = 'danger';
									array_push($_stat, 'PRC License Expired');
									$expiredProf++;
								} else if(strtotime($personnel->validityPeriodTo) <= strtotime('+1 month')){
									$_trColor = 'warning';
									array_push($_stat, 'PRC License Almost Expired');
									$nearExpired++;
								}
							}
	      					


	      					if($personnel->status == 0){
	      						unset($_stat[0]);
	      						array_push($_stat, 'Resigned');
	      						$inActivePer++;
	      					} else if($personnel->status == 1){
	      						$activePer++;
	      					}

	      				@endphp
						<tr class="bg-{{$_trColor}}">
							<td @if($trigger) class="font-weight-bold text-warning" @endif>
								@if($trigger)
									YES
									@php
									$existPer++;
									@endphp
								@else
									NO
								@endif
							</td>
							<td>
								@if($trigger)
									@foreach($exist as $e)
									@php
									array_push($appid, $e->appid);
									@endphp
									@endforeach
									<button onclick="getFacilities('{{implode(',',$appid)}}')" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye"></i></button>
								@else
									NO
								@endif
							</td>
							<td>{{ucfirst($personnel->prefix)}}</td>
							<td>{{ucfirst($personnel->surname)}}</td>
							<td>{{ucfirst($personnel->firstname)}}</td>
							<td>{{ucfirst($personnel->middlename)}}</td>
							<td>{{ucfirst($personnel->suffix)}}</td>
							<td>{{ucfirst($personnel->posname)}}</td>
							<td>{{$personnel->prcno}}</td>
							{{-- <td>{{$personnel->validityPeriodFrom}}</td> --}}
							<td>{{$personnel->validityPeriodTo}}</td>
							{{-- <td>{{$personnel->speciality}}</td> --}}
							<td>{{$personnel->dob}}</td>
							<td>{{$personnel->sex}}</td>
							<td>{{$personnel->email}}</td>
							<td>{{$personnel->pworksname}}</td>
							<td>{{$personnel->pos}}</td>
							<td>{{$personnel->qual}}</td>
							{{-- <td>{{$personnel->designation}}</td> --}}
							{{-- <td>{{$personnel->area}}</td> --}}
							<td>{{$personnel->pworksname}}</td>
							{{-- <td>{{$personnel->tin}}</td> --}}
							<td class="font-weight-bold">{{implode(',',$_stat)}}</td>
							
						</tr>
						@endforeach
	      		</tbody>
	      	</table>
	      	{{-- <div class="d-flex justify-content-end list-unstyled" style="font-size: 30px; letter-spacing: .5em;">
	      		{!!$hfsrbannexa->links()!!}
	      	</div> --}}
		</div>
		@php
		$prof = array_combine($prof, $profCountAr);
		$area = array_combine($area, $areaCount);
		@endphp
		<div class="container mt-5">
			<div class="row">
				<div class="col-md">
					Total Count of Personnel: <span class="font-weight-bold">{{$totalPer}}</span>
				</div>
				<div class="col-md">
					Total Count of Active Personnel: <span class="font-weight-bold">{{$activePer}}</span>
				</div>
				<div class="col-md">
					Total Count of In-Active Personnel: <span class="font-weight-bold">{{$inActivePer}}</span>
				</div>
				<div class="col-md">
					Total Count of Personnel that exist on other Facilities: <span class="font-weight-bold">{{$existPer}}</span>
				</div>
				<div class="col-md">
					Total Count of Personnel with Expired PRC: <span class="font-weight-bold">{{$expiredProf}}</span>
				</div>
				<div class="col-md">
					Total Count of Personnel with Near Expired PRC: <span class="font-weight-bold">{{$nearExpired}}</span>
				</div>
			</div>
		</div>

		<div class="container mt-5">
			<div class="row">
				<div class="col-md">
					Count on Profession based on:
				</div>

				{{-- <div class="col-md">
					Count on Area of Assignment based on:
				</div> --}}
			</div>
			<div class="row">
				<div class="col-md mt-4">
					@foreach($prof as $key => $values)
						<div class="row">
							<div class="col-md-4 font-weight-bold">{{$key}}</div>
							<div class="col-md font-weight-bold text-left">{{$values}}</div>
						</div>
					@endforeach
				</div>

				{{-- <div class="col-md mt-4">
					@foreach($area as $key => $values)
						<div class="row">
							<div class="col-md-4 font-weight-bold">{{$key}}</div>
							<div class="col-md font-weight-bold text-left">{{$values}}</div>
						</div>
					@endforeach
				</div> --}}
			</div>
			
		</div>

		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Facilities</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <table class="table table-bordered" id="facilities">
		        	<thead>
		        		<th>Facility Name</th>
		        		<th>Link To Facility</th>
		        	</thead>
		        </table>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		{{-- @include('client1.cmp.footer') --}}
		<script>
			$(function(){
				$("#tApp").dataTable();
			})
			function getFacilities(appid){
				if(appid.length){
					$.ajax({
						method: 'POST',
						data: {_token: '{{csrf_token()}}',appid: [appid]},
						success: function(a){
							$('#facilities').DataTable().clear().draw();
							if(a.length){
								for (var i = 0 ; i < a.length; i++) {
									$('#facilities').DataTable().row.add([
										a[i]['facilityname'],
										'<a target="blank" href="'+'{{url('client1/apply/hfsrb/view/annexa/')}}/'+a[i]['appid']+' '+'">'+a[i]['facilityname']+'</a>'
									]).draw();
								}
							}
						}
					})
				}
			}
		</script>
	</body>
	@endsection