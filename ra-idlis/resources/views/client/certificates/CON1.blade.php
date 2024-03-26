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
	<style>
		@font-face {
			font-family: NewGothicCenturySchoolBook;
			src: url({{ asset('ra-idlis/public/fonts/NewCenturySchoolbook.ttf') }});
		}
		@font-face {
			font-family: ArialUnicodeMs;
			src: url({{ asset('ra-idlis/public/fonts/ARIALUNI.TTF') }});
		}
	</style>
	<div class="container mt-5">
		@include('client.cmp.__breadcrumb')
		<script type="text/javascript">
			var arrBrd = ['Issuance', 'Health Facility Type', 'Report'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-6">
						<h6 class="card-title text-center">Republic of the Philippines</h6>
						<h5 class="card-title text-center">Department of Health</h5>
						<h5 class="card-title text-center">{{((isset($retTable->rgn_desc)) ? $retTable->rgn_desc : 'REGION')}}</h5>
						<h6 class="card-subtitle mb-2 text-center text-muted text-small">doholrs@gmail.com</h6>
					</div>
					{{-- <div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 118px; padding-left: 20px;">
					</div> --}}
				</div>
			</div>
			<div class="card-body">
				<br>
				<p class="text-muted" style="float: left;">CON No. {{date('Y')}}-{{str_pad(((isset($retTable->appid)) ? $retTable->appid : '_1'), 3, '0', STR_PAD_LEFT)}}</p><br><br>
				<h1 class="text-center">CERTIFICATE OF NEED</h1><br>
				<h5 class="text-center">is herby granted to</h4><br>
				<h3 class="text-center text-uppercase"><strong>{{((isset($retTable->facilityname)) ? $retTable->facilityname : "CURRENT_FACILITY")}}</strong></h3><br>
				<h5 class="text-center">located at</h5><br>
				<h4 class="text-center"><strong>{{((isset($retTable->rgn_desc) && isset($retTable->provname) && isset($retTable->cmname) && isset($retTable->brgyname)) ? ($retTable->rgn_desc.', '.$retTable->provname.', '.$retTable->cmname.', '.$retTable->brgyname.' '.$retTable->street_number) : "CURRENT_LOCATION")}}</strong></h4><br>
				<br>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Level of Hospital :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{((isset($serviceId)) ? (str_replace(',', ', ', $serviceId)) : 'LEVEL_1')}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Bed Capacity :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{((isset($otherDetails->ubn)) ? $otherDetails->ubn : 0)}} Bed(s)</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Date Issued :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{((isset($retTable->t_date)) ? date("F j, Y", strtotime($retTable->t_date)) : 'DATE_ISSUED')}}</strong></p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<p style="float: right;">Validity Period :</p>
					</div>
					<div class="col-md-6">
						<p><strong>{{((isset($retTable->t_date)) ? date("F j, Y", (strtotime($retTable->t_date)-(86400*2))) : 'DATE_ISSUED')}} to {{((isset($retTable->t_date)) ? date("F j, Y", ((strtotime($retTable->t_date)-(86400*2))+15552000)) : 'DATE_ISSUED')}}</strong></p>
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
					<iframe src="{{asset('ra-idlis/resources/views/client/qrcode/index.php')}}?data={{asset('client/certificates')}}/{{
$retTable->hfser_id}}/{{$retTable->appid}}" style="border: none !important; height: 91px; width: 91px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
	</div>
</body>
@include('client.cmp.foot')
@endsection