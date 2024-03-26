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
        @include('employee.reports.license.rptLicenseFilter') 
      <div class="card-body table-responsive">
        
      <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr>
                  <td scope="col" style="text-align: center;">Region</td>
                  <td scope="col" style="text-align: center;">Complete Address</td>
                  <td scope="col" style="text-align: center;">Name of the Facilities</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>
                  <td scope="col" style="text-align: center;">Authorized No.Of Bed</td>

                  <td scope="col" style="text-align: center;">Head of Facility</td>
                  <td scope="col" style="text-align: center;">Name of Owner</td>
                  <td scope="col" style="text-align:center">Ownership</td>
                  <td scope="col" style="text-align:center">Class / Subclass</td>
                  <td scope="col" style="text-align:center">DOH Retained</td>

                  <td scope="col" style="text-align:center">Tel. No.</td>
                  <td scope="col" style="text-align:center">Fax No.</td>
                  <td scope="col" style="text-align:center">Email</td>
                  <td scope="col" style="text-align:center">Authorization Type</td>
                  <td scope="col" style="text-align:center">License ID</td>
                  
                  <td scope="col" style="text-align: center;">Date Issued</td>     
                  <td scope="col" style="text-align: center;">Remarks</td>                 
                  
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                @foreach ($LotsOfDatas as $data)

                    <tr>
                      <td style="text-align:center">{{$data->rgn_desc}}</td>
                      <td style="text-align:center">{{$data->street_number}} {{$data->street_name}} {{$data->brgyname}}, {{$data->cmname}}, {{$data->provname}} {{$data->zipcode}}</td>
                      <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                      <td style="text-align:left">{{( $data->hgpdesc ?? 'NOT FOUND')}} {{$data->facmdesc}}</td>
                      <td style="text-align:left">{{$data->noofbed}}</td>                      
                      
                      <td style="text-align:left">{{$data->approvingauthority}}, {{$data->approvingauthoritypos}}</td>
                      <td style="text-align:left">{{$data->owner}}</td>
                      <td style="text-align:left">{{$data->ocdesc}}</td>
                      <td style="text-align:left">{{$data->classname}}/{{$data->subclassname}}</td>
                      <td style="text-align:left">{{$data->doh_retained}}</td>
                      
                      <td style="text-align:left">{{$data->landline}}</td>
                      <td style="text-align:left">{{$data->faxnumber}}</td>
                      <td style="text-align:left">{{$data->email}}</td>
                      <td style="text-align:left">{{$data->hfser_id}}</td>  
                      <td style="text-align:left">{{$data->license_id}}</td>   

                      <td style="text-align:left">{{$data->issued_date}}</td>
                      <td style="text-align:left">{{$data->approvedRemark}}</td>
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
  