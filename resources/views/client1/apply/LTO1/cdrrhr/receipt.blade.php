@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')

	<body>
		@include('client1.cmp.__wizard')
		
		<div class="container pb-3">
			<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button>
			<div class="container">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
							<th>Transaction/Deposit Slip/Official Receipt No.</th>
							<th>Date of Payment</th>
							<th>Office</th>
							<th>Amount Paid</th>
							<th>Receipt Attachment</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cdrrhrreceipt as $receipt)
							<tr>
								<td>{{$receipt->receiptno}}</td>
								<td>{{$receipt->dop}}</td>
								<td>{{$receipt->office}}</td>
								<td>{{$receipt->amountpaid}}</td>
								<td class="text-center"><a target="_blank" href="{{ route('OpenFile', $receipt->attachment)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
							</tr>
							@endforeach
		      		</tbody>
		      	</table>
			</div>
		</div>

		<div class="remthis modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="viewModalLabel">Add Payment Receipt</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBody">
	                   	<form id="receiptAdd" enctype="multipart/form-data" method="POST">
	                   		{{csrf_field()}}
							<div class="container pl-5">
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Transaction/Deposit Slip/Official Receipt No.:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="add_receipt" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Date of Payment:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="date" class="form-control w-100" name="add_dop" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Office:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="add_office" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Amount Paid:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="number" class="form-control w-100" name="add_amount" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Receipt Attachment:
		                   				<p class="text-danger">WARNING! Please upload PDF file only</p>
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="file" class="form-control w-100" name="add_attachment" required="">
		                   			</div>
		                   		</div>
		                   			<button class="btn btn-primary pt-1" type="submit">Submit</button>
							</div>
	                   	</form>
	                </div>
	            </div>
	        </div>
	    </div>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		<script type="text/javascript">
			"use strict";
			var ___div = document.getElementById('__applyBread'), ___wizardcount = document.getElementsByClassName('wizardcount');
			document.getElementById('stepDetails').innerHTML = 'Step 3.b: FDA Requirement';
			if(___wizardcount != null || ___wizardcount != undefined) {
				for(let i = 0; i < ___wizardcount.length; i++) {
					if(i < 2) {
						___wizardcount[i].parentNode.classList.add('past');
					}
					if(i == 2) {
						___wizardcount[i].parentNode.classList.add('active');
					}
				}
			}
			if(___div != null || ___div != undefined) {
				___div.classList.remove('active');	___div.classList.add('text-primary');
			}
		</script>
		@include('client1.cmp.footer')
		<script>
			$(function(){
				$("#tApp").dataTable();
			})

			$(document).on('submit','#receiptAdd',function(event){
				event.preventDefault();
				let data = new FormData(this);
				data.append('action','add');
				$.ajax({
					type: 'POST',
					data:data,
					cache: false,
			        contentType: false,
			        processData: false,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Added new Payment Receipt');
							location.reload();
						} else if(a == 'invalidFile') {
							alert('File Invalid! Please upload valid PDF file');
						}
					}
				})
			})
		</script>
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif