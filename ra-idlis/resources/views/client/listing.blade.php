@extends('main')
@section('content')
@include('client.cmp.__listing')
<body>
	@include('client.cmp.nav')
	@include('client.cmp.__msg')
	@include('client.cmp.breadcrumb')
	<script type="text/javascript">
		var ___div = document.getElementById('__homeBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
	</script>
	<div class="container mt-5">
		<div class="table-responsive">
			<table class="table table-bordered text-center">
			  <thead>
			    <tr>
			      <th rowspan="2" scope="col" style="vertical-align: middle;">Facility Name</th>
			      <th rowspan="2" scope="col" style="vertical-align: middle;">Owner</th>
			      <th rowspan="2" scope="col" style="vertical-align: middle;">Health Facility Type</th>
			      <th rowspan="2" scope="col" style="vertical-align: middle;">Application Type</th>
			      <th rowspan="2" scope="col" style="vertical-align: middle;">Date</th>
			      <th colspan="3" scope="col" style="vertical-align: middle;">Status</th>
			    </tr>
			    <tr>
			      <th scope="col" style="vertical-align: middle;">Application</th>
			      <th scope="col" style="vertical-align: middle;">Payment (Application)</th>
			      <th scope="col" style="vertical-align: middle;">Payment options</th>
			    </tr>
			  </thead>
			  <tbody>
			  	@isset($listing)
				  	@foreach($listing as $allData)
				  	<?php $_payment = []; foreach($payment AS $paymentRow) { if($paymentRow->appform_id == $allData->appid) { array_push($_payment, $paymentRow); } } ?>
				    <tr>
				      <th>{{$allData->facilityname}}</th>
				      <td>{{$allData->owner}}</td>
				      <td>{{$allData->hfser_desc}}</td>
				      <td>{{$allData->aptdesc}}</td>
				      <td>{{date('F j, Y', strtotime($allData->t_date))}}</td>
				      <td>{{$allData->trns_desc}}</td>
				      <td>{{(empty($allData->oop_total) ?"Pending":(($allData->oop_total - $allData->oop_paid) > 0 ? $allData->oop_total - $allData->oop_paid : "Paid"))}}</td>
				      <td><button class="btn btn-light" data-toggle="collapse" href="#appid{{$allData->appid}}" role="button" aria-expanded="false" aria-controls="appid{{$allData->appid}}"><i class="fa fa-plus-circle"></i></button></td>
				    </tr>
				    <tr>
				    	<td colspan="8">
				    		<div class="collapse" id="appid{{$allData->appid}}">
					    		<div class="row">
					    			<div class="col"><strong>Date</strong></div>
					    			<div class="col"><strong>Charge/Payment Description</strong></div>
					    			<div class="col"><strong>Reference</strong></div>
					    			<div class="col"><strong>Amount</strong></div>
					    		</div>
					    		@if(count($_payment) > 0) 
					    		@foreach($_payment AS $_paymentRow)
					    		<div class="row">
					    			<div class="col">{{date('F j, Y', strtotime($_paymentRow->t_date))}}</div>
					    			<div class="col">{{$_paymentRow->chg_desc}}</div>
					    			<div class="col">{{$_paymentRow->reference}}</div>
					    			<div class="col">{{number_format($_paymentRow->amount, 2)}}</div>
					    		</div>
						    	@endforeach @else
					    		<div class="row">
					    			<div class="col">No record</div>
					    		</div>
						    	@endif
						    </div>
				    	</td>
				    </tr>
				    @endforeach
			    @endisset
			  </tbody>
			</table>
		</div>
	</div>
</body>
@include('client.cmp.foot')
@endsection