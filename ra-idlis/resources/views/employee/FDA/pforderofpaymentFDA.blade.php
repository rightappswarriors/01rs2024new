@if (session()->exists('employee_login')) 
  @extends('mainEmployee')
  @section('title', 'Order of Payment Process Flow')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="FD008">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Order of Payment
          </div>
          <div class="card-body table-responsive">
              <table class="table table-hover" id="example" style="font-size:13px;">
                  <thead>
                  <tr>
                      <th scope="col" class="text-center">Type</th>
                      <th scope="col" class="text-center">Application Code</th>
                      <th scope="col" class="text-center">Name of Facility</th>
                      <th scope="col" class="text-center">Type of Facility</th>
                      <th scope="col" class="text-center">Date</th>
                      <th scope="col" class="text-center">&nbsp;</th>
                      <th scope="col" class="text-center">Current Status</th>
                      <th scope="col" class="text-center">Options</th>
                  </tr>
                  </thead>
                  <tbody id="FilterdBody">
                      @if (isset($BigData))
                        @foreach ($BigData as $data)

                          @if($data->isReadyForInspecFDA == 1 && ($request == 'machines' ? $data->isPayEvalFDA : $data->isPayEvalFDAPharma) == null && ($request == 'machines' ? $data->isrecommendedFDA : $data->isrecommendedFDAPharma) == null && strtolower($data->hfser_id) == 'lto')
                            @php
                              $toCheck = ($request == 'machines' ? 'cdrrhr' : 'cdrr');
                            @endphp
                            @if(!FunctionsClientController::hasRequirementsFor($toCheck,$data->appid))
                            @php continue; @endphp
                            @endif
                          @php
                            $status = '';
                            $paid = $data->appid_payment;
                            $reco = $data->isrecommendedFDA;
                            $ifdisabled = '';$color = '';
                            
                            // if($data->status == 'P' || $data->status == 'RA' || $data->status == 'RE' || $data->status == 'RI' ){
                            //   $ifdisabled = 'disabled';
                            // }

                          @endphp
                          <tr>
                            <td class="text-center">{{$data->hfser_id}}</td>
                            <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                            <td class="text-center"><strong>{{$data->facilityname}}</strong></td>
                            <td class="text-center">{{$data->hgpdesc}}</td>
                            <td class="text-center">{{$data->formattedDate}}</td>
                            <td class="text-center">{{$data->aptdesc}}</td>
                            <td class="text-center" style="font-weight:bold;">{{$data->trns_desc}}</td>
                              <td><center>
                                  <button type="button" title="Order of Payment for {{$data->facilityname}}" class="btn btn-outline-primary" onclick="window.location.href = '{{ asset('employee/dashboard/processflow/FDA/'.($request).'/orderofpayment/') }}/{{$data->appid}}'"  {{$ifdisabled}}><i class="fa fa-fw fa-clipboard-check" {{$ifdisabled}}></i></button>
                              </center></td>
                          </tr>
                          @endif

                        @endforeach
                      @endif
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#example').DataTable();
    });
  </script>
  @endsection 
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
