<script src="//cdn.datatables.net/plug-ins/1.10.24/filtering/row-based/range_dates.js"></script>
<script src="https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js"></script>

@if (session()->exists('employee_login'))   
  @extends('employee.regfacilities.template-regfacility')
  @section('title', 'Registered Facility')
  @section('content-regfacility')
  
<!---------------------------------->
<div class="card-header bg-white font-weight-bold">            
    <div class="row">
        <div class="col-md-3">
            <input type="" id="token" value="{{ Session::token() }}" hidden>
                <a class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" href="{{asset('/employee/dashboard/facilityrecords')}}">Back</a>&nbsp;
        </div>
        <div class="col-md-6"><h2 class="text-center">Registered Facility Profile</h2></div>        
        <div class="col-md-3"></div>
    </div>
</div>
          
@php
    $employeeData = session('employee_login');
    $grpid = isset($employeeData->grpid) ? $employeeData->grpid : 'NONE';
@endphp

<div class="card-body">
    <div class="row">  
        @include('dashboard.client.forms.parts-change.main-form')
    </div>
</div>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />


<!-- https://cdn.datatables.net/datetime/1.0.3/js/dataTables.dateTime.min.js -->