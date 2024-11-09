@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Recommendation/Issuance Process Flow')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="FDAMR">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
            <h3>Recommendation/Issuance Certificate  ({{$request =='machines' ? 'Radiation Facility' : 'Pharmacy'}}) </h3>   
          </div>
          <form class="filter-options-form">
            @include('employee.FDA.FDAtableDataFilter') 
          </form>
          <div class="card-body table-responsive">
              <table class="table table-hover" style="font-size:13px;">
                  <thead>
                    <tr>
                        <th scope="col" class="text-center">Type</th>
                        <th scope="col" class="text-center">Application Code</th>
                        <th scope="col" class="text-center">Name of Facility</th>
                        <th scope="col" class="text-center">Type of Facility</th>
                        <th scope="col" class="text-center">Date</th>
                        <th scope="col" class="text-center">Application Status</th>
                        <th scope="col" class="text-center">Current Status</th>
                        <th scope="col" class="text-center">Options</th>
                    </tr>
                  </thead>
                  <tbody id="FilterdBody">
                      @if (isset($BigData))
                        @php  $toCheck = ($request == 'machines' ? 'cdrrhr' : 'cdrr');  @endphp

                        @foreach ($BigData as $data)
                            <tr>
                              <td class="text-center">{{$data->hfser_id}}</td>
                              <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                              <td class="text-center"><strong>{{$data->facilityname}}</strong></td>
                              <td class="text-center">{{$data->hgpdesc}}</td>
                              <td class="text-center">{{$data->formattedDate}}</td>
                              <td class="text-center">{{$data->aptdesc}}</td>
                              @php   $status = (strtolower($request) == 'machines' ? $data->FDAStatMach : $data->FDAStatPhar)  @endphp
                              <td class="text-center" style="font-weight:bold;">{{$status}}</td>
                              <td>
                                <center>
                                  <button type="button" title="Evaluate Payment for {{$data->facilityname}}" class="btn btn-outline-primary" onclick="window.location.href='{{asset('employee/dashboard/processflow/FDA/recommendation')}}/{{$data->appid}}/{{$request}}'" ><i class="fa fa-fw fa-check"></i></button>
                                </center>
                              </td>
                            </tr>
                        @endforeach
                      @endif
                  </tbody>
                  <tfoot>
                    <tr>
                        <th scope="col" class="text-center">Type</th>
                        <th scope="col" class="text-center">Application Code</th>
                        <th scope="col" class="text-center">Name of Facility</th>
                        <th scope="col" class="text-center">Type of Facility</th>
                        <th scope="col" class="text-center">Date</th>
                        <th scope="col" class="text-center">Application Status</th>
                        <th scope="col" class="text-center">Current Status</th>
                        <th scope="col" class="text-center">Options</th>
                    </tr>
                  </tfoot>
              </table>
          </div>
      </div>
  </div>

  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
