@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Request for Assistance Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="OH002">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($AllData))
          @foreach ($AllData as $t)
            <option value="{{$t->rq_id}}">{{$t->rq_desc}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Request for Assistance <span class="OH002_add" ><a href="#" title="Add New Team" data-toggle="modal" data-target="#myModal"><button class="btn btn-primarys"><i class="fa fa-plus-circle" style="cursor: pointer;"></i>&nbsp;Add new</button></a></span>
          </div>
          <div class="card-body">
              <table class="table display" id="example" style="overflow-x: scroll;" >
  				<thead>
  					<tr>
  					  <th style="width: auto">ID</th>
  					  <th style="width: auto">Description</th>
  					  <th style="width: auto"><center>Options</center></th>
  					</tr>
  				</thead>
  				<tbody>
  					@if (isset($AllData))
  						@foreach ($AllData as $t)
  						<tr>
  							<td scope="row"> {{$t->rq_id}}</td>
  							<td>{{$t->rq_desc}}</td>
  							<td>
  							<center>
  							<span class="OH002_edit">
  							<button type="button" class="btn btn-outline-warning" onclick="showData('{{$t->rq_id}}', '{{$t->rq_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
  							</span>
  							<span class="OH002_cancel">
  							<button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$t->rq_id}}', '{{$t->rq_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
                  <h5 class="modal-title text-center"><strong>Add New Request for Assistance</strong></h5>
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
  {{-- Add --}}
  {{-- Edit --}}
  <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
  		<div class="modal-content" style="border-radius: 0px;border: none;">
  			<div class="modal-body" style=" background-color: #272b30;color: white;">
                  <h5 class="modal-title text-center"><strong>Edit Request for Assistance</strong></h5>
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
  				<h5 class="modal-title text-center"><strong>Delete Request for Assistance</strong></h5>
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
  {{-- Delete --}}
  <script type="text/javascript">
  	$(document).ready(function() {
            $('#example').DataTable();
        } );
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
      function deleteNow(){
            var id = $("#toBeDeletedID").val();
            var name = $("#toBeDeletedname").val();
            $.ajax({
              url : "{{ asset('employee/mf/del_requestforassistance') }}",
              method: 'GET',
              data: {_token:$('#token').val(),id:id, mod_id : $('#CurrentPage').val()},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+ name);
                  location.reload();
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
                      name : $('#new_rgn_desc').val(),
                      mod_id : $('#CurrentPage').val(),
                      rgn : $('#new_rgn').val(),
                    },
                    success: function(data) {
                      if (data == 'DONE') {
                          alert('Successfully Added Request of Assistance');
                          location.reload();
                      } else if(data == 'ERROR'){
                        $('#AddErrorAlert').show(100);
                      }
                    }, error : function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#AddErrorAlert').show(100);
                    }
                });
              } else {
                alert('Request of Assistance ID is already been taken');
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
             // var z = $('#selectedRegID').val();
             // if (z == z1) {
             //    alert('The same region.');
             //    $('#edit_seq').focus();
             // }
              $.ajax({
                url: "{{ asset('employee/mf/save_requestforassistance') }}",
                method: 'GET',
                data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
                success: function(data){
                    if (data == "DONE") {
                        alert('Successfully Edited Request for Assistance');
                        location.reload();
                    } else if (data == "ERROR") {
                        $('#EditErrorAlert').show(100);
                    }
                }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                    $('#EditErrorAlert').show(100);
                },
             });
           }
      }); 
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif