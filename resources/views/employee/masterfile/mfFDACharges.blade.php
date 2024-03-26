@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'FDA Ranges')
  @section('content')
   <input type="text" id="CurrentPage" hidden="" value="FD010">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Range <span class="#"><a href="#" title="Add New FDA Range" data-toggle="modal" data-target="#myModal">
              <span class="FD010_add">
                <button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button>
              </span>
          </a></span>
          </div>
          <div class="card-body">
            <div class="container table-responsive">
              <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th>Charge Description</th>
                    <th>Range From</th>
                    <th>Range To</th>
                    <th>Initial Amount</th>
                    <th>Renewal Amount</th>
                    <th>1st Renewal</th>
                    <th>2nd Renewal</th>
                    <th>3rd Renewal</th>
                    <th>4th Renewal</th>
                    <th>5th Renewal</th>  
                    <th>Type</th>
                    <th style="width: 25%"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if (isset($Chgs))
                  @foreach ($Chgs as $apptypes)
                    <tr>
                      <td>{{$apptypes->fchg_desc}}</td>
                      <td>{{$apptypes->rangeFrom}}</td>
                      <td>{{$apptypes->rangeTo}}</td>
                      <td>{{$apptypes->initial_amnt}}</td>
                      <td>{{$apptypes->renewal_amnt}}</td>
                      <td>{{$apptypes->renewal_1}}</td>
                      <td>{{$apptypes->renewal_2}}</td>
                      <td>{{$apptypes->renewal_3}}</td>
                      <td>{{$apptypes->renewal_4}}</td>
                      <td>{{$apptypes->renewal_5}}</td>
                      <td>{{$apptypes->type}}</td>
                      <td>
                        <center>
                          <span class="FD010_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$apptypes->id}}', '{{$apptypes->fchg_desc}}', '{{$apptypes->rangeFrom}}', '{{$apptypes->rangeTo}}', '{{$apptypes->initial_amnt}}', '{{$apptypes->renewal_amnt}}', '{{$apptypes->renewal_1}}', '{{$apptypes->renewal_2}}', '{{$apptypes->renewal_3}}', '{{$apptypes->renewal_4}}', '{{$apptypes->renewal_5}}', '{{$apptypes->type}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                          </span>
                          <span class="FD010_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$apptypes->id}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
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
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body text-justify" style=" background-color: #272b30;
          color: white;">
              <h5 class="modal-title text-center"><strong>Add New Price Range</strong></h5>
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
                  <div class="col-sm-4">Charge Description:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" name="cdescadd" data-parsley-required-message="*<strong>Range From</strong> required" class="form-control"  required>
                  </div>
                  <div class="col-sm-4">Range From:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" name="rangeFrom" data-parsley-required-message="*<strong>Range From</strong> required" class="form-control"  required>
                  </div>
                  <div class="col-sm-4">Range To:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" name="rangeTo" class="form-control" data-parsley-required-message="*<strong>Range to</strong> required" required>
                  </div>
                  <div class="col-sm-4">Initial Amount:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" name="iaadd" class="form-control" data-parsley-required-message="*<strong>Initial amount </strong> required" required>
                  </div>
                  <div class="col-sm-4">Renewal Amount:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" name="raadd" class="form-control" data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>
                  </div>
                  <div class="col-sm-4">1st Renewal:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" name="fadd" class="form-control" data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>
                  </div>
                  <div class="col-sm-4">2nd Renewal:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" name="sadd" class="form-control" data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>
                  </div>
                  <div class="col-sm-4">3rd Renewal:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" name="tadd" class="form-control" data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>
                  </div>
                  <div class="col-sm-4">4th Renewal:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" name="fadd" class="form-control" data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>
                  </div>
                  <div class="col-sm-4">5th Renewal:</div>
                  <input type="hidden" value="add" name="action">
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="number" name="ffadd" class="form-control" data-parsley-required-message="*<strong>Renewal Payment Required </strong> required" required>
                  </div>                  
                  <div class="col-sm-4">Type:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <select id="typeadd" name="typeadd" class="form-control" data-parsley-required-message="*<strong>Type </strong> required" required>
                    <option value="c">Charge</option>
                    <option value="p">Payment</option>
                  </select>
                  </div>
                  {{-- <div class="col-sm-4">Remarks:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" id="new_rgn_rmk" class="form-control">
                  </div> --}}
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
            <h5 class="modal-title text-center"><strong>Edit FDA Range</strong></h5>
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
            <h5 class="modal-title text-center"><strong>Delete FDA Range</strong></h5>
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
  	function showData(id,desc,from,to,iamnt,ramnt,r1,r2,r3,r4,r5,type){
            $('#EditBody').empty();
            $('#EditBody').append(
              '{{csrf_field()}}'+
            	'<input type="hidden" name="idtoEdit" value="'+id+'" data-parsley-required-message="*<strong>ID</strong> required" class="form-control"  required>'+
                '<div class="col-sm-5">Charge Description:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="text" name="cdescadd" data-parsley-required-message="*<strong>Range From</strong> required" class="form-control" value="'+desc+'"  required>'+
                  '<input type="hidden" value="edit" name="action">'+
                  '</div>'+
                  '<div class="col-sm-4">Range From:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="number" name="rangeFrom" value="'+from+'" data-parsley-required-message="*<strong>Range From</strong> required" class="form-control"  required>'+
                  '</div>'+
                  '<div class="col-sm-4">Range To:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="number" name="rangeTo" value="'+to+'" class="form-control" data-parsley-required-message="*<strong>Range to</strong> required" required>'+
                  '</div>'+
                  '<div class="col-sm-4">Initial Amount:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="number" name="iaadd" class="form-control" value="'+iamnt+'" data-parsley-required-message="*<strong>Initial amount </strong> required" required>'+
                  '</div>'+
                  '<div class="col-sm-4">Renewal Amount:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="number" name="raadd" class="form-control" value="'+ramnt+'" data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>'+
                  '</div>'+
                  '<div class="col-sm-4">1st Renewal:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="number" name="fadd" class="form-control" value="'+r1+'" data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>'+
                  '</div>'+
                  '<div class="col-sm-4">2nd Renewal:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="number" name="sadd" class="form-control" value="'+r2+'" data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>'+
                  '</div>'+
                  '<div class="col-sm-4">3rd Renewal:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="number" name="tadd" class="form-control" value="'+r3+'" data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>'+
                  '</div>'+
                  '<div class="col-sm-4">4th Renewal:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="number" name="fadd" class="form-control" value="'+r4+'"  data-parsley-required-message="*<strong>Renewal Payment Required </strong> " required>'+
                  '</div>'+
                  '<div class="col-sm-4">5th Renewal:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<input type="number" name="ffadd" class="form-control" value="'+r5+'"  data-parsley-required-message="*<strong>Renewal Payment Required </strong> required" required>'+
                  '</div>'                  +
                  '<div class="col-sm-4">Type:</div>'+
                  '<div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                  '<select id="typeadd" name="typeadd" class="form-control" value="'+type+'" data-parsley-required-message="*<strong>Type </strong> required" required>'+
                    '<option value="C">Charge</option>'+
                    '<option value="P">Payment</option>'+
                  '</select>'+
                  '</div>'
              );
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
            data = $(this).serialize();
              $.ajax({
                method: 'POST',
                data: data,
                success: function(data) {
                  if (data == 'DONE') {
                      alert('Successfully Added New FDA Range');
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
            console.log($(this).serialize());
             $.ajax({
                method: 'POST',
                data : $(this).serialize(),
                success: function(data){
                    if (data == "DONE") {
                        alert('Successfully Edited FDA Range');
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
          data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val(), action: 'delete'},
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