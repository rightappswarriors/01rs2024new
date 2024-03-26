@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Branch Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="OH003">
  <div class="content p-4">
      <datalist id="rgn_list">
        @if (isset($inBranch))
          @foreach ($inBranch as $inBranchs)
            <option value="{{$inBranchs->regionid}}">{{$inBranchs->rgn_desc}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Branchs <span class="OH003_add"><a href="#" title="Add New Branch" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>

          </div>
          <div class="card-body">
            <div class="container table-responsive">
                 <table class="table" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th>Region ID</th>
                    <th>Name</th>
                    <th>Director</th>
                    <th>Position</th>
                    <th>PTC</th>
                    <th>LTO</th>
                    <th>COR</th>
                    <th>CON</th>
                    <th>CON Bed</th>
                    <th>ATO</th>
                    <th>COA</th>
                    <th>Print Setting(x)</th>
                    <th>Print Setting(y)</th>
                    <th>In Certificate Name</th>
                    <th><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
					@foreach($inBranch as $in)
	                  <tr>
	                  	<td>{{$in->regionid}}</td>
	                  	<td>{{$in->name}}</td>
	                  	<td>{{$in->directorInRegion}}</td>
	                  	<td>{{$in->pos}}</td>
	                  	<td>{{$in->PTC}}</td>
	                  	<td>{{$in->LTO}}</td>
	                  	<td>{{$in->COR}}</td>
	                  	<td>{{$in->CON}}</td>
                      <td>{{$in->conBed}}</td>
	                  	<td>{{$in->ATO}}</td>
	                  	<td>{{$in->COA}}</td>
	                  	<td>{{$in->orprint_x}}</td>
	                  	<td>{{$in->orprint_y}}</td>
                      <td>{{$in->certificateName}}</td>
	                  	<td>
  	                      <center>
                          <span class="OH003_update">
  	                        <button type="button" class="btn btn-outline-warning" onclick="showData('{{$in->regionid}}', '{{$in->name}}', '{{$in->directorInRegion}}','{{$in->PTC}}','{{$in->LTO}}','{{$in->COR}}','{{$in->CON}}','{{$in->conBed}}','{{$in->ATO}}','{{$in->COA}}','{{$in->pos}}','{{$in->orprint_x}}','{{$in->orprint_y}}', '{{$in->certificateName}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
                          </span>
                          <span class="OH003_cancel">
  	                        <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$in->regionid}}', '{{$in->name}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                          </span>
  	                      </center>
  	                    </td>
	                  </tr>
	                @endforeach  
                </tbody>
              </table>
            </div>
          </div>
      </div>
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;
      color: white;">
          <h5 class="modal-title text-center"><strong>Add New Branch</strong></h5>
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
              <div class="col-sm-4">Region ID:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <select name="rgnid" id="rgnid" data-parsley-required-message="*<strong>Region ID</strong> required"  class="form-control"  required>
              	@foreach($notIn as $list)
              		<option value="{{$list->rgnid}}">{{$list->rgn_desc}}</option>
              	@endforeach
              </select>
              </div>
              <div class="col-sm-4">Team Name:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" id="tname" name="tname" class="form-control" data-parsley-required-message="*<strong>Team name</strong> required" required>
              </div>
              <div class="col-sm-4">Director:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" name="dir" id="dir" class="form-control" data-parsley-required-message="*<strong>Director</strong> required" required>
              </div>
              <div class="col-sm-4">Position:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" id="pos" name="pos" class="form-control">
              </div>
              <div class="col-sm-4">PTC Seq #:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="number" id="ptc" name="ptc" class="form-control">
              </div>
              <div class="col-sm-4">LTO Seq #:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="number" id="lto" name="lto" class="form-control">
              </div>
              <div class="col-sm-4">COR Seq #:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="number" id="cor" name="cor" class="form-control">
              </div>
              <div class="col-sm-4">CON Seq #:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="number" id="con" name="con" class="form-control">
              </div>
              <div class="col-sm-4">CON Bed:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="number" id="conBed" name="conBed" class="form-control">
              </div>
              <div class="col-sm-4">ATO Seq #:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="number" id="ato" name="ato" class="form-control">
              </div>
              <div class="col-sm-4">COA Seq #:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="number" id="coa" name="coa" class="form-control">
              </div>
              <div class="col-sm-4">OR Print (x):</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="number" id="orx" name="orx" class="form-control">
              </div>
              <div class="col-sm-4">OR Print (y):</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="number" id="ory" name="ory" class="form-control">
              </div>
              <div class="col-sm-4">Certificate Name:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" id="cname" name="cname" class="form-control">
              </div>
              <div class="col-sm-12">
                <button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New Branch</button>
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
            <h5 class="modal-title text-center"><strong>Edit Branch</strong></h5>
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
                <h5 class="modal-title text-center"><strong>Delete Branch</strong></h5>
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
  	function showData(id,p1,p2,p3,p4,p5,p6,p12,p7,p8,p9,p10,p11,p13){
        $('#EditBody').empty();
        $('#EditBody').append(
            '<div class="col-sm-4">Team Name:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '{{csrf_field()}}'+
              '<input type="hidden" value="edit" name="action" class="form-control" data-parsley-required-message="*<strong>ID</strong> required" required>'+
              '<input type="hidden" value="'+id+'" id="id" name="id" class="form-control" data-parsley-required-message="*<strong>ID</strong> required" required>'+
              '<input type="text" value="'+p1+'" id="tname" name="tname" class="form-control" data-parsley-required-message="*<strong>Team name</strong> required" required>'+
              '</div>'+
              '<div class="col-sm-4">Director:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="text" value="'+p2+'" name="dir" id="dir" class="form-control" data-parsley-required-message="*<strong>Director</strong> required" required>'+
              '</div>'+
              '<div class="col-sm-4">Position:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="text" value="'+p9+'" id="pos" name="pos" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">PTC Seq #:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="number" value="'+p3+'" id="ptc" name="ptc" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">LTO Seq #:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="number" value="'+p4+'" id="lto" name="lto" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">COR Seq #:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="number" value="'+p5+'" id="cor" name="cor" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">CON Seq #:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="number" value="'+p6+'" id="con" name="con" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">CON Bed:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="number" value="'+p12+'" id="conBed" name="conBed" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">ATO Seq #:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="number" value="'+p7+'" id="ato" name="ato" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">COA Seq #:</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="number" value="'+p8+'" id="coa" name="coa" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">OR Print (x):</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="number" value="'+p10+'" id="orx" name="orx" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">OR Print (y):</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="number" value="'+p11+'" id="ory" name="ory" class="form-control">'+
              '</div>'+
              '<div class="col-sm-4">In-Certificate name display (y):</div>'+
              '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
              '<input type="text" value="'+p13+'" id="cname" name="cname" class="form-control">'+
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
              data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val(),action:'delete'},
              success: function(data){
                if (data == 'DONE') {
                  alert('Successfully deleted '+name);
                  location.reload();
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
                 var data = $(this).serialize();
                  $.ajax({
                    method: 'POST',
                    data: data,
                    success: function(data) {
                      if (data == 'DONE') {
                          alert('Successfully Added New Branch');
                          location.reload();
                      } else if (data == 'ERROR') {
                        $('#AddErrorAlert').show(100);
                      }
                    },
                    error : function(XMLHttpRequest, textStatus, errorThrown) {
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
                 let data = $(this).serialize();
                 $.ajax({
                    method: 'POST',
                    data : data,
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited Branch');
                            location.reload();
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