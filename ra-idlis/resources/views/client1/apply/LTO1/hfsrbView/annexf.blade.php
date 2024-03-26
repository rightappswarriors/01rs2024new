@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	{{-- @include('client1.cmp.nav') --}}
		{{-- @include('client1.cmp.breadcrumb') --}}
		@include('client1.cmp.msg')

	<body>
		{{-- @include('client1.cmp.__wizard') --}}
		
		<div class="container pb-3 pt-5">
			<div class="container table-responsive">
				<table class="table table-hover border" width="400" id="tApp">
		      		<thead style="background-color: #428bca; color: white">
		      			<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Rad No.</th>
							<th>Rad Onco</th>
							<th>FPCR*</th>
							<th>DPBR*</th>
							<th>DOH Cert</th>
							<th>FP CCP*</th>
							<th>Trained*</th>
							<th>FPROS*</th>
							<th>RXT*</th>
							<th>RRT*</th>
							<th>RSO*</th>
							<th>Others*</th>
							<th>PRC License No.</th>
							<th>Validity*</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($hfsrbannexf as $personnel)
							<tr>
								<td>{{$personnel->name}}</td>
								<td>{{$personnel->position}}</td>
								<td>{!!($personnel->rad == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->radonco == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->fpcr == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->dpbr == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->dohcert == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->fpccp == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->trained == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->fpros == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->rxt == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->rrt == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{!!($personnel->rso == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : "")!!}</td>
								<td>{{$personnel->others}}</td>
								<td>{{$personnel->prcno}}</td>
								<td>{{$personnel->validity}}</td>
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