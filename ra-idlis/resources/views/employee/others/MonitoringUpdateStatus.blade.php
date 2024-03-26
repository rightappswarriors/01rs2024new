@if (session()->exists('employee_login')) 
@extends('mainEmployee')
@section('title', 'Monitoring Update Status of CA')
@section('content')
  	<div class="content p-4">
	    <div class="card">
	      	<div class="card-header bg-white font-weight-bold">
	           <a href="{{asset('employee/dashboard/others/monitoring')}}">Monitoring Entry</a> / <a href="{{asset('employee/dashboard/others/monitoring/inspection')}}">Monitoring Tool </a> / <a href="{{asset('employee/dashboard/others/monitoring/technical')}}">Technical Findings</a> / Update Status of CA
			   @include('employee.tableDateSearch')
			</div>
			<div class="card-body table-responsive">
				<table class="table table-hover" style="font-size: 13px;" id="example">
	        		<thead>
	        			<tr>
	        				<th scope="col" style="text-align: center; width:auto;">ID</th>
	        				<th scope="col" style="text-align: center; width:auto">NOV No.</th>
	        				<th scope="col" style="text-align: center; width:auto">Date Issued</th>
	        				<th scope="col" style="text-align: center; width:auto">Name of Facility</th>
	        				<th scope="col" style="text-align: center; width:auto">Status</th>
	        				<th scope="col" style="text-align: center; width:15%">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@isset($AllData)
	        				@foreach($AllData as $key => $value)
							@if(AjaxController::checkmonid($value->monid) == 'no')
									<?php  continue; ?>
							@endif
	        					<tr>
	        						<td style="text-align: center;">{{$value->monid}}</td>
	        						<td style="text-align: center;">@if($value->novid != "") {{ AjaxController::getNovidById($value->monid, "M")->novid }} @endif</td>
	        						<td style="text-align: center;">{{\Carbon\Carbon::parse($value->date_issued)->format('M d, Y')}}</td>
	        						<td style="text-align: center;">{{$value->name_of_faci}}</td>
	        						@if($value->isApproved == 1)
	        							<td style="text-align: center; color: white;" class="bg-success"><b>{{"Accepted"}}</b></td>
	        						@elseif($value->isApproved == 2 || $value->isApproved == "")
	        							<td style="text-align: center; color: white;" class="bg-danger"><b>{{"Not Accepted"}}</b></td>
	        						{{-- @elseif($value->verdict == 3)
	        							<td style="text-align: center; color: white;" class="bg-warning"><b>{{AjaxController::getVerdictById($value->verdict)->vdesc}}</b></td> --}}
	        						@endif
	        						<td style="text-align: center;">
	        							<button class="btn btn-info w-100" data-toggle="modal" data-target="#updateModal" onclick="currentStatus('{{($value->isApproved != "")?"Accepted":"Not Accepted"}}', '{{$value->monid}}')">
	        								<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update
	        							</button>
	        						</td>
	        					</tr>
	        				@endforeach
	        			@endisset
	        		</tbody>
	        	</table>
	      	</div>
	    </div>
	</div>

	<script type="text/javascript">
		function currentStatus(isapproved, monid) {
			document.getElementById('currentStatus').innerHTML=isapproved;
			document.getElementById('umonid').value=monid;
		}
	</script>

	{{-- Update --}}
	<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	    	<div class="modal-content " style="border-radius: 0px;border: none;">
	        	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
		          	<h5 class="modal-title text-center">
		          		<strong>Update Status</strong>
		          	</h5>
			          	
		          	<hr>
		          	<div class="container">
		          		<form method="POST" action="{{asset('employee/dashboard/others/monitoring/updatestatus/mon_update')}}" data-parsley-validate enctype="multipart/form-data">
		          			{{ csrf_field() }}

		          			<input type="hidden" name="monid" id="umonid">

			          		<div class="row mt-2">
				          		<div class="col-sm-12">
				          			Status:<span style="color:red">*</span> (<span id="currentStatus"></span>)
				          		</div>

				          		<div class="col-sm-12">
				          			<select class="form-control" name="asd" {{-- onchange="recextrachange(this)" --}} id="recvselect" data-parsley-required-message="<b>*Status</b> required" required data-parsley="recvselect" required>
			          					<option disabled hidden selected value="0"></option>
				          				{{-- @isset($AllVer)
				          					@foreach($AllVer as $k => $v)
				          						<option value="{{$v->vid}}">{{$v->vdesc}}</option>
				          					@endforeach
				          				@endisset --}}
				          				<option value="1">Accepted</option>
				          				<option value="2">Not Accepted</option>
				          			</select>
				          		</div>

				          	</div>
					         
					        <div class="row mt-2">	
				          		<div class="col-sm-12 mb-1">
				          			<span id="recextra"></span>
				          		</div>
					        </div>  	

				          	{{-- submit btn --}}
			              	<div class="row mt-3">
			                	<div class="col-sm-6 w-100">
			                  		<button type="submit" class="btn btn-outline-success w-100"><center>Update</center></button>
			                	</div>

		                		<div class="col-sm-6 w-100">
			                  		<button type="button" data-dismiss="modal" class="btn btn-outline-danger w-100"><center>Close</center></button>
			                	</div>
			              	</div>
		              	</form>
		          	</div>
        		</div>
	      	</div>
	    </div>
  	</div>
	  <script>
			$(document).ready( function () {
    $('#myTable').DataTable();
} );
	</script>
	@include('employee.cmp._othersJS')
@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif