@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Team Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="">
  <!-- <input type="text" id="CurrentPage" hidden="" value="TM001"> -->
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($team))
          @foreach ($team as $t)
            <option value="{{$t->teamid}}">{{$t->teamdesc}}</option>
          @endforeach
        @endif
      </datalist>
      @php
        $employeeData = session('employee_login');
        $grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';
    @endphp
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
          <button class="btn btn-primary" onclick="window.history.back();">Back</button>
          HFERC Team Assignment  
             <span  style="float: right;" ><a href="#" title="Add New Team" data-toggle="modal" data-target="#myModal"><button class="btn btn-primarys"><i class="fa fa-plus-circle" style="cursor: pointer;"></i>&nbsp;Add new</button></a></span>
             <!-- <span class="TM001_add" style="float: right;" ><a href="#" title="Add New Team" data-toggle="modal" data-target="#myModal"><button class="btn btn-primarys"><i class="fa fa-plus-circle" style="cursor: pointer;"></i>&nbsp;Add new</button></a></span> -->
          </div>
          <div class="card-body">
              <table class="table display" id="example" style="overflow-x: scroll;" >
  				<thead>
  					<tr>
  					  <th style="width: 25%">ID</th>
  					  <th style="width: 30%">Description</th>
  					  <th style="width: 20%">Region</th>
  					  <th style="width: 25%"><center>Options</center></th>
  					</tr>
  				</thead>
  				<tbody>
  					@if (isset($team))
  						@foreach ($team as $t)
  						<tr>
  							<td scope="row"> {{$t->teamid}}</td>
  							<td>{{$t->teamdesc}}</td>
  							<td style="text-align: center">{{$t->rgn_desc}}</td>
  							<td>
  							<center>
                <span >
  							<button type="button" class="btn btn-outline-primary" onclick="getAvailable('{{$t->rgnid}}', '{{$t->teamid}}')" data-toggle="modal" data-target="#viewModal11"><i class="fa fa-fw fa-users"></i></button>
  							</span>
  							<span>
  							<!-- <span class="TM001_update"> -->
  							<button type="button" class="btn btn-outline-warning" onclick="showData('{{$t->teamid}}', '{{$t->teamdesc}}', '{{$t->rgn_desc}}', '{{$t->rgnid}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
  							</span>
  							<span >
  							<!-- <span class="TM001_cancel"> -->
  							<button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$t->teamid}}', '{{$t->teamdesc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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

  {{-- Add --}}
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    	<div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            	<div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                  <h5 class="modal-title text-center"><strong>Add New Team</strong></h5>
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
                      <div class="col-sm-4">Region</div>
                      <div class="col-sm-8" style="margin:0 0 .8em 0;">
                        <select {{$grpid != 'NA' ? 'disabled' : ''}} id="new_rgn" class="form-control" data-parsley-required-message="*<strong>Region</strong> required" required>
                          <option value=""></option>
                          @isset($region)
                            @foreach ($region as $r)
                            @if($grpid != 'NA' && $employeeData->rgnid == $r->rgnid)
                              <option selected value="{{$r->rgnid}}">{{$r->rgn_desc}}</option>
                            @else
                            <option value="{{$r->rgnid}}">{{$r->rgn_desc}}</option>
                            @endif
                            @endforeach
                          @endisset
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
  {{-- Add --}}
  {{-- Edit --}}
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit Team</strong></h5>
            <hr>
            <div>
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
  {{-- Edit --}}
  {{-- Delete --}}
  <div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog" role="document">
  		<div class="modal-content" style="border-radius: 0px;border: none;">
  			<div class="modal-body" style=" background-color: #272b30;color: white;">
  				<h5 class="modal-title text-center"><strong>Delete Team</strong></h5>
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

  @include('employee.processflow.component.add_ptc_team_member')
  {{-- Delete --}}
  <script type="text/javascript">
  	$(document).ready(function() {
            $('#example').DataTable();
        } );
  	function showData(id,desc, rgndesc, rgid){ 
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
            '<div class="col-sm-12">Region: ('+rgndesc+')</div>' +
            '<input type="text" id="selectedRegID" value="'+rgid+'"  hidden>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<select id="edit_seq" class="form-control" data-parsley-required-message="*<strong>Region</strong> required">'+
                  '<option value="'+rgid+'"></option>' +
                  @isset($region)
                        @foreach ($region as $r)
                          '<option value="{{$r->rgnid}}">{{$r->rgn_desc}}</option>' +
                        @endforeach
                      @endisset
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
              url : "{{ asset('employee/mf/del_test') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id, mod_id : $('#CurrentPage').val()},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+name);
                  location.reload();
                  // window.location.href = "{{ asset('/employee/dashboard/mf/team') }}";
                  logActions('Deleted team with ID: '+id);
                }
                else if (data == 'ERROR'){
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
              if (test == -1) { 
                  $.ajax({
                    method: 'POST',
                    data: {
                      _token : $('#token').val(),
                      id: $('#new_rgnid').val(),
                      name : $('#new_rgn_desc').val(),
                      mod_id : $('#CurrentPage').val(),
                      rgn : $('#new_rgn').val(),
                    },
                    success: function(data) {
                      if (data == 'DONE') {
                          alert('Successfully Added Team');
                          location.reload();
                          // window.location.href = "{{ asset('/employee/dashboard/mf/team') }}";
                          logActions('Added team with ID: '+id);
                      } else if(data == 'ERROR'){
                        $('#AddErrorAlert').show(100);
                      }
                    }, error : function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#AddErrorAlert').show(100);
                    }
                });
              } else {
                alert('Team ID is already been taken');
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
             var z = $('#selectedRegID').val();
             var z1 = $('#edit_seq').val();
             // if (z == z1) {
             //    alert('The same region.');
             //    $('#edit_seq').focus();
             // }
             // else {
                $.ajax({
                  url: "{{ asset('employee/mf/save_team') }}",
                  method: 'POST',
                  data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val(), seq : $('#edit_seq').val()},
                  success: function(data){
                      if (data == "DONE") {
                          logActions('Edited team with ID: '+x);
                          alert('Successfully Edited Team');
                          location.reload();
                          // window.location.href = "{{ asset('/employee/dashboard/mf/team') }}";
                      } else if (data == "ERROR") {
                          $('#EditErrorAlert').show(100);
                      }
                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                      console.log(errorThrown);
                      $('#EditErrorAlert').show(100);
                  },
               });
             // }
           }
      }); 
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif