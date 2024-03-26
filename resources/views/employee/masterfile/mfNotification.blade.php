@if (session()->exists('employee_login'))    
  @extends('mainEmployee')
  @section('title', 'Notification Master File')
  @section('content')
  {{-- <input type="text" id="CurrentPage" hidden="" value="OH003"> --}}
  <div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Notification
        </div>
        <div class="card-body">
            <table class="table display" id="example" style="overflow-x: scroll;" >
        <thead>
          <tr>
            <th>ID</th>
            <th>Notification Description</th>
            <th><center>Options</center></th>
          </tr>
        </thead>
        <tbody>
          @if (isset($notifAll))
            @foreach ($notifAll as $no)
            <tr>
              <td scope="row"> {{$no->msg_code}}</td>
              <td>{{$no->msg_desc}}</td>
              <td>
              <center>
                <button type="button" class="btn btn-outline-warning" onclick="showData('{{$no->msg_code}}', '{{addslashes($no->msg_desc)}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
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
    <div class="modal fade" id="GodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center"><strong>Edit Team</strong></h5>
            <hr>
            <div>
                <form id="EditNow" method="POST" data-parsley-validate>
                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="EditErrorAlert" role="alert">
                  <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                  <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div> 
                <span id="EditBody">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        Description
                      </div>
                       <div class="col-md-12 p-3">
                        <input type="text" class="form-control" name="msg_desc">
                        <input type="hidden" class="form-control" name="msg_code">
                        <input type="hidden" class="form-control" name="action" value="edit">
                        {{csrf_field()}}
                      </div>
                    </div>
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
  <script>
    $(document).ready(function(){
      $('#example').DataTable();
    })

    function showData(id,desc){
      $('[name=msg_desc]').val(desc);
      $('[name=msg_code]').val(id);
    }
   
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif