@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'HFERC Assignment')
  @section('content')

  @php 
    $employeeData = session('employee_login');
   $grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';
    @endphp

  <input type="text" id="CurrentPage" hidden="" value="PF012">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             <h3>HFERC Assignment</h3>
             <div style="float: right;">
             @if($grpid == 'NA' || $grpid == 'DC' || $grpid == 'PO1' || $grpid == 'RDS')
             <a style="float: right;" href="{{asset('/employee/dashboard/processflow/manage/ptc/team')}}"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;<button class="btn btn-success" ><i class="fa fa-group"> &nbsp;</i> &nbsp; Manage Team</button></a>
        
             @endif
            </div>

          </div>
          
      <form class="filter-options-form">
        @include('employee.tableDataFilter') 
      </form>
      
          <div class="card-body table-responsive  backoffice-list">
          
			<table class="table table-hover" id="">
			  <thead>
          <tr style="font-weight:bold;">
              <th scope="col" class="text-center">Process</th>
              <th scope="col" class="text-center">Type</th>
              <th scope="col" class="text-center">Application Code</th>
              <th scope="col" class="text-center">Name of Facility</th>
              <th scope="col" class="text-center">Type of Facility</th>
              <th scope="col" class="text-center">Revision</th>
              <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
              <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of HFERC Evaluation</td>
              <td scope="col" style="text-align: center;">Actual Date of  HFERC Evaluation</td>
              <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Status</th>
              <th scope="col" class="text-center">Options</th>
          </tr>
			  </thead>
			  <tbody id="FilterdBody">
       
				@if (isset($BigData))
            @if(count($BigData) > 0)
       
              @foreach ($BigData as $data)
                <tr>
                    <td class="text-center">{{$data->aptdesc}}</td>
                    <td class="text-center"><strong>{{$data->hfser_id}}</strong></td>
                    <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                    <td class="text-left"><strong>{{$data->facilityname}}</strong></td>
                    <td class="text-left">{{ $data->hgpdesc ?? 'NOT FOUND'}}</td>
                    <td class="text-center">
                    @if ($data->trns_desc == "For Final Recommendation")
                      {{AjaxController::maxRevisionFor($data->appid)}}
                      @else 
                      {{AjaxController::maxRevisionFor($data->appid) + 1}}
                      @endif
                    </td>
                    <td style="text-align:left">@if(isset($data->CashierApproveformattedDate)){{$data->CashierApproveformattedDate}} @else <span style="color:red;">{{ 'Not Officially Applied Yet' }}</span> @endif </td>
                    <td style="text-align:left; border-left: darkgray;border-left-width: thin;border-left-style: solid;">@if(isset($data->CashierApproveformattedDate)){{date("F j, Y", strtotime($data->CashierApproveformattedDate. ' + 14 days')) }} @endif </td>
                    <td style="text-align:left">@if(isset($data->formattedInspectedDate)){{$data->formattedInspectedDate}} @endif @if(isset($data->formattedHFERC_evalDate)){{$data->formattedHFERC_evalDate}} @endif  </td>
                    <td style="text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;">{{$data->trns_desc}}</td>
                    <td><center>
                    @if ($data->trns_desc == "For Final Recommendation")
                      <button type="button" title="HFERC Actions for {{$data->facilityname}}" class="btn btn-primary" onclick="window.location.href = '{{ asset('employee/dashboard/processflow/assignmentofhferc') }}/{{$data->appid}}/{{AjaxController::maxRevisionFor($data->appid)}}'"><i class="fa fa-wrench"></i></button>
                      @else 
                      <button type="button" title="HFERC Actions for {{$data->facilityname}}" class="btn btn-primary" onclick="window.location.href = '{{ asset('employee/dashboard/processflow/assignmentofhferc') }}/{{$data->appid}}/{{AjaxController::maxRevisionFor($data->appid) + 1}}'"><i class="fa fa-wrench"></i></button>
                      @endif
                      
                    </center>
                  </td>
                </tr>
              @endforeach
            @else
              <tr><td colspan="11" class="text-center">No data available in table</td></tr>              
            @endif 
          @else
            <tr><td colspan="11" class="text-center">No data available in table</td></tr>  
				@endif
			  </tbody>
        <tfoot>
          <tr style="font-weight:bold;">
              <th scope="col" class="text-center">Process</th>
              <th scope="col" class="text-center">Type</th>
              <th scope="col" class="text-center">Application Code</th>
              <th scope="col" class="text-center">Name of Facility</th>
              <th scope="col" class="text-center">Type of Facility</th>
              <th scope="col" class="text-center">Revision</th>
              <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
              <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of HFERC Evaluation</td>
              <td scope="col" style="text-align: center;">Actual Date of  HFERC Evaluation</td>
              <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Status</th>
              <th scope="col" class="text-center">Options</th>
          </tr>
			  </tfoot>
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

      // $('#example').DataTable();
      var table = $('#example').DataTable();
      $("#example thead .select-filter").each( function ( i ) {
      var e = i == 0 ? 3  : 6;
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
    // var ToBeAddedMembers = [];
    $(function () {
      $('[data-toggle="popover"]').popover();
    })
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
