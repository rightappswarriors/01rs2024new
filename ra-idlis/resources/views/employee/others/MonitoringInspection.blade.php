@if (session()->exists('employee_login')) 
@extends('mainEmployee')
@section('title', 'Monitoring Inspection')
@section('content')


  	<div class="content p-4">
	    <div class="card">
	      	<div class="card-header bg-white font-weight-bold">
	           <a href="{{asset('employee/dashboard/others/monitoring')}}">Monitoring Entry</a> / Monitoring Tool / <a href="{{asset('employee/dashboard/others/monitoring/technical')}}">Technical Findings</a> 
			   @include('employee.tableDateSearch')
			</div>
		<div class="card-body table-responsive">
			<table class="table table-hover" style="font-size: 13px;" id="example">
	        		<thead>
	        			<tr>
	        				<th scope="col" style="text-align: center; width:auto">ID</th>
	        				<th scope="col" style="text-align: center; width:auto">Date Of Inspection</th>
	        				<th scope="col" style="text-align: center; width:auto">Name of Facility</th>
	        				<th scope="col" style="text-align: center; width:15%">Status</th>
	        				<th scope="col" style="text-align: center; width:auto">Options</th>
	        			</tr>
	        		</thead>
	        		<tbody>
	        			@isset($AllData)
	        				{{-- {{dd($AllData)}} --}}
	        				@foreach($AllData as $key => $value)
			        			<tr>
			        				<td style="text-align:center">{{$value->monid}}</td>
			        				<td style="text-align:center">
			        					<b>{{\Carbon\Carbon::parse($value->date_monitoring)->format('M d, Y')}}</b> 
			        					to<b>{{\Carbon\Carbon::parse($value->date_monitoring_end)->format('M d, Y')}}</b>
                  					</td>
			        				<td style="text-align:center">{{$value->name_of_faci}}</td>
									<td style="text-align:center;" class=" font-weight-bold">
									{{$value->trns_desc}}
										</td>

					                <!-- @if($value->isApproved == "1")
										<td style="text-align:center;" class="bg-success text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('A')[0]->trns_desc}}
											</span>
										</td>
									@elseif($value->isFinePaid != "" )
										<td style="text-align:center;" class="bg-info text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('PP')[0]->trns_desc}}
											</span>
										</td>
									@elseif($value->recommendation != "")
										<td style="text-align:center;" class="bg-primary text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('FPE')[0]->trns_desc}}
											</span>
										</td>
									@elseif($value->assessmentStatus != "0")
										<td style="text-align:center;" class="bg-warning text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('FA')[0]->trns_desc}}
											</span>
										</td> 
									@elseif($value->team != "")
										<td style="text-align:center;" class="bg-danger text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('FM')[0]->trns_desc}}
											</span>
										</td>
									@elseif($value->team == "")
										<td style="text-align:center;" class="bg-secondary text-light font-weight-bold">
											<span style="text-shadow: 2px 2px 4px #000000">
												{{AjaxController::getTransStatusById('NT')[0]->trns_desc}}
											</span>
										</td>
									@endif -->

			        				<td style="text-align:center">
			        					@php
				                          $url = 'employee/dashboard/processflow/parts/new/'.$value->regfac_id.'/'.$value->monid;
				                   
				                        @endphp
				                        <button class="btn btn-outline-primary" title="Inspect {{$value->name_of_faci}}" onclick="window.location.href='{{url($url)}}'">
				                          <i class="fa fa-search" aria-hidden="true"></i>
				                        </button>
										   <!-- url = 'employee/dashboard/processflow/parts/'.$value->appid.'/'.$value->monid;  -->
			        				</td>
			        			</tr>
			        		@endforeach
		        		@endisset
	        		</tbody>
	        	</table>
	        	
	    	</div>
		</div>
	</div>
	<script>
			$(document).ready( function () {
    $('#myTable').DataTable();
} );
	</script>

	@include('employee.cmp._othersJS')
@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif