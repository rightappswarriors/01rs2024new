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
				<span class="card-title text-center" style="font-family: Cambria;font-size: 33pt"><center><strong>CERTIFICATE OF ACCREDITATION</strong></center></span><br>
				<br>
				<br>
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Owner
					</div>
					<div class="col-md-6" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;{{((isset($retTable->owner)) ? $retTable->owner : "CURRENT_OWNER")}}
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
						:&nbsp;&nbsp;&nbsp;<strong><strong>{{((isset($retTable->facilityname)) ? $retTable->facilityname : "CURRENT_FACILITY")}}</strong></strong>
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
						:&nbsp;&nbsp;&nbsp;{{((isset($facilityTypeId)) ? $facilityTypeId : "No Health Service")}}
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
						 :&nbsp;&nbsp;&nbsp;{{((isset($retTable->rgn_desc) && isset($retTable->provname) && isset($retTable->cmname) && isset($retTable->brgyname)) ? ($retTable->rgn_desc.', '.$retTable->provname.', '.$retTable->cmname.', '.$retTable->brgyname) : "CURRENT_LOCATION")}}
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
						:&nbsp;&nbsp;&nbsp;4A-290-1719-LW-1
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
						:&nbsp;&nbsp;&nbsp;{{date('F j, Y', strtotime( strtotime($each[0]->approvedDate)))}} – {{date('F j, Y', strtotime( strtotime($each[0]->validDate)))}}
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