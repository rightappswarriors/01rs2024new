@if (session()->exists('employee_login'))       
  @extends('mainEmployee')
  @section('title', 'System Logs - Manage')
  @section('content')
  <div class="content p-4">
      {{-- <datalist id="rgn_list">
        @if (isset($Chrges))
          @foreach ($Chrges as $Chrge)
          <option value="{{$Chrge->chg_code}}">{{$Chrge->chg_desc}}</option>
        @endforeach
        @endif
      </datalist> --}}
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             System Logs {{-- <span class="MA"><a href="#" title="Add New Charges" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span> --}}
              
          </div>
          <div class="card-body">
                 <table class="table display" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th style="width: auto">Code</th>
                    <th style="width: auto">User</th>
                    <th style="width: auto">Region</th>
                    <th style="width: auto">Date and Time</th>
                    <th style="width: auto"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                  @if(isset($results))
                  @foreach ($results as $result)
                    <tr>
                      <td scope="row" style="font-weight: bold"> {{$result['code']}}</td>
                      <td>{{$result['name']}}</td>
                      <td>{{$result['region']}}</td>
                      <td data-order="{{$result['datetime']}}">{{$result['formmatedDate']}} {{$result['formattedTime']}}</td>
                      <td>
                        <center>
                          <span >
                            <button type="button" class="btn btn-outline-primary" onclick="showData('{{rawurlencode($result['content'])}}', '{{$result['code']}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>
                          </span>
                          {{-- <span>
                            <button type="button" class="btn-defaults" onclick="showDelete('{{$Chrge->chg_code}}', '{{$Chrge->chg_desc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                          </span> --}}
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
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong id="ErrName"></strong></h5>
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
                      <span id="EditBody"></span>
                      <div class="row">
                        <div class="col-sm-6">
                        {{-- <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button> --}}
                      </div> 
                      <div class="col-sm-6">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
                      </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
  <script type="text/javascript">
     $(document).ready(function() {
            $('#example').DataTable({"order": [[ 3, "desc" ]]});
        });
    function showData(message,code){
      // var final = message.replace(/\\/g,"/");
      // console.log(JSON.stringify(message));
      var decodeMessage = decodeURIComponent(message);
      // var final = escape(message);
      $('#ErrName').empty();
      $('#ErrName').append(code);
      $('#EditBody').empty();
      $('#EditBody').append(
          '<div class="col-sm-4">Error Message:</div>' +
          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
            '<textarea rows="10" type="text" id="edit_name"  class="form-control disabled" disabled>'+decodeMessage+'</textarea>' +
          '</div>'
        );
    } 
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif