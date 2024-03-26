@if (session()->exists('employee_login'))	
	@extends('mainEmployee')
	@section('title', 'License Validity Master File')
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
			License Validity <span class="AP001_add"></span>

			</div>
			<div class="card-body">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th style="width:  auto">ID</th>
							<th style="width:  auto">Description</th>
							<th style="width:  auto">License Validity</th>
							<th style="width:  auto"><center>Options</center></th>
						</tr>
					</thead>
					<tbody>
						@if (isset($hfstypes))
							@foreach ($hfstypes as $hfstype)
								<tr>
									<td scope="row"> {{$hfstype->hfser_id}}</td>
									<td>{{$hfstype->hfser_desc}}</td>
									<td>{{isset($hfstype->licenseValidity) ? $hfstype->licenseValidity : "Not Set"}}</td>
									<td>
										<center> 
											@isset($hfstype->licenseValidity)
											<span class="AP001_update">
												<button type="button" class="btn btn-outline-warning" onclick="showData('{{$hfstype->hfser_id}}', '{{$hfstype->hfser_desc}}', '{{$hfstype->seq_num}}', '{{addslashes($hfstype->terms_condi)}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
											</span>
											@else
											<span class="AP001_add">
												<button type="button" class="btn btn-outline-primary" onclick="showDataAdd('{{$hfstype->hfser_id}}', '{{$hfstype->hfser_desc}}', '{{$hfstype->seq_num}}', '{{addslashes($hfstype->terms_condi)}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-plus-circle"></i></button>
											</span>
											@endisset
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
					<h5 class="modal-title text-center"><strong>Add New License Validity</strong></h5>
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
							<div class="col-sm-4">ID:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required"  class="form-control"  required>
							</div>
							<div class="col-sm-4">Description:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
							</div>
							<div class="col-sm-4">Sequence #:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="new_rgn_seq" class="form-control" data-parsley-required-message="*<strong>Sequence</strong> required" required>
									<option value=""></option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
								</select>
							</div>
							<div class="col-sm-12">Terms And Condition: </div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<textarea rows="4" class="form-control summernote" id="AddEditor"></textarea>
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
					<h5 class="modal-title text-center"><strong>Edit License Validity</strong></h5>
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
					<h5 class="modal-title text-center"><strong>Delete License Validity</strong></h5>
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
		 function showData(id,desc, seq, terms){
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
	          '<div class="col-sm-4">Sequence #:('+seq+')</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<select id="edit_seq" class="form-control" data-parsley-required-message="*<strong>Sequence</strong> required">'+
	                '<option value=""></option>' +
	                '<option value="1">1</option>' +
	                '<option value="2">2</option>' +
	                '<option value="3">3</option>' +
	                '<option value="4">4</option>' +
	                '<option value="5">5</option>' +
	            '</select>' + 
	          '</div>' +
	          '<div class="col-sm-4">Terms and Condition</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	          	'<textarea class="form-control summernote" id="EditEditor"></textarea>' +
	          '</div>'
	        );
	      $('#EditEditor').summernote('code',terms);
	    }

	    function showDataAdd(id){
	    	$('#EditBody').empty();
	      	$('#EditBody').append(
	      	  '<div class="col-sm-4">ID:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
	          '</div>' +
	          '<div class="col-sm-4">Date:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="text" id="edit_desc" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" class="form-control" required>' +
	          '</div>'
	      	);
	    }

	    $('#EditNow').on('submit',function(event){
	      event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	         if (form.parsley().isValid()) {
	           var x = $('#edit_name').val();
	           var y = $('#edit_desc').val();
	           var term = $('#EditEditor').summernote('code');
	           $.ajax({
	              url: "{{ asset('employee/mf/save_apptype') }}",
	              method: 'POST',
	              data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val(), seq : $('#edit_seq').val(), terms : term },
	              success: function(data){
	                  if (data == "DONE") {
	                  	  logActions('Edited License Validity with ID: '+x);
	                      alert('Successfully Edited License Validity');
	                      window.location.href = "{{ asset('/employee/dashboard/mf/apptype') }}";
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