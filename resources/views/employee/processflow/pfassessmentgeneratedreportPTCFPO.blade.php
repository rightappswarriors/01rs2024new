@if (session()->exists('employee_login')) 

@extends('mainEmployeeFPO')
@section('title', 'Generated Report assessment file') 	
@section('content')
	@include('employee.processflow.pfassessmentgeneratedreportPTCdetails')
@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
