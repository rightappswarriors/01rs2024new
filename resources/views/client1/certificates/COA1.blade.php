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
						:&nbsp;&nbsp;&nbsp;{{((isset($retTable[0]->owner)) ? $retTable[0]->owner : "CURRENT_OWNER")}}
					</div>	
				</div>
				<!-- <div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Operated/Managed <br>
						   by (if applicable)
					</div>
					<div class="col-md-6" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
						<br>:&nbsp;
					</div>
				</div> -->
				<div class="row">
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
						Name of Facility 
					</div>
					<div class="col-md-5" style="float:left;display: inline;font-family:  Arial; font-size: 13pt">
						:&nbsp;&nbsp;&nbsp;<strong><strong>{{((isset($retTable[0]->facilityname)) ? $retTable[0]->facilityname : "CURRENT_FACILITY")}}</strong></strong>
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
						 :&nbsp;&nbsp;&nbsp;{{((isset($retTable[0])) ? ($retTable[0]->rgn_desc.', '.$retTable[0]->provname.', '.$retTable[0]->cmname.', '.$retTable[0]->brgyname.', '.$retTable[0]->street_name.' '.$retTable[0]->street_number) : "CURRENT_LOCATION")}}
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
					:&nbsp;&nbsp;&nbsp;{{date('F j, Y', strtotime($retTable[0]->approvedDate))}} – {{'December 31, '. date('Y', strtotime('+1 years' ,  strtotime($retTable[0]->approvedDate)))}}
					</div>
					<div class="col-md-1" style="display: inline">
						&nbsp;</div>
				</div>	
				@php
					$str = $newservices;
					$pattern = '/hospital/i';
					$sc = preg_replace($pattern, ' ', $str);
					$str_new = $servname;			
				
				@endphp

				@if(isset($retTable[0]->hgpid))		
					@if($retTable[0]->hgpid == "12" || $retTable[0]->hgpid == "9"  )	
						
					<div class="row">
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Arial; font-size: 12pt">
							Classification
						</div>
						<div class="col-md-5" style="float:left;display: inline;font-family: Arial; font-size: 13pt">
							:&nbsp;&nbsp;&nbsp;
							{{ $str_new  }}
						</div>
						<div class="col-md-1" style="display: inline">
							&nbsp;</div>
					</div>
					
					@endif
				@endif

				<br><br><br>

				<div class="row" style="margin-top:100px; ">
					<div class="col-md-6"  style="vertical-align: bottom;">
						<p class="text-muted text-small" style="text-align: center; padding: 0; margin: 0;">
							{{-- <iframe src="{{asset('ra-idlis/resources/views/client1/qrcode/index.php')}}?data={{asset('client1/certificates/view/external/')}}/{{$retTable[0]->appid}}" style="border: none !important; height: 150px; width: 150px;"></iframe> --}}
							<iframe src="{!!url('qrcode/'.$retTable[0]->appid )!!}" style="border: none !important; height: 230px; width: 260px;"></iframe>
						</p>					
					</div>
					<div class="col-md-6" >
						
						<div class="col-md-12 auth text-uppercase" style="font-family: Cambria;font-size: 12pt; font-weight:bold; text-align: center; ">By Authority of the Secretary of Health:</div>
						
						 <div class="col-md-12 director text-uppercase"  style="font-family: Cambria;font-size: 16pt; font-weight:bold; text-align: center;  margin-top:80px;">{{ucwords($retTable[0]->signatoryname)}}</div>
						
						 <div class="col-md-12 pos text-small" style="font-family: Cambria;font-size: 14pt; text-align: center; font-weight: bold;">
							{{$retTable[0]->signatorypos}}</div>
					</div>
				</div>
				<br><br><br><br><br><br><br><br>
			</div>
			</div>
			<div class="card-footer text-center">

				<b><hr/></b>
				@if(isset($director->ftr_msg_coa))
					<br/><i><b style="font-family: Cambria, Georgia, serif; font-size: 18px">{{$director->ftr_msg_coa}}</b></i>
					<br/><br/>
				@endif
				
				@if(isset($ftr_msg_facility))
					<br/><i><b style="font-family: Cambria, Georgia, serif; font-size: 18px">{{$ftr_msg_facility}}</b></i>
					<br/><br/>
				@endif

				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
	</div>
</body>
@endsection