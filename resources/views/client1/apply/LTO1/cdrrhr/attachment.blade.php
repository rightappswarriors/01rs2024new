@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')
		<style>
		@media print{
			
			footer, nav, button, #navBarWiz, div.dfn-hover, span.text-danger{
				display: none!important;
			}
			div.alert-warning{
				font-size: 10px;
			}

		}

		dfn {
		cursor: help;
		font-style: normal;
		position: relative;
		
		}
		dfn::after {
		    content: attr(data-info);
			white-space: pre-line;
			display: inline;
			position: absolute;
			top: 22px;
			left: 0;
			opacity: 0;
			width: 800px;
			font-size: 13px;
			font-weight: 700;
			line-height: 1.5em;
			padding: 0.5em 0.8em;
			background: rgba(0,0,0,0.8);
			color: #fff;
			pointer-events: none;
			transition: opacity 250ms, top 250ms;
		}
		dfn::before {
		content: '';
		display: block;
		position: absolute;
		top: 12px; left: 10px;
		opacity: 0;
		width: 0; height: 0;
		border: solid transparent 5px;
		border-bottom-color: rgba(0,0,0,0.8);
		transition: opacity 250ms, top 250ms;
		}
		dfn:hover {z-index: 2;} /* Keeps the info boxes on top of other elements */
		dfn:hover::after,
		dfn:hover::before {opacity: 1;}
		dfn:hover::after {top: 40px;}
		dfn:hover::before {top: 30px;}
	</style>
	<body>
		@include('client1.cmp.__wizard')
		<div class="container-fluid mt-5">
			<div class="row">
				<div class="col-md-6 d-flex justify-content-start" id="prevDiv">
					<a href="#" class="inactiveSlider slider"><button class="btn btn-success pl-3 mb-3">&laquo; Previous</button></a>
				</div>
				<div class="col-md-6 d-flex justify-content-end" id="nextDiv">
				<button class="btn btn-success pl-3 mb-3" style="color: white !important;">	<a href="#" style="color: white !important;" class="activeSlider slider"> &raquo;</a></button>
				</div>
			</div>
		</div>
		<div class="container text-center font-weight-bold mt-5">Radiation Facility Other Attachments</div>
		<div class="container pb-3 pt-3">
			<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button>
			<div class="col-md-1 pt-1 dfn-hover" style="font-size: 30px; display: inline-block;">
			<dfn data-info="Other attachments requirements

			1. Photocopy of the certificate of all the radiologist/s for being a Fellow of the Philippine College of
			Radiology (FPCR) or Diplomate of the Philippine Board of Radiology (DPBR).
			(FOR RENEWAL APPLICATION WITH NO CHANGES ON CURRENT RADIOLOGIST/S,
			THIS REQUIREMENT IS OPTIONAL)

			2. Photocopy of the certificate of training of the radiologic/x-ray technologist who will act as the
			radiation protection officer (RPO) as proof that he/she completed the RPO training provided by an
			FDA- or DOH-recognized training

			3. Photocopy of certificate of training in radiology of the head of the facility if he/she is not an
			FPCR/DPBR for government facilities and for facilities in areas with no FPCR/DPBR within 45 km
			vicinity radius

			4. Photocopy of valid notarized contract of employment of all the radiologist/s and radiologic/x-ray
			technologist/s. The CDRRHR recommends that the contract be valid for at least one (1) year.

			5. Photocopy of the Official Receipt of the personal dose monitor (TLD or OSL) from the provider of
			personnel dose monitoring service

			6. Photocopy of machine calibration report from FDA – CSL/DTI – PAB-accredited testing body.
			(FOR INITIAL/VARIATION APPLICATION). For facilities with changes/additional in machine

			7. Duly filled out Self-Assessment Forms. Refer to FDA Circular 2020-035 for the guide.
			(FOR INITIAL/VARIATION APPLICATION). For facilities with changes/additional in machine

			8. Photocopy of performance test report from FDA – CSL/DTI – PAB accredited testing body.
			(FOR INITIAL/VARIATION APPLICATION OF CT SCAN/MAMMOGRAPHY ONLY). For facilities with changes/additional in machine

			9. Duly filled out and notarized affidavit of continuous compliance.
			(FOR RENEWAL APPLICATION ONLY)">
			
			<button class="btn btn-default mb-3" data-toggle="modal" data-target="#viewModalInfo"><i class="fa fa-question-circle" aria-hidden="true"></i> See the Details Info</button>
			</dfn>
			</div>

		

			<div class="container">
				<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
		      				<th>Attachment For</th>
							<th>Attachment Details</th>
							<th>Attachment</th>
							<th>Option</th>
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
								<td>
									<center>
										<button class="btn btn-warning"  data-toggle="modal" data-target="#deletePersonnel" onclick="showData('{{$receipt->id}}','{{$receipt->reqID}}','{{$receipt->attachmentdetails}}','{{$receipt->attachment}}')"><i class="fa fa-edit"></i></button>&nbsp;
										<button class="btn btn-danger" data-toggle="modal" data-target="#deletePersonnel" onclick="showDelete('{{$receipt->id}}','{{$receipt->attachment}}')"><i class="fa fa-trash"></i></button>
									</center>
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
		                   			<div class="col-sm req">
		                   				Attachment For: 
										   <button class="btn btn-default mb-3" data-toggle="modal" data-target="#viewModalInfo"><i class="fa fa-question-circle" aria-hidden="true"></i></button>
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<select name="req" id="req" class="form-control" required="">
		                   					<option value selected disabled hidden="">Please Select</option>
		                   					@foreach($attType as $att)
		                   					<option value="{{$att->reqID}}">{{$att->reqName}}</option>
		                   					@endforeach
		                   				</select>
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
									   <span class="req">Attachment Details:</span>
		                   			</div>
		                   			<div class="col-sm-12">
		                   				<textarea name="add_details" class="form-control" id="add_details" cols="40" rows="10" required=""></textarea>
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm ">
		                   				<span class="req">Attachment:</span>
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

		<div class="remthis modal fade" id="viewModalInfo" tabindex="-1" role="dialog" aria-labelledby="viewModalInfoLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="viewModalLabel"> 
								<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16">
								<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
								<path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
								</svg>  
								Type of Other Attachments Requirements
						</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body">
	                   	<ol>
							<li>Photocopy of the certificate of all the radiologist/s for being a Fellow of the Philippine College of
							Radiology (FPCR) or Diplomate of the Philippine Board of Radiology (DPBR).
							(FOR RENEWAL APPLICATION WITH NO CHANGES ON CURRENT RADIOLOGIST/S,
							THIS REQUIREMENT IS OPTIONAL)</li>

							<li>Photocopy of the certificate of training of the radiologic/x-ray technologist who will act as the
							radiation protection officer (RPO) as proof that he/she completed the RPO training provided by an
							FDA- or DOH-recognized training</li>

							<li>Photocopy of certificate of training in radiology of the head of the facility if he/she is not an
							FPCR/DPBR for government facilities and for facilities in areas with no FPCR/DPBR within 45 km
							vicinity radius</li>

							<li>Photocopy of valid notarized contract of employment of all the radiologist/s and radiologic/x-ray
							technologist/s. The CDRRHR recommends that the contract be valid for at least one (1) year.</li>

							<li>Photocopy of the Official Receipt of the personal dose monitor (TLD or OSL) from the provider of
							personnel dose monitoring service</li>

							<li>Photocopy of machine calibration report from FDA – CSL/DTI – PAB-accredited testing body.
							(FOR INITIAL/VARIATION APPLICATION). For facilities with changes/additional in machine</li>

							<li>Duly filled out Self-Assessment Forms. Refer to FDA Circular 2020-035 for the guide.
							(FOR INITIAL/VARIATION APPLICATION). For facilities with changes/additional in machine</li>

							<li>Photocopy of performance test report from FDA – CSL/DTI – PAB accredited testing body.
							(FOR INITIAL/VARIATION APPLICATION OF CT SCAN/MAMMOGRAPHY ONLY). For facilities with changes/additional in machine</li>

							<li>Duly filled out and notarized affidavit of continuous compliance.
							(FOR RENEWAL APPLICATION ONLY)</li>
						</ol>
	                </div>
					<div class="modal-footer text-center">
						
						<button type="button" class="btn" data-dismiss="modal" aria-label="Close">Close</button>
						
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
			slider(['fda','CDRRHR/xraymachines',{{$appid}}],[ 'app','LTO',{{$appid}},'fda','Proceed To Submission of FDA Requirements']);
		</script>
		<script>
	
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
			function showData(id,reqname,details,filename){
				$("#viewModalLabelCRUD").html('Edit Attachment');
				$("#viewBodyCRUD").empty().append(
					'<form id="receiptEdit" enctype="multipart/form-data" method="POST">'+
	               		'{{csrf_field()}}'+
						'<div class="container pl-5">'+
							'<div class="row mb-2">'+
	                   			'<div class="col-sm">'+
	                   				'Requirements For:'+
	                   			'</div>'+
	                   			'<div class="col-sm-11">'+
	                   			'<select name="edit_req" id="edit_req" class="form-control">'+
	               					@foreach($attType as $att)
	               					'<option value="{{$att->reqID}}">{{$att->reqName}}</option>'+
	               					@endforeach
	               				'</select>'+
	                   			'</div>'+
	                   		'</div>'+
	                   		'<div class="row mb-2">'+
	                   			'<div class="col-sm">'+
	                   				'Attachment Details:'+
	                   			'</div>'+
	                   			'<div class="col-sm-11">'+
	                   			'<input type="hidden" name="oldFilename" value="'+filename+'">'+
	                   			'<input type="hidden" class="form-control w-100" name="id" value='+id+'>'+
	                   				'<textarea class="form-control" name="edit_details" id="edit_details" cols="40" rows="10">'+details+'</textarea>'+
	                   			'</div>'+
	                   		'</div>'+
	                   		'<div class="row mb-2">'+
	                   			'<div class="col-sm req">'+
	                   				'Attachment:'+
	                   			'</div>'+
	                   			'<div class="col-sm-11">'+
	                   				'<input type="file" class="form-control w-100" name="edit_attachment" >'+
	                   			'</div>'+
	                   		'</div>'+
	                   			'<button class="btn btn-primary pt-1" type="submit">Submit</button>'+
						'</div>'+
					'</form>'
					);
				$("#edit_req").val(reqname);
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