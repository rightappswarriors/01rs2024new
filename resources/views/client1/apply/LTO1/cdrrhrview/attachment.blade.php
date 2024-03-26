@if (session()->exists('employee_login'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	<body>
		<div class="container text-center font-weight-bold mt-5">Other Attachments</div>
		<div class="container pb-3">
			<div class="container">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
							<th>Attachment For</th>
							<th>Attachment Details</th>
							<th>Attachment</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cdrrhrotherattachment as $receipt)
							<tr>
								<td>{{$receipt->reqName}}</td>
								<td>{{$receipt->attachmentdetails}}</td>
								<td>
									<a target="_blank" href="{{ route('OpenFile', $receipt->attachment)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
								</td>
							</tr>
						@endforeach
		      		</tbody>
		      	</table>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		<script type="text/javascript">
			"use strict";
			// var ___div = document.getElementById('__applyBread'), ___wizardcount = document.getElementsByClassName('wizardcount');
			// document.getElementById('stepDetails').innerHTML = 'Step 3.b: FDA Requirement';
			// if(___wizardcount != null || ___wizardcount != undefined) {
			// 	for(let i = 0; i < ___wizardcount.length; i++) {
			// 		if(i < 2) {
			// 			___wizardcount[i].parentNode.classList.add('past');
			// 		}
			// 		if(i == 2) {
			// 			___wizardcount[i].parentNode.classList.add('active');
			// 		}
			// 	}
			// }
			// if(___div != null || ___div != undefined) {
			// 	___div.classList.remove('active');	___div.classList.add('text-primary');
			// }
		</script>
		<script>
			$(function(){
				$("#tApp").dataTable();
			})
		</script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif