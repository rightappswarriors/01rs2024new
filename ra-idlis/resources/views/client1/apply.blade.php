@extends('main')
@section('content')
@include('client1.cmp.__apply')
<style type="text/css">
	.legend {
	  background-color: #fff;
	  left: 80px;
	  padding: 20px;
	  border: 1px solid;
	}
	.legend h4 {
	  text-transform: uppercase;
	  font-family: sans-serif;
	  text-align: center;
	}
	.legend ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	}
	.legend li { padding-bottom: 5px; }
	.legend span {
	  display: inline-block;
	  width: 12px;
	  height: 12px;
	  margin-right: 6px;
	}
	.ddi{
		color: #fff;
	}

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<body>
	@include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb')
	@include('client1.cmp.msg')
	@include('client1.cmp.announcement')
	<div class="container mb-2">
			<div class="row">
				<div class="col-sm-3">
					<?php
						date_default_timezone_set('Asia/Manila');
						$todays_date = date("Y-m-d H:i:s");
						$today = strtotime($todays_date);
						$initial_period_1 =  date("Y")."-01-01 00:00:00";
						$initial_period_2 =  date("Y")."-11-15 23:59:59";
						$renewal_period_1 =  date("Y")."-10-01 00:00:00";
						$renewal_period_2 =  date("Y")."-12-31 23:59:59";				
						
						$late_renewal_period_1 =  date("Y")."-01-01 00:00:00";
						$late_renewal_period_2 =  date("Y")."-03-31 23:59:59";	
					?>
					<p>Application period for Initial / New health facility is from the 1st working day of the year to November 15 of the same year based on the <a href="https://hfsrb.doh.gov.ph/wp-content/uploads/2021/12/ao2019-0004.pdf">A.O. 2019-0004</a>.</p>
					
					{{--@if($initial_period_1 <= $todays_date &&  $initial_period_2 >= $todays_date) --}}
					<button class="btn btn-info btn-block" style="text-decoration: none;color:#fff;" data-toggle="modal" data-target="#applicationTypeModal" >
						Create New Application
					</button>
					{{-- @endif --}}
					@if($renewal_period_1 <= $todays_date &&  $renewal_period_2 >= $todays_date)
						
						<button class="btn btn-success btn-block" style="text-decoration: none;color:#fff; margin-top: 10%" data-toggle="modal" data-target="#applicationTypeModalRenew" >
							Create Renewal Application
						</button>
									
					@endif
					@if($late_renewal_period_1 <= $todays_date &&  $late_renewal_period_2 >= $todays_date)
						
						<button class="btn btn-success btn-block" style="text-decoration: none;color:#fff; margin-top: 10%" data-toggle="modal" data-target="#applicationTypeModalRenew" >
							Create Late Renewal Application
						</button>
									
					@endif

					<button class="btn btn-secondary btn-block" style="text-decoration: none;color:#fff; margin-top: 10%" data-toggle="modal" data-target="#clientregisteredfacilities" >
							Change Request Application
						</button>
					
				</div>
				<div class="col-sm-4">
					@isset($legends)
					<div class="legend mt-5">
					    <h4>Legend</h4>
					    <ul>
					    	@foreach($legends as $legend)
					        <li><span style="background-color: {{$legend->color}}"></span>{{$legend->trns_desc}}</li>
					        @endforeach
					    </ul>
					 </div>
					@endisset
				</div>
				<div class="col-md-5">
					<div class="media blog-thumb mt-5">
						<div class="media-object media-left">
							<a href="{{asset('/client1/historyapplication')}}"><img src="{{asset('ra-idlis/public/img/historical-report-256.png')}}" width="250" style=" border-radius: 1rem 0 0 1rem;height: 250px;" class="img-responsive" alt=""></a>
						</div>
						<div class="media-body blog-info">
							<small><i class="fa fa-clock-o"></i> Old Application Records</small>
							<h3><a style="color: #252525;font-weight: normal;transition: 0.5s; text-decoration: none !important;" href="{{asset('/client1/historyapplication')}}"> History Records</a></h3>
							<p>History Records of your Previous Applications</p>
							<div class="text-center">                                   	
								<a href="{{asset('/client1/historyapplication')}}" class="btn section-btn">View Records</a>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-8"></div>
			</div>
			@include('dashboard.client.modal.type-of-application')
			@include('dashboard.client.modal.type-of-application-renew')
			@include('dashboard.client.modal.client-registered-facliities')
	</div>
	<div  style="background: #fff;padding-left: 25px;padding-right: 25px;padding-top: 0;padding-bottom: 0;">
	<!-- <div  style="background: #fff;padding: 25px;"> -->
		<div style="overflow-x: scroll; min-height: 50%" >
			<table class="table table-bordered" id="tAppCl" style="border-bottom: none;border-collapse: collapse;">
				<thead class="thead-dark">
					<tr>
						<th style="white-space: wrap;" class="text-center">Process & Type of Application</th>
						<th style="white-space: nowrap;" class="text-center">Application <br/> Code</th>
						<th style="white-space: nowrap;" class="text-center">Name, Type, Owner of Facility <br/>& Date of Application</th>
						<th style="white-space: nowrap;" class="text-center">DOH Status</th>
						<th style="white-space: nowrap;" class="text-center">FDA<br/>Radiation</br>Facility Status</th>
						<th style="white-space: nowrap;" class="text-center">FDA<br/>Pharmacy </br> Status</th>
						<th style="white-space: nowrap;" class="text-center">Attachments</th>
						<th style="white-space: nowrap;" class="text-center">Document<br/>Received<br/>On</th>
						<th style="white-space: nowrap;" class="text-center">DOH &/ FDA <br/>Requirements</th>
						<th style="white-space: nowrap;" class="text-center">Options</th>
					</tr>
				</thead>
				<tbody id="homeTbl">
					@if(isset($appDet)) 
						@if(is_array($appDet)) 
							@foreach($appDet AS $each) 
								@if($each[0]->canapply == $each[0]->canapply) 
								<?php 
									$_payment = "bg-info"; 
									
									if(count($each[1]) > 0) { $_payment = "bg-info"; } $_percentage = ""; 

									if(intval($each[2][0]) < 100) 
									{ 
										if(intval($each[2][0]) > 0) { $_percentage = "warning"; } 
										else { $_percentage = "danger"; } 
									} else { $_percentage = "success"; }
								?>
								<?php $_tColor = (($each[0]->canapply == 0) ? "success" : (($each[0]->canapply == 1) ? "warning" : "primary")); ?>

									<tr>
										<td class="text-center">
											<strong>@if ($each[0]->aptid == 'IN') Initial New @elseif ($each[0]->aptid == 'R') Renewal @elseif ($each[0]->aptid == 'IC') Initial Change    @else Undefined @endif</strong>
											<br/>{{$each[0]->hfser_desc}}
										</td>
										<td class="text-center">
											{{$each[0]->hfser_id}}R{{$each[0]->rgnid}}-{{$each[0]->appid}}
											<br/>
											@isset($each[0]->nhfcode)<br/><strong style="font-size:smaller">NHFR Code:<br/><strong>{{$each[0]->nhfcode}}</strong></span>
											@endisset

											@isset($each[0]->regfac_id)<br/><strong style="font-size:smaller">Registered ID:<br/><strong>{{$each[0]->regfac_id}}</strong></span>
											@endisset
										</td>
										<td style="height: auto;" class="text-center">
											<strong>{{$each[0]->facilityname}}</strong>
											<br/><br/><span style="font-size:smaller">Facility Type: <strong>{{$each[0]->hgpdesc}}</strong></span>
											<br/><span style="font-size:smaller">Owner: <span style="color:#228B22;">{{$each[0]->owner}}</span></span>

											@isset($each[0]->created_at)
												<br/><span style="font-size:smaller">Created on <strong>{{$each[0]->created_at}}</strong></span>
											@endisset

											@isset($each[0]->t_date)
												<br/><span style="font-size:smaller">Application Submitted on <strong>{{$each[0]->t_date}}</strong></span>
											@else 
												<br/><span style="font-size:smaller; color:red">Not officially applied yet.</span>
											@endisset  

											@isset($each[0]->CashierApproveformattedDate)
												<br/><span style="font-size:smaller">Payment Confirmed on <strong>{{$each[0]->CashierApproveformattedDate}}</strong></span>
											@else 
												<br/><span style="font-size:smaller; color:red">No Payment confirmation yet.</span>
											@endisset  

										</td>
										<td style="background-color : {{$each[0]->dohcolor}}" class="text-center">
											
											@switch($each[0]->allowedlegend)

												@case(1)
													@if($each[0]->status == "P")
														@if(($each[0]->isRecommended && $each[0]->isRecommended != 2 && AjaxController::checkExitPay($each[0]->appid) == "no" && AjaxController::getAllDataOrderOfPaymentUploads($each[0]->appid ,4) != 0) || $each[0]->status=="CRFE")
															<a style="color:#FFF; font-weight: bold;" href="{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$each[0]->appid)}}">For Selection of Payment Method</a>
														@elseif($each[0]->status != null && ($each[0]->t_date) == true && $each[0]->isPayEval == 1)
															<a style="color:#FFF; font-weight: bold;"  href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}" onclick="remAppHiddenId('chgfil{{$each[0]->appid}}')" title="View Order of Payment on DOH" >For Payment Confirmation</a>
														@else 
															{{$each[0]->trns_desc}}
														@endif
													@else 
														{{$each[0]->trns_desc}}
													@endif
												@break
												@default
													@if($each[0]->status == "A")
														{{$each[0]->trns_desc}}
													@else
														{{"On Process"}}
													@endif
												@break

											@endswitch
										</td>		
										<td class="text-center">
											@if($each[0]->noofmain > 0 || $each[0]->hasRadio )
												{!! $each[0]->hfser_id == 'LTO' || $each[0]->hfser_id == 'COA'  || $each[0]->hfser_id == 'ATO'   || $each[0]->hfser_id == 'COR'  ? (isset($each[0]->FDAStatMach) ? $each[0]->FDAStatMach : 'Evaluation In Process') : 'Not Applicable'!!}
											@else
												Not Applicable
											@endif
										</td>
										<td class="text-center">
											@if($each[0]->noofmain > 0)
												{!! $each[0]->hfser_id == 'LTO' || $each[0]->hfser_id == 'COA'  || $each[0]->hfser_id == 'ATO'   || $each[0]->hfser_id == 'COR' ? (isset($each[0]->FDAStatPhar) ? $each[0]->FDAStatPhar : 'Evaluation In Process') : 'Not Applicable'!!}
											@else
												Not Applicable
											@endif
										</td>
										<td class="text-center">
											@if(isset($each[0]->submittedReq)) 
												Submitted.
											@else 
												<span style="color: red">No attachment submitted yet.</span><br/>
												<small class="text-center">To submit attachments, click the button <a href="{{asset('client1/apply/attachment')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}">Attachments</a> or check the DOH Requirements or FDA Requirements if applicable.</small>
											@endif
										</td>
										<td class="text-center">{{$each[0]->documentSent}}</td>
										<td class="text-center">
											@if(in_array(strtolower($each[0]->hfser_id), ['lto','coa','ato','cor']))

												<div class="btn-group mb-1">
												<button class="btn btn-block btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
													Requirements 
												</button>
												<div class="dropdown-menu">
													@if($each[0]->noofmain > 0  || $each[0]->hasRadio )
															<div style="margin-left: 10px;margin-right: 10px;">
															<a class="dropdown-item " style="border-radius: 3px;" href="{{asset('client1/apply/app/'.$each[0]->hfser_id.'/')}}/{{$each[0]->appid}}/fda">FDA Requirements</a>
															</div>									    
															<div class="dropdown-divider"></div>
														
													@endif
															<div style="margin-left: 10px;margin-right: 10px;">
															<a class="dropdown-item  " style="border-radius: 3px;"  href="{{asset('client1/apply/app/'.$each[0]->hfser_id.'/')}}/{{$each[0]->appid}}/hfsrb">DOH Requirements</a>
															</div>	
												</div>
												</div>

											@else
											
												@if($each[0]->isRecommended == 1)
													<span class="font-weight-bold">Documents Accepted</span>
												@elseif($each[0]->isRecommended == 2)
													<span class="font-weight-bold">Documents for Resubmission</span>
												@else
													@if($each[0]->submittedReq ==  1)
														<span class="font-weight-bold">Documents Submitted</span>
													@else
														<span class="font-weight-bold">No Submission</span>
													@endif											
												@endif

											@endif
										</td>
										<td class="text-center" style="height: auto;">
											<div class="btn-group mb-1 dropup" >
											<button class="btn btn-block btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Operations
											</button>
											<div class="dropdown-menu" style=" position: relative; z-index: 1000">
												@switch($each[0]->hfser_id)

													@case('CON')	

														<div style="margin-left: 10px;margin-right: 10px;">
															<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/app')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}?grp=c">Certificate of Need Details</a>
														</div>

														@if($each[0]->savingStat == "final")
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/attachment')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}">Attachments</a>
															</div>	
														@endif

														@if($each[0]->isRecommended && $each[0]->isRecommended != 2 && AjaxController::checkExitPay($each[0]->appid) == "no"  && AjaxController::getAllDataOrderOfPaymentUploads($each[0]->appid ,4) != 0)
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$each[0]->appid)}}">Select Payment Method</a>
															</div>
														@elseif($each[0]->status != null && ($each[0]->t_date) == true && $each[0]->isPayEval == 1)
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a  href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}" class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" onclick="remAppHiddenId('chgfil{{$each[0]->appid}}')" href="#">View Order of Payment on DOH </a>
															</div>
														@endif	

													@break											
													@case('PTC')
														
														@if($each[0]->isRecoForApproval === 0 && $each[0]->requestReeval === null)									
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-warning" style="border-radius: 3px;" onclick="requestReEval('{!! $each[0]->appid !!}')" href="#">Request for re-evaluation</a>
															</div>
															<div class="dropdown-divider"></div>
														@endif
													
														<div style="margin-left: 10px;margin-right: 10px;">
															<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/app')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}?grp=c">Permit to Construct Details</a>
														</div>

														@if($each[0]->savingStat == "final")
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/attachment')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}">Attachments</a>
															</div>
														@endif

														@if(($each[0]->isRecommended && $each[0]->isRecommended != 2 && AjaxController::checkExitPay($each[0]->appid) == "no" && AjaxController::getAllDataOrderOfPaymentUploads($each[0]->appid ,4) != 0) || $each[0]->status=="CRFE")										
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;"  href="{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$each[0]->appid)}}">Select Payment Method</a>
															</div>
														{{-- @elseif($each[0]->status != null && ($each[0]->t_date) == true && $each[0]->isPayEval == 1) --}}
														@elseif(isset($each[0]->submittedReq) || ($each[0]->status != null && ($each[0]->t_date) == true && $each[0]->isPayEval == 1) ) 
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a  href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}" class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" onclick="remAppHiddenId('chgfil{{$each[0]->appid}}')" href="#">View Order of Payment on DOH </a>
															</div>
														@endif

														@php $evaluationResult = AjaxController::maxRevisionFor($each[0]->appid,['revision',1], 1);  @endphp

														@if(isset($evaluationResult))
															@if(isset($evaluationResult->HFERC_eval))
																<div class="dropdown-divider"></div>							
																<div style="margin-left: 10px;margin-right: 10px;">
																	<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/app/showResult/floorplan')}}/{{$each[0]->appid}}" >View Floor Plan Evaluation Result</a>
																</div>
															@endif
														@endif

													@break
													@case('LTO')										
												
														@if(isset($each[0]->FDAStatMach))
															@if($each[0]->FDAStatMach == "For Payment")
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi {{$_payment}}" style="border-radius: 3px;" href="{{asset('client1/printPaymentFDA')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}">Order of Payment (FDA X-Ray)</a>
															</div>										
															@endif	
														@endif

														@if(isset($each[0]->FDAStatPhar))
															@if($each[0]->FDAStatPhar == "For Payment")
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi {{$_payment}}" style="border-radius: 3px;" href="{{asset('client1/printPaymentFDACDRR')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}">Order of Payment (FDA Pharmacy)</a>
															</div>										
															@endif		
														@endif		

														<div class="dropdown-divider"></div>
														@if ($each[0]->aptid == 'IC')
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi {{$_payment}}" style="border-radius: 3px;" href="{{asset('client1/changerequest')}}/{{$each[0]->regfac_id}}/main">View Application Details</a>
															</div>
														@else
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi {{$_payment}}" style="border-radius: 3px;" href="{{asset('client1/apply/app')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}?grp=c">License to Operate Details</a>
															</div>	
														@endif

														@if($each[0]->savingStat == "final")
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/assessmentReady/')}}/{{$each[0]->appid}}/">Self Assessment</a>
															</div>	
															<div class="dropdown-divider"></div>										
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/attachment')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}">Attachments</a>
															</div>									
														@endif	

														<div class="dropdown-divider"></div>
														<div style="margin-left: 10px;margin-right: 10px;">
															<a  data-toggle="modal" data-target="#chgfilupload-{{$each[0]->appid}}" class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;"  href="#">Upload FDA Proof of payment</a>
														</div>	

														@if(($each[0]->isRecommended && $each[0]->isRecommended != 2 && AjaxController::checkExitPay($each[0]->appid) == "no" && AjaxController::getAllDataOrderOfPaymentUploads($each[0]->appid ,4) != 0) || $each[0]->status=="CRFE")
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;"  href="{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$each[0]->appid)}}">Select Payment Method</a>
															</div>
														@elseif($each[0]->status != null && ($each[0]->t_date) == true && $each[0]->isPayEval == 1)
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a  href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}" class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" onclick="remAppHiddenId('chgfil{{$each[0]->appid}}')" href="#">View Order of Payment on DOH </a>
															</div>
														@endif		

													@break
													@case('COA')

														@if ($each[0]->aptid == 'IC')
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi {{$_payment}}" style="border-radius: 3px;" href="{{asset('client1/changerequest')}}/{{$each[0]->regfac_id}}/main">View Application Details</a>
															</div>
														@else
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/app')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}?grp=c">Continue Application</a>
															</div>	
														@endif

														@if($each[0]->savingStat == "final")
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/assessmentReady/')}}/{{$each[0]->appid}}/">Self Assessment</a>
															</div>	
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/attachment')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}">Attachments</a>
															</div>	
														@endif

														<div class="dropdown-divider"></div>
														<div style="margin-left: 10px;margin-right: 10px;">
															<a  data-toggle="modal" data-target="#chgfilupload-{{$each[0]->appid}}" class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;"  href="#">Upload FDA Proof of payment</a>
														</div>	
														<div class="dropdown-divider"></div>

														@if(($each[0]->isRecommended && $each[0]->isRecommended != 2 && AjaxController::checkExitPay($each[0]->appid) == "no" && AjaxController::getAllDataOrderOfPaymentUploads($each[0]->appid ,4) != 0) || $each[0]->status=="CRFE")
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;"  href="{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$each[0]->appid)}}">Select Payment Method</a>
															</div>	
														@elseif($each[0]->status != null && ($each[0]->t_date) == true && $each[0]->isPayEval == 1)
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a  href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}" class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" onclick="remAppHiddenId('chgfil{{$each[0]->appid}}')" href="#">View Order of Payment on DOH </a>
															</div>
														@endif	

													@break
													@case('COR')

														@if ($each[0]->aptid == 'IC')
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi {{$_payment}}" style="border-radius: 3px;" href="{{asset('client1/changerequest')}}/{{$each[0]->regfac_id}}/main">View Application Details</a>
															</div>
														@else
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/app')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}?grp=c">Continue Application</a>
															</div>	
														@endif
														
														@if($each[0]->savingStat == "final")								    
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/attachment')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}">Attachments</a>
															</div>
														@endif
														@if($each[0]->isRecommended || $each[0]->status=="CRFE")
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$each[0]->appid)}}">Select Payment Method</a>
															</div>
														@elseif($each[0]->status != null && ($each[0]->t_date) == true && $each[0]->isPayEval == 1)
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a  href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}" class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" onclick="remAppHiddenId('chgfil{{$each[0]->appid}}')" href="#">View Order of Payment on DOH </a>
															</div>
														@endif

													@break
													@case('ATO')

														@if ($each[0]->aptid == 'IC')
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi {{$_payment}}" style="border-radius: 3px;" href="{{asset('client1/changerequest')}}/{{$each[0]->regfac_id}}/main">View Application Details</a>
															</div>
														@else
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/app')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}?grp=c">Continue Application</a>
															</div>		
														@endif

														@if($each[0]->savingStat == "final")							    
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/attachment')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}">Attachments</a>
															</div>
														@endif

														@if($each[0]->isRecommended || $each[0]->status=="CRFE")
															<div class="dropdown-divider"></div>		
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{url('client1/payment/'.FunctionsClientController::getToken().'/'.$each[0]->appid)}}">Select Payment Method</a>
															</div>
														@elseif($each[0]->status != null && ($each[0]->t_date) == true && $each[0]->isPayEval == 1)
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
															<a  href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}" class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" onclick="remAppHiddenId('chgfil{{$each[0]->appid}}')" href="#">View Order of Payment on DOH </a>
															</div>
														@endif	

													@break
													@default

														@if ($each[0]->aptid == 'IC')
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi {{$_payment}}" style="border-radius: 3px;" href="{{asset('client1/changerequest')}}/{{$each[0]->regfac_id}}/main">View Application Details</a>
															</div>
														@else
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/app')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}?grp=c">Continue Application</a>
															</div>	
														@endif

														@if($each[0]->savingStat == "final")
															<div class="dropdown-divider"></div>
															<div style="margin-left: 10px;margin-right: 10px;">
																<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/attachment')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}">Attachments</a>
															</div>	
														@endif	

													@break
												@endswitch
													
													{{-- @if($each[0]->savingStat == "final")
														<div class="dropdown-divider"></div>
														<div style="margin-left: 10px;margin-right: 10px;">
															<a  data-toggle="modal" data-target="#chgfilupload-doh-{{$each[0]->appid}}" class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;"  href="#">Upload DOH Proof of payment</a>
														</div>	
													@endif --}}

													@if($each[0]->trns_desc == "For Compliance")
														<div class="dropdown-divider"></div>
														<div style="margin-left: 10px;margin-right: 10px;">
															<a class="dropdown-item ddi bg-{{$_tColor}}" style="border-radius: 3px;" href="{{asset('client1/apply/compliance')}}/{{$each[0]->appid}}">For Compliance</a>
														</div>	
													@endif	
											</div>
											
											<div class="modal fade" id="chgfil-{{$each[0]->appid}}" role="dialog"  tabindex="-1">
												<div class="modal-dialog modal-lg ">
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>										
														</div>
														<div class="modal-body" style="text-align:center">
															<table>
																<tr id="chgfil{{$each[0]->appid}}" hidden>
																	<td colspan="11">
																	@if(count($each[1]) > 0) <?php $isDone = false; ?>
																		<table class="table">
																			<thead class="thead-dark">
																				<tr>
																					<th>Date</th>
																					<th>Reference</th>
																					<th>Amount</th>
																					<th>Options</th>
																				</tr>
																			</thead>
																			<tbody>
																				@foreach($each[1] AS $anEach)
																				@if(strtolower($anEach->reference) != 'payment')
																				<tr>
																					<td>{{date("F j, Y", strtotime($anEach->t_date))}}</td>
																					<td>{{$anEach->reference}}</td>
																					<td>&#8369;&nbsp;{{number_format($anEach->amount, 2)}}</td>
																					@if(! $isDone)
																						<td class="text-center" rowspan="{{count($each[1])}}" style="vertical-align: middle;">
																							<a href="{{asset('client1/payment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}"><button class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Select Payment Method"><i class="fas fa-money-check-alt"></i></button></a>
																							<a href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}"><button class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i></button></a>
																						</td>
																						<?php $isDone = true; ?>
																					@endif
																				</tr>
																				@endif

																				@endforeach
																			</tbody>
																		</table>
																	@else
																		<center class="text-primary">Order of Payment has not been finalized by the Process Owner. We will notify you as soon as we finish the verification. Thank you for your patience.</center>
																	@endif
																	</td> <td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td> 
																</tr>										
															</table>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
														</div>
													</div>								
												</div>
											</div>

											<div class="modal fade" id="chgfilupload-{{$each[0]->appid}}" role="dialog"  tabindex="-1">
												<div class="modal-dialog modal-lg ">
													<form id="uppp-{{$each[0]->appid}}" method="post" enctype="multipart/form-data">
														<div class="modal-content">
															<div class="modal-header">
																Upload FDA Proof of Payment <button type="button" class="close" data-dismiss="modal">&times;</button>										
															</div>
															<div class="modal-body">
																@if( true)									
																	<label style="float: left;" for="filemach-{{$each[0]->appid}}">X-ray Facility</label>
																	<input id="filemach-{{$each[0]->appid}}" class="form-control"  type="file" name="upmach">
																	
																	<label style="float: left;" for="filemach-{{$each[0]->appid}}">Pharmacy</label>
																	<input id="filephar-{{$each[0]->appid}}" class="form-control"  type="file" name="upphar">
																	<input id="appi-{{$each[0]->appid}}" class="form-control" type="hidden" name="appid">
																@else
																	PROOF OF PAYMENT NOT APPLICABLE
																@endif
															</div>
															<div class="modal-footer">
																<button type="button"  style="width: 30%; float: right;" class="btn btn-default btn-block " data-dismiss="modal">Close</button>&nbsp;&nbsp;&nbsp;
																<button  style="width: 30%; float: right;"	class="btn btn-info btn-block " type="submit" >Submit</button>
															</div>
														</div>
													</form>
												</div>
											</div>

											<div class="modal fade" id="chgfilupload-doh-{{$each[0]->appid}}" role="dialog"  tabindex="-1">
												<div class="modal-dialog modal-lg ">									
													<form id="uppp-doh-{{$each[0]->appid}}" method="post" enctype="multipart/form-data">
														<div class="modal-content">
															<div class="modal-header">
																Upload DOH Proof of Payment<button type="button" class="close" data-dismiss="modal">&times;</button>										
															</div>
															<div class="modal-body">
																@if(true)
																	<label style="float: left;" for="filemach-{{$each[0]->appid}}">File</label>
																	<input id="file-payment-doh-{{$each[0]->appid}}" class="form-control"  type="file" name="upphar">
																	<input id="payment-doh-appi-{{$each[0]->appid}}" class="form-control" type="hidden" name="appid">
																@else
																	PROOF OF PAYMENT NOT APPLICABLE
																@endif
															</div>
															<div class="modal-footer">
																<button type="button"  style="width: 30%; float: right;"  class="btn btn-default btn-block " data-dismiss="modal">Close</button>&nbsp;&nbsp;&nbsp;
																<button  style="width: 30%; float: right;"	class="btn btn-info btn-block " type="submit" >Submit</button>
															</div>
														</div>
													</form>								
												</div>
											</div>
													
											<script>
												function requestReEval(appid){
													console.log(appid)

													if(confirm('Are you sure you want to request for re-evaluation?')){
														$.ajax({
															url: '{{asset('/api/request/reeval')}}',
															type: 'POST',
															data:{appid: appid},

															success: function(a){								
																if(a == 'succ'){
																	alert("Request for Re-evaluation sent")
																	location.reload();
																}else{	alert("Request for Re-evaluation failed")	}
															}
														})
													}
												}
												$(document).on('submit','#uppp-{{$each[0]->appid}}',function(event){
													event.preventDefault();

													if(confirm('Are you sure you want to upload proof of payment?')){
																			
														let data = new FormData(this);
														data.append('appid', '{{$each[0]->appid}}');
														console.log("data")
														console.log(data.values())
														console.log('{{$each[0]->appid}}')

														$.ajax({
															url: '{{asset('/api/upload/proofpayment')}}',
															type: 'POST',
															contentType: false,
															processData: false,
															data:data,
															success: function(a){
																console.log("a")
																console.log(a.msg)
																console.log(a.id)

																if(a.msg == "success"){	alert("Payment upload successful")	}
																else{	alert("Payment upload failed")	}
															},
															fail: function(a,b,c){	console.log([a,b,c]);	}
														})
													}
												})
												$(document).on('submit','#uppp-doh-{{$each[0]->appid}}',function(event){

													event.preventDefault();

													if(confirm('Are you sure you want to upload proof of payment?')){
																			
														let data = new FormData(this);
														// data.append('upproof', document.getElementById("file-{{$each[0]->appid}}").value);
														data.append('appid', '{{$each[0]->appid}}');
														console.log("data")
														console.log(data.values())
														console.log('{{$each[0]->appid}}')
														$.ajax({
															url: '{{asset('/api/upload/proofpayment')}}',
															type: 'POST',
															contentType: false,
															processData: false,
															data:data,
															success: function(a){
																console.log("a")
																console.log(a.msg)
																console.log(a.id)

																if(a.msg == "success"){	alert("Payment upload successful")	}
																else{	alert("Payment upload failed")	}
															},
															fail: function(a,b,c){	console.log([a,b,c]);	}
														})
													}
												})
											</script>				
										</td>
									</tr>
								@endif 
							@endforeach 
						@endif 
					@else
						<tr>
							<td colspan="13">No application applied yet.</td>
						</tr>
					@endif					
				</tbody>
			</table>
		</div>
	</div>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		var ___div = document.getElementById('__applyBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
		(function() {
		})();
		$(function () {	$('[data-toggle="tooltip"]').tooltip()	});
		$(document).ready( function () {
			$('#tApp').DataTable({
				"ordering": false,
				"lengthMenu": [10, 20, 50, 100]
			});
		});
		function remAppHiddenId(elId) {
			let idom = document.getElementById(elId);
			if(idom != undefined || idom != null) {
				if(idom.hasAttribute('hidden')) {
					idom.removeAttribute('hidden');
				} else {
					idom.setAttribute('hidden', true);
				}
			}
		}
	</script>
	<script type="text/javascript">
		"use strict";
		var ___div = document.getElementById('__applyBread');

		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
		(function() {
		})();
		$(function () {
			$('[data-toggle="tooltip"]').tooltip()
		});
		$(document).ready( function () {
			$('#tAppCl').DataTable({
				"ordering": false,
				"lengthMenu": [10, 20, 50, 100]
			});
		});
		function remAppHiddenId(elId) {
			let idom = document.getElementById(elId);
			if(idom != undefined || idom != null) {
				if(idom.hasAttribute('hidden')) {
					idom.removeAttribute('hidden');
				} else {
					idom.setAttribute('hidden', true);
				}
			}
		}
	</script>
@include('client1.cmp.footer')
</body>
@endsection

<script>
	function subProofPay(appid){

		document.getElementById("uppp-"+appid).addEventListener("submit", function(event){	event.preventDefault()	});		
		var form =	document.forms["uppp-"+appid].getElementsByTagName("input");
		
		if(form[0].value != ""){
			if(confirm("Are you sure you want to send your proof of payment?")){			
				$(document).on('submit','#uppp'+appid,function(event){
					event.preventDefault();
					let data = new FormData(this);
					console.log("data")
					console.log(data)
					$.ajax({
						url: '{{asset('client1/sendproofpay')}}',
						type: 'POST',
						contentType: false,
						processData: false,
						data:data,
						success: function(a){
							console.log("a")
							// if(a == 'DONE'){ alert('Successfully Edited Personnel');	location.reload(); } else { console.log(a); }
						},
						fail: function(a,b,c){
							console.log([a,b,c]);
						}
					})
				})
			// $.ajax({
			// 		url: '{{asset('client1/sendproofpay')}}',
			// 		// dataType: "json", 
			// 		async: false, type: 'POST', data:subs, cache: false, contentType: false, processData: false,
			// 		success: function(a){ console.log(a.msg)} 
			//});
			}
		}		
	}
</script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />