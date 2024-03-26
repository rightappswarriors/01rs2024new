@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Facility Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="AP008">
  <datalist id="rgn_list">
      @if (isset($faciType))
  	    @foreach ($faciType as $fatype)
  		    <option id="{{$fatype->hgpid}}_pro" value="{{$fatype->hgpid}}">{{$fatype->hgpdesc}}</option>
  	    @endforeach
      @endif
  </datalist>
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
              Facility <span class="AP008_add"><a href="#" title="Add New Health Facility" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
             <div style="float:right;display: inline-block;">
             </div>
          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th style="width: auto">ID</th>
                    <th style="width: auto">Name</th>
                    <th style="width: auto"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody id="FilterdBody">
                  @if($data)
                  @foreach ($data as $amb)
                    <tr>
                      <td>{{$amb->ambid}}</td>
                      <td>{{$amb->hgpdesc}}</td>
                      <td><center>
                      <span class="AP008_cancel">
                      <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$amb->ambid}}', '{{$amb->hgpdesc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                      </span>
                      </center></td>
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
  	    <h5 class="modal-title text-center"><strong>Add New Facility</strong></h5>
  	    <hr>
  	    <div class="container">
  	      <form class="row" id="addCls" data-parsley-validate>
  	        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
  	            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
  	            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
  	                <span aria-hidden="true">&times;</span>
  	            </button>
  	        </div>
  	        {{ csrf_field() }}
  	        {{-- <div class="col-sm-4">ID:</div> --}}
  	        {{-- <div class="col-sm-8"  style="margin:0 0 .8em 0;">
  	        <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" name="fname" class="form-control" required>
  	        </div> --}}
  	        <div class="col-sm-4">Facilities:</div>
  	        <div class="col-sm-8" style="margin:0 0 .8em 0;">
            <select id="new_rgn_desc" name="fname" required data-parsley-required-message="*<strong>Name</strong> required" class="form-control">
              <option value="">Please Select</option>
              @isset($faciType)
              @foreach($faciType as $f)
              <option value="{{$f->hgpid}}">{{$f->hgpdesc}}</option>
              @endforeach
              @endisset
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
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit Facility</strong></h5>
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
            <h5 class="modal-title text-center"><strong>Delete Facility</strong></h5>
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
        $('#example').DataTable({
            // dom: 'Bfrtip',
            // buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
        });
      });
      function showData(id,desc){
        $('#EditBody').empty();
        $('#EditBody').append(
            '<div class="col-sm-4">ID:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
            '</div>' +
            '<div class="col-sm-4">Description:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
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
              method: 'POST',
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val(), action: 'delete'},
              success: function(data){
                 if (data) {
                     logActions('Deleted Ambulance Facility with ID: '+id);
                     alert('Successfully deleted '+name);
                    window.location.href = "{{ asset('employee/dashboard/mf/For-Ambulance') }}";
                 } else if (data == 'ERROR') {
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
              var test = $.inArray(id,arr);
              if (test == -1) { // Not in Array
                  $.ajax({
                    method: 'POST',
                    data: {
                      _token : $('#token').val(),
                      id: $('#new_rgnid').val(),
                      name : $('#new_rgn_desc').val(),
                      mod_id : $('#CurrentPage').val(),
                    },
                    success: function(data) {
                      if (data) {
                          logActions('Added new Ambulance Facility with ID: '+ data);
                          alert('Successfully Added New Facility');
                          window.location.href = "{{ asset('employee/dashboard/mf/For-Ambulance') }}";
                      } else if (data == 'ERROR'){
                          $('#AddErrorAlert').show(100);
                      }
                    }, error : function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#AddErrorAlert');
                    }
                });
              } else {
                alert('Health Facility ID is already been taken');
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
                url: "{{ asset('employee/mf/save_facility') }}",
                method: 'POST',
                data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                success: function(data){
                    if (data == "DONE") {
                        logActions('Edited Facility with ID: '+ $('#edit_name').val());
                        alert('Successfully Edited Facility');
                        window.location.href = "{{ asset('employee/dashboard/mf/For-Ambulance') }}";
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
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif