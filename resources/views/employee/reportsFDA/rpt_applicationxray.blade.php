@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Application with FDA')
  @section('content')
  {{-- <input type="text" id="CurrentPage" hidden="" value="FD002"> --}}
  <div class="content p-4">
    <div class="card">
      <div class="card-header bg-white font-weight-bold">
             Application with {{$request =='machines' ? 'Radiation Facility' : 'Pharmacy'}} @include('employee.tableDateSearch')
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover" style="font-size:13px;" id="example">
                  <thead>
                  <tr>
                      <th class="select-filter" ></th>
                      <th></th>
                      <th ></th>
                      <th  class="select-filter"></th>
                      <th></th>
                      <th class="select-filter"></th>
                      <th  class="select-filter"></th>
                      <th></th>
                     
                  </tr>
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
                  </tr>
                  </thead>
                  <tbody id="FilterdBody">
                   @if (isset($BigData))
                   @foreach ($BigData as $data)
                          @php
                          $preassess = (strtolower($request) == 'machines' ? $data->ispreassessed : $data->ispreassessedpharma);
                          $oop = (strtolower($request) == 'machines' ? $data->isPayEvalFDA : $data->isPayEvalFDAPharma);
                          @endphp
                          @if(in_array(strtolower($data->hfser_id), ['lto','ato','coa']) &&( $data->isReadyForInspecFDA == 1 || $data->isReadyForInspecFDA == 0) && $oop == 1)
                            @php
                              $toCheck = ($request == 'machines' ? 'cdrrhr' : 'cdrr');
                            @endphp
                            @if(!FunctionsClientController::hasRequirementsFor($toCheck,$data->appid))
                            @php continue; @endphp
                            @endif
                            @php
                              $status = '';
                              $paid = $data->appid_payment;
                              $reco = $data->isrecommended;
                              $ifdisabled = '';$color = '';
                              // if($data->status == 'P'){
                              //   $ifdisabled = 'disabled';
                              // }
                            @endphp

                            <tr>
                              <!-- <td class="text-center">{{$data->ispreassessedpharma}}</td> -->
                              <td class="text-center">{{$data->hfser_id}}</td>
                              <td class="text-center">{{$data->aptdesc}}</td>
                              <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                              <td class="text-center"><strong>{{$data->facilityname}}</strong></td>
                              <td class="text-center">{{(ajaxController::getFacilitytypeFromHighestApplicationFromX08FT($data->appid)->hgpdesc ?? 'NOT FOUND')}}</td>
                              <td class="text-center">{{$data->formattedDate}}</td>                              
                              @php
                                $status = (strtolower($request) == 'machines' ?( $data->FDAStatMach ?  $data->FDAStatMach : 'For Evaluation') :( $data->FDAStatPhar? $data->FDAStatPhar: 'For Evaluation'))
                            @endphp
                            <td class="text-center" style="font-weight:bold;">{{$status}}</td>
                            <td class="text-center">{{$data->streetname}}, {{$data->brgyname}}, {{$data->cmname}}, {{$data->provname}} {{$data->rgn_desc}}</td>
                              <!-- <td class="text-center" style="font-weight:bold;">{{(AjaxController::getTransStatusById($data->FDAStatMach)[0]->trns_desc ?? '')}}</td> -->
                              <!-- <td class="text-center" style="font-weight:bold;">{{(AjaxController::getTransStatusById($data->FDAstatus)[0]->trns_desc ?? '')}}</td> -->                              
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
    $(document).ready(function() {
      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker('getDate');
            var max = $('#max').datepicker('getDate');
            var startDate = new Date(data[4]);
            if (min == null && max == null) return true;
            if (min == null && startDate <= max) return true;
            if (max == null && startDate >= min) return true;
            if (startDate <= max && startDate >= min) return true;
            return false;
        }
    );

    $('#min').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    $('#max').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });


  	   var table = $('#example').DataTable();

       $("#example thead .select-filter").each( function ( i ) {
      var e =i == 0 ? 0: i == 1 ? 3 : i == 2 ? 5 : 6;
        var select = $('<select><option value=""></option></select>')
            .appendTo( $(this).empty() )
            // .appendTo( $(this).empty() )
            .on( 'change', function () {
                table.column( e )
                    .search( $(this).val() )
                    .draw();
            } );
 
        table.column(e).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        } );


    } );

    
       $('#min, #max').change(function () {
        table.draw();
    });
      
      });
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
