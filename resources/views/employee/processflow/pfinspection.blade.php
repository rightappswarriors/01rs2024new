@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Inspection Schedule')
  @section('content')


   <input type="text" id="CurrentPage" hidden="" value="PF011">
		<div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">
             <h3>Inspection Schedule</h3>
          </div>
		  
		  	<form class="filter-options-form">
				@include('employee.tableDataFilter') 
			</form>
			
          <div class="card-body table-responsive backoffice-list">
          	<table class="table table-hover">
                  <thead>
						<tr style="font-weight:bold;">
							<th scope="col">Process</th>
							<th scope="col">Type</th>
							<th scope="col">Application Code</th>
							<th scope="col">Name of Facility</th>
							<th scope="col">Proposed Schedule</th>
							<td scope="col" style="text-align: center;">Payment Confirmation Date</td>
							<td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection</td>
							<td scope="col" style="text-align: center;">Actual Inspection Date</td>
							<td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">FDA Radiation Facility Status</th>		
							<th scope="col">FDA Pharmacy Status</th>		
							<th scope="col">Option</th>						  
	                  	</tr>
                  </thead>
                  <tbody id="FilterdBody" >
                    
                  @if (isset($applicant))
                        @if(count($applicant) > 0)

                   		@foreach($applicant as $apply)
							<script>
								console.log("{!! $apply->hasAssessors.'---'. $apply->facilityname.'---' . AjaxController::canProcessNextStepFDA($apply->appid,'isCashierApproveFDA','isCashierApprovePharma') !!}")
							</script>						
							@if($apply->hasAssessors == 'T')
								<tr style="padding-right: 20px!important;">
									<td scope="row" class="text-center">{{$apply->aptdesc}}</td>
									<td scope="row" class="text-center font-weight-bold">{{$apply->hfser_id}}</td>
									<td scope="row" class="text-center">{{$apply->hfser_id.'R'.$apply->rgnid.'-'.$apply->appid}}</td>
									<td scope="row" class="text-left">{{$apply->facilityname}}</td>
									<td scope="row" class="">@php $strdates = str_replace('<br>' , '', $apply->proposedWeek); echo str_replace('"' , '', $strdates); @endphp</td>
									<td scope="row" style="text-align:left">@if(isset($apply->CashierApproveformattedDate)){{$apply->CashierApproveformattedDate}} @else <span style="color:red;">{{ 'Not Officially Applied Yet' }}</span> @endif </td>
									<td scope="row" style="text-align:left; border-left: darkgray;border-left-width: thin;border-left-style: solid;">@if(isset($apply->CashierApproveformattedDate)){{date("F j, Y", strtotime($apply->CashierApproveformattedDate. ' + 14 days')) }} @endif </td>
									<td scope="row" style="text-align:left">@if(isset($apply->formattedInspectedDate)){{$apply->formattedInspectedDate}} @endif </td>
									<td scope="row" style="text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;">
										{{$apply->FDAStatMach}}
									</td>
									<td scope="row" class="">
										{{$apply->FDAStatPhar}}
									</td>
									<td scope="row" class="">
										<center>
											<button type="button" title="Show details for  {{$apply->facilityname}}" class="btn btn-outline-primary" onclick="window.location.href = '{{ asset('employee/dashboard/processflow/inspection') }}/{{$apply->appid}}'"><i class="fa fa-fw fa-check"></i></button>&nbsp;
										</center>
									</td>
								</tr>
							@endif
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
							<th scope="col">Process</th>
							<th scope="col">Type</th>
							<th scope="col">Application Code</th>
							<th scope="col">Name of Facility</th>
							<th scope="col">Proposed Schedule</th>
							<td scope="col" style="text-align: center;">Payment Confirmation Date</td>
							<td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection</td>
							<td scope="col" style="text-align: center;">Actual Inspection Date</td>
							<td scope="col" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">FDA Radiation Facility Status</th>		
							<th scope="col">FDA Pharmacy Status</th>		
							<th scope="col">Option</th>						  
	                  	</tr>
                  </tfoot>

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
