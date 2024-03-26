@extends('main')
@section('content')
@include('client.cmp.__issuance')
<body>
	@include('client.cmp.nav')
	@include('client.cmp.__msg')
	@include('client.cmp.breadcrumb')
	<script type="text/javascript">
		var ___div = document.getElementById('__issuanceBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
	</script>
	<div class="container mt-5">
		@include('client.cmp.__breadcrumb')
		@isset($hfserTbl)
		<script type="text/javascript">
			var arrBrd = ['Issuance', 'Health Facility Type'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		<h2>Select Facility Type</h2><br>
		@if(count($hfserTbl) > 0) @foreach($hfserTbl AS $hfserRow)
		<?php $_mc = ""; $_fc = ""; $_bc = ""; if(!isset($hfserRow->ifNull)) { if(!isset($hfserRow->cantapply)) { $_mc = "Not Applied"; $_fc = "fa-exclamation-circle"; $_bc = "badge-dark"; } else { $_mc = "Not yet Approved"; $_fc = "fa-question-circle"; $_bc = "badge-warning"; } } else { $_mc = "Applied"; $_fc = "fa-check-circle"; $_bc = "badge-success"; } if(isset($isStatus) && count($isStatus) > 0) { foreach($isStatus AS $isStatusRow) { if($isStatusRow->hfser_id == $hfserRow->hfser_id) { $_mc = $isStatusRow->trns_desc; $_fc = "fa-times-circle"; } } } ?>
		@if(isset($hfserRow->ifNull))<form method="POST" action="{{asset('/client/issuance')}}">
			{{csrf_field()}}
			<input type="hidden" name="hfserId" value="{{$hfserRow->hfser_id}}">@endisset
			<button class="btn btn-block btn-light"><span style="float: left;">{{$hfserRow->hfser_desc}}</span><label class="badge {{$_bc}}" style="float: right;"><i class="fa {{$_fc}}"></i> {{$_mc}}</label></button><hr>
		@if(isset($hfserRow->ifNull))</form>@endisset
		@endforeach @else
		@endif
		@endisset
		{{-- @isset($hfserIdCur) --}}
		<script type="text/javascript">
			var arrBrd = ['Issuance', 'Health Facility Type', 'Report'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		{{-- CON --}}
		<!--
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-6">
						<h6 class="card-title text-center">Republic of the Philippines</h6>
						<h5 class="card-title text-center">Department of Health</h5>
						<h5 class="card-title text-center">{{--((isset($subUserTbl)) ? $subUserTbl[0]->rgn_desc : 'REGION')--}}</h5>
						<h6 class="card-subtitle mb-2 text-center text-muted text-small">doholrs@gmail.com</h6>
					</div>
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 118px; padding-left: 20px;">
					</div>
				</div>
			</div>
			<div class="card-body">
				<br>
				<p class="text-muted" style="float: left;">CON No. {{--date('Y')}}-{{str_pad(((isset($appform)) ? $appform[0]->appid : '_1'), 3, '0', STR_PAD_LEFT)--}}</p><br><br>
				<h1 class="text-center">CERTIFICATE OF NEED</h1><br>
				<h5 class="text-center">is herby granted to</h4><br>
				<h3 class="text-center text-uppercase"><strong>{{--$curUser->facilityname--}}</strong></h3><br>
				<h5 class="text-center">located at</h5><br>
				<h4 class="text-center"><strong>{{--((isset($subUserTbl)) ? ($subUserTbl[0]->brgyname.', '.$subUserTbl[0]->cmname.', '.$subUserTbl[0]->provname) : 'LOCATION')--}}</strong></h4><br>
				<br>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Level of Hospital :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{--((isset($subUserTbl)) ? (str_replace(',', ', ', $subUserTbl[0]->facname)) : 'LEVEL_1')--}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Bed Capacity :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{--((isset($curUser->bed_capacity)) ? $curUser->bed_capacity : 0)--}} Bed(s)</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Date Issued :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{--((isset($appform)) ? date("F j, Y", strtotime($appform[0]->t_date)) : 'DATE_ISSUED')--}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Validity Period :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{--((isset($appform)) ? date("F j, Y", (strtotime($appform[0]->t_date)-(86400*2))) : 'DATE_ISSUED')}} to {{((isset($appform)) ? date("F j, Y", ((strtotime($appform[0]->t_date)-(86400*2))+15552000)) : 'DATE_ISSUED')--}}</strong></p>
					</div>
				</div>
				<br><br>
				<h5 class="text-uppercase text-center text-muted">By Authority of the Secretary of Health:</h5>
				<br><br><br>
				<h6 class="text-uppercase text-center"><strong>{{--((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')--}}</strong></h6>
				<p class="text-small text-center text-muted">Director IV</p>
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					<iframe src="{{asset('ra-idlis/resources/views/client/qrcode/index.php')}}?data={{--((isset($appform)) ? ($appform[0]->uid.'_'.$appform[0]->appid) : "CURRENT_USER")--}}" style="border: none !important; height: 91px; width: 91px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
		-->
		{{-- CON --}}
		{{-- PTC --}}
		<!--
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-2 hide-div">
						<img src="{{--asset('ra-idlis/public/img/doh2.png')--}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-10">
						<h5 class="card-title text-center">Republic of the Philippines</h5>
						<h4 class="card-title text-uppercase text-center">Department of Health</h4>
						<h3 class="card-title text-uppercase text-center">Health Facilities and Services Regulatory Bureau</h3>
					</div>
				</div>
			</div>
			<div class="card-body">
				<br>
				<h1 class="text-center">PERMIT TO CONSTRUCT</h1><br>
				<div class="row">
					<div class="col-md-4">
						<p style="float: left;">Owner </p><span style="float: right">:</span>
					</div>
					<div class="col-md-8">
						<p><strong>{{--$curUser->authorizedsignature--}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<p style="float: left;">Name of Facility </p><span style="float: right">:</span>
					</div>
					<div class="col-md-8">
						<p><strong>{{--$curUser->facilityname--}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<p style="float: left;">Location </p><span style="float: right">:</span>
					</div>
					<div class="col-md-8">
						<p><strong>{{--((isset($subUserTbl)) ? ($subUserTbl[0]->brgyname.', '.$subUserTbl[0]->cmname.', '.$subUserTbl[0]->provname) : 'LOCATION')--}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<p style="float: left;">Scope of Work </p><span style="float: right">:</span>
					</div>
					<div class="col-md-8">
						<p><strong>For the construction of an Eight-Storey (8) Level 2 Health with 116 beds with Roof deck and Basement, C.T. Scan, MRI, Thirty (30) station Institution-based Hemodialysis, Ambulatory Surgical Clinic or ASC (Center for Endoscopic and Physiologic Studies), Institution-based  Drug Testing Laboratory and Blood Bank Facility (Note: with notations as indicated on the plans and checklist for appropriate action).</strong></p>
					</div>
				</div>
				<br><br>
				<h5>Terms and Coditions:</h5>
				<br>
				<div class="row">
					<div class="col-md-4" style="vertical-align: bottom;">
						<small class="text-small">PTC No. 18-0413</small>
						<small class="text-small">Date Issued: {{--((isset($appform)) ? date("F j, Y", strtotime($appform[0]->t_date)) : 'DATE_ISSUED')--}}</small>
					</div>
					<div class="col-md-8">
						<h3 class="text-uppercase text-center"><strong>{{--((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')--}}</strong></h3>
						<p class="text-small text-center text-muted">Director IV</p>
					</div>					
				</div>
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					<iframe src="{{asset('ra-idlis/resources/views/client/qrcode/index.php')}}?data={{--((isset($appform)) ? ($appform[0]->uid.'_'.$appform[0]->appid) : "CURRENT_USER")--}}" style="border: none !important; height: 91px; width: 91px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
		-->
		{{-- PTC --}}
	
		{{-- LTO --}}
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-6">
						<span class="card-title text-center" style="font-family: Arial;font-size: 12pt"><center><strong>Republic of the Philippines</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 13pt"><center><strong>DEPARTMENT OF HEALTH</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 14pt"><center><strong>HEALTH FACILITIES AND SERVICES REGULATORY BUREAU</strong></center></span>
						{{-- <h5 class="card-title text-center">((isset($subUserTbl)) ? $subUserTbl[0]->rgn_desc : 'REGION')</h5> --}}
						{{-- <h6 class="card-subtitle mb-2 text-center text-muted text-small">doholrs@gmail.com</h6> --}}
					</div>
					<div class="col-md-3 hide-div">
						&nbsp;
						{{-- <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 118px; padding-left: 20px;"> --}}
					</div>
				</div>
			</div>
			<div class="card-body">
				<br>
				<span class="card-title text-center" style="font-family: Cambria;font-size: 33pt"><center><strong>CERTIFICATE OF ACCREDITATION</strong></center></span><br>
				<br>
				<br>
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Owner
					</div>
					<div class="col-md-6" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;Environmental – Health Laboratory Service Cooperative
					</div>	
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Operated/Managed <br>
						   by (if applicable)
					</div>
					
					<div class="col-md-6" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						<br>:&nbsp;
					</div>
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Name of Facility 
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family:  Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;<strong>ENVIRONMENTAL– HEALTH LABORATORY 
							<br>&nbsp;&nbsp;&nbsp;&nbsp;SERVICE COOPERATIVE</strong>
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Type of Facility
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;Laboratory for Drinking Water Analysis 
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family:Arial; font-size: 12pt">
						Location
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						 :&nbsp;&nbsp;&nbsp;50 Holy Spirit Drive, Don Antonio Heights, 
						 <br>&nbsp;&nbsp;&nbsp;&nbsp;Quezon City, Metro Manila
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Accreditation Number
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;4A-290-1719-LW-1 88
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Validity of Accreditation 
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;01 January 2017 – 31 December 2019
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	


				

				<br><br><br>
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-6">
						<p class="text-uppercase " style="font-family: Cambria;font-size: 12pt;"><strong>By Authority of the Secretary of Health:</strong></p>
						<br><br><br><br>
						<p class="text-uppercase"  style="font-family: Cambria;font-size: 16pt;"><strong>ATTY. NICOLAS B. LUTERO III, CESO III{{--((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')--}}</strong></p>
						<p class="text-small" style="font-family: Cambria;font-size: 14pt;">
							<strong style="margin-left: 7em;">Director IV</strong></p>
					</div>

				</div>
				<br><br><br><br><br><br><br><br>
				
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					<iframe src="{{asset('ra-idlis/resources/views/client/qrcode/index.php')}}?data={{--((isset($appform)) ? ($appform[0]->uid.'_'.$appform[0]->appid) : "CURRENT_USER")--}}" style="border: none !important; height: 91px; width: 91px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
		{{-- LTO --}}

		<!--COA 2-->
		<!--div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-6">
						<span class="card-title text-center" style="font-family: Arial;font-size: 12pt"><center><strong>Republic of the Philippines</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 13pt"><center><strong>DEPARTMENT OF HEALTH</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 14pt"><center><strong>HEALTH FACILITIES AND SERVICES REGULATORY BUREAU</strong></center></span>
						{{-- <h5 class="card-title text-center">((isset($subUserTbl)) ? $subUserTbl[0]->rgn_desc : 'REGION')</h5> --}}
						{{-- <h6 class="card-subtitle mb-2 text-center text-muted text-small">doholrs@gmail.com</h6> --}}
					</div>
					<div class="col-md-3 hide-div">
						&nbsp;
						{{-- <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 118px; padding-left: 20px;"> --}}
					</div>
				</div>
			</div>
			<div class="card-body">
				<br>
				<span class="card-title text-center" style="font-family: Cambria;font-size: 33pt"><center><strong>CERTIFICATE OF ACCREDITATION</strong></center></span><br>
				<br>
				<br>
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Owner
					</div>
					<div class="col-md-6" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;
					</div>	
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Operated/Managed <br>
						   by (if applicable)
					</div>
					
					<div class="col-md-6" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						<br>:&nbsp;
					</div>
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Name of Facility 
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family:  Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;<strong>ST. JAMES ACADEMY </strong>
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Type of Facility
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;Private School Dental Clinic
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family:Arial; font-size: 12pt">
						Location
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						 :&nbsp;&nbsp;&nbsp;Rizal Avenue Extension, Malabon City,
						 <br>&nbsp;&nbsp;&nbsp;&nbsp; Metro Manila
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Accreditation Number
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;13-025-03-DS-2
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Date Issued 
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;13 October 2003
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	


				

				<br><br><br>
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-6">
						<p class="text-uppercase " style="font-family: Cambria;font-size: 12pt;"><strong>By Authority of the Secretary of Health:</strong></p>
						<br><br><br><br>
						<p class="text-uppercase"  style="font-family: Cambria;font-size: 16pt;"><strong>ATTY. NICOLAS B. LUTERO III, CESO III{{--((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')--}}</strong></p>
						<p class="text-small text-center text-muted">Director IV</p>
					</div>
				</div>
				<br><br><br>
				
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					<iframe src="{{asset('ra-idlis/resources/views/client/qrcode/index.php')}}?data={{--((isset($appform)) ? ($appform[0]->uid.'_'.$appform[0]->appid) : "CURRENT_USER")--}}" style="border: none !important; height: 91px; width: 91px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
		<!--end COA 2-->

		<!--COA 3-->
		<!--div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-6">
						<span class="card-title text-center" style="font-family: Arial;font-size: 12pt"><center><strong>Republic of the Philippines</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 13pt"><center><strong>DEPARTMENT OF HEALTH</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 14pt"><center><strong>HEALTH FACILITIES AND SERVICES REGULATORY BUREAU</strong></center></span>
						{{-- <h5 class="card-title text-center">((isset($subUserTbl)) ? $subUserTbl[0]->rgn_desc : 'REGION')</h5> --}}
						{{-- <h6 class="card-subtitle mb-2 text-center text-muted text-small">doholrs@gmail.com</h6> --}}
					</div>
					<div class="col-md-3 hide-div">
						&nbsp;
						{{-- <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 118px; padding-left: 20px;"> --}}
					</div>
				</div>
			</div>
			<div class="card-body">
				<br>
				<span class="card-title text-center" style="font-family: Cambria;font-size: 33pt"><center><strong>CERTIFICATE OF ACCREDITATION</strong></center></span><br>
				<br>
				<br>
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Owner
					</div>
					<div class="col-md-6" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;
					</div>	
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Operated/Managed <br>
						   by (if applicable)
					</div>
					
					<div class="col-md-6" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						<br>:&nbsp;
					</div>
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Name of Facility 
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family:  Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;<strong>PHILIPPINE PHOSPHATE FERTILIZER CORP. </strong>
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Type of Facility
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;Occupational Establishment Dental Clinic

					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family:Arial; font-size: 12pt">
						Location
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						 :&nbsp;&nbsp;&nbsp;Lide, Isabel, Leyte
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Accreditation Number
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;08-08-05-DO-2
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Date Issued 
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;13 October 2003
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	


				

				<br><br><br>
				<div class="row">
					<div class="col-md-6"></div>
					<div class="col-md-6">
						<p class="text-uppercase " style="font-family: Cambria;font-size: 12pt;"><strong>By Authority of the Secretary of Health:</strong></p>
						<br><br><br><br>
						<p class="text-uppercase"  style="font-family: Cambria;font-size: 16pt;"><strong>ATTY. NICOLAS B. LUTERO III, CESO III{{--((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')--}}</strong></p>
						<p class="text-small text-center text-muted">Director IV</p>
					</div>
				</div>
				<br><br><br>
				
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					<iframe src="{{asset('ra-idlis/resources/views/client/qrcode/index.php')}}?data={{--((isset($appform)) ? ($appform[0]->uid.'_'.$appform[0]->appid) : "CURRENT_USER")--}}" style="border: none !important; height: 91px; width: 91px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
		<!--end COA 3-->


		{{-- LTO --}}
		<!-- <div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-6">
						<span class="card-title text-center" style="font-family: Arial;font-size: 12pt"><center><strong>Republic of the Philippines</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 13pt"><center><strong>DEPARTMENT OF HEALTH</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 14pt"><center><strong>HEALTH FACILITIES AND SERVICES REGULATORY BUREAU</strong></center></span>
						{{-- <h5 class="card-title text-center">((isset($subUserTbl)) ? $subUserTbl[0]->rgn_desc : 'REGION')</h5> --}}
						{{-- <h6 class="card-subtitle mb-2 text-center text-muted text-small">doholrs@gmail.com</h6> --}}
					</div>
					<div class="col-md-3 hide-div">
						&nbsp;
						{{-- <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 118px; padding-left: 20px;"> --}}
					</div>
				</div>
			</div>
			<div class="card-body">
				<br>
				<span class="card-title text-center" style="font-family: Arial;font-size: 42pt"><center><strong>LICENSE TO OPERATE</strong></center></span><br>
				<br>
				<br>
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Owner
					</div>
					<div class="col-md-1" style="display: inline">
						<center>:</center>
					</div>
					<div class="col-md-6" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						Lifeline Ambulance Rescue, Inc.
					</div>	
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Operated/Managed <br>
						   by (if applicable)
					</div>
					<div class="col-md-1" style="display: inline">
						<br><center>:</center></div>
					<div class="col-md-6" style="float:left;display: inline;font-family: Century Gothic; font-size: 13">
						&nbsp;
					</div>
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Name of Health Service Provider
					</div>
					<div class="col-md-1" style="display: inline">
						:</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13">
						<strong>LIFELINE AMBULANCE RESCUE, INC.;</strong>
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Type of Health Service
					</div>
					<div class="col-md-1" style="display: inline">
						:</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13">
						Ambulance Service
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Location
					</div>
					<div class="col-md-1" style="display: inline">
						:</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13">
						Grnd. Flr., Valgosons Bldg., 8484 East Service <br>
						Road, km.18, Sucat, 1700 Parañaque City, MM
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Institutional Character
					</div>
					<div class="col-md-1" style="display: inline;float: left">
						:</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13">
						Non-Institution based
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Authorized Ambulance Units
					</div>
					<div class="col-md-1" style="display: inline;float: left">
						:</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13">
						2
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						License Number
					</div>
					<div class="col-md-1" style="display: inline;float: left">
						:</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13">
						13-0001-1618-ASP-2
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>

				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Validity of License
					</div>
					<div class="col-md-1" style="display: inline;float: left">
						:</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13">
						15 September 2016 – 31 December 2018
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>
				

				<br><br>
				<h5 class="text-uppercase text-center text-muted">By Authority of the Secretary of Health:</h5>
				<br><br><br>
				<h6 class="text-uppercase text-center"><strong>{{--((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')--}}</strong></h6>
				<p class="text-small text-center text-muted">Director IV</p>
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					<iframe src="{{asset('ra-idlis/resources/views/client/qrcode/index.php')}}?data={{--((isset($appform)) ? ($appform[0]->uid.'_'.$appform[0]->appid) : "CURRENT_USER")--}}" style="border: none !important; height: 91px; width: 91px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br> -->
		{{-- LTO --}}
		{{-- @endisset --}}
	</div>
</body>
@include('client.cmp.foot')
@endsection