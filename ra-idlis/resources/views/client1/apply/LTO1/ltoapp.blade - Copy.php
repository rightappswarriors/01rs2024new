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
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-md-3 hide-div">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 60px; padding-left: 20px;">
							</div>
							<div class="col-md-6">
								<h5 class="card-title text-uppercase text-center">License To Operate</h5>
								<h6 class="card-subtitle mb-2 text-center text-muted">LTO Details</h6>
							</div>
							<div class="col-md-3 hide-div">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 60px; padding-right: 20px;">
							</div>
						</div>
					</div>
					<div class="card-body" id="ptcbody">
						<div id="_errMsg"></div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Health Facility Address</p>
							</div>
							<div class="col text-right">
								<p>Application Type: <span class="font-weight-bold">Initial New</span></p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-3">
								<p>Region:</p>
								<div class="mb-3">
									<strong>{{((isset($fAddress[0]->rgn_desc) > 0) ? $fAddress[0]->rgn_desc : "No Region")}}</strong>
								</div>
							</div>
							<div class="col-md-3">
								<p>Province:</p>
								<div class="mb-3">
									<strong>{{((isset($fAddress[0]->provname) > 0) ? $fAddress[0]->provname : "No Province")}}</strong>
								</div>
							</div>
							<div class="col-md-3">
								<p>District/City/Municipality:</p>
								<div class="mb-3">
									<strong>{{((isset($fAddress[0]->cmname) > 0) ? $fAddress[0]->cmname : "No City/Municipality")}}</strong>
								</div>
							</div>
							<div class="col-md-3">
								<p>Barangay:</p>
								<div class="mb-3">
									<strong>{{((isset($fAddress[0]->brgyname) > 0) ? $fAddress[0]->brgyname : "No Barangay")}}</strong>
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-6">
								<p>Street Name:</p>
								<div class="mb-3">
									<strong>{{((isset($fAddress[0]->street_name) > 0) ? $fAddress[0]->street_name : "No Street Name")}}</strong>
								</div>
							</div>
							<div class="col-md-6">
								<p>Zip Code:</p>
								<div class="mb-3">
									<strong>{{((isset($fAddress[0]->zipcode) > 0) ? $fAddress[0]->zipcode : "No Zipcode")}}</strong>
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Type of Application</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mb-3" id="hfaci_grp">
									@if(count($hfaci_serv_type) > 0) @for($i = 0; $i < ceil(count($hfaci_serv_type)/4); $i++) <?php $_min = $i * 4; $_oMax = $_min + 4; $_nMax = (($_oMax > count($hfaci_serv_type)) ? count($hfaci_serv_type) : $_oMax); ?>
									<div class="row">
										@for($j = $_min; $j < $_nMax; $j++)
										<div class="col-md-3">
											<div class="custom-control custom-radio mr-sm-2">
										        <input type="checkbox" class="custom-control-input" id="{{$hfaci_serv_type[$j]->hgpid}}" name="hgpid" value="{{$hfaci_serv_type[$j]->hgpid}}">
										        <label class="custom-control-label" for="{{$hfaci_serv_type[$j]->hgpid}}">{{$hfaci_serv_type[$j]->hgpdesc}}</label>
										    </div>
										</div>
										@endfor
									</div>
									@endfor @else
									<p>No facility type(s).</p>
									@endif
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>For Ambulatory Surgical Clinic</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="addCLick mb-3" id="hgpid1">

								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>For Ambulance Details</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-6">
								<p>Ambulance Service:</p>
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <label class="input-group-text" for="typeamb"><i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Lorem ipsum dolar"></i></label>
								  </div>
								  <select class="form-control" id="typeamb" name="typeamb">
										<option selected value hidden disabled>Please select</option>
										<option value="1">Type 1 (Basic Life Support)</option>
										<option value="2">Type 2 (Advance Life Support)</option>
									</select>
								</div>

								{{-- <p>Ambulance Service:</p>
								<div class="mb-3">
									<select class="form-control" id="typeamb" name="typeamb">
										<option selected value hidden disabled>Please select</option>
										<option value="1">Type 1 (Basic Life Support)</option>
										<option value="2">Type 2 (Advance Life Support)</option>
									</select>
								</div> --}}
							</div>
							<div class="col-md-6">
								<p>Ambulance Capacity:</p>
								<div class="mb-3">
									<input type="number" class="form-control" id="noofamb" name="noofamb" placeholder="Ambulance Capacity">
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>For Dialysis Clinic</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="addCLick mb-3" id="hgpid5">

								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Classification of Hospital</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mt-3 mb-3">
									<select class="form-control" id="funcid" name="funcid">
										<option selected value hidden disabled>Please select</option>
										@foreach($function AS $each)
											<option value="{{$each->funcid}}">{{$each->funcdesc}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>For Hospital</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="addCLick mb-3" id="hgpid6">

								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Other Ancillary Services</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="addCLick mb-3" id="oAnc">
									
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Classification According to</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-4">
								<p>Ownership:</p>
								<div class="mb-3">
									<select class="form-control" id="ocid" name="ocid">
										<option selected value hidden disabled>Please select</option>
										@foreach($ownership AS $each)
										<option value="{{$each->ocid}}">{{$each->ocdesc}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<p>Class:</p>
								<div class="mb-3">
									<select class="form-control" id="classid" name="classid">
										<option selected value hidden disabled>Please select</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<p>Subclass:</p>
								<div class="mb-3">
									<select class="form-control" id="subClassid" name="subClassid">
										<option selected value hidden disabled>Please select</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<p>Institutional Character:</p>
								<div class="mb-3">
									<select class="form-control" id="facmode" name="facmode">
										<option selected value hidden disabled>Please select</option>
										@foreach($facmode AS $each)
										<option value="{{$each->facmid}}">{{$each->facmdesc}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<input type="hidden" value="IN" id="aptid" name="aptid">
						{{-- <div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Other Details</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mt-3 mb-3">
									<select class="form-control" id="aptid" name="aptid">
										<option selected value hidden disabled>Please select</option>
										@foreach($apptype AS $each)
										<option value="{{$each->aptid}}">{{$each->aptdesc}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div> --}}
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Authorized Bed Capacity</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mt-3 mb-3">
									<input type="number" class="form-control" name="noofbed" id="noofbed" placeholder="Bed Capacity" autocomplete="off">
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Other Clinical Service(s)</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mb-3" id="cl_serv">

								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>For Pharmacy</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<p>No. of Satellite:</p>
								<div class="mb-3">
									<input type="number" class="form-control" id="noofsatellite" name="noofsatellite" placeholder="No. of Satellite">
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>For Clinical Laboratory</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mt-3 mb-3">
									<select class="form-control" name="clab" id="clab">
										<option selected value hidden disabled>Please select</option>
										<option value="1">Primary</option>
										<option value="2">Secondary</option>
										<option value="3">Tertiary</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;"></div>
					</div>
					<div class="card-footer">
						<div class="pull-left">
							<a href="{{asset('client1/apply')}}"><button class="btn btn-danger">Back</button></a>
						</div>
						<div class="remthis pull-right" id="cModal">
							<button class="btn btn-info" data-toggle="modal" data-target="#confirmModal">Submit Details</button>
						</div>
					</div>
				</div>
			</div>
			{{-- new col --}}
			<div class="col-md-4">
				<div class="accordion" id="accordionExample">
				  <div class="card">
				    <div class="card-header" id="headingOne">
				      <h5 class="mb-0">
				        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
				          Payment Details
				        </button>
				      </h5>
				    </div>

				    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
				      <div class="card-body table-responsive">
				      	<table class="table table-striped">
				      		<thead class="thead-dark">
				      			<tr>
				      				<th>Description</th>
				      				<th>Amount</th>
				      			</tr>
				      		</thead>
				      		<tbody id="serv_chg">
				      			<tr>
				      				<td colspan="2">No Service Capabilities selected.</td>
				      			</tr>
				      		</tbody>
				      	</table>
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingFive">
				      <h5 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
				          Payment and Application Process
				        </button>
				      </h5>
				    </div>
				    <div id="collapseFive" class="collapse show" aria-labelledby="headingFive" data-parent="#accordionExample">
				      <div class="card-body table-responsive">
				      	<table class="table table-bordered">
				      		<thead class="thead-dark">
				      			<tr>
				      				<th>Processed to</th>
				      				<th>Payment on</th>
				      			</tr>
				      		</thead>
				      		<tbody id="proapp">
				      			<tr>
				      				<td colspan="2">No Service Capabilities selected.</td>
				      			</tr>
				      		</tbody>
				      	</table>
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingFour">
				      <h5 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          Ancillary Services
				        </button>
				      </h5>
				    </div>
				    <div id="collapseThree" class="collapse show" aria-labelledby="headingFour" data-parent="#accordionExample">
				      <div class="card-body table-responsive">
				      	<table class="table table-bordered">
				      		<thead class="thead-dark">
				      			<tr>
				      				<th id="levelSelected">Ancillary</th>
				      			</tr>
				      		</thead>
				      		<tbody id="ancillary">
				      			<tr>
				      				<td colspan="2">No Current Ancillary Services.</td>
				      			</tr>
				      		</tbody>
				      	</table>
				      </div>
				    </div>
				  </div>
				  <div class="card">
				    <div class="card-header" id="headingThree">
				      <h5 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
				          Application Details
				        </button>
				      </h5>
				    </div>
				    <div id="collapseFour" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				      <div class="card-body table-responsive">
				      	<table class="table table-striped">
				      		<tbody>
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
				      				<td>{{((count($fAddress) > 0) ? date('M d, Y', strtotime($fAddress[0]->t_date)) : "No Date")}}</td>
				      			</tr>
				      		</tbody>
				      	</table>
				      </div>
				    </div>
				  </div>
				</div>
			</div>
		</div>
	</div>

	<div class="remthis modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="confirmModalLabel">Confirmation Dialog</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<strong>Are you sure you want to submit form?</strong><br>
	      	<label class="badge badge-danger">Please check/review your form.</label>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-success" data-dismiss="modal" id="subForm">Proceed</button>
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		var ___div = document.getElementById('__applyBread'), ___wizardcount = document.getElementsByClassName('wizardcount');
		document.getElementById('stepDetails').innerHTML = 'Application LTO Details';
		if(___wizardcount != null || ___wizardcount != undefined) {
			for(let i = 0; i < ___wizardcount.length; i++) {
				if(i < 2) {
					___wizardcount[i].parentNode.classList.add('past');
				}
				if(i == 2) {
					___wizardcount[i].parentNode.classList.add('active');
				}
			}
		}
		var mclass = JSON.parse('{!!$class!!}'), 
		msubclass = JSON.parse('{!!$subclass!!}'), 
		mserv_cap = JSON.parse('{!!$serv_cap!!}'), 
		mappform = JSON.parse('{!!json_encode($fAddress)!!}'), 
		mservfac = JSON.parse('{!!$servfac!!}');

		var curAppid = "", curPtcId = "", curHfserid ="{{((count($fAddress) > 0) ? $fAddress[0]->hfser_id : "")}}";

		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
		(function() {
			let cRadioId = ['type0', 'type1'], 
			hgpid = document.getElementsByName('hgpid'), 
			facid = document.getElementsByName('facid');
			function changeNrs(inOf) {
				let dom = document.getElementsByClassName('nrs');
				if(dom != null || dom != undefined) {
					for(let i = 0; i < dom.length; i++) {
						dom[i].setAttribute('hidden', true);
					}
					dom[inOf].removeAttribute('hidden');
				}
			}
			function fPTCApp() {
				let token = document.getElementsByName('_token')[0], ocid = document.getElementById('ocid'), classid = document.getElementById('classid'), subClassid = document.getElementById('subClassid'), facmode = document.getElementById('facmode'), funcid = document.getElementById('funcid'), gtype = document.getElementsByName('type'), type = "", ghgpid = document.getElementsByName('hgpid'), gfacid = document.getElementsByName('facid'), uid = document.getElementById('uid'), aptid = document.getElementById('aptid'), noofbed = document.getElementById('noofbed'), clab = document.getElementById('clab'), noofsatellite = document.getElementById('noofsatellite'), typeamb = document.getElementById('typeamb'), noofamb = document.getElementById('noofamb');
				let sArr = ['_token='+token.value, 'uid='+uid.value, 'appid='+curAppid, 'ocid='+ocid.value, 'classid='+classid.value, 'subClassid='+subClassid.value, 'facmode='+facmode.value, 'funcid='+funcid.value, 'aptid='+aptid.value, 'noofbed='+noofbed.value, 'clab='+clab.value, 'noofsatellite='+noofsatellite.value, 'typeamb='+typeamb.value, 'noofamb='+noofamb.value];
				if(ghgpid != null || ghgpid != undefined) { for(let i = 0; i < ghgpid.length; i++) { if(ghgpid[i].checked) {
					sArr.push('hgpid[]='+ghgpid[i].value);
				} } }
				if(gfacid != null || gfacid != undefined) { for(let i = 0; i < gfacid.length; i++) { if(gfacid[i].checked) {
					sArr.push('facid[]='+gfacid[i].value);
				} } }
				insErrMsg('warning', 'Sending request.');
				sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/fLTOApp')}}", "POST", true, {
					functionProcess: function(arr) {
						let aBol = true;
						arr.forEach(function(a, b, c) {
							if(a != true) {
								aBol = false;
								insErrMsg('danger', a);
							}
						});
						if(aBol) {
							var r = confirm('Application submitted. Proceed to submission of requirements?');
							if (r == true) { window.location.href = "{{asset('client1/apply/app/')}}/{{$fAddress[0]->hfser_id}}/"+curAppid+"/hfsrb";} else { window.location.href = "{{asset('client1/apply')}}"; }
							// var r = confirm('Application submitted. Proceed to payment?');
							// if (r == true) { window.location.href = "{{asset('client1/payment')}}/{{$cToken}}/"+curAppid; } else { window.location.href = "{{asset('client1/apply')}}"; }
						}
					}
				});
			}
			function findChkName(arrCol) {
				let sArr = ['_token='+document.getElementsByName('_token')[0].value, 'appid='+curAppid, 'hfser_id='+curHfserid];
				if(Array.isArray(arrCol)) {
					for(let i = 0; i < arrCol.length; i++) {
				  		sArr.push('facid[]='+arrCol[i]); 
					} 
				}
				sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/getServiceCharge')}}", "POST", true, {
					functionProcess: function(arr) {
						let serv_chg = document.getElementById('serv_chg');
						if(serv_chg != undefined || serv_chg != null) {
							if(arr.length > 0) {
								serv_chg.innerHTML = '';
								for(let i = 0; i < arr.length; i++) {
									serv_chg.innerHTML += '<tr><td>'+arr[i]['facname']+'</td><td>&#8369;&nbsp;<span>'+(parseInt(arr[i]['amt'])).toFixed(2)+'</span></td></tr>';
								}
							} else {
								serv_chg.innerHTML = '<tr><td colspan="2">No Service Capabilities selected.</td></tr>';
							}
						}
					}
				});
			}
			function retArrReqChk(elName, isCheck) {
				let idom = document.getElementsByName(elName), retArr = [];
				if(idom != undefined || idom != null) { for(let i = 0; i < idom.length; i++) { if(typeof isCheck == "boolean") { if(idom[i].checked == isCheck) {
					retArr.push(idom[i].value);
				} } } }
				return retArr;
			}
			function findSelName(elName, colName, tblName, insId, arrCol, clId) {
				let dom = document.getElementById(elName), 
				arr = [], 
				forDispArr = [], 
				selArr = { hgpid1: 'hgpid1', hgpid5: 'hgpid5', hgpid6: 'hgpid6', oAnc: 'oAnc' }; // document.getElementsByName(elName)

				let procTbl = function(eDom) {

					if(window[tblName] != undefined){
						window[tblName].forEach(function(a, b, c) {
							if(a[colName] == eDom.value) {
							 arr.push(a); 
							} 
						}); 
					} 

					if(window[tblName] == undefined) {
						tblName.forEach(function(a, b, c) {
							if(a[colName] == eDom.value) {
							 arr.push(a); 
							} 
						}); 
					}

				};

				if(dom != null || dom != undefined) {
					if(insId in selArr) {
						if(dom.checked) {
						 procTbl(dom); 
						} 
					} else { 
						procTbl(dom); 
					}
					let idom = document.getElementById(insId);
					if(idom != null || idom != undefined) {
						if(arr.length > 0) {
							let apString = "", 
							selString = '<option selected value hidden disabled>Please select</option>';
							for(let i = 0; i < Math.ceil(arr.length/4); i++) {
								let iMin = i * 4, iMax = iMin + 4, mMax = ((iMax > arr.length) ? arr.length : iMax);
								apString += '<div class="row">';
								for(let j = iMin; j < mMax; j++) {
									selString += '<option value="'+arr[j][arrCol[0]]+'">'+arr[j][arrCol[1]]+'</option>';
									// if(elName == 6){
									apString += '<div class="col-md-3"><div class="custom-control custom-checkbox mr-sm-2">'+
											        '<input type="checkbox" class="custom-control-input" id="'+arr[j][arrCol[0]]+'" name="facid" value="'+arr[j][arrCol[0]]+'">'+
											        '<label class="custom-control-label" for="'+arr[j][arrCol[0]]+'">'+arr[j][arrCol[1]]+'</label>'+
											    '</div></div>';
									// } else if(elName != 6) {
									// 	apString += '<div class="col-md-3"><div class="custom-control custom-checkbox mr-sm-2">'+
									// 		        '<input type="checkbox" class="custom-control-input" id="'+arr[j][arrCol[0]]+'" name="facid" value="'+arr[j][arrCol[0]]+'">'+
									// 		        '<label class="custom-control-label" for="'+arr[j][arrCol[0]]+'">'+arr[j][arrCol[1]]+'</label>'+
									// 		    '</div></div>';
									// }
								}
								apString += '</div>';
							}
							idom.innerHTML = ((insId in selArr) ? apString : selString);
							if(Array.isArray(clId)) {
								for(let i = 0; i < clId.length; i++) {
									document.getElementById(clId[i]).innerHTML = ((insId in selArr) ? '' : '<option selected value hidden disabled>Please select</option>'); 
								} 
							}
					} else {
						idom.innerHTML = ((insId in selArr) ? '' : '<option selected value hidden disabled>Please select</option>'); 
					} 
					}
				}
			}
			function remThis() {
				let idom = document.getElementsByClassName('remthis'), ptcbody = document.getElementById('ptcbody');
				if(idom != null || idom != undefined) { 
					for(let i = 0; i < idom.length; i++) { idom[i].parentNode.removeChild(idom[i]); 
					} 
				}
				fPTCApp = undefined;
				if(ptcbody != undefined || ptcbody != null) { ptcbody.disabled = true; }
			}

			// display choosen service capabilities
			function fSelServ(elName) {

				let retArr = retArrReqChk(elName, true);
				if(retArr != undefined && retArr != null && retArr.length > 0){
					let desc = $("#levelSelected");
					let anc = $("#ancillary");
					$.ajax({
						url: '{{asset('client1/request/customQuery/getApplyLoc')}}',
						dataType: "json", 
						method: 'POST',
						data: {_token:$("input[name=_token]").val(),id: retArr[0],hfer: '{{$hfer}}'},
						success: function(a){
							let ret = JSON.parse(a)[0];
							$("#proapp").empty().append(
								'<tr>'+
				      				'<td>'+
				      				ret['applytofaci']+
				      				'</td>'+
				      				'<td>'+
				      				ret['applytoLoc']+
				      				'</td>'+
				      			'</tr>'
							)
						}
					})
					switch (retArr[0]) {
						case 'H':
							desc.empty().append('Hospital Level 1');
							anc.empty().append(
								'<tr>'+
				      				'<td>'+
				      				'Consulting Specialist in:'+
				      				'<ul>'+
				      					'<li>Medicine</li>'+
				      					'<li>Pediatrics</li>'+
				      					'<li>OB-GYNE</li>'+
				      					'<li>Surgery</li>'+
				      				'</ul>'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Emergency and Out-patient Services'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Isolation Facilities'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Surgical/Maternity Facilities'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Dental Clinic'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Secondary Clinical Laboratory'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Blood Station'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'1st Level X-ray'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Pharmacy'+
				      				'</td>'+
				      			'</tr>'
								)
							break;
						case 'H2':
							desc.empty().append('Hopsital Level 2');
							anc.empty().append(
								'<tr>'+
				      				'<td>'+
				      				'Consulting Specialist in:'+
				      				'<ul>'+
				      					'<li>Medicine</li>'+
				      					'<li>Pediatrics</li>'+
				      					'<li>OB-GYNE</li>'+
				      					'<li>Surgery</li>'+
				      				'</ul>'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Emergency and Out-patient Services'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Isolation Facilities'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Surgical/Maternity Facilities'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Dental Clinic'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Departmentalized Clinical Services'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Respiratory Unit'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'General ICU'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'High Risk Pregnancy Unit'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'NICU'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Tertiary Clinical Laboratory'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Blood Station'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'2nd Level X-ray w/mobile unit'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Pharmacy'+
				      				'</td>'+
				      			'</tr>'
								)
							break;
						case 'H3':
							desc.empty().append('Hospital Level 3');
							desc.empty().append('Hopsital Level 2');
							anc.empty().append(
								'<tr>'+
				      				'<td>'+
				      				'Consulting Specialist in:'+
				      				'<ul>'+
				      					'<li>Medicine</li>'+
				      					'<li>Pediatrics</li>'+
				      					'<li>OB-GYNE</li>'+
				      					'<li>Surgery</li>'+
				      				'</ul>'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Emergency and Out-patient Services'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Isolation Facilities'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Surgical/Maternity Facilities'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Dental Clinic'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Departmentalized Clinical Services'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Respiratory Unit'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'General ICU'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'High Risk Pregnancy Unit'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'NICU'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Teaching/Training w/Accredited Residency Training Program In:'+
				      				'<ul>'+
				      					'<li>Medicine</li>'+
				      					'<li>Pediatrics</li>'+
				      					'<li>OB-GYNE</li>'+
				      					'<li>Surgery</li>'+
				      				'</ul>'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Physical Medicine and Rehabilitation Unit'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Ambulatory Surgical Clinic'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Dialysis Clinic'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Tertiary Laboratory w/histopathology'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Blood Bank'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'3rd Level X-ray'+
				      				'</td>'+
				      			'</tr>'+
				      			'<tr>'+
				      				'<td>'+
				      				'Pharmacy'+
				      				'</td>'+
				      			'</tr>'
								)
							break;
						default:
							desc.empty().append('Ancillary');
							anc.empty().append('No Current Ancillary Services.');
							break;
					}
				}
				findChkName(retArr);
			}

			//for displaying saved data
			function procChkSelData() {
				if(mappform.length > 0) {
					let mappformArr = ['ocid', 'classid', 'subClassid', 'facmode', 'funcid', 'aptid', 'noofbed', 'clab', 'noofsatellite', 'typeamb', 'noofamb'], 
					chReq = [['ocid', 'mclass', 'classid', ['classid', 'classname'], ['subClassid']], ['isSub', 'msubclass', 'subClassid', ['classid', 'classname'], []], [], [], [], [], [], [], []], 
					mappformArrChk = ['ocid', 'facmode', 'funcid', 'aptid', 'noofbed', 'clab', 'noofsatellite'], 
					premThis = true;
					curAppid = mappform[0]['appid'];
					if(Array.isArray(mservfac)) {
						let mservfacArr = ['hgpid', 'facid'], 
						chReq = [['hgpid', 'mserv_cap', 'serv_cap', ['facid', 'facname'], [], ['facilitytyp', 'hgpid']]];
						// mservfac.length

						for(let i = 0; i < mservfacArr.length; i++) { 
							for(let j = 0; j < mservfac[i].length; j++) {
							let idom = document.getElementById(mservfac[i][j][mservfacArr[i]]);
							if(idom != undefined || idom != null) { 
								idom.checked = true; 
								if(chReq[i] != null || chReq[i] != undefined) { 
									findSelName(idom.id, chReq[i][0], chReq[i][1], mservfacArr[i] + mservfac[i][j][mservfacArr[i]], chReq[i][3], chReq[i][4]); 
								} 
							} // chReq[i][2]
							} if(i == 1) {
							 fSelServ(mservfacArr[i]); 
							} 
						}
					}
					for(let i = 0; i < mappformArr.length; i++) {
						let idom = document.getElementById(mappformArr[i]);
						if(idom != undefined || idom != null) {
							if(mappform[0][mappformArr[i]] != null) {
							 idom.value = mappform[0][mappformArr[i]]; 
							}
							if(chReq.length == mappformArr.length) { 
								if(chReq[i].length > 0) { 
									findSelName(idom.id, chReq[i][0], chReq[i][1], chReq[i][2], chReq[i][3], chReq[i][4], []); 
								} 
							}
						}
					}
					mappformArrChk.forEach(function(a, b, c) {
						if(mappform[0][a] == null) {
							premThis = false;
						}
					});
					if(mappform[0]['canapply'] == 1) {
						premThis = false;
					}
					if(premThis) {
						remThis();
					}
					// chkApOop();
				}
			}
			//end

			document.getElementById('subForm').addEventListener('click', fPTCApp);

			// for clicked health facility
			for(let i = 0; i < hgpid.length; i++) {
				hgpid[i].addEventListener('click', function() {
					let arrAddon = Array();
					findSelName(this.id, 'hgpid', 'mserv_cap', 'hgpid'+this.id, ['facid', 'facname'], []);

					$.ajax({
						url: '{{asset('client1/request/customQuery/getAncillary')}}',
						dataType: "json", 
        				async: false,
						method: 'POST',
						data: {_token:$("input[name=_token]").val(),id: $(this).val()},
						success: function(a){
							arrAddon.push(JSON.parse(a));
						}
					})
					findSelName(this.id, 'hgpid', arrAddon[0], 'oAnc', ['facid', 'facname'], []);

				});
			}
			document.getElementById('ocid').addEventListener('change', function() {
				findSelName(this.id, 'ocid', 'mclass', 'classid', ['classid', 'classname'], ['subClassid'], []);
			});
			document.getElementById('classid').addEventListener('change', function() {
				findSelName(this.id, 'isSub', 'msubclass', 'subClassid', ['classid', 'classname'], [], []);
			});
			for(let j = 0; j < document.getElementsByClassName('addCLick').length; j++) {
				if(document.getElementsByClassName('addCLick')[j] != null || document.getElementsByClassName('addCLick')[j] != undefined) 
					{ 
						document.getElementsByClassName('addCLick')[j].addEventListener('click', function(e) {
						let target = e.target || window.event.target;
						if(target.name == "facid") {
							fSelServ(target.name);
						}
				}); }
			}
			procChkSelData();
		})();
		$(function () {
		  	$('[data-toggle="tooltip"]').tooltip()
		});



		// $("input[name=hgpid]").click(function(){
		// 	let apString = "";
		// 	$.ajax({
		// 		url: '{{asset('client1/request/customQuery/getAncillary')}}',
		// 		method: 'POST',
		// 		data: {_token:$("input[name=_token]").val(),id: $(this).val()},
		// 		success: function(a){
		// 			let oAnc = $("#oAnc");
		// 			a = JSON.parse(a);
		// 			if(oAnc != undefined || oAnc != null) {
		// 				if(a.length > 0) {
		// 					oAnc.innerHTML = '';
		// 					for(let i = 0; i < a.length; i++) {
		// 						apString += '<div class="col-md-3"><div class="custom-control custom-checkbox mr-sm-2">'+
		// 								        '<input type="checkbox" class="custom-control-input" id="'+a[i]['facid']+'" name="facid" value="'+a[i]['facid']+'">'+
		// 								        '<label class="custom-control-label" for="'+a[i]['facid']+'">'+a[i]['facname']+'</label>'+
		// 								    '</div></div>';
		// 					}
		// 					apString += '</div>';
		// 					oAnc.empty().append(apString);
		// 				} else {
		// 					oAnc.innerHTML = '<tr><td colspan="2">No Service Capabilities selected.</td></tr>';
		// 				}
		// 			}
		// 		}
		// 	})
		// })
	</script>
	@if(! isset($hideExtensions))
		@include('client1.cmp.footer')
	@endif
</body>
@endsection