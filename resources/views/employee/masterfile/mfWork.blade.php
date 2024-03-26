@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Position Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PR003">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($works))
          @foreach ($works as $work)
            <option value="{{$work->posid}}">{{$work->posname}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Position <span class="PR003_add"><a href="#" title="Add New Position" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
          </div>
          <div class="card-body">
                 <table class="table" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    {{-- <th>ID</th> --}}
                    <th>Description</th>
                    <th><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($works))
                    @foreach ($works as $work)
                    <tr>
                      {{-- <td scope="row"> {{$work->posid}}</td> --}}
                      <td><strong>{{$work->posname}}</strong></td>
                      <td>
                        <center>
                          <span class="PR003_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$work->posid}}', '{{$work->posname}}', '{{$work->groupRequired}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="PR003_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$work->posid}}', '{{$work->posname}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
  	      <div class="modal-body" style=" background-color: #272b30;
  	    color: white;">
  	        <h5 class="modal-title text-center"><strong>Add New Position</strong></h5>
  	        <hr>
  	        <div class="container">
  	          <form id="addRgn" class="row"  data-parsley-validate>
  	            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
  	                <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
  	                <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
  	                    <span aria-hidden="true">&times;</span>
  	                </button>
  	            </div>
  	            {{ csrf_field() }}
  	            {{-- <div class="col-sm-4">ID:</div>
  	            <div class="col-sm-8" style="margin:0 0 .8em 0;">
  	            <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required"  class="form-control"  required>
  	            </div> --}}
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
              <div class="modal-body" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Edit Position</strong></h5>
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
            <h5 class="modal-title text-center"><strong>Delete Position</strong></h5>
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
    	$(document).ready(function() {
           $('#example').DataTable({
                // dom: 'Bfrtip',
                // buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
            });
       });
    	function showData(id,desc,required){
        if(required == '1') {
          $checked = 'checked';
        } else {
          $checked = '';
        }
        $('#EditBody').empty();
        $('#EditBody').append(
            '<div class="col-sm-4" style="display: none">ID:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;display: none">' +
              '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
            '</div>' +
            '<div class="col-sm-4">Description:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input style="margin-bottom:2px;" type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
              'PRC Reg. Number and Validity Period Required ? <input type="checkbox" value="1" id="groupRequired" '+$checked+'>' +
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
              url : "{{ asset('employee/mf/del_position') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+ name);
                  location.reload();
                } else {
                  $('#DelErrorAlert').show(100);
                }
              }, error : function (XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('$DelErrorAlert').show(100);
              }
            });
          }
      $('#addRgn').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
              // var id = $('#new_rgnid').val();
              var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
              // var test = $.inArray(id,arr);
              // if (test == -1) { // Not in Array
                  $.ajax({
                    method: 'POST',
                    data: {
                      _token : $('#token').val(),
                      // id: $('#new_rgnid').val(),
                      name : $('#new_rgn_desc').val(),
                      mod_id : $('#CurrentPage').val(),
                    },
                    success: function(data) {
                      if (data == 'DONE') {
                          alert('Successfully Added New Position');
                          location.reload();
                      } else if (data == 'ERROR') {
                          $('#AddErrorAlert').show(100);
                      }
                    }, error : function (XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#AddErrorAlert').show(100);
                    }
                });
              // } else {
              //   alert('Position ID is already been taken');
              //   $('#new_rgnid').focus();
              // }
          }
      });
      $('#EditNow').on('submit',function(event){
        event.preventDefault();
          var form = $(this);
          form.parsley().validate();
           if (form.parsley().isValid()) {
             var x = $('#edit_name').val();
             var y = $('#edit_desc').val();
             var req = $("#groupRequired").is(':checked') ? 1 : 0;
             $.ajax({
                url: "{{ asset('employee/mf/save_position') }}",
                method: 'POST',
                data : {_token:$('#token').val(),id:x,name:y,req:req,mod_id : $('#CurrentPage').val()},
                success: function(data){
                    if (data == "DONE") {
                        alert('Successfully Edited Position');
                        location.reload();
                    } else if (data == 'DONE') {
                        $('#EditErrorAlert').show(100);
                    }
                }, error : function (XMLHttpRequest, textStatus, errorThrown){
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