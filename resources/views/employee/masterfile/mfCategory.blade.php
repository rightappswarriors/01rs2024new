@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Category (Payment) Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PY002">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($category))
          @foreach ($category as $categorys)
            <option value="{{$categorys->cat_id}}">{{$categorys->cat_desc}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Category (Payment)&nbsp;<span class="PY002_add"><a href="#" title="Add New Category" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Type</th>
                    <th><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($category))
                    @foreach ($category as $categorys)
                      <tr>
                        <td scope="row"> {{$categorys->cat_id}}</td>
                        <td>{{$categorys->cat_desc}}</td>
                        @php
                        		$type = ($categorys->cat_type == 'C') ? 'Charge' : 'Payment';
                        @endphp
                        <td>
                          	{{$type}}
                        </td>
                        <td>
                          <center>
                            <span class="PY002_update">
                              <button type="button" class="btn btn-outline-warning" onclick="showData('{{$categorys->cat_id}}', '{{$categorys->cat_desc}}', '{{$type}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                            </span>
                            <span class="PY002_cancel">
                              <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$categorys->cat_id}}', '{{$categorys->cat_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
                  <h5 class="modal-title text-center"><strong>Add Category (Payment)</strong></h5>
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
                      <div class="col-sm-4">Type:</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                        <select id="new_rgn_type" class="form-control" data-parsley-required-message="*<strong>Type</strong> required" required>
                          <option value=""></option>
                          <option value="C">Charge</option>
                          <option value="P">Payment</option>
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
                <h5 class="modal-title text-center"><strong>Edit Category (Payment)</strong></h5>
                <hr>
                <div >
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
                <h5 class="modal-title text-center"><strong>Delete Category (Payment)</strong></h5>
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
      </div>
  <script type="text/javascript">
  	$(document).ready(function() { $('#example').DataTable();});
  	function showData(id,desc, des2){
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
                '<div class="col-sm-12">Type: ('+des2+')</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<select type="text" id="edit_type" value="'+desc+'" class="form-control">' +
                      '<option value=""></option>' +
                      '<option value="C">Charge</option>' +
                      '<option value="P">Payment</option>' +
                  '</select>' +
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
      function deleteNow(){
            var id = $("#toBeDeletedID").val();
            var name = $("#toBeDeletedname").val();
            $.ajax({
              url : "{{ asset('employee/mf/del_category') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+name);
                  window.location.href = "{{ asset('/employee/dashboard/mf/category') }}";
                }
                else if (data == 'ERROR') {
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
                  var id = $('#new_rgnid').val();
                  var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
                  var test = $.inArray(id,arr);
                  if (test == -1) { // Not in Array
                      $.ajax({
                        method: 'POST',
                        data: {
                          _token : $('#token').val(),
                          id: $('#new_rgnid').val(),
                          name : $('#new_rgn_desc').val(),
                          type : $('#new_rgn_type').val(),
                        },
                        success: function(data) {
                          if (data == 'DONE') {
                              alert('Successfully Added New Category');
                              window.location.href = "{{ asset('/employee/dashboard/mf/category') }}";
                          } else if(data == 'ERROR'){
                            $('#AddErrorAlert').show(100);
                          }
                        }, error : function(XMLHttpRequest, textStatus, errorThrown){
                            console.log(errorThrown);
                            $('#AddErrorAlert').show(100);
                        }
                    });
                  } else {
                    alert('Category ID is already been taken');
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
                    url: "{{ asset('employee/mf/save_category') }}",
                    method: 'POST',
                    data : {_token:$('#token').val(),id:x,name:y,type: $('#edit_type').val()},
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Category');
                            window.location.href = "{{ asset('/employee/dashboard/mf/category') }}";
                        } else if (data == "ERROR") {
                            $('#EditErrorAlert').show(100);
                        }
                    }
                 });
               }
          });
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif