<table>
    <tr>
        <td>
            <h1>1</h1>
        </td>
        <td>
            <small><b>Client</b></small>
            <p>Client Registration</p>

        </td>

    </tr>
    <tr>
        <td>
            <h1>2</h1>
        </td>
        <td>
            <p>Application</p>
        </td>
    </tr>
    <tr>
        <td>
            <h1>3</h1>
        </td>
        <td>
            <p>Input Requirements</p>
        </td>
    </tr>
    <tr>
        <td>
            <h1>4</h1>
        </td>
        <td>
            <small><b>RLO/Div Chief</b></small>
            <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('/employee/dashboard/processflow/evaluate') : '#'}}"> <p>Documentary Evaluation</p></a>
        </td>
         @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA") 
        <!-- <td><a href="{{asset('/employee/dashboard/processflow/evaluate')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
         @endif 
    </tr>
    <tr>
        <td>
            <h1>5</h1>
        </td>
        <td>
            <small><b>Client</b></small>
            <p>Payment (Auto Generated Order of Payment)</p>
        </td>

    </tr>

    <tr>
        <td>
            <h1>6</h1>
        </td>
        <td>
            <small><b>Cashier</b></small>
            <a href="{{$grpid == 'NA' || $grpid == 'CS' ? asset('employee/dashboard/processflow/cashier'): '#'}}">  <p>Payment Confirmation</p></a>
        </td>
         @if($grpid == 'NA' || $grpid == 'CS') 
        <!-- <td><a href="{{asset('employee/dashboard/processflow/cashier')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
         @endif 
    </tr>
    <tr>
        <td>
            <h1>7</h1>
        </td>
        <td>
            <small><b>RLO/Div Chief</b></small>
            <a href="{{$grpid == 'NA' || $grpid == 'DC' ? asset('/employee/dashboard/processflow/assignmentofcommittee') : '#'}}">  <p>Committee Assignment</p> </a>
        </td>
        @if($grpid == 'NA' || $grpid == 'DC')
        <!-- <td><a href="{{asset('/employee/dashboard/processflow/assignmentofcommittee')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
         @endif 
    </tr>
    <tr>
        <td>
            <h1>8</h1>
        </td>
        <td>
        <a href="{{$grpid == 'NA' || $grpid == 'DC' ? asset('employee/dashboard/processflow/conevaluation') : '#'}}">    <p>CON Evaluation</p> </a>
        </td>
        @if($grpid == 'NA' || $grpid == 'DC') 
        <!-- <td><a href="{{asset('employee/dashboard/processflow/conevaluation')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
         @endif 
    </tr>
    <tr>
        <td>
            <h1>9</h1>
        </td>
        <td>
            <small><b>Div Chief</b></small>
            <a href="{{ $grpid == 'NA' || $grpid == 'DC' ? asset('/employee/dashboard/processflow/recommendation') : '#' }}">     <p>Recommendation for Approval</p> </a>
        </td>
         @if ($grpid == 'NA' || $grpid == "DC") 
        <!-- <td><a href="{{ asset('/employee/dashboard/processflow/recommendation') }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
         @endif 
    </tr>
    <tr>
        <td>
            <h1>10</h1>
        </td>
        <td>
            <small><b>Director</b></small>
            <a href="{{ $grpid == 'NA' || $grpid == 'DR' || $grpid == 'PO' ? asset('/employee/dashboard/processflow/approval') : '#'}}">  <p>Approval/Issuance of Certificate</p> </a>
        </td>
        @if($grpid == 'NA' || $grpid == 'DR' || $grpid == 'PO') 
        <!-- <td><a href="{{asset('/employee/dashboard/processflow/approval')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
         @endif 
    </tr>
  
</table>