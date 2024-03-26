@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'View Facilities with Assessment tool')
  @section('content')
  {{-- <input type="text" id="CurrentPage" hidden="" value="RMF001">  --}}
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">
             Assessment tool
          </div>
          <div class="card-body table-responsive">
          	<table class="table table-hover" style="font-size:13px;" id="example">
                  <thead>
                  <tr>
                      <th scope="col">Facility Code</th>
                      <th scope="col">Facility Name</th>
                      <th class="text-center" scope="col">Options</th>
                  </tr>
                  </thead>
                  <tbody id="FilterdBody">
                    @isset($servCap)
                      @foreach($servCap as $serv)
                      <tr>
                        <td class="font-weight-bold">{{$serv->facid}}</td>
                        <td>{{$serv->facname}}</td>
                        <td>
                          <center>
                              <a class="btn btn-primary" href="{{url('employee/reports/masterfile/assessment/'.$serv->facid.'/'.$serv->hfser_id)}}"><i class="fa fa-fw fa-eye"></i></a>
                            </center>
                        </td>
                      </tr>
                      @endforeach
                    @endisset
                  </tbody>
              </table>
          </div>
  	</div>
  </div>
  <script>
    $(document).ready(function() {$('#example').DataTable();});
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif