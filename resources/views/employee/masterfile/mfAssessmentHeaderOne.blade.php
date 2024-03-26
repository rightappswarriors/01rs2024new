@if (session()->exists('employee_login'))	
	@extends('mainEmployee')
	@section('title', 'Assessment Header One Master File')
	@section('content')
	<input type="text" id="CurrentPage" hidden value="header">
	<div class="content p-4">
		<script type="text/javascript">
		</script>
		<datalist id="rgn_list">
			@if (isset($allData))
				@foreach ($allData as $hfstype)
					<option value="{{$hfstype->title_code}}">{{$hfstype->title_name}}</option>
				@endforeach
			@endif
		</datalist>
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
			Assessment Header One <span class="header_add"><a href="#" title="Add New Assessment Header One" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

			</div>
			<div class="card-body">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th class="text-center">Header One Description</th>
							<th class="text-center">Part Name</th>
							<th class="text-center">Application Type</th>
							<th class="text-center">Option</th>
						</tr>
					</thead>
					<tbody>
					
						@if (!empty($allData))
							@foreach($allData as $titleData)
								<tr class="text-center">
									<td scope="row">
										{{$titleData->h1name}}
									</td>
									<td>
										{{$titleData->title_name}}
									</td>
									<td>
										{{$titleData->hfser_desc}}
									</td>
									<td>
										<button type="button" class="btn btn-outline-warning" onclick="showData('{{$titleData->asmtH1ID}}', '{{$titleData->h1name}}', '{{$titleData->title_code}}','{{$titleData->hfser_id}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
										<button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$titleData->asmtH1ID}}', '{{$titleData->h1name}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
										<button type="button" class="btn btn-outline-success" onclick="showData('{{$titleData->asmtH1ID}}', '{{$titleData->h1name}}', '{{$titleData->title_code}}','{{$titleData->hfser_id}}',true);" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-copy"></i></button>
									</td>
								</tr>
							@endforeach
						@endisset
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
					<h5 class="modal-title text-center"><strong>Add New Assessment Header One</strong></h5>
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
							<div class="col-sm-4">Header One Description:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgnid" data-parsley-required-message="*<strong>Header One Code</strong> required"  class="form-control"  required>
							</div>
							<div class="col-sm-4">Part Name:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="newserv" id="newserv" class="form-control" required="">
									<option value disabled readonly hidden="" selected="" value="">Please Select</option>
									@foreach($part as $se)
									<option value="{{$se->title_code}}">{{$se->title_name}} ({{$se->title_code}})</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-4">Application Type:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="apptype" id="apptype" class="form-control" required="">
									<option value disabled readonly hidden="" selected="" value="">Please Select</option>
									@foreach($apptype as $apty)
									<option value="{{$apty->hfser_id}}">{{$apty->hfser_desc}}</option>
									@endforeach
								</select>
							</div>
							{{-- <div class="col-sm-4">User Interface: <p class="text-danger">WARNING:INCORRECT FILENAME/UNEXISTING FILE MAY RESULT TO ERROR. PLEASE BE GUIDED ACCORDINGLY</p> </div> --}}
							{{-- <div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_view_title" class="form-control" data-parsley-required-message="*<strong>User Interface</strong> required" required>
							</div> --}}
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
					<h5 class="modal-title text-center"><strong id="modHeader">Edit Assessment Header One</strong></h5>
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
					<h5 class="modal-title text-center"><strong>Delete Asessment Header One</strong></h5>
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
				$('#example').DataTable(); 
		});


		function showData(id,desc,serv,apptype,copy = false){
		  let toCopy;
		  if(!copy){
		  	  $("#modHeader").empty().html('Edit Assessment Header One');
			  toCopy = '<div class="col-sm-4" hidden>Header One Code:</div>' +
		          '<div class="col-sm-12" style="margin:0 0 .8em 0;" hidden>' +
		            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
		            '<input type="hidden" name="action" value="edit">' +
		          '</div>' +
		          '<div class="col-sm-4">Header One Description:</div>' +
		          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
		            '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
		          '</div>'+
		          // '<div class="col-sm-4">User Interface:</div>' +
		          // '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
		          //   '<input type="text" id="edit_ui" value="'+UI+'" data-parsley-required-message="<strong>*</strong>User Interface <strong>Required</strong>" placeholder="'+UI+'" class="form-control" required>' +
		          // '</div>'+
		          '<div class="col-sm-4">Part:</div>' +
		          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
		            '<select name="newserv" id="newserv_edit" class="form-control" required>'+
						'<option value disabled readonly hidden="" selected="" value="">Please Select</option>'+
						@foreach($part as $se)
						'<option value="{{$se->title_code}}">{{$se->title_name}} ({{$se->title_code}})</option>'+
						@endforeach
					'</select>'+
		          '</div>'+
		          '<div class="col-sm-4">Application Type:</div>' +
		          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
		            '<select name="apptype" id="apptype_edit" class="form-control" required>'+
						'<option value disabled readonly hidden="" selected="" value="">Please Select</option>'+
						@foreach($apptype as $apty)
						'<option value="{{$apty->hfser_id}}">{{$apty->hfser_desc}} </option>'+
						@endforeach
					'</select>'+
		          '</div>'
	      } else {
	      	$("#modHeader").empty().html('Copy Assessment');
	      	toCopy = '<div class="col-sm-4" hidden>Header One Code:</div>' +
		          '<div class="col-sm-12" style="margin:0 0 .8em 0;" hidden>' +
		            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
		            '<input type="hidden" name="action" value="copy" class="form-control disabled">' +
		          '</div>' +
		          '<div class="col-sm-4">Header One Description:</div>' +
		          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
		            '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
		          '</div>'+
		          // '<div class="col-sm-4">User Interface:</div>' +
		          // '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
		          //   '<input type="text" id="edit_ui" value="'+UI+'" data-parsley-required-message="<strong>*</strong>User Interface <strong>Required</strong>" placeholder="'+UI+'" class="form-control" required>' +
		          // '</div>'+
		          '<div class="col-sm-4">Part:</div>' +
		          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
		            '<select name="newserv" id="newserv_edit" class="form-control" required>'+
						'<option value disabled readonly hidden="" selected="" value="">Please Select</option>'+
						@foreach($part as $se)
						'<option value="{{$se->title_code}}">{{$se->title_name}} ({{$se->title_code}})</option>'+
						@endforeach
					'</select>'+
		          '</div>'+
		          '<div class="col-sm-4">Application Type:</div>' +
		          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
		            '<select name="apptype" id="apptype_edit" class="form-control" required>'+
						'<option value disabled readonly hidden="" selected="" value="">Please Select</option>'+
						@foreach($apptype as $apty)
						'<option value="{{$apty->hfser_id}}">{{$apty->hfser_desc}}</option>'+
						@endforeach
					'</select>'+
		          '</div>'
	      }
	      $('#EditBody').empty();
	      $('#EditBody').append(
	          toCopy
	        );
	      $("#newserv_edit").val(serv);
	      $("#apptype_edit").val(apptype);
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
	                    id: $('#new_rgnid').val(),
	                    name : $('#new_rgn_title').val(),
	                    serv :  $('#newserv').val(),
	                    // view : $('#new_view_title').val(),
	                    mod_id : $('#CurrentPage').val(),
	                    seq : $('#new_rgn_seq').val(),
	                    apptype : $("#apptype").val(),
	                    action: 'add'
	                  },
	                  success: function(data) {
	                    if (data == 'DONE') {
	                        alert('Successfully Added New Assessment Header One');
	                        location.reload();
	                    } else if(data == 'ERROR'){
	                      $('#AddErrorAlert').show(100);
	                    }
	                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                      console.log(errorThrown);
	                      $('#AddErrorAlert').show(100);
	                  }
	              });
	            } else {
	              alert('Assessment Code is already taken');
	              $('#new_rgnid').focus();
	            }
	        }
	    });


		function showDelete (id,desc){
	        $('#DelModSpan').empty();
	        $('#DelModSpan').append(
	            '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
	            '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
	            '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
	            '</div>'
	          );
	    }
	    function deleteNow(){
	      var id = $("#toBeDeletedID").val();
	      var name = $("#toBeDeletedname").val();
	      $.ajax({
	        method: 'POST',
	        data: {_token:$('#token').val(),id:id, mod_id : $('#CurrentPage').val(),action:'delete'},
	        success: function(data){
	          if (data == 'DONE') {
	            alert('Successfully deleted '+name);
	            location.reload();
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

	    $('#EditNow').on('submit',function(event){
	      event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	         if (form.parsley().isValid()) {
	           var y = $('#edit_desc').val();
	           var x = $('#edit_name').val();
	           var a = $('#edit_ui').val();
	           $.ajax({
	              method: 'POST',
	              data : {_token:$('#token').val(),id:x,name:y,filename:a,serv: $("#newserv_edit").val(),apptype: $("#apptype_edit").val(), action: $("input[type=hidden][name=action]").val()},
	              success: function(data){
	                  if (data == "DONE") {
	                      alert(($("input[type=hidden][name=action]").val() == 'edit' ? 'Successfully Edited ' : 'Successfully Copied ')+y);
	                      location.reload();
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


