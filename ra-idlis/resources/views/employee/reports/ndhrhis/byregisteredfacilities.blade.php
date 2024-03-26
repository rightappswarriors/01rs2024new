<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', $pg_title)
  @section('content')
  {{-- <input type="text" id="CurrentPage" hidden="" value="RLR002">  --}}
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
                <td scope="col" style="text-align:center">Registered ID</td>
                <td scope="col" style="text-align: center;">Name of the Facilities</td>
                <td scope="col" style="text-align: center;">Type of Facility</td>

                <td scope="col" style="text-align: center;">Name of Owner</td>
                <td scope="col" style="text-align:center">Ownership/ Classification</td>
                @if($viewtype != -1)   
                <td scope="col" style="text-align:center">Options</td>
                @endif 
            </tr>
          </thead>
          <tbody id="FilterdBody">
            @if (isset($LotsOfDatas))
              @foreach ($LotsOfDatas as $data)

                  <tr>
                    <td style="text-align:left"><strong>{{$data->rgn_desc}}</strong><br/>{{$data->street_number}} {{$data->street_name}} {{$data->brgyname}}, {{$data->cmname}}, {{$data->provname}} {{$data->zipcode}}</td>
                    <td scope="col" style="text-align:center"><strong>{{$data->nhfcode}}</strong></td>
                    <td scope="col" style="text-align:center">{{$data->regfac_id}}</td>
                    <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                    <td style="text-align:left"><strong>{{( $data->facilitytype ?? 'Facility Type Not Found.')}}</strong><br/>{{$data->facmdesc}}<br/>@php if(isset($data->noofbed)) echo 'Authorized No.Of Bed: '.$data->noofbed;  @endphp</td>                   

                    <td style="text-align:left">{{$data->owner}}</td>
                    <td style="text-align:left"><strong>{{$data->ocdesc}}</strong><br/>{{$data->classname}}</td>
                    @if($viewtype != -1)    
                    <td scope="col" style="text-align:center">           
                        @if($viewtype == 0)               
                        <button type="button" title="View Profile" class="btn btn-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="window.location.href = '{{asset('employee/regfacility/')}}/{{$data->regfac_id}}'"><i class="fa fa-building-o"></i></button>&nbsp; 
                        @endif 
                        @if($viewtype == 1 || $viewtype == 0)
                        <button type="button" title="View List of Personnel" class="btn btn-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="window.location.href = '{{asset('employee/regfacility/annexa')}}/{{$data->regfac_id}}'"><i class="fa fa-users"></i></button>&nbsp;  
                        @endif
                        <!-- button type="button" title="View List of Equipment" class="btn btn-primary ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="window.location.href = '{{asset('employee/regfacility/')}}/{{$data->regfac_id}}'"><i class="fa fa-wrench"></i></button --->
                    </td>
                    @endif 
                  </tr>

              @endforeach
            @endif 
          </tbody>
          <tfoot>
            <tr>
                <td scope="col" style="text-align: center;">Region / Complete Address</td>
                <td scope="col" style="text-align:center">NHFR Code</td>
                <td scope="col" style="text-align:center">Registered ID</td>
                <td scope="col" style="text-align: center;">Name of the Facilities</td>
                <td scope="col" style="text-align: center;">Type of Facility</td>

                <td scope="col" style="text-align: center;">Name of Owner</td>
                <td scope="col" style="text-align:center">Ownership/ Classification</td>
                @if($viewtype != -1)   
                <td scope="col" style="text-align:center">Options</td>
                @endif 
            </tr>
          </tfoot>
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
  