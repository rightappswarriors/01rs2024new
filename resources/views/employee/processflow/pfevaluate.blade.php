@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Evaluate Process Flow')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PF002">
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">
          <h3>@if(isset($type)) {{ $type == 'technical' ? 'Technical' : 'Documentary' }}  @endif  Evaluation</h3>
      </div>
      
      <form method="POST" action="{{asset('employee/dashboard/processflow/evaluate')}}@if(isset($type)){{ $type == 'technical' ? '/technical' : '' }}@endif" data-parsley-validate  class="filter-options-form">
        
        <input type="hidden" name="type" id="type" value="@if(isset($type)){{$type}}@endif">
        @include('employee.tableDataFilter') 
      </form>
         {{-- @if($type != 'technical')  --}}
          <div  class="card-header bg-white text-center">
              <span class=" font-weight-bold">Legend:</span> <span class=" font-weight-bold">Gray Background </span>= Not yet Viewed/Not yet Opened Document(s).  <span class=" font-weight-bold">White Background</span> = Viewed/Opened Document(s).
          </div>
          {{-- @endif --}}
          
          <div class="card-body table-responsive backoffice-list">
         
          	<table class="table table-hover" id="">
                  <thead>
                    <tr>
                        <td scope="col" class="text-center">Process</td>
                        <td scope="col" class="text-center">Type</td>
                        <td scope="col" class="text-center">Application Code</td>
                        <td scope="col" class="text-center">Name of Facility</td>
                        <td scope="col" class="text-center">Type of Facility</td>
                        <td scope="col" class="text-center">Last Updated On</td>
                        <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                        <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of @if(isset($type)){{ $type == 'technical' ? 'Inspection' : 'Evaluation' }}@endif</td>
                        <td scope="col" style="text-align: center;">Actual Date of @if(isset($type)) {{ $type == 'technical' ? 'Inspection' : 'Evaluation' }}  @endif </td>
                        <td scope="col" class="text-center" style= "border-left: darkgray;border-left-width: thin;border-left-style: solid;">Current Status</td>
                        <td scope="col" class="text-center">Options</td>
                    </tr>
                  </thead>
                  
                  <tbody id="FilterdBody">
              
                   @if (isset($BigData))
                      @if(count($BigData) > 0)
                        @foreach ($BigData as $data)
                            @php
                              $reco = $data->isrecommended;
                              $ifdisabled = '';$color = '';

                            @endphp
                            
                            <tr @if(!isset($data->documentSent) || $data->isrecommended == 2) style="background-color: #c4c1bb"; @endif>
                              <!-- <td class="text-center">{{$data->isCashierApprove}}</td> -->
                              <td class="text-center">{{$data->aptdesc}}</td>
                              <td class="text-center">{{$data->hfser_id}}</td>
                              <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                              <td class=""><strong>{{$data->facilityname}}</strong></td>
                              <td class="">{{($data->hgpdesc ?? 'NOT FOUND')}}</td>
                              <td>@if(isset($data->formattedUpdatedDate)) <span style="color: black;font-weight:normal; font-size: small;">{{ $data->formattedUpdatedDate }}  @if(isset($data->formattedUpatedTime)) <br/>{{ $data->formattedUpatedTime }}  @endif</span> @endif</td>
                              <td style="text-align:left">@if(isset($data->CashierApproveformattedDate)){{$data->CashierApproveformattedDate}} @else <span style="color:red;">{{ 'Not Officially Applied Yet' }}</span> @endif </td>
                              <td style="text-align:left; border-left: darkgray;border-left-width: thin;border-left-style: solid;">@if(isset($data->CashierApproveformattedDate)){{date("F j, Y", strtotime($data->CashierApproveformattedDate. ' + 14 days')) }} @endif </td>
                              <td style="text-align:left">@if(isset($data->formattedInspectedDate)){{$data->formattedInspectedDate}} @endif </td>
                              <td class="" style="font-weight:bold; border-left: darkgray;border-left-width: thin;border-left-style: solid;">{{$data->trns_desc}}</td>
                              <td>
                                <center>
                                  @if(!isset($data->documentSent))
                                    <button type="button" title="Evaluate {{$data->facilityname}}" class="btn btn-outline-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="acceptDocu({{$data->appid}})"  {{$ifdisabled}}><i class="fa fa-check" {{$ifdisabled}}></i></button>&nbsp;
                                    
                                    {{-- for documentary evaluation  --}}
                                  @else
                                    @if(isset($type))

                                        @if($type == 'technical') 
                                          <button type="button" title="Evaluate {{$data->facilityname}}" class="btn btn-outline-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="window.location.href = '{{ asset('/employee/dashboard/processflow/evaluatetech') }}/{{$data->appid}}/{{'hfsrb'}}/'"  {{$ifdisabled}}><i class="fa fa-check" {{$ifdisabled}}></i></button>&nbsp;
                                        @else
                                          <button type="button" title="Evaluate {{$data->facilityname}}" class="btn btn-outline-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="window.location.href = '{{ asset('/employee/dashboard/processflow/evaluate') }}/{{$data->appid}}/{{'hfsrb'}}/'"  {{$ifdisabled}}><i class="fa fa-check" {{$ifdisabled}}></i></button>&nbsp;
                                        @endif

                                    @endif
                                  @endif
                                </center>
                              </td>
                            </tr>
                        @endforeach
                      @else
                        <tr><td colspan="16" class="text-center">No data available in table</td></tr>              
                      @endif 
                    @else
                      <tr><td colspan="16" class="text-center">No data available in table</td></tr>   
                    @endif
                  </tbody>

                  <tfoot>
                    <tr>
                        <td scope="col" class="text-center">Process</td>
                        <td scope="col" class="text-center">Type</td>
                        <td scope="col" class="text-center">Application Code</td>
                        <td scope="col" class="text-center">Name of Facility</td>
                        <td scope="col" class="text-center">Type of Facility</td>
                        <td scope="col" class="text-center">Last Updated On</td>
                        <td scope="col" style="text-align: center;">Payment Confirmation Date</td>
                        <td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of @if(isset($type)){{ $type == 'technical' ? 'Inspection' : 'Evaluation' }}@endif</td>
                        <td scope="col" style="text-align: center;">Actual Date of @if(isset($type)) {{ $type == 'technical' ? 'Inspection' : 'Evaluation' }}  @endif </td>
                        <td scope="col" class="text-center" style= "border-left: darkgray;border-left-width: thin;border-left-style: solid;">Current Status</td>
                        <td scope="col" class="text-center">Options</td>
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
      
      var table = $('#example').DataTable();
    
      $("#example thead .select-filter").each( function ( i ) {
      var e = i == 0 ? 0 : i == 1 ? 1 : i == 2 ? 4 : 6;
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
   


    function acceptDocu(id){
            Swal.fire({
              title: 'You are about to View this documents',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Confirm!'
            }).then((result) => {
              if (result.value) {
                $.ajax({
                  url: '{{asset('employee/dashboard/processflow/evaluate/')}}/'+id,
                  type: 'POST',
                  data: {_token: $('#token').val(),checkFiles: true},
                  success: function(){
                    Swal.fire({
                      type: 'success',
                      title: 'Success',
                      text: '',  //Successfully Accepted Documents
                      timer: 2000,
                    }).then(() => {
                      window.location.href = '{{ asset('/employee/dashboard/processflow/evaluate') }}/'+id;
                    });
                  }
                })
              }
            })
       }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
