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
			<div class="container">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
							<th>Test</th>
							<th>Kit Type</th>
							<th>Kit</th>
							<th>Lot Number</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($hfsrbannexi as $Equipment)
							<tr>
								<td>{{$Equipment->test}}</td>
								<td>{{$Equipment->kittype}}</td>
								<td>{{$Equipment->kit}}</td>
								<td>{{$Equipment->lotno}}</td>
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