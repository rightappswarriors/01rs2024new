@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	@include('client1.cmp.requirementsSlider')
	@include('client1.cmp.nav')
	@include('client1.cmp.breadcrumb')
	@include('client1.cmp.msg')
	{{-- cdrrhr = pharmacy --}}
		<?php 
			$toProceed = (FunctionsClientController::hasRequirementsFor('cdrrhr',$appid) ? true : false);
		?>
	<body>
		@include('client1.cmp.__wizard')
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-6 d-flex justify-content-start" id="prevDiv">
					<a href="#" class="inactiveSlider slider">&laquo; Previous</a>
				</div>
				<div class="col-md-6 d-flex justify-content-end" id="nextDiv">
					<a href="#" class="activeSlider slider">Next &raquo;</a>
				</div>
			</div>
		</div>
		<div class="container text-center font-weight-bold mt-5">Other Attachments</div>
		<div class="container pb-3">
			@if(!$canAdd)
			<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button>
			@endif
			<div class="container">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
							<th>Attachment Details</th>
							<th>Attachment</th>
							<th>Option</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cdrrattachment as $receipt)
							<tr>
								<td>{{$receipt->attachmentdetails}}</td>
								<td>
									<a target="_blank" href="{{ route('OpenFile', $receipt->attachment)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
								</td>
								<td>
									@if(!$canAdd)
									<center>
										<button class="btn btn-warning"  data-toggle="modal" data-target="#deletePersonnel" onclick="showData('{{$receipt->id}}','{{$receipt->attachmentdetails}}','{{$receipt->attachment}}')"><i class="fa fa-edit"></i></button>&nbsp;
										<button class="btn btn-danger" data-toggle="modal" data-target="#deletePersonnel" onclick="showDelete('{{$receipt->id}}','{{$receipt->attachment}}')"><i class="fa fa-trash"></i></button>
									</center>
									@else
									NOT AVAILABLE
									@endif
								</td>
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
	                    <h5 class="modal-title" id="viewModalLabel">Add Attachment</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBody">
	                   	<form id="receiptAdd" enctype="multipart/form-data" method="POST">
	                   		{{csrf_field()}}
							<div class="container pl-5">
		                   		<div class="row mb-2">
		                   			<div class="col-sm required">
		                   				Attachment Details: 
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<textarea name="add_details" class="form-control" id="add_details" cols="40" rows="10" required></textarea>
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm required">
		                   				Attachment:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="file" class="form-control w-100" name="add_attachment" required="">
		                   				<p class="text-danger">WARNING! Please upload PDF file only</p>
		                   			</div>
		                   		</div>
		                   			<button class="btn btn-primary pt-1" type="submit">Submit</button>
							</div>
	                   	</form>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="remthis modal fade" id="deletePersonnel" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="viewModalLabelCRUD"></h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBodyCRUD">
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
		@include('client1.cmp.footer')
		<script>
			onStep(3);
			slider(['fda','CDRR/personnel',{{$appid}}],[@if($toProceed)  'fda','CDRRHR','personnel',{{$appid}},'Proceed To Submission of Pharmacy Requirements' @else 'app','LTO',{{$appid}},'fda','Proceed To Submission of FDA Requirements'  @endif]);
		</script>
		<script>
			// $(".required").each(function(index, el) {
			// 	$(el).append('<span class="text-danger" style="font-size: 20px;">*</span>');
			// });
			function showDelete(id,filename){
				$("#viewModalLabelCRUD").html('Delete Attachment');
				$("#viewBodyCRUD").empty().append(
					'<div class="container">'+
					'<input type="hidden" id="idtodelete" value='+id+'>'+
					'<input type="hidden" id="deleteFile" value='+filename+'>'+
					' Are you sure you want to delete this entry?<br><br>'+
					'<button type="button" class="btn btn-danger" id="delete">Submit</button> &nbsp;'+
					'<button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>'+
					'</div>'
					);
			}
			function showData(id,details,filename){
				$("#viewModalLabelCRUD").html('Edit Attachment');
				$("#viewBodyCRUD").empty().append(
					'<form id="receiptEdit" enctype="multipart/form-data" method="POST">'+
	               		'{{csrf_field()}}'+
						'<div class="container pl-5">'+
	                   		'<div class="row mb-2">'+
	                   			'<div class="col-sm">'+
	                   				'Attachment Details:'+
	                   			'</div>'+
	                   			'<div class="col-sm-11">'+
	                   			'<input type="hidden" name="oldFilename" value="'+filename+'">'+
	                   			'<input type="hidden" class="form-control w-100" name="id" value='+id+'>'+
	                   				'<textarea class="form-control" name="edit_details" id="edit_details" cols="40" rows="10" required>'+details+'</textarea>'+
	                   			'</div>'+
	                   		'</div>'+
	                   		'<div class="row mb-2">'+
	                   			'<div class="col-sm">'+
	                   				'Attachment:'+
	                   				'<p class="text-danger">WARNING! Please upload PDF file only</p>'+
	                   			'</div>'+
	                   			'<div class="col-sm-11">'+
	                   				'<input type="file" class="form-control w-100" name="edit_attachment" >'+
	                   			'</div>'+
	                   		'</div>'+
	                   			'<button class="btn btn-primary pt-1" type="submit">Submit</button>'+
						'</div>'+
					'</form>'
					);
			}
			$(document).on('submit','#receiptEdit',function(event){
				event.preventDefault();
				let data = new FormData(this);
				
				data.append('action','edit');
				$.ajax({
					type: 'POST',
					data:data,
					cache: false,
			        contentType: false,
			        processData: false,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Edited Attachment');
							location.reload();
						} else if(a == 'invalidFile') {
							alert('File Invalid! Please upload valid PDF file');
						}
					}
				})
			})
			$(document).on('click','#delete',function(event){
				$.ajax({
					type: 'POST',
					data:{_token:$('input[name=_token]').val(), action:'delete',id:$("#idtodelete").val(), deleteFile:$("#deleteFile").val()},
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Deleted Attachment');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})
			$(function(){
				$("#tApp").dataTable();
			})
			$(document).on('submit','#receiptAdd',function(event){
				event.preventDefault();
				let data = new FormData(this);
				// console.log("data")
				// console.log(new FormData(this))
				data.append('action','add');
				
				$.ajax({
					type: 'POST',
					data:data,
					cache: false,
			        contentType: false,
			        processData: false,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Added new Attachment');
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