@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'FDA Pharmacy Charges')
  @section('content')
   <input type="text" id="CurrentPage" hidden="" value="FD005">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             FDA Pharmacy Charges <span class="#"><a href="#" title="Add FDA Pharmacy Charges" data-toggle="modal" data-target="#myModal">
          </a></span>
          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th class="text-center">Charge Name</th>
                    <th>Amount per Count</th>
                    <th>Renewal Amount per Count</th>
                    <th>Options</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $charges)
                  <tr>
                    <td>{{$charges->chargeName}}</td>
                    <td>{{$charges->price}}</td>
                    <td>{{$charges->price_renew}}</td>
                    <td>
                      <span class="FD005_update">
                        <button type="button" class="btn btn-outline-warning" onclick="showData('{{$charges->chargeID}}', '{{$charges->chargeName}}','{{$charges->price}}','{{$charges->price_renew}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
                      </span>
                    </td>
                  </tr>
                  @endforeach
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
              <h5 class="modal-title text-center"><strong>Add FDA Pharmacy Charges</strong></h5>
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
                  <div class="col-sm-4">FDA Pharmacy Charges:</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                  <input type="text" name="name" id="name" data-parsley-required-message="*<strong>FDA Pharmacy Charges Name</strong> required" class="form-control"  required>
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
            <h5 class="modal-title text-center"><strong>Edit FDA Pharmacy Charges</strong></h5>
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
            <h5 class="modal-title text-center"><strong>Delete FDA Pharmacy Charges</strong></h5>
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
    function showData(id,desc,price, price_renew){
            $('#EditBody').empty();
            $('#EditBody').append(
              '<input type="hidden" id="eid" value="'+id+'" data-parsley-required-message="*<strong>ID</strong> required" class="form-control"  required>'+
               ' <div class="col-sm-9">'+desc+' Initial New Charge:</div>'+
                 ' <div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                 ' <input type="text" id="ename" name="ename" value="'+price+'" id="name" data-parsley-required-message="*<strong>FDA Pharmacy Initial New Charges Name</strong> required" class="form-control"  required>'+
                  '</div>'+

                  ' <div class="col-sm-9">'+desc+' Renewal Charge:</div>'+
                 ' <div class="col-sm-12" style="margin:0 0 .8em 0;">'+
                 ' <input type="text" id="ename_renew" name="ename_renew" value="'+price_renew+'" id="name" data-parsley-required-message="*<strong>FDA Pharmacy Renewal Charges Name</strong> required" class="form-control"  required>'+
                  '</div>'+

                 ' <input type="hidden" name="action" value="edit">'
              );
          }

      $('#EditNow').on('submit',function(event){
            event.preventDefault();
              var form = $(this);
              form.parsley().validate();
               if (form.parsley().isValid()) {
                 var desc = $('#ename').val();
                 var desc_renew = $('#ename_renew').val();
                 var id = $("#eid").val();
                 $.ajax({
                    method: 'POST',
                    data : 
                    {
                      _token:$('#token').val(),
                      id:id,
                      ename:desc,
                      ename_renew:desc_renew,
                      mod_id : $('#CurrentPage').val(), 
                      action: 'edit'
                  },
                    success: function(data){
                        if (data == "DONE") {
                            alert('Successfully Edited FDA Pharmacy Charges');
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