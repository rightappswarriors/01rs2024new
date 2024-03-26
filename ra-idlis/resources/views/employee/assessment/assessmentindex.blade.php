@extends('mainEmployee')
@section('title', 'Assessment Tool')
@section('content')
<div class="content p-4">
	<div class="card">
		<div class="card-header bg-white font-weight-bold">
			Assessment
		</div>
		<div class="card-body table-responsive">
			@for($levels=1; $levels<=3/*ilisan kung pila ka levels tanan*/; $levels++)
				<hr>
				<a class="text-white" href="/doholrs4/employee/dashboard/assessment/hospitallevel{{$levels}}"><button class="btn btn-primary" href="/">Hospital Level {{$levels}}</button></a>
				<hr>
			@endfor
		</div>
	</div>
</div>
@endsection