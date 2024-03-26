@extends('mainEmployee')
@section('title', 'Manage Assessment Master File')
@section('content')
<div hidden="">
	@if (isset($MngAsmt) && isset($Facilitys))
		@foreach ($Facilitys as $owns)
			<datalist id="{{$owns->hgpid}}_list">
				@foreach ($MngAsmt as $classs)
					@if ($owns->hgpid == $classs->facid)
						<option id="AS_{{$classs->asmt_id}}_pro" value="{{$classs->asmt_id}}" theText="{{$classs->asmt_name}}" ></option>
					@endif 
				@endforeach
			</datalist>
		@endforeach
	@endif
</div>
<div class="content p-4">
	<div class="card">
		<div class="card-header bg-white font-weight-bold">
			Manage Assessment <a href="#" title="Add New Assessment" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
			<div style="float:right;display: inline-block;">
				<form class="form-inline">
					<label>Filter : &nbsp;</label>
						<select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()">
							<option value="">Select Facility ...</option>
							@if(isset($Facilitys))
								@foreach ($Facilitys as $owns)
									<option value="{{$owns->hgpid}}">{{$owns->hgpdesc}}</option>
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
						<th style="width: 75%">Name</th>
						<th style="width: 25%"><center>Options</center></th>
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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content" style="border-radius: 0px;border: none;">
			<div class="modal-body" style=" background-color: #272b30;color: white;">
				<h5 class="modal-title text-center"><strong>Add New Assessment in Facility</strong></h5>
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
						<div class="col-sm-4">Facility:</div>
						<div class="col-sm-8" style="margin:0 0 .8em 0;">
							<select id="OCID" data-parsley-required-message="*<strong>Ownership</strong> required" class="form-control" required>  
								
								@if(isset($Facilitys))
										<option value="">Select Facility ...</option>
									@foreach ($Facilitys as $owns)
										<option value="{{$owns->hgpid}}">{{$owns->hgpdesc}}</option>
									@endforeach
								@else
									<option value="">No Facility Registered..</option>
								@endif
							</select>
						</div>
						<div class="col-sm-4">Assessment:</div>
						<div class="col-sm-8"  style="margin:0 0 .8em 0;">
							<input type="text"  id="new_rgnid" list="Facilist" onchange="getSelectedAssessment()" data-parsley-required-message="*<strong>Assessment</strong> required" name="fname" class="form-control" required>
								<datalist id="Facilist">
								@isset ($Asmt)
								    <option value="">Select Assessment ...</option>
								    @foreach ($Asmt as $A)
										<option id="{{$A->asmt_id}}_TEST" value="{{$A->asmt_id}}">{{$A->asmt_name}}</option>
									@endforeach
								@endisset
								</datalist>
						</div>
						<div class="col-sm-4">Description:</div>
						<div class="col-sm-8" style="margin:0 0 .8em 0;">
							<textarea rows="5" id="new_rgn_desc" class="form-control" disabled></textarea>
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
<div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content" style="border-radius: 0px;border: none;">
	    <div class="modal-body" style=" background-color: #272b30;color: white;">
	      <h5 class="modal-title text-center"><strong>Delete Assessment from Facility</strong></h5>
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
         $('#example').DataTable();
    });
    function filterGroup(){
        var id = $('#filterer').val();
        var token = $('#token').val();
        var x = $('#'+id+'_list option').map(function() {return $(this).val();}).get();
        $('#FilterdBody').empty();
        // $('#FilterdBody').append('<option value="">Select Province ...</option>');
        var table = $('#example').DataTable();
        table.clear().draw();
        for (var i = 0; i < x.length; i++) {
        	
            var d = $('#AS_'+x[i]+'_pro').attr('theText');
            var e = $('#AS_'+x[i]+'_pro').attr('value');
            console.log(d);
            var table = $('#example').DataTable();
            $('#example').DataTable()
               .row
               .add([d,
                      '<center>'+
                        // '<span class="MA08_update">'+
                        // '<button type="button" class="btn btn-outline-warning" onclick="showData(\''+e+'\',\''+d+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;'+
                        // '</span>'+
                          '<span class="">' +
                          '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+e+'\', \''+d+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>'+
                        '</span>' +
                          '</center>'
                ])
            .draw();
  
        }
    }
    function getSelectedAssessment()
    {
    	var selectedData = $('#new_rgnid').val();
    	var selectedText = $('#'+selectedData+'_TEST').text();
    	if (selectedText == '') {$('#new_rgn_desc').text('');}
    		else {$('#new_rgn_desc').text(selectedText);}
    	
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
	        url : "{{ asset('employee/mf/manage/del_manageassessment') }}",
	        method: 'POST',
	        data: {_token:$('#token').val(),id:id,mod_id: $('#CurrentPage').val()},
	        success: function(data){
	          if (data == 'DONE') {
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
        	var ocid = $('#OCID').val();
            var id = $('#new_rgnid').val();
            var arr = $('#'+ocid+'_list option[value]').map(function () {return this.value}).get();
            var test = $.inArray(id,arr);
            if (test == -1) { // Not in Array
                $.ajax({
                  method: 'POST',
                  data: {
                    _token : $('#token').val(),
                    asmt_id: $('#new_rgnid').val(),
                    hgpid : $('#OCID').val(),
                    // mod_id: $('#CurrentPage').val()
                  },
                  success: function(data) {
                    if (data == 'DONE') {
                        alert('Successfully added an assessment in the selected facility.');
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
              alert('Assessment is already in the selected facility.');
              $('#new_rgnid').focus();
            }
        }
    });
</script>
@endsection