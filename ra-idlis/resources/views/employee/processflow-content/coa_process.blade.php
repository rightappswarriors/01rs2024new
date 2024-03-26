<table>
    <tr>
        <td>
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
                        <p>Self Assessment</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h1>4</h1>
                    </td>
                    <td>
                        <p>Input Requirements</p>
                    </td>
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
                        <a href="{{$grpid == 'NA' || $grpid == 'CS' ? asset('employee/dashboard/processflow/cashier') : '#'}}">   <p>Payment Confirmation</p></a>
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
                        <small><b>Div Chief</b></small>
                        <a href="{{$grpid == 'NA' || $grpid == 'DC'  ? asset('employee/dashboard/others/monitoring/teams') : '#'}}">   <p>Assignment of Team</p></a>
                    </td>
                    @if($grpid == 'NA' || $grpid == 'DC' )
                    <!-- <td><a href="{{asset('employee/dashboard/others/monitoring/teams')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>

                <tr>
                    <td>
                        <h1>8</h1>
                    </td>
                    <td>

                    <a href="{{$grpid == 'NA' || $grpid == 'DC' ? asset('/employee/dashboard/processflow/inspection') : '#'}}"> <p>Inspection Schedule</p> </a>
                    </td>
                    @if($grpid == 'NA' || $grpid == 'DC' )
                    <!-- <td><a href="{{asset('/employee/dashboard/processflow/inspection')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>9</h1>
                    </td>
                    <td>
                        <small><b>LO(HFSRB)/RLO(Region)</b></small>
                        <a href="{{$grpid == 'NA' || $grpid == 'PO' || $grpid == 'DA' ? asset('/employee/dashboard/processflow/evaluate') : '#'}}">  <p>Documentary Evaluation</p> </a>
                    </td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('/employee/dashboard/processflow/evaluate')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>10 &nbsp;&nbsp;</h1>
                    </td>
                    <td>
                        <small><b>Div Chief</b></small>
                        <a href="{{ $grpid == 'NA' || $grpid == 'DC' ? asset('/employee/dashboard/processflow/recommendation') : '#'}}">  <p>Recommendation for Approval</p></a>
                    </td>
                    @if ($grpid == 'NA' || $grpid == "DC")
                    <!-- <td>&nbsp;&nbsp;<a href="{{ asset('/employee/dashboard/processflow/recommendation') }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>11</h1>
                    </td>
                    <td>
                        <small><b>Director</b></small>
                        <a href="{{$grpid == 'NA' || $grpid == 'DR' || $grpid == 'PO' ? asset('/employee/dashboard/processflow/approval') : '#'}}">   <p>Approval/Issuance of Certificate</p> </a>
                    </td>
                    @if($grpid == 'NA' || $grpid == 'DR' || $grpid == 'PO')
                    <!-- <td>&nbsp;&nbsp;<a href="{{asset('/employee/dashboard/processflow/approval')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>


            </table>
        </td>
        
        
    </tr>
</table>














<!-- 
    <tr>
        <td>
            <h1>4</h1>
        </td>
        <td>
            <small><b>RLO/Div Chief</b></small>
            <p>Documentary Evaluation (Submission of Floor Plan) &nbsp;</p>
        </td>
        @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
        <td><a href="{{asset('/employee/dashboard/processflow/evaluate')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td>
        @endif
    </tr>
    

  
    <tr>
        <td>
            <h1>7</h1>
        </td>
        <td>
            <small><b>RLO/LO (HFSRB)</b></small>
            <p>Assignment of Team (HFERC Operation)/</p>
        </td>
        @if($grpid == 'NA' || $grpid == 'DC')
        <td><a href="{{asset('/employee/dashboard/processflow/assignmentofhferc')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td>
        @endif
    </tr>
    <tr>
        <td>
            <h1>8</h1>
        </td>
        <td>
            <p>Floor plan Evaluation and Chairperson Recommendation</p>
        </td>
        @if($grpid == 'NA' || $grpid == 'DC')
        <td><a href="{{asset('employee/dashboard/processflow/evaluation')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td>
        @endif
    </tr>
   
    -->