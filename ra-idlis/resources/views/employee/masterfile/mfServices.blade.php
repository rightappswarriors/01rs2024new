@if (session()->exists('employee_login'))    	
	@extends('mainEmployee')
	@section('title', 'Services Master File')
	@section('content')
	 <input type="text" id="CurrentPage" hidden="" value="AP016">
		@if (isset($own) && isset($class))
			@foreach ($own as $owns)
				<datalist id="{{$owns->ocid}}_list">
					@foreach ($class as $classs)
						@if ($owns->ocid == $classs->ocid)
							<option id="{{$classs->classid}}_pro" value="{{$classs->classid}}">{{$classs->classname}}</option>
						@endif
					@endforeach
				</datalist>
			@endforeach
		@endif
		<datalist id="rgn_list">
			@if(isset($services))
				@foreach ($services as $classs)
					<option id="{{$classs->facid}}_pro" value="{{$classs->facid}}">{{$classs->facname}}</option>
				@endforeach
			@endif
		</datalist>
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				Services <span class="AP016_add"><a href="#" title="Add New Class" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
				{{-- <div style="float:right;display: inline-block;">
					<form class="form-inline">
						<label>Filter : &nbsp;</label>
							<select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()">
								<option value="">Select Facility ...</option>
								@if(isset($own))
									@foreach ($own as $owns)
										<option value="{{$owns->ocid}}">{{$owns->ocdesc}}</option>
									@endforeach
								@endif
							</select>
					</form>
				</div> --}}
			</div>
			<div class="card-body">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th style="width: auto">ID</th>
							<th style="width: auto">Facility</th>
							<th style="width: auto">Name</th>
							<th style="width: auto">For Specialty?</th>
							<th style="width: auto">Service Type</th>
							<th style="width: auto">Office</th>
							<th style="width: auto">Status</th>
							<th style="width: auto"><center>Options</center></th>
						</tr>
					</thead>
					<tbody id="FilterdBody">
						@isset ($services)
						    @foreach ($services as $s)
						    	<tr>
						    		<td>{{$s->facid}}</td>
						    		<td>{{$s->hgpdesc}}</td>
						    		<td>{{$s->facname}}</td>
						    		<td>{{($s->forSpecialty == 1 ? 'Yes' : 'No')}}</td>
						    		<td>{{$s->anc_name}}</td>
						    		<td>{{($s->assignrgn == 'rgn' ? 'Region' : 'HFSRB')}}</td>
                            		<td>@if($s->status == "1") Active @else Inactive @endif</td>
						    		<td>
						    			<center>
						    				<span class="AP016_update">
						    					<button class="btn btn-outline-warning" onclick="showData('{{$s->facid}}', '{{addslashes($s->facname)}}', '{{addslashes($s->hgpdesc)}}', '{{addslashes($s->anc_name)}}', '{{addslashes($s->assignrgn)}}', '{{$s->status}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
						    				</span>
						    				<span class="AP016_cancel">
						    					<button class="btn btn-outline-danger" onclick="showDelete('{{$s->facid}}', '{{$s->facname}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
						    				</span>
						    			</center>
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
		<div class="modal-dialog  modal-lg" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #C2CAD0; color: black;">
					<h5 class="modal-title text-center"><strong>Add New Service</strong></h5>
					<hr>
					<div class="container">
						<form class="row" id="addCls" data-parsley-validate>
							{{ csrf_field() }}
							<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
								<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
								<button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="col-sm-12">ID:</div>
							<div class="col-sm-12"  style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" name="fname" class="form-control" required>
							</div>
							<div class="col-sm-12">Description:</div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgn_desc" name="fname" data-parsley-required-message="*<strong>Name</strong> required" class="form-control"  required>
							</div>
							<div class="col-sm-12">Facility:</div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<select id="OCID" class="form-control" data-parsley-required-message="*<strong>Facility</strong> required" required>  
									<option value="">Select Facility...</option>
									@if(isset($facility))
										@foreach ($facility as $owns)
											<option value="{{$owns->hgpid}}">{{$owns->hgpdesc}}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="col-sm-12">Service Type:</div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<select id="OCID1" class="form-control" data-parsley-required-message="*<strong>Service Type</strong> required" required>  
									<option value="">Select Facility...</option>
									@if(isset($servtype))
										@foreach ($servtype as $owns)
											<option value="{{$owns->servtype_id}}">{{$owns->anc_name}}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="col-sm-12">Office:</div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<select id="OCID2" class="form-control" data-parsley-required-message="*<strong>Office</strong> required" required>  
									<option value="">Select Office...</option>
									<option value="rgn">Region</option>
									<option value="hfsrb">HFSRB</option>
								</select>
							</div>
							<div class="text-center col-sm-12" style="font-size: 20px;">For Specialty Hospital?<br><small class="text-danger">NOTE: This is for Hospital facility option only</small></div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<div class="d-flex justify-content-center">
									<div class="row">
										<div class="col-md-4">
											<div class="col-md">
												<label class="form-check-label" for="exampleRadios5">
													Yes
													<input type="radio" class="form-control" id="exampleRadios5" name="forSpecialty" value="1">
												</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="col-md">
												<label class="form-check-label" for="exampleRadios6">
													No
													<input type="radio" class="form-control" id="exampleRadios6" name="forSpecialty" value="0" checked>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="text-center col-sm-12" style="font-size: 20px;">Display on Specified Service?</div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<div class="d-flex justify-content-center">
									<div class="row">
										<div class="col-md-4">
											<div class="col-md">
												<label class="form-check-label" for="exampleRadios1">
													Yes
													<input type="radio" class="form-control" id="exampleRadios1" name="isSelectedDisplay" value="1">
												</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="col-md">
												<label class="form-check-label" for="exampleRadios2">
													No
													<input type="radio" class="form-control" id="exampleRadios2" name="isSelectedDisplay" value="0" checked>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="text-center col-sm-12" style="font-size: 20px;">Group on Display?<br><small class="text-danger">NOTE: This is for Hospital Add on option only</small></div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<div class="d-flex justify-content-center">
									<div class="row">
										<div class="col-md-4">
											<div class="col-md">
												<label class="form-check-label" for="exampleRadios13">
													Yes
													<input type="radio" class="form-control" id="exampleRadios13" name="isSelectedDisplayGroup" value="1">
												</label>
											</div>
										</div>
										<div class="col-md-3">
											<div class="col-md">
												<label class="form-check-label" for="exampleRadios23">
													No
													<input type="radio" class="form-control" id="exampleRadios23" name="isSelectedDisplayGroup" value="0" checked>
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="container mt-4 mb-2" id="toHideIfNoDisplay" hidden>
								<input type="hidden" name="subAssessment">
								<div class="row">
									<div class="col-md-12">
										Group Name
										<input type="text" name="grpz" class="form-control" id="exampleRadios33">
									</div>
								</div>
							</div>
							<div class="container mt-4 mb-2" id="toHideIfNo" hidden>
								<input type="hidden" name="subAssessment">
								<div class="container lead">
									<p class="text-center">Please select Application type</p>
									<select name="hfser_id" class="form-control mb-4">
										<option value="">Please Select</option>
										@isset($apptype)
										@foreach($apptype as $type)
										<option value="{{$type->hfser_id}}">{{$type->hfser_id}} - {{$type->hfser_desc}}</option>
										@endforeach
										@endisset
									</select>
								</div>
								<div class="container">
									<table class="table display" id="example2" style="overflow-x: scroll;" >
										<thead>
											<tr>
												<th style="width: auto">ID</th>
												<th style="width: auto">Facility</th>
												<th style="width: auto">Name</th>
												<th style="width: auto">Service Type</th>
												<th style="width: auto">Select</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-sm-12">
								<button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
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
		      <h5 class="modal-title text-center"><strong>Edit Service</strong></h5>
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
		      <h5 class="modal-title text-center"><strong>Delete Service</strong></h5>
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

		$('input[name=forSpecialty]').change(function(event) {
	    	if($(this).val() == 1){
	    		$("#toHideIfNo").removeAttr('hidden');
	    		$('[name=hfser_id]').attr('required',true);
	    	} else {
	    		$('[name=hfser_id]').removeAttr('required');
	    		$("[name=hfser_id]").val('');
	    		$("#toHideIfNo").attr('hidden',true);
	    	}

	    });

		$('input[name=isSelectedDisplay]').change(function(event) {
	    	if($(this).val() == 1){
	    		$("#toHideIfNo").removeAttr('hidden');
	    		$('[name=hfser_id]').attr('required',true);
	    		$.ajax({
	      			method: 'POST',
	      			data: {_token: $('input[name=_token]').val(), action: 'dispalySpecified'},
	      			success: function(data){
	      				data = JSON.parse(data);
	      				$('#example2').DataTable().clear().draw();
	      				if (data.length != 0) {
							for (var i = 0; i < data.length; i++) {
								$('#example2').DataTable().row.add([
									data[i].facid,
									data[i].hgpdesc,
									data[i].facname,
									data[i].anc_name,
									'<div class="text-center">'+
										'<button type="button" class="btn btn-outline-success" onclick="$(\'input[name=subAssessment]\').val(\''+data[i].facid+'\')"><i class="fa fa-check" aria-hidden="true"></i></button>'+
									'</div>'
								]).draw();
							}
						}
	      			}
	      		})
	    	} else {
	    		$('[name=hfser_id]').removeAttr('required');
	    		$("input[name=subAssessment]").val('');
	    		$("[name=hfser_id]").val('');
	    		$("#toHideIfNo").attr('hidden',true);
	    	}

	    });

	    $('input[name=isSelectedDisplayGroup]').change(function(event) {
	    	if($(this).val() == 1){
	    		$("#toHideIfNoDisplay").removeAttr('hidden');
	    	} else {
	    		$("input[name=grpz]").val('');
	    		$("#toHideIfNoDisplay").attr('hidden',true);
	    	}
	    });

		$(document).ready(function() {
	         $('#example').DataTable({
	              // dom: 'Bfrtip',
	              // buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
	          });
	      } );
		function showData(id,desc, facid, servtype, office, status){
	      $('#EditBody').empty();
	      $('#EditBody').append(
	          '<div class="col-sm-4">ID:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
	          '</div>' +
	          '<div class="col-sm-4">Description:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Zip Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
	          '</div>' +
	          '<div class="col-sm-12">Facility: ('+facid+') </div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            	'<select class="form-control" id="edit_faci" data-parsley-required-message="<strong>*</strong>Facility <strong>Required</strong> required>' +
	            		'<option value=""></option>' +
	            	@if(isset($facility))
						@foreach ($facility as $owns)
							'<option value="{{$owns->hgpid}}">{{$owns->hgpdesc}}</option>' +
						@endforeach
					@endif
	            	'</select>' +
	          '</div>' +
	          '<div class="col-sm-12">Service Type: ('+servtype+') </div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            	'<select class="form-control" id="edit_faci" data-parsley-required-message="<strong>*</strong>Service Type <strong>Required</strong> required>' +
	            		'<option value=""></option>' +
	            	@if(isset($servtype))
						@foreach ($servtype as $owns)
							'<option value="{{$owns->servtype_id}}">{{$owns->anc_name}}</option>' +
						@endforeach
					@endif
	            	'</select>' +
	          '</div>',
	          '<div class="col-sm-12">Office: </div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            	'<select id="edit_office" class="form-control" data-parsley-required-message="<strong>*</strong>Office <strong>Required</strong> required>' +
	            		'<option value="">Please Select</option>' +
	            		'<option value="rgn">Region</option>' +
	            		'<option value="hfsrb">HFSRB</option>' +
	            	'</select>' +
	          '</div>' +
	          '<div class="col-sm-4">Status:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="number" id="edit_status" value="'+status+'" data-parsley-required-message="<strong>*</strong>Status <strong>Required</strong>" placeholder="'+status+'" class="form-control" required>' +
	          '</div>'
	        );
	      	$('#edit_office').val(office);
	    }
	    function showDelete (id, desc){
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
		        url : "{{ asset('employee/mf/del_service') }}",
		        method: 'POST',
		        data: {_token:$('#token').val(),id:id,mod_id: $('#CurrentPage').val()},
		        success: function(data){
		          if (data == 'DONE') {
		          	logActions('Deleted Services with ID: '+id);
		            alert('Successfully deleted '+name);
		            location.reload();
		          } else {
		            $('#DelErrorAlert').show(100);
		          }
		        }, error : function(XMLHttpRequest, textStatus, errorThrown){
		            console.log(errorThrown);
		            $('#DelErrorAlert').show(100);
		        }
		      });
	    }
	    $('#addCls').on('submit',function(event){
	        event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	        if (form.parsley().isValid()) {
	            var id = $('#new_rgnid').val();

	            var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
	            var test = $.inArray(id.toUpperCase(),arr);
	            if (test == -1) { // Not in Array
	                $.ajax({
	                  method: 'POST',
	                  data: {
	                    _token : $('#token').val(),
	                    id: $('#new_rgnid').val(),
	                    name : $('#new_rgn_desc').val(),
	                    specified : $("input[name=subAssessment]").val(),
	                    ocid : $('#OCID').val(),
	                    ocid1 : $("#OCID1").val(),
	                    ocid2 : $("#OCID2").val(),
	                    mod_id: $('#CurrentPage').val(),
	                    forSpecialty: $("[name=forSpecialty]:checked").val(),
	                    grpz: $("[name=grpz]").val(),
	                    hfser_id: $("[name=hfser_id]").val()
	                  },
	                  success: function(data) {
	                    if (data == 'DONE') {
	                    	logActions('Added new Services with ID: '+ $('#new_rgnid').val());
	                        alert('Successfully Added New Service');
	                        location.reload();
	                    } else {
	                      $('#AddErrorAlert').show(100);
	                    }
	                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                      console.log(errorThrown);
	                      $('#AddErrorAlert').show(100);
	                  }
	              });
	            } else {
	              alert('Service ID is already been taken');
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
	           	var z = $('#edit_office').val();

	           	$.ajax({
	             	url: "{{ asset('employee/mf/save_service') }}",
	              	method: 'POST',
	             	data : {_token:$('#token').val(), id:x, name:y, office: z, faci : $('#edit_faci').val(), status: $('#edit_status').val(), mod_id: $('#CurrentPage').val()},
	              	success: function(data){
	                  	if (data != "ERROR") {
	                  		logActions('Edited Services with ID: '+$('#edit_name').val());
	                      	alert('Successfully Edited Service');
	                      	location.reload();
	                  	} else if (data == 'ERROR'){
	                      	$('#EditErrorAlert').show(100);
	                  	}
	              	}, error : function(XMLHttpRequest, textStatus, errorThrown){
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