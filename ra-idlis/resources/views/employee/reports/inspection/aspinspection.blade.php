<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', $pg_title)
  @section('content')
  {{-- <input type="text" id="CurrentPage" hidden="" value="RIR003">  --}}
  <div class="content p-4">
  	<div class="card" style="width: 165vh;" >
  		<div class="card-header bg-white font-weight-bold">
        <h3> {{$pg_title}} </h3>
      </div>
        @include('employee.reports.inspection.rptInspectionFilter') 
      <div class="card-body table-responsive">
        
      <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr>
                  <td scope="col" style="text-align: center;">Region</td>
                  <td scope="col" style="text-align: center;">Complete Address</td>
                  <td scope="col" style="text-align: center;">Application Code</td>
                  <td scope="col" style="text-align: center;">Name of the Facility</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>
                  <td scope="col" style="text-align: center;">Tel.No.</td>
                  <td scope="col" style="text-align: center;">Fax.No.</td>
                  <td scope="col" style="text-align: center;">Email Address</td>
                  <td scope="col" style="text-align: center;">Head Of Facility</td>
                  <td scope="col" style="text-align: center;">Owner</td>
                  <td scope="col" style="text-align: center;">Payment</td>      
                  <td scope="col" style="text-align: center;">Date Applied</td>
                  <td scope="col" style="text-align: center;">Date Inspected</td>
                  <td scope="col" style="text-align:center">Type of Application</td>
                  <td scope="col" style="text-align:center">Remarks</td>
                  <td scope="col" style="text-align: center;">Team Leader</td>  
                  <td scope="col" style="text-align: center;">Status</td>                  
                  
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                @foreach ($LotsOfDatas as $data)

                    <tr>
                      <td style="text-align:center">{{$data->rgn_desc}}</td>
                      <td style="text-align:center">{{$data->street_number}} {{$data->street_name}} {{$data->brgyname}}, {{$data->cmname}}, {{$data->provname}} {{$data->zipcode}}</td>
                      <td style="text-align:center">{{$data->appid}}</td>
                      <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                      <td style="text-align:left">{{( $data->hgpdesc ?? 'NOT FOUND')}} </td>
                      <td style="text-align:left">{{$data->facmdesc}}</td>
                      <td style="text-align:left">@if(isset($data->t_date)){{date("F j, Y", strtotime($data->t_date)) }} @endif </td>
                      <td style="text-align:left">{{$data->formattedDateInspect}}  </td>
                      <td style="text-align:left">{{ $data->aptid}}/{{$data->hfser_id}} / {{ $data->ocdesc }} / {{$data->classname}} / No.Of Bed={{ $data->noofbed}} / No.Of Dialysis={{$data->noofbed}}</td>
                      <td style="text-align:left"></td>
                      <td style="text-align:left"></td>
                      <td style="text-align:left"></td>
                      <td style="text-align:left"></td>
                      <td style="text-align:left">{{$data->inspectorName}}</td>
                      <td style="text-align:left">{{$data->trns_desc}}</td>
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
  