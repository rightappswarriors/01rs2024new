@extends('mainEmployee')
@section('title', 'Part (Assessment) Master File')
@section('content')
<div class="content p-4">
    <datalist id="rgn_list">
      @if (isset($parts ))
        @foreach ($parts as $part)
          <option value="{{$part->partid}}">{{$part->partdesc}}</option>
        @endforeach
      @endif
    </datalist>
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Part (Assessment) <span class="AT001_add"><a href="#" title="Add New Part" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

        </div>
        <div class="card-body">
               <table id="example" class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: 5%">ID</th>
                  <th style="width: 65%">Description</th>
                  {{-- <th style="width: 5%;text-align: center">Part #</th> --}}
                  <th style="width: 25%"><center>Options</center></th>
                </tr>
              </thead>
              <tbody>
                @if (isset($parts))
                  @foreach ($parts as $part)
                  <tr>
                    <td scope="row"> {{$part->partid}}</td>
                    <td>{{$part->partdesc}}</td>
                    {{-- <td class="text-center">{{$part->partno}}</td> --}}
                    <td>
                      <center>
                        <span class="AT001_update">
                          <button type="button" class="btn btn-outline-warning" onclick="showData('{{$part->partid}}', '{{$part->partdesc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                        </span>
                        <span class="AT001_cancel">
                          <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$part->partid}}', '{{$part->partdesc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                        </span>
                      </center>
                    </td>
                  </tr>
                @endforeach
                @endif
              </tbody>
            </table>
            @if ($parts == [] || $parts == null || !isset($parts))
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong><i class="fas fa-exclamation"></i></strong> No <strong>Parts</strong> are currently registered!
            </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body" style=" background-color: #272b30;
    color: white;">
        <h5 class="modal-title text-center"><strong>Add New Part (Assessment) </strong></h5>
        <hr>
        <div class="container">
          <form id="addRgn" class="row"  data-parsley-validate>
            {{ csrf_field() }}
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
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
            <div class="col-sm-12">
              <button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content" style="border-radius: 0px;border: none;">
	    <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
	      <h5 class="modal-title text-center"><strong>Edit Part (Assessment)</strong></h5>
	      <hr>
	      <div class="container">
	            <form id="EditNow" data-parsley-validate>
	              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
	            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
	                <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
	                    <span aria-hidden="true">&times;</span>
	                </button>
	            </div>
	            <span id="EditBody"></span>
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
          <h5 class="modal-title text-center"><strong>Delete Part (Assessment)</strong></h5>
          <hr>
          <div class="container">
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DelErrorAlert" role="alert">
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
	$(document).ready(function(){ $('#example').DataTable();});
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
          '</div>' 
        );
    }
    function showDelete (id,desc){
        $('#DelModSpan').empty();
        $('#DelModSpan').append(
            '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
            '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
            '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
            '</div>'
          );
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
                        name : $('#new_rgn_desc').val(),
                        id: $('#new_rgnid').val(),
                        mod_id : $('#CurrentPage').val(),
                      },
                      success: function(data) {
                        if (data == 'DONE') {
                            alert('Successfully Added New Part (Assessment)');
                            window.location.href = "{{asset('employee/dashboard/mf/part')}}";
                        } else if (data == 'ERROR') {
                          $('#AddErrorAlert').show(100);
                        }
                      }, error : function(XMLHttpRequest, textStatus, errorThrown){
                        conole.log(errorThrown);
                        $('#AddErrorAlert').show(100);
                      }
                  });
                } else {
                  alert('Part ID is already been taken');
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
              url: "{{ asset('employee/mf/assessment/save_part') }}",
              method: 'POST',
              data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
              success: function(data){
                  if (data == "DONE") {
                      alert('Successfully Edited Part (Assessment)');
                      window.location.href = "{{ asset('/employee/dashboard/mf/part') }}";
                  } else if (data == 'ERROR') {
                    $('#EditErrorAlert').show(100);
                  }
              }, error: function(data) {
                  $('#EditErrorAlert').show(100);
              }
           });
         }
    });
    function deleteNow(){
      var id = $("#toBeDeletedID").val();
      var name = $("#toBeDeletedname").val();
      $.ajax({
        url : "{{ asset('employee/mf/assessment/del_part') }}",
        method: 'POST',
        data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
        success: function(data){
          if (data == 'DONE') {
            alert('Successfully deleted '+name);
            window.location.href = "{{ asset('/employee/dashboard/mf/part') }}";
          } else if (data == 'ERROR') {
              $('#DelErrorAlert').show(100);
          }
        }, error : function(){
          $('#DelErrorAlert').show(100);
        }
      });
    }
</script>
@endsection