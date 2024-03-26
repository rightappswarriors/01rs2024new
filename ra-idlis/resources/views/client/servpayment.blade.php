@extends('main')
@section('content')
@include('client.cmp.__servpayment')
<body>
	@include('client.cmp.nav')
	@include('client.cmp.__msg')
	@include('client.cmp.breadcrumb')
	<script type="text/javascript">
		var ___div = document.getElementById('__paymentBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
	</script>
	<div class="container mt-5">
		@include('client.cmp.__breadcrumb')
		<script type="text/javascript">
			var arrBrd = ['Payment', 'Application Form'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>

		<div class="row">
			<div class="col table-responsive">
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th>Facility Type</th>
							<th>Service Capabilities</th>
							<th>Amount</th>
						</tr>
					</thead>
					<tbody>
						<?php $_total = 0; ?> @if(is_array($services)) @if(count($services) > 0) @foreach($services AS $servicesRow)
						<?php $_total = $_total + $servicesRow->amt; ?>
						<tr>
							<td>{{$servicesRow->hgpdesc}}</td>
							<td>{{$servicesRow->facname}}</td>
							<td>&#8369;&nbsp;{{number_format($servicesRow->amt, 2)}}</td>
						</tr>
						@endforeach @else
						<tr><td colspan="3">No available payment</td></tr>
						@endif
						@else
						<tr><td colspan="3">No available payment</td></tr>
						@endif
					</tbody>
					<tfoot>
						<tr>
							<th>TOTAL:</th>
							<td></td>
							<td>&#8369;&nbsp;{{number_format($_total, 2)}}</td>
						</tr>
					</tfoot>
				</table>
			</div>
			<div class="col">
				<div class="card">
					<form method="POST" action="{{asset('client/payment/app')}}" enctype="multipart/form-data">
						{{csrf_field()}}
						<div class="card-header">
							<h5 class="card-title">Payment</h5>
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col">
									<label>Payment Date</label>
								</div>
								<div class="col">
									<input type="date" name="pdate" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label>Mode of Payment</label>
								</div>
								<div class="col">
									<select name="mop" class="form-control">
										<option value>None</option>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label>OR Reference</label>
								</div>
								<div class="col">
									<input type="text" name="orreference" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label>Deposit Slip Number</label>
								</div>
								<div class="col">
									<input type="text" name="deposit" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label>Other Reference</label>
								</div>
								<div class="col">
									<input type="text" name="other" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label>Attached file</label>
								</div>
								<div class="col">
									<input type="file" name="attachfile" class="form-control">
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label>Total Amount</label>
								</div>
								<div class="col">
									<input type="hidden" name="total" class="form-control" value="{{$_total}}">
									<strong>&#8369;&nbsp;{{number_format($_total, 2)}}</strong>
								</div>
							</div>
							<div class="row">
								<div class="col">
									<label>Amount Paid</label>
								</div>
								<div class="col">
									<input type="number" name="amount" class="form-control">
								</div>
							</div>
						</div>
						<div class="card-footer">
							<button type="submit" class="btn btn-success pull-right" name="paymentSubmit" value="asd">Proceed</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		(function() {
			sendRequestRetArr([], "{{asset('/client/request/customQuery/getModePayment')}}", 'GET', true, {
				functionProcess: function(arr) {
					document.getElementsByName('mop')[0].innerHTML = '<option value>None</option>';
					if(arr.length > 0) {
						for(var i = 0; i < arr.length; i++) {
							document.getElementsByName('mop')[0].innerHTML += '<option value="'+arr[i]['chg_code']+'">'+arr[i]['chg_desc']+'</option>';
						}
					}
				}
			});
		})();
	</script>
</body>
@include('client.cmp.foot')
@endsection