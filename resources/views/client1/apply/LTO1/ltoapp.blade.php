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
	<?php 
	$_aptid = "IN"; 
	$_aptdesc = "Initial New"; 
	$_dispSubmit = false; 
	$_dispData = "Submit Details"; 
	if(isset($aptid)) { 
		if($aptid == "IC") { 
			$_aptid = $aptid; 
			$_aptdesc = "Change Request"; 
			$_dispSubmit = true; 
			$_dispData = "Update Details"; 
		} 
		if($aptid == "R") { 
			$_aptid = $aptid; 
			$_aptdesc = "Renewal"; 
			$_dispSubmit = true; 
			$_dispData = "Update Details"; 
		}  
	} ?>
	{{-- {{dd([$_aptdesc,$_dispSubmit,$_dispData,$aptid,$_aptdesc])}} --}}
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
					{{-- <div class="card-header">
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
					</div> --}}
					<div class="card-header">
						<div class="row">
							<div class="offset-1 col-md-3 hide-div d-flex justify-content-end">
								<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 60px; padding-left: 20px;">
							</div>
							<div class="col-md-3 text-left">
								<h5 class="card-title text-uppercase text-center">License To Operate</h5>
								<h6 class="card-subtitle mb-2 text-center text-muted">LTO Details</h6>
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
								<p>Health Facility Address</p>
							</div>
							<div class="col text-right">
								<p>Application Type: <span class="font-weight-bold">{{$_aptdesc}}</span></p>
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
						@if($_aptid == 'IN')
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p class="req">PTC Code</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mt-3 mb-3">
									<input type="text" class="form-control" name="ptcCode" id="ptcCode" placeholder="PTC Code" autocomplete="off">
								</div>
							</div>
						</div>
						@endif

						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p class="req">Type of Facility</p>
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
										        <input type="radio" class="custom-control-input" id="{{$hfaci_serv_type[$j]->hgpid}}" name="hgpid" value="{{$hfaci_serv_type[$j]->hgpid}}">
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
						<div class="row col-border-right showifHospital" hidden style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Classification of Hospital</p>
							</div>
						</div>
						<div class="row col-border-right showifHospital" hidden style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
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
								<p>For Ambulatory Surgical Clinic</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="addCLick mb-3" id="hgpid1">
								</div>
							</div>
						</div>
						<div class="row col-border-right showAmb" hidden style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>
									For Ambulance Details
								</p>
								<span class="text-danger">NOTE: For Owned ambulance, Payments are as follows:</span>
								<br>
								Ambulance Service Provider = &#8369; 5,000<br>
								Ambulance Unit (Per Unit) = &#8369; 1,000
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;" hidden>
							<div class="col-md-12">
								<div class="mb-3">
									<p>Ambulance count</p>
									<input type="number" class="form-control" id="noofamb" name="noofamb" placeholder="Ambulance Count">
								</div>
							</div>
						</div>
						<div class="row col-border-right showAmb" hidden style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							{{-- <div class="col-md-4">
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
								<p>Ambulance Service:</p>
								<div class="mb-3">
									<select class="form-control" id="typeamb" name="typeamb">
										<option selected value hidden disabled>Please select</option>
										<option value="1">Type 1 (Basic Life Support)</option>
										<option value="2">Type 2 (Advance Life Support)</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<p>Ambulance Count:</p>
								<div class="mb-3">
									<input type="number" class="form-control" id="noofamb" name="noofamb" placeholder="Ambulance Count">
								</div>
							</div>
							<div class="col-md-4">
								<p>Plate Number/Conduction Number:</p>
								<div class="mb-3">
									<input type="text" class="form-control" id="plate_number" name="plate_number" placeholder="Plate Number">
								</div>
							</div> --}}
							<table class="table table-bordered">
								<thead>
									<tr> <td> <button class="btn btn-success" id="buttonId"><i class="fa fa-plus-circle"></i></button> </td> <th>Ambulance Service(Type 1, Type 2)</th> <th>Ambulance Type(Owned, Outsoured)</th> <th>Details</th> </tr>
								</thead>
								<tbody id="body_amb">
									<tr id="tr_amb">
										<td> <button class="btn btn-danger" onclick="if(! this.parentNode.parentNode.hasAttribute('id')) { this.parentNode.parentNode.parentNode.removeChild(this.parentNode.parentNode); }"><i class="fa fa-minus-circle"></i></button> </td>
										<td>
											<div class="input-group">
											  <div class="input-group-prepend">
											    <label class="input-group-text" for="typeamb"><i class="fa fa-info" data-toggle="tooltip" data-placement="top" title="Lorem ipsum dolar"></i></label>
											  </div>
											  <select class="form-control" id="typeamb" name="typeamb">
													<option selected value hidden disabled>Please select</option>
													<option value="1">Type 1 (Basic Life Support)</option>
													<option value="2">Type 2 (Advance Life Support)</option>
												</select>
											</div>
										</td>
										<td>
											<select class="form-control" id="ambtyp" name="ambtyp">
												<option selected value hidden disabled>Please Select</option>
												<option value="1">Outsource</option>
												<option value="2">Owned</option>
											</select>
										</td>
										<td> 
											<div class="row">
												<div class="col-md">
													<input type="text" class="form-control" id="plate_number" name="plate_number" placeholder="Plate Number/Conduction Sticker"> 
												</div>
												<div class="col-md" hidden>
													<input type="text" class="form-control" id="ambOwner" name="ambOwner" placeholder="Owner"> 
												</div>
											</div>
											
										</td>
									</tr>
								</tbody>
							</table>
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
								<p>Ancillary/Clinical Services</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="addCLick mb-3">
									<div class="row" id="Anc"></div>
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Add on Services</p>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="addCLick mb-3" id="oAnc">
								</div>
							</div>
						</div>
						{{-- <div class="row col-border-right" style="border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<p>Others, please specify: <button class="btn btn-success" id="buttonId1"><i class="fa fa-plus-circle"></i></button></p>
								<div class="mb-3" id="paste_others">
									<div id="copy_others" class="input-group mb-3">
									  <div class="input-group-prepend" style="cursor: pointer;" onclick="if(! this.parentNode.hasAttribute('id')) { this.parentNode.parentNode.removeChild(this.parentNode); }">
									    <span class="input-group-text bg-danger" id="basic-addon1"><i class="fa fa-times-circle text-white"></i></span>
									  </div>
									  <input type="text" class="form-control" name="others_oanc" placeholder="Other Ancillary Services" aria-label="Other Ancillary Services" aria-describedby="basic-addon1">
									</div>
								</div>
							</div>
						</div> --}}

						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>Classification According to 
									{{-- <strong id="hfep1" style="float: right;">Assigned Region: {{((isset($fAddress[0]->assRgnDesc) > 0) ? $fAddress[0]->assRgnDesc : "No Assigned Region")}}</strong>
									<br> --}}
								</p>
							</div>
							<div class="col" id="hfepCol">
								<div class="custom-control custom-checkbox mr-sm-2" style="float: right;">
							        <input type="checkbox" class="custom-control-input" id="hfep" name="hfep" value="1">
							        <label class="custom-control-label text-danger" for="hfep">HFEP Funded</label>
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
						</div>
						
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<p class="req">Institutional Character:</p>
								<div class="mb-3">
									<select class="form-control" id="facmode" disabled name="facmode">
										<option selected value hidden disabled>Please select</option>
										@foreach($facmode AS $each)
										<option value="{{$each->facmid}}">{{$each->facmdesc}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<input type="hidden" value="{{$_aptid}}" id="aptid" name="aptid">
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
								<p id="toChangeOnHDS">Authorized Bed Capacity</p>
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
								<div class="mb-3 addCLick" id="cl_serv">
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
								<p>Main Pharmacy:</p>
								<div class="mb-3">
									<input type="number" class="form-control" id="noofmain" name="noofmain" placeholder="Main Pharmacy">
								</div>
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
						<div class="row col-border-right hideMeIfHospital" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid; background-color: #bfcddc;">
							<div class="col">
								<p>For Clinical Laboratory</p>
							</div>
						</div>
						<div class="row col-border-right hideMeIfHospital" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;">
							<div class="col-md-12">
								<div class="mt-3 mb-3">
									<select class="form-control" name="clab" id="clab">
										<option selected value="Not Applicable">Not Applicable</option>
										<option value="1">Primary</option>
										<option value="2">Secondary</option>
										<option value="3">Tertiary</option>
									</select>
								</div>
							</div>
						</div>
						<div class="row col-border-right" style="border-top: 1px solid; border-right: 1px solid; border-left: 1px solid;"></div>
					</div>
					{{-- @if(! isset($hideExtensions)) --}}
					<div class="card-footer">
						<div class="remthis pull-right" id="cModal">
							<button class="btn btn-success" data-toggle="modal" data-target="#confirmModal">{{$_dispData}}</button>
						</div>
						<div class="ml-3 pull-right">
							<a href="{{asset('client1/apply')}}"><button class="btn btn-danger">Back</button></a>
						</div>
					</div>
					{{-- @endif --}}
				</div>
			</div>
			{{-- new col --}}
			<div class="col-md-4">
				<div class="accordion" id="accordionExample">
					@if($aptid == 'R')
					<div class="card mb-3" style="background-color: #03a9f4!important">
					    <div class="card-header" id="headingOne">
					      <h5 class="mb-0">
					        <button class="btn btn-link text-white" aria-expanded="true" aria-controls="collapseOne" style="text-decoration: none!important">
					          <i class="fa fa-exclamation-circle"></i> Note: Please settle your requirements first on <a class="text-white" href="https://ohsrs.doh.gov.ph"><u>OHSRS</u></a>
					        </button>
					      </h5>
					    </div>
				  	</div>
				  	@endif

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
				      				<td colspan="2">No Services selected.</td>
				      			</tr>
				      		</tbody>						
				      		<tbody id="serv_chg_not">
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
				    <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
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
				      				<td colspan="2">No Services selected.</td>
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
				    <div id="collapseThree" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
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
		
		var mclass = JSON.parse('{!!$class!!}'), 
		msubclass = JSON.parse('{!!$subclass!!}'), 
		mserv_cap = JSON.parse('{!!addslashes($serv_cap)!!}'), 
		mappform = JSON.parse('{!!addslashes(json_encode($fAddress))!!}'), 
		mservfac = JSON.parse('{!!$servfac!!}'),
		mgroup = JSON.parse('{!!$group!!}'),
		mAmb = JSON.parse('{!!addslashes($forAmbulance)!!}');
		var curAppid = "", curPtcId = "", curHfserid ="{{((count($fAddress) > 0) ? $fAddress[0]->hfser_id : "")}}", assignedRgn = "", assignedGroup = {} , arrGraphzName = ['groupThis'];
		var unprocessedDueToDelays = [];
		// if(___div != null || ___div != undefined) {
		// 	___div.classList.remove('active');
		// 	___div.classList.add('text-primary');
		// }
		(function() {
			let cRadioId = ['type0', 'type1'], loadearly = true, mhfser_id = "",
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
			function cloneAppend(elId, elInsTo) {
				let dom = document.getElementById(elId);
				if(dom != null || dom != undefined) {
					let dClone = dom.cloneNode(true), insDom = document.getElementById(elInsTo);
					if(insDom != null || insDom != undefined) { 
						dClone.removeAttribute('id'); dClone.classList.add(elId); insDom.appendChild(dClone);
						let doms = insDom.getElementsByClassName(elId)[insDom.getElementsByClassName(elId).length - 1];
						if(doms != undefined || doms != null) { let ndoms = ["input", "select"]; for(let j = 0; j < ndoms.length; j++) { let cdom = doms.getElementsByTagName(ndoms[j]); if(cdom != undefined || cdom != null) { for(let i = 0; i < cdom.length; i++) { cdom[i].value = ""; } } } }
						setValueTypeAmb();
					}
				}
			}
			function setValueTypeAmb() {
				let typeamb = document.getElementsByName('typeamb'), checkValueHere = [['H', 'H2', 'H3'], ['1', '2', '2']], cValue = "";
				checkValueHere[0].forEach(function(a, b, c) { let cDom = document.getElementById(a); if(cDom != undefined || cDom != null) { if(cDom.checked) { cValue = checkValueHere[1][b]; } } });
				if(typeamb != undefined || typeamb != null) { for(let i = 0; i < typeamb.length; i++) { typeamb[i].value = cValue; for(let j = 0; j < typeamb[i].options.length; j++) { if(j > typeamb[i].selectedIndex) { continue; } 
				// typeamb[i].options[j].hidden = ((typeamb[i].options[j].value !== cValue) ? true: false); 
			} } }
			}
			function removeClone(clName) {
				let dom = document.getElementsByClassName(clName);
				if(dom != null || dom != undefined) {
					for(let i = 0; i < dom.length; i++) { dom[i].parentNode.removeChild(dom[i]); }
				}
			}
			function fPTCApp() {
				let token = document.getElementsByName('_token')[0], ocid = document.getElementById('ocid'), classid = document.getElementById('classid'), subClassid = document.getElementById('subClassid'), facmode = document.getElementById('facmode'), funcid = document.getElementById('funcid'), gtype = document.getElementsByName('type'), type = "", ghgpid = document.getElementsByName('hgpid'), gfacid = document.getElementsByName('facid'), uid = document.getElementById('uid'), aptid = document.getElementById('aptid'), @if($_aptid == 'IN')ptcCode = document.getElementById('ptcCode'),@endif noofbed = document.getElementById('noofbed'), clab = document.getElementById('clab'), noofsatellite = document.getElementById('noofsatellite'), noofmain = document.getElementById('noofmain'), noofamb = document.getElementById('noofamb'), groupThis = document.getElementsByClassName('groupThis'), NgroupThis = document.getElementsByName('groupThis'), typeamb = document.getElementsByName('typeamb'), ambtyp = document.getElementsByName('ambtyp'), plate_number = document.getElementsByName('plate_number'), ambOwner = document.getElementsByName('ambOwner'), others_oanc = document.getElementsByName('others_oanc'), mtypeamb = [], mambtyp = [], mambOwner = [], mplate_number = [], mNgroupThis = [], mothers_oanc, hfep = document.getElementById('hfep'), mhfep = 0, massignedRgn = "";
				if(hfep != undefined || hfep != null) { if(hfep.checked) { mhfep = '1'; massignedRgn = mappform[0]['rgnid']; } else { mhfep = '0'; massignedRgn = assignedRgn; } }
				if(massignedRgn == "rgn") { massignedRgn = mappform[0]['rgnid']; }
				let sArr = ['_token='+token.value, 'uid='+uid.value, 'appid='+curAppid, 'ocid='+ocid.value, 'classid='+classid.value, 'subClassid='+subClassid.value, 'facmode='+facmode.value, 'funcid='+funcid.value, 'aptid='+aptid.value, @if($_aptid == 'IN')'ptcCode='+ptcCode.value,@endif 'noofbed='+noofbed.value, 'clab='+clab.value, 'noofsatellite='+noofsatellite.value, 'noofmain='+noofmain.value, 'noofamb='+noofamb.value, 'hfep_funded='+mhfep, 'assignedRgn='+massignedRgn];
				if(ghgpid != null || ghgpid != undefined) { for(let i = 0; i < ghgpid.length; i++) { if(ghgpid[i].checked) {
					sArr.push('hgpid[]='+ghgpid[i].value);
				} } }
				if(gfacid != null || gfacid != undefined) { for(let i = 0; i < gfacid.length; i++) { if(gfacid[i].checked) {
					sArr.push('facid[]='+gfacid[i].value);
				} } }
				if(groupThis != null || groupThis != undefined) { for(let i = 0; i < groupThis.length; i++) { if(groupThis[i].checked) {
					sArr.push('facid[]='+groupThis[i].value);
				} } }

				if($('[name=ambtyp]').find('option[value=2]:selected').length){
					if($('[name=typeamb]').find('option[value=1]:selected').length){
						sArr.push('facid[]=ASP');
					}
					if($('[name=typeamb]').find('option[value=2]:selected').length){
						sArr.push('facid[]=ASP2');
					}
				}

				// if(others_oanc != null || others_oanc != undefined) { for(let i = 0; i < others_oanc.length; i++) { mothers_oanc.push(others_oanc[i].value); } sArr.push('others_oanc='+JSON.stringify(mothers_oanc)); }
				if(typeamb != null || typeamb != undefined) { for(let i = 0; i < typeamb.length; i++) { mtypeamb.push(typeamb[i].value); } sArr.push('typeamb='+JSON.stringify(mtypeamb)); }
				if(ambtyp != null || ambtyp != undefined) { for(let i = 0; i < ambtyp.length; i++) { mambtyp.push(ambtyp[i].value); } sArr.push('ambtyp='+JSON.stringify(mambtyp)); }
				if(plate_number != null || plate_number != undefined) { for(let i = 0; i < plate_number.length; i++) { mplate_number.push(plate_number[i].value); } sArr.push('plate_number='+JSON.stringify(mplate_number)); }

				if(ambOwner != null || ambOwner != undefined) { 
					for(let i = 0; i < ambOwner.length; i++) { 
						mambOwner.push(ambOwner[i].value); 
					} 
					sArr.push('ambOwner='+JSON.stringify(mambOwner)); 
				}

				if(NgroupThis != null || NgroupThis != undefined) { for(let i = 0; i < NgroupThis.length; i++) { if(NgroupThis[i].checked) {
					sArr.push('facid[]='+NgroupThis[i].value);
				} } }
				console.log("sArr")
				console.log(sArr)
				insErrMsg('warning', 'Sending request.');
				sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/fLTOApp')}}", "POST", true, {
					functionProcess: function(arr) {
						let aBol = true;
						arr.forEach(function(a, b, c) {
							if(a !== true) {
								aBol = false;
								insErrMsg('danger', a);
								setTimeout(function() { window.scroll({top: 0, left: 0, behavior: 'smooth'}) }, 500)
							}
						});
						if(aBol) {
							@if(! isset($hideExtensions))
							window.location.href="{{asset('client1/apply/assessmentReady')}}/{{$fAddress[0]->appid}}"
							@else
							alert('Application Updated');
							location.reload();
							@endif
						}
					}
				});
			}

			if(typeof(mgroup) != 'undefined' && mgroup.length){
				mgroup.forEach(function(index, el) {
					arrGraphzName.push(index['grphrz_name']);
				});
			}

			function findChkName(arrCol) {


				//for filter of no payments
				let facilitiesToExemp = 
					[
					//aptid
						['IN',
							//options NOTE: 1st parameter is ID and must be unique, second is DATA
							[
								['ocid',['G']]
							],
							//facilities 
							['H','H2','H3']
						]
					], 
					currentApplicationStatus = '{{$_aptid}}',
					arrTemp = [];
				for (var i = 0; i < facilitiesToExemp.length; i++) {
					//check if same as currentapplicationstatus
					if(currentApplicationStatus == facilitiesToExemp[i][0]){
						for (var j = 0; j < facilitiesToExemp[i][1].length; j++) {
							//check for value of first paramenter on second argument
							if( $.inArray($('#'+facilitiesToExemp[i][1][j][0]).val(), facilitiesToExemp[i][1][j][1]) >=0 ){

								if(document.getElementsByName('facid').length){
									//check for selected facilities

									document.getElementsByName('facid').forEach(function(el,key){
										if(el.checked){
											if( $.inArray(el.value, facilitiesToExemp[i][2]) >=0 ){
												arrTemp.push(true);
											}
										}
									})


								}
								
							} 


						}
					}
				}
				let serv_chg = document.getElementById('serv_chg');
				if(arrTemp.length <= 0){
					let thisFacid = [], appendToPayment = ['groupThis'], hospitalFaci = ['H','H2','H3'];
					let sArr = ['_token='+document.getElementsByName('_token')[0].value, 'appid='+curAppid, 'hfser_id='+curHfserid, 'aptid='+document.getElementById('aptid').value];
					if(Array.isArray(arrCol)) {
						for(let i = 0; i < arrCol.length; i++) {
					  		sArr.push('facid[]='+arrCol[i]); 
					  		thisFacid.push(arrCol[i]);
						} 
					}

					if(!document.getElementById('6').checked){
						for(let j = 0; j < thisFacid.length; j++) {
							if($.inArray(thisFacid[j], hospitalFaci) < 0){
								if(document.getElementsByName('ambtyp').length){
									for(let k = 0; k < document.getElementsByName('ambtyp').length; k++) {
										document.getElementsByName('ambtyp')[k].value = "";
									} 
								}
							}
						} 
					}

				
					
					sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/getServiceCharge')}}", "POST", true, {
						functionProcess: function(arr) {

							
							if(serv_chg != undefined || serv_chg != null) {
								if(arr.length > 0) {
									serv_chg.innerHTML = '';
									for(let i = 0; i < arr.length; i++) {
										serv_chg.innerHTML += '<tr><td>'+arr[i]['facname']+'</td><td>&#8369;&nbsp;<span>'+(parseInt(arr[i]['amt'])).toFixed(2)+'</span></td></tr>';
									}
								} else {
									serv_chg.innerHTML = '<tr><td colspan="2">No Services selected.</td></tr>';
								}
							}
						}
					});

				} else {
					serv_chg.innerHTML = '<tr><td colspan="2">No Payment Necessary.</td></tr>';
				}

			}
			function getChargesPerApplication() {
				let sArr = ['_token='+document.getElementsByName('_token')[0].value, 'appid='+curAppid, 'aptid='+document.getElementById('aptid').value, 'hfser_id='+mhfser_id], ghgpid = document.getElementsByName('hgpid');
				if(ghgpid != null || ghgpid != undefined) { for(let i = 0; i < ghgpid.length; i++) { if(ghgpid[i].checked) {
					sArr.push('hgpid[]='+ghgpid[i].value);
				} } }
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

				getChargesPerAmb();
				
			}
			function getChargesPerAmb() {

				let sArr = ['_token='+document.getElementsByName('_token')[0].value, 'appid='+curAppid], theuseless = [], ambtyp = document.getElementsByName('ambtyp'), plate_number = document.getElementsByName('plate_number'), ambOwner = document.getElementsByName('ambOwner'), amount = 0;
				if(ambtyp != null || ambtyp != undefined) { 
					for(let i = 0; i < ambtyp.length; i++) { 
						if(ambtyp[i].value == '1') { 
							plate_number[i].placeholder = "Number of Ambulance"; 
							ambOwner[i].parentElement.removeAttribute('hidden');
						} 
						if(ambtyp[i].value == '2') { 
							amount = amount + ((amount < 1) ? {{($ambcharges[0]->amt + $ambcharges[1]->amt)}} : {{$ambcharges[0]->amt}}); 
							plate_number[i].placeholder = "Plate Number/Conduction Sticker"; 
							ambOwner[i].parentElement.setAttribute('hidden', true);
							ambOwner[i].value = "";
						} 
					} 
					sArr.push('ambamt='+amount); }
				sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/getChargesPerAmb')}}", "POST", true, {
					functionProcess: function(arr) {
						let serv_chg_not = document.getElementById('serv_chg_not'); serv_chg_not.innerHTML = "";
						if(arr.length > 0) {
							for(let i = 0; i < arr.length; i++) {
								serv_chg_not.innerHTML += '<tr><td>'+arr[i]['chg_desc']+'</td><td>&#8369;&nbsp;<span>'+(parseInt(arr[i]['amt'])).toFixed(2)+'</span></td></tr>'
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
			function retArrReqMultiple(elName, isCheck) {
				if(elName.length){
					let idom;
					let retArr = [];
					for(let k = 0; k < elName.length; k++) {
						idom = document.getElementsByName(elName[k]);
						if(idom != undefined || idom != null) { 
							for(let i = 0; i < idom.length; i++) { 
								if(typeof isCheck == "boolean") { 
									if(idom[i].checked == isCheck) {
										retArr.push(idom[i].value);
									} 
								} 
							} 
						}
					}
					return retArr;
				}
			}

			function retArrReqChk(elName, isCheck) {
				let idom = document.getElementsByName(elName), retArr = [], defAssigned = "";
				if(idom != undefined || idom != null) { for(let i = 0; i < idom.length; i++) { if(typeof isCheck == "boolean") { if(idom[i].checked == isCheck) {
					mserv_cap.forEach(function(a, b ,c) { if(a.facid == idom[i].value) { defAssigned = a.assignrgn; } });
					retArr.push(idom[i].value); assignedRgn = defAssigned;
				} } } }
				return retArr;
			}
			function insInId(idom, arr, typeInput, arrCol, insId, selArr, clId, thisnewgrpname) {
				if(arr.length > 0) {
					let apString = "", selString = '<option selected value hidden disabled>Please select</option>', newLength = ((insId.includes("groupThis")) ? 1 : 3), newString = thisnewgrpname;
					for(let i = 0; i < Math.ceil(arr.length/newLength); i++) {
						let iMin = i * (newLength), iMax = iMin + newLength, mMax = ((iMax > arr.length) ? arr.length : iMax);
						apString += '<div class="row">';
						for(let j = iMin; j < mMax; j++) {
							selString += '<option value="'+arr[j][arrCol[0]]+'">'+arr[j][arrCol[1]]+'</option>';
							// if(elName == 6){
							apString += '<div class="col-md-'+(12/newLength)+'"><div class="custom-control custom-'+typeInput+' mr-sm-2">'+
									        '<input type="'+typeInput+'" class="custom-control-input '+((newString == null) ? 'groupThis' : '')+'" id="'+arr[j][arrCol[0]]+'" name="'+((newString == null) ? arr[j]['grphrz_name'] : newString)+'" value="'+arr[j][arrCol[0]]+'" '+((arr[j]['ischecked'] != undefined || arr[j]['grphrz_name'] != null) ? arr[j]['ischecked'] : "")+'>'+
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
					if(arr.length == 1) { 
						findChkName([arr[0][arrCol[0]]]);
					}
					if(Array.isArray(clId)) {
						for(let i = 0; i < clId.length; i++) {
							document.getElementById(clId[i]).innerHTML = ((insId in selArr) ? '' : '<option selected value hidden disabled>Please select</option>'); 
						} 
					}
				} else {
					idom.innerHTML = ((insId in selArr) ? '' : '<option selected value hidden disabled>Please select</option>'); 
				} 
			}
			function findSelName(elName, colName, tblName, insId, arrCol, clId) {
				// console.log(elName, colName, tblName, insId, arrCol, clId);
				let dom = document.getElementById(elName), 
				arr = [], 
				forDispArr = [], 
				selArr = { hgpid1: 'hgpid1', hgpid5: 'hgpid5', hgpid6: 'hgpid6', oAnc: 'oAnc', cl_serv: 'cl_serv', Anc: 'Anc' }, 
				ifRadio = { hgpid5: 'hgpid5', hgpid6: 'hgpid6', cl_serv: 'cl_serv' }, 
				// this is for multiple selection
				selAnArr = ['hgpid1', 'hgpid5', 'hgpid6', 'oAnc', 'cl_serv', 'Anc'], 
				procTbl = function(eDom) { 
					if(window[tblName] != undefined){
						window[tblName].forEach(function(a, b, c) {
							if(elName == '6'){
								if(document.getElementById('funcid').value == 2){
									if(a['forSpecialty'] == 1 && a['hfser_id'] == 'LTO') {
										arr.push(a); 
									} 
								} else {
									if(a[colName] == eDom.value && a['forSpecialty'] != 1) {
										arr.push(a); 
									} 
								}
							} else {
								if(a[colName] == eDom.value) {
									arr.push(a); 
								} 
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
				}, 
				hideMeIfHospital = document.getElementsByClassName('hideMeIfHospital'), 
				showifHospital = document.getElementsByClassName('showifHospital'),
				showForAmb = document.getElementsByClassName('showAmb');
				insId = ($('#'+insId).length > 0 ? insId : 'cl_serv');
				if(dom != null || dom != undefined) {
					let idom = document.getElementById(insId), typeInput = ((insId in ifRadio) ? "radio" : "checkbox");
					if(insId in selArr) {
						if(insId != 'oAnc') { selAnArr.forEach(function(a, b, c) {
							if(a != insId) {
								document.getElementById(a).innerHTML = "";
							}
						});
						if(hideMeIfHospital != undefined || hideMeIfHospital != null) { for(let i = 0; i < hideMeIfHospital.length; i++) { if(insId == "hgpid6") { hideMeIfHospital[i].setAttribute('hidden', true); } else { hideMeIfHospital[i].removeAttribute('hidden'); } } }
						if(showifHospital != undefined || showifHospital != null) { for(let j = 0; j < showifHospital.length; j++) { if(insId != "hgpid6") { showifHospital[j].setAttribute('hidden', true); } else { showifHospital[j].removeAttribute('hidden'); } } }
						if((mAmb != undefined || mAmb != null)) { 
							
							if($.inArray(parseInt(elName), mAmb) >= 0) { 
								$('.showAmb').removeAttr('hidden');
							} 
							else { 
								$('.showAmb').attr('hidden',true);
							} 
						}


						}
						if(dom.checked) {
							procTbl(dom);
							if(dom.value == '6') { document.getElementById('noofmain').value = "1"; }
						}
					} else { 
						procTbl(dom);
					}
					if(idom != null || idom != undefined) {
						if(arr.length == 1) { arr[0].ischecked = 'checked'; }
						insInId(idom, arr, typeInput, arrCol, insId, selArr, clId, ((insId == 'oAnc') ? 'groupThis' : 'facid'));
						if(colName == "hgpid") { 
							findChkName(retArrReqChk('facid', true)); 
						}
					}
				}
				getChargesPerApplication();
			}

			function processInput(toCheckbox = false){
				setTimeout(function() {
					if(toCheckbox){
						$('[name=facid]').attr('type','checkbox').parent().removeClass('custom-radio').addClass('custom-checkbox');
					} else {
						$('[name=facid]').attr('type','radio').parent().removeClass('custom-checkbox').addClass('custom-radio');
					}
				}, 10);
			}

			function getAnc(theId) {
				if(typeof(theId) !== 'undefined' && theId.length){
					let arrAddon = [];
					$.ajax({
						url: '{{asset('client1/request/customQuery/getAncillary')}}',
						dataType: "json", 
	    				async: false,
						method: 'POST',
						data: {_token:$("input[name=_token]").val(),id: theId, selected : theId, from: 1},
						success: function(a){
							arrAddon.push(JSON.parse(a));
						}
					});
					findSelName(Number($('[name=hgpid]:checked').attr('id')), 'hgpid', arrAddon[0], 'oAnc', ['facid', 'facname'], []);
				}
			}

			function getGoAncillary(theId, arrCol) {
				let sArr = ['_token='+document.getElementsByName('_token')[0].value], forAnc = arrCol[0];
				if(Array.isArray(arrCol)) { for(let i = 0; i < arrCol.length; i++) { sArr.push('facid[]='+arrCol[i]); } }
				sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/getGoAncillary')}}", "POST", true, {
					functionProcess: function(arr) {
						getAnc(forAnc);
						let Anc = document.getElementById('Anc'), theuseless = {  };
						if(arr.length > 0) { if(arr[1].length > 0) {
							Anc.innerHTML = "";
							for(let j = 0; j < arr[1].length; j++) {
								let mservfacArr = arr[2], arrSendPlay = [], addThisGo = { hgpid1: 'hgpid1', hgpid5: 'hgpid5', hgpid6: 'hgpid6', oAnc: 'oAnc', cl_serv: 'cl_serv' };
								Anc.innerHTML += '<div class="col-md-'+(12/arr[1].length)+'"><strong>'+arr[1][j]['anc_name']+'</strong><div id="groupThis'+arr[1][j]['servtype_id']+'"></div></div>';

								arr[0].forEach(function(a, b, c) { 
									if(a.servtype_id == arr[1][j]['servtype_id']) { 
										if(!(a.grphrz_name in theuseless)) { 
											// a.ischecked = "checked"; 
											theuseless[a.grphrz_name] = a.grphrz_name; 
										} 
										arrSendPlay.push(a); 
									} 
								});

								addThisGo['groupThis'+arr[1][j]['servtype_id']+''] = 'groupThis'+arr[1][j]['servtype_id']+'';
								if(arrSendPlay.length == 1) { arrSendPlay[0].ischecked = 'checked'; }
								insInId(document.getElementById('groupThis'+arr[1][j]['servtype_id']+''), arrSendPlay, 'radio', ['facid', 'facname'], 'groupThis'+arr[1][j]['servtype_id']+'', addThisGo, [], null);
								if(loadearly) { 
									loadearly = false; 
									if(mappform.length > 0) { 
										for(let i = 0; i < mservfacArr.length; i++) { 
											if(typeof(mservfac[i]) != 'undefined'){
												for(let j = 0; j < mservfac[i].length; j++) {
													let idom = document.getElementById(mservfac[i][j]['facid']);
													if(idom != undefined || idom != null) { 
														idom.checked = true;
													}
												}
											}
										} 
									} 
								}
							}
						} }
						// new added timeout for letting checked
						setTimeout(function() {
							if($.inArray(theId, arrGraphzName) < 0){
								arrGraphzName.push(theId);
							}
							let retArr = retArrReqMultiple(['groupThis',theId, 'AAA', 'BLD', 'PHM', 'XRAY'], true);
							findChkName(retArr);
						}, 10);
						$("#Anc").find('div:eq(0):visible input[type=radio]').each(function(index, el) {
							$(el).prop('checked',true);
						});
					}
				});
			}
			function remThis() {
				let idom = document.getElementsByClassName('remthis'), ptcbody = document.getElementById('ptcbody');
				if(idom != null || idom != undefined) { 
					for(let i = 0; i < idom.length; i++) { @if($_dispSubmit) if(i == 0) { continue; } @endif idom[i].parentNode.removeChild(idom[i]); 
					} 
				}
				fPTCApp = undefined;
				if(ptcbody != undefined || ptcbody != null) { ptcbody.disabled = true; }
			}
			// display choosen service capabilities
			function fSelServ(elName) {
				let retArr = retArrReqChk(elName, true);
				getGoAncillary(elName, retArr);
				if(retArr != undefined && retArr != null && retArr.length > 0){
					let desc = $("#levelSelected");
					let anc = $("#ancillary");
					$.ajax({
						url: '{{asset('client1/request/customQuery/getApplyLoc')}}',
						dataType: "json", 
						method: 'POST',
						data: {_token:$("input[name=_token]").val(),id: retArr[0],hfer: '{{$hfer}}'},
						success: function(a){
							let ret = JSON.parse(a);
							if(ret.length > 0) {
								$("#proapp").empty().append(
									'<tr>'+
					      				'<td>'+
					      				ret[0]['applytofaci']+
					      				'</td>'+
					      				'<td>'+
					      				ret[0]['applytoLoc']+
					      				'</td>'+
					      			'</tr>'
								)
							}
						}
					})
					if($.inArray(retArr[0], ['HDS']) >= 0){
						$('[name=noofbed]').attr('placeholder','Dialysis Station');
						$("#toChangeOnHDS").html('Authorized Dialysis Station');
					} else {
						$('[name=noofbed]').attr('placeholder','Bed Capacity');
						$("#toChangeOnHDS").html('Authorized Bed Capacity');
					}
					switch (retArr[0]) {
						case 'H':
							desc.empty().append('Minimum Requirements for Hospital Level 1');
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
				      			// '<tr>'+
				      			// 	'<td>'+
				      			// 	'Dental Clinic'+
				      			// 	'</td>'+
				      			// '</tr>'+
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
							desc.empty().append('Minimum Requirements for Hopsital Level 2');
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
							desc.empty().append('Minimum Requirements for Hospital Level 3');
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
				// findChkName(retArr);
				setValueTypeAmb();
			}
			//for displaying saved data
			function procChkSelData() {
				if(mappform.length > 0) {
					let mappformArr = ['ocid', 'classid', 'subClassid', 'facmode', 'funcid', 'aptid', 'ptcCode', 'noofbed', 'noofsatellite', 'clab', 'noofmain'], 
					forAmb = ['noofamb', 'typeamb', 'ambtyp', 'plate_number', 'ambOwner'],
					chReq = [['ocid', 'mclass', 'classid', ['classid', 'classname'], ['subClassid']], ['isSub', 'msubclass', 'subClassid', ['classid', 'classname'], []], [], [], [], [], [], [], []], 
					mappformArrChk = ['ocid', 'facmode', 'funcid', 'aptid', 'noofbed', 'noofmain', 'ptcCode', 'clab'], 
					premThis = true, hfep = document.getElementById('hfep');
					curAppid = mappform[0]['appid'];
					mhfser_id = mappform[0]['hfser_id'];
					let idomChk = { typeamb: 'typeamb', ambtyp: 'ambtyp', plate_number: 'plate_number', ambOwner: 'ambOwner' };
					for(let i = 0; i < mappformArr.length; i++) {
						let idom = document.getElementById(mappformArr[i])
						if(idom != undefined || idom != null) {
							if(mappform[0][mappformArr[i]] != null) {
							 idom.value = mappform[0][mappformArr[i]]; 
							}
							if(chReq[i] != undefined) { 
								if(chReq[i].length > 0) { 
									findSelName(idom.id, chReq[i][0], chReq[i][1], chReq[i][2], chReq[i][3], chReq[i][4], []); 
								} 
							}
							if(mappformArr[i] == "ocid") { if(idom.value == "G") { } }
						}
					}
					if(Array.isArray(mservfac)) {
						let mservfacArr = ['hgpid', 'facid'], 
						chReq = [['hgpid', 'mserv_cap', 'serv_cap', ['facid', 'facname'], [], ['facilitytyp', 'hgpid']]];
						for(let i = 0; i < mservfacArr.length; i++) { 
							for(let j = 0; j < mservfac[i].length; j++) {
								
								let idom = document.getElementById(mservfac[i][j][mservfacArr[i]]);
								if(idom != undefined || idom != null) { 
									idom.checked = true; 
									if(chReq[i] != null || chReq[i] != undefined) {
										findSelName(idom.id, chReq[i][0], chReq[i][1], mservfacArr[i] + mservfac[i][j][mservfacArr[i]], chReq[i][3], chReq[i][4]); 

									}
									// if(i == 0) { getAnc(idom); }
								} 
								else {
									unprocessedDueToDelays.push($.escapeSelector(mservfac[i][j][mservfacArr[i]]));
								}
							}
							if(i == 1) { 
								fSelServ(mservfacArr[i]);
							}
						}
						if(unprocessedDueToDelays.length > 0){
							processUnproccessedSelectors('ancillary',unprocessedDueToDelays,chReq);
						}
					}
					for(let k = 0; k < forAmb.length; k++) {
						if(forAmb[k] in idomChk) {
							if(mappform[0][forAmb[k]] != null) {
								let curValue = JSON.parse(mappform[0][forAmb[k]]), 
								curName = document.getElementsByName(forAmb[k]);
								if(curName.length < curValue.length) {
									addNewRows(curValue.length, 'tr_amb', 'body_amb');
								}
								for(let l = 0; l < curValue.length; l++) {
									curName[l].value = curValue[l];
								}
							}
							getChargesPerAmb();
						}
					}


					if(hfep != undefined || hfep != null) { hfep.checked = ((mappform[0]['hfep_funded'] == 1) ? true : false); }
					mappformArrChk.forEach(function(a, b, c) {
						let six = document.getElementById('6'), ifHospital = { noofmain: 'noofmain' }, ifNotHospital = { clab: 'clab' }; 
						if(mappform[0][a] == null) { if(six != undefined || six != null) { if(six.checked) { if(a in ifHospital) { premThis = false; } else { premThis = premThis; } } else { if(a in ifNotHospital) { premThis = false; } else { premThis = premThis; } } } else { premThis = premThis; } }
					});
					if(mappform[0]['canapply'] == 1) {
						premThis = false;
					}
					@if(! isset($hideExtensions))
					if(premThis) {
						remThis();
					}
					@endif
					// chkApOop();

				}
			}
			//end

			function processUnproccessedSelectors(onwhich,selector,requirements){
				switch (onwhich) {
					case 'ancillary':
						setTimeout(function() {
							if(Array.isArray(mservfac)) {
								for(let i = 0; i < selector.length; i++) { 
									let idom = document.getElementById(selector[i]);
									if(idom != undefined || idom != null) { 
										idom.checked = true; 
									}
								}
							}
						}, 1500);
					break;
				}
			}

			document.getElementById('subForm').addEventListener('click', fPTCApp);
			// for clicked health facility
			let hospital = "6";
			for(let i = 0; i < hgpid.length; i++) {
				hgpid[i].addEventListener('click', function() {
					let loc = ($('#hgpid'+this.id).length > 0 ? 'hgpid'+this.id : 'cl_serv');
					findSelName(this.id, 'hgpid', 'mserv_cap', loc, ['facid', 'facname'], []);
					// getAnc(this);
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
						} else if(target.name == "groupThis" || $.inArray(target.name, arrGraphzName) >= 0) {
							// newly added
							// findChkName(retArrReqChk('groupThis', true));
							findChkName(retArrReqMultiple(arrGraphzName,true));
						}
					});
				}
			}
			window.addEventListener('change', function(e) {
				if(e.target.id == 'ambtyp') {
					getChargesPerAmb();
				}
			});
			window.addEventListener('click', function(e) {
				let insHere = { H1ASCL: '1', H2ATCL: '2', H3ATLH: '3' };
				if(e.target.id == 'H3') {
					
				}
				if(e.target.id in insHere) {
					let clab = document.getElementById('clab');
					if(clab != undefined || clab != null) {
						clab.value = insHere[e.target.id];
					}
				}
			});
			function addNewRows(eDom, clName, pNode) {
				let nValue = ((isNaN(parseInt(eDom))) ? 0 : parseInt(eDom));
				removeClone(clName);
				if(nValue > 1) { for(let i = 0; i < (nValue - 1); i++) {
					cloneAppend(clName, pNode);
				} }
			}
			document.getElementById('buttonId').addEventListener('click', function() {
				// addNewRows(this, 'tr_amb', 'body_amb');
				cloneAppend('tr_amb', 'body_amb');
			});
			// document.getElementById('buttonId1').addEventListener('click', function() {
				// addNewRows(this, 'tr_amb', 'body_amb');
			// 	cloneAppend('copy_others', 'paste_others');
			// });
			procChkSelData();
			$("#funcid").on('change',function(){
				let loc = ($('#hgpid'+'6').length > 0 ? 'hgpid'+'6' : 'cl_serv');
				findSelName('6', 'hgpid', 'mserv_cap', loc, ['facid', 'facname'], []);
			})

		})();
		$(function () {
		  	$('[data-toggle="tooltip"]').tooltip();
		  	$("#ocid").change(function(event) {
				processHFEPVisibility();
			});
			processHFEPVisibility();

			function processHFEPVisibility(){
				if($('#ocid').find('option:selected').val() == 'P'){
					$("#hfepCol").hide();
					$("#hfep").prop("checked", false);
				} else {
					$("#hfepCol").show();
				}
			}
		});
		if($('#uid').length <= 0){
			$('#ptcbody').append('<input type="hidden" id="uid" value="{{AjaxController::getCurrentUserAllData()['cur_user']}}" hidden="">');
		}
	</script>
	@if(! isset($hideExtensions))
		@include('client1.cmp.footer')
		<script>
			onStep(2);
		</script>
	@endif
</body>
@endsection