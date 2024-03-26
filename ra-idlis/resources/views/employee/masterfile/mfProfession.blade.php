@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Profession Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PY001">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($professions))
          @foreach ($professions as $profession)
          <option value="{{$profession->id}}">{{$profession->description}}</option>
          @endforeach
        @endif
      </datalist> 
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
          Profession <span class="PY001_add"><a href="#" title="Add New Profession" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
          </div>
          <div class="card-body">
                 <table class="table" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Position</th>
                    <th>Type</th>
                    <th><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($professions))
                  @foreach ($professions as $profession)
                    <tr>
                      <td scope="row"> {{$profession->id}}</td>
                      <td>{{$profession->description}}</td>
                      <td>{{$profession->posname}}</td>
                      <td>{{$profession->type}}</td>
                      <td>
                        <center>
                          <span class="PY001_update">   
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$profession->id}}', '{{$profession->description}}', '{{$profession->id}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="PY001_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$profession->id}}', '{{$profession->description}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
              <h5 class="modal-title text-center"><strong>Add Profession</strong></h5>
              <hr>
              <div class="container">
                <form id="addRgn" class="row"  data-parsley-validate>
                  {{ csrf_field() }}
   
                  <div class="col-sm-4">Description:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" id="description" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
                  </div>
                  <div class="col-sm-4">Position:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <select class="form-control" id="position">
                      @if(isset($positions))
                      @foreach ($positions as $position)
                        <option value="{{$position->posid}}">{{$position->posname}}</option>
                      @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="col-sm-4">Type:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <select class="form-control" id="type">
                      <option value="Pharmacy">Pharmacy</option>
                      <option value="Radiology">Radiology</option>
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
          <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit Profession</strong></h5>
            <hr>
            <div class="container">
                  <form id="EditNow" data-parsley-validate>
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
  	      <h5 class="modal-title text-center"><strong>Delete Profession</strong></h5>
  	      <hr>
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
  <script type="text/javascript">
  	$(document).ready(function() {$('#example').DataTable();});

  	function showData(id,desc,pos ){
            $('#EditBody').empty();
            $('#EditBody').append(
                '<input type="hidden" id="edit_id" value="'+id+'">' +
                '<div class="col-sm-4">Description:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="text" id="edit_description" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
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
            $.ajax({
              url : "{{ asset('employee/mf/del_profession') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
              success: function(data){
                alert('Successfully deleted '+name);
                window.location.href = "{{ asset('/employee/dashboard/mf/profession') }}";
              }
            });
          }
      $('#addRgn').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {


              $.ajax({
                method: 'POST',
                data: {
                    _token : $('#token').val(),
                    description : $('#description').val(),
                    position : $('#position').val(),
                    type : $('#type').val(),
                    act: 'add',
                },
                success: function(data) {
                    if (data == 'DONE') {
                        alert('Successfully Added Profession');
                        window.location.href = "{{ asset('employee/dashboard/mf/profession') }}";
                    } else {
                    alert(data);
                    }
                }
            });
          }
      });
      $('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              form.parsley().validate();
               if (form.parsley().isValid()) {

                 if($('#edit_status').is(':checked')){
                    status = '1';
                 } else {
                    status = '0';
                 }
                 $.ajax({
                    url: "{{ asset('employee/mf/save_profession') }}",
                    method: 'POST',
                    data : {
                        _token:$('#token').val(),
                        id:$('#edit_id').val(),
                        description : $('#edit_description').val(),
                    },
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Profession');
                            window.location.href = "{{ asset('employee/dashboard/mf/profession') }}";
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