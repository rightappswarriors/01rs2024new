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
						<h5 class="card-title text-center">Department of Health</h5>
						<h5 class="card-title text-center">ORDER OF PAYMENT</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row pt-3">
					<div class="col-md-4"><span class="pull-left">Date:</span></div>
					<div class="col-md-8"><u><strong>{{date("F j, Y", strtotime($appDet[0][0]->t_date))}}</strong></u></div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="pull-left">Name of Hospital:</span></div>
					<div class="col-md-8"><u><strong>{{$appDet[0][0]->facilityname}}</strong></u></div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="pull-left">Address:</span></div>
					<div class="col-md-8"><u><strong>{{$appDet[0][0]->rgn_desc}}, {{$appDet[0][0]->provname}}, {{$appDet[0][0]->cmname}}, {{$appDet[0][0]->brgyname}}, {{$appDet[0][0]->street_name}}</strong></u></div>
				</div>
				<div class="row">
					<div class="col-md-4"><span class="pull-left">Please Charge the amount of:</span></div>
					<div class="col-md-8"><u><strong>{{strtoupper($totalWord[1])}} ONLY</strong></u></div>
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
						@if(count($appDet[1]) > 0) @foreach($appDet[1] AS $each)
						<tr>
							<td>{{date("F j, Y", strtotime($each->t_date))}}</td>
							<td>{{$each->reference}}</td>
							<td>&#8369;&nbsp;{{number_format($each->amount, 2)}}</td>
						</tr>
						@endforeach @else
						<tr>
							<td colspan="3">No charge(s).</td>
						</tr>
						@endif
					</tbody>
				</table><br><br><br>
				<div class="text-center">
					<span class="text-danger font-italic font-weight-bold"><u>NOTE: This Order of Payment is subject for approval.</u></span>
				</div>
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
</body>
@endsection