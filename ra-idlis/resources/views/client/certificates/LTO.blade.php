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
				<span class="card-title text-center" style="font-family: ArialUnicodeMs;font-size: 42pt"><center><strong>LICENSE TO OPERATE</strong></center></span><br>
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
						{{((isset($retTable->owner)) ? $retTable->owner : "CURRENT_OWNER")}}
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
						<strong>{{((isset($retTable->facilityname)) ? $retTable->facilityname : "CURRENT_FACILITY")}}</strong>
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
						{{((isset($facilityTypeId)) ? $facilityTypeId : "No Health Service")}}
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
						{{((isset($retTable->rgn_desc) && isset($retTable->provname) && isset($retTable->cmname) && isset($retTable->brgyname)) ? ($retTable->rgn_desc.', '.$retTable->provname.', '.$retTable->cmname.', '.$retTable->brgyname) : "CURRENT_LOCATION")}}
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
						<strong>{{((isset($retTable->facmdesc)) ? $retTable->facmdesc : "CURRENT_FACILITY")}}</strong>
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
						0
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
						13-0002-H1-2
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
						 01 January 2019 to 31 December 2019
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>
				<br><br><br>

				<div class="row">
					<div class="col-md-5">&nbsp;</div>
					<div class="col-md-7" style="font-family: ArialUnicodeMs; font-size:11pt;">
						<strong>By Authority of the Secretary of Health:</strong>
					</div>
				</div><br><br>
				<div class="row">
					<div class="col-md-4">&nbsp;</div>
					<div class="col-md-8" style="font-family: NewGothicCenturySchoolBook; font-size:16pt;">
						<strong><center>ATTY. NICOLAS B. LUTERO III, CESO III</center></strong>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">&nbsp;</div>
					<div class="col-md-8" style="font-family: NewGothicCenturySchoolBook; font-size:14pt;">
						<center><b>Director IV</b></center>
					</div>
				</div>
				<br><br><br>
				<!-- <h5 class="text-uppercase text-center text-muted">By Authority of the Secretary of Health:</h5>
				<br><br><br>
				<h6 class="text-uppercase text-center"><strong>{{--((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')--}}</strong></h6>
				<p class="text-small text-center text-muted">Director IV</p> -->
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