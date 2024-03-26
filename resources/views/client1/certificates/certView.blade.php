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
	</style>

	<div class="container mt-5">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-3 col-sm-12 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-6">
						<span class="card-title text-center" style="font-family: Arial;font-size: 12pt"><center><strong>Republic of the Philippines</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 13pt"><center><strong>DEPARTMENT OF HEALTH</strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 14pt"><center><strong><?=(isset($retTable[0]->office) && !empty($retTable[0]->office)? $retTable[0]->office : '')?></strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 13pt"><center><strong><?=(isset($retTable[0]->address) && !empty($retTable[0]->address)? $retTable[0]->address : '')?></strong></center></span>
						<span class="card-title text-center" style="font-family: Arial;font-size: 13pt"><center><strong><?=(isset($retTable[0]->iso_desc) && !empty($retTable[0]->iso_desc)? $retTable[0]->iso_desc : '')?></strong></center></span>
					</div>
					<div class="col-md-3 hide-div">
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="container w-auto">
					<a class="card-title text-center text-uppercase" style="font-family: ArialUnicodeMs;font-size: 20pt">
						<center>
							<strong>{{$retTable[0]->hfser_desc}}</strong>
						</center>
					</a>
				</div>
				<br>
				<div class="row">	
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						@if($retTable[0]->hfser_id == 'CON')
						Application No.
						@else
								Application Code
						@endif
						</div>
						<div class="col-md-1 hide-div">
							<center>:</center>
						</div>
						<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
							{{((isset($retTable[0]->hfser_id)) ? ucwords($retTable[0]->hfser_id.'R'.$retTable[0]->rgnid.'-'.$retTable[0]->appid) : "CURRENT_OWNER")}}
						</div>	
				</div>
				<div class="row">	
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
							Owner
						</div>
						<div class="col-md-1 hide-div">
							<center>:</center>
						</div>
						<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
							{{((isset($retTable[0]->owner)) ? ucwords($retTable[0]->owner) : "CURRENT_OWNER")}}
						</div>	
				</div>
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Health Facility Name
					</div>
					<div class="col-md-1 hide-div">
						<center>:</center>
					</div>
					<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						{{((isset($retTable[0]->facilityname)) ? strtoupper($retTable[0]->facilityname) : "NOT DEFINED")}}
					</div>	
				</div>
				@if(strtolower($retTable[0]->hfser_id) == 'lto')
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Type of Facility
					</div>
					<div class="col-md-1 hide-div">
						<center>:</center>
					</div>
					<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
					{{((isset($facname)) ? $facname : "No Health Service")}}
					</div>	
				</div>
@endif
			@if(strtolower($retTable[0]->hfser_id) != 'con' && strtolower($retTable[0]->hfser_id) != 'ptc')


				@if(isset($retTable[0]->hgpid))		
					@if($retTable[0]->hgpid == "6" || $retTable[0]->hgpid == "28")	
						
					<div class="row">
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
								Service Capability
						</div>
						<div class="col-md-1 hide-div">
							<center>:</center>
						</div>
						<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
							{{((isset($servCap)) ? implode(', ',$servCap)  : "NOT DEFINED")}}
						</div>	
					</div>
					
					@endif
				@endif
			@endif
				@isset($retTable[0]->hgpid)
					@if(strtolower($retTable[0]->hfser_id) != 'ptc')
						@php
							$str = $newservices;
							$pattern = '/hospital/i';
							$sc = preg_replace($pattern, ' ', $str);
							$str_new = $servname;			
						
						@endphp
					
						@if(isset($retTable[0]->hgpid))		
							@if($retTable[0]->hgpid == "12" || $retTable[0]->hgpid == "6" ||  $retTable[0]->hgpid == "9"  || $retTable[0]->hgpid == "4")	
								
							<div class="row">	
								<div class="col-md-2" style="">&nbsp;</div>
								<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
									Classification
								</div>
								<div class="col-md-1 hide-div">
									<center>:</center>
								</div>
								<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
									{{ $str_new  }}
								</div>	
							</div>
							
							@endif
						@endif

					@endif
				@endisset


				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Health Facility Address
					</div>
					<div class="col-md-1 hide-div">
						<center>:</center>
					</div>
					<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
					@php
$loc =(
							 ($retTable[0]->street_name ? ucwords(strtolower($retTable[0]->street_name)).', ' : ' ')
						 
						 .
						($retTable[0]->street_number ?  ucwords(strtolower($retTable[0]->street_number)).', ' : '' ).ucwords(strtolower($retTable[0]->brgyname)).', '.ucwords(strtolower($retTable[0]->cmname)).', '.ucwords(strtolower($retTable[0]->provname)).' '.strtoupper($retTable[0]->rgn_desc));

$stringloc = preg_replace_callback('/\b(?=[LXIVCDM]+\b)([a-z]+)\b/i', 
				function($matches) {
					return strtoupper($matches[0]);
				}, $loc);	

@endphp


					{{((isset($retTable[0])) ?
						$stringloc
						
						: 'No Location.')}}
					</div>	
				</div>
				@if(isset($retTable[0]->noofbed))
					@if($retTable[0]->noofbed > 0)
						<div class="row">	
							<div class="col-md-2" style="">&nbsp;</div>
							<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
							Authorized Bed Capacity
							</div>
							<div class="col-md-1 hide-div">
								<center>:</center>
							</div>
							<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
								<strong>{{((isset($retTable[0]->noofbed)) ? $retTable[0]->noofbed : "NA")}}</strong>
							</div>	
						</div>
					@endif
				@endif
				@if(strtolower($retTable[0]->hfser_id) != 'con' && strtolower($retTable[0]->hfser_id) != 'ptc')
				@if(isset($otherDetails->noofdialysis))
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
					Authorized Dialysis Station
					</div>
					<div class="col-md-1 hide-div">
						<center>:</center>
					</div>
					<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
					{{((isset($otherDetails->noofdialysis)) ? $otherDetails->noofdialysis : "NA")}}
					</div>	
				</div>
				@endif
				@endif
				@if(strtolower($retTable[0]->hfser_id) == 'lto')
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						License Number
					</div>
					<div class="col-md-1 hide-div">
						<center>:</center>
					</div>
					<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">

					@php
						$str = $newservices;
						$pattern = '/hospital/i';


						$sc = preg_replace($pattern, ' ', $str);
						
						$pad_length = 4;
						$pad_char = 0;
						$str_type = 'd';

						$format = "%{$pad_char}{$pad_length}{$str_type}";
						$formatted_str = sprintf($format, $retTable[0]->appid);


						$sercap = preg_replace('/\s*/', '', $sc);
         			    $sercap = strtolower($sercap);

						 $disercap = $sercap == 'level1' ? 'H1' :  ($sercap == 'level2' ? 'H2' :  ($sercap == 'level3' ? 'H3' : ' '));

						@endphp
						{{$retTable[0]->rgnid.'-'.$formatted_str.'-'.date('y', strtotime(str_replace('-','/', $retTable[0]->t_date))).'-'. $disercap.'-'.($retTable[0]->ocid == 'G'? '1':'2') }}
					</div>	
				</div>

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
								<div class="col-md-2" style="">&nbsp;</div>
								<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
								Authorized Ambulance Unit
								</div>
								<div class="col-md-1 hide-div">
									<center>:</center>
								</div>
								<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
									@php echo $ambulance_display; @endphp
								</div>	
							</div>
						@endif
					
					@endif

				@endif

				@if(strtolower($retTable[0]->hfser_id) == 'ptc')
				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Scope of Work
					</div>
					<div class="col-md-1 hide-div">
						<center>:</center>
					</div>
					<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
					
						{{((isset($otherDetails->HFERC_comments)) ? $otherDetails->HFERC_comments : 'Not Specified')}}
					</div>	
				</div>
				@endif

				@if(strtolower($retTable[0]->hfser_id) == 'lto' || strtolower($retTable[0]->hfser_id) == 'coa' || strtolower($retTable[0]->hfser_id) == 'ato')
					<div class="row">	
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
							License Validity
						</div>
						<div class="col-md-1 hide-div">
							<center>:</center>
						</div>
						<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						@if(strtolower($retTable[0]->hfser_id) == 'lto')
							@if($retTable[0]->aptid != 'R' )
							{{date('j F Y', strtotime($retTable[0]->approvedDate))}} – {{date('j F Y',  strtotime($otherDetails[0]->valto))}}
							@else
							{{date('j F Y', strtotime($retTable[0]->approvedDate))}} – {{date('j F Y',  strtotime($retTable[0]->validDate))}}
							@endif
						@elseif(strtolower($retTable[0]->hfser_id) == 'coa')
							{{date('F j, Y', strtotime($retTable[0]->approvedDate))}} – {{'December 31, '. date('Y', strtotime('+1 years' ,  strtotime($retTable[0]->approvedDate)))}}
						@endif

						<!-- {{((isset($otherDetails->valto)) ? $otherDetails->valto : "NOT DEFINED")}} -->
						</div>	
					</div>
					@isset($addons)
						@if(count($addons) > 0)
						<div class="row">
							<div class="col-md-2" style="">&nbsp;</div>
							<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
								Other Services
							</div>
						</div>
						<div class="row">
							<div class="col-md-2" style="">&nbsp;</div>
							<div class="col-md-3 pl-5 mt-3 font-weight-bold" style="font-family: Century Gothic; font-size: 11pt">
								@foreach($addons as $add)
									{{$add}}
								@endforeach
							</div>
						</div>
						@endif
					@endisset

				@endif

				@if(strtolower($retTable[0]->hfser_id) == 'con')
					<div class="row">	
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Proposed number of beds
							<!-- Number of Beds -->
						</div>
						<div class="col-md-1 hide-div">
							<center>:</center>
						</div>
						<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
							{{((isset($otherDetails->ubn)) ? $otherDetails->ubn : (isset($otherDetails->noofbed) ? $otherDetails->noofbed : ''))}}
							<!-- {{((isset($otherDetails->ubn)) ? $otherDetails->ubn : (isset($retTable[0]->noofbed) ? $retTable[0]->noofbed : ''))}} -->
						</div>	
					</div>
					<div class="row">	
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
							Level of Hospital
						</div>
						<div class="col-md-1 hide-div">
							<center>:</center>
						</div>
						<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						{{((isset($serviceId)) ? (str_replace(',', ', ', $serviceId)) : 'LEVEL_1')}}
						</div>	
					</div>

					<!-- <div class="row">	
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
							Bed Capacity
						</div>
						<div class="col-md-1 hide-div">
							<center>:</center>
						</div>
						<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						{{((isset($otherDetails->ubn)) ? abs($otherDetails->ubn) : (isset($retTable[0]->noofbed) ? abs($retTable[0]->noofbed) : 0) )}} Bed(s)
						</div>	
					</div> -->

					<div class="row">	
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
							Date Issued
						</div>
						<div class="col-md-1 hide-div">
							<center>:</center>
						</div>
						<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						{{((isset($retTable[0]->t_date)) ? date("F j, Y", strtotime($retTable[0]->t_date)) : 'DATE_ISSUED')}}
						</div>	
					</div>
					<div class="row">	
						<div class="col-md-2" style="">&nbsp;</div>
						<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
							Validity Period
						</div>
						<div class="col-md-1 hide-div">
							<center>:</center>
						</div>
						<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
							
						{{((isset($retTable[0]->t_date)) ? date("F j, Y", strtotime($retTable[0]->t_date)) : 'DATE_ISSUED')}} to {{((isset($retTable[0]->t_date)) ? date("F j, Y", ((strtotime($retTable[0]->t_date)-(86400*2))+15552000)) : 'DATE_ISSUED')}}
						<!--- {{((isset($retTable[0]->t_date)) ? date("F j, Y", strtotime($retTable[0]->t_date)) : 'DATE_ISSUED')}} to {{((isset($retTable[0]->t_date)) ? date("F j, Y", ((strtotime($retTable[0]->t_date)-(86400*2))+15552000)) : 'DATE_ISSUED')}} --->
						</div>	
					</div>

				@endif


				<div class="row">	
					<div class="col-md-2" style="">&nbsp;</div>
					<div class="col-md-3" style="font-family: Century Gothic; font-size: 11pt">
						Date Issued
					</div>
					<div class="col-md-1 hide-div">
						<center>:</center>
					</div>
					<div class="col-md-6 font-weight-bold" style="float:left;display: inline;font-family: Century Gothic; font-size: 13pt">
						
						{{((isset($issued_date)) ? $issued_date : 'Not Specified')}}
					</div>	
				</div>

			</div>
			<div class="card-footer">
				<p class="text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div>
	</div>


</body>

@endsection