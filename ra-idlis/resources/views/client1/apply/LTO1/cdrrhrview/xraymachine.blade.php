@if (session()->exists('employee_login'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')

	<body>
		
		<div class="container pb-3 pt-3 table-responsive">
			<div class="container">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
							<th>Type of X-ray Machine</th>
							<th>Manufacturer Control Console</th>
							<th>Manufacturer Tube housing</th>
							<th>Model Control Console</th>
							<th>Model Tube Head</th>
							<th>Serial Control Console</th>
							<th>Serial Tube Housing</th>
							<th>X-ray Machine Max.mA</th>
							<th>X-ray Machine Max.kVp</th>
							<th>Location</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cdrrhrxraylist as $xraylist)
							<tr>
								<td>{{$xraylist->xraydesc}}</td>
								<td>{{$xraylist->brandtubeconsole}}</td>
								<td>{{$xraylist->brandtubehead}}</td>
								<td>{{$xraylist->modeltubeconsole}}</td>
								<td>{{$xraylist->modeltubehead}}</td>
								<td>{{$xraylist->serialconsole}}</td>
								<td>{{$xraylist->serialtubehead}}</td>
								<td>{{$xraylist->maxma}}</td>
								<td>{{$xraylist->maxkvp}}</td>
								<td>{{$xraylist->location}}</td>
							</tr>
							@endforeach
		      		</tbody>
		      	</table>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		<script>
			$(function(){
				$("#tApp").dataTable();
			})
		</script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif