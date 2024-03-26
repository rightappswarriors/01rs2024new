@extends('main')
@section('content')
@include('client1.cmp.__apply')
<body>
	@if(! isset($hideExtensions))
		@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')
		@include('client1.cmp.__wizard')
	@endif
	{{csrf_field()}}
	<div class="container-fluid mt-5 mb-5">
		<nav aria-label="breadcrumb">
		  <ol class="breadcrumb d-flex justify-content-center">
		  	<li class="breadcrumb-item active text-primary"><a href="{{asset($addresses[0])}}">Application Details</a></li>
		  	<li class="breadcrumb-item active"><a href="{{asset($addresses[1])}}">DOH Requirements</a></li>
		  	<li class="breadcrumb-item active"><a href="{{asset($addresses[2])}}">FDA Requirements</a></li>
		  	<li class="breadcrumb-item active">Submit Requirements</li>
		  </ol>
		</nav>
		<div class="row">
			<div class="col-md-4">
				<div class="accordion" id="accordionExample">
				  <div class="card">
				    <div class="card-header" id="headingThree">
				      <h5 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          Application Details
				        </button>
				      </h5>
				    </div>
				    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionExample">
				      <div class="card-body table-responsive">
				      	<table class="table table-striped">
				      		<tbody>
				      			<tr>
				      				<th style="background-color: #4682B4; color: white;">Type of Process</th>
				      				<td>{{((count($fAddress) > 0) ? (($fAddress[0]->aptid == 'IN') ? "Initial New" : "Renewal" ) : "No Type of Application")}}</td>
				      			</tr>
				      			<tr>
				      				<th style="background-color: #4682B4; color: white;">Type of Application</th>
				      				<td>{{((count($fAddress) > 0) ? $fAddress[0]->hfser_desc : "No Type of Application")}}</td>
				      			</tr>
				      			<tr>
				      				<th style="background-color: #4682B4; color: white;">Status of Application</th>
				      				<td>{{((count($fAddress) > 0) ? $fAddress[0]->trns_desc : "No Status")}}</td>
				      			</tr>
				      			<tr>
				      				<th style="background-color: #4682B4; color: white;">Name of Facility</th>
				      				<td>{{((count($fAddress) > 0) ? $fAddress[0]->facilityname : "No Facility Name")}}</td>
				      			</tr>
				      			<tr>
				      				<th style="background-color: #4682B4; color: white;">Owner</th>
				      				<td>{{((count($fAddress) > 0) ? $fAddress[0]->owner : "No Owner")}}</td>
				      			</tr>
				      			<tr>
				      				<th style="background-color: #4682B4; color: white;">Date of Application</th>
				      				<td>{{((count($fAddress) > 0) ? ($fAddress[0]->t_date ? date('M d, Y', strtotime($fAddress[0]->t_date) ): 'Requirement not yet completed')  : "No Date")}}</td>
				      				<!-- <td>{{((count($fAddress) > 0) ? date('M d, Y', strtotime($fAddress[0]->t_date)) : "No Date")}}</td> -->
				      			</tr>
				      		</tbody>
				      	</table>
				      </div>
				    </div>
				  </div>
				  <!-- div class="card">
				    <div class="card-header" id="headingOne">
				      <h5 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Details
				        </button>
				      </h5>
				    </div>

				    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
				      <div class="card-body table-responsive">

				      </div>
				    </div>
				  </div -->

				</div>
			</div>

			<div class="col-md-8" style="margin-bottom:100px;">
				<div class="float-right">
                    <button type="button" onclick="window.location.href='{{asset('client1/apply/app/'.($fAddress[0]->hfser_id ?? 'LTO').'/'.$fAddress[0]->appid."/hfsrb")}}'" class="text-white btn btn-primary mt-1"><span><i class="text-white fa fa-arrow-left"></i></span> Check DOH Requirements </button>
                </div>
				@if(intval($fAddress[0]->noofmain) > 0)
				
				<div class="container text-left mt-3 lead mb-5">
                    Requirements Status: 
                    <span>
                        @if($fAddress[0]->isrecommendedFDA === 0)
                            <span class="text-danger">Requirements Disapproved</span>
                        @elseif($fAddress[0]->isrecommendedFDA === 1)
                            <span class="text-success">Requirements Approved</span>
                        @elseif($fAddress[0]->isrecommendedFDA === 2)
                            <span class="text-warning">Requirements set for Revision</span>
                        @else
                            <span class="text-info">Pending for Evaluation</span>
                        @endif 
                    </span>
                </div>

				<center  style="padding-top: 40px;"><h3>Pharmacy</h3></center>
				
				<div class="row marginbottom-md">
					
					@if(count($fAddress) > 0)  @if($fAddress[0]->aptid == 'R')
						<div class="col-md-4" style="text-align: center;">
							<div class="col-12 mb-3">
								<div class="col-12 mb-3">
									@if(!empty($data[0][2][0]))

									<div class="modal fade" id="modal_or_pharma" tabindex="-1" role="dialog" aria-labelledby="header_or_pharma" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="header_or_pharma">{{$data[0][1]}}</h5>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" id="body_or_pharma">
												@php echo nl2br($data[0][2][0]->remarks); @endphp
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
											</div>
											</div>
										</div>
									</div>
								
										@if($data[0][2][0]->evaluation === 1)
											<i class="fa fa-check text-success"></i>
											<button class="btn" data-toggle="modal" data-target="#modal_or_pharma">Show Remarks</button>
										@elseif($data[0][2][0]->evaluation === 0)
											<i class="fa fa-times text-danger"></i>
											<button class="btn" data-toggle="modal" data-target="#modal_or_pharma">Show Remarks</button>
										@endif
									@endif
								</div>
							</div>
							<button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="window.location.href='{{asset('client1/apply/fda/CDRR/coc/'.$appid)}}'"><i class="fa fa-paperclip"></i> Official Reciept (For Renewal)</button>
						</div>
					@endif @endif

					<div class="col-md-4" style="text-align: center;">
						<div class="col-12 mb-3">
							 @if(!empty($data[2][2][0]))

							 <div class="modal fade" id="modal_personnel" tabindex="-1" role="dialog" aria-labelledby="header_personnel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="header_personnel">{{$data[2][1]}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="body_personnel">
										@php echo nl2br($data[2][2][0]->remarks); @endphp
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									</div>
								</div>
							</div>
					
                                @if($data[2][2][0]->evaluation === 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_personnel">Show Remarks</button>
                                @elseif($data[2][2][0]->evaluation === 0)
                                    <i class="fa fa-times text-danger"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_personnel">Show Remarks</button>
                                @endif
                            @endif
						</div>
						<button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="window.location.href='{{asset('client1/apply/fda/CDRR/personnel/'.$appid)}}'"><i class="fa fa-users"></i> LIST OF PERSONNEL</button>
					</div>
		
					<div class="col-md-4" style="text-align: center;">
						<div class="col-12 mb-3">
							 @if(!empty($data[6][2][0]))

							 <div class="modal fade" id="modal_other_pharma" tabindex="-1" role="dialog" aria-labelledby="header_other_pharma" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="header_other_pharma">{{$data[6][1]}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="body_other_pharma">
										@php echo nl2br($data[6][2][0]->remarks); @endphp
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									</div>
								</div>
							</div>

                                @if($data[6][2][0]->evaluation === 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_other_pharma">Show Remarks</button>
                                @elseif($data[6][2][0]->evaluation === 0)
                                    <i class="fa fa-times text-danger"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_other_pharma">Show Remarks</button>
                                @endif
                            @endif
						</div>
						<button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="window.location.href='{{asset('client1/apply/fda/CDRR/attachments/'.$appid)}}'"><i class="fa fa-paperclip"></i> Other Attachments</button>
					</div>			
				</div>
	
				@else
				<br><br>
				<center><p>No FDA Pharmacy Required for this Application.</p></center>
				@endif

				@if($hasRadio)

				<center style="margin-top: 130px; margin-bottom: 50px; "><h3>Radiology</h3></center>

				<div class="row marginbottom-md">
					
					@if(count($fAddress) > 0)  @if($fAddress[0]->aptid == 'R')
						<div class="col-md-4 mt-3" style="text-align: center;">
							<div class="col-12 mb-3">
							@if(!empty($data[1][2][0]))

							<div class="modal fade" id="modal_or_rad" tabindex="-1" role="dialog" aria-labelledby="header_or_rad" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="header_or_rad">{{$data[1][1]}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="body_or_rad">
										@php echo nl2br($data[1][2][0]->remarks); @endphp
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									</div>
								</div>
							</div>

									@if($data[1][2][0]->evaluation === 1)

										<i class="fa fa-check text-success"></i>
										<button class="btn" data-toggle="modal" data-target="#modal_or_rad">Show Remarks</button>
									@elseif($data[1][2][0]->evaluation === 0)
										<i class="fa fa-times text-danger"></i>
										<button class="btn" data-toggle="modal" data-target="#modal_or_rad">Show Remarks</button>
									@endif
								@endif
							</div>
							<button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="window.location.href='{{asset('client1/apply/fda/CDRRHR/coc/'.$appid)}}'"><i class="fa fa-paperclip"></i> COC (For Renewal)</button>
						</div>
					@endif @endif

					<div class="col-md-4 mt-3" style="text-align: center;">
						<div class="col-12 mb-3">
                            @if(!empty($data[3][2][0]))

							<div class="modal fade" id="modal_personnel_rad" tabindex="-1" role="dialog" aria-labelledby="header_personnel_rad" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="header_personnel_rad">{{$data[3][1]}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="body_personnel_rad">
										@php echo nl2br($data[3][2][0]->remarks); @endphp
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									</div>
								</div>
							</div>

                                @if($data[3][2][0]->evaluation === 1)

                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_personnel_rad">Show Remarks</button>
                                @elseif($data[3][2][0]->evaluation === 0)
                                    <i class="fa fa-times text-danger"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_personnel_rad">Show Remarks</button>
                                @endif
                            @endif
                        </div>
						<button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;"  onclick="window.location.href='{{asset('client1/apply/fda/CDRRHR/personnel/'.$appid)}}'"><i class="fa fa-users"></i> LIST OF PERSONNEL</button>
					</div>

					<div class="col-md-4 mt-3" style="text-align: center;">
						<div class="col-12 mb-3">
                            @if(!empty($data[4][2][0]))

							<div class="modal fade" id="modal_xray_rad" tabindex="-1" role="dialog" aria-labelledby="header_xray_rad" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="header_xray_rad">{{$data[4][1]}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="body_xray_rad">
										@php echo nl2br($data[4][2][0]->remarks); @endphp
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									</div>
								</div>
							</div>

                                @if($data[4][2][0]->evaluation === 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_xray_rad">Show Remarks</button>
                                @elseif($data[4][2][0]->evaluation === 0)
                                    <i class="fa fa-times text-danger"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_xray_rad">Show Remarks</button>
                                @endif
                            @endif
                        </div>
						<button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="window.location.href='{{asset('client1/apply/fda/CDRRHR/xrayservcat/'.$appid)}}'"><i class="fa fa-heartbeat"></i> X-RAY SERVICE CATEGORY</button>
					</div>
				

					<div class="col-md-4 mt-3" style="text-align: center;">
						<div class="col-12 pb-3">
                            @if(!empty($data[5][2][0]))

							<div class="modal fade" id="modal_facility_rad" tabindex="-1" role="dialog" aria-labelledby="header_facility_rad" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="header_facility_rad">{{$data[5][1]}}</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body" id="body_facility_rad">
										@php echo nl2br($data[5][2][0]->remarks); @endphp
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
									</div>
								</div>
							</div>

                                @if($data[5][2][0]->evaluation === 1)
                                    <i class="fa fa-check text-success"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_facility_rad">Show Remarks</button>
                                @elseif($data[5][2][0]->evaluation === 0)
                                    <i class="fa fa-times text-danger"></i>
                                    <button class="btn" data-toggle="modal" data-target="#modal_facility_rad">Show Remarks</button>
                                @endif
                            @endif
                        </div>
						<button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="window.location.href='{{asset('client1/apply/fda/CDRRHR/xraymachines/'.$appid)}}'"><i class="fa fa-fax"></i> LIST OF DIAGNOSTIC RADIATION FACILITY</button>
						<!-- <button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="window.location.href='{{asset('client1/apply/fda/CDRRHR/xraymachines/'.$appid)}}'"><i class="fa fa-fax"></i> LIST OF DIAGNOSTIC MACHINES</button> -->
					</div>
	
		
					 <div class="col-md-4 mt-3" style="text-align: center;">
					 	<div class="col-12 pb-3">
							</div>
						<button class="btn btn-info" style="white-space: normal; width: 100%; height: 100%;" onclick="window.location.href='{{asset('client1/apply/fda/CDRRHR/attachments/'.$appid)}}'"><i class="fa fa-paperclip"></i> Other Attachments (CDRRHR)</button>
					</div> 
					
				</div>

				@else
				<br><br>
				<center><p>No FDA Radiology Required for this Application.</p></center>
				@endif

				@if($fAddress[0]->isReadyForInspecFDA <= 0)
					<div class="d-flex justify-content-center" style="margin-top: 150px;">
						<button class="btn btn-primary p-3" onclick="submit()">Finalize and Submit</button>
					</div>
				@endif
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="header"></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

	{{-- <div class="remthis modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document" style="max-width: 1350px !important;">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="viewModalLabel">Upload</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div id="_errMsg"></div>
	      	<div class="container-fluid pb-3" id="buttonsAdd">
	      		<button class="btn btn-primary">Add</button>
	      	</div>
	      	<table class="table table-hover" id="tApp">
	      		<thead style="background-color: #428bca; color: white" id="theadapp">
	      			
	      		</thead>
	      		<tbody id="loadHere">
	      			
	      		</tbody>
	      	</table>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      	</div>
	      </div>
	    </div>
	  </div> --}}
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		
		function submit(){
			var r = confirm('Are you sure you want to save this inputs? WARNING! unedited/unlisted entries will not be accepted anymore');
			if(r){
                $.ajax({
                    method:"POST",
                    data:{_token:$("input[name=_token]").val(),readyNow:true},
                    success:function(a){
                    	if(a != ""){
                        	if(a == 'succ'){
                        		var r = confirm('Data Requirement has been submitted to FDA. Please for wait our notifications while we are processing your request. You will be redirected to DOH Requirements');
                        		// var r = confirm('Data Requirement has been submitted to FDA. Please for wait our notifications while we are processing your request. Would you like to redirect to home page for now?');
                            	// if (r == true) { window.location.href = "asset($addresses[1])" } else { location.reload() };
                            	if (r == true) { window.location.href = "{{url('client1/apply/app/LTO/')}}/{{$appid}}/hfsrb" } else { location.reload() };
                            	// if (r == true) { window.location.href = "{{url('client1/apply')}}" } else { location.reload() };

                        	} else {
                        		alert(a);
                        	}
                        }
                    }
                })
			}
		}

		function addT(title,remark){
            $("#header").empty().html(title);
            $("#body").empty().html(remark);
        }

		// var ___div = document.getElementById('__applyBread'), loadHere = document.getElementById('loadHere'), ___wizardcount = document.getElementsByClassName('wizardcount');
		// document.getElementById('stepDetails').innerHTML = 'Step 3.b: FDA Requirement';
		// if(___wizardcount != null || ___wizardcount != undefined) {
		// 	for(let i = 0; i < ___wizardcount.length; i++) {
		// 		if(i < 2) {
		// 			___wizardcount[i].parentNode.classList.add('past');
		// 		}
		// 		if(i == 2) {
		// 			___wizardcount[i].parentNode.classList.add('active');
		// 		}
		// 	}
		// }
		var curAppid = "", curPtcId = "", lData = "fda", sesslString = "", cAppid = "{{((count($fAddress) > 0) ? $fAddress[0]->appid : "0")}}";

		// if(___div != null || ___div != undefined) {
		// 	___div.classList.remove('active');
		// 	___div.classList.add('text-primary');
		// }

		{{--function loadData(title,type){
			$('#viewModalLabel').empty().append(title);
			let headToAdd = $("#theadapp");
			let loadHere = $("#loadHere");
			let add = $("#buttonsAdd");
			switch (type) {
				case 'pcdrr':
					add.empty().append(
						'<button class="btn btn-primary" data-dismiss="modal" data-toggle="modal" data-target="#addpersonnelcdrr">Add</button>'
						);
					headToAdd.empty().append(
						'<tr>'+
							'<th>Name</th>'+
							'<th>Designation/Position</th>'+
							'<th>TIN</th>'+
							'<th>Email</th>'+
							'<th>Government ID</th>'+
							'<th>Option</th>'+
						'</tr>'
						);
					loadHere.empty().append(
						@foreach($cdrrpersonnel as $personnel)
						'<tr>'+
							'<td>{{$personnel->name}}</td>'+
							'<td>{{$personnel->designation}}</td>'+
							'<td>{{$personnel->tin}}</td>'+
							'<td>{{$personnel->email}}</td>'+
							'<td>{{$personnel->governmentid}}</td>'+
							'<td>'+
								'<center>'+
									'<button class="btn btn-warning"><i class="fa fa-edit"></i></button>&nbsp;'+
									'<button class="btn btn-danger"><i class="fa fa-trash"></i></button>'+
								'</center>'+
							'</td>'+
						'</tr>'
						@endforeach
						);

					break;
				default:
					// statements_def
					break;
			}
			$('#tApp').dataTable();
		}--}}

		// function loadData(lString) {
		// 	if(lString != null || lString != "") {
		// 		sesslString = lString;
		// 		insDataFunction([['_token', 'rTbl[]', 'rId[]', 'rTbl[]', 'rId[]', 'rTbl[]', 'rId[]'], [document.getElementsByName('_token')[0].value, 'type', sesslString, 'ltotype', lData, 'app_id', cAppid]], '{{asset('client1/request/app_upload')}}', 'POST', {
		// 			functionProcess: function(arr) {
		// 				if(loadHere != null || loadHere != undefined) {
		// 					loadHere.innerHTML = "";
		// 					if(arr.length > 0) { for(let i = 0; i < arr.length; i++) {
		// 						let spl = (arr[i]['filepath']).split('/');
		// 						loadHere.innerHTML += '<tr><td>'+((spl.length > 0) ? spl[spl.length - 1] : 'No file uploaded.')+'</td></tr>';
		// 					} } else {
		// 						loadHere.innerHTML = '<tr><td colspan="1">No file(s) uploaded.</td></tr>';
		// 					}
		// 				}
		// 			}
		// 		});
		// 	}
		// }
		// function upData() {
		// 	insErrMsg('warning', 'Sending request');
		// 	insDataFunction([['_token', 'filepath', 'type', 'ltotype', 'appid'], [document.getElementsByName('_token')[0].value, document.getElementById('filepath').files[0], sesslString, lData, cAppid]], '{{asset('client1/request/customQuery/fUploads')}}', 'POST', {
		// 		functionProcess: function(arr) {
		// 			if(arr == true) {
		// 				loadData(sesslString); insErrMsg('success', 'Successfully sent request.');
		// 			} else {
		// 				loadData(sesslString); insErrMsg('danger', arr);
		// 			}
		// 		}
		// 	});
		// }
		$(function () {
		  	$('[data-toggle="tooltip"]').tooltip();
		});
	</script>
	@if(! isset($hideExtensions))
		@include('client1.cmp.footer')
		<script>
			onStep(3);
		</script>
	@endif
</body>
@endsection