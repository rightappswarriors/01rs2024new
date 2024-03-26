@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	@include('client1.cmp.requirementsSlider')
	@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')
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
		<div class="container text-center font-weight-bold mt-5">Radiology Personnel </div>
		<div style="padding: 2%;" >
		<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button>
		<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr style="font-size: 15px">
							<th style="width: 20%">Full Name</th>
							<th>Designation/<br/>Position</th>
							<th>Profession</th>
							<th>Facility Assignment</th>
							<th>Qualification</th>
							<th style="width: 15%">PRC License Number</th>
							<th style="width: 10%">Validity Period</th>
							<th>PRC ID</th>
							<th>Board Certificate</th>
							<th>Contract of Employment</th>
							<th style="width: 2%">Option</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cdrrhrpersonnelnew as $personnel)
		      		{{-- @foreach($cdrrhrpersonnel as $personnel) --}}	
							<tr>
								{{-- <td>{{$personnel->prefix . " " . $personnel->firstname . " " . $personnel->surname . " " . $personnel->suffix}}</td> --}}
								<td>{{ucwords($personnel->name)}}</td>
								<td>{{$personnel->designation}}</td>
								<td>{{$personnel->posname}}</td>
								<td>{{$personnel->faciassign}}</td>
								<td>
									@php 

										$personel_professions = json_decode($personnel->profession);

										if($personel_professions != NULL){
											foreach($personel_professions as $personel_profession){
												if(isset($profession[$personel_profession.'-Radiology'])){
													echo $profession[$personel_profession.'-Radiology'].'<br>';
												}
												
											}
										}
										
									@endphp

									<!-- {{$personnel->qualification}} -->
								
								</td>
								<td>{{$personnel->prcno}}</td>
								<td>{{$personnel->validity}}</td>
								<td class="text-center">
									@isset($personnel->prc)
										<a target="_blank" href="{{ route('OpenFile', $personnel->prc)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
									@else
										<span class="font-weight-bold">NOT DEFINED YET</span>
									@endisset
								</td>
								<td class="text-center">
									@isset($personnel->bc)
										<a target="_blank" href="{{ route('OpenFile', $personnel->bc)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
									@else
										<span class="font-weight-bold">NOT DEFINED YET</span>
									@endisset
								</td>
								<td class="text-center">
									@isset($personnel->coe)
										<a target="_blank" href="{{ route('OpenFile', $personnel->coe)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
									@else
										<span class="font-weight-bold">NOT DEFINED YET</span>
									@endisset
								</td>
								<td style="width: 120px;">
									<div class="row">
										<div class="col-md-5">
											<button class="btn btn-warning"  data-toggle="modal" data-target="#editPersonnel" onclick="showData('{{$personnel->id}}'/*,'{{$personnel->name}}','{{$personnel->designation}}','{{$personnel->qualification}}','{{$personnel->prcno}}','{{$personnel->validity}}'*/,'{{$personnel->faciassign}}','{{$personnel->prc}}','{{$personnel->bc}}','{{$personnel->coe}}')"><i class="fa fa-edit"></i></button>
										</div>	
										<div class="col-md-5">
											<button class="btn btn-danger" data-toggle="modal" data-target="#deletePersonnel" onclick="showDelete('{{$personnel->id}}','{{$personnel->name}}')"><i class="fa fa-trash"></i></button>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
		      		</tbody>
		      	</table>
		</div>
		<div class="container pb-3" style="width: 100%; padding-right: 100px">
			
			<div class="container">
				
			</div>
		</div>
		<div class="remthis modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog modal-dialog-centered" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="viewModalLabel">Add Personnel</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBody">
	                   	<form id="personnelAdd">
	                   		{{csrf_field()}}
	                   		<input type="hidden" name="action" value="add">
	                   		<div class="container">
								<div class="row border">
									<select class="js-example-basic-multiple" name="states[]" multiple="multiple" style="width: 100%">
				                   		@if(count($annexa) > 0)
				                   			@foreach($annexa as $ann)
												  <option value="{{$ann->id}}">{{ucwords($ann->prefix . ' ' . $ann->firstname . ' ' . $ann->surname . ' ' . $ann->suffix)}}</option>
											@endforeach
										@endif
									</select>
								</div>
							</div>
							<div class="d-flex justify-content-center mt-3">
	                   			<button class="btn btn-primary pt-1" type="submit" id="getpersonnel">Submit</button>
	                   		</div>
							{{-- <div class="container pl-5">
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Full Name:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="add_name" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Designation/Position:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="add_position" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Facility Assignment:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="add_faciassign" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Qualification/Specialization:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="text" class="form-control w-100" name="add_qualification" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				PRC License Number:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input class="form-control w-100" name="add_prcno" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Validity Period:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="date" class="form-control w-100" name="add_validity" required="">
		                   			</div>
		                   		</div>
		                   		<div class="row mb-2">
		                   			<div class="col-sm">
		                   				Certificate Attachment:
		                   			</div>
		                   			<div class="col-sm-11">
		                   				<input type="file" class="form-control w-100" name="add_attachment" required="">
		                   			</div>
		                   		</div>
		                   			<button class="btn btn-primary pt-1" type="submit" id="getpersonnel">Submit</button>
							</div> --}}

	                   	</form>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="remthis modal fade" id="editPersonnel" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="viewModalLabel">Edit Personnel</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBodyEdit">
	                   	<form id="personnelEdit">					
	                   	</form>
	                   	<div class="offset-1 col-md">
	                   		<small class="text-danger mt-3 mb-3">NOTE: Changes and addition of personnel must be done on DOH Requirements</small>
	                   	</div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="remthis modal fade" id="deletePersonnel" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead">
	                    <h5 class="modal-title" id="viewModalLabel">Delete Personnel</h5>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBodyDelete">
	                </div>
	            </div>
	        </div>
	    </div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
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
			slider(['fda','CDRRHR/coc',{{$appid}}],['fda','CDRRHR/xrayservcat',{{$appid}}]);
		</script>
		<script>
			$(document).ready(function() {
			    $('.js-example-basic-multiple').select2();
			});
			$(function(){
				$("#tApp").dataTable();
			})
			function showData(id,/*name,pos,qualification,prcno,validity,*/faciassign,prcFile,bcFile,coeFile){
				$("#personnelEdit").empty().append(
					'<div class="container pl-5">'+
                   		// '<div class="row mb-2">'+
                   		// 	'<div class="col-sm">'+
                   		// 	'	Full Name:'+
                   		// 	'</div>'+
                   		// 	'<div class="col-sm-11">'+
                   			'{{csrf_field()}}'+
                   		// 		'<input value='+name+' class="form-control w-100" name="edit_name" required="">'+
                   				'<input type="hidden" class="form-control w-100" name="action" value="edit">'+
                   				'<input type="hidden" class="form-control w-100" name="id" value='+id+'>'+
                   		// 	'</div>'+
                   		// '</div>'+
                   		// '<div class="row mb-2">'+
                   		// 	'<div class="col-sm">'+
                   		// 		'Designation/Position:'+
                   		// 	'</div>'+
                   		// 	'<div class="col-sm-11">'+
                   		// 		'<input value='+pos+' class="form-control w-100" name="edit_position" required="">'+
                   		// 	'</div>'+
                   		// '</div>'+
                   		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   				'Facility Assignment:<span class="text-danger">*</span>'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   				'<input value="'+faciassign+'" class="form-control w-100" name="edit_faciassign" required="">'+
                   			'</div>'+
                   		'</div>'+
                   		// '<div class="row mb-2">'+
                   		// 	'<div class="col-sm">'+
                   		// 		'Qualification:'+
                   		// 	'</div>'+
                   		// 	'<div class="col-sm-11">'+
                   		// 	'	<input value='+qualification+' type="qualification" class="form-control w-100" name="edit_qualification" +required="">'+
                   		// 	'</div>'+
                   		// '</div>'+
                   		// '<div class="row mb-2">'+
                   		// 	'<div class="col-sm">'+
                   		// 		'PRC License Number:'+
                   		// 	'</div>'+
                   		// 	'<div class="col-sm-11">'+
                   		// 		'<input value='+prcno+' class="form-control w-100" name="edit_prcno" required="">'+
                   		// 	'</div>'+
                   		// '</div>'+
                   		// '<div class="row mb-2">'+
                   		// 	'<div class="col-sm">'+
                   		// 		'Validity Period:'+
                   		// 	'</div>'+
                   		// 	'<div class="col-sm-11">'+
                   		// 		'<input type="date" value='+validity+' class="form-control w-100" name="edit_validity" required="">'+
                   		// 	'</div>'+
                   		// '</div>'+
                   		// '<div class="row mb-2">'+
                   		// 	'<div class="col-sm">'+
                   		// 		'Cetificate Attachment:'+
                   		// 	'</div>'+
                   		// 	'<div class="col-sm-11">'+
                   		// 		'<input type="file" name="edit_attachment" class="form-control w-100">'+
                   		// 		'<input type="hidden" name="oldFilename" class="form-control w-100" value="'+filename+'">'+
                   		// 	'</div>'+
                   		// '</div>'+
	               		'<div class="row mb-2">'+
	               			'<div class="col-sm">'+
	               				'PRC ID:'+
	               			'</div>'+
	               			'<div class="col-sm-11">'+
	               			'	<input  type="file" class="form-control w-100" name="edit_prc" '+(prcFile == "" ? "required" : "") +'>'+
	               			'</div>'+
	               		'</div>'+
	               		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   				'Board Certificate:'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   			'	<input  type="file" class="form-control w-100" name="edit_bc" '+(bcFile == "" ? "required" : "") +'>'+
                   			'</div>'+
                   		'</div>'+
	               		'<div class="row mb-2">'+
                   			'<div class="col-sm">'+
                   				'Contract of Employment:'+
                   			'</div>'+
                   			'<div class="col-sm-11">'+
                   			'	<input  type="file" class="form-control w-100" name="edit_coe" '+(coeFile == "" ? "required" : "") +'>'+
                   			'</div>'+
                   		'</div>'+
           			'<button class="btn btn-primary pt-1" type="submit">Save</button>'+
					'</div>'
					);
			}
			function showDelete(id,name,filename){
				$("#viewBodyDelete").empty().append(
					'<div class="container">'+
					'<input type="hidden" id="idtodelete" value='+id+'>'+
					'<input type="hidden" id="filename" value='+filename+'>'+
					' Are you sure you want to delete <span class="text-danger">'+
					name +
					'</span>?<br><br>'+
					'<button type="button" class="btn btn-danger" id="delete">Submit</button>&nbsp;'+
					'<button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>'+
					'</div>'
					);
			}
			$(document).on('click','#delete',function(event){
				$.ajax({
					type: 'POST',
					data:{_token:$('input[name=_token]').val(), action:'delete',id:$("#idtodelete").val(),filename:$("#filename").val()},
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Deleted Personnel');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})
			$(document).on('submit','#personnelAdd',function(event){
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
							alert('Successfully Added new Personnel');
							location.reload();
						} else if(a == 'invalidFile') {
							alert('File Invalid! Please upload valid PDF file');
						}
					}
				})
			})
			$(document).on('submit','#personnelEdit',function(event){
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
							alert('Successfully Edited Personnel');
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
