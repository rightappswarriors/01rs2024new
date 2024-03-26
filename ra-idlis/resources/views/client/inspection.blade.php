@extends('main')
@section('content')
@include('client.cmp.__inspection')
<body>
	@include('client.cmp.nav')
	@include('client.cmp.__msg')
	@include('client.cmp.breadcrumb')
	<script type="text/javascript">
		var ___div = document.getElementById('__inspectionBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
	</script>
	<div class="container mt-5">
		@include('client.cmp.__breadcrumb')
		@isset($hfserId)
		<script type="text/javascript">
			var arrBrd = ['Inspection', 'Application'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		<h4>Select Facility Type</h4><hr>
			@if(count($hfserId) > 0) @foreach($hfserId AS $hfserIdRow)
			@isset($hfserIdRow->hf_null)<form method="POST" action="{{asset('/client/inspection')}}">
				{{csrf_field()}}
				<input type="hidden" name="hfserId" value="{{$hfserIdRow->hfser_id}}">@endisset
				<button type="submit" class="btn btn-light btn-block">@isset($hfserIdRow->hf_null)<label class="badge badge-success"><i class="fa fa-check-circle"></i></label>@endisset {{$hfserIdRow->hfser_desc}}</button><hr>
			@isset($hfserIdRow->hf_null)</form>@endisset
			@endforeach @else
			@endif
		@endisset
		@isset($viewInsp)
		<script type="text/javascript">
			var arrBrd = ['Inspection', 'Facility Type', 'Inspection Details'];
			for(var i = 0; i < arrBrd.length; i++) {
				document.getElementById('_brdcmb').innerHTML += '<li class="breadcrumb-item '+((i == (arrBrd.length - 1)) ? 'active' : '')+'" '+((i == (arrBrd.length - 1)) ? 'aria-current="page"' : '')+'>'+arrBrd[i]+'</li>';
			}
		</script>
		<?php $_arrDisp = ['asmt_id']; $_uid = $curUser->uid; $_hfser_id = $viewInsp->hfser_id; ?>
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th rowspan="2" class="text-center" style="vertical-align: middle; width:40%">Assessment Name</th>
						<th colspan="{{count($viewAptid)}}" class="text-center">{{$viewInsp->hfser_desc}}</th>
					</tr>
					<tr>
						@if(count($viewAptid) > 0) @foreach($viewAptid AS $viewAptidRow)
						<?php array_push($_arrDisp, $viewAptidRow->aptid); ?>
						<th>{{$viewAptidRow->aptdesc}}</th>
						@endforeach @endif
					</tr>
				</thead>
				<tbody>
					@if(count($asmtTbl[0]) > 0) @for($j = 0; $j < count($asmtTbl[0]); $j++)
					<tr>
						<td>{{$asmtTbl[0][$j]->asmt_name}}</td>
						@for($i = 1; $i < count($_arrDisp); $i++)
						<?php $_mc = ""; $_fc = ""; $_bc = ""; if($asmtTbl[$i][$j]->asmt_id == $asmtTbl[0][$j]->asmt_id) { if(isset($asmtTbl[$i][$j]->ifNull)) { if(isset($asmtTbl[$i][$j]->isapproved)) { if($asmtTbl[$i][$j]->isapproved == 1) { $_mc = "Approved"; $_fc = "fa-check-circle"; $_bc = "badge-success"; } else { $_mc = "Not Approved"; $_fc = "fa-times-circle"; $_bc = "badge-danger"; } } else { $_mc = "Approval Pending"; $_fc = "fa-question-circle"; $_bc = "badge-warning"; } } else { $_mc = "No Assessment"; $_fc = "fa-exclamation-circle"; $_bc = "badge-dark"; } } else { $_mc = "Not record"; $_fc = "fa-unlink"; $_bc = "badge-secondary"; } ?>
						<td><label class="badge {{$_bc}}"><i class="fa {{$_fc}}"></i> {{$_mc}}</label></td>
						@endfor
					</tr>
					@endfor @else
					<tr>
						<td colspan="{{count($asmtTbl)}}" class="text-center">No Assessment.</td>
					</tr>
					@endif
				</tbody>
			</table>
		</div>
		@endisset
	</div>
</body>
@include('client.cmp.foot')
@endsection