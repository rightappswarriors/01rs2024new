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
		.watermarked:after {
			
		}
		.heading { font-family: "Arial Unicode MS", "Lucida Sans Unicode", "DejaVu Sans", "Quivira", "Symbola", "Code2000", ;
			 font-size: 60px;}
		.auth { font-family: "Arial Unicode MS", "Lucida Sans Unicode", "DejaVu Sans", "Quivira", "Symbola", "Code2000", ;
			 font-size: 18px;}
	    .director { font-family: "Arial Unicode MS", "Lucida Sans Unicode", "DejaVu Sans", "Quivira", "Symbola", "Code2000", ;
			 font-size: 21px;}
		.pos { font-family: "Arial Unicode MS", "Lucida Sans Unicode", "DejaVu Sans", "Quivira", "Symbola", "Code2000", ;
			 font-size: 20px;}
		.contl { font-family: Century Gothic; font-size: 18px; }
		.contr { font-family: Century Gothic; font-size: 20px; }
	</style>
	<div class="container mt-5">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-2 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 90px; padding-left: 20px;">
					</div>
					<div class="col-md-8 card-title text-center font-weight-bold">
						<span style="font-family: Arial;font-size: 12pt">Republic of the Philippines</span><br/>
						<span style="font-family: Arial;font-size: 13pt">DEPARTMENT OF HEALTH</span><br/>
						<span style="font-family: Arial;font-size: 14pt;">{{((isset($director->certificateName)) ? $director->certificateName : "CURRENT_OWNER")}}</span>
					</div>
				</div>
			</div>
			<div class="card-body " style="width: 100%;">
				<div class="{{$retTable[0]->assignedRgn == 'hfsrb'? 'watermarked': 'watermarked'}}">
					<br>
					<span class="  heading"><center><strong>LICENSE TO OPERATE</strong></center></span><br>

					<div class="row">	
							<div class="col-md-1"  >&nbsp;</div>
						<div class="col-md-4 contl" >
							Owner
						</div>
						<div class="col-md-1" style="display: inline">:</div>
						<div class="col-md-6 contr" style="float:left;display: inline;">
							{{((isset($retTable[0]->owner)) ? $retTable[0]->owner : "CURRENT_OWNER")}}
						</div>	
					</div>

					<div class="row">
						<div class="col-md-1"  >&nbsp;</div>
						<div class="col-md-4 contl" >
							Name of Facility
						</div>
						<div class="col-md-1" style="display: inline">:</div>
						<div class="col-md-5 contr" style="float:left;display: inline;">
							<strong>{{((isset($retTable[0]->facilityname)) ? $retTable[0]->facilityname : "CURRENT_FACILITY")}} </strong> 
							<span style="font-size: small; font-style: italic;">{{((isset($retTable[0]->rename_dateapproved)) ? "(". date_format(date_create($retTable[0]->rename_dateapproved),"m/d/Y") .")": "")}}</span>
						</div>
						<div class="col-md-1" style="display: inline">&nbsp;</div>
					</div>

					<div class="row">
							<div class="col-md-1"  >&nbsp;</div>
						<div class="col-md-4 contl">
							Type of Health Facility
						</div>
						<div class="col-md-1" style="display: inline">:</div>
						<div class="col-md-5 contr" style="float:left;display: inline;">
							{{((isset($facname)) ? strtoupper($facname)  : "No Health Service")}} 
							
						</div>
						<div class="col-md-1" style="display: inline">&nbsp;</div>
					</div>
					
					@php
						$str = $newservices;
						$pattern = '/hospital/i';
						$sc = preg_replace($pattern, ' ', $str);
						$str_new = $servname;			
					
					@endphp

					@if(isset($retTable[0]->hgpid))		
						@if($retTable[0]->hgpid == "6" || $retTable[0]->hgpid == "28" || $retTable[0]->hgpid == "4"  )						
							<div class="row">
								<div class="col-md-1"  >&nbsp;</div>
								<div class="col-md-4 contl">
									@if($retTable[0]->hgpid == "4")
										Classification
									@else
										Service Capability
									@endif
								</div>
								<div class="col-md-1" style="display: inline">:</div>
								<div class="col-md-5 contr" style="float:left;display: inline;">
									{{ $str_new  }} 
									<span style="font-size: small; font-style: italic;">
										@if($retTable[0]->hgpid == "4")
											<!---Classification -->
											{{((isset($retTable[0]->classification_dateapproved)) ? "(".date_format(date_create($retTable[0]->classification_dateapproved),"m/d/Y").")" : "")}}
										@else
											<!--- Service Capability -->
											{{((isset($retTable[0]->changeonservice_dateapproved)) ? "(". date_format(date_create($retTable[0]->changeonservice_dateapproved),"m/d/Y") .")" : "")}}
										@endif										
									</span>
								</div>
								<div class="col-md-1" style="display: inline">&nbsp;</div>
							</div>					
						@endif
					@endif

					@if(isset($retTable[0]->hgpid))		
						@if($retTable[0]->hgpid == "6" || $retTable[0]->hgpid == "12" || $retTable[0]->hgpid == "9")	
							@if(isset($retTable[0]->funcid))						
								<div class="row">
									<div class="col-md-1"  >&nbsp;</div>
									<div class="col-md-4 contl" >
										Classification
									</div>
									<div class="col-md-1" style="display: inline">:</div>
									<div class="col-md-5 contr" style="float:left;display: inline;">
										@if(isset($retTable[0]->funcid))
											{{$retTable[0]->funcid == 1 ? 'General': ''}}
											{{$retTable[0]->funcid == 2 ? 'Special': ''}}
											{{$retTable[0]->funcid == 3 ? 'Not Applicable': ''}}
										@endif 
										<span style="font-size: small; font-style: italic;">
											{{((isset($retTable[0]->classification_dateapproved)) ? "(".date_format(date_create($retTable[0]->classification_dateapproved),"m/d/Y").")" : "")}}
										</span>
									</div>
									<div class="col-md-1" style="display: inline">&nbsp;</div>
								</div>					
							@endif
						@endif
					@endif
					<div class="row">
						<div class="col-md-1"  >&nbsp;</div>
						<div class="col-md-4 contl" >
							Location
						</div>
						<div class="col-md-1" style="display: inline">:</div>
						<div class="col-md-5 contr" style="float:left;display: inline;">
							@php								
								/*$loc =( ($retTable[0]->street_number ?  ucwords(strtolower($retTable[0]->street_number)).', ' : '' )
										.($retTable[0]->street_name  ? ucwords(mb_strtolower($retTable[0]->street_name, "UTF-8")).', ' : ' ') 				 
										.ucwords(mb_strtolower($retTable[0]->brgyname, "UTF-8")).', '.ucwords(mb_strtolower($retTable[0]->cmname, "UTF-8")).', '
										.ucwords(mb_strtolower($retTable[0]->provname, "UTF-8")).' '.strtoupper($retTable[0]->rgn_desc)
									);*/
								$loc =( ($retTable[0]->street_number ?  ucwords(strtolower($retTable[0]->street_number)).', ' : '' )
									.($retTable[0]->street_name  ? ucwords(mb_strtolower($retTable[0]->street_name, "UTF-8")).', ' : ' ') 				 
									.ucwords(mb_strtolower($retTable[0]->brgyname, "UTF-8")).', '.ucwords(mb_strtolower($retTable[0]->cmname, "UTF-8")).', '
									.ucwords(mb_strtolower($retTable[0]->provname, "UTF-8"))
								);
								
								$stringloc = preg_replace_callback('/\b(?=[LXIVCDM]+\b)([a-z]+)\b/i', function($matches) {   return strtoupper($matches[0]); }, $loc);	
							@endphp
							{{((isset($retTable[0])) ?	$loc	: 'No Location.')}}		
						</div>
						<div class="col-md-1" style="display: inline">&nbsp;</div>
					</div>
					@php
						$pad_length = 4;
						$pad_char = 0;
						$str_type = 'd';

						$format = "%{$pad_char}{$pad_length}{$str_type}";
						$formatted_str = sprintf($format, $retTable[0]->appid);

						$sercap = preg_replace('/\s*/', '', $sc);
						$sercap = strtolower($sercap);
						$disercap = $sercap == 'level1' ? 'H1' :  ($sercap == 'level2' ? 'H2' :  ($sercap == 'level3' ? 'H3' : $sercap));
					@endphp
					
					@if(isset($retTable[0]->noofbed))
						@if($retTable[0]->noofbed > 0)
							<div class="row">
								<div class="col-md-1"  >&nbsp;</div>
								<div class="col-md-4 contl" >
									Authorized Bed Capacity
								</div>
								<div class="col-md-1" style="display: inline;float: left">:</div>
								<div class="col-md-5 contr" style="float:left;display: inline;">			
									{{((isset($retTable[0]->noofbed)) ? $retTable[0]->noofbed : "NA")}}
									<span style="font-size: small; font-style: italic;">
										{{((isset($retTable[0]->noofbed_dateapproved)) ? "(". date_format(date_create($retTable[0]->noofbed_dateapproved),"m/d/Y") .")" : "")}}
									</span>
								</div>
								<div class="col-md-1" style="display: inline">&nbsp;</div>
							</div>
						@endif
					@endif
					
					@if(isset($retTable[0]->noofdialysis))
						@if($retTable[0]->noofdialysis > 0)
							<div class="row">
								<div class="col-md-1"  >&nbsp;</div>
								<div class="col-md-4 contl" >
									Authorized Dialysis Station
								</div>
								<div class="col-md-1" style="display: inline;float: left">:</div>
								<div class="col-md-5 contr" style="float:left;display: inline;">							
									{{((isset($retTable[0]->noofdialysis)) ? $retTable[0]->noofdialysis : "NA")}}
									<span style="font-size: small; font-style: italic;"> 
										
										{{((isset($retTable[0]->noofdialysis_dateapproved)) ? "(". date_format(date_create($retTable[0]->noofdialysis_dateapproved),"m/d/Y") .")" : "")}}
									</span>
								</div>
								<div class="col-md-1" style="display: inline">&nbsp;</div>
							</div>
						@endif
					@endif
					
					@if(isset($retTable[0]->plate_number) && isset($retTable[0]->ambtyp))					
						@php 
							$type = json_decode($retTable[0]->typeamb);
							$ambType = json_decode($retTable[0]->ambtyp);
							$ambType1 = json_decode($retTable[0]->ambtyp);
							$plateNum = json_decode($retTable[0]->plate_number);
							$owner = json_decode($retTable[0]->ambOwner);					
							$i=0;
							$amb_disp_temp = ""; $ambulance_display = "";							
										
							foreach($ambType1 as $atval){
								if($i != 0){
									if($ambType1[$i] == '2'){
										//	echo ' Type '. $type[$i].' ,Plate No. ' .  $plateNum[$i];
										$amb_disp_temp =  ((int)$i).', Type '. $type[$i].' ,Plate No. ' .  $plateNum[$i] ."<br/>";									
									}else{
										//	echo ' Type '. $type[$i].' ,Plate No. ' .  $plateNum[$i].' ,Owner: '.$owner[$i];
										$amb_disp_temp =	((int)$i).', Type '. $type[$i].' ,Plate No. ' .  $plateNum[$i].' ,Owner: '.$owner[$i] ."<br/>";
									}
									$ambulance_display = $ambulance_display ."".$amb_disp_temp;
								}
								$i++;
							}
						@endphp

						@if(!empty($ambulance_display))
							<div class="row">
									<div class="col-md-1"  >&nbsp;</div>
								<div class="col-md-4 contl" >
									Authorized Ambulance Unit
								</div>
								<div class="col-md-1" style="display: inline;float: left">
									:</div>
								<div class="col-md-5 contr" style="float:left;display: inline;">
									@php echo $ambulance_display; @endphp 
									<span style="font-size: small; font-style: italic;">
										{{((isset($retTable[0]->ambulance_dateapproved)) ? "(".date_format(date_create($retTable[0]->ambulance_dateapproved),"m/d/Y").")" : "")}}
									</span>
								</div>
								<div class="col-md-1" style="display: inline">&nbsp;</div>
							</div>
						@endif
					@endif

					<!-- div class="row">
						<div class="col-md-1"  >&nbsp;</div>
						<div class="col-md-4 contl" >
							License Number
						</div>
						<div class="col-md-1" style="display: inline;float: left">:</div>
						<div class="col-md-5 contr" style="float:left;display: inline;">						
							{{$retTable[0]->rgnid.'-'.$formatted_str.'-'.date('y', strtotime(str_replace('-','/', $retTable[0]->t_date))).'-'. strtoupper($disercap).'-'.($retTable[0]->ocid == 'G'? '1':'2') }}
						</div>
						<div class="col-md-1" style="display: inline">&nbsp;</div>
					</div --->

					<div class="row">
						<div class="col-md-1"  >&nbsp;</div>
						<div class="col-md-4 contl" >
							Validity of License
						</div>
						<div class="col-md-1" style="display: inline;float: left">:</div>
						<div class="col-md-5 contr" style="float:left;display: inline;">
							@if($retTable[0]->aptid != 'R' )
								{{date('j F Y', strtotime($retTable[0]->approvedDate))}} – {{date('j F Y',  strtotime($otherDetails[0]->valto))}}
							@else
								01 January {{date('Y', strtotime('+1 year', strtotime($retTable[0]->approvedDate)))}} – {{date('j F Y',  strtotime($retTable[0]->validDate))}}
							@endif 
						</div>
						<div class="col-md-1" style="display: inline">&nbsp;</div>
					</div>

					@if((count($addons) > 0)  || ($disercap != 'level3' && isset($retTable[0]->noofdialysis) && $retTable[0]->noofdialysis > 0) )
						<div class="row">
							<div class="col-md-1"  >&nbsp;</div>
							<div class="col-md-4 contl" >
								Other Services Offered
							</div>
						</div>

						<div class="row">
							<div class="col-md-1"  >&nbsp;</div>
							<script>
								console.log('{{$retTable[0]->addonDesc}}')
							</script>
							<div class="col-md-5 pl-5 mt-3 contr" >
								
								@if($disercap != 'level3' && $retTable[0]->hgpid != "5" && isset($retTable[0]->noofdialysis) && $retTable[0]->noofdialysis > 0)
									{{((isset($retTable[0]->noofdialysis)) ? "Dialysis Clinic (".$retTable[0]->noofdialysis."), " : "")}} 	
								@endif		

									@foreach($addons as $add)
										@php
											$ons = json_decode($retTable[0]->addonDesc);
											$exadd = 'no';
											$aowner = ' ';
											
											if($ons != null)
											{											
												foreach($ons as $o){
													if($o->facid_name  == $add && $o->servtyp == 1){
														$exadd = 'yes';
														$aowner = $o->servowner;
													}
												}
											}
										@endphp

										@if($exadd == 'yes')
											{{$add}} (Owner: {{$aowner}})
										@else
											{{$add}}
										@endif									
									@endforeach 
								<span style="font-size: small; font-style: italic;">
									@if(isset($retTable[0]->changeonservice_dateapproved))
										({{date_format(date_create($retTable[0]->changeonservice_dateapproved),"m/d/Y")}})
									@elseif(isset($retTable[0]->addonservice_dateapproved))
										({{date_format(date_create($retTable[0]->addonservice_dateapproved),"m/d/Y") }})
									@endif
								</span>
								
							</div>
						</div>
					@endif

					<div class="row">
						<div class="col-md-3" style="vertical-align: bottom;">
							<p class="text-muted text-small" style="text-align: center; margin-top: 80px;">
								{{-- <iframe src="{{asset('ra-idlis/resources/views/client1/qrcode/index.php')}}?data={{asset('client1/certificates/view/external/')}}/{{$retTable[0]->appid}}" style="border: none !important; height: 150px; width: 150px;"></iframe> --}}
								<iframe src="{!!url('qrcode/'.$retTable[0]->appid )!!}" style="border: none !important; height: 230px; width: 260px;"></iframe>
							</p>
						</div>
						<div class="col-md-9" style="padding-top:120px;">
							
							<div class="col-md-12 auth" style="text-align: center; font-weight: bold;" >
								By Authority of the Secretary of Health:
							</div>							
							<div class="col-md-12 director" style="text-align: center; font-weight: bold; margin-top:80px;">
								{{ucwords($retTable[0]->signatoryname)}}
							</div>
							<div class="col-md-12 pos" style="text-align: center; font-weight: bold;">
								<b style="white-space: pre-line">{{$retTable[0]->signatorypos}}</b>
							</div>

						</div>
					</div>
				</div>
			</div>
			<div class="card-footer text-center">				
				<b><hr/></b>
				@if(isset($director->ftr_msg_lto))
					<br/><i><b style="font-family: Cambria, Georgia, serif; font-size: 18px">{{$director->ftr_msg_lto}}</b></i>
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