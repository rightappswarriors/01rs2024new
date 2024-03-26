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
		@if(isset($hfserRow->ifNull))<form method="GET" action="{{asset('/client/certificates')}}/{{$hfserRow->hfser_id}}/{{$hfserRow->appid}}">
			{{csrf_field()}}
			<input type="hidden" name="hfserId" value="{{$hfserRow->hfser_id}}">@endisset
			<button class="btn btn-block btn-light"><span style="float: left;">{{$hfserRow->hfser_desc}}</span><label class="badge {{$_bc}}" style="float: right;"><i class="fa {{$_fc}}"></i> {{$_mc}}</label></button><hr>
		@if(isset($hfserRow->ifNull))</form>@endisset
		@endforeach @else
		@endif
		@endisset

		@isset($hfserIdCur)
		<script type="text/javascript">
			var arrBrd = ['Issuance', 'Health Facility Type', 'Report'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		@if(strtoupper($hfserIdCur) == "CON")
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-6">
						<h6 class="card-title text-center">Republic of the Philippines</h6>
						<h5 class="card-title text-center">Department of Health</h5>
						<h5 class="card-title text-center">{{((isset($subUserTbl)) ? $subUserTbl[0]->rgn_desc : 'REGION')}}</h5>
						<h6 class="card-subtitle mb-2 text-center text-muted text-small">doholrs@gmail.com</h6>
					</div>
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 118px; padding-left: 20px;">
					</div>
				</div>
			</div>
			<div class="card-body">
				<br>
				<p class="text-muted" style="float: left;">CON No. {{date('Y')}}-{{str_pad(((isset($appform)) ? $appform[0]->appid : '_1'), 3, '0', STR_PAD_LEFT)}}</p><br><br>
				<h1 class="text-center">CERTIFICATE OF NEED</h1><br>
				<h5 class="text-center">is herby granted to</h4><br>
				<h3 class="text-center text-uppercase"><strong>{{$curUser->facilityname}}</strong></h3><br>
				<h5 class="text-center">located at</h5><br>
				<h4 class="text-center"><strong>{{((isset($subUserTbl)) ? ($subUserTbl[0]->brgyname.', '.$subUserTbl[0]->cmname.', '.$subUserTbl[0]->provname) : 'LOCATION')}}</strong></h4><br>
				<br>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Level of Hospital :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{((isset($subUserTbl)) ? (str_replace(',', ', ', $subUserTbl[0]->facname)) : 'LEVEL_1')}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Bed Capacity :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{((isset($curUser->bed_capacity)) ? $curUser->bed_capacity : 0)}} Bed(s)</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Date Issued :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{((isset($appform)) ? date("F j, Y", strtotime($appform[0]->t_date)) : 'DATE_ISSUED')}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Validity Period :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{((isset($appform)) ? date("F j, Y", (strtotime($appform[0]->t_date)-(86400*2))) : 'DATE_ISSUED')}} to {{((isset($appform)) ? date("F j, Y", ((strtotime($appform[0]->t_date)-(86400*2))+15552000)) : 'DATE_ISSUED')}}</strong></p>
					</div>
				</div>
				<br><br>
				<h5 class="text-uppercase text-center text-muted">By Authority of the Secretary of Health:</h5>
				<br><br><br>
				<h6 class="text-uppercase text-center"><strong>{{((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')}}</strong></h6>
				<p class="text-small text-center text-muted">Director IV</p>
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					<iframe src="{{asset('ra-idlis/resources/views/client/qrcode/index.php')}}?data={{((isset($appform)) ? ($appform[0]->uid.'_'.$appform[0]->appid) : "CURRENT_USER")}}" style="border: none !important; height: 91px; width: 91px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
		@elseif(strtoupper($hfserIdCur) == "PTC")
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-2 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
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
						<p><strong>{{$curUser->authorizedsignature}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<p style="float: left;">Name of Facility </p><span style="float: right">:</span>
					</div>
					<div class="col-md-8">
						<p><strong>{{$curUser->facilityname}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<p style="float: left;">Location </p><span style="float: right">:</span>
					</div>
					<div class="col-md-8">
						<p><strong>{{((isset($subUserTbl)) ? ($subUserTbl[0]->brgyname.', '.$subUserTbl[0]->cmname.', '.$subUserTbl[0]->provname) : 'LOCATION')}}</strong></p>
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
						<small class="text-small">Date Issued: {{((isset($appform)) ? date("F j, Y", strtotime($appform[0]->t_date)) : 'DATE_ISSUED')}}</small>
					</div>
					<div class="col-md-8">
						<h3 class="text-uppercase text-center"><strong>{{((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')}}</strong></h3>
						<p class="text-small text-center text-muted">Director IV</p>
					</div>					
				</div>
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					<iframe src="{{asset('ra-idlis/resources/views/client/qrcode/index.php')}}?data={{((isset($appform)) ? ($appform[0]->uid.'_'.$appform[0]->appid) : "CURRENT_USER")}}" style="border: none !important; height: 91px; width: 91px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
		@endif
		@endisset
	</div>
</body>
@include('client.cmp.foot')
@endsection