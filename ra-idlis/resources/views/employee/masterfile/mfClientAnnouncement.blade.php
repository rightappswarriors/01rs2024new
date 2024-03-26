@if (session()->exists('employee_login'))	
	@extends('mainEmployee')
	@section('title', 'Client Announcement Master File')
	@section('content')
	<input type="text" id="CurrentPage" hidden="" value="AP001">
	<div class="content p-4">
		<script type="text/javascript">
		</script>
		<datalist id="rgn_list">
			@if (isset($hfstypes))
				@foreach ($hfstypes as $hfstype)
					<option value="{{$hfstype->hfser_id}}">{{$hfstype->hfser_desc}}</option>
				@endforeach
			@endif
		</datalist>
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
			Client Announcement <span class="AP001_add"><a href="#" title="Add New Client Announcement" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

			</div>
			<div class="card-body">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th style="width:  auto">ID</th>
							<th style="width:  auto">Effective Date</th>
							<th style="width:  auto">End Date</th>
							<th style="width:  auto">Message</th>
							<th style="width:  auto"><center>Options</center></th>
						</tr>
					</thead>
					<tbody>
						@if (isset($hfstypes))
							@foreach ($hfstypes as $hfstype)
								<tr>
									<td scope="row"> {{$hfstype->hfser_id}}</td>
									<td>{{$hfstype->hfser_desc}}</td>
									<td>{{$hfstype->hfser_id}}</td>
									<td>{{addslashes($hfstype->terms_condi)}}</td>
									<td>
										<center> 
											<span class="AP001_update">
												<button type="button" class="btn btn-outline-warning" onclick="showData('{{$hfstype->hfser_id}}', '{{$hfstype->hfser_desc}}', '{{$hfstype->seq_num}}', '{{addslashes($hfstype->terms_condi)}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
											</span>
											<span class="AP001_cancel">
												<button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$hfstype->hfser_id}}', '{{$hfstype->hfser_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body text-justify" style=" background-color: #272b30;
				color: white;">
					<h5 class="modal-title text-center"><strong>Add New Client Announcement</strong></h5>
					<hr>
					<div class="container">
						<form id="addRgn" class="row"  data-parsley-validate>
							{{ csrf_field() }}
							<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
								<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
								<button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="col-sm-4">Effective Date:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="date" id="new_date_effective" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
							</div>
							<div class="col-sm-4">End Date:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="date" id="new_date_end" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
							</div>
							<div class="col-sm-12">Message: </div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<textarea rows="4" class="form-control summernote" id="AddMessage"></textarea>
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
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #272b30;color: white;">
					<h5 class="modal-title text-center"><strong>Edit Client Announcement</strong></h5>
					<hr>
					<div>
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
	<div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #272b30;color: white;">
					<h5 class="modal-title text-center"><strong>Delete Client Announcement</strong></h5>
					<hr>
						<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
							<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
							<button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<div class="container">
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
				$('.note-popover').attr('display','none');
				$('#example').DataTable(); 
				$('#AddEditor').summernote('code','');
				
		});
		// $('#myModal').on('shown.bs.modal', function() {
		// 	  $('#AddEditor').summernote({
		// 	  		placeholder: '',
					
		// 		});
		// 	}); 
		 // C
		 function showData(id,effdate, enddate, message){
	      $('#EditBody').empty();
	      $('#EditBody').append(
	          '<div class="col-sm-4">ID:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
	          '</div>' +
	          '<div class="col-sm-4">Effective Date:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="date" id="edit_date_effective" value="'+effdate+'" data-parsley-required-message="<strong>*</strong>Effective Date <strong>Required</strong>" placeholder="'+effdate+'" class="form-control" required>' +
	          '</div>' +
			  '<div class="col-sm-4">End Date:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="date" id="edit_date_end" value="'+enddate+'" data-parsley-required-message="<strong>*</strong>End Date <strong>Required</strong>" placeholder="'+enddate+'" class="form-control" required>' +
	          '</div>' +
	          '<div class="col-sm-4">Message</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	          	'<textarea class="form-control summernote" id="EditMessage"></textarea>' +
	          '</div>'
	        );
	      $('#EditMessage').summernote('code',message);
	    }
	    function showDelete (id){
	        $('#DelModSpan').empty();
	        $('#DelModSpan').append(
	            '<div class="col-sm-12"> Are you sure you want to delete ID Number <span style="color:red"><strong>' + id + '</strong></span>?' +
	            '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
	            '</div>'
	          );
	    }
	    function deleteNow(){
	      var id = $("#toBeDeletedID").val();
	      var name = $("#toBeDeletedname").val();
	      $.ajax({
	        url : "{{ asset('employee/mf/delClientAnnouncement') }}",
	        method: 'POST',
	        data: {_token:$('#token').val(),id:id, mod_id : $('#CurrentPage').val()},
	        success: function(data){
	          if (data == 'DONE') {
	          	logActions('Deleted Client Announcement with ID: '+id);
	            alert('Successfully deleted '+name);
	            window.location.href = "{{ asset('/employee/dashboard/mf/clientannouncement') }}";
	          }
	          else if (data == 'ERROR'){
	              $('#DelErrorAlert').show(100);
	          }
	        }, error : function(XMLHttpRequest, textStatus, errorThrown){
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
	            var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
	            var test = $.inArray(id,arr);
	            var AddMessage = $('#AddMessage').summernote('code');
	            if (test == -1) { // Not in Array
	                $.ajax({
	                  url: "{{ asset('/employee/dashboard/mf/clientannouncement') }}",
	                  method: 'POST',
	                  data: {
	                    _token : $('#token').val(),
	                    mod_id : $('#CurrentPage').val(),
	                    date_effective : $('#new_date_effective').val(),
	                    date_end : $('#new_date_end').val(),
	                    message : AddMessage,
	                  },
	                  success: function(data) {
	                    if (data == 'DONE') {
	                    	logActions('Successfuly added new Client Announcement.');
	                        alert('Successfully Added New Client Announcement');
	                        window.location.href = "{{ asset('/employee/dashboard/mf/clientannouncement') }}";
	                    } else if(data == 'ERROR'){
	                      $('#AddErrorAlert').show(100);
	                    }
	                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                      console.log(errorThrown);
	                      $('#AddErrorAlert').show(100);
	                  }
	              });
	            } else {
	              alert('Client Announcement ID is already been taken');
	              $('#new_rgnid').focus();
	            }
	        }
	    });
	    $('#EditNow').on('submit',function(event){
	      event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	         if (form.parsley().isValid()) {
	           var x = $('#edit_date_effective').val();
	           var y = $('#edit_date_end').val();
	           var EditMessage = $('#EditMessage').summernote('code');
	           $.ajax({
	              url: "{{ asset('employee/mf/saveClientAnnouncement') }}",
	              method: 'POST',
	              data : {_token:$('#token').val(), mod_id : $('#CurrentPage').val(), date_effective : $('#edit_date_effective').val(), date_end : $('#edit_date_end').val(), message : EditMessage },
	              success: function(data){
	                  if (data == "DONE") {
	                  	  logActions('Edited Client Announcement with ID: '+x);
	                      alert('Successfully Edited Client Announcement');
	                      window.location.href = "{{ asset('/employee/dashboard/mf/clientannouncement') }}";
	                  } else if (data == "ERROR") {
	                      $('#EditErrorAlert').show(100);
	                  }
	              }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                  console.log(errorThrown);
	                  $('#EditErrorAlert').show(100);
	              },
	           });
	         }
	    });
	</script>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif