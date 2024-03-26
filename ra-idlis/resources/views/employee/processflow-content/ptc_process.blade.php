<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vQGwCqb08-Q1O47roBEYdCqshGnmUHBXrta7XZ6-6oX_Sp1rUNLxYIvGH8LuGXO0eJMSRltVL4Rv4P5/embed?start=true&loop=true&delayms=3000" frameborder="0" 
            width="470" height="350" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>
    

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
            <a href="{{  $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('/employee/dashboard/processflow/evaluate') :'#'}}">  <p>Documentary Evaluation (Submission of Floor Plan) &nbsp;</p></a>
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
            <a href="{{$grpid == 'NA' || $grpid == 'CS' ? asset('employee/dashboard/processflow/cashier') :'#'}}">    <p>Payment Confirmation</p> </a>
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
            <small><b>RLO/LO (HFSRB)</b></small>
            <a href="{{ $grpid == 'NA' || $grpid == 'DC' ? asset('/employee/dashboard/processflow/assignmentofhferc') : '#'}}">    <p>Assignment of Team (HFERC Operation)/</p></a>
        </td>
        @if($grpid == 'NA' || $grpid == 'DC')
        <!-- <td><a href="{{asset('/employee/dashboard/processflow/assignmentofhferc')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
        @endif
    </tr>
    <tr>
        <td>
            <h1>8</h1>
        </td>
        <td>
        <a href="{{$grpid == 'NA' || $grpid == 'DC' ? asset('employee/dashboard/processflow/evaluation') : '#'}}">  <p>Floor plan Evaluation and Chairperson Recommendation</p> </a>
        </td>
        @if($grpid == 'NA' || $grpid == 'DC')
        <!-- <td><a href="{{asset('employee/dashboard/processflow/evaluation')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
        @endif
    </tr>
    <tr>
        <td>
            <h1>9</h1>
        </td>
        <td>
            <small><b>Div Chief</b></small>
            <a href="{{ $grpid == 'NA' || $grpid == 'DC' ? asset('/employee/dashboard/processflow/recommendation') : '#' }}">   <p>Recommendation for Approval</p> </a>
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
            <a href="{{ $grpid == 'NA' || $grpid == 'DR' || $grpid == 'PO' ? asset('/employee/dashboard/processflow/approval') : '#'}}">     <p>Approval/Issuance of Certificate</p> </a>
        </td>
        @if($grpid == 'NA' || $grpid == 'DR' || $grpid == 'PO')
        <!-- <td><a href="{{asset('/employee/dashboard/processflow/approval')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
        @endif
    </tr>

</table>