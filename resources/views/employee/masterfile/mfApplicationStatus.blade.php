@if (session()->exists('employee_login'))
	@extends('mainEmployee')
	@section('title', 'Application Status Master File')
	@section('content')
	<input type="text" id="CurrentPage" hidden="" value="AP002">
	<div class="content p-4">
		<datalist id="rgn_list">
			@if (isset($apptype))
				@foreach ($apptype as $apptypes)
					<option value="{{$apptypes->aptid}}">{{$apptypes->aptdesc}}</option>
				@endforeach
			@endif
		</datalist>
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				Application Status <span class="AP002_add"><a href="#" title="Add New Application Status" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
			</div>
			<div class="card-body">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th style="width: auto">#</th>
							<th style="width: auto">ID</th>
							<th style="width: auto">Description</th>
							<th style="width: auto">Required</th>
							<th style="width: auto">Update</th>
							<th style="width: 25%"><center>Options</center></th>
						</tr>
					</thead>
					<tbody>
						@if (isset($apptype))
							@foreach ($apptype as $apptypes)
							<tr>
								<td scope="row"> {{$apptypes->apt_seq}}</td>
								<td scope="row"> {{$apptypes->aptid}}</td>
								<td>{{$apptypes->aptdesc}}</td>
								<td>
									@isset($apptypes->apt_reqid)
										<strong>{{$apptypes->apt_req_name}}</strong>
									@else
									None
									@endisset
								</td>
								<td>
									@isset($apptypes->apt_isUpdateTo)
										<strong>{{$apptypes->apt_upd_name}}</strong>
									@else
									None
									@endisset
								</td>
								<td>
								<center>
									<span class="AP002_update">
									<button type="button" class="btn btn-outline-warning" onclick="showData('{{$apptypes->aptid}}', '{{$apptypes->aptdesc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
									</span>
								<span class="AP002_cancel">
									<button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$apptypes->aptid}}', '{{$apptypes->aptdesc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
									</span>
								</center>
								</td>
							</tr>
							@endforeach
						@endif
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{{-- Add --}}
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body text-justify" style=" background-color: #272b30;
				color: white;">
					<h5 class="modal-title text-center"><strong>Add New Appplication Status</strong></h5>
					<hr>
					<div class="container">
						<form id="addRgn" class="row"  data-parsley-validate>
							{{ csrf_field() }}
							<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
								<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
								<button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div> 
							<div class="col-sm-4">ID:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required"  class="form-control"  required>
							</div>
							<div class="col-sm-4">Description:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
							</div>
							<div class="col-sm-4">Requirement:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" id="new_req" class="form-control">
									@isset($Stat)
									<option value="">None</option>
										@foreach($Stat as $s)
											<option value="{{$s->aptid}}">{{$s->aptdesc}}</option>
										@endforeach
									@else
									<option value="">No registered Application Status</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-4">Update to:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" id="new_upd" class="form-control">
									@isset($isUpdate)
									<option value="">None</option>
										@foreach($isUpdate as $s)
											<option value="{{$s->aptid}}">{{$s->aptdesc}}</option>
										@endforeach
									@else
									<option value="">No registered Application Status</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-12">
								<button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
							</div> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- Edit --}}
	<div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #272b30;color: white;">
					<h5 class="modal-title text-center"><strong>Edit Application Status</strong></h5>
					<hr>
					<div class="container">
						<form id="EditNow" data-parsley-validate>
							<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="EditErrorAlert" role="alert">
								<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
									<button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
							</div>
								<span id="EditBody">
								</span>
							<div class="row">
								<div class="col-sm-6">
									<button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
								</div> 
								<div class="col-sm-6">
									<button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- Delete --}}
	<div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #272b30;color: white;">
					<h5 class="modal-title text-center"><strong>Delete Application Status</strong></h5>
					<hr>
					<div class="container">
						<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
							<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
							<button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<span id="DelModSpan">
						</span>
						<hr>
						<div class="row">
							<div class="col-sm-6">
								<button type="button" onclick="deleteNow();" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
							</div> 
							<div class="col-sm-6">
								<button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable({
				// dom: 'Bfrtip',
				// buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
			});
		} );
		function showData(id,desc){
	      $('#EditBody').empty();
	      $('#EditBody').append(
	          '<div class="col-sm-4">ID:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
	          '</div>' +
	          '<div class="col-sm-4">Description:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
	          '</div>' + 
	          '<div class="col-sm-4">Required:</div>' 
	        );
	    }
	    function showDelete (id,desc){
	        $('#DelModSpan').empty();
	        $('#DelModSpan').append(
	            '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
	              // <input type="text" id="edit_desc2" class="form-control"  style="margin:0 0 .8em 0;" required>
	            '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
	            '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
	            '</div>'
	          );
	    }
	    function deleteNow(){
	      var id = $("#toBeDeletedID").val();
	      var name = $("#toBeDeletedname").val();
	      $.ajax({
	        url : "{{ asset('employee/mf/del_appstatus') }}",
	        method: 'POST',
	        data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
	        success: function(data){
	          if (data == 'DONE') {
	          	logActions('Deleted Application Status with ID: '+ id);
	            alert('Successfully deleted '+name);
	            window.location.href = "{{ asset('/employee/dashboard/mf/appstatus') }}";
	          } else if (data == 'ERROR') {
	            $('#DelErrorAlert').show(100);
	          }
	        }, error : function (XMLHttpRequest, textStatus, errorThrown){
	            console.log(errorThrown);
	            $('#DelErrorAlert').show(100);
	        }
	      });
	    }
	    $('#addRgn').on('submit',function(event){
	        event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	        if (form.parsley().isValid()) {
	            var id = $('#new_rgnid').val();
	            var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
	            var test = $.inArray(id,arr);
	            if (test == -1) { // Not in Array
	                $.ajax({
	                  method: 'POST',
	                  data: {
	                    _token : $('#token').val(),
	                    id: $('#new_rgnid').val().toUpperCase(),
	                    name : $('#new_rgn_desc').val(),
	                    mod_id : $('#CurrentPage').val(),
	                    req : $('#new_req').val(),
	                    upd : $('#new_upd').val(),
	                    act: 'add',
	                  },
	                  success: function(data) {
	                    if (data == 'DONE') {
	                    	logActions('Added Application Status with ID: '+ $('#new_rgnid').val().toUpperCase());
	                        alert('Successfully Added New Application Status');
	                        location.reload();
	                    } else if (data == 'ERROR'){
	                      $('#AddErrorAlert').show(100);
	                    }
	                    else if(data == 'SAME')
	                    {
	                    	alert('Application Status ID is already been taken');
			            	$('#new_rgnid').focus();
	                    }
	                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                      console.log(errorThrown);
	                      $('#AddErrorAlert').show(100);
	                  },
	              });
	            } else {
	              alert('Application Status ID is already been taken');
	              $('#new_rgnid').focus();
	            }
	        }
	    }); 
	    $('#EditNow').on('submit',function(event){
	      event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();  
	         if (form.parsley().isValid()) {
	           var x = $('#edit_name').val();
	           var y = $('#edit_desc').val();
	           $.ajax({
	              url: "{{ asset('employee/mf/save_appstatus') }}",
	              method: 'POST',
	              data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
	              success: function(data){
	                  if (data == "DONE") {
	                  	  logActions('Edited Application Status with ID: '+ $('#edit_name').val());
	                      alert('Successfully Edited Application Status');
	                      window.location.href = "{{ asset('/employee/dashboard/mf/appstatus') }}";
	                  } else if (data == 'ERROR') {
	                      $('#EditErrorAlert').show(100);
	                  }
	              }, error : function (XMLHttpRequest, textStatus, errorThrown){
	                  console.log(errorThrown);
	                  $('#EditErrorAlert').show(100);
	              }
	           });
	         }
	    });
	</script> 
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif