@extends('main')
@section('content')
@include('client1.cmp.__apply')
<style>
	@media print{
		
		footer, nav, button, #navBarWiz, div.dfn-hover, span.text-danger{
			display: none!important;
		}
		div.alert-warning{
			font-size: 10px;
		}

	}

	dfn {
	  cursor: help;
	  font-style: normal;
	  position: relative;
	  
	}
	dfn::after {
	  content: attr(data-info);
	  white-space: pre;
	  display: inline;
	  position: absolute;
	  top: 22px; left: 0;
	  opacity: 0;
	  width: 230px;
	  font-size: 13px;
	  font-weight: 700;
	  line-height: 1.5em;
	  padding: 0.5em 0.8em;
	  background: rgba(0,0,0,0.8);
	  color: #fff;
	  pointer-events: none; /* This prevents the box from apearing when hovered. */
	  transition: opacity 250ms, top 250ms;
	}
	dfn::before {
	  content: '';
	  display: block;
	  position: absolute;
	  top: 12px; left: 10px;
	  opacity: 0;
	  width: 0; height: 0;
	  border: solid transparent 5px;
	  border-bottom-color: rgba(0,0,0,0.8);
	  transition: opacity 250ms, top 250ms;
	}
	dfn:hover {z-index: 2;} /* Keeps the info boxes on top of other elements */
	dfn:hover::after,
	dfn:hover::before {opacity: 1;}
	dfn:hover::after {top: 40px;}
	dfn:hover::before {top: 30px;}
</style>
<body>
	@include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb')
	@include('client1.cmp.msg')
	@include('client1.cmp.__wizard')
	{{csrf_field()}}
	<div class="container mt-5 mb-5">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="offset-1 col-md-3 hide-div d-flex justify-content-end">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 60px; padding-left: 20px;">
					</div>
					<div class="col-md-3 text-left">
						<h5 class="card-title text-uppercase text-center">Application Form</h5>
						{{-- <h6 class="card-subtitle mb-2 text-center text-muted"><span id="tForm">New</span> Application</h6> --}}
					</div>
					{{-- <div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 60px; padding-right: 20px;">
					</div> --}}
				</div>
			</div>
			<div class="card-body">
				<div id="_errMsg"></div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
					<div class="col">
						<p>Application</p>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="container alert alert-warning mt-3 mb-3 text-center">
						Please note: Red asterisk (<span class="req"></span>) is a required field and may be encountered throughout the system
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="col-md-5">
						<p class="req">Type of Application:</p>
						<div class="mb-3">
							<select class="form-control" id="hfser_id" name="hfser_id" autocomplete="off" required>
								<option selected disabled value hidden>Please select</option>
								@if(count($hfaci) > 0) @foreach($hfaci AS $each)
								<option value="{{$each->hfser_id}}">{{$each->hfser_desc}}</option>
								@endforeach @endif
							</select>
						</div>
					</div>
					<div class="col-md-7">
						<p class="req">Facility Name:</p>
						<div class="input-group mb-3">
						  	<input type="text" class="form-control" placeholder="Facility name" aria-label="Facility name" aria-describedby="basic-addon2" id="facilityname" name="facilityname" style="text-transform: uppercase;">
						  	<div class="input-group-append" data-toggle="tooltip" data-placement="top" title="Manually search existing Facility">
						    	<button class="btn btn-dark" type="button" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-info"></i></button>
						  	</div>
						</div>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
					<div class="col">
						<p><span class="faciDet"></span>Facility Address</p>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="col-md-3">
						<p class="req">Region:</p>
						<div class="mb-3">
							<select class="form-control" id="rgnid" name="rgnid" autocomplete="off" required>
								<option selected disabled value hidden>Please select</option>
								@if(count($region) > 0) @foreach($region AS $each)
								<option value="{{$each->rgnid}}">{{$each->rgn_desc}}</option>
								@endforeach @endif
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<p class="req">Province/District:</p>
						<div class="mb-3">
							<select class="form-control" id="provid" name="provid" autocomplete="off" required>
								<option selected disabled value hidden>Please select</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<p class="req">City/Municipality</p>
						<div class="mb-3">
							<select class="form-control" id="cmid" name="cmid" autocomplete="off" required>
								<option selected disabled value hidden>Please select</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<p class="req">Barangay:</p>
						<div class="mb-3">
							<select class="form-control" id="brgyid" name="brgyid" autocomplete="off" required>
								<option selected disabled value hidden>Please select</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="col-md-6">
						<div class="row col-border-right">
							<div class="col-md-4">
								<p>Street Number:</p>
								<div class="mb-3">
									<input style="text-transform: uppercase;" type="text" class="form-control" name="street_number" id="street_number" placeholder="Street Number">
								</div>
							</div>
							<div class="col-md">
								<p>Street name:</p>
								<div class="mb-3">
									<input style="text-transform: uppercase;" type="text" class="form-control" name="street_name" id="street_name" placeholder="Street Name">
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<p class="req">Zip Code:</p>
						<span class="text-danger">NOTE:</span> for reference, please follow this <a href="https://www.phlpost.gov.ph/zip-code-search.php" target="_blank">link</a>
						<div class="mb-3">
							<input type="number" class="form-control" name="zipcode" id="zipcode" placeholder="Zip Code">
						</div>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
					<div class="col">
						<p><span class="faciDet"></span>Facility Contact Details</p>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="col-md-3">
						<p class="req">Facility Mobile No.:</p>
						<div class="mb-3">
							<input type="number" class="form-control" id="contact" name="contact" placeholder="Facility Mobile No." autocomplete="off" required>
						</div>
					</div>
					<div class="col-md-3">
						<p>Facility Landline:</p>
						<div class="mb-3">
							<div class="row">
								<div class="col-md-5">
									<input type="number" class="form-control" id="areacode" name="areacode" placeholder="Area Code" autocomplete="off">
								</div>
								<div class="col-md-7">
									<input type="number" class="form-control" id="landline" name="landline" placeholder="Facility Landline" autocomplete="off" required>
								</div>
							</div>							
						</div>
					</div>
					<div class="col-md-3">
						<p>Fax Number:</p>
						<div class="row mb-3">
							<div class="col-md-5">
								<input type="number" class="form-control" id="areacode" name="areacode" placeholder="Area Code" autocomplete="off">
							</div>
							<div class="col-md-7">
								<input type="number" class="form-control" id="faxNumber" name="faxNumber" placeholder="Fax Number" autocomplete="off" required>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<p class="req">Facility Email Address:</p>
						<div class="mb-3">
							<input type="text" class="form-control" id="email" name="email" placeholder="Facility Email Address" autocomplete="off" required>
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
						<p class="req">Ownership:</p>
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
						<p class="req">Classification:</p>
						<div class="mb-3">
							<select class="form-control" id="classid" name="classid">
								<option selected value hidden disabled>Please select</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<p>Sub Classification:</p>
						<div class="mb-3">
							<select class="form-control" id="subClassid" name="subClassid">
								<option selected value hidden disabled>Please select</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="col-md-6">
						<p class="">Institutional Character: <span class="text-danger" style="font-size: 20px;">*</span> 
						{{-- <small class="text-danger">Note: Not Applicable for Hospital</small></p> --}}
						<div class="mb-3">
							<div class="row">
								<div class="col-md-11">
									<select class="form-control" id="facmode" name="facmode">
										<option selected value hidden disabled>Please select</option>
										@foreach($facmode AS $each)
										<option value="{{$each->facmid}}">{{$each->facmdesc}}</option>
										@endforeach
									</select>
								</div>
								<div class="col-md-1 pt-1 dfn-hover" style="font-size: 30px;">
									<dfn data-info="Institution Based &#xa;- A health Facility that is located  &#xa; within the premises and operates  &#xa; as part of an institution &#xa;  &#xa; Free Standing  &#xa; - A health Facility that is not&#xa;attached to an insitution and&#xa;operates independently &#xa;  &#xa; Hospital Based  &#xa; - A health Facility that is located in &#xa; a Hospital
									"><i class="fa fa-question-circle" aria-hidden="true"></i></dfn>
								</div>
							</div>
						</div>
						<div class="mb-3">
							
						</div>
					</div>
					<div class="col-md-6">
						<p class="req">Function:</p>
						<div class="mb-3">
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
					<div class="col-md-12">
						<p>
							<p class="pull-left">Owner Details</p>
							<div class="pull-right" hidden>
								<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="customCheck1">
								  	<label class="custom-control-label" for="customCheck1">Applicant is the same as the owner</label>
								</div>
							</div>
						</p>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="col-md-12">
						<p class="req">Owner :</p>
						<div class="mb-3">
							{{-- <span class="text-danger">Note: The applicant must be the same as the owner</span> --}}
							<input type="text" class="form-control" id="owner" name="owner" placeholder="Owner (Name/Company/Organization)" autocomplete="off" required <?=((isset($applicationType) && !empty($applicationType) && ($applicationType === 'edit')) ? 'disabled' : '')?>>
						</div>
						{{-- <p>For Corporation:</p> --}}
						<div class="mb-3 alert alert-warning">
							For Sole-proprietorship,
							<ul class="list-unstyled" style="font-size: small">
								<li>
									Name of the owner must be the same as your DTI-Business Name Registration
								</li>
							</ul>
							For Partnership and Corporation,
							<ul class="list-unstyled" style="font-size: small">
								<li>
									Name of the owner must be the same as your SEC Registration
								</li>
							</ul>
							For Cooperative,
							<ul class="list-unstyled" style="font-size: small">
								<li>
									Name of the owner must be the same as your Cooperative Development Authority Registration
								</li>
							</ul>
							For Government Facilities,
							<ul class="list-unstyled" style="font-size: small">
								<li>
									Please refer to your Enabling Act/Board Resolution
								</li>
							</ul>
							{{-- <span class="alert alert-warning" style="font-size: small">For <i>sole-proprietorship, partnership, Corporation</i>, please refer to your SEC Registration for the Business Name</span> --}}
						</div>
					</div>
					{{-- <div class="col-md-6">
					</div> --}}
				</div><div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
					<div class="col">
						<p class="req">Proponent/Owner Contact Details</p>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="col-md-4">
						<p class="req">Proponent/Owner Mobile No.:</p>
						<div class="mb-4">
							<input type="number" class="form-control" id="ownerMobile" name="ownerMobile" placeholder="Proponent/Owner Mobile No." autocomplete="off" required>
						</div>
					</div>
					<div class="col-md-4">
						<p>Proponent/Owner Landline:</p>
						<div class="mb-4">
							<div class="row">
								<div class="col-md-4">
									<input type="number" class="form-control" id="areacode" name="areacode" placeholder="Area Code" autocomplete="off">
								</div>
								<div class="col-md-8">
									<input type="number" class="form-control" id="ownerLandline" name="ownerLandline" placeholder="Proponent/Owner Landline" autocomplete="off" required>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<p class="req">Proponent/Owner Email Address:</p>
						<div class="mb-4">
							<input type="text" class="form-control" id="ownerEmail" name="ownerEmail" placeholder="Proponent/Owner Email Address" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="col-md-12">
						<p class="req">Official Mailing Address:</p>
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="same" name="example1">
							    <label class="custom-control-label" for="same">Official Mailing address same as Facility Address? If no, please specify complete address</label>
							</div>
						<div class="mb-3">
							<input type="text" class="form-control" id="mailingAddress" name="mailingAddress" placeholder="Official Mailing Address" autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
					<div class="col-md-12">
						<p>
							<p class="pull-left required">Approving Authority Details</p>
							<div class="pull-right" hidden>
								<div class="custom-control custom-checkbox">
								  	<input type="checkbox" class="custom-control-input" id="customCheck1">
								  	<label class="custom-control-label" for="customCheck1">Applicant is the same as the owner</label>
								</div>
							</div>
						</p>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
					<div class="col-md-6">
						<p class="req">Approving Authority Position/Designation:</p>
						<div class="mb-4">
							{{-- <input type="text" class="form-control" id="approvingauthoritypos" name="approvingauthoritypos" placeholder="Approving Authority Position/Designation." autocomplete="off" required> --}}
							<select id="approvingauthoritypos" name="approvingauthoritypos" class="form-control" required autocomplete="off">
							  <option value="" selected="" hidden >Please Select</option>
	                          <option value="President">President</option>
	                          <option value="Owner">Owner</option>
	                          <option value="Head of Facility">Head of Facility</option>
	                          {{-- <option value="others">Others</option> --}}
	                        </select>
						</div>
					</div>
					<div class="col-md-6">
						<p class="req">Approving Authority Full Name:</p>
						<div class="mb-4">
							<input type="text" class="form-control" id="approvingauthority" name="approvingauthority" placeholder="Approving Authority Full Name." autocomplete="off" required>
						</div>
					</div>
				</div>
				<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
					
				</div>
			</div>
			<div class="card-footer">
				<div class="pull-right">
					<a href="{{asset('client1/apply')}}"><button class="btn btn-danger">Cancel</button></a>
					<button class="btn btn-info" data-toggle="modal" data-target="#confirmModal">Submit Form</button>
					<button class="btn btn-success" id="saveDraft">Save as Draft</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Facility Name</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div class="row mb-3">
				<div class="col-sm-8">
				</div>
				{{-- <div class="col-sm-4">
					<div class="pull-left">
						<span id="cur">1</span> out of <span>{{count($appFacName)}}</span> page(s).
					</div>
					<div class="pull-right">
						<button class="btn btn-danger" id="prev"><i class="fa fa-arrow-circle-left" id="prev"></i></button>
						<button class="btn btn-danger" id="next"><i class="fa fa-arrow-circle-right" id="next"></i></button>
					</div>
				</div> --}}
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="tApp">
					<thead class="thead-dark">
						<tr>
							<th rowspan="2" style="vertical-align: middle; text-align: center;">Facility Name</th>
							<th colspan="4" style="vertical-align: middle; text-align: center;">Location</th>
						</tr>
						<tr>
							<th style="vertical-align: middle; text-align: center;">Region</th>
							<th style="vertical-align: middle; text-align: center;">Province</th>
							<th style="vertical-align: middle; text-align: center;">City/Municipality</th>
							<th style="vertical-align: middle; text-align: center;">Barangay</th>
						</tr>
					</thead>
					<tbody>
					@if(count($appFacName) > 0) @foreach($appFacName AS $each)
						<tr>
							<td><a data-dismiss="modal" onclick="document.getElementsByName('facilityname')[0].value = '{{$each->facilityname}}';" href="javascript:void(0);">{{$each->facilityname}}</a></td>
							<td>{{$each->rgn_desc}}</td>
							<td>{{$each->provname}}</td>
							<td>{{$each->cmname}}</td>
							<td>{{$each->brgyname}}</td>
						</tr>
					@endforeach @else
						<tr>
							<td colspan="2">No Facility</td>
						</tr>
					@endif
				</table>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
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
	      			<strong>Are you sure you want to submit form?</strong><br>
	      			<label class="lead">Please <strong>check and review</strong> your application form before submitting.</label>
	      		</div>
	      	</div>
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-primary" onclick="setTimeout(function() {window.print()}, 10); " data-dismiss="modal"><i class="fa fa-print"></i> Preview</button>
	      	<button type="button" onclick="setTimeout(function() { window.scroll({top: 0, left: 0, behavior: 'smooth'}) }, 500)" class="btn btn-danger" data-dismiss="modal">No, Recheck details</button>
	        <button type="button" class="btn btn-success" data-dismiss="modal" id="subForm">Proceed</button>
	      </div>
	    </div>
	  </div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";

		// var ___div = document.getElementById('__applyBread'), ___wizardcount = document.getElementsByClassName('wizardcount');
		// document.getElementById('stepDetails').innerHTML = 'Step 1: Facility Profile';
		// if(___wizardcount != null || ___wizardcount != undefined) {
		// 	for(let i = 0; i < ___wizardcount.length; i++) {
		// 		if(i < 0) {
		// 			___wizardcount[i].parentNode.classList.add('past');
		// 		}
		// 		if(i == 0) {
		// 			___wizardcount[i].parentNode.classList.add('active');
		// 		}
		// 	}
		// }
		// if(___div != null || ___div != undefined) {
		// 	___div.classList.remove('active');
		// 	___div.classList.add('text-primary');
		// }
		var mclass = JSON.parse('{!!$class!!}'), 

		msubclass = JSON.parse('{!!$subclass!!}'), 

		// mappform = JSON.parse('{!!($fAddress ?? json_encode(['']))!!}'),

		mservfac = JSON.parse('{!!($servfac ?? json_encode(['']))!!}'),

		mptcdet = JSON.parse('{!!($ptcdet ?? json_encode(['']))!!}');

		var curAppid = ""
		
		function findSelName(elName, colName, tblName, insId, arrCol, clId, servFilter = null) {
			let dom = document.getElementsByName(elName), arr = [], forDispArr = [], hgValues = [];
			let procTbl = function(eDom) {
			 window[tblName].forEach(function(a, b, c) {
			  if(a[colName] == eDom.value) {
			   	arr.push(a); 
			  } 
				}); 
			};
			if(dom != null || dom != undefined) {
				for(let i = 0; i < dom.length; i++) {
					 if(insId == 'serv_cap') {
					  if(dom[i].checked) { procTbl(dom[i]); 
					  } 
					} else { 
						procTbl(dom[i]); 
					} 
				}
				arr.forEach( function(element, index) {
					hgValues.push(element['hgpid']);
				});
				let idom = document.getElementById(insId);
				if(idom != null || idom != undefined) { if(arr.length > 0) {
					if(arr.length == 1) { arr[0].ischecked = 'checked'; }
					let apString = "", selString = '<option selected value hidden disabled>Please select</option>';
					for(let i = 0; i < Math.ceil(arr.length/4); i++) {
						let iMin = i * 4, iMax = iMin + 4, mMax = ((iMax > arr.length) ? arr.length : iMax);
						apString += '<div class="row">';
						for(let j = iMin; j < mMax; j++) {
							selString += '<option value="'+arr[j][arrCol[0]]+'">'+arr[j][arrCol[1]]+'</option>';
							if(servFilter != null && servFilter == 6){
							apString += '<div class="col-md-3"><div class="custom-control custom-radio mr-sm-2">'+
									        '<input type="radio" class="custom-control-input" id="'+arr[j][arrCol[0]]+'" name="facid" value="'+arr[j][arrCol[0]]+'" '+((arr[j]['ischecked'] != undefined || arr[j]['grphrz_name'] != null) ? arr[j]['ischecked'] : "")+'>'+
									        '<label class="custom-control-label" for="'+arr[j][arrCol[0]]+'">'+arr[j][arrCol[1]]+'</label>'+
									    '</div></div>';
							} else {
								apString += '<div class="col-md-3"><div class="custom-control custom-radio mr-sm-2">'+
									        '<input type="radio" class="custom-control-input" id="'+arr[j][arrCol[0]]+'" name="facid" value="'+arr[j][arrCol[0]]+'" '+((arr[j]['ischecked'] != undefined || arr[j]['grphrz_name'] != null) ? arr[j]['ischecked'] : "")+'>'+
									        '<label class="custom-control-label" for="'+arr[j][arrCol[0]]+'">'+arr[j][arrCol[1]]+'</label>'+
									    '</div></div>';
							}
						}
						apString += '</div>';
					}
					idom.innerHTML = ((insId == 'serv_cap') ? apString : selString);
					if(Array.isArray(clId)) { for(let i = 0; i < clId.length; i++) { document.getElementById(clId[i]).innerHTML = ((insId == 'serv_cap') ? '' : '<option selected value hidden disabled>Please select</option>'); } }
				} else { idom.innerHTML = ((insId == 'serv_cap') ? '' : '<option selected value hidden disabled>Please select</option>'); } }
			}
		}

		(function() {

			// $("#facilityname").keyup(function(){
			// 	$(this).val(this.value = this.value.toUpperCase());
			// })
			let curInfOf = 0, event = document.createEvent('Event'), canProc = 0, forLoadOld = 0, appid = "", isICR = false;
			let curUser = JSON.parse('{!!$curUserDet!!}'), curForm = JSON.parse('{!!addslashes($curForm)!!}');
			$(document).on('change','#same', function(event){
				if($(this).prop('checked') == true){
					if($("#street_name").val() != null && $("#cmid option:selected").val() != "" && $("#provid option:selected").val() != "" && $("#brgyid option:selected").val() != "" && $("#rgnid option:selected").val() != ""){
					$('#mailingAddress').val(($('#street_number').val() != "" ? $('#street_number').val() : "") + " " + $("#street_name").val() + " " + $("#brgyid option:selected").text().toUpperCase() + " " + $("#cmid option:selected").text().toUpperCase() + " " + $("#provid option:selected").text().toUpperCase() + " " +  $("#rgnid option:selected").text().toUpperCase());
					} else {
						this.checked = false;
    					event.preventDefault();
						alert('Please select facility address first!');
					}
				} else {
					$('#mailingAddress').val('');
				}
			});
			let _obj = {rgnid: "province", provid: "city_muni", cmid: "barangay"}, _arrName = {rgnid: "provid", provid: "cmid", cmid: "brgyid"}, _arrCol = {rgnid: ["provid", "provname"], provid: ["cmid", "cmname"], cmid: ["brgyid", "brgyname"]}, _arrQCol = {rgnid: "rgnid", provid: "provid", cmid: "cmid"}, _allObj = ["rgnid", "provid", "cmid", "brgyid"];
			for(let i = 0; i < _allObj.length; i++) {
				if(document.getElementsByName(_allObj[i])[0] != undefined || document.getElementsByName(_allObj[i])[0] != null) {
					document.getElementsByName(_allObj[i])[0].addEventListener('change', function() {
						procAfter(this.name);
					});
				}
			}
			if(curForm.length > 0) {
				appid = curForm[0]['appid'];
				if(curForm[0]['aptid'] in { IC: "IC", R: "R" }) {
					isICR = true;
				}
			}
			function procAfter(tName) {
				if(tName in _arrName) {
					let curDom = document.getElementsByName(_arrName[tName])[0], curInOf = _allObj.indexOf(tName);
					curDom.classList.add('loading');
					if(curInOf > -1) {
						for(var i = (curInOf + 1); i < _allObj.length; i++) {
							document.getElementsByName(_allObj[i])[0].innerHTML = '<option value hidden selected disabled>Please select</option>';
						}
					}
					sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "rTbl="+_arrQCol[tName], "rId="+document.getElementsByName(tName)[0].value], "{{asset('client1/request')}}/"+_obj[tName], "POST", true, {
						functionProcess: function(arr) {				
							if(curDom != undefined || curDom != null) {
								curDom.innerHTML = '<option value hidden selected disabled>Please select</option>';
								arr.forEach(function(a, b, c) {
									curDom.innerHTML += '<option value="'+a[_arrCol[tName][0]]+'">'+a[_arrCol[tName][1]]+'</option>';
								});
								curDom.classList.remove('loading');
								canProc = 1;
							}
						}
					});
				}
			}
			document.getElementById('customCheck1').addEventListener('change', function(e) {
				let doms = ["owner", "contact", "email", 'street_number', 'street_name', 'zipcode', 'landline', 'faxNumber', 'ownerMobile', 'ownerLandline', 'ownerEmail', 'mailingAddress', 'areacode','ocid','classid','subClassid','facmode','funcid','approvingauthority','approvingauthoritypos'], cols = ["authorizedsignature", "contact", "email", 'street_number', 'street_name', 'zipcode', 'landline', 'faxNumber', 'ownerMobile', 'ownerLandline', 'ownerEmail', 'mailingAddress', 'areacode','ocid','classid','subClassid','facmode','funcid','approvingauthority','approvingauthoritypos'];
				forLoadOld = 0;
				this.disabled = true;
				if(this.checked) {
					for(var i = 0; i < doms.length; i++) {
						let curDom = document.getElementsByName(doms[i])[0];
						if(curDom != null || curDom != undefined) {
							curDom.value = curUser[0][cols[i]];
						}
					}
					forLoadFunc(true);
				} else {
					for(var i = 0; i < doms.length; i++) {
						let curDom = document.getElementsByName(doms[i]);
						if(doms[i] == "areacode") {
							if(curForm[0][doms[i]] != null) { let curValDom = JSON.parse(curForm[0][doms[i]]);  for(let j = 0; j < curValDom.length; j++) { if(curDom[j] != null || curDom[j] != undefined) {
								curDom[j].value = curValDom[j];
							} } }
						} else {
							if(curDom[0] != null || curDom[0] != undefined) {
								curDom[0].value = ((curForm.length > 0) ? curForm[0][doms[i]] : "");
							}
						}
					}
					forLoadFunc(false);
				}
				this.disabled = false;
			});
			function forLoadFunc(bool) {
				let j = forLoadOld + 1, intVal, curDom = document.getElementsByName(_allObj[forLoadOld])[0], arrCols = ["rgnid", "province", "city_muni", "barangay"]; clearInterval(intVal); canProc = 0;
				if(curDom != null || curDom != undefined) {
					if(bool || (!bool && curForm.length > 0)) {
						curDom.value = ((!bool && curForm.length > 0) ? curForm[0][_allObj[forLoadOld]] : curUser[0][arrCols[forLoadOld]]);
						procAfter(_allObj[forLoadOld]);
						intVal = setInterval(function() {
							if(canProc > 0) {
								clearInterval(intVal);
								if((forLoadOld + 1) <= (_allObj.length - 1)) {
									forLoadOld = forLoadOld + 1;
									forLoadFunc(bool);
								}
							}
						}, -1);
					} else {
						if(forLoadOld > 0) {
							curDom.innerHTML = '<option value hidden selected disabled>Please select</option>';
						} else {
							curDom.value = "";
						}
						if((forLoadOld + 1) <= (_allObj.length - 1)) {
							forLoadOld = forLoadOld + 1;
							forLoadFunc(bool);
						}
					}
				}
			}
			function anNext(inOf) {
				let div = document.getElementsByClassName('appDet');
				if(! isNaN(inOf)) {
					curInfOf = (((curInfOf + inOf) > (div.length - 1)) ? curInfOf : (((curInfOf + inOf) < 0) ? curInfOf : (curInfOf + inOf)));
					for(var i = 0; i < div.length; i++) {
						div[i].setAttribute('hidden', true);
					}
					div[curInfOf].removeAttribute('hidden');
					document.getElementById('cur').innerHTML = ((div.length > 1) ? (curInfOf + 1) : 0);
				}
			}
			document.body.addEventListener('click', function(e) {
				let _target = e.target || window.event.target;
				switch(_target.id) {
					case 'next':
						anNext(1);
						break;
					case 'prev':
						anNext(-1);
						break;
				}
			});
			document.getElementById('subForm').addEventListener('click', function(e) {
				let hfser_id = document.getElementById('hfser_id'), 
					facilityname = document.getElementById('facilityname'), 
					owner = document.getElementById('owner'), 
					rgnid = document.getElementById('rgnid'), 
					provid = document.getElementById('provid'), 
					cmid = document.getElementById('cmid'), 
					brgyid = document.getElementById('brgyid'), 
					contact = document.getElementById('contact'), 
					email = document.getElementById('email'), 
					uid = document.getElementById('uid'), 
					street_name = document.getElementById('street_name'), 
					street_number = document.getElementById('street_number'), 
					zipcode = document.getElementById('zipcode'), 
					landline = document.getElementById('landline'), 
					mailingAddress = document.getElementById('mailingAddress'), 
					faxNumber = document.getElementById('faxNumber'),
					ownerMobile = document.getElementById('ownerMobile'),
					ownerLandline = document.getElementById('ownerLandline'),
					ownerEmail = document.getElementById('ownerEmail'), 
					areacode = document.getElementsByName('areacode'),
					ocid = document.getElementById('ocid'), 
					classid = document.getElementById('classid'), 
					subClassid = document.getElementById('subClassid'), 
					facmode = document.getElementById('facmode'), 
					funcid = document.getElementById('funcid'), 
					approvingauthority = document.getElementById('approvingauthority'), 
					approvingauthoritypos = document.getElementById('approvingauthoritypos'), 
					mareacode = [];
				if(areacode != undefined || areacode != null) { 
					for(let i = 0; i < areacode.length; i++) { 
						mareacode.push(areacode[i].value) 
					} 
				}
				if((
					hfser_id != null || 
					hfser_id != undefined
				) && (
					facilityname != null || 
					facilityname != undefined
				) && (
					owner != null || 
					owner != undefined
				) && (
					rgnid != null || 
					rgnid != undefined
				) && (
					provid != null || 
					provid != undefined
				) && (
					cmid != null || 
					cmid != undefined
				) && (
					brgyid != null || 
					brgyid != undefined
				) && (
					contact != null || 
					contact != undefined
				) && 
				(/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(contact.value)) && 
				(email != null || email != undefined) && /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email.value) && 
				(uid != null || uid != undefined) && 
				(street_name != null || street_name != undefined) && 
				(street_number != null || street_number != undefined) && 
				(zipcode != null || zipcode != undefined) && 
				(mailingAddress != null || mailingAddress != undefined) && 
				(ownerMobile != null || ownerMobile != undefined) && (/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(contact.value)) && (ownerEmail != null || ownerEmail != undefined) && /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(ownerEmail.value)) {
					insErrMsg('warning', 'Sending request.');
					sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, 'hfser_id='+hfser_id.value, 'facilityname='+facilityname.value.toUpperCase(), 'owner='+owner.value, 'rgnid='+rgnid.value, 'provid='+provid.value, 'cmid='+cmid.value, 'brgyid='+brgyid.value, 'contact='+contact.value, 'email='+email.value, 'uid='+uid.value, 'street_name='+street_name.value, 'street_number='+street_number.value, 'faxNumber='+faxNumber.value, 'zipcode='+zipcode.value, 'landline='+landline.value, 'mailingAddress='+mailingAddress.value.toUpperCase(), 'ownerMobile='+ownerMobile.value, 'ownerLandline='+ownerLandline.value, 'ownerEmail='+ownerEmail.value, 'appid='+appid, 'areacode='+JSON.stringify(mareacode), 'ocid='+ocid.value, 'classid='+classid.value, 'subClassid='+subClassid.value, 'facmode='+facmode.value, 'funcid='+funcid.value, 'approvingauthority='+approvingauthority.value,'approvingauthoritypos='+approvingauthoritypos.value,'draft='], "{{asset('client1/request/customQuery/fApply')}}", "POST", true, {
						functionProcess: function(arr) {
							if(arr == true) {
								// if(appid == "") {
									// getLatestAppformId("{{asset('client1/request/customQuery/fGetAppformIdLatest')}}", "{{asset('client1/apply/app')}}");
									getLatestAppformId("{{asset('client1/request/customQuery/fGetAppformIdLatest')}}", "{{asset('client1/apply/app')}}", isICR);
								// } else {
								// 	window.location.href = "{{asset('client1/home')}}";
								// }
							} else {
								insErrMsg('danger', arr);
								window.scrollTo(500, 0);
							}
						}
					});
				} else {
					if(/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(contact.value) == false){
						alert('Please Input proper and Valid Philippine mobile Number');
					}
					// if(/^[+]?[\d]+([\-][\d]+)*\d$/.test(landline.value) == false){
					// 	alert('Please Input proper and Valid Philippine telephone Number');
					// }
					if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email.value) == false){
						alert('Please Input proper and Valid email Address');
					}
					if(/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(ownerMobile.value) == false){
						alert('Please Input proper and Valid Philippine mobile Number on Proponent/Owner Details');
					}
					// if(/^[+]?[\d]+([\-][\d]+)*\d$/.test(ownerLandline.value) == false){
					// 	alert('Please Input proper and Valid Philippine telephone Number on Proponent/Owner Details');
					// }
					if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(ownerEmail.value) == false){
						alert('Please Input proper and Valid email Address on Proponent/Owner Details');
					}
				}
			});

			//draft
			document.getElementById('saveDraft').addEventListener('click', function(e) {
				let hfser_id = document.getElementById('hfser_id'), 
					facilityname = document.getElementById('facilityname'), 
					owner = document.getElementById('owner'), 
					rgnid = document.getElementById('rgnid'), 
					provid = document.getElementById('provid'), 
					cmid = document.getElementById('cmid'), 
					brgyid = document.getElementById('brgyid'), 
					contact = document.getElementById('contact'), 
					email = document.getElementById('email'), 
					uid = document.getElementById('uid'), 
					street_name = document.getElementById('street_name'), 
					street_number = document.getElementById('street_number'), 
					zipcode = document.getElementById('zipcode'), 
					landline = document.getElementById('landline'), 
					mailingAddress = document.getElementById('mailingAddress'), 
					faxNumber = document.getElementById('faxNumber'), 
					ownerMobile = document.getElementById('ownerMobile'),
					ownerLandline = document.getElementById('ownerLandline'),
					ownerEmail = document.getElementById('ownerEmail'), 
					areacode = document.getElementsByName('areacode'),
					ocid = document.getElementById('ocid'), 
					classid = document.getElementById('classid'), 
					subClassid = document.getElementById('subClassid'), 
					facmode = document.getElementById('facmode'), 
					funcid = document.getElementById('funcid'), 
					approvingauthority = document.getElementById('approvingauthority'), 
					approvingauthoritypos = document.getElementById('approvingauthoritypos'), 
					mareacode = [];
				if(areacode != undefined || areacode != null) { for(let i = 0; i < areacode.length; i++) { mareacode.push(areacode[i].value) } }
				if((hfser_id != null || hfser_id != undefined) && (facilityname != null || facilityname != undefined) && (owner != null || owner != undefined) && (rgnid != null || rgnid != undefined) && (provid != null || provid != undefined) && (cmid != null || cmid != undefined) && (brgyid != null || brgyid != undefined) && (contact != null || contact != undefined) && (/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(contact.value)) && (email != null || email != undefined) && /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email.value) && (uid != null || uid != undefined) && (street_name != null || street_name != undefined) && (street_number != null || street_number != undefined) && (zipcode != null || zipcode != undefined) && (mailingAddress != null || mailingAddress != undefined) && (ownerMobile != null || ownerMobile != undefined) && (/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(contact.value)) && (ownerEmail != null || ownerEmail != undefined) && /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(ownerEmail.value)) {
					insErrMsg('warning', 'Sending request.');
					sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, 'hfser_id='+hfser_id.value, 'facilityname='+facilityname.value, 'owner='+owner.value, 'rgnid='+rgnid.value, 'provid='+provid.value, 'cmid='+cmid.value, 'brgyid='+brgyid.value, 'contact='+contact.value, 'email='+email.value, 'uid='+uid.value, 'street_name='+street_name.value, 'street_number='+street_number.value, 'faxNumber='+faxNumber.value, 'zipcode='+zipcode.value, 'landline='+landline.value, 'mailingAddress='+mailingAddress.value, 'ownerMobile='+ownerMobile.value, 'ownerLandline='+ownerLandline.value, 'ownerEmail='+ownerEmail.value, 'appid='+appid, 'areacode='+JSON.stringify(mareacode), 'ocid='+ocid.value, 'classid='+classid.value, 'subClassid='+subClassid.value, 'facmode='+facmode.value, 'funcid='+funcid.value, 'approvingauthority='+approvingauthority.value,'approvingauthoritypos='+approvingauthoritypos.value,'draft=1'], "{{asset('client1/request/customQuery/fApply')}}", "POST", true, {
						functionProcess: function(arr) {
							if(arr == true) {
								alert('Saved');
								location.reload();
							} else {
								insErrMsg('danger', arr);
								window.scrollTo(500, 0);
							}
						}
					});
				} else {
					if(/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(contact.value) == false){
						alert('Please Input proper and Valid Philippine mobile Number');
					}
					// if(/^[+]?[\d]+([\-][\d]+)*\d$/.test(landline.value) == false){
					// 	alert('Please Input proper and Valid Philippine telephone Number');
					// }
					if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email.value) == false){
						alert('Please Input proper and Valid email Address');
					}
					if(/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(ownerMobile.value) == false){
						alert('Please Input proper and Valid Philippine mobile Number on Proponent/Owner Details');
					}
					// if(/^[+]?[\d]+([\-][\d]+)*\d$/.test(ownerLandline.value) == false){
					// 	alert('Please Input proper and Valid Philippine telephone Number on Proponent/Owner Details');
					// }
					if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(ownerEmail.value) == false){
						alert('Please Input proper and Valid email Address on Proponent/Owner Details');
					}
				}
			});


			if(curForm.length > 0) {
				// document.getElementById('tForm').innerHTML = "Edit";
				document.getElementsByName('hfser_id')[0].value = curForm[0]['hfser_id'];
				document.getElementsByName('facilityname')[0].value = curForm[0]['facilityname'];
				event.initEvent('change', false, true);
				document.getElementById('customCheck1').dispatchEvent(event);
			}
			// anNext(curInfOf);
		})();
		$(function () {
		  	$('[data-toggle="tooltip"]').tooltip();
		  	// $('#tApp').DataTable({
		  	// 	"pageLength": 5
		  	// });
		  	$("#hfser_id").trigger('change');
		});
		$("#hfser_id").change(function(event) {
			if($(this).val() == 'CON' || $(this).val() == 'PTC'){
				preAppendText($(".faciDet"),'Proposed ');
			} else {
				$(".faciDet").empty().html('')
			}
		});
		function preAppendText(element,text){
			element.empty().prepend(text);
		}

		// function procChkSelData() {
		// 	if(mappform.length > 0) {
		// 		alert('Drafted inputs will now be re-inputted');
		// 		let mappformArr = ['ocid', 'classid', 'subClassid', 'facmode', 'funcid'], chReq = [['ocid', 'mclass', 'classid', ['classid', 'classname'], ['subClassid']], ['isSub', 'msubclass', 'subClassid', ['classid', 'classname'], []], [], [], []], premThis = true;
		// 		curAppid = mappform[0]['appid'];
		// 		if(Array.isArray(mservfac)) {
		// 			let mservfacArr = ['hgpid', 'facid'], chReq = [['hgpid', 'mserv_cap', 'serv_cap', ['facid', 'facname'], [], ['facilitytyp', 'hgpid']]];
		// 			for(let i = 0; i < mservfacArr.length; i++) { for(let j = 0; j < mservfac[i].length; j++) {
		// 				let idom = document.getElementById(mservfac[i][j][mservfacArr[i]]);
		// 				if(idom != undefined || idom != null) { idom.checked = true; if(chReq[i] != null || chReq[i] != undefined) { findSelName(idom.name, chReq[i][0], chReq[i][1], chReq[i][2], chReq[i][3], chReq[i][4]); } }
		// 			} if(i == 1) { fSelServ(mservfacArr[i]); } }
		// 		}
		// 		if(mptcdet.length > 0) {
		// 			curPtcId = mptcdet[0]['id'];
		// 			let mptcdetArr = ['propbedcap', 'propstation', 'incbedcapfrom', 'incbedcapto', 'incstationfrom', 'incstationto', 'construction_description'/*, 'others'*/];
		// 			for(let i = 0; i < mptcdetArr.length; i++) { let idom = document.getElementById(mptcdetArr[i]); if(idom != null || idom != undefined) { idom.value = mptcdet[0][mptcdetArr[i]]; } }
		// 			let idom = document.getElementById('type' + mptcdet[0]['type']);
		// 			if(idom != null || idom != undefined) { idom.checked = true; changeNrs(parseInt(mptcdet[0]['type'])); }
		// 		}
		// 		// for(let i = 0; i < mappformArr.length; i++) {
		// 		// 	let idom = document.getElementById(mappformArr[i]);
		// 		// 	if(idom != undefined || idom != null) {
		// 		// 		if(mappform[0][mappformArr[i]] != null) { idom.value = mappform[0][mappformArr[i]]; }
		// 		// 		if(chReq.length == mappformArr.length) { if(chReq[i].length > 0) { findSelName(idom.name, chReq[i][0], chReq[i][1], chReq[i][2], chReq[i][3], chReq[i][4], []); } }
		// 		// 	}
		// 		// }
		// 		// if(mappform[0]['canapply'] == 1) {
		// 		// 	premThis = false;
		// 		// }
		// 	}
		// }
		function retArrReqChk(elName, isCheck) {
			let idom = document.getElementsByName(elName), retArr = [], defAssigned = "";
			if(idom != undefined || idom != null) { for(let i = 0; i < idom.length; i++) { if(typeof isCheck == "boolean") { if(idom[i].checked == isCheck) {
				mserv_cap.forEach(function(a, b ,c) { if(a.facid == idom[i].value) { defAssigned = a.assignrgn; } });
				retArr.push(idom[i].value); assignedRgn = defAssigned;
			} } } }
			return retArr;
		}
		function fSelServ(elName) {
			let retArr = retArrReqChk(elName, true);
			// findChkName(retArr);
		}
		// procChkSelData();
		document.getElementById('ocid').addEventListener('change', function() {
				findSelName(this.name, 'ocid', 'mclass', 'classid', ['classid', 'classname'], ['subClassid'], []);
			});
		document.getElementById('classid').addEventListener('change', function() {
			findSelName(this.name, 'isSub', 'msubclass', 'subClassid', ['classid', 'classname'], [], []);
		});
	</script>
	@include('client1.cmp.footer')
	<script>
		onStep(1);
	</script>
</body>
@endsection