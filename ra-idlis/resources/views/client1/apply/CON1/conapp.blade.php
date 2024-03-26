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

		div.col-md-8, div.col-md-4{
			flex: 0 0 100%;
			max-width: 100%;
		}

	}
</style>
<body>
	@if(! isset($hideExtensions))
		@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')
		@include('client1.cmp.__wizard')
	@endif
	{{csrf_field()}}
	<div class="container-fluid mt-5 mb-5">
		<div class="row">
			<div class="col-md-8">
				<div class="card">
				{{-- 					<div class="card-header">
						<div class="row">
							<div class="col-md-3 hide-div">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 60px; padding-left: 20px;">
							</div>
							<div class="col-md-6">
								<h5 class="card-title text-uppercase text-center">Certificate of Need</h5>
								<h6 class="card-subtitle mb-2 text-center text-muted">Application Details</h6>
							</div>
							<div class="col-md-3 hide-div">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 60px; padding-right: 20px;">
							</div>
						</div>
					</div> --}}
					<div class="card-header">
						<div class="row">
							<div class="offset-1 col-md-3 hide-div d-flex justify-content-end">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 60px; padding-left: 20px;">
							</div>
							<div class="col-md-3 text-left">
								<h5 class="card-title text-uppercase text-center">Certificate of Need</h5>
								<h6 class="card-subtitle mb-2 text-center text-muted">Application Details</h6>
							</div>
							{{-- <div class="col-md-3 hide-div">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 60px; padding-right: 20px;">
							</div> --}}
						</div>
					</div>
					<div class="card-body" id="ptcbody">
						<div id="_errMsg"></div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Proposed Health Facility Address</p>
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
								<p>Province/District:</p>
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
								<p>Classification According to</p>
							</div>
							<div class="col">
								<div class="custom-control custom-checkbox mr-sm-2">
							        <input type="checkbox" class="custom-control-input" id="hfep_funded" name="hfep_funded">
							        <label class="custom-control-label" for="hfep_funded">HFEP Funded</label>
							    </div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-4">
								<p class="req">Ownership:</p>
								<div class="mb-3">
									<select class="form-control" id="ocid" name="ocid" disabled="">
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
									<select class="form-control" id="classid" name="classid" disabled="">
										<option selected value hidden disabled>Please select</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<p>Sub Classification:</p>
								<div class="mb-3">
									<select class="form-control" id="subClassid" name="subClassid" disabled="">
										<option selected value hidden disabled>Please select</option>
									</select>
								</div>
							</div>
							{{-- <div class="col-md-3">
								<p class="req">Classification of Hospital:</p>
								<div class="mb-3">
									<select class="form-control" id="funcid" name="funcid">
										<option selected value hidden disabled>Please select</option>
										@foreach($function AS $each)
											<option value="{{$each->funcid}}">{{$each->funcdesc}}</option>
										@endforeach
									</select>
								</div>
							</div> --}}
						</div>


						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p class="req">Service Capabilities</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mb-3" id="serv_cap">
									@if(count($serv_cap) > 0) @for($i = 0; $i < ceil(count($serv_cap)/4); $i++) <?php $_min = $i * 4; $_oMax = $_min + 4; $_nMax = (($_oMax > count($serv_cap)) ? count($serv_cap) : $_oMax); ?>
									<div class="row">
										@for($j = $_min; $j < $_nMax; $j++)
										<div class="col-md-3">
											<div class="custom-control custom-radio mr-sm-2">
										        <input type="radio" class="custom-control-input" id="{{$serv_cap[$j]->facid}}" name="facid" value="{{$serv_cap[$j]->facid}}">
										        <label class="custom-control-label" for="{{$serv_cap[$j]->facid}}">{{$serv_cap[$j]->facname}}</label>
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
								<p>Other Details</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-4">
								<p class="req">Capital Investment:</p>
								<div class="mb-3">
									<div class="row">
										<div class="col-1">&#8369;</div>
										<div class="col-10"><input type="text" class="form-control" id="cap_inv" name="cap_inv" placeholder="Capital Investment"></div>	
									</div>
									
								</div>
							</div>
							<div class="col-md-4">
								<p class="req">Lot Area (by square meters):</p>
								<div class="mb-3">
									<input type="number" class="form-control" id="lot_area" name="lot_area" placeholder="Lot Area">
								</div>
							</div>
							<div class="col-md-4">
								<p class="req">Proposed Bed Capacity:</p>
								<div class="mb-3">
									<input type="number" class="form-control" id="noofbed" name="noofbed" placeholder="Proposed Bed Capacity">
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p class="req">
									Projected Primary and Secondary Catchment Population (P) of the Proposed Hospital: 
									<span class="font-weight-bold"></span>
								</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<ul class="p-0 ml-3">
									<li>
										<span class="text-danger font-weight-bold">Primary Catchment/Area</span> refers to the municipality/urban district for Level 1 Hospitals, rural district/city for Level 2 Hospitals, provice and region for Level 3 Hospitals
									</li>
									<li>
										<a class="text-danger font-weight-bold">Secondary Catchment Area</a> refers to other geographic areas that have access or contigous to the Primary Catchment Area
									</li>
									<li>
										<a class="text-danger font-weight-bold">Note:</a> Source of Projected Population (5<sup>th</sup> year) of Catchment Area should be from PSA/NEDA. Refer to this link <a href="https://www.doh.gov.ph/sites/default/files/publications/Philippines%20projected%20pop%20by%20Prov%2CCity%2CBarangay%202018-2022.pdf" target="_blank">here</a>
									</li>
									<li>
										<a class="text-danger font-weight-bold">Note:</a> Please Refer to Regional DOH websites on encoding Population Projection
									</li>
								</ul>
								<div class="mb-3 mt-3">
									<table class="table">
										<thead class="thead-dark">
											<tr>
												<th>
													<button 
														class="btn btn-success" 
														data-toggle="tooltip" 
														data-placement="top" 
														title="Add" 
														onclick="addNewRowA('addNewRow', 0, 'projectedPrimary');"
														id="projectedPrimary"
													>
														<i class="fa fa-plus"></i>
													</button>
												</th>
												<th>Type</th>
												<th>Location</th>
												<th>Projected Population (5<sup>th</sup> year) of Catchment Area</th>
											</tr>
										</thead>
										<tbody id="addNewRow">
											@if(count($condet[0]) > 0) <?php $cIa = 1; ?> @foreach($condet[0] AS $each)
											<tr id="trd{{$cIa}}">
												<td><button class="btn btn-danger" onclick="deleteRow('trd{{$cIa}}');"><i class="fa fa-times"></i></button></td>
												<td>
													<select class="form-control" name="type[]">
														<option value hidden disabled selected></option>
														<option value="0">Primary</option>
														<option value="1">Secondary</option>
													</select>
													<script type="text/javascript">
														document.getElementsByName('type[]')
														[document.getElementsByName('type[]').length - 1].value = "{{$each->type}}";
													</script>
												</td>
												<td>
													<input type="text" class="form-control" name="location[]" value="{{$each->location}}">
												</td>
												<td>
													<input type="text" class="form-control" name="population[]" value="{{$each->population}}">
												</td>
											</tr>
											<?php $cIa++; ?> @endforeach @else @endif
											<tr class="border">
												<td colspan="3" class="border text-right">Total</td>
												<td colspan="2" class="border font-weight-bold" id="total"></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>List of Existing Hospital(s) currently managed/operated by the Proponent, if any:</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mb-3 mt-3 table-responsive">
									<table class="table">
										<thead class="thead-dark">
											<tr>
												<th>
													<button 
														class="btn btn-success" 
														data-toggle="tooltip" 
														data-placement="top" 
														onclick="addNewRowA('addNewRow1', 1, 'existingHospitals');"
														id="existingHospitals"
													>
													<i class="fa fa-plus"></i>
												</button>
												</th>
												<th>Facility Name</th>
												<th>Location</th>
												<th>Bed Capacity</th>
												<th>Category of Hospital</th>
												<th>License Number</th>
												<th>Validity Period</th>
												<th>Due of Operations</th>
												<th>Remarks</th>
											</tr>
										</thead>
										<tbody id="addNewRow1">
											@if(count($condet[1]) > 0) <?php $cI = 1; ?> @foreach($condet[1] AS $each)
											<tr id="tr{{$cI}}">
												<td><button class="btn btn-danger" onclick="deleteRow('tr{{$cI}}');"><i class="fa fa-times"></i></button></td>
												<td>
													<input type="text" style="width:200px;" class="form-control" name="facilityname[]" value="{{$each->facilityname}}">
												</td>
												<td>
													<input type="text" style="width:200px;" class="form-control" name="location1[]" value="{{$each->location1}}">
												</td>
												<td>
													<input type="number" class="form-control" name="noofbed1[]" value="{{$each->noofbed1}}">
												</td>
												<td>
													<select class="form-control" style="width:200px;" name="cat_hos[]">
														<option value disabled hidden selected>Select Please</option>
														@if(count($serv_cap) > 0) @foreach($serv_cap AS $each1)
														<option value="{{$each1->facid}}">{{$each1->facname}}</option>
														@endforeach @endif
													</select>
													<script type="text/javascript">
														document.getElementsByName('cat_hos[]')[document.getElementsByName('cat_hos[]').length - 1].value = "{{$each->cat_hos}}";
													</script>
												</td>
												<script type="text/javascript"></script>
												<td>
													<input type="text" style="width:150px;" class="form-control" name="license[]" value="{{$each->license}}">
												</td>
												<td>
													<input type="date" class="form-control" name="validity[]" value="{{$each->validity}}">
												</td>
												<td>
													<input type="date" class="form-control" name="date_operation[]" value="{{$each->date_operation}}">
												</td>
												<td>
													<textarea cols="4" class="form-control" name="remarks[]" value="{{$each->remarks}}" placeholder="{{$each->remarks}}"></textarea>
												</td>
											</tr>
											<?php $cI++; ?> @endforeach @else @endif
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;"></div>
					</div>
					{{-- @if(! isset($hideExtensions)) --}}
					<div class="card-footer">
						<div class="pull-left">
							<a href="{{asset('client1/apply')}}"><button class="btn btn-danger">Back</button></a>
						</div>
						<div class="remthis pull-right" id="cModal">
							<button class="btn btn-info" data-toggle="modal" data-target="#confirmModal">Submit Details</button>
						</div>
					</div>
					{{-- @endif --}}
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
				      		<tbody id="not_serv_chg">
				      			<tr>
				      				<td colspan="2">No Facility Type selected.</td>
				      			</tr>
				      		</tbody>
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
				    <div class="card-header" id="headingThree">
				      <h5 class="mb-0">
				        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
				          Application Details
				        </button>
				      </h5>
				    </div>
				    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
				      <div class="card-body table-responsive">
				      	<table class="table table-striped">
				      		<tbody>
				      			<tr>
				      				<th style="background-color: #4682B4; color: white;">Type of Facility</th>
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
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		let total = 0;
		function numberWithCommas(number) {
		    var parts = number.toString().split(".");
		    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		    return parts.join(".");
		}
		$(document).ready(function() {
		  $("#cap_inv").change(function() {
		    var num = $(this).val();
		    var commaNum = numberWithCommas(num);
		    $(this).val(commaNum);
		  });
		});


		//for trappings on who can apply to CON
		$(function(){
			$("#noofbed").keyup(function(event) {
				if($("#ocid").val() == 'P'){
					if($(this).val() > 99){
						alert('100 and above beds are encourage to directly apply to PTC. Please lower Proposed beds or proceed to PTC');
						$(this).val("").focus();
					}
				}
			});

			$("#funcid, #ocid, #subClassid").change(function(event) {
				if($('#funcid').val() == '2'){
					alert('Specialized hospitals do not need to apply to CON. Please proceed to PTC or change classification');
					$(this).val("").focus();
				}
				if($.inArray($('#subClassid').val(), Array('NA','NP')) != -1){
					alert('Any Military hospitals is not required to undergo CON. proceed to PTC or change Sub Class');
					$(this).val("").focus();
				}
			});

		})

		// var ___div = document.getElementById('__applyBread'), ___wizardcount = document.getElementsByClassName('wizardcount');
		// @if(!session()->has('employee_login'))
		// 	document.getElementById('stepDetails').innerHTML = 'Application CON Details';
		// @endif
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
		var mclass = JSON.parse('{!!$class!!}'), 
		msubclass = JSON.parse('{!!$subclass!!}'), 
		mserv_cap = JSON.parse('{!!addslashes($serv_cap)!!}'), 
		mappform = JSON.parse('{!!json_encode($fAddress)!!}'), 
		mservfac = JSON.parse('{!!$servfac!!}');
		var curAppid = "", curPtcId = "", curHfserid ="{{((count($fAddress) > 0) ? $fAddress[0]->hfser_id : "")}}", assignedRgn = "", assignedGroup = {};
		// if(___div != null || ___div != undefined) {
		// 	___div.classList.remove('active');
		// 	___div.classList.add('text-primary');
		// }
		function deleteRow(elName) {
			let idom = document.getElementById(elName);
			if(idom != undefined || idom != null) {
				idom.parentNode.removeChild(idom);
			}
		}
		function addNewRowA(elName, ind, sourceId) {
			let idom = document.getElementById(elName);
			const childCount = $("#" + elName).children().length
			console.log(childCount)
			if(childCount < 3) {
				if(idom != undefined || idom != null) {
					let tTr = idom.getElementsByTagName('tr'), 
					tInt = ((tTr[tTr.length - 1] != undefined || tTr[tTr.length - 1] != null) ? parseInt((tTr[tTr.length - 1].id).replace('tr', '')) : 0), 
					whatToInsert = [
					'<tr id="trd'+(tInt + 1001)+'">'+
						`<td>
							<button 
								class="btn btn-danger" 
								data-toggle="tooltip" 
								data-placement="top" 
								title="Remove" 
								onclick="deleteRow(\'trd'+(tInt + 1001)+'\');">
								<i class="fa fa-times"></i>
							</button>
						</td>`+
						`<td>
							${
								childCount === 1 ? ("PRIMARY") : (childCount === 2 ? "SECONDARY" : "")
							}
							<input type="hidden" name="type[]" value="${
								childCount === 1 ? ("0") : (childCount === 2 ? "1" : "")
							}">
						</td>`+
						'<td><input type="text" class="form-control" name="location[]"></td>'+
						'<td><input type="number" class="form-control" name="population[]"></td>'+
					'</tr>', 
					'<tr id="tr'+(tInt + 1001)+'">'+
					'<td><button class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Add" onclick="deleteRow(\'tr'+(tInt + 1001)+'\');"><i class="fa fa-times"></i></button></td>'+
					'<td><input type="text" style="width:200px;" class="form-control" name="facilityname[]"></td>'+
					'<td><input type="text" style="width:200px;" class="form-control" name="location1[]"></td>'+
					'<td><input type="number" class="form-control" name="noofbed1[]"></td>'+
					'<td><select class="form-control" name="cat_hos[]" style="width:200px;"> <option value disabled hidden selected>Select Please</option> @if(count($serv_cap) > 0) @foreach($serv_cap AS $each) <option value="{{$each->facid}}">{{$each->facname}}</option> @endforeach @endif </select></td>'+
					'<td><input type="text" class="form-control" style="width:150px;" name="license[]"></td>'+
					'<td><input type="date" class="form-control" name="validity[]"></td>'+
					'<td><input type="date" class="form-control" name="date_operation[]"></td>'+
					'<td><textarea cols="4" class="form-control" name="remarks[]"></textarea></td>'+
					'</tr>'
					];
					if(whatToInsert.indexOf(ind) < 0) {
						// $(idom).append(whatToInsert[ind]);
						$("#" + elName).prepend(whatToInsert[ind]); 
						// idom.outerHTML += whatToInsert[ind];
					}
				}
			}
			else {
				alert("Primary and Secondary already added")
			}
		}
		(function() {
			let cRadioId = ['type0', 'type1'], mhfser_id = "", hgpid = document.getElementsByName('hgpid'), facid = document.getElementsByName('facid');
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
				let token = document.getElementsByName('_token')[0], 
					ocid = document.getElementById('ocid'),  
					classid = document.getElementById('classid'), 
					subClassid = document.getElementById('subClassid'), 
					gfacid = document.getElementsByName('facid'), 
					/*funcid = document.getElementById('funcid'),*/ 
					uid = document.getElementById('uid'), 
					gtype = document.getElementsByName('type[]'), 
					glocation = document.getElementsByName('location[]'), 
					gpopulation = document.getElementsByName('population[]'), 
					facilityname = document.getElementsByName('facilityname[]'), 
					location1 = document.getElementsByName('location1[]'), 
					noofbed1 = document.getElementsByName('noofbed1[]'),
					cat_hos = document.getElementsByName('cat_hos[]'), 
					license = document.getElementsByName('license[]'), 
					validity = document.getElementsByName('validity[]'), 
					date_operation = document.getElementsByName('date_operation[]'), 
					remarks = document.getElementsByName('remarks[]'), 
					cap_inv = document.getElementById('cap_inv'), 
					lot_area = document.getElementById('lot_area'), 
					noofbed = document.getElementById('noofbed'), 
					hfep_funded = document.getElementById('hfep_funded'), 
					mhfep_funded = '0', 
					massignedRgn = assignedRgn;
				if(hfep_funded != undefined || hfep_funded != null) { 
					if(hfep_funded.checked) {
						mhfep_funded = '1'; 
						massignedRgn = mappform[0]['rgnid']; 
					} 
					else { 
						mhfep_funded = '0'; 
						massignedRgn = assignedRgn; 
					} 
				}
				if(massignedRgn == "rgn") { 
					massignedRgn = mappform[0]['rgnid']; 
				}
				let sArr = [
					'_token='+token.value,
					'uid='+uid.value, 
					'appid='+curAppid, 
					'ocid='+ocid.value, 
					'classid='+classid.value, 
					'subClassid='+subClassid.value, 
					/*'funcid='+funcid.value, */
					'cap_inv='+cap_inv.value, 
					'lot_area='+lot_area.value, 
					'noofbed='+noofbed.value, 
					'hfep_funded='+mhfep_funded, 
					'assignedRgn='+massignedRgn
				];
				if(gfacid != null || gfacid != undefined) {  
					for(let i = 0; i < gfacid.length; i++) { 
						if(gfacid[i].checked) {
							sArr.push('facid[]='+gfacid[i].value);
						} 
					} 
				}
				if(gtype != null || gtype != undefined) { 
					for(let i = 0; i < gtype.length; i++) {
						sArr.push('type[]='+gtype[i].value);
					} 
				}
				if(glocation != null || glocation != undefined) { 	
					for(let i = 0; i < glocation.length; i++) {
						sArr.push('location[]='+glocation[i].value);
					} 
				}
				if(gpopulation != null || gpopulation != undefined) { 
					for(let i = 0; i < gpopulation.length; i++) {
					sArr.push('population[]='+gpopulation[i].value);
				} }
				if(facilityname != null || facilityname != undefined) { 
					for(let i = 0; i < facilityname.length; i++) {
						sArr.push('facilityname[]='+facilityname[i].value);
					} 
				}
				if(location1 != null || location1 != undefined) { 
					for(let i = 0; i < location1.length; i++) {
						sArr.push('location1[]='+location1[i].value);
					} 
				}
				if(noofbed1 != null || noofbed1 != undefined) { 
					for(let i = 0; i < noofbed1.length; i++) {
						sArr.push('noofbed1[]='+noofbed1[i].value);
					} 
				}
				if(cat_hos != null || cat_hos != undefined) { 
					for(let i = 0; i < cat_hos.length; i++) {
						sArr.push('cat_hos[]='+cat_hos[i].value);
					} 
				}
				if(license != null || license != undefined) { 
					for(let i = 0; i < license.length; i++) {
						sArr.push('license[]='+license[i].value);
					} 
				}
				if(validity != null || validity != undefined) { 
					for(let i = 0; i < validity.length; i++) {
						sArr.push('validity[]='+validity[i].value);
					} 
				}
				if(date_operation != null || date_operation != undefined) { 
					for(let i = 0; i < date_operation.length; i++) {
						sArr.push('date_operation[]='+date_operation[i].value);
					} 
				}
				if(remarks != null || remarks != undefined) { 
					for(let i = 0; i < remarks.length; i++) {
						sArr.push('remarks[]='+remarks[i].value);
					} 
				}
				insErrMsg('warning', 'Sending request.');
				sendRequestRetArr(
						sArr, 
						"{{asset('client1/request/customQuery/fCONApp')}}", 
						"POST", 
						true, {
							functionProcess: function(arr) {
								let aBol = true;
								arr.forEach(function(a, b, c) {
									if(a != true) {
										aBol = false;
										insErrMsg('danger', a);
										setTimeout(function() { window.scroll({top: 0, left: 0, behavior: 'smooth'}) }, 500)
									}
								});
								if(aBol) {
									@if(! isset($hideExtensions))
									var r = confirm('Application submitted. Proceed to submission of requirements?');
									if (r == true) { window.location.href = "{{asset('client1/apply/attachment')}}/{{$fAddress[0]->hfser_id}}/"+curAppid;} else { window.location.href = "{{asset('client1/apply')}}"; }
									// var r = confirm('Application submitted. Proceed to payment?');
									// if (r == true) { window.location.href = "{{asset('client1/payment')}}/{{$cToken}}/"+curAppid;} else { window.location.href = "{{asset('client1/apply')}}"; }
									@else
									alert('Application Updated');
									location.reload();
									@endif
								}
							}
						}
				);
			}
			function chkApOop() {
				let sArr = ['_token='+document.getElementsByName('_token')[0].value, 'rTbl=appid', 'rId='+curAppid];
				sendRequestRetArr(sArr, "{{asset('client1/request/appform_orderofpayment')}}", "POST", true, {
					functionProcess: function(arr) {
						let appopp = document.getElementById('appopp'), serv_chg = document.getElementById('serv_chg'), cModalBtn = document.getElementById('cModal').getElementsByTagName('button')[0];
						if(appopp != null || appopp != undefined) { if(cModalBtn != undefined || cModalBtn != null) {
							if(arr.length > 0) {
								let tpaid = arr[0]['oop_total'] - arr[0]['oop_paid'];
								if(tpaid == 0) {
									cModalBtn.removeAttribute('data-target'); cModalBtn.setAttribute('hidden', true); cModalBtn.innerHTML = "Proceed payment.";
								} else {
									cModalBtn.removeAttribute('hidden'); cModalBtn.setAttribute('data-target', '#appOppModal'); cModalBtn.innerHTML = "Proceed payment.";
								}
							} else {
								if(serv_chg != undefined || serv_chg != null) {
									let servStr = serv_chg.innerHTML, paypalAdd = document.getElementById('paypalAdd');
									if(serv_chg.getElementsByTagName('tr').length > 0) {
										cModalBtn.removeAttribute('hidden');  cModalBtn.setAttribute('data-target', '#appOppModal'); cModalBtn.innerHTML = "Proceed payment.";
										if(paypalAdd != undefined || paypalAdd != null) { paypalAdd.innerHTML = ""; for(let i = 0; i < serv_chg.getElementsByTagName('tr').length; i++) {
											paypalAdd.innerHTML += '<input type="hidden" name="item_name_'+(i + 1)+'" value="'+serv_chg.getElementsByTagName('tr')[i].getElementsByTagName('td')[0].textContent+'">';
											paypalAdd.innerHTML += '<input type="hidden" name="quantity_'+(i + 1)+'" value="1">';
											paypalAdd.innerHTML += '<input type="hidden" name="shipping_'+(i + 1)+'" value="0.00">';
											paypalAdd.innerHTML += '<input type="hidden" name="amount_'+(i + 1)+'" value="'+((serv_chg.getElementsByTagName('tr')[i].getElementsByTagName('td')[1] in { null: null, undefined: undefined }) ? '' : serv_chg.getElementsByTagName('tr')[i].getElementsByTagName('td')[1].getElementsByTagName('span')[0].textContent)+'">';
										} }
										appopp.innerHTML = servStr;
									} else {
										cModalBtn.removeAttribute('hidden');  cModalBtn.setAttribute('data-target', '#confirmModal'); cModalBtn.innerHTML = "Submit form";
										appopp.innerHTML = '<tr><td colspan="2">No Service Capabilities selected.</td></tr>';
									}
								}
							}
						} }
					}
				});
			}
			function findChkName(arrCol) {
				
				let sArr = ['_token='+document.getElementsByName('_token')[0].value, 'appid='+curAppid, 'hfser_id='+curHfserid];
				if(Array.isArray(arrCol)) { for(let i = 0; i < arrCol.length; i++) { sArr.push('facid[]='+arrCol[i]); } }
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
			function getChargesPerApplication() {
				let sArr = ['_token='+document.getElementsByName('_token')[0].value, 'appid='+curAppid, 'aptid=IN', 'hfser_id='+mhfser_id], ghgpid = JSON.parse('{!!$arrCon!!}');
				if(ghgpid != null || ghgpid != undefined) { for(let i = 0; i < ghgpid.length; i++) {
					sArr.push('hgpid[]='+ghgpid[i]);
				} }
				sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/getChargesPerApplication')}}", "POST", true, {
					functionProcess: function(arr) {
						let not_serv_chg = document.getElementById('not_serv_chg');
						if(not_serv_chg != undefined || not_serv_chg != null) {
							if(arr.length > 0) {
								not_serv_chg.innerHTML = '';
								for(let i = 0; i < arr.length; i++) {
									not_serv_chg.innerHTML += '<tr><td>'+arr[i]['chg_desc']+'</td><td>&#8369;&nbsp;<span>'+(parseInt(arr[i]['amt'])).toFixed(2)+'</span></td></tr>';
								}
							} else {
								not_serv_chg.innerHTML = '<tr><td colspan="2">Chosen facility has no Registration fee Required.</td></tr>';
							}
						}
					}
				});
			}
			function retArrReqChk(elName, isCheck) {
				let idom = document.getElementsByName(elName), retArr = [], defAssigned = "";
				if(idom != undefined || idom != null) { for(let i = 0; i < idom.length; i++) { if(typeof isCheck == "boolean") { if(idom[i].checked == isCheck) {
					mserv_cap.forEach(function(a, b ,c) { if(a.facid == idom[i].value) { defAssigned = a.assignrgn; } });
					retArr.push(idom[i].value); assignedRgn = defAssigned;
				} } } }
				return retArr;
			}
			function findSelName(elName, colName, tblName, insId, arrCol, clId) {
				let dom = document.getElementsByName(elName), arr = [], forDispArr = [];
				let procTbl = function(eDom) { window[tblName].forEach(function(a, b, c) { if(a[colName] == eDom.value) { arr.push(a); } }); };
				if(dom != null || dom != undefined) {
					for(let i = 0; i < dom.length; i++) { if(insId == 'serv_cap') { if(dom[i].checked) { procTbl(dom[i]); } } else { procTbl(dom[i]); } }
					let idom = document.getElementById(insId);
					if(idom != null || idom != undefined) { if(arr.length > 0) {
						if(arr.length == 1) { arr[0].ischecked = 'checked'; }
						let apString = "", selString = '<option selected value hidden disabled>Please select</option>';
						for(let i = 0; i < Math.ceil(arr.length/4); i++) {
							let iMin = i * 4, iMax = iMin + 4, mMax = ((iMax > arr.length) ? arr.length : iMax);
							apString += '<div class="row">';
							for(let j = iMin; j < mMax; j++) {
								selString += '<option value="'+arr[j][arrCol[0]]+'">'+arr[j][arrCol[1]]+'</option>';
								apString += '<div class="col-md-3"><div class="custom-control custom-checkbox mr-sm-2">'+
										        '<input type="checkbox" class="custom-control-input" id="'+arr[j][arrCol[0]]+'" name="facid" value="'+arr[j][arrCol[0]]+'" '+((arr[j]['ischecked'] != undefined || arr[j]['grphrz_name'] != null) ? arr[j]['ischecked'] : "")+'>'+
										        '<label class="custom-control-label" for="'+arr[j][arrCol[0]]+'">'+arr[j][arrCol[1]]+'</label>'+
										    '</div></div>';
							}
							apString += '</div>';
						}
						idom.innerHTML = ((insId == 'serv_cap') ? apString : selString);
						if(arr.length == 1) { 
							findChkName([arr[0][arrCol[0]]]);
						}
						if(Array.isArray(clId)) { for(let i = 0; i < clId.length; i++) { document.getElementById(clId[i]).innerHTML = ((insId == 'serv_cap') ? '' : '<option selected value hidden disabled>Please select</option>'); } }
					} else { idom.innerHTML = ((insId == 'serv_cap') ? '' : '<option selected value hidden disabled>Please select</option>'); } }
				}
			}
			function remThis() {
				let idom = document.getElementsByClassName('remthis'), ptcbody = document.getElementById('ptcbody');
				if(idom != null || idom != undefined) { for(let i = 0; i < idom.length; i++) { idom[i].parentNode.removeChild(idom[i]); } }
				fPTCApp = undefined;
				if(ptcbody != undefined || ptcbody != null) { ptcbody.disabled = true; }
			}
			function fSelServ(elName) {
				let retArr = retArrReqChk(elName, true);
				findChkName(retArr);
			}
			function procChkSelData() {
				if(mappform.length > 0) {
					let mappformArr = ['ocid', 'classid', 'subClassid', 'funcid', 'cap_inv', 'lot_area', 'noofbed'], 
					chReq = [['ocid', 'mclass', 'classid', ['classid', 'classname'], ['subClassid']], ['isSub', 'msubclass', 'subClassid', ['classid', 'classname'], []], [], [], [], [], []], 
					// chReq = [['ocid', 'mclass', 'classid', ['classid', 'classname'], ['subClassid']], ['isSub', 'msubclass', 'subClassid', ['classid', 'classname'], []], [], []],
					mappformArrChk = ['ocid', 'cap_inv','funcid', 'lot_area', 'noofbed'], premThis = true;
					curAppid = mappform[0]['appid'];
					mhfser_id = mappform[0]['hfser_id'];
					if(Array.isArray(mservfac)) {
						let mservfacArr = ['', 'facid'], chReq = [];
						for(let i = 0; i < mservfacArr.length; i++) { for(let j = 0; j < mservfac[i].length; j++) {
							let idom = document.getElementById(mservfac[i][j][mservfacArr[i]]);
							if(idom != undefined || idom != null) { idom.checked = true; if(chReq[i] != null || chReq[i] != undefined) { findSelName(idom.name, chReq[i][0], chReq[i][1], chReq[i][2], chReq[i][3], chReq[i][4]); } }
						} if(i == 1) { fSelServ(mservfacArr[i]); } }
					}
					for(let i = 0; i < mappformArr.length; i++) {
						let idom = document.getElementById(mappformArr[i]);
						if(idom != undefined || idom != null) {
							if(mappform[0][mappformArr[i]] != null) { 
								idom.value = mappform[0][mappformArr[i]]; 
							}
							if(chReq.length == mappformArr.length) { 
								if(chReq[i].length > 0) { 
									findSelName(idom.name, chReq[i][0], chReq[i][1], chReq[i][2], chReq[i][3], chReq[i][4], []); 
								} 
							}
						}
					}
					if(hfep_funded != undefined || hfep_funded != null) { hfep_funded.checked = ((mappform[0]['hfep_funded'] == 1) ? true : false); }
					if(mappform[0]['canapply'] == 1) {
						premThis = false;
					}
					mappformArrChk.forEach(function(a, b, c) {
						if(mappform[0][a] == null) {
							premThis = false;
						}
					});
					@if(! isset($hideExtensions))
					if(premThis) {
						remThis();
					}
					@endif
					// chkApOop();
				}
			}
			document.getElementById('ocid').addEventListener('change', function() {
				findSelName(this.name, 'ocid', 'mclass', 'classid', ['classid', 'classname'], ['subClassid'], []);
			});
			document.getElementById('classid').addEventListener('change', function() {
				findSelName(this.id, 'isSub', 'msubclass', 'subClassid', ['classid', 'classname'], [], []);
			});
			document.getElementById('subForm').addEventListener('click', fPTCApp);
			if(document.getElementById('serv_cap') != null || document.getElementById('serv_cap') != undefined) { document.getElementById('serv_cap').addEventListener('click', function(e) {
				let target = e.target || window.event.target;
				if(target.name == "facid") {
					fSelServ(target.name);
				}
			}); }
			procChkSelData();
			getChargesPerApplication();
		})();
		$(function () {
		  	$('[data-toggle="tooltip"]').tooltip()
		});

		function totalPop(){
			if($('input[name="population[]"]').length > 0){
				total = 0;
				$('input[name="population[]"]').each(function() {
					total = Number(total) + Number($(this).val());
					$("#total").empty().html(numberWithCommas(total));
				});
			}
		}

		$(document).on('keyup','input[name="population[]"]',function(){
			totalPop();
		})
		$(function(){
			totalPop();
		})
	</script>
	@if(! isset($hideExtensions))
		@include('client1.cmp.footer')
		<script>
			onStep(2);
		</script>
	@endif
</body>
@endsection