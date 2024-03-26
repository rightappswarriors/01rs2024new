
<!-- 
  <input type="text" id="CurrentPage" hidden="" value="RER001">
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">
             PTC Inspection
          </div>
          <div class="card-body table-responsive">
          	<table class="table table-hover" style="font-size:13px;" id="example">
                  <thead>
                  <tr>
                      <th scope="col">Facility Code</th>
                      <th scope="col">Facility Name</th>
                      <th class="text-center" scope="col">Options</th>
                  </tr>
                  </thead>
                  <tbody id="FilterdBody">
                    @isset($servCap)
                      @foreach($servCap as $serv)
                      <tr>
                        <td class="font-weight-bold">{{$serv->hfser_id .'R'.$serv->rgnid.'-'.$serv->appid}}</td>
                        <td>{{$serv->facilityname}}</td>
                        <td>
                          <center>
                              <a class="btn btn-primary" target="_blank" href="{{url('employee/dashboard/processflow/view/hfercevaluation/'.$serv->appid.'/'.$serv->revision)}}"><i class="fa fa-fw fa-eye"></i></a>
                            </center>
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
    $(document).ready(function() {$('#example').DataTable();});
  </script>

<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>
-->

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', $pg_title)
  @section('content')
  {{-- <input type="text" id="CurrentPage" hidden="" value="RER001">  --}}
  <div class="content p-4">
  	<div class="card" style="width: 165vh;" >
  		<div class="card-header bg-white font-weight-bold">
        <h3> {{$pg_title}} </h3>
      </div>
        @include('employee.reports.evaluation.rptEvalFilter') 
      <div class="card-body table-responsive">
        
      <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr>
                  <td scope="col" style="text-align: center;">Date Applied</td>     
                  <td scope="col" style="text-align: center;">Application Code</td>
                  <td scope="col" style="text-align: center;">Name of the Facility</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>
                  <td scope="col" style="text-align: center;">Complete Address</td>
                  <td scope="col" style="text-align:center">Review</td>   
                  <td scope="col" style="text-align:center">Action</td>         
                  
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                @foreach ($LotsOfDatas as $data)

                    <tr>
                      <td style="text-align:left">@if(isset($data->formattedDate)){{$data->formattedDate}} @else <span style="color:orange;">{{ 'Not Officially Applied Yet' }}</span> @endif </td>
                      <td style="text-align:center">{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}</td>
                      <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                      <td style="text-align:left">{{$data->hgpdesc}}</td>
                      <td style="text-align:center">{{$data->street_number}} {{$data->street_name}} {{$data->brgyname}}, {{$data->cmname}}, {{$data->provname}}, {{$data->zipcode}} {{$data->rgn_desc}}</td>
                      <td style="text-align:left">{{$data->revision}}</td>
                      <td style="text-align:left">
                          <center>
                            <a class="btn btn-primary" target="_blank" href="{{url('employee/dashboard/processflow/view/hfercevaluation/'.$data->appid.'/'.$data->revision)}}"><i class="fa fa-fw fa-eye"></i></a>
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
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
  