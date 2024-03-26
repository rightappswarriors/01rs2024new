@extends('main')
@section('content')
@include('client1.cmp.__apply')
<style>
	/*.table .table-bordered{
		border: 2px solid black!important;
	}*/
</style>
<body>
	@include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb')
	@include('client1.cmp.msg')
	@include('client1.cmp.__wizard')
	@php
		$currentStatus = null;
	@endphp
	<br/>
	<div class="row">
		<div class="container text-center">
			<div class=" pt-1">
				<h3><span class="font-weight-bold text-uppercase">[{{$appform->hfser_id}}R{{$appform->rgnid}}-{{$appform->appid}}] {{$appform->facilityname}}</span> </h3>
			</div>			
			<div class=" pt-1">
				<span class="font-weight-normal text-uppercase">{{$appform->street_name}} {{$appform->street_number}} {{$appform->brgyname}} {{$appform->cmname}} {{$appform->provname}} {{$appform->rgn_desc}}</span>
			</div>
		</div>
	</div>

	<div class="container mt-5 mb-5">
	
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Description</th>
					<th>Upload</th>
					<th>Remarks</th>
					<th>View Uploaded</th>
				</tr>
			</thead>
			<tbody>

			@php
				$findups = 0;
			@endphp
				
				@if(count($appDet) > 0)
				<form id="upId" method="POST" enctype="multipart/form-data">
					{{csrf_field()}}
					@foreach($appDet AS $each)
					<tr>
						<script>
							console.log('{!! $each->upid. "--". $each->updesc !!}')
						</script>
						<td >
							{!!((isset($each->upDesc)) ? ('<span class="req"></span>'. $each->upDesc . ' (' . $each->updesc . ')' ) . '<br>' . (isset($each->upDescRemarks) ? '<span class="font-weight-bold"><br>Evaluator\'s Remarks: <br></span>'. $each->upDescRemarks : '') : ($each->isRequired == 1 ? '<span class="req"></span>'.$each->updesc : $each->updesc))!!}
							<!-- {!!((isset($each->upDesc)) ? ('<span class="req">'. $each->upDesc . ' (' . $each->updesc . ')' . '</span>') . '<br>' . (isset($each->upDescRemarks) ? '<span class="font-weight-bold"><br>Evaluator\'s Remarks: <br></span>'. $each->upDescRemarks : '') : ($each->isRequired == 1 ? '<span class="req">'.$each->updesc.'</span>' : $each->updesc))!!} -->
						</td>
						<td><center>
					
							@isset($each->filepath)
								@isset($each->evaluation) 
								@switch($each->evaluation)
									@case(0)
										@php
											$currentStatus = 0;
											$findups += 1;
										@endphp
										<label class="badge badge-danger">Uploaded file denied.</label>
										{{-- @if($appform->canapply == 1) --}}
										
											<input class="form-control" type="file" name="upload[{{$each->upid}}]" @if($each->isRequired == 1) required @endif accept="image/png, image/jpeg, image/jpg, image/gif, image/bmp, application/pdf">
										{{-- @endif --}}
										@break
									@case(1)
										@php
											$currentStatus = 1;
										@endphp
										<label class="badge badge-success">Uploaded file approved.</label>
										<!-- <input class="form-control" type="file" name="upload[{{$each->upid}}]" @if($each->isRequired == 1) required @endif> -->
										@break
									@default
										@break
								@endswitch @else
										@php
											$currentStatus = 3;
										@endphp
									<label class="badge badge-warning">Uploaded file not yet evaluated.</label>
									<!-- <input class="form-control" type="file" name="upload[{{$each->upid}}]" @if($each->isRequired == 1) required @endif> -->
								@endisset
							@else
								@php
									$findups += 1;
									$currentStatus = 5;
								@endphp
								<input class="form-control" type="file" name="upload[{{$each->upid}}]" @if($each->isRequired == 1) required @endif accept="image/png, image/jpeg, image/jpg, image/gif, image/bmp, application/pdf">
							@endisset
						</center></td>
						<td>
							{{$each->remarks}}
						</td>
						<td>
						@isset($each->evaluation) 
						@if($each->evaluation != 0)
							{!!(isset($each->filepath) ? '<a target="_blank" class="btn btn-primary text-white" href="'.asset('file/open/'.$each->filepath).'"><i class="fa fa-eye"></i></a>' : '<span class="font-weight-bold">Option Not Yet Available</span>')!!}
						@endif
							@endisset
						
							<!-- {!!(isset($each->filepath) ? '<a target="_blank" class="btn btn-primary text-white" href="'.asset('file/open/'.$each->filepath).'"><i class="fa fa-eye"></i></a>' : '<span class="font-weight-bold">Option Not Yet Available</span>')!!} -->
						</td>
					</tr>
					@endforeach
					@if(strtolower($appform->hfser_id) == 'ptc' && $office == 'hfsrb')
					<tr>
						<td>
							Three (3) sets of Site Development Plans and Architectural Floor Plans (in Blue Print 20" x 30")
							<div class="container">
								<ol>
									<li>Signed and sealed by an Architech/Engineer</li>
									<li>Showing all areas with appropriate scale (1:100m or bigger), dimension and labels</li>
									<li>Demonstrating proper spatial and functional relationships of areas (refer to Checklist for Review of Floor Plan)</li>
								</ol>
							</div>
						</td>
						<td>Please submit Floor Plan / Blue Print to HFSRB/CHD Office prior to Payment.</td>
						<td colspan='2'>
							{!!(isset($appform->isAcceptedFP) ? '<span class="text-success">RECEIVED</span>' :'<span class="text-danger">NOT YET RECEIVED</span>')!!}
							<p class="font-weight-bold pt-5">Floor plan Status:</p>
							<span class="font-weight-bold pt-5">
								
								@if($appform->isAcceptedFP == 1)
									<span class="text-success">
										Accepted 
										@if(isset($appform->FPacceptedDate))
											{{ ' on '. date("F j, Y", strtotime($appform->FPacceptedDate)).' '. date("h:i:s a", strtotime($appform->FPacceptedTime)) }}
										@endif
									</span>
								@else
									<span class="text-danger">Not Accepted</span>
								@endif
							</span>
							@if(isset($appform->fpcomment))
							<p class="font-weight-bold pt-5">With Remarks:</p>
							<span class="">{{$appform->fpcomment}}</span>
							@endif
						</td>						
					</tr>
						
					@endif
				</form>
				@else
				@php
					$currentStatus = 4;
				@endphp
				<tr>
					<td colspan="4">No requirement(s) for Upload.</td>
				</tr>
				@endif
			</tbody>
		</table>
		<!-- <div class="container mt-5 text-danger">
			{{-- <p class="text-danger">Note:</p> --}}
			<ul class = "list-unstyled">
				<li><span class="text-danger">REFERENCE AND GUIDANCE: </span><br> Incomplete Attachment shall be a ground for the denial of this application</li>
				{{-- @if(strtolower($appform->hfser_id) == 'ptc')
				<li>
					<span class="text-danger">Please submit Floor Plan / Blue Print on HFSRB Office .</span>
				</li>
				@endif --}}
				@if(strtolower($appform->hfser_id) == 'con' && $office == 'hfsrb')
				<li>
					<span class="text-danger">DOH Regional Office may require additional documents</span>
				</li>
				@endif
			</ul>
		</div> -->
		@if(strtolower($appform->hfser_id) == 'ptc' && $office == 'hfsrb')
		<!-- <div class="container mt-5">
			<ul class = "list-unstyled">
				<li><span class="text-danger">REFERENCE AND GUIDANCE:</span> For your guidance, checklist can be downloaded below</li>
			</ul>
			<div class="container table-responsive">
				<table class="table table-striped">
					<tbody>
					@isset($checklist)
						@foreach($checklist as $ck)
						<tr>
							<td>
								{{trim($ck->displayname)}}
							</td>
							<td>
								<a class="btn btn-primary text-white" target="_blank" href="{{ route('OpenFile', $ck->filename)}}"><i class="fa fa-download" aria-hidden="true"></i></a>
							</td>
						</tr>
						@endforeach
					@endisset
					</tbody>
				</table>
			</div>
		</div> -->
		@endif
		<br>

	@if(!isset($submitted) || $findups != 0)	
		@if($appform->isrecommended ==  2 || $appform->isrecommended ==  null )
			<!-- if($appform->isReadyForInspec == 0 ) -->
				<div class="container">
					<div class="float-right">
						<a href="{{asset('client1/apply')}}"><button class="btn btn-danger">Back</button></a>
						@if($canSubmit)
						<button id="submit" class="btn btn-success" @if($appform->isReadyForInspec == 0) data-toggle="modal" data-target="#confirmModal" @else form="upId" @endif>Submit Requirements</button>
						@endif
						@if(strtolower($appform->hfser_id) == 'con' && !$isReadyToInspect && $office == 'hfsrb')
							<button id="submit" class="btn btn-success hidden" style="display:none;" @if($appform->isReadyForInspec == 0) data-toggle="modal" data-target="#confirmModalCON" @else form="upIdCON" @endif>Send Request to Process Owners</button>
						@endif
					</div>
				</div>
			<!-- endif -->

		@endif
	@endif
	</div>
	<div class="modal fade" id="orderOfPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Order of Payment</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div class="row">
	      		<div class="col-md-7">
		      		<p class="mb-3 ">Status: {!!isset($appform->isPayEval) ? ($appform->isPayEval == 1 ? '<span class="text-success">Order of Payment Verified</span>' : '<span class="text-warning">Order of Payment Disapproved</span>') :'<span class="text-info">Order of Payment Unverified/Pending</span>'!!}</p>
		      	</div>
		      	@if($appform->isPayEval == 1)
			      	<div class="offset-1 col-md-4">
				      	<button class="btn btn-primary" onclick="window.location.href='{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$appform->appid}}'">
				      		<i class="fa fa-print">
				      		</i> Print
				      	</button>
			      	</div>
		      	@endif
	      	</div>
	        <table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th>Description</th>
						<th>Amount</th>
					</tr>
				</thead>
				<tbody>
			     	@foreach($orderOfPayment as $oop)
			     		<tr>
			     			<td>
			     				{{$oop->reference}}
			     			</td>
			     			<td>
			     				&#8369; {{$oop->amount}}
			     			</td>
			     		</tr>
			     	@endforeach
			    </tbody>
			</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>

	@if($appform->isReadyForInspec == 0)
	<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content" style="-webkit-box-shadow: -5px 6px 18px 0px rgba(72,71,74,0.63);-moz-box-shadow: -5px 6px 18px 0px rgba(72,71,74,0.63);box-shadow: -5px 6px 18px 0px rgba(72,71,74,0.63);">
	      <div class="modal-header">
	        <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body pt-3 pb-3 text-white" style="background-image: linear-gradient(to bottom, #228b22, #248e24, #279125, #299427, #2b9728);">
	      	<div class="row">
	      		<div class="col-md-2 text-warning" style="margin: auto; width: 50%; font-size: 50px;">
	      			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
	      		</div>
	      		<div class="col-md-10">
	      			<strong>Are you sure you want to submit this requirements?</strong><br>
	      			<br>
	      			<label class="lead">Please <strong>check and review</strong> your requirements before submitting. After successfully submitting this requirements, the process owners will check this files and will be a basis for approval/disapproval of evaluation.</label> <br>
	      			<label class="lead"><span class="text-white">Note: </span>Please wait for the evaluation result of your documents.</label>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        <button type="submit" form="upId" class="btn btn-success">Proceed</button>
	      </div>
	    </div>
	  </div>
	</div>
	@endif

	@if(strtolower($appform->hfser_id) == 'con' && !$isReadyToInspect && $office == 'hfsrb')
	<div class="modal fade" id="confirmModalCON" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content" style="-webkit-box-shadow: -5px 6px 18px 0px rgba(72,71,74,0.63);-moz-box-shadow: -5px 6px 18px 0px rgba(72,71,74,0.63);box-shadow: -5px 6px 18px 0px rgba(72,71,74,0.63);">
	      <div class="modal-header">
	        <h5 class="modal-title" id="confirmModalLabel">Confirmation</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body pt-3 pb-3 text-white" style="background-image: linear-gradient(to bottom, #228b22, #248e24, #279125, #299427, #2b9728);">
	      	<div class="row">
	      		<div class="col-md-2 text-warning" style="margin: auto; width: 50%; font-size: 50px;">
	      			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
	      		</div>
	      		<div class="col-md-10">
	      			<strong>Are you sure you want to send a request to Process Owners?</strong><br>
	      			<br>
	      			<label class="lead">Please <strong>be advised</strong> that sending this request will make process owners open your application and send you specific requirements.</label> <br>
	      			<label class="lead"><span class="text-white">Note: </span>Process owners will notify you to send requirements.</label>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
	        <button type="button" id="upIdCON" class="btn btn-success">Proceed</button>
	      </div>
	    </div>
	  </div>
	</div>
	@endif

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		$(function () {
		  	$('[data-toggle="tooltip"]').tooltip()
		});
		$(document).ready( function () {
		    $('#tApp').DataTable();
		});

		$("#upIdCON").click(function(){
			$.ajax({
				method: 'POST',
				data: {_token: '{{csrf_token()}}', action: 'trigger'},
				success: function(a){
					if(a == 'DONE'){
						alert('Successfully executed operation');
						location.reload();
					} else {
						console.log(a);
					}
				}
			})
		})

		@if($prompt == true)

		alert('Uploaded requirements are submitted.');
		

		var aptid = '{{$appform->aptid}}';
		var hfser_id = '{{$appform->hfser_id}}';

		//if(aptid == 'R' && hfser_id == 'COA'){
			if(hfser_id == 'LTO' || hfser_id == 'COA' || hfser_id == 'ATO' || hfser_id == 'COR'){
				window.location.href = "{{asset('client1/apply/app/"+hfser_id+"/')}}/{{$appform->appid}}/hfsrb"
			}else{
				window.location.href = "{{url('client1/apply')}}"
			}
		
		// if (r == true) { window.location.href = "{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$appid)}}" };
		// var r = confirm('Requirements submitted. Proceed to Payment Method?');
		// if (r == true) { window.location.href = "{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$appid)}}" };
	
		@endif
	</script>
	@include('client1.cmp.footer')
	<script>
		onStep(3);
	</script>
</body>
@endsection