<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', $pg_title)
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="RLR002">
  <div class="content p-4">
  	<div class="card" style="width: 165vh;" >
  		<div class="card-header bg-white font-weight-bold">
        <h3> {{$pg_title}} </h3>
      </div>
        @include('employee.reports.ndhrhis.rptNDHRHISFilter') 
      <div class="card-body table-responsive">
        
      <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr>
                  <td scope="col" style="text-align: center;">Region / Complete Address</td>
                  <td scope="col" style="text-align:center">NHFR Code</td>
                  <td scope="col" style="text-align: center;">Name of the Facilities</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>

                  <td scope="col" style="text-align: center;">Name of Owner</td>
                  <td scope="col" style="text-align:center">Ownership/ Classification</td>
                  <td scope="col" style="text-align:center">Options</td>
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                @foreach ($LotsOfDatas as $data)

                    <tr>
                      <td style="text-align:left"><strong>{{$data->rgn_desc}}</strong><br/>{{$data->street_number}} {{$data->street_name}} {{$data->brgyname}}, {{$data->cmname}}, {{$data->provname}} {{$data->zipcode}}</td>
                      <td scope="col" style="text-align:center">{{$data->nhfcode}}</td>
                      <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                      <td style="text-align:left"><strong>{{( $data->hgpdesc ?? 'Facility Type Not Found.')}}</strong><br/>{{$data->facmdesc}}<br/>@php if(isset($data->noofbed)) echo 'Authorized No.Of Bed: '.$data->noofbed;  @endphp</td>                   

                      <td style="text-align:left">{{$data->owner}}</td>
                      <td style="text-align:left"><strong>{{$data->ocdesc}}</strong><br/>{{$data->classname}}/{{$data->subclassname}}</td>
                      <td class="text-center" style="text-align:center">
                        <button type="button" title="View List of Personnel" class="btn btn-outline-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="window.location.href = 'http://localhost/01rs2022/employee/dashboard/processflow/evaluate/7044/hfsrb/'"><i class="fa fa-eye"></i></button>&nbsp;
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
  