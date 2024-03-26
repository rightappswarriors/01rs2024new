@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Assessment Process Flow')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PF009">
  <div class="content p-4">
      <div class="card">
        <div class="card-header bg-white font-weight-bold">
          <h3> Assessment Tool   </h3>
        </div>
        
		  	<form class="filter-options-form">
          @include('employee.tableDataFilter') 
        </form>

          <div class="card-body table-responsive backoffice-list">
        
              <table class="table table-hover">
                  <thead>
                    <tr style="font-weight:bold;">
                      <th scope="col" class="text-center">Process</th>
                      <th scope="col" class="text-center">Type</th>
                      <th scope="col" class="text-center">Code</th>
                      <th scope="col" class="text-center">Name of Facility</th>
                      <th scope="col" class="text-center">Type of Facility</th>
                      <th scope="col" class="text-center">Assigned Officer</th>
                      <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection</td>
                      <td scope="col" style="text-align: center;">Actual Inspection Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Current Status</th>
                      <th scope="col" class="text-center">Options</th>
                    </tr>
                  </thead>
                  <tbody id="FilterdBody">
                    @if (isset($BigData)) 
                        @if(count($BigData) > 0)
                          @foreach ($BigData as $data)
                            @php
                              $status = '';   $paid = $data->appid_payment;  $reco = $data->isrecommended;
                              $ifdisabled = '';$color = '';
                            @endphp
                            <tr>
                              <td class="text-left">{{$data->aptdesc}}</td>
                              <td class="text-left"><strong>{{$data->hfser_id}}</strong></td>
                              <td class="text-left">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                              <td class="text-left"><strong>{{$data->facilityname}}</strong></td>
                              <td class="text-left">{{$data->hgpdesc ?? 'NOT FOUND'}}</td>
                              <td class="text-left">{{$data->uid}}</td>
                              <td scope="row" style="text-align:left">
                                @if(isset($data->CashierApproveformattedDate)){{$data->CashierApproveformattedDate}} 
                                @else <span style="color:red;">{{ 'Not Officially Applied Yet' }}</span> @endif 
                              </td>
                              <td scope="row" style="text-align:left; border-left: darkgray;border-left-width: thin;border-left-style: solid;">
                                @if(isset($data->CashierApproveformattedDate)){{date("F j, Y", strtotime($data->CashierApproveformattedDate. ' + 14 days')) }} @endif </td>
                              <td scope="row" style="text-align:left">@if(isset($data->formattedInspectedDate)){{$data->formattedInspectedDate}} @endif </td>
                              <td style="color:{{$color}};font-weight:bold;text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;" class="text-left">
                                {{$data->trns_desc}}
                              
                                <br/> @if(isset($data->formattedUpdatedDate)) <span style="color: black;font-weight:normal; font-size: small;"><i>Last updated on {{ $data->formattedUpdatedDate }}  @if(isset($data->formattedUpatedTime)) {{ $data->formattedUpatedTime }}  @endif.</i></span> @endif
                              </td>
                              <td>
                                  <center>
                                    <button type="button" title="Assess {{$data->facilityname}}" class="btn btn-outline-primary" onclick="window.location.href='{{asset('employee/dashboard/processflow/parts')}}/{{$data->appid}}'"><i class="fa fa-fw fa-check"></i></button>
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
                      <th scope="col" class="text-center">Process</th>
                      <th scope="col" class="text-center">Type</th>
                      <th scope="col" class="text-center">Code</th>
                      <th scope="col" class="text-center">Name of Facility</th>
                      <th scope="col" class="text-center">Type of Facility</th>
                      <th scope="col" class="text-center">Assigned Officer</th>
                      <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection</td>
                      <td scope="col" style="text-align: center;">Actual Inspection Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Current Status</th>
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




var table = $('#example').DataTable();
$("#example thead .select-filter").each( function ( i ) {
      var e = i == 0 ? 2 : i == 1 ? 4 : 5;
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