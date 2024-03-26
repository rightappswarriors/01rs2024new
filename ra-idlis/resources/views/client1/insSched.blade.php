	@include('client1.cmp.__apply')
	@extends('main')
	@if (session()->exists('uData'))  
		@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
	@endif
	@section('content')
	<body>
		<div class="container pb-3 pt-3">
			<div class="row mt-5">
		        <div class="col-md text-center">
		          <p style="font-size: 30px;">Inspection will be conducted in any of the following days:</p>
		          <span style="font-size: 20px;">{!!str_replace('<br>,', '<br>', json_decode($data->proposedWeek))!!}</span><br>
		        </div>
		    </div>
		    @if(count($inspectors) > 0)
		    <div class="col-md text-center" style="font-size: 30px;">With Inspectors:</div>
		    <div class="row mt-3 text-center" style="border: 1px solid black">
		    	@foreach($inspectors as $ins)
		    	<div class="col-md-4 mt-4 mb-3" style="font-size: 20px;">{{$ins->fname . ' ' . $ins->lname}}</div>
		    	@endforeach
		    </div>
		    <div class="row text-center">
		    	<div class="col-md mt-3">
		    		<span class="text-danger">Note: Team members may changed anytime.</span>
		    	</div>
		    </div>
		    @endif
		</div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		@include('client1.cmp.footer')
	</body>
	@endsection
