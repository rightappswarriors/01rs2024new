@if (session()->exists('employee_login'))
	@extends('mainEmployee')
	@section('title', 'Class Master File')
	@section('content')
	<input type="text" id="CurrentPage" hidden="" value="AP003">
		@if (isset($own) && isset($class))
			@foreach ($own as $owns)
				<datalist id="{{$owns->ocid}}_list">
					@foreach ($class as $classs)
						@if ($owns->ocid == $classs->ocid)
							<option id="{{$classs->classid}}_pro" isRemarks="{{$classs->isSub}}" sub="{{$classs->SubName}}" value="{{$classs->classid}}">{{$classs->classname}}</option>
						@endif
					@endforeach
				</datalist>
			@endforeach
		@endif
		<datalist id="rgn_list">
			@if(isset($class))
				@foreach ($class as $classs)
					<option id="{{$classs->classid}}_pro"  value="{{$classs->classid}}">{{$classs->classname}}</option>
				@endforeach
			@endif
		</datalist>
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				Class <span class="AP003_add"><a href="#" title="Add New Class" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
				<div style="float:right;display: inline-block;">
					<form class="form-inline">
						<label>Filter : &nbsp;</label>
							<select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()">
								<option value="">Select Ownership ...</option>
								@if(isset($own))
									@foreach ($own as $owns)
										<option value="{{$owns->ocid}}">{{$owns->ocdesc}}</option>
									@endforeach
								@endif
							</select>
					</form>
				</div>
			</div>
			<div class="card-body">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th style="width: auto">ID</th>
							<th style="width: auto">Name</th>
							<th style="width: auto">Sub Class</th>
							<th style="width: auto"><center>Options</center></th>
						</tr>
					</thead>
					<tbody id="FilterdBody">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{{-- Add --}}
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #272b30;color: white;">
					<h5 class="modal-title text-center"><strong>Add New Class</strong></h5>
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
							<div class="col-sm-4">Ownership:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="OCID" data-parsley-required-message="*<strong>Ownership</strong> required" class="form-control" required>  
									<option value="">Select Ownership ...</option>
									@if(isset($own))
										@foreach ($own as $owns)
											<option value="{{$owns->ocid}}">{{$owns->ocdesc}}</option>
										@endforeach
									@endif
								</select>
							</div>
							<div class="col-sm-4">ID:</div>
							<div class="col-sm-8"  style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" name="fname" class="form-control" required>
							</div>
							<div class="col-sm-4">Description:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgn_desc" name="fname" data-parsley-required-message="*<strong>Name</strong> required" class="form-control"  required>
							</div>
							<div class="col-sm-4">Subclass:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<center>
									<input class="form-control" type="checkbox" value="" id="defaultCheck1" onclick="isSubTest()">
								</center> 
							</div>
							<div class="col-sm-4">&nbsp;</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;display:none" id="sub_div">
								<select type="text" class="form-control" data-parsley-required-message="*<strong>Class</strong> required" id="sub" list="rgn_list">
									@if(isset($class))
										<option value="">Select Class..</option>
										@foreach ($class as $classs)
											@if($classs->classid != 'O' && $classs->isSub == null)
												<option value="{{$classs->classid}}">{{$classs->classname}}</option>
											@endif
										@endforeach
									@else 
										<option value="">No Class currently registered.</option>
									@endif
								</select>
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
		      <h5 class="modal-title text-center"><strong>Edit Class</strong></h5>
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
		      <h5 class="modal-title text-center"><strong>Delete Class</strong></h5>
		      <hr>
		      <div class="container table">
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
	         /////////////////////////////////
	      } );
		function showData(id,desc, hasRemarks, isRemarks){
	      $('#EditBody').empty();
	      $('#EditBody').append(
	          '<div class="col-sm-4">ID:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
	          '</div>' +
	          '<div class="col-sm-4">Description:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Zip Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
	          '</div>'  +
	          '<div class="col-sm-12">Subclass:</div>' +
				'<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
					'<center>' +
						'<input class="form-control" type="checkbox" value="" id="defaultCheck2" onclick="isSubTest2()">' +
					'</center> ' +
				'</div>' +
				'<div class="col-sm-12" style="margin:0 0 .8em 0;display:none" id="sub_div2">' +
					'<select type="text" onclick="removeSelect()" class="form-control" data-parsley-required-message="*<strong>Class</strong> required" id="sub2" list="rgn_list">'+
					@if(isset($class))
						'<option value="'+isRemarks+'">Select Class..</option>' +
						@foreach ($class as $classs)
							@if($classs->classid != 'O' && $classs->isSub == null)
								'<option value="{{$classs->classid}}">{{$classs->classname}}</option>' +
							@endif
						@endforeach
					@else 
						'<option value="">No Class currently registered.</option>' +
					@endif
					'</select>' +
				'</div>'
	        );
	      if (hasRemarks == 1) {  
	      		$('#defaultCheck2').attr('checked', ''); 
	      		$("select option[value='"+isRemarks+"']").attr("selected","selected");
	      		$('#sub2').attr('required', '');
	      		$("#sub2 option:first").val(isRemarks);
	  		} else {
	  			$("select option[value='']").attr("selected","selected");
	  			$('#sub2').removeAttr('required');
	  			$("#sub2 option:first").val('');
	  		}
	      isSubTest2();
	    }
	    function removeSelect()
	    {
	    	$('#sub2 option').removeAttr('selected');
	    }
	    function filterGroup(){
	        var id = $('#filterer').val();
	        var token = $('#token').val();
	        var x = $('#'+id+'_list option').map(function() {return $(this).val();}).get();
	        $('#FilterdBody').empty();
	        // $('#FilterdBody').append('<option value="">Select Province ...</option>');
	        var table = $('#example').DataTable();
	        table.clear().draw();
	        for (var i = 0; i < x.length; i++) {
	            var d = $('#'+x[i]+'_pro').text();
	            var e = $('#'+x[i]+'_pro').attr('value');
	            var table = $('#example').DataTable();
	            var isRemarks = $('#'+x[i]+'_pro').attr('isRemarks');
	            var sub = $('#'+x[i]+'_pro').attr('sub');
	            var tobeDisplayed = (isRemarks != '') ? 'Yes - ' + sub: 'No';
	            var hasRemarks = (isRemarks != '') ? 1: 0;
	            $('#example').DataTable()
	               .row
	               .add([e,d, tobeDisplayed,
	                      '<center>'+
	                        '<span class="AP003_update">'+
	                        '<button type="button" class="btn btn-outline-warning" onclick="showData(\''+e+'\',\''+d+'\', '+hasRemarks+', \''+isRemarks+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;'+
	                        '</span>'+
	                          '<span class="AP003_cancel">' +
	                          '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+e+'\', \''+d+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>'+
	                        '</span>' +
	                          '</center>'
	                ])
	            .draw();
	  
	        }
	        GroupRightsActivate();
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
		        url : "{{ asset('employee/mf/del_class') }}",
		        method: 'POST',
		        data: {_token:$('#token').val(),id:id,mod_id: $('#CurrentPage').val()},
		        success: function(data){
		          if (data == 'DONE') {
		          	logActions('Deleted Class with ID: '+id);
		            alert('Successfully deleted '+name);
		            window.location.href = "{{ asset('/employee/dashboard/mf/class') }}";
		          } else {
		            $('#DelErrorAlert').show(100);
		          }
		        }, error : function(XMLHttpRequest, textStatus, errorThrown){
		            console.log(errorThrown);
		            $('#DelErrorAlert').show(100);
		        }
		      });
	    }
	    function isSubTest(){
	    	if ($('#defaultCheck1').is(':checked')) {
					// sub_div, sub
				$('#sub_div').show();
				$('#sub').attr('required', '');
	    	}else {
	    		$('#sub_div').hide();
	    		$('#sub').removeAttr('required');
	    	}
	    }
	    function isSubTest2(){
	    	if ($('#defaultCheck2').is(':checked')) {
					// sub_div, sub
				$('#sub_div2').show();
				$('#sub2').attr('required', '');
	    	}else {
	    		$('#sub_div2').hide();
	    		$('#sub2').removeAttr('required');
	    	}
	    }
	    $('#addCls').on('submit',function(event){
	        event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	        if (form.parsley().isValid()) {
	            var id = $('#new_rgnid').val();
	            var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
	            var test = $.inArray(id,arr);
	            var y = $('#defaultCheck1').is(':checked') ? 1 : 0;
	            if (test == -1) { // Not in Array
	                $.ajax({
	                  method: 'POST',
	                  data: {
	                    _token : $('#token').val(),
	                    id: $('#new_rgnid').val(),
	                    name : $('#new_rgn_desc').val(),
	                    ocid : $('#OCID').val(),
	                    isRemarks : y,
	                    cls : $('#sub').val(),
	                    mod_id: $('#CurrentPage').val()
	                  },
	                  success: function(data) {
	                    if (data == 'DONE') {
	                    	logActions('Added Class with ID: '+$('#new_rgnid').val());
	                        alert('Successfully Added New Class');
	                        window.location.href = "{{ asset('employee/dashboard/mf/class') }}";
	                    } else if (data == 'ERROR') {
	                      $('#AddErrorAlert').show(100);
	                    }
	                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                      console.log(errorThrown);
	                      $('#AddErrorAlert').show(100);
	                  }
	              });
	            } else {
	              alert('Class ID is already been taken');
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
	           	var z = $('#defaultCheck2').is(':checked') ? 1 : 0;
	           	$.ajax({
	             	url: "{{ asset('employee/mf/save_class') }}",
	              	method: 'POST',
	             	data : {
	             		_token:$('#token').val(),
	             		id:x,
	             		name:y,
	             		isRemarks : z,
	                    cls : $('#sub2').val(),
	             		mod_id: $('#CurrentPage').val()},
	              	success: function(data){
	                  	if (data == "DONE") {
	                  		logActions('Edited Class with ID: '+ $('#edit_name').val());
	                      	alert('Successfully Edited Class');
	                      	window.location.href = "{{ asset('/employee/dashboard/mf/class') }}";
	                  	} else {
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