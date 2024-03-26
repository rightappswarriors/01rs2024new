@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'UACS')
  @section('content')
   <input type="text" id="CurrentPage" hidden="" value="PY007">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($Chgs))
          @foreach ($Chgs as $apptypes)
            <option value="{{$apptypes->m04ID}}">{{$apptypes->m04ID}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             UACS <span class="#"><a href="#" title="Add New UACS" data-toggle="modal" data-target="#myModal">
              <span class="PY007_add">
                <button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button>
              </span>
          </a></span>

          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th>Code</th>
                    <th>Description</th>
                    <th style="width: 25%"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($Chgs))
                  @foreach ($Chgs as $apptypes)
                    <tr>
                      <td scope="row"> {{$apptypes->m04ID}}</td>
                      <td>{{$apptypes->m04Desc}}</td>
                      <td>
                        <center>
                          <span class="PY007_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$apptypes->m04IDA}}','{{$apptypes->m04ID}}', '{{$apptypes->m04Desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="PY007_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$apptypes->m04IDA}}', '{{$apptypes->m04Desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Add New UACS</strong></h5>
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
                  <div class="col-sm-4">Code:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" class="form-control"  required>
                  </div>
                  <div class="col-sm-4">Description:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                  </div>
                  {{-- <div class="col-sm-4">Remarks:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" id="new_rgn_rmk" class="form-control">
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
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit UACS</strong></h5>
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
  <div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Delete UACS</strong></h5>
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
  	$(document).ready(function() { $('#example').DataTable();});
  	function showData(idTrue,id,desc){
            $('#EditBody').empty();
            $('#EditBody').append(
                '<div class="col-sm-4 d-none">Code:</div>' +
                '<div class="col-sm-12 d-none" style="margin:0 0 .8em 0;">' +
                  '<input type="text" id="edit_name" value="'+idTrue+'" class="form-control " >' +
                '</div>' +
                '<div class="col-sm-4">UACS ID:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="text" id="edit_m04id" value="'+id+'" data-parsley-required-message="<strong>*</strong>ID <strong>Required</strong>" placeholder="'+id+'" class="form-control" required>' +
                '</div>'+
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
                  // if (test == -1) {
                      $.ajax({
                        method: 'POST',
                        data: {
                          _token : $('#token').val(),
                          id: $('#new_rgnid').val(),
                          name : $('#new_rgn_desc').val(),
                          mod_id : $('#CurrentPage').val(),
                          action: 'add'
                        },
                        success: function(data) {
                          if (data == 'DONE') {
                              alert('Successfully Added New UACS');
                              location.reload();
                          } else if (data == 'ERROR'){
                            $('#AddErrorAlert').show(100);
                          }
                        }, error : function(XMLHttpRequest, textStatus, errorThrown){
                            console.log(errorThrown);
                            $('#AddErrorAlert').show(100);
                        },
                    });
                  // } else {
                  //   alert('Code is already been taken');
                  //   $('#new_rgnid').focus();
                  // }
              }
          });
      $('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              form.parsley().validate();
               if (form.parsley().isValid()) {
                 var id = $('#edit_name').val();
                 var name = $('#edit_desc').val();
                 var m04id = $("#edit_m04id").val();
                 $.ajax({
                    method: 'POST',
                    data : {_token:$('#token').val(),id:id,name:name,m04id:m04id,mod_id : $('#CurrentPage').val(), action: 'edit'},
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited UACS');
                            location.reload();
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
      function deleteNow(){
            var id = $("#toBeDeletedID").val();
            var name = $("#toBeDeletedname").val();
            $.ajax({
              method: 'POST',
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val(), action: 'delete'},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+name);
                  location.reload();
                } else if (data == 'ERROR') {
                  $('#DelErrorAlert').show(100);
                }
              }, error : function (XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#DelErrorAlert').show(100);
              }
            });
          }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif