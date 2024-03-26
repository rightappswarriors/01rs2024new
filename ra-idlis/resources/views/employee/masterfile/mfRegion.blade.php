@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Region Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PL001">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($region))
          @foreach ($region as $regions)
            <option value="{{$regions->rgnid}}">{{$regions->rgn_desc}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Regions <span class="PL001_add"><a href="#" title="Add New Region" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

          </div>
          <div class="card-body">
                 <table class="table" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                     <th>ID</th>
                      <th>Name</th>
                      <th>Office</th>
                      <th>Address</th>
                      <th>ISO Description</th>
                      <th>Sort</th>
                    <th><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($region))
  	                @foreach ($region as $regions)
  	                  <tr>
  	                  	<td>{{$regions->rgnid}}</td>
  	                    <td>{{$regions->rgn_desc}}</td>
  	                    <td>{{$regions->office}}</td>
  	                    <td>{{$regions->address}}</td>
  	                    <td>{{$regions->iso_desc}}</td>
                        <td>{{$regions->sort}}</td>
  	                    <td>
  	                      <center>
                          <span class="PL001_update">
  	                        <button type="button" class="btn btn-outline-warning" onclick="showData('{{$regions->rgnid}}', '{{$regions->rgn_desc}}', '{{$regions->office}}', '{{$regions->address}}','{{$regions->iso_desc}}','{{$regions->sort}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
                          </span>
                          <span class="PL001_cancel">
  	                        <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$regions->rgnid}}', '{{$regions->rgn_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
          <h5 class="modal-title text-center"><strong>Add New Region</strong></h5>
          <hr>
          <div class="container">
            <form id="addRgn" class="row"  data-parsley-validate>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                <div class="row">
                </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                  <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div> 
              {{ csrf_field() }}
              <div class="col-sm-4 req">ID:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required"  class="form-control"  required>
              </div>
              <div class="col-sm-4 req">Name:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
              </div>
              <div class="col-sm-4 req">Office:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <input type="text" id="new_office" class="form-control" data-parsley-required-message="*<strong>Office</strong> required" required>
              </div>
              <div class="col-sm-4 req">Address:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <input type="text" id="new_address" class="form-control" data-parsley-required-message="*<strong>Address</strong> required" required>
              </div>
              <div class="col-sm-4 req">ISO Description:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <input type="text" id="new_iso_desc" class="form-control" data-parsley-required-message="*<strong>Address</strong> required" required>
              </div>
              <div class="col-sm-4">Director:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" id="director" class="form-control">
              </div>
              <div class="col-sm-4">Director Description:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" id="directorDesc" class="form-control">
              </div>
              <div class="col-sm-12">
                <button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Region</button>
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
            <h5 class="modal-title text-center"><strong>Edit Region</strong></h5>
            <hr>
            <div class="container">
                  <form id="EditNow" data-parsley-validate>
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
                    <div class="row">
                    </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
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
                <h5 class="modal-title text-center"><strong>Delete Region</strong></h5>
                <hr>
                <div class="container">
                  <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DelErrorAlert" role="alert">
                        <div class="row">
                        </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
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
  	$(document).ready(function() { $('#example').DataTable();});
  	function showData(id,desc,ofc,address,iso_desc, sort){
        console.log(ofc);
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
            '<div class="col-sm-4">Office:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_office" value="' + ofc + 
              '" data-parsley-required-message="<strong>*</strong>Office<strong>Required</strong>" placeholder="' + ofc +
              '" class="form-control" required>' +
            '</div>' +
            '<div class="col-sm-4">Address:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_address" value="' + address + 
              '" data-parsley-required-message="<strong>*</strong>Address<strong>Required</strong>" placeholder="' + address +
              '" class="form-control" required>' +
            '</div>' +
            '<div class="col-sm-4">ISO Description:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_iso_desc" value="' + iso_desc + 
              '" data-parsley-required-message="<strong>*</strong>Address<strong>Required</strong>" placeholder="' + iso_desc +
              '" class="form-control" required>' +
            '</div>' +
            '<div class="col-sm-4">Sorting:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_director" value="'+sort+'" data-parsley-required-message="<strong>*</strong>Sort <strong>Required</strong>" placeholder="'+sort+'" class="form-control" required>' +
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
              url : "{{ asset('employee/mf/del_region') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+name);
                  window.location.href = "{{ asset('employee/dashboard/ph/regions') }}";
                } else if (data == 'ERROR') {
                  $('#DelErrorAlert').show(100);
                }
              },
              error: function(XMLHttpRequest, textStatus, errorThrown){
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
                        url: "{{asset('employee/dashboard/ph/regions')}}",
                        method: 'POST',
                        data: {
                          _token : $('#token').val(),
                          id: $('#new_rgnid').val(),
                          name : $('#new_rgn_desc').val(),
                          office: $('#new_office').val(),
                          address: $('#new_address').val(),
                          iso_desc: $('#new_iso_desc').val(),
                          director : $('#director').val(),
                          directorDesc : $('#directorDesc').val(),
                          mod_id : $('#CurrentPage').val(),
                        },
                        success: function(data) {
                          if (data == 'DONE') {
                              alert('Successfully Added New Region');
                              window.location.href = "{{ asset('employee/dashboard/ph/regions') }}";
                          } else if (data == 'ERROR') {
                            $('#AddErrorAlert').show(100);
                          }
                        },
                        error : function(XMLHttpRequest, textStatus, errorThrown) {
                          $('#AddErrorAlert').show(100);
                        },
                    });
                  } else {
                    alert('Regional ID is already been taken');
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
                 var y1 = $('#edit_office').val();
                 var y2 = $('#edit_address').val();
                 var y3 = $('#edit_iso_desc').val();
                 var z = $('#edit_director').val();
                 $.ajax({
                    url: "{{ asset('employee/mf/save_region') }}",
                    method: 'POST',
                    data : {
                      _token:$('#token').val(),
                      id:x,
                      name:y,
                      office: y1,
                      address: y2,
                      iso_desc: y3,
                      director:z,
                      mod_id : $('#CurrentPage').val()
                    },
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Region');
                            window.location.href = "{{ asset('/employee/dashboard/ph/regions') }}";
                        } else if (data == 'ERROR') {
                          $('#EditErrorAlert').show(100);                           
                        }
                    }, 
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
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