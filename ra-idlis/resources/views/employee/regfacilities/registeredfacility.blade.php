<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Registered Facility')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PF001">

  <div class="content p-4" style="font-size:13px; margin-left:0px;" >
  	<div class="card" >
   
  		<div class="card-header bg-white font-weight-bold">
             <h3>Registered Facillities</h3> 
      </div>
      <form class="filter-options-form">
        @include('employee.regfacilities.arcFilter') 
      </form>
      <div class="card-body table-responsive backoffice-list">
        <div>   

          <table class="table table-hover" style="font-size:13px;" id="1example">
            <thead>
              <tr style="font-weight:bold;">
                  <td scope="col" style="text-align: center;">Options</td>
                  <td scope="col" style="text-align: center;">NHFR Code</td>
                  <td scope="col" style="text-align: center;">Reg.Facility Code</td>
                  <td scope="col" style="text-align: center;">Name of the Facility</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>
                  <td scope="col" style="text-align: center;">Ownernship</td>
                  <td scope="col" style="text-align: center;">Email</td>
                  <td scope="col" style="text-align: center;">System Username</td>
                  <td scope="col" style="text-align: center;">Region</td>
                  <td scope="col" style="text-align: center;">Assigned Region Office</td>                 
                  
              </tr>
            </thead>
            <tbody id="FilterdBody">
              @if (isset($LotsOfDatas))
                @foreach ($LotsOfDatas as $data)

                    <tr>
                      <td>
                        <center>
                          <a href="{{asset('employee/dashboard/facilityrecords')}}/{{$data->regfac_id}}" title="View detailed information for {{$data->facilityname}}" class="btn btn-outline-info form-control"><i class="fa fa-fw fa-desktop"></i></a>
                        </center>
                      </td>
                      <td style="text-align:center">{{$data->nhfcode}}</td>
                      <td style="text-align:center">{{$data->regfac_id}}</td>
                      <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                      <td style="text-align:left">{{( $data->facilitytype ?? 'NOT FOUND')}} </td>
                      <td style="text-align:left">{{$data->ocdesc}}</td>
                      <td style="text-align:left">{{$data->email}}</td>  
                      <td style="text-align:center">{{$data->uid}}</td>                    
                      <td style="text-align:left">{{$data->rgn_desc}}</td>
                      <td style="text-align:left">{{$data->asrgn_desc}}</td>
                    </tr>

                @endforeach
              @else
                  <tr><td colspan="10" class="text-center">No data available in table</td></tr>
              @endif 
            </tbody>
            <tfoot>
              <tr style="font-weight:bold;">
                  <td scope="col" style="text-align: center;">Options</td>
                  <td scope="col" style="text-align: center;">NHFR Code</td>
                  <td scope="col" style="text-align: center;">System Code</td>
                  <td scope="col" style="text-align: center;">Name of the Facility</td>
                  <td scope="col" style="text-align: center;">Type of Facility</td>
                  <td scope="col" style="text-align: center;">Ownernship</td>
                  <td scope="col" style="text-align: center;">Email</td>
                  <td scope="col" style="text-align: center;">System Username</td>
                  <td scope="col" style="text-align: center;">Region</td>
                  <td scope="col" style="text-align: center;">Assigned Region Office</td>                 
                  
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
  	</div>
  </div>
  
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />


<!-- https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js -->