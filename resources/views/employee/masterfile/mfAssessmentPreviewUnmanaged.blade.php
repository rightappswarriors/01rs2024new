@if (session()->exists('employee_login'))
	@extends('mainEmployee')
	@section('title', 'Preview Assessment (Unmanaged)')
	@section('content')
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				<div class="container-fluid">
					Preview Assessment (Unmanaged)
				</div>
			</div>
			<div class="card-body">
				<div class="container table-responsive">
					<table class="table table-striped" id="example">
						@php $until = 4; @endphp
						<thead>
							<tr>
								<th rowspan="2">Assessment ID (asmt2_id)</th>
								<th rowspan="2">Assessment Headers (asmt2_loc)</th>
								<th rowspan="2">Assessment Description (asmt2_desc)</th>
								<th rowspan="2">Assessment SubDescription Code (asmt2sd_id)</th>
								<th rowspan="2">Assessment Location (asmt2l_id)</th>
								<th rowspan="2">Assessment Location Description (asmt2l_sdesc)</th>
								<th rowspan="2">Header Level (header_lvl)</th>
								<th class="text-center" colspan="4">Headers</th>
							</tr>
							<tr>
								@for($i = 1; $i <= $until; $i++)
								<th>Header Level {{$i}}</th>
								@endfor
							</tr>
						</thead>
						<tbody>
						@foreach($data as $dbData)
							@if(isset($dbData->asmt2_id))
								<tr>
									<td>{{$dbData->asmt2_id}}</td>
									<td>{{$dbData->asmt2_loc}}</td>
									<td>{{$dbData->asmt2_desc}}</td>
									{{-- <td>{!!isset($dbData->asmt2sd_desc) ? $dbData->asmt2sd_desc : 'NOT SPECIFIED'!!}</td> --}}
									<td>{!!isset($dbData->asmt2sd_id) ? $dbData->asmt2sd_id : 'NOT SPECIFIED'!!}</td>
									<td>{!!$dbData->asmt2l_id!!}</td>
									<td>{!!isset($dbData->asmt2l_sdesc) ? $dbData->asmt2l_sdesc : 'NOT SPECIFIED'!!}</td>
									<td class="text-center">{!!isset($dbData->header_lvl) ? $dbData->header_lvl : 'NOT SPECIFIED'!!}</td>
									@for($i = 1.0; $i <= $until; $i++)
										@php 
											$lvl = 'header_lvl'.$i;
											$preserv = $lvl;
											$lvl = $dbData->$lvl;
											$lvl = $lvl.'Desc';
										@endphp
										<td>{{($lvl == 'Desc' ? 'No Header' :(isset($data[$lvl]) ? $data[$lvl] : $dbData->$preserv) )}}</td>
									@endfor
								</tr>
							@endif
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function() {
	         $('#example').DataTable({
	         	"order": [[ 2, "asc" ]]
	         });
	    });
	</script>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif