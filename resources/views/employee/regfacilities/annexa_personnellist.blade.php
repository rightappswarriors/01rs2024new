<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('employee.regfacilities.template-regfacility')
  @section('title', $pg_title)
  @section('content-regfacility')
  {{-- <input type="text" id="CurrentPage" hidden="" value="RLR002">  --}}
  	<div class="card" >
  		<div class="card-header bg-white font-weight-bold">        
        <button class="btn btn-primary" onclick="window.history.back();">Back</button>
        <h3> {{$pg_title}} <br/> <strong> @if(isset($pg_regfac_id)) of [{{$pg_regfac_id}}] @endif @if(isset($pg_facilityname)){{$pg_facilityname}} @endif </strong></h3>
      </div>
        @include('employee.reports.ndhrhis.rptNDHRHIS_Personnel_Filter') 
      <div class="card-body table-responsive">
        
      <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr>
                  <td scope="col" style="text-align: center;">Prefix</td>
                  <td scope="col" style="text-align: center;">Personnel Name<br/> <italic>(Surname, First Name, Middle Name)</italic></td>
                  <td scope="col" style="text-align:center">Suffix</td>
                  <td scope="col" style="text-align: center;">PRC No./<br/>Validity To</td>
                  <td scope="col" style="text-align:center">Profession/<br/>Specialty</td>
                  <td scope="col" style="text-align: center;">Position</td>
                  <td scope="col" style="text-align: center;">Designation</td>
                  <td scope="col" style="text-align:center">Status</td>
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                @foreach ($LotsOfDatas as $data)

                    <tr>
                      <td style="text-align:left"><strong>{{$data->prefix}}</strong></td>
                      <td style="text-align:left"><strong>{{ucwords($data->surname)}}, {{ucwords($data->firstname)}} {{ucwords($data->middlename)}} </strong></td>
                      <td scope="col" style="text-align:center">{{strtoupper($data->suffix)}}</td>
                      <td style="text-align:left"><strong>{{$data->prcno}}</strong><br/>{{$data->validityPeriodTo}}</td>
                      <td style="text-align:left"><strong>{{$data->profession_official}}</strong><br/>{{$data->speciality}}</td>
                      <td style="text-align:left"><strong>{{$data->pos}}</strong><br/>@php if(isset($data->noofbed)) echo 'Authorized No.Of Bed: '.$data->noofbed;  @endphp</td>                   
                      <td scope="col" style="text-align:center">{{$data->designation}}</td>
                      <td style="text-align:left">{{$data->status}}</td>                      
                    </tr>

                @endforeach
              @endif 
            </tbody>
          </table>

      </div>
  	</div>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
  