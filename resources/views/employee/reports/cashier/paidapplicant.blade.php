@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Paid Applicants Report')
  @section('content')
 {{-- <input type="text" id="CurrentPage" hidden="" value="RDC001">  --}}
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">
             Listing of Paid Application
          </div>
          <div class="card-body table-responsive">
          	<table class="table table-hover" style="font-size:13px;" id="example">
                  <thead>
                  <tr>
                      <th scope="col">Application ID</th>
                      <th scope="col">Facility Name</th>
                      <th scope="col">Address</th>
                      <th scope="col">Type of Facility</th>
                      <th scope="col">Paid?</th>                      
                      <th scope="col">Confirmed By</th>
                      <th scope="col">Confirmed Date</th>
                      <th scope="col">Application Type</th>
                  </tr>
                  </thead>
                  <tbody id="FilterdBody">
                    @isset($servCap)
                      @foreach($servCap as $serv)
                      <tr>
                        <td class="font-weight-bold">{{$serv->hfser_id .'R'.$serv->rgnid.'-'.$serv->appid}}</td>
                        <td>{{$serv->facilityname}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
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