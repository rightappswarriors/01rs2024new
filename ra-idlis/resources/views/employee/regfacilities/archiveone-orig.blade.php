<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('employee.regfacilities.template-regfacility')
  @section('title', 'Archive Facility')
  @section('content-regfacility')
  
<!---------------------------------->
  		    <div class="card-header bg-white font-weight-bold">             

              <div class="row">
                <input type="" id="token" value="{{ Session::token() }}" hidden>
                  <a class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" href="{{asset('/employee/dashboard/facilityrecords/archive')}}">Back</a>&nbsp;
                
                  <a href="#" title="Add New Services Upload" data-toggle="modal" data-target="#myModal">
                      <button type="button" class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold"><i class="fa fa-plus-circle"></i>&nbsp;Add Files</button>
                  </a>

                  <a href="#" title="Archive Settings" data-toggle="modal" data-target="#myModalSettings">
                      <button type="button" class="btn btn-default  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold"><i class="fas fa-fw fa-cog"></i>&nbsp;Archive Settings</button>
                  </a>
              </div>
          
          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th>Line No.</th>
                    <th>Record Type</th>
                    <th>Description</th>
                    <th>Uploaded File</th>
                    <th style="width: 25%"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($data ))
                  @php $i=0; @endphp
                  @foreach ($data as $key)
                    <tr>
                      <td>{{++$i}}</td>
                      <td>{{$key->rectype_desc}}<br/><br/><small>[Archive ID {{$key->rfa_id}}]</small></td>
                      <td>
                        {{$key->description}}
                      </td>
                      <td>
                        <a target="_blank" href="{{ route('OpenFile', $key->filename)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i>{{$key->filename}}</a>
                        <small>
                          <br/>Created On {{$key->created_at}} By {{$key->created_by}}
                          <br/>Updated On {{$key->updated_at}} By {{$key->updated_by}}
                          <br/>IP Address: {{$key->ipaddress}} 
                        </small>                        
                      </td>
                      <td>
                        <center>
                          <span class="FD007_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$key->rfa_id}}', '{{$key->regfac_id}}', '{{$key->rectype_id}}', '{{$key->description}}','{{$key->savelocation}}','{{$key->filename}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="FD007_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$key->rfa_id}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                          </span>
                        </center>
                      </td>
                    </tr>
                  @endforeach
                  @endif
                </tbody>
              </table>
          </div>

  <div class="modal fade" id="myModalSettings" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Manage Archive Settings</strong></h5>
              <hr>
              <div class="container">
                  <form id="ArchiveSettings"  data-parsley-validate>
                    <div class="row">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="settings">
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                          <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                          <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                        </div> 

                        <div class="col-sm-3">Diretory Path:</div>
                        <div class="col-sm-9" style="margin:0 0 .8em 0;">
                          <input type="file" webkitdirectory = "true"  directory/>
                          <input name="archive_loc" value="@isset($archive_loc){{$archive_loc}}@endisset" required class="form-control" data-parsley-required-message="*<strong>Display Name</strong> required">
                        </div>

                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                        </div>
                    </div> 
                  </form>
             </div>
            </div>
          </div>
        </div>
        
  </div>

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Add New File Upload</strong></h5>
              <hr>
              <div class="container">
                  <form id="addRgn"  data-parsley-validate>
                    <div class="row">
                        {{ csrf_field() }}
                        <input type="hidden" name="action" value="add">
                        <input type="hidden" name="regfac_id" value="{{$user->regfac_id}}">
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                          <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                          <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                        </div> 

                        <div class="col-sm-5">File Type:</div>
                        <div class="col-sm-7" style="margin:0 0 .8em 0;">
                          <select name="rec" class="form-control" data-parsley-required-message="*<strong>Facility Service Type</strong> required" required>
                            <option value="" selected="" disabled="" hidden readonly>Please Select</option>
                            @foreach($recordtype as $fa)
                              <option value="{{$fa->rectype_id}}">{{$fa->rectype_desc}}</option>
                            @endforeach
                          </select>
                        </div>

                        <div class="col-sm-5">Description:</div>
                        <div class="col-sm-7" style="margin:0 0 .8em 0;">
                          <input name="dname" required class="form-control" data-parsley-required-message="*<strong>Display Name</strong> required">
                        </div>

                        <div class="col-sm-5">Upload file:</div>
                        <div class="col-sm-7" style="margin:0 0 .8em 0;">
                          <input type="file" required class="form-control" name="upload" data-parsley-required-message="*<strong>Display Name</strong> required">
                        </div>

                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
                        </div>
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
            <h5 class="modal-title text-center"><strong>Edit File Upload</strong></h5>
            <hr>
            <div class="container">
                <form id="EditNow" data-parsley-validate>
                    {{@csrf_field()}}
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="EditErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                  <span id="EditBody">

                  	<div class="col-sm-12">File Type:</div>
	                  <div class="col-sm-12" style="margin:0 0 .8em 0;">
                      <select name="editrec" class="form-control" data-parsley-required-message="*<strong>Facility Service Type</strong> required" required>
                        <option value="" selected="" disabled="" hidden readonly>Please Select</option>
                        @foreach($recordtype as $fa)
                          <option value="{{$fa->rectype_id}}">{{$fa->rectype_desc}}</option>
                        @endforeach
                      </select>
	                  </div>

	                  <div class="col-sm-12">Description:</div>
	                  <div class="col-sm-12" style="margin:0 0 .8em 0;">
	                 	  <input name="editdname" required class="form-control" data-parsley-required-message="*<strong>Display Name</strong> required">
	                  </div>

	                  <div class="col-sm-12">Upload file:</div>
	                  <div class="col-sm-12" style="margin:0 0 .8em 0;">
	                  	<input type="hidden" name="action" value="edit">
	                  	<input type="hidden" name="editregfac_id">
	                  	<input type="text" name="editoldfileloc">
	                  	<input type="text" name="editoldfilename">
	                  	<input type="hidden" name="id">
	                  	<input type="file" class="form-control" name="upload">
	                  </div>
                    
                  </span>
                  <div class="row">
                    <div class="col-sm-6">
                    <button type="submit" class="btn btn-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
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
            <h5 class="modal-title text-center"><strong>Delete Archive Upload</strong></h5>
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

      $('#ArchiveSettings').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();

          if (form.parsley().isValid()) {
            var data = new FormData(this);
            $.ajax({
              type: 'POST',
              contentType: false,
              processData: false,
              data: data,
              success: function(data) {
                if (data == 'DONE') {
                    alert('Successfully Added New Archive Upload');
                    location.reload();
                } else if (data == 'ERROR'){
                    $('#AddErrorAlert').show(100);
                }
              }, error : function(XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#AddErrorAlert').show(100);
              }
            });
          }
      });

      $('#addRgn').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();

          if (form.parsley().isValid()) {
            var data = new FormData(this);
            $.ajax({
              type: 'POST',
              contentType: false,
              processData: false,
              data: data,
              success: function(data) {
                if (data == 'DONE') {
                    alert('Successfully Added New Archive Upload');
                    location.reload();
                } else if (data == 'ERROR'){
                    $('#AddErrorAlert').show(100);
                }
              }, error : function(XMLHttpRequest, textStatus, errorThrown){
                  console.log(errorThrown);
                  $('#AddErrorAlert').show(100);
              }
            });
          }
      });

      $('#EditNow').on('submit',function(event){
        event.preventDefault();
        var form = $(this);
        form.parsley().validate();

        if (form.parsley().isValid()) {
          var data = new FormData(this);
          var id = $("#id").val();
          $.ajax({
            type: 'POST',
            contentType: false,
            processData: false,
            data: data,
            success: function(data){
                if (data == "DONE") {
                    alert('Successfully Edited Archive Upload');
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

      function showData(id,rec,dname,oldfileloc,oldfilename){
        let arrDom = ['input[name=id]','input[name=editregfac_id]','select[name=editrec]','input[name=editdname]','input[name=editoldfileloc]','input[name=editoldfilename]'];
        let arrValue = [id,rec,dname,oldfileloc,oldfilename];

          arrDom.forEach(function(index, el) {
            if($(index).length > 0){
              $(index).val(arrValue[el]);
            }
          });            
      }
      
      function showDelete (id){
        $('#DelModSpan').empty();
        $('#DelModSpan').append(
            '<div class="col-sm-12"> Are you sure you want to delete this data?' +
            '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
            '</div>' );
      }

      function deleteNow(){
        var id = $("#toBeDeletedID").val();
        $.ajax({
          method: 'POST',
          data: {
            _token:$('#token').val(),
            id:id,
            mod_id : $('#CurrentPage').val(), 
            action: 'delete'},
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />


<!-- https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js -->