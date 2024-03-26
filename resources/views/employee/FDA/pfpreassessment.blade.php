@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Pre-Assessment')
  @section('content')
  {{-- <input type="text" id="CurrentPage" hidden="" value="FD002"> --}}
  <div class="content p-4">
    <div class="card">
      <div class="card-header bg-white font-weight-bold">
          <h3>Pre-Assessment ({{$request =='machines' ? 'Radiation Facility' : 'Pharmacy'}}) </h3>
          </div>

          <form class="filter-options-form">
            @include('employee.FDA.FDAtableDataFilter') 
          </form>

          <div class="card-body table-responsive">
            <table class="table table-hover" style="font-size:13px;" id="example">
                  <thead>
                  <tr>
                      <!-- <th scope="col" class="text-center"></th> -->
                      <th scope="col" class="text-center">Type</th>
                      <th scope="col" class="text-center">Process</th>
                      <th scope="col" class="text-center">Application Code</th>
                      <th scope="col" class="text-center">Name of Facility</th>
                      <th scope="col" class="text-center">Type of Facility</th>
                      <th scope="col" class="text-center">Date</th>
                      <th scope="col" class="text-center">Current Status</th>
                      <th scope="col" class="text-center">Address</th>
                      <th scope="col" class="text-center">Options</th>
                  </tr>
                  </thead>
                  <tbody>
                   @if (isset($BigData))
                   @foreach ($BigData as $data)
                                         
                          @php
                          // $eval = (strtolower($request) == 'machines' ? $data->isrecommendedFDA : $data->isrecommendedFDAPharma);
                          // $cashier = (strtolower($request) == 'machines' ? $data->isCashierApproveFDA : $data->isCashierApprovePharma);
                         // $toCheck = ($request == 'machines' ? 'cdrrhr' : 'cdrr');
                         //if(!FunctionsClientController::hasRequirementsFor($toCheck,$data->appid))
                              //continue;
                              $status = '';
                              $paid = $data->appid_payment;
                              $reco = $data->isrecommended;
                              $ifdisabled = '';$color = '';
                            @endphp

                            <tr>
                              <td class="text-center">{{$data->hfser_id}}</td>
                              <td class="text-center">{{$data->aptdesc}}</td>
                              <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                              <td class="text-center"><strong>{{$data->facilityname}}</strong></td>
                              <td class="text-center">{{($data->hgpdesc ?? 'NOT FOUND')}}</td>
                              <td class="text-center">{{$data->formattedDate}}</td>                              
                              @php
                                $status = (strtolower($request) == 'machines' ?( $data->FDAStatMach ?  $data->FDAStatMach : 'For Evaluation') :( $data->FDAStatPhar? $data->FDAStatPhar: 'For Evaluation'))
                              @endphp
                            <td class="text-center" style="font-weight:bold;">{{$status}}</td>
                            <td class="text-center">{{$data->street_name}}, {{$data->brgyname}}, {{$data->cmname}}, {{$data->provname}} {{$data->rgn_desc}}</td>
                                <td class="text-center">
                                    {{-- @if(!isset($data->documentSent)) --}}
                                      {{-- <button type="button" title="Pre-assess {{$data->facilityname}}" class="btn btn-outline-primary"  {{$ifdisabled}}><i class="fa fa-fw fa-clipboard-check" {{$ifdisabled}}></i></button>&nbsp; --}}
                                      {{-- <button type="button" title="Edit {{$data->facilityname}}" class="btn btn-outline-warning" onclick="window.location.href = '{{ asset('/employee/dashboard/processflow/Pre-assess') }}/{{$data->appid}}/edit'"  {{$ifdisabled}}><i class="fa fa-fw fa-edit" {{$ifdisabled}}></i></button> --}}
                                    {{-- @else --}}
                                      <button type="button" title="Pre-assess {{$data->facilityname}}" class="btn btn-outline-primary" onclick="window.location.href = '{{ url('employee/dashboard/processflow/evaluate') }}/{{$data->appid}}/{{($request == 'machines' ? 'xray' : $request)}}'"  {{$ifdisabled}}><i class="fa fa-check" {{$ifdisabled}}></i></button>&nbsp;
                                    {{-- <button type="button" title="Edit {{$data->facilityname}}" class="btn btn-outline-warning" onclick="window.location.href = '{{ asset('/employee/dashboard/processflow/evaluate') }}/{{$data->appid}}/edit'"  {{$ifdisabled}}><i class="fa fa-fw fa-edit" {{$ifdisabled}}></i></button> --}}
                                    {{-- @endif --}}
                              </td>
                              
                            </tr>
                     @endforeach
                  @endif
                  </tbody>
              </table>
          </div>
    </div>
  </div>
 
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
