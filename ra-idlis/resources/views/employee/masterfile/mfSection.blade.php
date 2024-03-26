@if (session()->exists('employee_login'))      
  @extends('mainEmployee')
  @section('title', 'Section Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PR002">
   @if (isset($depts) && isset($secs))
     @foreach ($depts as $dept)
     <datalist id="{{$dept->depid}}_list">
       @foreach ($secs as $sec)
         @if ($dept->depid == $sec->depid)
            <option id="{{$sec->secid}}_pro" value="{{$sec->secid}}">{{$sec->secname}}</option>
         @endif
       @endforeach
     </datalist>
    @endforeach
   @endif
   <datalist id="rgn_list">
     @if (isset($secs))
       @foreach ($secs as $sec)
         <option id="{{$sec->secid}}_pro" value="{{$sec->secid}}">{{$sec->secname}}</option>
       @endforeach
     @endif
   </datalist>
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Section <span class="PR002_add"><a href="#" title="Add New Section" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
             <div style="float:right;display: inline-block;">
              <form class="form-inline">
                <label>Filter : &nbsp;</label>
                <select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()">
                  <option value="">Select Department ...</option>
                  @if (isset($depts))
                    @foreach ($depts as $dept)
                      <option value="{{$dept->depid}}">{{$dept->depname}}</option>
                    @endforeach     
                  @endif
                </select>
                </form>
             </div>
          </div>
          <div class="card-body">
                 <table class="table" style="overflow-x: scroll;" id="example">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th><center>Options</center></th>
                  </tr>
                </thead>
                <tbody id="FilterdBody">
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
  		    <h5 class="modal-title text-center"><strong>Add New Department</strong></h5>
  		    <hr>
  		    <div class="container">
  		      <form class="row" id="addCls" data-parsley-validate>
  		        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
  		            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
  		            <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
  		                <span aria-hidden="true">&times;</span>
  		            </button>
  		        </div>
  		        {{ csrf_field() }}
  		        <div class="col-sm-4">Department:</div>
  		        <div class="col-sm-8" style="margin:0 0 .8em 0;">
  		          <select id="OCID" data-parsley-required-message="*<strong>Ownership</strong> required" class="form-control" required>  
  		              <option value="">Select Department ...</option>
  		                @if (isset($depts))
  		                  @foreach ($depts as $dept)
  		                  <option value="{{$dept->depid}}">{{$dept->depname}}</option>
  		                @endforeach
  		                @endif
  		          </select>
  		        </div>
  		        <div class="col-sm-4">ID:</div>
  		        <div class="col-sm-8"  style="margin:0 0 .8em 0;">
  		        <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required" name="fname" class="form-control" required>
  		        </div>
  		        <div class="col-sm-4">Description:</div>
  		        <div class="col-sm-8" style="margin:0 0 .8em 0;">
  		        <input type="text" id="new_rgn_desc" name="fname" data-parsley-required-message="*<strong>Name</strong> required" class="form-control"  required>
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
            <h5 class="modal-title text-center"><strong>Edit Section</strong></h5>
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
                <h5 class="modal-title text-center"><strong>Delete Section</strong></h5>
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
  	function showData(id,desc){
        $('#EditBody').empty();
        $('#EditBody').append(
            '<div class="col-sm-4">ID:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
            '</div>' +
            '<div class="col-sm-4">Description:</div>' +
            '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
              '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Zip Code <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
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
      function filterGroup(){
          var id = $('#filterer').val();
          var token = $('#token').val();
          var x = $('#'+id+'_list option').map(function() {return $(this).val();}).get();
          $('#FilterdBody').empty();
          $('#example').DataTable().clear().draw();
            for (var i = 0; i < x.length; i++) {
              var d = $('#'+x[i]+'_pro').text();
              var e = $('#'+x[i]+'_pro').attr('value');
              $('#example').DataTable().row.add([
              		e,d,
              		'<center><span class="PR002_update">' +
              		'<button type="button" class="btn btn-outline-warning" onclick="showData(\''+e+'\',\''+d+'\');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;'+
                    '</span>'+
                    '<span class="PR002_cancel">' +
                    '<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+e+'\', \''+d+'\');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>'+
                  '</span>' +
                    '</center>'
      				]).draw();
            }
            GroupRightsActivate();
        }
      function deleteNow(){
            var id = $("#toBeDeletedID").val();
            var name = $("#toBeDeletedname").val();
            $.ajax({
              url : "{{ asset('employee/mf/del_section') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+name);
                  window.location.href = "{{ asset('/employee/dashboard/mf/section') }}";
                } else if (data == 'ERROR') {
                  $('#DelErrorAlert').show(100);
                }
              }, error : function (XMLHttpRequest, textStatus, errorThrown){
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
                          depid : $('#OCID').val(),
                          mod_id : $('#CurrentPage').val(),
                        },
                        success: function(data) {
                          if (data == 'DONE') {
                              alert('Successfully Added New Section');
                              window.location.href = "{{ asset('employee/dashboard/mf/section') }}";
                          } else if (data == 'ERROR') {
                            $('#AddErrorAlert').show(100);
                          }
                        }, error : function (XMLHttpRequest, textStatus, errorThrown){
                            console.log(errorThrown);
                            $('#AddErrorAlert').show(100);
                        },
                    });
                  } else {
                    alert('Section ID is already been taken');
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
  			      url: "{{ asset('employee/mf/save_section') }}",
  			      method: 'POST',
  			      data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
  			      success: function(data){
  			          if (data == "DONE") {
  			              alert('Successfully Edited Section');
  			              window.location.href = "{{ asset('/employee/dashboard/mf/section') }}";
  			          } else if (data == 'ERROR') {
  			            $('#EditErrorAlert').show(100);
  			          }
  			      }, error : function(XMLHttpRequest, textStatus, errorThrown){
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