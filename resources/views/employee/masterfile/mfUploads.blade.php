@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Uploads Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="AP013">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Uploads <span class="AP013_add"><a href="#" title="Add New Uploads" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
             <div style="float:right;display: inline-block;">
          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
  	              <thead>
  	                <tr>
                      <th>Office</th>
  	                  <th>Name</th>
  	                  <th><center>Required</center></th>
  	                  <th><center>Options</center></th>
  	                </tr>
  	              </thead>
  	              <tbody id="FilterdBody">
  	                @if(isset($uploads))
  	                  @foreach ($uploads as $upl)
  	                  <tr>
                          <td><center>{{$upl->office}}</center></td>
  	                      <td>{!!$upl->updesc!!}</td>
  	                            <td><center> 
  	                            <?php $test = ($upl->isRequired == 1)? '<span style="color:green;font-weight:bold">YES</span>':'<span style="color:red;font-weight:bold">NO</span>';echo $test; ?>                           
  	                            </center></td>
  	                            <td><center>
  	                            <span class="AP013_update">
  	                            <button type="button"  class="btn btn-outline-warning" onclick="showData({{$upl->upid}},'{{$upl->updesc}}','{{$upl->office}}',{{$upl->isRequired}});" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
  	                            </span>
  	                            <span class="AP013_cancel">
  	                            <button type="button" class="btn btn-outline-danger" onclick="showDelete({{$upl->upid}},'{{$upl->updesc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Add New Upload</strong></h5>
              <hr>
              <div class="container">
                <form class="row" id="addCls" data-parsley-validate>
                  {{ csrf_field() }}
                  <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="col-sm-4">Office:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  {{-- <input type="text" id="new_rgn_desc" name="fname"> --}}
                  <select name="office" id="office" class="form-control" data-parsley-required-message="*<strong>Office</strong> required" class="form-control"  required>
                    <option selected value="hfsrb">HFSRB</option>
                    <option value="xray">FDA X-Ray</option>
                    <option value="pharma">FDA Pharmacy</option>
                  </select>
                  </div>
                  <div class="col-sm-4">Description:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  {{-- <input type="text" id="new_rgn_desc" name="fname"> --}}
                  <textarea name="fname" id="new_rgn_desc" cols="30" rows="10" data-parsley-required-message="*<strong>Description</strong> required" class="form-control"  required></textarea>
                  </div>
                  <div class="col-sm-4">Required:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="checkbox" class="form-control" id="new_required">
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
            <h5 class="modal-title text-center"><strong>Edit Upload</strong></h5>
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
            <h5 class="modal-title text-center"><strong>Delete Upload</strong></h5>
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
      $('#new_rgn_desc').summernote({
        height: 150,
        width: 285
      });
          $('#example').DataTable({
               // dom: 'Bfrtip',
               // buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
  		});
  	});
  	function showData(id,desc,office,IsRequired){
          var checked = (IsRequired == 1) ? 'checked' : '';
          $('#EditBody').empty();
          $('#EditBody').append(
                '<div class="col-sm-4" hidden>ID:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;" hidden>' +
                  '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
                '</div>' +
                '<div class="col-sm-4">Office:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  {{-- <input type="text" id="new_rgn_desc" name="fname"> --}}
                  '<select name="officeedit" id="officeedit" class="form-control" data-parsley-required-message="*<strong>Office</strong> required" class="form-control"  required>'+
                    '<option selected value="hfsrb">HFSRB</option>'+
                    '<option value="xray">FDA X-Ray</option>'+
                    '<option value="pharma">FDA Pharmacy</option>'+
                  '</select>'+
                  '</div>'+
                '<div class="col-sm-4">Description:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                '<textarea id="edit_desc" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>"></textarea>'+
                  // '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
                '</div>' +
                '<div class="col-sm-4">Required:</div>' +
                '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
                  '<input type="checkbox" id="edit_required" class="form-control" '+checked+'>' +
                '</div>' 
          );
          $("#edit_desc").summernote("code", desc);
          $("#officeedit").val(office).trigger('change');
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
              url : "{{ asset('employee/mf/del_upload') }}",
              method: 'POST',
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
              success: function(data){
                if (data == 'DONE') {
                    logActions('Deleted Uploads with ID: '+id);
                    alert('Successfully deleted '+name);
                    window.location.href = "{{ asset('/employee/dashboard/mf/uploads') }}";
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
                  var TestRequired = ($('#new_required').is(":checked") == true) ? 1 : 0;
                  var test = $.inArray(id,arr);
                  if (test == -1) { // Not in Array
                      $.ajax({
                        method: 'POST',
                        data: {
                          _token : $('#token').val(),
                          name : $('#new_rgn_desc').val(),
                          required : TestRequired,
                          office: $('#office').val(),
                          mod_id : $('#CurrentPage').val(),
                        },
                        success: function(data) {
                          if (data) {
                              logActions('Added new Uploads with ID: '+ data);
                              alert('Successfully Added New Upload');
                              window.location.href = "{{ asset('employee/dashboard/mf/uploads') }}";
                          } else if (data == 'ERROR') {
                              $('#AddErrorAlert').show(100);
                          }
                        }, error : function (XMLHttpRequest, textStatus, errorThrown){
                            console.log(errorThrown);
                            $('#AddErrorAlert').show(100);
                        }
                    });
                  } else {
                    alert('Upload ID is already been taken');
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
                 var TestRequired = ($('#edit_required').is(":checked") == true) ? 1 : 0;
                 $.ajax({
                    url: "{{ asset('employee/mf/save_upload') }}",
                    method: 'POST',
                    data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val(),isRequiredNow : TestRequired,office: $('#officeedit').val()},
                    success: function(data){
                        if (data == "DONE") {
                            logActions('Edited Uploads with ID: '+$('#edit_name').val());
                            alert('Successfully Edited Upload');
                            window.location.href = "{{ asset('employee/dashboard/mf/uploads') }}";
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