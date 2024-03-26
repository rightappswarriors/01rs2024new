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
		<div class="container text-center font-weight-bold mt-5">Pharmacy OR</div>
		<div style="padding: 2%;" >
		<button class="btn btn-primary pl-3 mb-3" data-toggle="modal" data-target="#viewModal">Add</button>
		<table class="table table-hover" id="tApp">
		      		<thead style="background-color: #428bca; color: white" id="theadapp">
		      			<tr>
							<th>Reference Transaction Number</th>
							<th>Valid To</th>
							<th>OR / Proof of Payment</th>
							<th>Action</th>
						</tr>
		      		</thead>
		      		<tbody id="loadHere">
		      			@foreach($cocs as $coc)
							<tr>
								<td>{{$coc->coc_number}}</td>
								<td>{{$coc->valid_to}}</td>
								<td class="text-center">
									@isset($coc->coc_file)
										<a target="_blank" href="{{ route('OpenFile', $coc->coc_file)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
									@else
										<span class="font-weight-bold">NOT DEFINED YET</span>
									@endisset
								</td>
								<td class="text-center" style="width:150px;">
									<div class="row">
										<div class="col-md-5">
											<button class="btn btn-warning"  data-toggle="modal" data-target="#editPersonnel" onclick="showData('{{$coc->id}}', '{{$coc->coc_number}}', '{{$coc->valid_to}}', '{{$coc->coc_file}}' )"><i class="fa fa-edit"></i></button>
										</div>
										<div class="col-md-5">
											<button class="btn btn-danger" data-toggle="modal" data-target="#deletePersonnel" onclick="showDelete('{{$coc->id}}', '{{$coc->coc_number}}')"><i class="fa fa-trash"></i></button>
										</div>
									</div>
								</td>
							</tr>
						@endforeach
		      		</tbody>
		      	</table>
		</div>
		<div class="container pb-3">
			
			<div class="container">
			
			</div>
		</div>
		<div class="remthis modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead" style="display: block;">
	                    <h5 class="modal-title" id="viewModalLabel">Add OR</h5>
						<small>Uploading of the OR is required and will be the basis for issuance of the order of Payment</small>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBody">
	                   	<form id="personnelAdd">
                            {{csrf_field()}}

                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="fda_type" value="Pharmacy">
                            <div class="container">

                                <div class="row mb-2">
                                    <div class="col-sm">
                                        Reference Transaction Number:
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="coc_number" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-sm">
                                         Validity (optional):
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="date" class="form-control" name="valid_to" >
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-sm">
                                        OR or Proof of Payment:
                                    </div>
                                    <div class="col-sm-12">
                                        <input type="file" class="form-control" name="coc_file" >
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <button class="btn btn-primary pt-1" type="submit" id="getpersonnel">Submit</button>
                                </div>
                            </div>
	                   	</form>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="remthis modal fade" id="editPersonnel" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
	        <div class="modal-dialog" role="document">
	            <div class="modal-content">
	                <div class="modal-header" id="viewHead" style="display:block;">
	                    <h5 class="modal-title" id="viewModalLabel">Edit COC</h5>
						<small>Uploading of the OR is required and will be the basis for issuance of the order of Payment</small>
	                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                <div class="modal-body" id="viewBodyEdit">
	                   	<form id="personnelEdit">					
	                   	</form>
	                   	<div class="offset-1 col-md">
	                   		<small class="text-danger mt-3 mb-3">NOTE: Changes and addition on personnel must be done on DOH Requirements</small>
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
            slider([],['fda','CDRR/personnel',{{$appid}}]);
        </script>
		<script>
			$(document).ready(function() {
			    $('.js-example-basic-multiple').select2();
			});
			$(function(){
				$("#tApp").dataTable();
			})
			function showData(id,coc_number,coc_validity,coc_file){
				$("#personnelEdit").empty().append(
					'<div class="container pl-5">'+
                            '{{csrf_field()}}'+
                                '<input type="hidden" class="form-control w-100" name="action" value="edit">'+
                                '<input type="hidden" class="form-control w-100" name="id" value='+id+'>'+
                                '<input type="hidden" class="form-control w-100" name="fda_type" value="Pharmacy">'+
                        '<div class="row mb-2">'+
                            '<div class="col-sm">'+
                                'COC Number:'+
                            '</div>'+
                            '<div class="col-sm-11">'+
                                '<input value="'+coc_number+'" class="form-control w-100" name="coc_number" >'+
                            '</div>'+
                        '</div>'+
                            '<div class="row mb-2">'+
                            '<div class="col-sm">'+
                                'COC Validity'+
                            '</div>'+
                            '<div class="col-sm-11">'+
                                '<input type="date" value="'+coc_validity+'" class="form-control w-100" name="valid_to">'+
                            '</div>'+
                        '</div>'+
                        '<div class="row mb-2">'+
                            '<div class="col-sm">'+
                                'PRC ID:<span class="text-danger">*</span>'+
                            '</div>'+
                            '<div class="col-sm-11">'+
                                '<input  type="file" class="form-control w-100" name="coc_file" '+(coc_file == "" ? "required" : "") +'>'+
                            '</div>'+
                        '</div>'+
                            '<button class="btn btn-primary pt-1" type="submit">Save</button>'+
                    '</div>'
				);
			}
			function showDelete(id,coc_number){
				$("#viewBodyDelete").empty().append(
					'<div class="container">'+
					'<input type="hidden" id="idtodelete" value='+id+'>'+
					' Are you sure you want to delete <span class="text-danger">'+
					coc_number +
					'</span>?<br>'+
					'<button type="button" class="btn btn-danger" id="delete">Submit</button>'+
					'<button type="button" class="btn btn-primary"data-dismiss="modal">Close</button>'+
					'</div>'
					);
			}
			$(document).on('click','#delete',function(event){
				$.ajax({
					type: 'POST',
					data:{_token:$('input[name=_token]').val(), action:'delete',id:$("#idtodelete").val()},
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
				$.ajax({
					type: 'POST',
                    contentType: false,
    				processData: false,
					data:data,
					success: function(a){
						if(a == 'DONE'){
							alert('Successfully Added new COC');
							location.reload();
						} else {
							console.log(a);
						}
					},
                    fail: function(a,b,c){
						console.log([a,b,c]);
					}
				})
			})
			$(document).on('submit','#personnelEdit',function(event){
				event.preventDefault();
				let data = new FormData(this);
				console.log("data")
				console.log(data)
				$.ajax({
					type: 'POST',
					contentType: false,
    				processData: false,
					data:data,
					success: function(a){
						console.log("a")
						console.log(a)
						if(a == 'DONE'){
							alert('Successfully Edited COC');
							location.reload();
						} else {
							console.log(a);
						}
					},
					fail: function(a,b,c){
						console.log([a,b,c]);
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