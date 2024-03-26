@if (session()->exists('employee_login'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')

	<body>
		@php $already = []; @endphp

		
		<div class="container mt-5 mb-5">
			<p class="text-center">GENERAL RADIOGRAPHY (TICK APPROPRIATE SERVICES)</p>
			{{csrf_field()}}
			<div class="container">
				<div class="row">
				@foreach($serv as $cat)
					@if(!in_array($cat->catid, $already))
						@php array_push($already,$cat->catid); @endphp
						<div class="container pt-5 pb-5 text-center lead ">
							<u>{{$cat->catdesc}}</u>
						</div>
					@endif
					<div class="col-md-4">
						<div class="custom-control custom-checkbox">
					    	<input name="services[]" type="checkbox" class="custom-control-input" id="{{$cat->servid}}" {{(is_array($selected) ? in_array($cat->servid,$selected) ? "checked" : "" : "")}} value="{{$cat->servid}}">
					    	<label class="custom-control-label" for="{{$cat->servid}}">{{$cat->servdesc}}</label>
					  	</div>
				  	</div>
				@endforeach
				</div>
			</div>
		</div>
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif