@if (session()->exists('employee_login'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	{{-- @include('client1.cmp.nav') --}}
		{{-- @include('client1.cmp.breadcrumb') --}}
		@include('client1.cmp.msg')

	<body>
		{{-- @include('client1.cmp.__wizard') --}}
		
		<div class="container pb-3 pt-5">
			{{-- <button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button> --}}
			<div class="container">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
		      				<th>Serial Exist on Other Facility?</th>
		      				<th>Option</th>
							<th>Equipment</th>
							<th>Brand Name</th>
							<th>Model</th>
							<th>Serial</th>
							<th>Manufacturing Date</th>
							<th>Date of Purchase</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($hfsrbannexb as $Equipment)
		      			<?php $appid = []; ?>
		      			@php
		      			$exist = AjaxController::isExistonDB('hfsrbannexb','appid',$Equipment->appid,array('serial'),array($Equipment->serial),true);
		      			$trigger = count($exist) > 1 ? true : false;
		      			@endphp
							<tr class="{{($trigger ? 'bg-danger' :"")}}">
								<td class="font-weight-bold">{{($trigger ? 'Yes' : 'No')}}</td>
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
								<td>{{$Equipment->equipment}}</td>
								<td>{{$Equipment->brandname}}</td>
								<td>{{$Equipment->model}}</td>
								<td>{{$Equipment->serial}}</td>
								<td>{{$Equipment->manDate}}</td>
								<td>{{$Equipment->dop}}</td>
							</tr>
							@endforeach
		      		</tbody>
		      	</table>
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
										'<a target="blank" href="'+'{{url('client1/apply/hfsrb/view/annexb/')}}/'+a[i]['appid']+' '+'">'+a[i]['facilityname']+'</a>'
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
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif