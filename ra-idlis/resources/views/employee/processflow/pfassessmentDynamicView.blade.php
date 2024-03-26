@if (session()->exists('employee_login'))  
	@extends('mainEmployee')
	@section('title', 'Assessment Dynamic View')
	@section('content')
		<div class="container table-responsive mt-5">
			<table class="table table-striped">
				<thead >
					<th>STANDARDS AND REQUIREMENTS</th>
					<th>COMPLIANT</th>
					<th>REMARKS</th>
				</thead>
				<tbody>
					@foreach($data as $dk => $dt)
					<tr>
						<td>{!!(isset($dt[1]) ? $dt[1] : 'NO DATA')!!}</td>
						<td>{!!(isset($dt[2]) && !$dt['isRemark'] ? ($dt[2] == 'true' ? '<i class="fa fa-check text-success" style="font-size:30px"; aria-hidden="true"></i>' : $dt[2]) : '')!!}</td>
						<td>{!!(isset($dt[2]) && $dt['isRemark'] ? $dt[2] : 'No Remarks')!!}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
