@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Service Type')
  @section('content')
   <input type="text" id="CurrentPage" hidden="" value="AP20">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($data))
          @foreach ($data as $ans)
            <option value="{{$ans->servtype_id}}">{{$ans->servtype_id}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Service Type <span class="#"><a href="#" title="Add Service Type" data-toggle="modal" data-target="#myModal">
              <span class="AP20_add">
                <button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button>
              </span>
          </a></span>
          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                  	<th>Service Type Name</th>
                    <th style="width: 25%"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($data))
                  @foreach ($data as $ans)
                    <tr>
                      <td>{{$ans->anc_name}}</td>
                      <td>
                        <center>
                          <span class="AP20_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$ans->servtype_id}}', '{{$ans->anc_name}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="AP20_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$ans->servtype_id}}','{{$ans->anc_name}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
              <h5 class="modal-title text-center"><strong>Add Service Type</strong></h5>
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
                  <div class="col-sm-4">Service Type:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" name="name" id="name" data-parsley-required-message="*<strong>Service Type Name</strong> required" class="form-control"  required>
                  </div>
                  <input type="hidden" name="action" value="add">
                  
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
            <h5 class="modal-title text-center"><strong>Edit Ancilliary</strong></h5>
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
            <h5 class="modal-title text-center"><strong>Delete Ancilliary</strong></h5>
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
  	function showData(id,desc){
            $('#EditBody').empty();
            $('#EditBody').append(
            	'<input type="hidden" id="eid" value="'+id+'" data-parsley-required-message="*<strong>ID</strong> required" class="form-control"  required>'+
               ' <div class="col-sm-4">Service Type Name:</div>'+
                 ' <div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                 ' <input type="text" id="ename" name="ename" value="'+desc+'" id="name" data-parsley-required-message="*<strong>Service Type Name</strong> required" class="form-control"  required>'+
                  '</div>'+
                 ' <input type="hidden" name="action" value="edit">'
              );
          }
      function showDelete (id,desc){
          $('#DelModSpan').empty();
          $('#DelModSpan').append(
              '<div class="col-sm-12"> Are you sure you want to delete '+desc +'?'+
              '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
              '</div>'
            );
      }
      $("#addRgn").submit(function(e){
      	e.preventDefault();
      	let data = $(this).serialize();
      	$.ajax({
      		method: "POST",
      		data: data,
      		success: function(a){
      			if(a == 'DONE'){
      				alert('Added New Service Type Successfully');
      				location.reload();
      			}
      		}
      	})
      })

      $('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              form.parsley().validate();
               if (form.parsley().isValid()) {
                 var desc = $('#ename').val();
                 var id = $("#eid").val();
                 $.ajax({
                    method: 'POST',
                    data : 
                    {
                    	_token:$('#token').val(),
                    	id:id,
                    	ename:desc,
                    	mod_id : $('#CurrentPage').val(), 
                    	action: 'edit'
                	},
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Ancilliary');
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
              	action: 'delete'
              },
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