@extends('main')
@section('content')
@include('client1.cmp.__issuance')
<body>
<?php
	function xucwords($string)
	{
		$words = split(" ", $string);
		$newString = array();

		foreach ($words as $word)
		{
			if(!preg_match("/^m{0,4}(cm|cd|d?c{0,3})(xc|xl|l?x{0,3})(ix|iv|v?i{0,3})$/", $word)) {
				$word = ucfirst($word);
			} else {	$word = strtoupper($word);	}
			array_push($newString, $word);
		}
		return join(" ", $newString);  
	}
?>
	<style>
		
		.leftHeader{
			font-family: Cambria, Georgia, serif;
			font-size: 12;
		}
		.rightHeader{
			font-family: Arial, Helvetica, sans-serif;
			font-size: 12;
		}
		.contl { float: left; font-family: Cambria, Georgia, serif; font-size: 12; }
		
		@media print {
			.card-header .row{	height:120px;	}
			.card-body {	line-height: 20px;	}
			.card-body .row.location{	height:50px;	}
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
		div {
		white-space: normal;
		}
		.row, .col-md-8 { display: flex;}


		ol,li{
			font-family: Cambria, Georgia, serif;			
			
		}		

		ol {
			list-style-type: none;
			counter-reset: item;
			margin: 0;
			padding: 0;
		}

		li{
			padding-top: 20px;margin-left: 5px;
		}

		ol > li {
			display: table;
			counter-increment: item;
		}

		ol > li:before {
			content: counters(item, ".") ". ";
			display: table-cell;
			padding-right: 0.6em;    
		}

		li ol > li {
			margin: 0;
		}

		li ol > li:before {
			content: counters(item, ".") " ";
		}

	</style>
	<div class="container mt-5">
		<div class="card">
			<div class="card-header" style="padding-bottom: 5px;">
				<div class="row">
					<div class="col-md-3 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: left; max-height: 100px; padding-left: 20px;">
					</div>
					<!-- <div class="col-md-9"> -->
					<center style="margin-bottom:0;padding-bottom:0; height: 100px;" >
						<h5 class="card-title text-center font-weight-bold" style="margin-bottom:0; margin-top:auto;">Republic of the Philippines</h5>
						<h5 class="card-title text-uppercase text-center font-weight-bold" style="margin:0;">DEPARTMENT OF HEALTH</h5>
						<h3 class="card-title text-uppercase text-center font-weight-bold" style="margin:0;">{{((isset($director->certificateName)) ? $director->certificateName : 'REGION')}}</h3>
					</center>
					<!-- </div> -->
				</div>
			</div>
			<div class="card-body">
			
				<div class="watermarked" style="font-family: Cambria, Georgia, serif;">
				
					<h1 class="text-center" >PERMIT TO CONSTRUCT</h1>

					<div class="row" style="margin-top:5px; margin-left: 39px;margin-right: 39px;">
						<div class="col-md-3 leftHeader contl">
							Owner
						</div>
						<div class="col-md-8 rightHeader text-justify">
							:&nbsp;{{((isset($retTable[0]->owner)) ? $retTable[0]->owner : 'No owner')}}
						</div>
						<div class="col-md-1" style="display: inline">
							
						</div>
					</div>
					<div class="row" style="margin-left: 39px;margin-right: 39px;">
						<div class="col-md-3 leftHeader contl">
							Name of Health Facility
						</div>
						<div class="col-md-8 rightHeader text-justify">
							:&nbsp;<strong>{{((isset($retTable[0]->facilityname)) ? strtoupper($retTable[0]->facilityname)  : 'No facility name')}}</strong>
						</div>
						<div class="col-md-1" style="display: inline">
							
						</div>
					</div>
					
					<div class="row" style="margin-left: 39px;margin-right: 39px;">
						<div class="col-md-3 leftHeader contl">
							Type of Health Facility
						</div>
						<div class="col-md-8 rightHeader text-justify">
							:&nbsp;{{((isset($retTable[0]->facmdesc)) ? $retTable[0]->facmdesc : '')}}  {{((isset($retTable[0]->hgpdesc)) ? $retTable[0]->hgpdesc : '')}}  {{((isset($retTable[0]->ocdesc)) ? ' / '.$retTable[0]->ocdesc : '')}}
						</div>
						<div class="col-md-1" style="display: inline">
							
						</div>
					</div>

					<div class="row " style="margin-left: 39px;margin-right: 39px;">
						<div class="col-md-3 leftHeader contl">
							Location
						</div>
						<div class="col-md-8 rightHeader text-left">
							:
							@php
								/*$loc =( ($retTable[0]->street_name  ? ucwords(strtolower($retTable[0]->street_name)).', ' : ' ') 				 
										.($retTable[0]->street_number ?  ucwords(strtolower($retTable[0]->street_number)).', ' : '' )
										.ucwords(strtolower($retTable[0]->brgyname)).', '.ucwords(strtolower($retTable[0]->cmname)).', '
										.ucwords(strtolower($retTable[0]->provname)).' '.strtoupper($retTable[0]->rgn_desc));*/
								
								/*$loc =( ($retTable[0]->street_number ?  ucwords(strtolower($retTable[0]->street_number)).', ' : '' )
										.($retTable[0]->street_name  ? ucwords(mb_strtolower($retTable[0]->street_name, "UTF-8")).', ' : ' ') 				 
										.ucwords(mb_strtolower($retTable[0]->brgyname, "UTF-8")).', '.ucwords(mb_strtolower($retTable[0]->cmname, "UTF-8")).', '
										.ucwords(mb_strtolower($retTable[0]->provname, "UTF-8")).' '.strtoupper($retTable[0]->rgn_desc)
									); */
								$loc =( ($retTable[0]->street_number ?  ucwords(strtolower($retTable[0]->street_number)).', ' : '' )
									.($retTable[0]->street_name  ? ucwords(mb_strtolower($retTable[0]->street_name, "UTF-8")).', ' : ' ') 				 
									.ucwords(mb_strtolower($retTable[0]->brgyname, "UTF-8")).', '.ucwords(mb_strtolower($retTable[0]->cmname, "UTF-8")).', '
									.ucwords(mb_strtolower($retTable[0]->provname, "UTF-8"))
								);
								
								$stringloc = preg_replace_callback('/\b(?=[LXIVCDM]+\b)([a-z]+)\b/i', function($matches) {   return strtoupper($matches[0]); }, $loc);	
							@endphp
							{{((isset($retTable[0])) ?	$loc	: 'No Location.')}}
						</div>
						<div class="col-md-1" style="display: inline">
							
						</div>
					</div>
					<br/>
					<div class="row" style="margin-left: 39px;margin-right: 39px;">
						<div class="col-md-3 contl">
							Scope of Work
						</div>
						<div class="col-md-8 rightHeader text-justify">
							:&nbsp;<strong>{{((isset($otherDetails->HFERC_comments)) ? $otherDetails->HFERC_comments : 'Not Specified')}}</strong>
						</div>
						<div class="col-md-1" style="display: inline">
							
						</div>
					</div>

					<div style="margin-top:50px;">
						<div class="col-md-12" style="padding:0;">
							<span style="font-size: 12; font-family: Cambria, Georgia, serif;">Terms and Conditions:</span>
							@php 
								$employee_login = session()->get('employee_login');  
								$rgnoffice = "";

								if($employee_login) {
									$rgnoffice = $retTable[0]->assignedRgn == 'hfsrb'? 'HFSRB': 'Regional';
								} else {
									$rgnoffice = "Regional";
								}
							@endphp
							<ol type="1" class="text-justify" style="margin-left: 39px;margin-right: 39px;">
								<li>That the construction, alteration, expansion or renovation of a Hospital or other Health Facility is implemented in accordance with:
									<ol>
										<li>Floor Plans prepared by a duly licensed Architect and/or Civil Engineer and approved by the Health Facilities and Services Regulatory Bureau</li>
										<li>Architectural and engineering drawings (based on approved floor plans by the  {{$rgnoffice}} Office), specifications, building permit and fire safety permit prepared by a duly licensed Architect and/or Civil Engineer and approved by the Office of the Building Official and the Bureau of Fire Protection in the locality;</li>
									</ol>
								</li>
								<li>
									That the permit to construct and approved floor plans comprise observance of appropriate professional practices, prescribed functional relationships and applicable codes;
								</li>
								<li>
									That the permit to construct and approved floor plans are available for ready reference at the construction site;
								</li>
								<li>
									That the permit to construct is considered lapsed and fee paid is forfeited when the work authorized by the permit does not commence within 365 days from date of issuance, or is abandoned during the period specified; in which case, another application shall be filed;
								</li>
								<li>
									That the submission of progress report/status on the construction both for new and existing health facility required every six (6) months until project completion.
								</li>
								<li>
									That any addition and/or alteration of scope of work shall be reported immediately to the Health Facilities and Services Regulatory Bureau for appropriate action;
								</li>
								<li>
									That any unauthorized deviation from approved floor plans or any violation of the above condition, will be sufficient ground for the imposition of sanctions as based from the provision of Administrative Order No. 2016-0042.
								</li>
								<li>
									Inspection of the facility is necessary prior to the operation, utilization or usage of the approved scope of work.
								</li>
							</ol>

						</div>
					</div>
					<br><br>
					<div class="row" style="margin-left: 39px;margin-right: 39px;">
						<div class="col-md-12" style="vertical-align: bottom;">
												
							<small class="text-small"><strong>PTC No. {{$retTable[0]->licenseNo}}</strong></small><br>
							<small class="text-small"><strong>Date Issued: {{((isset($retTable[0]->approvedDate)) ? date("F j, Y", strtotime($retTable[0]->approvedDate)) : 'No date.')}}</strong></small>
												
						</div>
					</div>
					<div class="row" style="margin-left: 39px;margin-right: 39px;">
						<div class="col-md-2" style="vertical-align: bottom;">
							<p class="text-muted text-small" style="text-align: left; padding: 0; margin: 0;">
								{{-- <iframe  src="{{asset('ra-idlis/resources/views/client1/qrcode/index.php')}}?data={{asset('client1/certificates/view/external/')}}/{{$retTable[0]->appid}}" style="border: none !important; height: 150px; width: 150px;"></iframe> --}}
								<iframe src="{!!url('qrcode/'.$retTable[0]->appid )!!}" style="border: none !important; height: 150px; width: 180px;"></iframe>
							</p>
						
						</div>
						<div class="col-md-10" style="padding-top:50px;">
							<h3 class="text-uppercase text-center" style="font-size: 30px;"><strong>{{$retTable[0]->signatoryname}}</strong></h3>
							<h4 class="text-small text-center text-muted" style="white-space: pre-line; margin-top:10px;">{{$retTable[0]->signatorypos}}</h4>
						</div>					
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
@endsection