{{-- @if (session()->exists('uData'))   --}}
	@section('content')
	{{-- @if (session()->exists('uData')) --}}
	@extends('main')
	@include('client1.cmp.__apply')
	{{-- @endif --}}
	<style>
		table,th,tr,td{
			border: 2px solid black!important;
		}
	</style>
	<body>
		@include('client1.cmp.msg')
		@if (session()->exists('uData'))
		@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.__wizard')
		@endif

		<div class="container border pt-3 pb-3">
			<table class="table">
				<thead>
					<tr class="font-weight-bold" style="background-color: rgb(148,138,84);">
						<th>STANDARDS AND REQUIREMENTS</th>
						<th class="text-center">COMPLIANT</th>
						<th>REMARKS</th>
					</tr>
				</thead>
				<tbody>
					@isset($reports)
						@foreach($reports as $report)
						@if(isset($report->assessmentHead))
						<tr>
							<td colspan="3" class="" style="background-color: rgb(196,188,150);">{!!$report->assessmentHead!!}</td>
						</tr>
						@endif
						<tr>
							<td>
								<div class="container" style="min-height: 150px;">
									{!!$report->assessmentName!!}
								</div>
							</td>
							<td class="text-center mt-3" style="font-size:30px">

								{!!( $report->evaluation == 'NA' ? '<i class="fa fa-ban text-danger" aria-hidden="true"></i>' : ($report->evaluation ? '<i class="fa fa-check text-success" ; aria-hidden="true"></i>' : '<i class="fa fa-times text-danger" aria-hidden="true"></i>' ))!!}
							</td>
							<td>
								{{$report->remarks}}
							</td>
						</tr>

						@endforeach
					@endisset
				</tbody>
			</table>

			{{-- <div class="container"> --}}
			{{-- <div class="col-md-12 text-left font-weight-bold">Assessed By:</div>
			<table class="table">
				<thead>
					<tr>
						<th>Printed Name</th>
						<th>Position/Designation</th>
					</tr>
				</thead>
				<tbody>
					@isset($assessor)
						@foreach($assessor as $evaluator)
							@if(isset($evaluator->authorizedsignature))
							<tr>
								<td class="font-weight-bold">{{ucwords($evaluator->authorizedsignature)}}</td>
								<td>{{$evaluator->position}}</td>
							</tr>
							@else
							<tr>
								<td class="font-weight-bold">UNKNOWN</td>
								<td>UNKNOWN</td>
							</tr>
							@endif
						@endforeach
					@endisset
				</tbody>
			</table> --}}
			@if (session()->exists('uData'))

			@if(isset($aptid) && !empty($aptid))
			

			{{--  @if($aptid=="IC") --}}
					<div class="col-md-12 text-left font-weight-bold text-center">
						<a href="{{url('client1/apply/attachment/')}}/{{$hfser_id}}/{{$appid}}" class="btn btn-primary">Proceed to attachments <i class="fa fa-chevron-right"></i> </a>		
					</div>
				{{-- @else
					<div class="col-md-12 text-left font-weight-bold text-center">
						<a href="{{asset('client1/printPayment')}}/{{FunctionsClientController::getToken()}}/{{$appid}}" class="btn btn-primary" style="border-radius: 3px;"  href="#">View Order of Payment on DOH <i class="fa fa-chevron-right"></i> </a>			
					</div>
				@endif --}}
			
			@else			<div class="col-md-12 text-left font-weight-bold text-center">
					<a href="{{url('client1/apply/attachment/')}}/{{$hfser_id}}/{{$appid}}" class="btn btn-primary">Proceed to attachments <i class="fa fa-chevron-right"></i> </a>

				{{-- @if($hfser_id == 'COA')
					<a href="{{url('client1/apply/attachment/')}}/COA/{{$appid}}" class="btn btn-primary">Proceed to attachments <i class="fa fa-chevron-right"></i> </a>
				@else
					<a href="{{url('client1/apply/app/LTO/'.$appid.'/'.'hfsrb')}}" class="btn btn-primary">Proceed to DOH Requirements <i class="fa fa-chevron-right"></i> </a>
				@endif	--}}
					
				@endif
				</div>
			
			
			@endif
			{{-- </div> --}}
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		
		@include('client1.cmp.footer')
	</body>
	@endsection
{{-- @else --}}
  {{-- <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script> --}}
{{-- @endif --}}