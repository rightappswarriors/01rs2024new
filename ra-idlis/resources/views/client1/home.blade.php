@extends('main')
@section('content')
@include('client1.cmp.__home')
<body>
	@include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb')
	@include('client1.cmp.msg')


	@include('client1.cmp.announcement')

	<style type="text/css">
		#style-15::-webkit-scrollbar-track
		{
		-webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
		background-color: #F5F5F5;
		border-radius: 10px;
		}

		#style-15::-webkit-scrollbar
		{
		width: 10px;
		background-color: #F5F5F5;
		}

		#style-15::-webkit-scrollbar-thumb
		{
		border-radius: 10px;
		background-color: #FFF;
		background-image: -webkit-gradient(linear,
							40% 0%,
							75% 84%,
							from(#4D9C41),
							to(#19911D),
							color-stop(.6,#54DE5D))
		}
	</style>

	<div class="container mb-5">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					
					<div class="_forIntro col-lg-6">
			          <div class="media blog-thumb">
                              <div class="media-object media-left">
                                   <a href="{{asset('/client1/apply')}}"><img src="{{asset('ra-idlis/public/img/laptop-typer.gif')}}" width="250" style=" border-radius: 1rem 0 0 1rem;height: 250px;" class="img-responsive" alt=""></a>
                              </div>
                              <div class="media-body blog-info">
                                   <small><i class="fa fa-clock-o"></i>Last applied: N/A</small>
                                   <h3><a style="color: #252525;font-weight: normal;transition: 0.5s; text-decoration: none !important;" href="{{asset('/client1/apply')}}">Application</a></h3>
                                   <p>Fill-in application form and submit requirements online.</p>
                                   <div class="text-center">                                   	
                                   		<a href="{{asset('/client1/apply')}}" class="btn section-btn">Apply Now!</a>
                                   </div>
                              </div>
                         </div>
			        </div>

					<div class="_forIntro col-lg-6">
			          	<div class="media blog-thumb">
                              <div class="media-object media-left">
                                   <a href="{{asset('/client1/messages')}}"><img src="{{asset('ra-idlis/public/img/message.gif')}}" width="250" style=" border-radius: 1rem 0 0 1rem;height: 250px;" class="img-responsive" alt=""></a>
                              </div>
                              <div class="media-body blog-info">
                                   <small><i class="fa fa-clock-o"></i> History</small>
                                   <h3><a style="color: #252525;font-weight: normal;transition: 0.5s; text-decoration: none !important;" href="{{asset('/client1/messages')}}">Messages</a></h3>
                                   <p>Notifications Messages</p>
                                   <div class="text-center">                                   	
                                   		<a href="{{asset('/client1/messages')}}" class="btn section-btn">Check Here.</a>
                                   </div>
                              </div>
                         </div>
			        </div>

					{{-- Display past applications  --}}
			        <div class="_forIntro col-lg-6" style="display:none;">
			          <div class="card flex-lg-row mb-4 box-shadow h-lg-250" style="border-radius: 1rem; box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);height: 300px;">
						<div class="container table-responsive">
							<h3 class="mb-0 pt-3 pb-3 text-center">
				            	<span>Previous Applications</span>
				            </h3>
				            <table class="table pt-2" id="aYear">
				            	<thead>
				            		<tr>
					            		<th style="white-space: nowrap;">Facility Name</th>
					            		<th style="white-space: nowrap;">Type of Application</th>
					            		<th style="white-space: nowrap;">Application Date</th>
				            		</tr>
				            	</thead>
				            	<tbody>
				            		@foreach($year as $y)
				            		<tr>
				            			<td>{{$y->facilityname}}</td>
				            			<td>{{$y->hfser_desc}}</td>
				            			<td>{{Date('F j, Y',strtotime($y->t_date))}}</td>
				            		</tr>
				            		@endforeach
				            	</tbody>
				            </table>
						</div>
			          </div>
			        </div>
					
			    </div>
			</div>

			
		</div>
	</div>
			<div class="row" style="background: #fff; border-radius: 10px;padding: 25px;">
			<div class="col-md-12 lead pt-3 pb-2 text-center text-uppercase font-weight-bold" style="font-size:30px ;">List of Registered Facility by Approved Applications</div>   
			<div class="col-md-12" id="style-15" class="scrollbar" style="overflow-x: scroll;">
				<table class="table table-hover">
					<thead>
						<tr>
							<th style="white-space: nowrap;">NHFR Code</th>
							<th style="white-space: nowrap;">Application Code</th>
							<th style="white-space: nowrap;">License Number</th>
							<th style="white-space: nowrap;">Facility Name</th>
							<th style="white-space: nowrap;">Owner & Facility Head</th>
							<th style="white-space: nowrap;">Validity Date</th>
							<th style="white-space: nowrap;">OHSRS Status</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody class="text-white font-weight-bold">
						@if(count($appDet)) @foreach($appDet AS $each) @if($each[0]->canapply == $each[0]->canapply) {{-- 2 --}}
						<?php $_tColor = (($each[0]->isapproved == 1) ? ((FunctionsClientController::checkExpiryDate($each[0]->validDate)) ? "danger" : "success") : "warning"); $_tMsg = ((FunctionsClientController::checkExpiryDate($each[0]->validDate)) ? "License already expired." : $each[0]->trns_desc); ?>
						<tr class="bg-{{$_tColor}}">
							<td class="font-weight-bold">@if(isset($each[0]->nhfcode))NHFR Code: {{$each[0]->nhfcode}} @endif<br/><p>@if(isset($each[0]->regfac_id)) Registered ID: {{$each[0]->regfac_id}} @endif</p></td>
							<td class="font-weight-bold">
								{{$each[0]->hfser_id}}R{{$each[0]->rgnid}}-{{$each[0]->appid}}<br/>
								<p>@if($each[0]->aptid == "IN") {{'Initial New'}} @elseif($each[0]->aptid == "R") {{'Renewal'}} @else {{'Initial New with Change'}} @endif Process</p>
							</td>
							<td>{{(isset($each[0]->licenseNo) ?$each[0]->licenseNo : "Not Applicable")}}<br/><p>{{$each[0]->hfser_desc}}</p></td>
							<td>{{$each[0]->facilityname}}<br/><p>{{$each[0]->hgpdesc}}</p></td>
							<td>{{$each[0]->owner}}<br/><p>{{$each[0]->approvingauthority}}, {{$each[0]->approvingauthoritypos}}</p></td> 							
							<td>
								@if($each[0]->hfser_id == 'CON')
									{{((isset($each[0]->approvedDate)) ? date("F j, Y", ((strtotime($each[0]->approvedDate)-(86400*2))+15552000)) : 'DATE_ISSUED')}}
								@elseif($each[0]->hfser_id == 'LTO')
									{{date('F j, Y', strtotime("Last day of December", strtotime($each[0]->approvedDate)))}}
								@elseif($each[0]->hfser_id == 'COA')
									{{date('F j, Y', strtotime($each[0]->validDate))}}
								@else 
									{{($each[0]->hfser_id == 'LTO' ? (isset($each[4]->valto) ? Date('F j, Y',strtotime($each[4]->valto)) : "Valid To is not applicable"): "Permit is valid." )}}
								@endif
								<br/><p>Issued On {{Date('M d,  Y',strtotime($each[0]->approvedDate))}}</p>
							</td>
							<td>{!!($each[0]->hfser_id == 'LTO' && in_array($each[0]->hgpid, ['6', '17', '18']) ? 'No Report Submitted, <br>Please Submit to <a href="https://ohsrs.doh.gov.ph" target="_blank" class="btn btn-info">OHSRS</a>' : "Not Applicable" )!!}</td>
							
							{{-- <td>{{($each[0]->hfser_id == 'LTO' ? (isset($each[0]->pharValidity) ? $each[0]->pharValidity : "Not Applicable"): "Not Available" )}}</td> --}}
							{{-- <td>{{($each[0]->hfser_id == 'LTO' ? (isset($each[0]->xrayVal) ? $each[0]->xrayVal : "Not Applicable"): "Not Available" )}}</td> --}}
							<td>
								<div class="dropdown">
									<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-align-justify"></i></button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="padding: 0px 10px 10px 10px;">
										<!-- <button style="margin-top: 10px;" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Continue Application" onclick="window.location.href='{{asset('client1/apply/app/updApp')}}/{{$each[0]->appid}}'"><i class="fa fa-copy"></i></button> -->

										@if($each[0]->hfser_id == 'CON' || $each[0]->hfser_id == 'PTC')
											@if($each[0]->hfser_id == 'CON')
											<button style="margin-top: 10px;" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Continue Application" onclick="window.location.href='{{asset('/cont/ptc')}}/{{$each[0]->appid}}?cont=yes'"><i class="fa fa-arrow-right"></i></button>
											@elseif($each[0]->hfser_id == 'PTC')
												@php 
													$next_hfser_id = 'lto';

													if(isset($each[5])){
														$next_hfser_id = strtolower($each[5]);
													}
												@endphp
											<button style="margin-top: 10px;" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Continue Application" onclick="window.location.href='{{asset('/cont')}}/{{$next_hfser_id}}/{{$each[0]->appid}}?cont=yes'"><i class="fa fa-arrow-right"></i></button>
											@endif
										@endif

										<button style="margin-top: 10px;" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Print" onclick="window.location.href='{{asset('client1/certificates')}}/{{strtoupper($each[0]->hfser_id)}}/{{$each[0]->appid}}'"><i class="fa fa-print"></i></button>
										@if($each[0]->hfser_id != "PTC")
										<button style="margin-top: 10px;" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Change Request Form" @if(isset($each[0]->regfac_id)) onclick="window.location.href='{{asset('client1/changerequest')}}/{{$each[0]->regfac_id}}/main'" @endif><i class="fa fa-pencil-square-o"></i></button>
										@endif
										<button style="margin-top: 10px;" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="View Payment Details" onclick="remAppHiddenId('chgfil{{$each[0]->appid}}')"><i class="fa fa-money"></i></button>
										<form action="{{asset('client1/apply/app')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}" method="get">
										<input type="hidden" name="apptype" value="renewal" />
										<button type="submit" style="margin-top: 10px;" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Renew Application" ><i class="fa fa-refresh"></i></button>
										</form>
										@if($each[0]->hfser_id == 'LTO' && !in_array($each[0]->hgpid, ['6', '17', '18'])) <button hidden style="margin-top: 10px;" {{(FunctionsClientController::checkExpiryDate($each[0]->validDate) ? "" : "")}} class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Renew Facility" onclick="window.location.href='{{asset('client1/apply/app')}}/{{$each[0]->hfser_id}}/{{$each[0]->appid}}/R'"><i class="fas fa-refresh"></i></button> @endif
									</div>
								</div>					
							</td>
						</tr>
						<tr id="chgfil{{$each[0]->appid}}" hidden><td colspan="12">
						@if(count($each[1]) > 0) <?php $isDone = false; ?>
						<table class="table ">
							<thead class="thead-dark">
								<tr>
									<th>Date</th>
									<th>Reference</th>
									<th>Amount</th>
									<th>Option</th>
								</tr>
							</thead>
							<tbody>
								@foreach($each[1] AS $anEach)
								<tr>
									<td>{{date("F j, Y", strtotime($anEach->t_date))}}</td>
									<td>{{$anEach->reference}}</td>
									<td>&#8369;&nbsp;{{number_format($anEach->amount, 2)}}</td>
									@if(! $isDone)
										<td class="text-center" rowspan="{{count($each[1])}}" style="vertical-align: middle;">
											{{-- <button class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Add Payment"><i class="fas fa-money-check-alt"></i></button> --}}
											<a href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$each[0]->appid}}"><button class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i></button></a>
										</td>
										<?php $isDone = true; ?>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
						@else
							<center>No record in payment.</center>
						@endif
						</td> <td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td><td hidden></td> </tr>
						@endif @endforeach @else
						<tr>
							<td colspan="5">No application applied yet.</td>
						</tr>
						@endif
					</tbody>
				</table>
			</div>
		</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		var ___div = document.getElementById('__homeBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
		(function() {
			// let homeTbl = document.getElementById('homeTbl'), homeBody = homeTbl.getElementsByTagName('tbody')[0].getElementsByTagName('tr'), colors = ["green", "blue", "teal", "pink", "red", "yellow"], colorD = 0;
			// for(let i = 0; i < homeBody.length; i++) {
			// 	homeBody[i].style.color = colors[colorD];
			// 	colorD++;
			// 	if(colorD > (colors.length - 1)) {
			// 		colorD = 0;
			// 	}
			// }
			window.addEventListener('click', function(e) {
				var _target = e.target || window.event.target;
			});
		})();
		$(function () {
		  	$('[data-toggle="tooltip"]').tooltip()
		});
		$(document).ready( function () {
		    $('#homeTbl').DataTable({
		    	"ordering": false,
		    	"lengthMenu": [10, 20, 50, 100]
		    });
		    $('#aYear').DataTable( {
			  "pageLength": 1,
			  "lengthMenu": [1]
			} );
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