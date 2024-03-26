@if (session()->exists('employee_login'))
	@extends('mainEmployee')
	@section('title', 'Preview Assessment')
	@section('content')
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				<div class="container-fluid">
					Preview Assessment ({{$data[0]->title_name}})
				</div>
			</div>
			<div class="card-body">
				<div class="container text-center mb-5">
				Previewing Assessment in: <span class="font-weight-bold">{{$data[0]->hgpdesc}}</span><br>
				with Service of : <span class="font-weight-bold">{{$data[0]->facname}}</span><br>
				on Application : <span class="font-weight-bold">{{$data[0]->hfser_desc}}</span><br>
				</div>
				
				<div class="container table-responsive">
					<table class="table table-striped" id="example">
						@php $until = 4; @endphp
						<thead>
							<tr>
								<th rowspan="2">Description</th>
								<th rowspan="2">Sub-Description</th>
								<th rowspan="2">Sequence Number</th>
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
							@if(isset($dbData->srvasmt_id))
								<tr>
									<td>
										{{$dbData->asmt2l_desc}}<br>
										{{$dbData->asmt2_desc}}
									</td>
									<td>{!!$dbData->asmt2sd_desc!!}</td>
									@php 
									@endphp
									<td>{{$dbData->srvasmt_seq}}</td>
									@for($i = 1; $i <= $until; $i++)
										@php 
											$lvl = 'header_lvl'.$i;
											$preserv = $lvl;
											$lvl = $dbData->$lvl;
											$lvl = $lvl.'Desc';
										@endphp
										<td>{{($lvl == 'Desc' ? 'No Header' :(isset($data[$lvl]) ? $data[$lvl] : $dbData->$preserv ))}}</td>
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