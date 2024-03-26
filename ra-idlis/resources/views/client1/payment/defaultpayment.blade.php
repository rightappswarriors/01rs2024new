@extends('main')
@section('content')
@include('client1.cmp.__payment')
<body>
	<style type="text/css">
		@media print {
			.hidePrint {
				visibility: hidden;
			}
			@page { margin: 0; } body { margin: 1.6cm; }
			.pagebreak { page-break-before: always; }
		}
	</style>
	<div class="container mt-5 mb-5">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-2 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-8">
						<h6 class="card-title text-center">Republic of the Philippines</h6>
						<h5 class="card-title text-center">Department of Health</h5>
						<h5 class="card-title text-center">HEALTH FACILITIES AND SERVICES REGULATORY BUREAU</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="container">
					Name of Health Facility or Service Provider: <span class="font-weight-bold text-uppercase">{{$neededData[0]->facilityname}}</span> 
				</div>
				<div class="container">
					Application Code: <span class="font-weight-bold text-uppercase">{{$neededData[0]->hfser_id}}R{{$neededData[0]->rgnid}}-{{$neededData[0]->appid}}</span> 
				</div>
				<div class="container pt-1">
					Address: <span class="font-weight-bold text-uppercase">{{$neededData[0]->street_name}} {{$neededData[0]->street_number}} {{$neededData[0]->brgyname}} {{$neededData[0]->cmname}} {{$neededData[0]->provname}} {{$neededData[0]->rgn_desc}}</span> 
				</div>
				<div class="container pt-1">
					<div class="row">
						<div class="col">
							Telephone No.: <span class="font-weight-bold text-uppercase">{{$neededData[0]->contact}}</span> 
						</div>
						{{-- <div class="col">
							Fax No.: <span class="font-weight-bold text-uppercase">123</span> 
						</div> --}}
						<div class="col">
							Email Address: <span class="font-weight-bold text-uppercase">{{$neededData[0]->email}}</span> 
						</div>
					</div>
				</div>
				<div class="container pt-1">
					Owner: <span class="font-weight-bold text-uppercase">{{$neededData[0]->owner}}</span> 
				</div>
				<div class="container pt-1">
					Classification According to:
				</div>
				<div class="container pt-1">
					<div class="col" style="margin-left: 100px;">
						Ownership: <span class="font-weight-bold text-uppercase">{{$neededData[0]->ocdesc}}</div>
					</div>
					@if($neededData[0]->hfser_id == 'LTO')
					<div class="col" style="margin-left: 115px;">
						Institutional Character: <span class="font-weight-bold text-uppercase">{{$neededData[0]->facmdesc}}({{$neededData[0]->classname}})</span>
					</div>
					@endif
				</div>
				@if(strtolower($neededData[0]->hfser_id) == 'lto')
					<div class="container pt-1">
						Status of Application: <span class="font-weight-bold text-uppercase">{{$neededData[0]->aptdesc}}</span> 
					</div>
				@endif
				@if(isset($neededData[0]->noofbed) && $isDisplayABC)
				<div class="container pt-1">
					Authorized Bed Capacity (ABC): <span class="font-weight-bold text-uppercase">{{$neededData[0]->noofbed}}</span> 
				</div>
				@endif
				@if(strtolower($neededData[0]->hfser_id) == 'lto')
				<div class="container pt-2 font-weight-bold text-uppercase">
					LICENSE TO OPERATE
				</div>
				@endif

				@if(strtolower($neededData[0]->hfser_id) == 'ptc')
				<div class="container pt-2 font-weight-bold text-uppercase">
					PERMIT TO CONSTRUCT
				</div>
				@endif
				@if(strtolower($neededData[0]->hfser_id) == 'coa')
				<div class="container pt-2 font-weight-bold text-uppercase">
					CERTFICIATE OF ACCREDITATION
				</div>
				@endif
				@if(strtolower($neededData[0]->hfser_id) == 'ato')
				<div class="container pt-2 ">
					<span class="font-weight-bold text-uppercase">AUTHORITY TO OPERATE</span>(For Free Standing)
				</div>
				@endif
				@if(strtolower($neededData[0]->hfser_id) == 'cor')
				<div class="container pt-2 font-weight-bold text-uppercase">
					CERTIFICATE OF REGISTRATION
				</div>
				@endif
				<div class="container pt-1">
					<div class="col">
						Facility Type: <span class="font-weight-bold text-uppercase">{{$neededData[1][3][0]->hgpdesc}}</span>
					</div>
					
					<div class="col">
						{{(strtolower($neededData[1][3][0]->hgpdesc) == 'hospital' ? 'Function: ' : 'Service/s: ')}} <span class="font-weight-bold text-uppercase">{{$neededData[1][2][0]->facname}}</span>
					</div>
				</div>
				<div class="container pt-3">

					Date of Application: <span class="font-weight-bold">{{Date('F, j Y',strtotime($neededData[0]->autoTimeDate))}}</span>
				</div>
				<br>
			</div>
		</div>
	</div>
					
	<div class="container mt-5 mb-5 pagebreak">
		@if(count($appDet[0]) > 0)
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-2 hide-div">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="float: right; max-height: 118px; padding-left: 20px;">
					</div>
					<div class="col-md-8">
						<h6 class="card-title text-center">Republic of the Philippines</h6>
						<h5 class="card-title text-center">Department of Heatlh</h5>
						<h5 class="card-title text-center">ORDER OF PAYMENT</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-md-4"><span class="pull-left">Date:</span></div>
					<!-- <div class="col-md-8"><u><strong>{{date("F j, Y", strtotime($appDet[0][0]->t_date))}}</strong></u></div> -->
					<div class="col-md-8"><u><strong>{{Date('F, j Y',strtotime($neededData[0]->autoTimeDate))}}</strong></u></div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="pull-left">Name of Health Facility:</span></div>
					<div class="col-md-8"><u><strong>{{$appDet[0][0]->facilityname}}</strong></u></div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="pull-left">Address:</span></div>
					<div class="col-md-8"><u><strong>{{$appDet[0][0]->rgn_desc}}, {{$appDet[0][0]->provname}}, {{$appDet[0][0]->cmname}}, {{$appDet[0][0]->brgyname}}, {{$appDet[0][0]->street_name}}</strong></u></div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="pull-left">Please Charge the amount of:</span></div>
					<div class="col-md-8"><u><strong>{{strtoupper($totalWord[1])}} PESOS ONLY</strong></u></div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="pull-left">PHP:</span></div>
					<div class="col-md-8"><u><strong>&#8369;&nbsp;{{number_format($totalWord[0], 2)}}</strong></u></div>
				</div>
				<br><br>
				<table class="table table-bordered">
					<thead class="thead-dark">
						<tr>
							<th>Date</th>
							<th>Description</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						@if(count($appDet[1]) > 0) 
						@php
						$total = 0;
						@endphp
						@foreach($appDet[1] AS $each)
							@if($each->m04ID_FK == null)
							@php
								$total += $each->amount;
							@endphp

							<tr>
								<td>{{date("F j, Y", strtotime($each->t_date))}}</td>
								<td>{{$each->reference}}</td>
								<td>&#8369;&nbsp;{{number_format($each->amount, 2)}}</td>
							</tr>
							@endif

						@endforeach

						@if(count($discounts) > 0)

						@for($i = 0; $i < count($discounts); $i++)


						@php

						$discountdecimal = floatval(floatval($discounts[$i]->percentage) / 100);
						$discountprice = $discountdecimal * floatval($total);
						$discountedtotal = floatval($total) - floatval($discountprice);
						$total = $discountedtotal;
						@endphp
						<tr>
							<td>{{date("F j, Y", strtotime($discounts[$i]->date_start))}} {{date("F j, Y", strtotime($discounts[$i]->date_end))}}</td>
							<td>{{$discounts[$i]->description}} {{$discounts[$i]->percentage}}%</td>
							<td>&#8369;&nbsp;{{number_format($discountprice, 2)}}</td>
						</tr>



						@endfor 

						@endif
						<tr>
							<td></td>
							<td><b>Total</b></td>
							<td>&#8369;&nbsp;{{number_format($total, 2)}}</td>
						</tr>
						 @else
						<tr>
							<td colspan="3">No charge(s).</td>
						</tr>
						@endif

					</tbody>
				</table><br><br><br>
				@if(!$Notfinal)
				<div class="text-center">
					<span class="text-danger font-italic font-weight-bold"><u>NOTE: This Order of Payment is subject for approval.</u></span>
				</div>
				@endif
			</div>
			<div class="card-footer">
				<p class="hidePrint text-muted text-small" style="float: left; padding: 0; margin: 0;">
					<a href="{{asset('client1/home')}}"><button class="btn btn-dark"><i class="fa fa-arrow-circle-left"></i></button></a>
					{{-- <iframe src="{{asset('ra-idlis/resources/views/client1/qrcode/index.php')}}?data={{asset('client1/certificates')}}/{{
$retTable[0]->hfser_id}}/{{$retTable[0]->appid}}" style="border: none !important; height: 91px; width: 91px;"></iframe> --}}
				</p>
				<p class="hidePrint text-muted text-small" style="float: right; padding: 0; margin: 0;">© All Rights Reserved {{date('Y')}}</p>
			</div>
		</div>
		@else

		@endif
	</div>
	<script type="text/javascript">
		// window.print();
	</script>
</body>
@endsection