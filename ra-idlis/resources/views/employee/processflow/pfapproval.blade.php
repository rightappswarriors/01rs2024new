@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Approval/Issuance Process Flow')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PF007">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             <h3>For Approval and Issuance of Certificate </h3>   
          </div>
          
		  	<form class="filter-options-form">
          @include('employee.tableDataFilter') 
        </form>
        
          <div class="card-body table-responsive backoffice-list">
        
            @php
              $lname = preg_replace('/\s*/', '', $uilastname);
              $lname = strtolower($lname);

              $position = preg_replace('/\s*/', '', $uiposition);
              $position = strtolower($position);
            @endphp          
            
              <table class="table table-hover">
                  <thead>
                    <tr style="font-weight:bold;">
                      <th scope="col" class="text-center">Process</th>
                      <th scope="col" class="text-center">Type</th>
                      <th scope="col" class="text-center">App.Code</th>
                      <th scope="col" class="text-center">Facility Name</th>
                      <th scope="col" class="text-center">Facility Type</th>
                      <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                      <td scope="col" style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Issuance/Nonissuance</td>
                      <td scope="col" style="text-align: center;">Actual Issuance/Nonissuance Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" class="text-center">Current Status</th>
                      <th scope="col" class="text-center">Options</th>
                    </tr>
                  </thead>
                  <tbody id="FilterdBody">
                      @if (isset($BigData))
                        @if(count($BigData) > 0)
                        @foreach ($BigData as $data)
                            @php
                              $status = '';
                              $paid = $data->appid_payment;
                              $reco = $data->isrecommended;
                              $ifdisabled = '';$color = '';
                              
                              if($data->status == 'P' || $data->status == 'RA' || $data->status == 'RE' || $data->status == 'RI' ){
                                $ifdisabled = 'disabled';
                              }
                            @endphp
                            <tr>
                              <td class="text-center">{{$data->aptdesc}}</td>
                              <td class="text-center"><strong>{{$data->hfser_id}}</strong></td>
                              <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                              <td class="text-left"><strong>{{$data->facilityname}}</strong></td>
                              <td class="text-left">{{$data->hgpdesc ?? 'NOT FOUND'}}</td>
                              <td scope="row" style="text-align:left">@if(isset($data->CashierApproveformattedDate)){{$data->CashierApproveformattedDate}} @else <span style="color:orange;">{{ 'Not Officially Applied Yet' }}</span> @endif </td>
										          <td scope="row" style="text-align:left; border-left: darkgray;border-left-width: thin;border-left-style: solid;">@if(isset($data->CashierApproveformattedDate)){{date("F j, Y", strtotime($data->CashierApproveformattedDate. ' + 56 days')) }} @endif </td>
										          <td scope="row" style="text-align:left">@if(isset($data->formattedApprovedDate)){{$data->formattedApprovedDate}} @endif </td>
                              <td class="text-left" style="text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;">{{$data->trns_desc}}</td>
                              <td>
                                <center>
                                    <button type="button" title="Evaluate Payment for {{$data->facilityname}}" class="btn btn-outline-primary" onclick="window.location.href='{{asset('employee/dashboard/processflow/approval')}}/{{$data->appid}}'"  {{$ifdisabled}}><i class="fa fa-fw fa-check" {{$ifdisabled}}></i></button>
                                </center></td>
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
                      <th scope="col" class="text-center">App.Code</th>
                      <th scope="col" class="text-center">Facility Name</th>
                      <th scope="col" class="text-center">Facility Type</th>
                      <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                      <td scope="col" style="text-align: center;border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Issuance/Nonissuance</td>
                      <td scope="col" style="text-align: center;">Actual Issuance/Nonissuance Date</td>
                      <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;" class="text-center">Current Status</th>
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
