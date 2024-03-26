@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'Evaluate Process Flow')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PF002">
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">
        <h3>For Compliance</h3>
      </div>
        
          
          <div class="card-body table-responsive">


          	<table class="table table-bordered table-striped dataTable" style="font-size:13px;" id="ex-ample">
                  <thead>
              
                  <tr>
                      <!-- <td scope="col" class="text-center"></td> -->
                      <td scope="col" class="text-center">Process</td>
                      <td scope="col" class="text-center">Type</td>
                      <td scope="col" class="text-center">Application Code</td>
                      <td scope="col" class="text-center">Name of Facility</td>
                      <td scope="col" class="text-center">Type of Facility</td>
                      <td scope="col" class="text-center">Start of Compliance</td>
                      <td scope="col" class="text-center">End of Compliance</td>
                      <td scope="col" class="text-center">Options</td>
                  </tr>
                  </thead>

        
                  <tbody id="FilterdBody">
              
                   @if (isset($BigData))
                      @foreach ($BigData as $data)
                      
                          <tr>
                            <!-- <td class="text-center">{{$data->isCashierApprove}}</td> -->
                            <td class="text-center">@if($data->aptid == 'R'){{'Renewal'}}@elseif($data->aptid == 'IN'){{'Initial New'}}@else{{'Unidentified'}}@endif</td>
                            <td class="text-center">{{$data->hfser_id}}</td>
                            <td class="text-center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                            <td class="text-center"><strong>{{$data->facilityname}}</strong></td>
                            <td class="text-center">{{(ajaxController::getFacilitytypeFromHighestApplicationFromX08FT($data->appid)->hgpdesc ?? 'NOT FOUND')}}</td>
                            <td class="text-center">{{date('M d, Y', strtotime($data->date_for_compliance))}}</td>
                            <td class="text-center">{{date('M d, Y', strtotime($data->valid_until))}}</td>
                            <td>
                              	<center>
                                  <button type="button" title="" class="btn btn-outline-primary" onclick="window.location.href='{{asset('employee/dashboard/processflow/compliancedetails')}}/{{$data->compliance_id}}'"><i class="fa fa-check"></i></button>
                            	</center>
                              </td>
                          
                          </tr>

                      @endforeach
                    @endif
                  </tbody>
              </table>
          </div>
  	</div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function(){

      var table = $('#example').DataTable();
    });
    </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
