@extends('mainEmployee')
@section('title', 'Assessment Column Master File')
@section('content')
 @if (isset($colmn))
   <datalist id="rgn_list">
   @foreach ($colmn as $asment)
     <option id="{{$asment->asmt2c_id}}_pro" value="{{$asment->asmt2c_id}}">{{$asment->asmt2c_id}}</option>
   @endforeach
 </datalist>
 @endif
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Assessment Column <span class="AT006_add"><a href="#" title="Add New Assessment" data-toggle="modal" data-target="#myModal" {{-- onclick="$('#AddEditor').summernote('code','    ');" --}}><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

        </div>
        <div class="card-body table-responsive">

        <table id="example" class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: auto;text-align: center;">ID</th>
                  <th style="width: auto;text-align: center;">Description</th>
                  <th style="width: auto;text-align: center;">Type</th>
                  <th style="width: 10%;">Options</th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
                @isset ($colmn)
                  @foreach ($colmn as $e)
                    <tr>
                      <td style="text-align: center">{{$e->asmt2c_id}}</td>
                      <td>{{$e->asmt2c_desc}}</td>
                      <td style="text-align: center">{{$e->asmt2c_type}}</td>
                      <td><center>
                        <div class="row">
                          <span class="AT006_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$e->asmt2c_id}}', '{{$e->asmt2c_desc}}', '{{$e->asmt2c_type}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
                            </span>
                            <span class="AT006_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$e->asmt2c_id}}', '{{$e->asmt2c_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                          </span>
                        </div>
                      </center></td>
                    </tr>
                  @endforeach
                @endisset
              </tbody>
            </table>
        </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content " style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Add New Assessment Column</strong></h5>
                <hr>
                <div class="container">
                    <form id="addCls" class="row"  data-parsley-validate>
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
               <input type="text" id="la_DesC" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
             </div>
              <div class="col-sm-4">Input Type: </div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <select id="new_subDesc" class="form-control" data-parsley-required-message="*<strong>Input Type</strong> required" required>
                    <option value="">Select Input Type...</option>
                    <option value="Boolean">Boolean</option>
                    <option value="Text">Text</option>
                    <option value="Numeric">Numeric</option>
                    <option value="CheckBox">Check Box</option>
                    <option value="Link">Link</option>
                    <option value="File">File</option>
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
<div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Edit Assessment Column</strong></h5>
          <hr>
          <div class="container">
                <form id="EditNow" data-parsley-validate>
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
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
          <h5 class="modal-title text-center"><strong>Delete Assessment</strong></h5>
          <hr>
          <div class="container">
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DelErrorAlert" role="alert">
                <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                    <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <span id="DelModSpan"></span>
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
	$(document).ready(function(){
    $('#example').DataTable();
    // $('#AddEditor').summernote('code','Select description..<br><br>');
    // $('#AddEditor').summernote('enable');
  });
  let lastSelected;
	function showData(id, loc, desc){
          $('#EditBody').empty();
          $('#EditBody').append(
              '<div class="col-sm-6">ID:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
              '</div>' +   
              '<div class="col-sm-7">Description:</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<input type="text" id="edit_faci" class="form-control" ata-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" value="'+loc+'" required>' +
              '</div>' 
              +          
              '<div class="col-sm-6">Input Type: ('+desc+')</div>' +
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<select type="text" id="edit_desc" data-parsley-required-message="<strong>*</strong>Type <strong>Required</strong>" placeholder="'+desc+'" class="form-control">' +
                  '<option value="'+desc+'">Select Type...</option>' +
                  '<option value="Boolean">Boolean</option>' +
                  '<option value="Text">Text</option>' +
                  '<option value="Numeric">Numeric</option>' +
                '</select>' +
              '</div>' 
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
        url : "{{ asset('employee/mf/assessment/del_asmtcol') }}",
        method: 'POST',
        data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
        success: function(data){
         if (data == 'DONE') {
          alert('Successfully deleted '+name);
          location.reload();
        } else if (data == 'ERROR') {
            $('#DelErrorAlert').show(100);
        }
        }, error : function(){
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
          var test = $.inArray(id,arr);
          if (test == -1) { // Not in Array
              $.ajax({
                method: 'POST',
                data: {
                  _token : $('#token').val(),
                  id: id.toUpperCase(),
                  desc : $('#la_DesC').val(),
                  inputype : $('#new_subDesc').val(),
                  mod_id : $('#CurrentPage').val(),
                },
                success: function(data) {
                  if (data == 'DONE') {
                      alert('Successfully Added New Assessment Column');
                      location.reload();
                  } else if (data == 'ERROR') {
                      $('#AddErrorAlert').show(100);
                  } 
                }, error: function(XMLHttpRequest, textStatus, errorThrown){
                    $('#AddErrorAlert').show(100);
                }
            });
          } else {
            alert('Assessment Column ID is already been taken');
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
             var y = $('#edit_faci').val();
             var z = $('#edit_desc').val();
             $.ajax({
                url: "{{ asset('employee/mf/assessment/save_asmtcol') }}",
                method: 'POST',
                data : {_token:$('#token').val(),id:x,desc:y, inputype :z,mod_id : $('#CurrentPage').val()},
                success: function(data){
                    if (data == "DONE") {
                        alert('Successfully Edited Assessment Column');
                        location.reload();
                    } else if (data == 'ERROR') {
                        $('#EditErrorAlert').show(100);
                    }
                }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    $('#EditErrorAlert').show(100);
                }
             });
           }
      });

</script>
@endsection