@extends('main')
@section('content')
@include('client.cmp.__apply')
<body>
	@include('client.cmp.nav')
	@include('client.cmp.__msg')
	@include('client.cmp.breadcrumb')
	<script type="text/javascript">
		var ___div = document.getElementById('__applyBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
	</script>
	<div class="container-fluid mt-5 pulse animated">
		@include('client.cmp.__breadcrumb')
		@isset($hfserTbl)
		<script type="text/javascript">
			var arrBrd = ['Apply', 'Health Facility Type'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		@if(count($hfserTbl) > 0)
		{{-- 3 --}}
		@for($k = 0; $k < (ceil(count($hfserTbl)/3)); $k++)
		<div class="row"><?php $inOf = ($k*(3)); ?>
			@for($i = $inOf; $i < ((($inOf+3) > count($hfserTbl)) ? count($hfserTbl) : ($inOf+3)); $i++)
			<form method="POST" action="{{asset('/client/apply')}}">
				{{csrf_field()}}
				<input type="hidden" name="apHfd" value="{{$hfserTbl[$i]->hfser_id}}">
				<input type="hidden" name="apApt" value="{{$hfserTbl[$i]->aptid}}">
				<input type="submit" name="apBtn" value="Submit" hidden>
			</form>
			<div class="col-md-4">
				<div class="card text-white @if($hfserTbl[$i]->aptdesc != NULL) bg-success @else bg-info @endif o-hidden h-100 dashboard-leave-menu">
	             <div class="card-body">
	               <div class="card-body-icon" style="opacity: 0.4;">
	                 <i class="fa fa-fw fa-clipboard-list"></i>
	               </div>
	               <div class="text-uppercase" style="font-size: 27px;text-decoration: underline;"><strong>{{$hfserTbl[$i]->hfser_desc}}</strong></div>
	               <div class="text-uppercase small">@if($hfserTbl[$i]->aptdesc != NULL)<small>Application applied:</small> <strong>{{$hfserTbl[$i]->aptdesc}}</strong>@endif</div>
	             </div>
	             <a class="card-footer text-white clearfix small z-1" onclick="document.getElementsByName('apBtn')[{{$i}}].click();" style="cursor: pointer;">
	               <span class="float-left text-uppercase">View Details</span>
	               <span class="float-right">
	                 <i class="fa fa-angle-right"></i>
	               </span>
	             </a>
	           	</div>
	        </div>
			@endfor
		</div><hr>
		@endfor
		@endif @endisset
		@isset($aptTbl)
		<script type="text/javascript">
			var arrBrd = ['Apply', 'Health Facility Type', 'Application Type'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		<div class="row">
			<div class="col-md-6">
				<h2>Select Application Type</h2>
				<h6><small>Facility Type:</small> <strong>{{$aHTbl[0]->hfser_desc}}</strong>@if($aHTbl[0]->aptdesc != NULL) <br><small>Last Application applied:</small> <strong>{{$aHTbl[0]->aptdesc}}</strong>@endif</h6>
			</div>
			<div class="col-md-6">
				<?php $_lbc = ""; $_lmc = ""; if(count($pDApf) > 0) { $_lbc = "badge-info"; $_lmc = count($pDApf)." personnel(s) added."; } else { $_lbc = "badge-warning"; $_lmc = "No personnel added."; } ?>
				<div style="float: right;">
					<label class="badge {{$_lbc}}">{{$_lmc}}</label><br>
					{{-- <form method="POST" action="{{asset('/client/apply')}}"> {{csrf_field()}}
						<input type="hidden" name="fPsnft" value="Personnel">
						<button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add Personnel</button>
					</form> --}}
				</div>
			</div>
		</div>
		<hr>
		@foreach($aptTbl AS $aptRow) <?php $_btn = ""; $_fa = ""; if(!isset($aptRow->_disabled)): $_btn = "btn-light"; $_fa = "fa-exclamation-circle"; else: $_btn = "btn-light"; $_fa = "fa-check-circle"; endif; ?>
		<?php $_bc = ""; $_fc = ""; $mc = ""; if(isset($aptRow->apt_reqAst)) { if($aptRow->apt_reqAst == 1) {  $_fc = "fa-exclamation-circle"; if($aptRow->ap_count >= count($tlAsmtTbl)) { $_bc = "badge-success"; } else { $_bc = "badge-dark"; } $mc = "Assessment required!"; } else { $_bc = "badge-light"; $_fc = "fa-check-circle"; $mc = "Assessment not required!"; } } else { $_bc = "badge-success"; $_fc = "fa-times-circle"; $mc = "Assessment not required!"; } ?>
		@if(isset($aptRow->_disabled)) <form id="{{$aptRow->_disabled}}" method="POST" action="{{asset('/client/apply')}}">
			{{csrf_field()}}
			<input type="hidden" name="apFApt" value="{{$aptRow->aptid}}">
		</form> @endif
		<div class="row">
			<div class="@if($_bc == 'badge-success' && count($tlAsmtTbl) > 0) col-sm-9 @else col-sm-12 @endif">
				<button @if(isset($aptRow->_disabled)) form="{{$aptRow->_disabled}}" @endif class="btn btn-block {{$_btn}}"><span style="float: left;"><i class="fa {{$_fa}}"></i> {{$aptRow->aptdesc}}</span>
				<label class="badge {{$_bc}}" style="float: right;"><i class="fa {{$_fc}}"></i> {{$mc}} @if(isset($aptRow->ap_count))<span>({{$aptRow->ap_count}}/{{count($tlAsmtTbl)}})</span>@endif</label>
				</button>
			</div>
			@if($_bc == 'badge-success' && count($tlAsmtTbl) > 0)
			<form id="{{$aptRow->_disabled}}_asmt" method="POST" action="{{asset('/client/apply')}}">
				{{csrf_field()}}
				<input type="hidden" name="asmtApt" value="{{$aptRow->aptid}}">
			</form>
			<div class="col-sm-3">
				<button class="btn btn-light btn-block" style="float: right;" form="{{$aptRow->_disabled}}_asmt"><i class="fa fa-question-circle"></i> View Assessment</button>
			</div>
			@endif
		</div>
		<hr>
		@endforeach @endisset
		@isset($apFTbl) @if($apFTbl != NULL)
		<script type="text/javascript">
			var arrBrd = ['Apply', 'Health Facility Type', 'Application Type', 'Application Form'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		<div class="row">
			<div class="col-md-9">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-3 hide-div">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 60px; padding-left: 20px;">
							</div>
							<div class="col-md-6">
								<h5 class="card-title text-uppercase text-center">Application Form</h5>
								<h6 class="card-subtitle mb-2 text-center text-muted">{{$apFTbl[1]->hfser_desc}} ({{$apFTbl[0]->aptdesc}})</h6>
							</div>
							<div class="col-md-3 hide-div">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 60px; padding-right: 20px;">
							</div>
						</div>
					</div>
					<div class="card-body">
						@isset($subUser) @if(count($subUser) > 0)
						<form id="afpForm" method="post" enctype="multipart/form-data" action="{{asset('/client/apply')}}">
							{{csrf_field()}}
							<div class="custom-control custom-checkbox">
							  	<input type="checkbox" class="custom-control-input" id="customCheck1">
							  	<label class="custom-control-label" for="customCheck1">Applicant is the same as the owner</label>
							</div>
							<input type="hidden" name="drafts" value>
							@isset($upApfTbl) @if(count($upApfTbl) > 0) <input type="hidden" name="curApid" value="{{$upApfTbl[0]->appid}}"> @endif @endisset

							<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
								<div class="col-md-9">
									<p>Facility Name: <br>
										{{-- <strong>{{$curUser->facilityname}}</strong> --}}
										<input type="text" list="__facilityName" class="form-control" name="facilityname_s" required autocomplete="off">
									</p>
								</div>
								<div class="col-md-3">
									<p>Institutional Character: <br>
										{{-- <strong>{{$curUser->facilityname}}</strong> --}}
										<select class="form-control" name="facMode">
											<option value>None</option>
										</select>
									</p>							
								</div>
							</div>
							<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
								<div class="col-md-12">
									<p>Facility Type: </p>
										{{-- <strong>{{$subUser[0]->hgpdesc}}</strong> --}}
									<select name="facilitytype_s" class="form-control" autocomplete="off" hidden>
										<option value>None</option>
									</select>
									<div name="facilitytype_s1"></div>
								</div>
							</div>
							<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
								<div class="col-md-12">
									<p>Service Capabilites: </p>
										{{-- <strong>{{$subUser[0]->hgpdesc}}</strong> --}}
									<select name="servicecapabilities_s" class="form-control" autocomplete="off" hidden>
										<option value>None</option>
									</select>
									<div name="servicecapabilities_s1"></div>
									<input type="hidden" name="cheatServiceCapabilitites" value required>
								</div>
							</div>
							@if($apFTbl[1]->hfser_id == "PTC")
							<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
								<div class="col-md-12">
									<p>Type of Construction: </p>
									<div class="row" name="ptc">
										<div class="col">
											<label for="forNew">New
												<input type="radio" name="type" id="forNew" value="0" onchange="__removeHidden('forConstruction', 0);">
											</label>
										</div>
										<div class="col">
											<label for="forNew1">Expansion/Renovation/Alteration
												<input type="radio" name="type" id="forNew1" value="1" onchange="__removeHidden('forConstruction', 1);">
											</label>
										</div>
									</div>
									<div class="row">
										<div class="col">
											<div class="forConstruction" hidden>
												<p>New Construction</p>
												<div class="row">
													<div class="col">
														<label>Proposed Bed Capacity
															<input type="text" name="propbedcap" class="form-control">
														</label>
													</div>
													<div class="col">
														<label>Proposed Dialysis Station
															<input type="text" name="propstation" class="form-control">
														</label>
													</div>
												</div>
											</div>
										</div>
										<div class="col">
											<div class="forConstruction" hidden>
												<p>Expansion Construction</p>
												<div class="row">
													<div class="col">
														<label>Increase Bed Capacity From
															<input type="text" name="incbedcapfrom" class="form-control">
														</label>
														<label>Increase Bed Capacity To
															<input type="text" name="incbedcapto" class="form-control">
														</label>
													</div>
												</div>
												<div class="row">
													<div class="col">
														<label>Increase Dialysis Station From
															<input type="text" name="incstationfrom" class="form-control">
														</label>
														<label>Increase Dialysis Station To	
															<input type="text" name="incstationto" class="form-control">
														</label>
													</div>
												</div>
											</div>
											<label>Construction Details
												<textarea name="construction_description" class="form-control"></textarea>
											</label>
										</div>
									</div>
								</div>
							</div>
							@endif
							<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
								<div class="col-md-4">
									<p>Owner:
									<br>
										{{-- <strong>{{$curUser->authorizedsignature}}</strong> --}}
										<input type="text" class="form-control" name="owner_s" required autocomplete="off">
									</p>
								</div>
								<div class="col-md-4">
									<p>Email Address: <br>
										{{-- <strong>{{$curUser->email}}</strong> --}}
										<input type="text" class="form-control" name="email_s" required autocomplete="off">
									</p>
								</div>
								<div class="col-md-2">
									<p>Contact Number: <br>
										{{-- <strong>{{$curUser->contact}}</strong> --}}
										<input type="number" class="form-control" name="contact_s" required autocomplete="off">
									</p>
								</div>
								<div class="col-md-2">
									<p>Bed Capacity: <br>
										{{-- <strong>{{$curUser->bed_capacity}}</strong> --}}
										<input type="number" class="form-control" name="bed_s" required autocomplete="off">
									</p>
								</div>
							</div>
							<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
								<div class="col-md-3">
									<p>Region: <br>
										{{-- <strong>{{$subUser[0]->rgn_desc}}</strong> --}}
										<select class="form-control" name="region_s" required autocomplete="off">
											<option value>None</option>
										</select>
									</p>
								</div>
								<div class="col-md-3">
									<p>Province: <br>
										{{-- <strong>{{$subUser[0]->provname}}</strong> --}}
										<select class="form-control" name="province_s" required autocomplete="off">
											<option value>None</option>
										</select>
									</p>
								</div>
								<div class="col-md-3">
									<p>City/Municipality: <br>
										{{-- <strong>{{$subUser[0]->cmname}}</strong> --}}
										<select class="form-control" name="city_s" required autocomplete="off">
											<option value>None</option>
										</select>
									</p>
								</div>
								<div class="col-md-3">
									<p>Barangay: <br>
										{{-- <strong>{{$subUser[0]->brgyname}}</strong> --}}
										<select class="form-control" name="barangay_s" required autocomplete="off">
											<option value>None</option>
										</select>
									</p>
								</div>
							</div>
							<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
								<div class="col-md-4">
									<p>Ownership: <i class="fa fa-sync" style="cursor: pointer;" onclick="__chCl()"></i> <br><select name="owTbl_s" class="form-control" onchange="__chCl(this.value)" autocomplete="off">
										<option hidden selected disabled value>Select Ownership</option>
									</select><input type="text" class="form-control" name="owTbl"></p>
								</div>
								<div class="col-md-3">
									<p>Class: <i class="fa fa-sync" style="cursor: pointer;" onclick="__chCl(document.getElementsByName('owTbl_s')[0].value)"></i> <br><select name="clTbl_s" class="form-control" onchange="__chCl(document.getElementsByName('owTbl_s')[0].value, this.value)" autocomplete="off">
										<option hidden selected disabled value>Select Class</option>
									</select><input type="text" class="form-control" name="clTbl"></p>
								</div>
								<div class="col-md-3">
									<p>Sub-class: <i class="fa fa-sync" style="cursor: pointer;" onclick="__chCl(document.getElementsByName('owTbl_s')[0].value)"></i> <br>
										<select name="subClTbl_s" class="form-control">
											<option hidden selected disabled value>Select Sub-class</option>
										</select><input type="text" class="form-control" name="subClTbl">
									</p>
								</div>
								<div class="col-md-2">
									<p>Function:<select name="funcId" class="form-control" autocomplete="off">
										<option hidden selected disabled value>Select Function</option>
									</select></p>
								</div>
							</div>

							<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
								<div class="col-md-2" style="padding: 5px; text-align: center;">
									<button type="button" data-toggle="modal" data-target="#personnelModal" class="btn btn-success" style="white-space: normal; width: 100%; height: 100%;">List of Personnel</button>
								</div>
								<div class="col-md-2" style="padding: 5px; text-align: center;">
									<button type="button" class="btn btn-success" style="white-space: normal; width: 100%; height: 100%;">List of Equipment</button>
								</div>
								<div class="col-md-2" style="padding: 5px; text-align: center;">
									<button type="button" class="btn btn-success" style="white-space: normal; width: 100%; height: 100%;">List of Equipment, Reagent, Laboratory, Ware and Materials For Specific Test</button>
								</div>
								<div class="col-md-2" style="padding: 5px; text-align: center;">
									<button type="button" class="btn btn-success" style="white-space: normal; width: 100%; height: 100%;">List of Products</button>
								</div>
								<div class="col-md-2" style="padding: 5px; text-align: center;">
									<button type="button" class="btn btn-success" style="white-space: normal; width: 100%; height: 100%;">List of Personnel for Diagnostic Radiology and Radiation Services</button>
								</div>
								<div class="col-md-2" style="padding: 5px; text-align: center;">
									<button type="button" class="btn btn-success" style="white-space: normal; width: 100%; height: 100%;">List of Equipment, Laboratory Ware and Materials</button>
								</div>
							</div>
							<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
								<div class="col-md-12 table-responsive" style="padding: 20px;">
									<table class="table">
										<thead>
											<tr>
												<th style="width: 60%;">Description</th>
												<th style="width: 40%;">File(s)</th>
											</tr>
										</thead>
										<tbody id="tBodyRequirement">
											@if(count($apUpApfTbl) > 0) @foreach($apUpApfTbl AS $apUpApfRow)
											<tr>
												<td>
													{{$apUpApfRow->updesc}}
												</td>
												<td>
													@isset($apUpApfRow->filepath) @if($apUpApfRow->evaluation != NULL) @if($apUpApfRow->evaluation == 1)
													<i class="fa fa-check-circle"> Approved</i>
													@else
													<i class="fa fa-times-circle"> Approved</i>
													@endif
													@else
													<i class="fa fa-spinner"> Pending</i>
													@endif
													@else
													<input type="file" class="form-control" name="upid[{{$apUpApfRow->upid}}]" @if(isset($apUpApfRow->isrequired)) @if($apUpApfRow->isrequired == 1) required autocomplete="off" @endif @endif>
													@endisset
												</td>
											</tr>
											@endforeach @else
											<tr><td colspan="2">No requirements to upload</td></tr>
											@endif
										</tbody>
									</table>
								</div>
							</div>
							<input type="hidden" name="__upDraft" value="new">
						</form>
						<datalist id="__facilityName" name="__facilityName">
							<option value="asdf" id="asdfff" class=" asdfq">qwe</option>
							<option value="asdfqwe" id="asdfffasdf">qwzxcve</option>
						</datalist>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
						</div>
						<!-- Modal -->
						<div class="modal fade" id="personnelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog" role="document">
						    <div class="modal-content">
						      <div class="modal-header">
						        <h5 class="modal-title" id="exampleModalLabel">Personnel</h5>
						        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
						          <span aria-hidden="true">&times;</span>
						        </button>
						      </div>
						      <div class="modal-body">
						      	<div class="perRecord table-responsive">
							        <table class="table table-bordered">
							        	<thead class="thead-dark">
							        		<tr>
							        			<th>Name</th>
							        			<th>Gender</th>
							        			<th>Position</th>
							        			<th>Section</th>
							        			<th>Department</th>
							        		</tr>
							        	</thead>
							        	<tbody id="personnelBody">
							        		<tr><td colspan="5">No personnel</td></tr>
							        	</tbody>
							        </table>
							    </div>
						        <div class="perRecord" hidden>
									<div class="perAdd">
										<h5>Profile</h5>
										<div>
											<div class="form-row">
												<div class="form-group col-sm-4">
													<input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname">
												</div>
												<div class="form-group col-sm-4">
													<input type="text" class="form-control" placeholder="Middle Name" name="middlename" id="middlename">
												</div>
												<div class="form-group col-sm-4">
													<input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname">
												</div>
												<div class="form-group col-sm-6">
													<label for="bod">Birth Date</label>
													<input type="date" class="form-control" placeholder="Birth Date" name="bod" id="bod" value="{{date('Y-m-d')}}">
												</div>
												<div class="form-group col-sm-6">
													<label for="gender">Gender</label>
													<select id="gender" name="gender" class="form-control">
														<option disabled hidden value selected>Gender</option>
														<option value="Male">Male</option>
														<option value="Female">Female</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="perAdd">
										<h5>Work</h5>
										<div>
											<div class="form-row">
												<div class="form-group col-sm-4">
													<label for="position">Position</label>
													{{-- <input type="text" class="form-control" placeholder="Position" name="position" id="position" value> --}}
													<select id="position" name="position" class="form-control">
														<option disabled hidden value selected>Position</option>
													</select>
												</div>
												<div class="form-group col-sm-4">
													<label for="section">Section</label>
													{{-- <input type="text" class="form-control" placeholder="Section" name="section" id="section" value> --}}
													<select id="section" name="section" class="form-control">
														<option disabled hidden value selected>Section</option>
													</select>
												</div>
												<div class="form-group col-sm-4">
													<label for="department">Department</label>
													{{-- <input type="text" class="form-control" placeholder="Department" name="department" id="department" value> --}}
													<select id="department" name="department" class="form-control">
														<option disabled hidden value selected>Department</option>
													</select>
												</div>
												<div class="form-group col-sm-6">
													<label for="assigndate">Assigned Date</label>
													<input type="date" class="form-control" placeholder="Assigned Date" name="assigndate" id="assigndate" value="{{date('Y-m-d')}}">
												</div>
												<div class="form-group col-sm-6">
													<label for="enddate">End Date</label>
													<input type="date" class="form-control" placeholder="End Date" name="enddate" id="enddate" value="{{date('Y-m-d')}}">
												</div>
											</div>
										</div>
									</div>
									<div class="perAdd">
										<h5>Eligibility</h5>
										<div>
											<div class="form-row">
												<div class="form-group col-sm-6">
													<button type="button" class="btn btn-success" style="float: right;" onclick="__addClone(['plicensetype', 'expiration'], ['licensetypeCom', 'expirationCom'])">Add Others</button>
												</div>
												<div class="form-group col-sm-6">
													<button type="button" class="btn btn-danger" style="float: left;" onclick="__removeClone(['licensetypeCom', 'expirationCom'])">Reset</button>
												</div>
												<div class="form-group col-sm-6">
													<label for="plicensetype">License Type</label>
													<select id="plicensetype" name="plicensetype[]" class="form-control">
														<option disabled hidden value selected>License Type</option>
													</select>
													<div id="licensetypeCom">
													</div>
												</div>
												<div class="form-group col-sm-6">
													<label for="expiration">Licensed ID Expiration Date</label>
													<input type="date" class="form-control" placeholder="End Date" name="expiration[]" id="expiration" value="{{date('Y-m-d')}}">
													<div id="expirationCom">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="perAdd">
										<h5>Trainings</h5>
										<div>
											<div class="form-row">
												<div class="form-group col-sm-6">
													<button type="button" class="btn btn-success" style="float: right;" onclick="__addClone('trainingsClone', 'placeTraningsClone')">Add Others</button>
												</div>
												<div class="form-group col-sm-6">
													<button type="button" class="btn btn-danger" style="float: left;" onclick="__removeClone('placeTraningsClone')">Reset</button>
												</div>
												<div id="trainingsClone" class="form-row" style="border: 1px solid;">
													<div class="form-group col-sm-12">
														<label for="ptrainings_trainingtype">Trainings</label>
														<select id="ptrainings_trainingtype" name="ptrainings_trainingtype[]" class="form-control">
															<option disabled hidden value selected>Trainings</option>
														</select>
													</div>
													<div class="form-group col-sm-6">
														<label for="school">School</label>
														<input type="text" class="form-control" placeholder="School" name="school[]" id="school">
													</div>
													<div class="form-group col-sm-6">
														<label for="course">Course</label>
														<input type="text" class="form-control" placeholder="Course" name="course[]" id="course">
													</div>
													<div class="form-group col-sm-6">
														<label for="datestart">Date Started</label>
														<input type="date" class="form-control" placeholder="Date Started" name="datestart[]" id="datestart" value="{{date('Y-m-d')}}">
													</div>
													<div class="form-group col-sm-6">
														<label for="datefinish">Date Finished</label>
														<input type="date" class="form-control" placeholder="Date Finished" name="datefinish[]" id="datefinish" value="{{date('Y-m-d')}}">
													</div>
													<br>
												</div>
												<div id="placeTraningsClone">
												</div>
											</div>
										</div>
									</div>
									<hr>
									<button class="btn btn-light" style="float: left" onclick="chooseRecord('perAdd', -1);">Previous</button>
									<button class="btn btn-light" id="btnnext" style="float: right" onclick="chooseRecord('perAdd', 1);">Next</button>
									<button class="btn btn-light" id="btnsubmit" style="float: right" hidden>Submit</button>
						        </div>
						      </div>
						      <div class="modal-footer">
						      	<div style="float: left;">
							        <button type="button" class="btn btn-primary" onclick="chooseRecord('perRecord', 0)">Record</button>
							        <button type="button" class="btn btn-primary" onclick="chooseRecord('perRecord', 1)">Add Personnel</button>
						      	</div>
						        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						      </div>
						    </div>
						  </div>
						</div>

						<script type="text/javascript">
						var perAddCount = 0;
						@isset($clTbl)
						clArr = JSON.parse(("{{json_encode($clTbl)}}").replace(/&quot;/g,'"'));
						@endisset
						@isset($owTbl)
						owArr = JSON.parse(("{{json_encode($owTbl)}}").replace(/&quot;/g,'"'));
						@endisset
						@isset($funcTbl)
						fnArr = JSON.parse(("{{json_encode($funcTbl)}}").replace(/&quot;/g,'"'));
						@endisset
						@isset($subClTbl)
						subArr = JSON.parse(("{{json_encode($subClTbl)}}").replace(/&quot;/g,'"'));
						@endisset
						chooseRecord('perAdd', 0);
						function chooseRecord(clName, inOf) {
							let curDom = document.getElementsByClassName(clName);
							if(curDom.length > 0) {
								for(var i = 0; i < curDom.length; i++) {
									curDom[i].setAttribute('hidden', true);
								}
								if(clName == 'perAdd') {
									if((perAddCount + inOf) > (curDom.length - 2)) {
										document.getElementById('btnnext').setAttribute('hidden', true);
										document.getElementById('btnsubmit').removeAttribute('hidden');
									} else {
										document.getElementById('btnsubmit').setAttribute('hidden', true);
										document.getElementById('btnnext').removeAttribute('hidden');
									}
									perAddCount = (((perAddCount + inOf) > (curDom.length - 1)) ? (curDom.length - 1) : (((perAddCount + inOf) < 0) ? 0 : (perAddCount + inOf)));
									inOf = perAddCount;
								}
								curDom[inOf].removeAttribute('hidden');
							}
						}
						(function(){
							var _appId = null, __aptid = "{{$apFTbl[0]->aptid}}", __hfser_id = "{{$apFTbl[1]->hfser_id}}";
							@isset($upApfTbl[0]->appid)
							_appId = "{{$upApfTbl[0]->appid}}";
							@endisset
							@if($apFTbl[1]->hfser_id == "PTC")
							sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "appid="+_appId], "{{asset('/client/request/customQuery/getPtc')}}", 'POST', true, {
								functionProcess: function(arr) {
									var arrLoad = ['propbedcap', 'propstation', 'incbedcapfrom', 'incbedcapto', 'incstationfrom', 'incstationto', 'construction_description'];
									if(arr.length > 0) {
										for(var i = 0; i < arrLoad.length; i++) {
											document.getElementsByName(arrLoad[i])[0].value = arr[0][arrLoad[i]];	
										}
										document.getElementsByName('type')[arr[0]["type"]].checked = true;
										__removeHidden('forConstruction', parseInt(arr[0]["type"]));
									}
								}
							});
							@endif
							sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "hfser_id="+__hfser_id], "{{asset('/client/request/customQuery/getPersonnelRecord')}}", 'POST', true, {
								functionProcess: function(arr) {
									personnelProceed(arr);
								}
							});
							function personnelProceed(arr) {
								let curDom = document.getElementById('personnelBody');
								if(curDom != null || curDom != undefined) {
									curDom.innerHTML = '';
									if(arr.length > 0) {
										arr.forEach(function(a, b, c) {
											curDom.innerHTML += '<tr><td>'+a['firstname']+' '+a['middlename']+' '+a['lastname']+'</td> <td>'+a['gender']+'</td> <td>'+a['posname']+'</td> <td>'+a['secname']+'</td> <td>'+a['depname']+'</td></tr>';
										});
									} else {
										curDom.innerHTML = '<tr><td colspan="5">No personnel</td></tr>';
									}
								}
							}
							sendRequestRetArr([], "{{asset('/client/request/customQuery/getPersonnelReq')}}", 'GET', true, {
								functionProcess: function(arr) {
									let arrCol = ['position', 'section', 'department', 'plicensetype', 'ptrainings_trainingtype'];
									let arrColGo = [['posid', 'posname'], ['secid', 'secname'], ['depid', 'depname'], ['plid', 'pldesc'], ['tt_id', 'ptdesc']];
									for(let i = 0; i < arrCol.length; i++) {
										let curDom = document.getElementById(arrCol[i]);
										if(curDom != undefined || curDom != null) {
											curDom.innerHTML = '<option disabled hidden value selected>Select</option>';
											arr[arrCol[i]].forEach(function(a, b, c) {
												curDom.innerHTML += '<option value="'+a[arrColGo[i][0]]+'">'+a[arrColGo[i][1]]+'</option>';
											});
										}
									}
								}
							});
							retNameReqCheckBox([["_token="+document.getElementsByName('_token')[0].value, "appid="+_appId, "hfser_id="+__hfser_id], "{{asset('/client/request/customQuery/getFacilityNow')}}", "POST", true], "facilitytype_s1", _appId, __hfser_id);
							retNameReqSelect([[], "{{asset('/client/request/region')}}", "GET", true], "region_s");
							retNameReqSelect([[], "{{asset('/client/request/facmode')}}", "GET", true], "facMode");
							document.getElementById('btnsubmit').addEventListener('click', function(e) {
								let arrSend = ["_token="+document.getElementsByName('_token')[0].value, 'firstname='+document.getElementsByName('firstname')[0].value, 'middlename='+document.getElementsByName('middlename')[0].value, 'lastname='+document.getElementsByName('lastname')[0].value, 'bod='+document.getElementsByName('bod')[0].value, 'gender='+document.getElementsByName('gender')[0].value, 'position='+document.getElementsByName('position')[0].value, 'section='+document.getElementsByName('section')[0].value, 'department='+document.getElementsByName('department')[0].value, 'assigndate='+document.getElementsByName('assigndate')[0].value, 'enddate='+document.getElementsByName('enddate')[0].value];
								for(let i = 0; i < document.getElementsByName('plicensetype[]').length; i++) {
									arrSend.push("plicensetype[]="+document.getElementsByName('plicensetype[]')[i].value);
									arrSend.push("expiration[]="+document.getElementsByName('expiration[]')[i].value);
								}
								for(let i = 0; i < document.getElementsByName('ptrainings_trainingtype[]').length; i++) {
									arrSend.push("ptrainings_trainingtype[]="+document.getElementsByName('ptrainings_trainingtype[]')[i].value);
									arrSend.push("school[]="+document.getElementsByName('school[]')[i].value);
									arrSend.push("course[]="+document.getElementsByName('course[]')[i].value);
									arrSend.push("datestart[]="+document.getElementsByName('datestart[]')[i].value);
									arrSend.push("datefinish[]="+document.getElementsByName('datefinish[]')[i].value);
								}
								arrSend.push("submitPersonnel=submit"); arrSend.push("hfser_id="+__hfser_id);
								sendRequestRetArr(arrSend, "{{asset('/client/request/customQuery/savePersonnel')}}", 'POST', true, {
									functionProcess: function(arr) {
										chooseRecord('perRecord', 0);
										personnelProceed(arr);
									}
								});
							});
							document.getElementsByName('facilitytype_s1')[0].addEventListener('click', function(e) {
								if(e.target.type == "checkbox" || (e.target == this)) {
									let _arrSend = ["_token="+document.getElementsByName('_token')[0].value, "rTbl=hgpid", "rFunc=in"], _arrForRequirements = ["_token="+document.getElementsByName('_token')[0].value, "appid="+_appId, "aptid="+__aptid, "hfser_id="+__hfser_id], _newName = ((e.target.name == undefined || e.target.name == null) ? 'facilitytype_s1[]' : e.target.name);
									for(var i = 0; i < document.getElementsByName(_newName).length; i++) {
										if(document.getElementsByName(_newName)[i].checked) {
											_arrSend.push("rId[]="+document.getElementsByName(_newName)[i].value);
											_arrForRequirements.push("facid[]="+document.getElementsByName(_newName)[i].value);
										}
									}
									if(_arrSend.length > 3) {
										retNameReqCheckBox([_arrSend, "{{asset('/client/request/facilitytyp')}}", "POST", true], "servicecapabilities_s1", _appId);
										retNameRequirements([_arrForRequirements, "{{asset('/client/request/customQuery/getRequirements')}}", "POST", true], '');
									} else {
										document.getElementsByName('servicecapabilities_s1')[0].innerHTML = '';
									}
								}
							});
							document.getElementsByName('servicecapabilities_s1')[0].addEventListener('click', function(e) {
								if(e.target.type == "checkbox" || (e.target == this)) {
									let _arrSend = ["_token="+document.getElementsByName('_token')[0].value], _newName = ((e.target.name == undefined || e.target.name == null) ? 'servicecapabilities_s1[]' : e.target.name);
									for(var i = 0; i < document.getElementsByName(_newName).length; i++) {
										if(document.getElementsByName(_newName)[i].checked) {
											_arrSend.push("facid[]="+document.getElementsByName(_newName)[i].value);
										}
									}
									sendRequestRetArr(_arrSend, "{{asset('/client/request/customQuery/getServiceCharge')}}", 'POST', true, {
										functionProcess: function(arr) {
											let paymentBody = document.getElementById('paymentBody'), paymentTotal = document.getElementById('paymentTotal');
											if(paymentBody != null || paymentBody != undefined) {
												paymentBody.innerHTML = '';
												paymentBody.classList.add('loading');
												if(arr.length > 0) {
													var __total = 0.00;
													arr.forEach(function(a, b ,c) {
														__total = parseFloat(__total) + parseFloat(a['amt']);
														paymentBody.innerHTML += '<tr><td>'+a['facname']+'</td><td>&#8369;&nbsp;'+parseFloat(a['amt']).toFixed(2)+'</td></tr>';
													});
													if(paymentTotal != null || paymentTotal != undefined) {
														paymentTotal.innerHTML = __total.toFixed(2);
													}
												} else {
													paymentBody.innerHTML = '<tr><td colspan="2">No payment</td></tr>';
													paymentTotal.innerHTML = '0.00';
												}
												paymentBody.classList.remove('loading');
											}
										}
									});
								}
							});
							function proceedPayment(arr) {
								console.log(arr);
							}
							document.getElementsByName('region_s')[0].addEventListener('change', function() {
								if(document.getElementsByName('region_s')[0].value != "") {
									retNameReqSelect([["_token="+document.getElementsByName('_token')[0].value, "rTbl=rgnid", "rId="+document.getElementsByName('region_s')[0].value], "{{asset('/client/request/province')}}", "POST", true], "province_s");
								}
								document.getElementsByName('province_s')[0].innerHTML = '<option value>None</option>';
								document.getElementsByName('city_s')[0].innerHTML = '<option value>None</option>';
								document.getElementsByName('barangay_s')[0].innerHTML = '<option value>None</option>';
							});
							document.getElementsByName('province_s')[0].addEventListener('change', function() {
								if(document.getElementsByName('province_s')[0].value != "") {
									retNameReqSelect([["_token="+document.getElementsByName('_token')[0].value, "rTbl=provid", "rId="+document.getElementsByName('province_s')[0].value], "{{asset('/client/request/city_muni')}}", "POST", true], "city_s");
								}
								document.getElementsByName('city_s')[0].innerHTML = '<option value>None</option>';
								document.getElementsByName('barangay_s')[0].innerHTML = '<option value>None</option>';
							});
							document.getElementsByName('city_s')[0].addEventListener('change', function() {
								if(document.getElementsByName('city_s')[0].value != "") {
									retNameReqSelect([["_token="+document.getElementsByName('_token')[0].value, "rTbl=cmid", "rId="+document.getElementsByName('city_s')[0].value], "{{asset('/client/request/barangay')}}", "POST", true], "barangay_s");
								}
								document.getElementsByName('barangay_s')[0].innerHTML = '<option value>None</option>';
							});
							document.getElementById('customCheck1').addEventListener('change', function() {
								var region_s = document.getElementsByName('region_s')[0], province_s = document.getElementsByName('province_s')[0], city_s = document.getElementsByName('city_s')[0], barangay_s = document.getElementsByName('barangay_s')[0];
								var _forLoop, _forProv, _forCity, _forBarangay;
								clearInterval(_forLoop); clearInterval(_forProv); clearInterval(_forCity); clearInterval(_forBarangay);
								if(this.checked == true) {
									document.getElementsByName('owner_s')[0].value = "{{$curUser->authorizedsignature}}";
									document.getElementsByName('email_s')[0].value = "{{$curUser->email}}";
									document.getElementsByName('contact_s')[0].value = "{{$curUser->contact}}";
									document.getElementsByName('bed_s')[0].value = ((document.getElementsByName('bed_s')[0].value != "") ? document.getElementsByName('bed_s')[0].value : "{{((isset($upApfTbl[0]->noofbed)) ? $upApfTbl[0]->noofbed : "")}}");
									document.getElementsByName('facMode')[0].value = ((document.getElementsByName('facMode')[0].value != "") ? document.getElementsByName('facMode')[0].value : "{{((isset($upApfTbl[0]->facmode)) ? $upApfTbl[0]->facmode : "")}}");
									document.getElementsByName('facilityname_s')[0].value = ((document.getElementsByName('facMode')[0].value != "") ? document.getElementsByName('facilityname_s')[0].value : "{{((isset($upApfTbl[0]->facilityname)) ? $upApfTbl[0]->facilityname : "")}}");

									_forLoop = setInterval(function() {
										if(region_s.length > 1) {
											clearInterval(_forLoop);
											region_s.value = "{{$subUser[0]->rgnid}}";
											event.initEvent('change', false, true);
											region_s.dispatchEvent(event);
											_forProv = setInterval(function() {
												if(_hasTask < 1) {
													if(province_s.length > 1) {
														clearInterval(_forProv);
														province_s.value = "{{$subUser[0]->provid}}";
														event.initEvent('change', false, true);
														province_s.dispatchEvent(event);
													}
												}
											}, -1);
											_forCity = setInterval(function() {
												if(_hasTask < 1) {
													if(city_s.length > 1) {
														clearInterval(_forCity);
														city_s.value = "{{$subUser[0]->cmid}}";
														event.initEvent('change', false, true);
														city_s.dispatchEvent(event);
													}
												}
											}, -1);
											_forBarangay = setInterval(function() {
												if(_hasTask < 1) {
													if(barangay_s.length > 1) {
														clearInterval(_forBarangay);
														barangay_s.value = "{{$subUser[0]->brgyid}}";
													}
												}
											}, -1);
										}
									}, -1);
								} else {
									document.getElementsByName('owner_s')[0].value = "{{((isset($upApfTbl[0]->owner)) ? $upApfTbl[0]->owner : "")}}";
									document.getElementsByName('email_s')[0].value = "{{((isset($upApfTbl[0]->email)) ? $upApfTbl[0]->email : "")}}";
									document.getElementsByName('contact_s')[0].value = "{{((isset($upApfTbl[0]->contact)) ? $upApfTbl[0]->contact : "")}}";
									document.getElementsByName('bed_s')[0].value = ((document.getElementsByName('bed_s')[0].value != "") ? document.getElementsByName('bed_s')[0].value : "{{((isset($upApfTbl[0]->noofbed)) ? $upApfTbl[0]->noofbed : "")}}");
									document.getElementsByName('facMode')[0].value = ((document.getElementsByName('facMode')[0].value != "") ? document.getElementsByName('facMode')[0].value : "{{((isset($upApfTbl[0]->facmode)) ? $upApfTbl[0]->facmode : "")}}");
									document.getElementsByName('facilityname_s')[0].value = ((document.getElementsByName('facMode')[0].value != "") ? document.getElementsByName('facilityname_s')[0].value : "{{((isset($upApfTbl[0]->facilityname)) ? $upApfTbl[0]->facilityname : "")}}");
									var _forLoop = setInterval(function() {
										if(region_s.length > 1) {
											clearInterval(_forLoop);
											region_s.value = "{{((isset($upApfTbl[0]->rgnid)) ? $upApfTbl[0]->rgnid : "")}}";
											event.initEvent('change', false, true);
											region_s.dispatchEvent(event);
											if(region_s.value != "") {
												var _forProv = setInterval(function() {
													if(_hasTask < 1) {
														if(province_s.length > 1) {
															clearInterval(_forProv);
															province_s.value = "{{((isset($upApfTbl[0]->provid)) ? $upApfTbl[0]->provid : "")}}";
															event.initEvent('change', false, true);
															province_s.dispatchEvent(event);
														}
													}
												}, -1);
												var _forCity = setInterval(function() {
													if(_hasTask < 1) {
														if(city_s.length > 1) {
															clearInterval(_forCity);
															city_s.value = "{{((isset($upApfTbl[0]->cmid)) ? $upApfTbl[0]->cmid : "")}}";
															event.initEvent('change', false, true);
															city_s.dispatchEvent(event);
														}
													}
												}, -1);
												var _forBarangay = setInterval(function() {
													if(_hasTask < 1) {
														if(barangay_s.length > 1) {
															clearInterval(_forBarangay);
															barangay_s.value = "{{((isset($upApfTbl[0]->brgyid)) ? $upApfTbl[0]->brgyid : "")}}";
														}
													}
												}, -1);
											}
										}
									}, -1);
								}
							});
							var event = document.createEvent('Event');
							event.initEvent('change', false, true);
							document.getElementById('customCheck1').dispatchEvent(event);
						})();
						__chCl(); __clFn();
						@if(count($upApfTbl) > 0)
						clDesc = "{{$upApfTbl[0]->classdesc}}"; owDesc = "{{$upApfTbl[0]->ocdesc}}"; subClDesc = "{{$upApfTbl[0]->subClassdesc}}";
						setTimeout(function() { __chCl("{{$upApfTbl[0]->ocid}}", "{{$upApfTbl[0]->classid}}", "{{$upApfTbl[0]->subClassid}}"); __clFn("{{$upApfTbl[0]->funcid}}"); }, 500);
						@else
						@endif
						</script>
						@else
						<center><p>No user's record</p></center>
						@endif @endisset
					</div>
					<div class="card-footer">
						<div class="row">
							@if($isView != true)
							<div class="col-md-4" style="padding: 10px;">
								<button type="button" onclick="__clFrm(1)" class="btn btn-warning btn-block" data-toggle="modal" data-target="#saveFile"><i class="fa fa-file"></i> Save as Draft</button>
							</div>
							<div class="col-md-4" style="padding: 10px;">
								<button type="button" onclick="__clFrm(2)" class="btn btn-dark btn-block" data-toggle="modal" data-target="#saveFile"><i class="fa fa-list-alt"></i> Open Saved Drafts</button>
							</div>
							<div class="col-md-4" style="padding: 10px;">
								<button type="button" onclick="__clFrm(0)" onmouseover="checkServiceCapabilities()" class="btn btn-info btn-block" data-toggle="modal" data-target="#saveFile"><i class="fa fa-save"></i> Save file</button>
							</div>
							@else
							<div class="col-md-12" style="padding: 10px;">
								<small class="tex-small text-muted" style="float: right;">Copyright</small>
							</div>
							@endif
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card">
					<div class="card-header">
						<h5>Payment Details (Service Capabilites)</h5>
					</div>
					<div class="card-body table-responsive">
						<table class="table tabled-hover">
							<thead class="thead-dark">
								<tr>
									<th>Service Capabilities</th>
									<th>Amount</th>
								</tr>
							</thead>
							<tbody id="paymentBody">
								<tr><td colspan="2">No payment</td></tr>
							</tbody>
							<tfoot>
								<tr>
									<th>TOTAL:</th>
									<td>&#8369;&nbsp;<span id="paymentTotal">0.00</span></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>



		<div id="saveFile" class="modal" tabindex="-1" role="dialog">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title">Confirmation</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<div class="__clFrmCl">
		        	<p>Are you sure you want to save?</p>
		        </div>
		      	<div class="__clFrmCl">
		      		<label for="_inputDraft">Draft Name</label>
		      		<input type="text" id="_inputDraft" class="form-control" name="draft_save" autocomplete="off" placeholder="Draft Name" onkeyup="document.getElementsByName('drafts')[0].value = this.value;">
		        </div>
		      	<div class="__clFrmCl">
		      		@if(count($drApfTbl) > 0)
					<div class="accordion" id="accordionExample">
					  @foreach($drApfTbl AS $drApfRow)
					  <form id="drApfF{{$drApfRow->appid}}" method="post" action="{{asset('/client/apply')}}">
					  	{{csrf_field()}}
					  	<input type="hidden" name="drApfApid" value="{{$drApfRow->appid}}">
					  </form>
					  <div class="card">
					    <div class="card-header" id="headingOne">
					      <h5 class="mb-0">
					        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$drApfRow->appid}}" aria-expanded="true" aria-controls="collapseOne{{$drApfRow->appid}}">
					          {{$drApfRow->draft}}
					        </button>
					      	<button type="submit" form="drApfF{{$drApfRow->appid}}" class="btn btn-sm btn-info" style="float: right;">open</button>
					      </h5>
					    </div>
					    <div id="collapseOne{{$drApfRow->appid}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
					      <div class="card-body">
					      	<p class="text-muted">Draft created: {{date("M jS, Y", strtotime($drApfRow->t_date))}} at {{$drApfRow->t_time}}</p>
					      </div>
					      <div style="border-top: 1px solid rgba(0,0,0,.125);"></div>
					    </div>
					  </div>
					  @endforeach
					</div>
		      		@else
		      		<p>No recent Drafts yet</p>
		      		@endif
		        </div>
		      </div>
		      <div class="modal-footer" id="mdFot">
		        <button type="submit" form="afpForm" class="btn btn-primary">Save changes</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>
		@endif @endisset
		@isset($asmtApply)
		<script type="text/javascript">
			var arrBrd = ['Apply', 'Health Facility Type', 'Application Type', 'Assessment'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th class="text-center" style="width: 35%;">Assessment Name</th>
						<th class="text-center" style="width: 20%;">Complied</th>
						<th class="text-center" style="width: 25%;">File Upload</th>
						<th class="text-center" style="width: 20%;">Remarks (if required)</th>
					</tr>
				</thead>
				<form id="asmtFrm" enctype="multipart/form-data" method="post" action="{{asset('/client/apply')}}"> {{csrf_field()}} <input type="hidden" name="asmtSub" value="{{$app_Id}}">
				@if(count($partTbl) > 0) @foreach($partTbl AS $partRow)
					<tbody id="{{$partRow->partid}}" class="partDesc" hidden>
						<tr>
							<td class="text-center" colspan="4" style="font-size: 28px;">{{$partRow->partdesc}}</td>
						</tr>
							@foreach($asmtApply AS $asmtApplyRow) @if($asmtApplyRow->partid == $partRow->partid)
							<tr>
								<td class="text-justify td-padding">{{$asmtApplyRow->asmt_name}}</td>
								<td class="td-padding">
									@if($asmtApplyRow->complied != NULL)
									<?php $_i = ""; $_c = ""; $_m = ""; if($asmtApplyRow->complied == "1") { $_i = "fa-check-circle"; $_c = "badge-success"; $_m = "Yes"; } else { $_i = "fa-times-circle"; $_c = "badge-danger"; $_m = "No"; } ?>
									<label class="badge {{$_c}}"><i class="fa {{$_i}}"></i> {{$_m}}</label><br>
									@if($asmtApplyRow->complied == "1")
									<input type="hidden" name="complied[{{$asmtApplyRow->asmt_id}}]" value="{{$asmtApplyRow->complied}}">
									@endif
									@endif
									@if($asmtApplyRow->complied == NULL || ($asmtApplyRow->complied != NULL && $asmtApplyRow->complied == '0'))
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="complied_{{$asmtApplyRow->asmt_id}}_1" name="complied[{{$asmtApplyRow->asmt_id}}]" class="custom-control-input" value="1" onchange="__chInp(true, '{{$asmtApplyRow->asmt_id}}')">
									  <label class="custom-control-label" for="complied_{{$asmtApplyRow->asmt_id}}_1">Yes</label>
									</div>
									<div class="custom-control custom-radio custom-control-inline">
									  <input type="radio" id="complied_{{$asmtApplyRow->asmt_id}}_2" name="complied[{{$asmtApplyRow->asmt_id}}]" class="custom-control-input" value="0" onchange="__chInp(false, '{{$asmtApplyRow->asmt_id}}')">
									  <label class="custom-control-label" for="complied_{{$asmtApplyRow->asmt_id}}_2">No</label>
									</div>
									@endif
								</td>
								<td class="td-padding">
									@if($asmtApplyRow->fileName != NULL) 
									<?php $_iF = ""; $_cF = ""; $_mF = ""; if($asmtApplyRow->isapproved != NULL) { if($asmtApplyRow->isapproved == 1) { $_iF = "fa-check-circle"; $_cF = "badge-success"; $_mF = "File Approved."; } else { $_iF = "fa-times-circle"; $_cF = "badge-danger"; $_mF = "File Not Approved."; } } else { $_iF = "fa-exclamation-circle"; $_cF = "badge-dark"; $_mF = "File Uploaded."; } ?>
									<label class="badge {{$_cF}}"><i class="fa {{$_iF}}"></i> {{$_mF}}</label>
									<input type="hidden" name="filetype[{{$asmtApplyRow->asmt_id}}]" value="{{$asmtApplyRow->fileName}}">
									@else
									<input id="file_{{$asmtApplyRow->asmt_id}}" type="file" class="form-control" name="filetype[{{$asmtApplyRow->asmt_id}}]" value>
									@endif
								</td>
								<td class="td-padding">
									@if($asmtApplyRow->app_assess_id != NULL && $asmtApplyRow->fileName != NULL)
									<label class="badge badge-light">Remarks: {{((!empty($asmtApplyRow->remarks)) ? $asmtApplyRow->remarks : "No remarks")}}</label>
									<input type="hidden" name="remarks[{{$asmtApplyRow->asmt_id}}]" value="{{$asmtApplyRow->remarks}}">
									@else
									<input id="remarks_{{$asmtApplyRow->asmt_id}}" type="text" class="form-control text-remarks" placeholder="Remarks" name="remarks[{{$asmtApplyRow->asmt_id}}]" hidden>
									@endif
								</td>
							</tr>
							@endif @endforeach
					</tbody>
				@endforeach @endif
				</form>
			</table>
			<button type="button" id="btnprv" class="btn btn-info" onclick="__frCls('partDesc', -1)" style="float: left;">Prev</button>
			<button type="button" id="btnnxt" class="btn btn-info" onclick="__frCls('partDesc', 1)" style="float: right;">Next</button>
			@if($isView == false)
			<button type="submit" id="btnsub" form="asmtFrm" class="btn btn-success" style="float: right;" hidden>Submit</button>
			@else
			<button type="button" id="btnsub" class="btn btn-success" style="float: right; display: none;" hidden>Submit</button>
			@endif
			<script type="text/javascript">__frCls('partDesc', 0);</script>
		</div><br>
		@endisset
		@isset($pDApf_c)
		<script type="text/javascript">
			var arrBrd = ['Apply', 'Health Facility Type', 'Application Type', 'Personnel'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		<div class="row">
			<div class="col-sm-2">
				<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModal">
				  Add
				</button><hr>
				<button type="submit" class="btn btn-danger btn-block" form="deleteFPersonnel">Deactivate</button>
			</div>
			<div class="col-sm-10">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th></th>
								<th>Name</th>
								<th>Gender</th>
								<th>Birthdate</th>
								<th>Position</th>
								<th>Section</th>
								<th>Deparment</th>
							</tr>
						</thead>
						<tbody><form method="POST" action="{{asset('/client/apply')}}" id="deleteFPersonnel">
							{{csrf_field()}}
							@if(count($pDApf_c) > 0) @foreach($pDApf_c AS $pDApf_cRow)
							<tr>
								<td>
									<div class="custom-control custom-checkbox custom-control-inline">
									  <input type="checkbox" id="{{$pDApf_cRow->pid}}" name="deleteFPersonnel[]" class="custom-control-input" value="{{$pDApf_cRow->pid}}">
									  <label class="custom-control-label" for="{{$pDApf_cRow->pid}}"></label>
									</div>
								</td>
								<td>{{ucwords($pDApf_cRow->firstname)}} {{ucwords($pDApf_cRow->lastname)}}</td>
								<td>{{$pDApf_cRow->gender}}</td>
								<td>{{date("M jS, Y", strtotime($pDApf_cRow->bod))}}</td>
								<td>{{$pDApf_cRow->posname}}</td>
								<td>{{$pDApf_cRow->secname}}</td>
								<td>{{$pDApf_cRow->depname}}</td>
							</tr>
							@endforeach @else
							<tr>
								<td colspan="3" class="text-center">No personnel added</td>
							</tr>
							@endif
						</form></tbody>
					</table>
				</div><hr>
			</div>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Personnel</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		      	<form id="fPersonnel" enctype="multipart/form-data" method="post" action="{{asset('/client/apply')}}">
				{{csrf_field()}}
					<div class="perAdd">
						<h5>Profile</h5>
						<div>
							<div class="form-row">
								<div class="form-group col-sm-4">
									<input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname">
								</div>
								<div class="form-group col-sm-4">
									<input type="text" class="form-control" placeholder="Middle Name" name="middlename" id="middlename">
								</div>
								<div class="form-group col-sm-4">
									<input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname">
								</div>
								<div class="form-group col-sm-6">
									<label for="bod">Birth Date</label>
									<input type="date" class="form-control" placeholder="Birth Date" name="bod" id="bod" value="{{date('Y-m-d')}}">
								</div>
								<div class="form-group col-sm-6">
									<label for="gender">Gender</label>
									<select id="gender" name="gender" class="form-control">
										<option disabled hidden value selected>Gender</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="perAdd">
						<h5>Work</h5>
						<div>
							<div class="form-row">
								<div class="form-group col-sm-4">
									<label for="position">Position</label>
									{{-- <input type="text" class="form-control" placeholder="Position" name="position" id="position" value> --}}
									<select id="position" name="position" class="form-control">
										<option disabled hidden value selected>Position</option>
										@if(count($position) > 0) @foreach($position AS $positionRow)
										<option value="{{$positionRow->posid}}">{{$positionRow->posname}}</option>
										@endforeach @endif
									</select>
								</div>
								<div class="form-group col-sm-4">
									<label for="section">Section</label>
									{{-- <input type="text" class="form-control" placeholder="Section" name="section" id="section" value> --}}
									<select id="section" name="section" class="form-control">
										<option disabled hidden value selected>Section</option>
										@if(count($section) > 0) @foreach($section AS $sectionRow)
										<option value="{{$sectionRow->secid}}">{{$sectionRow->secname}}</option>
										@endforeach @endif
									</select>
								</div>
								<div class="form-group col-sm-4">
									<label for="department">Department</label>
									{{-- <input type="text" class="form-control" placeholder="Department" name="department" id="department" value> --}}
									<select id="department" name="department" class="form-control">
										<option disabled hidden value selected>Department</option>
										@if(count($department) > 0) @foreach($department AS $departmentRow)
										<option value="{{$departmentRow->depid}}">{{$departmentRow->depname}}</option>
										@endforeach @endif
									</select>
								</div>
								<div class="form-group col-sm-6">
									<label for="assigndate">Assigned Date</label>
									<input type="date" class="form-control" placeholder="Assigned Date" name="assigndate" id="assigndate" value="{{date('Y-m-d')}}">
								</div>
								<div class="form-group col-sm-6">
									<label for="enddate">End Date</label>
									<input type="date" class="form-control" placeholder="End Date" name="enddate" id="enddate" value="{{date('Y-m-d')}}">
								</div>
							</div>
						</div>
					</div>
					<div class="perAdd">
						<h5>Eligibility</h5>
						<div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<button type="button" class="btn btn-success" style="float: right;" onclick="__addClone(['plicensetype', 'expiration'], ['licensetypeCom', 'expirationCom'])">Add Others</button>
								</div>
								<div class="form-group col-sm-6">
									<button type="button" class="btn btn-danger" style="float: left;" onclick="__removeClone(['licensetypeCom', 'expirationCom'])">Reset</button>
								</div>
								<div class="form-group col-sm-6">
									<label for="plicensetype">License Type</label>
									<select id="plicensetype" name="plicensetype[]" class="form-control">
										<option disabled hidden value selected>License Type</option>
										@if(count($plicensetype) > 0) @foreach($plicensetype AS $plicensetypeRow)
										<option value="{{$plicensetypeRow->plid}}">{{$plicensetypeRow->pldesc}}</option>
										@endforeach @endif
									</select>
									<div id="licensetypeCom">
									</div>
								</div>
								<div class="form-group col-sm-6">
									<label for="expiration">Licensed ID Expiration Date</label>
									<input type="date" class="form-control" placeholder="End Date" name="expiration[]" id="expiration" value="{{date('Y-m-d')}}">
									<div id="expirationCom">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="perAdd">
						<h5>Trainings</h5>
						<div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<button type="button" class="btn btn-success" style="float: right;" onclick="__addClone('trainingsClone', 'placeTraningsClone')">Add Others</button>
								</div>
								<div class="form-group col-sm-6">
									<button type="button" class="btn btn-danger" style="float: left;" onclick="__removeClone('placeTraningsClone')">Reset</button>
								</div>
								<div id="trainingsClone" class="form-row" style="border: 1px solid;">
									<div class="form-group col-sm-12">
										<label for="ptrainings_trainingtype">Trainings</label>
										<select id="ptrainings_trainingtype" name="ptrainings_trainingtype[]" class="form-control">
											<option disabled hidden value selected>Trainings</option>
											@if(count($ptrainings_trainingtype) > 0) @foreach($ptrainings_trainingtype AS $ptrainings_trainingtypeRow)
											<option value="{{$ptrainings_trainingtypeRow->tt_id}}">{{$ptrainings_trainingtypeRow->ptdesc}}</option>
											@endforeach @endif
										</select>
									</div>
									<div class="form-group col-sm-6">
										<label for="school">School</label>
										<input type="text" class="form-control" placeholder="School" name="school[]" id="school">
									</div>
									<div class="form-group col-sm-6">
										<label for="course">Course</label>
										<input type="text" class="form-control" placeholder="Course" name="course[]" id="course">
									</div>
									<div class="form-group col-sm-6">
										<label for="datestart">Date Started</label>
										<input type="date" class="form-control" placeholder="Date Started" name="datestart[]" id="datestart" value="{{date('Y-m-d')}}">
									</div>
									<div class="form-group col-sm-6">
										<label for="datefinish">Date Finished</label>
										<input type="date" class="form-control" placeholder="Date Finished" name="datefinish[]" id="datefinish" value="{{date('Y-m-d')}}">
									</div>
									<br>
								</div>
								<div id="placeTraningsClone">
								</div>
							</div>
						</div>
					</div>
					<input type="hidden" name="fPersonnel" value="Submit">
				</form>
		      </div>
		      <div class="modal-footer">
		        <button type="button" id="btnprv" class="btn btn-info" onclick="__frCls('perAdd', -1)" style="float: left;">Prev</button>
				<button type="button" id="btnnxt" class="btn btn-info" onclick="__frCls('perAdd', 1)" style="float: right;">Next</button>
				<button type="submit" id="btnsub" form="fPersonnel" class="btn btn-success" hidden>Submit</button>
		      </div>
		    </div>
		  </div>
		</div>
		<script type="text/javascript">__frCls('perAdd', 0);</script>
		@endisset
		@isset($pDApf_cSendData)
		<form method="post" action="{{asset('/client/apply')}}">
			{{csrf_field()}}
			<input type="hidden" name="fPsnft" value="addedNew">
			<button type="submit" id="submitasdfs" hidden>Submit</button>
			<script type="text/javascript">document.getElementById('submitasdfs').click();</script>
		</form>
		@endisset
	</div>
</body>
@include('client.cmp.foot')
@endsection