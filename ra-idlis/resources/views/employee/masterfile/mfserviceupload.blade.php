@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Services Upload')
  @section('content')
   <input type="text" id="CurrentPage" hidden="" value="FD007">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($mach))
          @foreach ($mach as $xray)
            <option value="{{$xray->xrayid}}">{{$xray->xrayid}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Services Upload <span class="#"><a href="#" title="Add New Services Upload" data-toggle="modal" data-target="#myModal">
              <span class="FD007_add">
                <button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button>
              </span>
          </a></span>
          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th>Facility Service Type</th>
                    <th>Service Capabilities</th>
                    <th>Display Name</th>
                    <th>Uploaded File</th>
                    <th style="width: 25%"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($data))
                  @foreach ($data as $xray)
                    <tr>
                      <td>{{$xray->hfser_desc}} ({{$xray->hfser_id}})</td>
                      <td>{{$xray->facname}}</td>
                      <td>{{$xray->displayname}}</td>
                      <td><a target="_blank" href="{{ route('OpenFile', $xray->filename)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a></td>
                      <td>
                        <center>
                          <span class="FD007_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$xray->facilitytypUploadid}}', '{{$xray->hfser_id}}', '{{$xray->facid}}', '{{$xray->displayname}}','{{$xray->filename}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="FD007_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$xray->facilitytypUploadid}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
              <h5 class="modal-title text-center"><strong>Add New Service Upload</strong></h5>
              <hr>
              <div class="container">
                <form id="addRgn" enctype="multipart/form-data" class="row"  data-parsley-validate>
                  {{ csrf_field() }}
                  <input type="hidden" name="action" value="add">
                  <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div> 
                  <div class="col-sm-5">Facility Service Type:</div>
                  <div class="col-sm-7" style="margin:0 0 .8em 0;">
                  <select name="hfser_id" class="form-control" data-parsley-required-message="*<strong>Facility Service Type</strong> required" required>
                  	<option value="" selected="" disabled="" hidden readonly>Please Select</option>
                  	@foreach($type as $fa)
                  		<option value="{{$fa->hfser_id}}">{{$fa->hfser_desc}}</option>
                  	@endforeach
                  </select>
                  </div>

                  <div class="col-sm-5">Service Capabilities:</div>
                  <div class="col-sm-7" style="margin:0 0 .8em 0;">
                  <select name="facid" class="form-control" data-parsley-required-message="*<strong>Service Capability</strong> required" required>
                  	<option value="" selected="" disabled="" hidden readonly>Please Select</option>
                  	@foreach($facilities as $fac)
                  		<option value="{{$fac->facid}}">{{$fac->facname}}</option>
                  	@endforeach
                  </select>
                  </div>

                  <div class="col-sm-5">Display Name:</div>
                  <div class="col-sm-7" style="margin:0 0 .8em 0;">
                 	<input name="dname" required class="form-control" data-parsley-required-message="*<strong>Display Name</strong> required">
                  </div>

                  <div class="col-sm-5">Upload file:</div>
                  <div class="col-sm-7" style="margin:0 0 .8em 0;">
                  	<input type="file" required class="form-control" name="upload" data-parsley-required-message="*<strong>Display Name</strong> required">
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
            <h5 class="modal-title text-center"><strong>Edit Services Upload</strong></h5>
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
                  	{{csrf_field()}}

                  	<div class="col-sm-12">Facility Service Type:</div>
	                  <div class="col-sm-12" style="margin:0 0 .8em 0;">
	                  <select name="edithfser_id" class="form-control" data-parsley-required-message="*<strong>Facility Service Type</strong> required" required>
	                  	<option value="" selected="" disabled="" hidden readonly>Please Select</option>
	                  	@foreach($type as $fa)
	                  		<option value="{{$fa->hfser_id}}">{{$fa->hfser_desc}}</option>
	                  	@endforeach
	                  </select>
	                  </div>

	                  <div class="col-sm-12">Service Capabilities:</div>
	                  <div class="col-sm-12" style="margin:0 0 .8em 0;">
	                  <select name="editfacid" class="form-control" data-parsley-required-message="*<strong>Service Capability</strong> required" required>
	                  	<option value="" selected="" disabled="" hidden readonly>Please Select</option>
	                  	@foreach($facilities as $fac)
	                  		<option value="{{$fac->facid}}">{{$fac->facname}}</option>
	                  	@endforeach
	                  </select>
	                  </div>

	                  <div class="col-sm-12">Display Name:</div>
	                  <div class="col-sm-12" style="margin:0 0 .8em 0;">
	                 	<input name="editdname" required class="form-control" data-parsley-required-message="*<strong>Display Name</strong> required">
	                  </div>

	                  <div class="col-sm-12">Upload file:</div>
	                  <div class="col-sm-12" style="margin:0 0 .8em 0;">
	                  	<input type="hidden" name="action" value="edit">
	                  	<input type="hidden" name="oldFilename">
	                  	<input type="hidden" name="id">
	                  	<input type="file" class="form-control" name="upload">
	                  </div>
                    
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
            <h5 class="modal-title text-center"><strong>Delete Services Upload</strong></h5>
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
  	function showData(id,hf,faci,dname,oldfilename){
  		let arrDom = ['input[name=id]','select[name=edithfser_id]','select[name=editfacid]','input[name=editdname]','input[name=oldFilename]'];
  		let arrValue = [id,hf,faci,dname,oldfilename];

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
              '</div>'
            );
      }
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
                          alert('Successfully Added New Services Upload');
                          location.reload();
                      } else if (data == 'ERROR'){
                        $('#AddErrorAlert').show(100);
                      }
                    }, error : function(XMLHttpRequest, textStatus, errorThrown){
                        console.log(errorThrown);
                        $('#AddErrorAlert').show(100);
                    },
                });
              }
          });
      $('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              form.parsley().validate();
               if (form.parsley().isValid()) {
               	var data = new FormData(this);
                 var desc = $('#descEdit').val();
                 var id = $("#id").val();
                 $.ajax({
                   	type: 'POST',
					contentType: false,
    				processData: false,
                    data: data,
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Services Upload');
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