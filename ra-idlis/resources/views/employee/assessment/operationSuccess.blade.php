@if (session()->exists('employee_login'))
	@extends('mainEmployee')
	@section('title', 'Success')
	@section('content')
		<div class="container text-center">
			<div class="d-flex justify-content-center mt-5 mb-3">
				<p>
					<i class="fa fa-check-circle text-success" style="font-size: 170px;" aria-hidden="true"></i>
				</p>
			</div>
			<div class="container display-3">
				Data Saved Successfully!
			</div>
			<div class="container lead mt-4 mb-2">
				Data has been saved successfully. Please wait for other assessor to complete then a button will be generated that will take you to the view of finished assessment.
			</div>
			<div class="d-flex justify-content-center mt-5">
				<a href="{{$redirectTo}}" class="btn btn-success text-white p-3"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go back</a>
			</div>

		</div>
	@endsection
@else
<script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif