@if (session()->exists('employee_login'))     
  @extends('mainEmployee')
  @section('title', 'Manage Facility Master File')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="AP010">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Manage Facilities <span class="AP010_add"><a href="" title="Add New" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>  
          </div>
          <div class="card-body">
            <div style="float:left;margin-bottom: 5px">
              <form class="form-inline">
                <label>Filter : &nbsp;</label>
                <input type="text" class="form-control" id="filterer" list="grp_list" onchange="filterGroup()" placeholder="Application Type">
                <datalist id="grp_list">
                  @if (isset($types))
                    @foreach ($types as $type)
                      <option value="{{$type->hfser_id}}">{{$type->hfser_desc}}</option>
                    @endforeach
                  @endif
                </datalist>
                &nbsp;
                </form>
             </div>
            <span id="showSucc">
            </span>
            <div class="table-responsive">
              <table class="table table-hover" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th style="width: 75%">Health Facility</th>
                    {{-- <th style="width: 35%"><center>Order of Payment</center></th> --}}
                    <th style="width: 25%"><center>Option</center></th>
                  </tr>
                </thead>
                <tbody id="FilterdBody">
                </tbody>
              </table>
              </div>
          </div>
      </div>
  </div>
  {{-- Add --}}
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body container" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Add Facility in Application</strong></h5>
            <hr>
            <form id="NewFacServIn" class="container" action="#" class="row" data-parsley-validate>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                <div class="row">
                  <div class="col-sm-4">Application :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;">
                   <select id="appID" data-parsley-required-message="*<strong>Application</strong> required" class="form-control" required>  
                          <option value="">Select Application ...</option>
                          @if(isset($types))
                            @foreach ($types as $type)
                              <option value="{{$type->hfser_id}}">{{$type->hfser_desc}}</option>
                            @endforeach
                          @endif
                      </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">Facility :</div>
                  <div class="col-sm-8" style="margin:0 0 .8em 0;" >
                   <select id="FacServID" data-parsley-required-message="*<strong>Facility/Service</strong> required" class="form-control" required>  
                          <option value="">Select Facility/Service ...</option>
                          @if (isset($facilitys))
                            @foreach ($facilitys as $facility)
                              <option value="{{$facility->hgpid}}">{{$facility->hgpdesc}}</option>
                            @endforeach
                          @endif
                      </select>
                  </div>
                </div>
                <div class="col-sm-12">
                  <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add Facility/Service</button>
                </div>
              </form>
          </div>
        </div>
      </div>
  </div>
  {{-- Delete --}}
  <div class="modal fade" id="IfActiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body text-justify" style=" background-color: #272b30;
        color: white;">
            <h5 class="modal-title text-center"><strong><span id="ifActiveTitle">Remove Facility</span></strong></h5>
            <hr>
            <div class="container">
              <form  id="AddOOP" class="row" data-parsley-validate>
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DeleteErrorAlert" role="alert">
                      <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                      <button type="button" class="close" onclick="$('#DeleteErrorAlert').hide(1000);" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
                <div class="col-sm-12" id="Error">
                  <p>Are you sure you want to delete <span style="font-weight: bold;color:red" id="selectedFacility"></span> from <span style="font-weight: bold;color:red" id="selectedTypeX"></span>? </p>
                  <p style="font-weight: bold;color:red">*Deleting this may remove its requirements.</p>
                  <input type="text" id="ToBeRemovedFacility" hidden="" value="">
                </div>
                <div class="col-sm-12">
                  <hr>
                  <div class="row">
                    <div class="col-sm-6">
                      <button type="submit" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Remove</button>
                    </div>
                    <div class="col-sm-6">
                      <button type="button" data-dismiss="modal" class="btn btn-outline-warning form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                    </div>
                  </div>
                </div> 
              </form>
           </div>
          </div>
        </div>
      </div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function() {$('#example').DataTable();});
  	function filterGroup(){
          var id = $('#filterer').val();
          var token = $('#token').val();
          $.ajax({
                  url: " {{asset('employee/mf/get_managefacility')}}",
                  method: 'POST',
                  data: {
                    _token : token,
                    hfser_id : id,
                  },
                  success: function(data) {
                    if (data == 'NONE') {
                      $('#example').DataTable().clear().draw();
                    } else {
                      $('#FilterdBody').empty();
                      $('#example').DataTable().clear().draw();
                      for (var i = 0; i < data.length; i++) {
                        var option = "", settings = "", addOOP = "";
                        $('#example').DataTable().row.add([
                              data[i].hgpdesc,
                              '<center><span class="AP010_cancel"><button class="btn btn-outline-danger" data-toggle="modal" data-target="#IfActiveModal" onclick="ShowDelete('+data[i].tyf_id+', \''+data[i].hgpdesc+'\', \''+data[i].hfser_desc+'\')"><i class="fa fa-fw fa-trash"></i></button></span></center>'])
                        .draw();
                      }
                      GroupRightsActivate();
                    }
                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    console.log(errorThrown);
                    $('#ERROR_MSG2').show();
                  }
              });
        }
      function ShowDelete(id, faciname, typename){
          // selectedFacility, selectedTypeX, ToBeRemovedFacility
          $('#ToBeRemovedFacility').val('');
          $('#ToBeRemovedFacility').val(id);

          $('#selectedFacility').text('');
          $('#selectedFacility').text(faciname);

          $('#selectedTypeX').text('');
          $('#selectedTypeX').text(typename);
      }
      $('#NewFacServIn').on('submit',function(event){
        event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
            $.ajax({
                    method: 'POST',
                    data: {_token:$('input[name="_token"]').val(),hfser_id:$('#appID').val(),facid:$('#FacServID').val()},
                    success: function(data) {
                      if (data == 'DONE') {
                          alert('Successfully Added New Facility in an Application');
                          window.location.href = "{{ asset('employee/dashboard/mf/manage/facilities') }}";
                      } else if (data == 'SAME') {
                          alert('Facility is already in the selected Application');
                          $('#FacServID').focus();
                      } else if (data == 'ERROR') {
                          $('#AddErrorAlert').show(100);
                      }
                    }, error : function (XMLHttpRequest, textStatus, errorThrown){
                      console.log(errorThrown);
                      $('#AddErrorAlert');
                    }
                });
        }
      });
      $('#AddOOP').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
            $.ajax({
                url : '{{ asset('employee/mf/del_managefacility') }}',
                method : 'POST',
                data : {_token : $('#token').val(), id : $('#ToBeRemovedFacility').val()},
                success : function(data){
                  if (data == 'DONE') {
                    alert('Successfully deleted a facility');
                    $('#IfActiveModal').modal('toggle');
                    filterGroup();
                  }
                  else if(data == 'ERROR'){
                      $('#DeleteErrorAlert').show(100);
                  }
                },
                error : function(a,b,c){
                  console.log(c);
                  $('#DeleteErrorAlert').show(100);
                }
            });
          }
        });
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif