@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Evaluation Process Flow')
  @section('content')
  @php 
    $employeeData = session('employee_login');
   $grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';
    @endphp
  <input type="text" id="CurrentPage" hidden="" value="PF015">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             <h3>CON Evaluation</h3>  
          </div>
          
          <form class="filter-options-form">
            @include('employee.tableDataFilter') 
          </form>

          <div class="card-body table-responsive backoffice-list">
        
              <table class="table table-hover"  style="font-size:13px; width: 100%">
                  <thead>
                  <tr style="font-weight:bold;">
                      <th scope="col" class="text-center">Type</th>
                      <th scope="col" class="text-center">Application Code</th>
                      <th scope="col" class="text-center">Name of Health Facility</th>
                      <th scope="col" class="text-center">Type of Health Facility</th>
                      <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection</td>
                      <td scope="col" style="text-align: center;">Actual Inspection Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Application Status</th>
                      <th scope="col" class="text-center">Current Status</th>
                      <th scope="col" class="text-center">Options</th>
                  </tr>
                  </thead>
                  <tbody id="FilterdBody">
                      @if (isset($BigData))
                        @if(count($BigData) > 0)
                          @foreach ($BigData as $data)
                            @php
                              $status = ''; $link = '';
                              $paid = $data->appid_payment;
                              $reco = $data->isrecommended;
                              $ifdisabled = '';$color = '';
                            @endphp
                            @switch($data->hfser_id)
                              @case('PTC')
                                @php
                                  $link = asset('employee/dashboard/processflow/evalution/'.$user['cur_user'].'/'.$data->appid.'/'.$data->hfser_id);
                                @endphp
                                @break
                              @case('CON')
                                @php
                                  $link = asset('employee/dashboard/processflow/conevalution/'.$data->appid);
                                @endphp
                                @break
                            @endswitch

                            <tr>
                              <td class="text-center">{{$data->hfser_id}}</td>
                              <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                              <td class="text-center"><strong>{{$data->facilityname}}</strong></td>
                              <td class="text-center">{{$data->hgpdesc ?? 'NOT FOUND'}}</td>
                              <td style="text-align:left">@if(isset($data->CashierApproveformattedDate)){{$data->CashierApproveformattedDate}} @else <span style="color:orange;">{{ 'Not Officially Applied Yet' }}</span> @endif </td>
                              <td style="text-align:left; border-left: darkgray;border-left-width: thin;border-left-style: solid;">@if(isset($data->CashierApproveformattedDate)){{date("F j, Y", strtotime($data->CashierApproveformattedDate. ' + 14 days')) }} @endif </td>
                              <td style="text-align:left">@if(isset($data->formattedInspectedDate)){{$data->formattedInspectedDate}} @endif </td>
                              <td style="text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;">{{$data->aptdesc}}</td>
                              <td style="color:{{$color}};font-weight:bold;" class="text-center">{{$data->trns_desc}}</td>
                              <td>
                                <center>
                                  <button type="button" title="Assess {{$data->facilityname}}" class="btn btn-outline-primary" onclick="window.location.href='{{$link}}'"><i class="fa fa-fw fa-check"></i></button>
                                </center>
                              </td>
                            </tr>
                          @endforeach
                        @else
                          <tr><td colspan="10" class="text-center">No data available in table</td></tr>              
                        @endif 
                      @else
                        <tr><td colspan="10" class="text-center">No data available in table</td></tr>   
                      @endif
                  </tbody>
                  <tfoot>
                    <tr style="font-weight:bold;">
                      <th scope="col" class="text-center">Type</th>
                      <th scope="col" class="text-center">Application Code</th>
                      <th scope="col" class="text-center">Name of Health Facility</th>
                      <th scope="col" class="text-center">Type of Health Facility</th>
                      <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection</td>
                      <td scope="col" style="text-align: center;">Actual Inspection Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Application Status</th>
                      <th scope="col" class="text-center">Current Status</th>
                      <th scope="col" class="text-center">Options</th>
                    </tr>
                  </tfoot>
              </table>
          </div>
      </div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function(){
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



  		// $('#example').DataTable();
      var table = $('#example').DataTable();

      $("#example thead .select-filter").each( function ( i ) {
      var e = i == 0 ? 3 : i == 1 ? 5 : 6;
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