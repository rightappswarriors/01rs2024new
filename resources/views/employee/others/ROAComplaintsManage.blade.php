@extends('mainEmployee')
@section('title', 'Manage Request Assistance/Complaints')
@section('content')

<style type="text/css">
	@media print{
		@page{margin:0;}
		nav:first-child,#wrapper,.card-header, .bg-white, .font-weight-bold{
			display: none!important;
		}
	}

</style>
	<div class="content p-4">
	    <div class="card">
			<div class="card-header bg-white font-weight-bold">
			
				<!-- <a href="{{URL::route('others.roacomp')}}"> -->
				<a href="{{asset('employee/dashboard/others/roacomplaints/regfac')}}">
				<button type="button" class="btn-primarys"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;Back</button></a>
				Manage Request For Assistance/Complaints
			</div>
			<div class="card-body table-responsive">
				@isset($RequestData)
					<div class="container">
						
						<div class="row text-center mb-5">
							<div class="col-sm-4 text-right">
								<img style="width:30%" src="http://uhmis3.doh.gov.ph/fsmm/gallery/content/99_2nd%20Cosultative%20Meeting/DOH.jpg">
							</div>

							<div class="col-sm-4 text-center">
								<div class="row">
									<div class="col-sm-12">
										<b>Republic of the Philippines</b>
									</div>
									<div class="col-sm-12">
										<b>Department of Health</b>
									</div>
									<div class="col-sm-12">
										@if(AjaxController::getHighestApplicationFromX08FT($RequestData['appid']) != null)
											@if(AjaxController::getHighestApplicationFromX08FT($RequestData['appid'])->assignrgn == "rgn")
												<h6><b>{{AjaxController::getRegionByAppId($RequestData['appid'])}}</b></h6>
											@elseif(AjaxController::getHighestApplicationFromX08FT($RequestData['appid'])->assignrgn == "hfsrb")
												<h6><b>CENTRAL OFFICE HFSRB</b></h6>
											@endif
										@endif
									</div>
								</div>
							</div>
							<div class="col-sm-4 text-left">
								{{-- <img style="width:30%" src="http://uhmis3.doh.gov.ph/fsmm/gallery/content/99_2nd%20Cosultative%20Meeting/DOH.jpg"> --}}
							</div>	
						</div>

						<div class="row text-center mt-5">
							<div class="col-sm-12">
								<h5><b>COMPLAINT/REQUEST FOR ASSISTANCE FORM</b></h5>
							</div>
						</div>

						{{-- refno --}}
						<div class="row text-center mt-5">
							<div class="col-sm-9">
								&nbsp;
							</div>
							<div class="col-sm-3">
								<b>Reference No.:</b>
								<span id="manage_refno">{{$RequestData['ref_no']}}</span> 
								<br> <i>(office-year-month-sequential no)</i>
							</div>
						</div>

						{{-- name, age, civil --}}
						<div class="row text-left mt-4">
							<div class="col-sm-2">
								<b>Name of Client/<br>Complainant:</b>
							</div>
							<div class="col-sm-2">
								<span id="manage_name_of_comp">{{$RequestData['name_of_comp']}}</span> 
							</div>
							<div class="col-sm-2">
								<b>Age:</b>
							</div>
							<div class="col-sm-2">
								<span id="manage_age">{{$RequestData['age']}}</span>
							</div>
							<div class="col-sm-2">
								<b>Civil Status:</b>
							</div>
							<div class="col-sm-2">
								<span id="manage_civil_status">{{$RequestData['civ_stat']}}</span>
							</div>	
						</div>

						{{-- addr, gender, date --}}
						<div class="row text-left mt-3">
							<div class="col-sm-2">
								<b>Address:</b>
							</div>
							<div class="col-sm-2">
								<span id="manage_addr">{{$RequestData['address']}}</span> 
							</div>
							<div class="col-sm-2">
								<b>Gender:</b>
							</div>
							<div class="col-sm-2">
								<span id="manage_gender">{{$RequestData['gender']}}</span>
							</div>
							<div class="col-sm-2">
								<b>Date:</b>
							</div>
							<div class="col-sm-2">
								<span id="manage_date">{{$RequestData['req_date']}}</span>
							</div>	
						</div>

						{{-- name of faci, type of faci --}}
						<div class="row text-left mt-3 mb-5">
							<div class="col-sm-2">
								<b>Name of Facility:</b>
							</div>
							<div class="col-sm-4">
								<span id="manage_name_of_faci">{{$RequestData['name_of_faci']}}</span> 
							</div>
							<div class="col-sm-2">
								<b>Type of Facility:</b>
							</div>
							<div class="col-sm-4">
								<span id="manage_type_of_facility">{{$RequestData['type_of_faci']}}</span>
							</div>
						</div>
						@if($RequestData['name_of_conf_pat'])
						<div class="row text-left mt-3 mb-5">
							<div class="col-sm-2">
								<b>Name of Patient:</b>
							</div>
							<div class="col-sm-4">
								<span id="manage_name_of_faci">{{$RequestData['name_of_conf_pat']}}</span> 
							</div>
							<div class="col-sm-2">
								<b>Date Confined  :</b>
							</div>
							<div class="col-sm-4">
								<span id="manage_type_of_facility">{{$RequestData['date_of_conf_pat']}}</span>
							</div>
						</div>
						@endif

						{{-- reqs/comps --}}
						<div class="row text-left mt-5 mb-5">
							<div class="col-sm-3">
								@if($RequestData['reqs'] != "")
									<b>Request for Assistance</b>
								@elseif($RequestData['comps'] != "")
									<b>Nature of Complaints</b>
								@endif
							</div>
							<div class="col-sm-3">
								@php
									$reqs = explode(', ', $RequestData['reqs']);
									$comps = explode(', ', $RequestData['comps']);
								@endphp
								<ul>
									@if($RequestData['reqs'] != "")
										@for($i=0; $i<count($reqs); $i++)
											<li>{{$reqs[$i]}}</li>
										@endfor
									@elseif($RequestData['comps'] != "")
										@for($i=0; $i<count($comps); $i++)
											<li>{{$comps[$i]}}</li>
										@endfor
									@endif
								</ul>
							</div>
						</div>

						{{-- attest --}}
						<div class="row text-left mt-5 mb-5">
							<div class="col-sm-12 text-center">
								<i><b>I attest to the truth and veracity of the above-mentioned fact and statement. Any false and misrepresentation I made could be ground for civil, criminal and administrative action under law by the injured party.</b></i>
							</div>
						</div>

						{{-- sign1 --}}
						<div class="row mt-5">
							<div class="col-sm-8 w-100">
								&nbsp;
							</div>
							<div class="col-sm-4 text-center">
								<b><span>{{$RequestData['name_of_comp']}}</span></b>
							</div>
						</div>

						{{-- sign2 --}}
						<div class="row mb-5">
							<div class="col-sm-8 w-100">
								&nbsp;
							</div>
							<div class="col-sm-4 text-center border border-secondary border-bottom-0 border-left-0 border-right-0">
								Client's/Complainant's Name and Signature
							</div>
						</div>

						{{-- do not fill below --}}
						<div class="row mb-2 mt-5">
							<div class="col-sm-12 w-100 text-center">
								<h5 style="font-family: courier">do not fill below this line</h5>
							</div>
						</div>

						<hr>
						@php
							$check_flag = explode(',', $RequestData['actions']);
						@endphp
						{{-- attending staff --}}
						<div class="row mt-5 mb-3">
							<div class="col-sm-5 w-100">
								<b>Name, signature and position of attending Staff:</b>
							</div>
							<div class="text-left col-sm-4 w-50 border border-secondary border-top-0 border-left-0 border-right-0">
								{{$RequestData['staff_name']}}, {{$RequestData['staff_position']}}
							</div>
						</div>


						{{-- init action --}}
						<div class="row mb-3">
							<div class="col-sm-12 w-100">
								<b>Initial Action Taken: (Check appropriate box)</b>
							</div>
							<div class="col-sm-12 w-100 pt-3 pl-3 pr-3">
								<input  
								@if(in_array("1", $check_flag))
									checked
								@endif
								type="checkbox" name="" disabled> Wrote a letter to the respondent/health facility asking for written answer:
							</div>
							<div class="col-sm-5 w-100 pt-3 pl-3 pr-3">
								<input 
								@if(in_array("2", $check_flag))
									checked
								@endif
								type="checkbox" name="" disabled> Endorsed to concerned Division/Regional Office (specify):
							</div>
							<div class="text-left pt-3 col-sm-4 w-50 border border-secondary border-top-0 border-left-0 border-right-0">
								{{$RequestData['action2_text']}}
							</div>
							<div class="col-sm-5 w-100 pt-3 pl-3 pr-3">
								<input 
								@if(in_array("3", $check_flag))
									checked
								@endif
								type="checkbox" name="" disabled>
								Endorsed to Another Agency (specify agency):
							</div>
							<div class="col-sm-5 w-100 pt-3 pl-3 pr-3">
								<input 
								@if(in_array("4", $check_flag))
									checked
								@endif
								type="checkbox" name="" disabled>
								Evaluated the complaint as to the nature jurisdiction etc.:
							</div>
							<div class="text-left pt-3 col-sm-4 w-50 border border-secondary border-top-0 border-left-0 border-right-0">
								{{$RequestData['action3_text']}}
							</div>
						</div>
					</div>
				@endisset
			</div>
		</div>
	</div>
	@include('employee.cmp._othersJS')
@endsection