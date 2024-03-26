@extends('main')
@section('content')
@include('client1.cmp.__issuance')
<body>
	<style>
		@font-face {
			font-family: NewGothicCenturySchoolBook;
			src: url({{ asset('ra-idlis/public/fonts/NewCenturySchoolbook.ttf') }});
		}
		@font-face {
			font-family: ArialUnicodeMs;
			src: url({{ asset('ra-idlis/public/fonts/ARIALUNI.TTF') }});
		}

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

		.headDetL{
			font-family: Candara, Calibri, Segoe, "Segoe UI", Optima, Arial, sans-serif;
			
		}
		.arial { font-family: "Arial Unicode MS", "Lucida Sans Unicode", "DejaVu Sans", "Quivira", "Symbola", "Code2000", ;
			 }
		.dir { 
			 font-size: 25px;}
	    .pos { 
			 font-size: 20px;}

		.contl { 
			 font-size: 20px;}
		.contr { 
			 font-size: 23px;}


		.headDetR{
			font-family: Candara, Calibri, Segoe, "Segoe UI", Optima, Arial, sans-serif;
			
		}
		.tit{font-size: 50px ;}
		.here{font-size: 20px ;}
		.name{font-size: 40px ;}
		.auth{font-size: 23px ;}
		.loc{font-size: 22px ;}
		/* .auth{font-size: px ;} */
		.font-mong {
	font-family: 'Menk Hawang Tig', 'Menk Qagan Tig', 'Menk Garqag Tig', 'Menk Har_a Tig', 'Menk Scnin Tig', 'Oyun Gurban Ulus Tig', 'Oyun Qagan Tig', 'Oyun Garqag Tig', 'Oyun Har_a Tig', 'Oyun Scnin Tig', 'Oyun Agula Tig', 'Mongolian BT', 'Mongolian Baiti', 'Mongolian Universal White', 'Noto Sans Mongolian', 'Mongol Usug', 'Mongolian White', 'MongolianScript', 'Code2000', /*Myatav Erdenechimeg's*/'Menksoft Qagan';
}
	</style>
	<div class="container mt-5">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-2 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-8">
						<h6 class="card-title text-center font-weight-bold">Republic of the Philippines</h6>
						<h5 class="card-title text-center font-weight-bold">Department of Health</h5>
						<!-- <h5 class="card-title text-center font-weight-bold">{{((isset($director->certificateName)) ? $director->certificateName : 'REGION')}}</h5> -->
						<h6 class="card-title text-center font-weight-bold" >
							<?=(isset($retTable[0]->office) && !empty($retTable[0]->office)? $retTable[0]->office : '')?><br />
							<?=(isset($retTable[0]->address) && !empty($retTable[0]->address)? $retTable[0]->address : '')?><br />
							<!-- <?=(isset($retTable[0]->iso_desc) && !empty($retTable[0]->iso_desc)? $retTable[0]->iso_desc : '')?> -->
						</h6>
					
						{{-- <h6 class="card-subtitle mb-2 text-center text-muted text-small">doholrs@gmail.com</h6> --}}
					</div>
					<!-- <div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 118px; padding-left: 20px;">
					</div> -->
				</div>
			</div>
			<div class="card-body">			
			<div class="{{$retTable[0]->assignedRgn == 'hfsrb'? 'watermarked': 'watermarked
				'}}">
				
				<p class="headDetR" style="float: left; font-size: 20px; padding-left: 30px"><strong>CON No. {{date('Y')}}-{{str_pad(((isset($retTable[0]->appid)) ? $retTable[0]->appid : '_1'), 3, '0', STR_PAD_LEFT)}}</strong></p><br><br>
				<p class="text-center font-mong tit">CERTIFICATE OF NEED</p>
				<!-- <br> -->
				<h5 class="text-center font-mong here">is hereby granted to</h5>
				<!-- <br> -->
				<h3 class="text-center text-uppercase font-mong name"><strong>{{((isset($retTable[0]->facilityname)) ? $retTable[0]->facilityname : "CURRENT_FACILITY")}}</strong></h3><br>
				<!-- <h5 class="text-center font-mong">located at</h5><br> -->
				<center>	<h4 style="width: 70%;" class="text-center font-mong loc"><strong>{{((isset($retTable[0])) ? (($retTable[0]->street_name  ? $retTable[0]->street_name.', ' : '').($retTable[0]->street_number ? $retTable[0]->street_number.', ' : '').$retTable[0]->brgyname.', '.$retTable[0]->cmname.', '.$retTable[0]->provname.' '.$retTable[0]->rgn_desc) : 'No Location.')}}</strong></h4></center><br>
				<!-- <h4 class="text-center"><strong>{{((isset($retTable[0])) ? ($retTable[0]->rgn_desc.', '.$retTable[0]->provname.', '.$retTable[0]->cmname.', '.$retTable[0]->brgyname.', '.$retTable[0]->street_name) : "CURRENT_LOCATION")}}</strong></h4><br> -->
				<br>
				<div class="row">
				<div class="col-md-1"  >&nbsp;</div>
					<div class="col-md-4">
						<p  class="headDetL contl">Level of Hospital </p>
						<!-- <p style="float: right;" class="headDetL contl">Level of Hospital :</p> -->
					</div>
					<div class="col-md-1" style="display: inline">
						:
					</div>
					<div class="col-md-6 headDetR ">

					@php
						$str = (isset($serviceId)) ? (str_replace(',', ', ', $serviceId)) : 'LEVEL_1';
						$pattern = '/hospital/i';
						
						@endphp
					
						<p class="contr"><strong>	{{  preg_replace($pattern, ' ', $str) }}</strong></p>
						<!-- <p class="contr"><strong>{{((isset($serviceId)) ? (str_replace(',', ', ', $serviceId)) : 'LEVEL_1')}}</strong></p> -->
					</div>
				</div>
				<div class="row">
				<div class="col-md-1"  >&nbsp;</div>
					<div class="col-md-4">
						<p class="headDetL contl">Proposed Number of Beds </p>
						<!-- <p style="float: right;" class="headDetL contl">Proposed Number of Beds :</p> -->
					</div>
					<div class="col-md-1" style="display: inline">
						:
					</div>
					<div class="col-md-6 headDetR contr">
						<p  class="contr"><strong>{{((isset($otherDetails->ubn)) ? abs($otherDetails->ubn) : (isset($retTable[0]->noofbed) ? abs($retTable[0]->noofbed) : 0) )}}</strong></p>
						<!-- <p  class="contr"><strong>{{((isset($otherDetails->ubn)) ? abs($otherDetails->ubn) : (isset($retTable[0]->noofbed) ? abs($retTable[0]->noofbed) : 0) )}} Bed(s)</strong></p> -->
					</div>
				</div>
				<div class="row">
				<div class="col-md-1"  >&nbsp;</div>
					<div class="col-md-4">
						<p  class="headDetL contl">Date Issued </p>
						<!-- <p style="float: right;" class="headDetL contl">Date Issued :</p> -->
					</div>
					<div class="col-md-1" style="display: inline">
						:
					</div>
					<div class="col-md-6 headDetR contr">
						<p  class="contr"><strong>{{((isset($retTable[0]->t_date)) ? date("F j, Y", strtotime($retTable[0]->t_date)) : 'DATE_ISSUED')}}</strong></p>
					</div>
				</div>
				<div class="row">
				<div class="col-md-1"  >&nbsp;</div>
					<div class="col-md-4">
						<p class="headDetL contl">Validity Period </p>
						<!-- <p style="float: right;" class="headDetL contl">Validity Period :</p> -->
						<!-- <p style="float: right;">Validity Until :</p> -->
					</div>
					<div class="col-md-1" style="display: inline">
						:
					</div>
					<div class="col-md-6 headDetR contr">
						<p  class="contr"><strong>{{((isset($retTable[0]->approvedDate)) ? date("F j, Y", strtotime($retTable[0]->approvedDate)) : 'DATE_ISSUED')}} to {{((isset($retTable[0]->approvedDate)) ? date("F j, Y", ((strtotime($retTable[0]->approvedDate)-(86400*2))+15552000)) : 'DATE_ISSUED')}}</strong></p>
						<!-- <p  class="contr"><strong>{{((isset($retTable[0]->t_date)) ? date("F j, Y", strtotime($retTable[0]->t_date)) : 'DATE_ISSUED')}} to {{((isset($retTable[0]->t_date)) ? date("F j, Y", ((strtotime($retTable[0]->t_date)-(86400*2))+15552000)) : 'DATE_ISSUED')}}</strong></p> -->
					</div>
				</div>
				<div class="row">
					<div class="col-md-5">
						<p class="text-muted text-small" style="float: left; margin-top: 80px;">
						<iframe src="{!!url('qrcode/'.$retTable[0]->appid )!!}" style="border: none !important; height: 230px; width: 260px;"></iframe>
						</p>
					</div>
					<div class="col-md-7">
						<br><br><br>
						<div class="row">
							{{-- <div class="col-md-5">&nbsp;</div> --}}
							<div class="col-md-12 font-mong auth" >
								<strong>By Authority of the Secretary of Health:</strong>
							</div>
						</div><br><br>
						<div class="row">
							{{-- <div class="col-md-4">&nbsp;</div> --}}
							<div class="col-md-12 arial dir" >
								<strong ><center>{{ucwords($retTable[0]->signatoryname)}}</center></strong>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 arial  pos">
								<center><b style="white-space: pre-line">{{$retTable[0]->signatorypos}}</b></center>
							</div>
						</div>
						<br><br><br>
					</div>
				</div>
				<!-- <br><br>
				<h5 class="text-uppercase text-center text-muted">By Authority of the Secretary of Health:</h5>
				<br><br><br>
				<h6 class="text-uppercase text-center" style="font-size: 40px;"><strong>{{$director->directorInRegion}}{{-- CORAZON I. FLORES, MD, MPH, CESO IV,Director IV --}}{{-- {{((isset($sec_name)) ? $sec_name->sec_name : 'DIRECTOR')}} --}}</strong></h6>
				<p class="text-small text-center text-muted">{{$director->pos}}</p>
				<br/>
				<br/> -->
				<hr/>
				<center><i><b style="font-family: Cambria, Georgia, serif; font-size: 18px">This certificate of need is subject to suspension or revocation if the facility is found violating A0 2006-0004 and related issuances.</b></i></center>
			</div>
			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: left; padding: 0; margin: 0;">
					{{-- <iframe src="{{asset('ra-idlis/resources/views/client1/qrcode/index.php')}}?data={{asset('client1/certificates/view/external/')}}/{{$retTable[0]->appid}}" style="border: none !important; height: 150px; width: 150px;"></iframe> --}}
				{{--	<iframe src="{!!url('qrcode/'.$retTable[0]->appid )!!}" style="border: none !important; height: 230px; width: 260px;"></iframe>--}}
		
		
				<!-- <iframe src="{!!url('qrcode/'.$retTable[0]->appid )!!}" style="border: none !important; height: 230px; width: 260px;"></iframe> -->
				</p>
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div><br>
	</div>
</body>
@endsection