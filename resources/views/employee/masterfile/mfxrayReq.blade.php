@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'FDA X-Ray Machine Requirements')
  @section('content')
   <input type="text" id="CurrentPage" hidden="" value="FD012">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($mach))
          @foreach ($mach as $xray)
            <option value="{{$xray->reqID}}">{{$xray->reqID}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             X-Ray Machine Requirements <span class="#"><a href="#" title="Add New X-Ray Machine Requirements" data-toggle="modal" data-target="#myModal">
              <span class="FD012_add">
                <button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button>
              </span>
          </a></span>
          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th>Requirements Name</th>
                    <th>Required</th>
                    <th style="width: 25%"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($mach))
                  @foreach ($mach as $xray)
                    <tr>
                      <td>{{$xray->reqName}}</td>
                      <td>{{($xray->isRequired == 1 ? 'YES' : 'NO')}}</td>
                      <td>
                        <center>
                          <span class="FD012_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$xray->reqID}}', '{{addslashes($xray->reqName)}}','{{$xray->isRequired}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="FD012_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$xray->reqID}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
              <h5 class="modal-title text-center"><strong>Add New X-Ray Machine Requirements</strong></h5>
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
                  <div class="col-sm-4">Requirements Name:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" id="desc" data-parsley-required-message="*<strong>Requirements name required</strong> required" class="form-control"  required>
                  </div>
                  <div class="col-sm-4">Required:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="checkbox" id="req" value="true" class="form-control">
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
            <h5 class="modal-title text-center"><strong>Edit X-Ray Machine Requirements</strong></h5>
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
            <h5 class="modal-title text-center"><strong>Delete X-Ray Machine Requirements</strong></h5>
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
  	function showData(id,desc, isRequired){
            $('#EditBody').empty();
            $('#EditBody').append(
            	'<input type="hidden" id="id" value="'+id+'" data-parsley-required-message="*<strong>ID</strong> required" class="form-control"  required>'+
                '<div class="col-sm-6">Requirements Name:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                    '<input type="text" id="descEdit" value="'+desc+'" data-parsley-required-message="*<strong>Range From</strong> required" class="form-control"  required>'+
                  '</div>'+
                  '<div class="container">'+
                    '<div class="row">'+
                      '<div class="col-sm-6">Is Required?:</div>'+
                      '<div class="col-sm-6"><input type="checkbox" id="isRequired" class="form-control" '+(isRequired == 1 ? "checked" : "")+'></div>'+
                    '</div>'+
                  '</div>'
              );
          }
      function showDelete (id){
          $('#DelModSpan').empty();
          $('#DelModSpan').append(
              '<div class="col-sm-12"> Are you sure you want to delete this data?' +
              '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
              '</div>'
            );
      }
      $('#addRgn').on('submit',function(event){
              event.preventDefault();
              var form = $(this);
              form.parsley().validate();
              if (form.parsley().isValid()) {
                  var desc = $('#desc').val();
                  var req = $('#isRequired').val();
                  $.ajax({
                    method: 'POST',
                    data: {
                      _token : $('#token').val(),
                      reqName: desc,
                      isRequired: req,
                      mod_id : $('#CurrentPage').val(),
                      action: 'add'
                    },
                    success: function(data) {
                      if (data == 'DONE') {
                          alert('Successfully Added New X-Ray Machine Requirements');
                          location.reload();
                      } else if (data == 'ERROR'){
                        $('#AddErrorAlert').show(100);
                      }
                    }, error : function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#AddErrorAlert').show(100);
                    },
                });
              }
          });
      $('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              form.parsley().validate();
               if (form.parsley().isValid()) {
                  var req = $('#req').val();
                 var desc = $('#descEdit').val();
                 var id = $("#id").val();
                 $.ajax({
                    method: 'POST',
                    data : 
                    {
                    	_token:$('#token').val(),
                    	id:id,
                    	reqName: desc,
                      isRequired: req,
                    	mod_id : $('#CurrentPage').val(), 
                    	action: 'edit'
                	},
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited X-Ray Machine Requirements');
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
            $.ajax({
              method: 'POST',
              data: {
              	_token:$('#token').val(),
              	id:id,
              	mod_id : $('#CurrentPage').val(), 
              	action: 'delete'},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted choosen entry');
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