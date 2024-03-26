@extends('main')
@section('content')
@include('client1.cmp.__issuance')
<style>
		.watermarked {
			position: relative;
			content: "";
			display: block;
			width: 100%;
			height: 100%;
			top: 0px;
			left: 0px;
			background-image: url("{{asset('ra-idlis/public/img/watermark/doh.watermark.horizontal.noborder.png')}}");
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;
			z-index: 0;
			-webkit-print-color-adjust: exact;
		}
	</style>
<body>
	<div class="container mt-5">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-6">
						<span class="card-title text-center font-weight-bold" style="font-family: Arial;font-size: 12pt"><center><strong>Republic of the Philippines</strong></center></span>
						<span class="card-title text-center font-weight-bold" style="font-family: Arial;font-size: 13pt"><center><strong>DEPARTMENT OF HEALTH</strong></center></span>
						<span class="card-title text-center font-weight-bold" style="font-family: Arial;font-size: 14pt"><center><strong>{{((isset($director->certificateName)) ? $director->certificateName : 'REGION')}}</strong></center></span>
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
			<div class="{{$retTable[0]->assignedRgn == 'hfsrb'? 'watermarked': 'watermarked'}}">
				<br><br><br>
				<span class="card-title text-center" style="font-family: Arial;font-size: 36pt"><center><strong>AUTHORITY TO OPERATE</strong></center></span><br>
				<br>
				<br>
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Owner
					</div>
					<div class="col-md-6" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;{{((isset($retTable[0]->owner)) ? $retTable[0]->owner : "CURRENT_OWNER")}}
					</div>	
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Operated/Managed <br>
						   by (if applicable)
					</div>
					<div class="col-md-6" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						<br>:&nbsp;
					</div>
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Name of Facility 
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family:  Century Gothic; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;<strong>{{((isset($retTable[0]->facilityname)) ? $retTable[0]->facilityname : "CURRENT_FACILITY")}}</strong>
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Type of Facility
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family:Century Gothic; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;{{((isset($facilityTypeId)) ? $facilityTypeId : "No Health Service")}}
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family:Century Gothic; font-size: 11pt">
						Location
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						 :&nbsp;&nbsp;&nbsp;{{((isset($retTable[0])) ? ($retTable[0]->rgn_desc.', '.$retTable[0]->provname.', '.$retTable[0]->cmname.', '.$retTable[0]->brgyname.', '.$retTable[0]->street_name) : "CURRENT_LOCATION")}}
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Authorization Number
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp; 06-001-1719-CU-BS-1
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Validity
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;03 September 2019 – 31 December 2019
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	
				<br><br><br>
				<div class="row">
					<div class="col-md-5"></div>
					<div class="col-md-6">
						<p class="text-uppercase " style="font-family: Arial;font-size: 11pt;"><strong>By Authority of the Secretary of Health:</strong></p>
						<br><br><br><br>
						<p class="text-uppercase"  style="font-family: Arial;font-size: 16pt;"><strong>{{ucwords($retTable[0]->signatoryname)}}</strong></p>
						<p class="text-small" style="font-family: Arial;font-size: 14pt;">
							<strong style="margin-left: 6em; white-space: pre-line">{{$retTable[0]->signatorypos}}</strong></p>
					</div>
				</div>
				<br><br><br><br><br><br><br><br>
			</div>
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					{{-- <iframe src="{{asset('ra-idlis/resources/views/client1/qrcode/index.php')}}?data={{asset('client1/certificates/view/external/')}}/{{$retTable[0]->appid}}" style="border: none !important; height: 150px; width: 150px;"></iframe> --}}
					<iframe src="{!!url('qrcode/'.$retTable[0]->appid )!!}" style="border: none !important; height: 230px; width: 260px;"></iframe>
				</p>
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
	</div>
</body>
@endsection