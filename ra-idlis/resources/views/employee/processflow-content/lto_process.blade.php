<iframe src="https://docs.google.com/presentation/d/e/2PACX-1vTO2cL05UOgGdExGo3BpGSWI7yB7u61GIFql-6auWdPCAebwpUo9RfuM67M3ukrZj7duMMeXp96zFtX/embed?start=true&loop=true&delayms=3000" 
frameborder="0" width="600" 
height="500" allowfullscreen="true" mozallowfullscreen="true" webkitallowfullscreen="true"></iframe>

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
                        
                        <p>Payment (Auto Generated Order of Payment)</p>
                    </td>

                </tr>
                <tr>
                    <td>
                        <h1>6</h1>
                    </td>
                </tr>   
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;<small><sup>6</sup></small><small>.1</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>
                        <small><b>Cashier</b></small>
                        <a href="{{ $grpid == 'NA' || $grpid == 'CS' ? asset('employee/dashboard/processflow/cashier') : '#'}}"> <p>Payment Confirmation</p>  </a>
                    </td>
                    @if($grpid == 'NA' || $grpid == 'CS')
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/cashier')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>

                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>6</sup></small><small></span>.2</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>

                    <a href="{{ $grpid == 'NA' || $grpid == 'CS' ? asset('employee/dashboard/processflow/FDA/cashier'): '#'}}">   <p>Payment Confirmation (Machine)</p> </a>
                    </td>
                    @if($grpid == 'NA' || $grpid == 'CS')
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/FDA/cashier')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>

                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>6</sup></small><small></span>.3</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>

                    <a href="{{ $grpid == 'NA' || $grpid == 'CS' ? asset('employee/dashboard/processflow/FDA/pharma/cashier') : '#'}}">   <p>Payment Confirmation (Pharmacy)</p> </a>
                    </td>
                    @if($grpid == 'NA' || $grpid == 'CS')
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/FDA/pharma/cashier')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>

                <tr>
                    <td>
                        <h1>7</h1>
                    </td>
                    <td>
                        <small><b>Div Chief</b></small>
                        <a  href="{{ $grpid == 'NA' || $grpid == 'DC' ? asset('/employee/dashboard/processflow/assignmentofteam') : '#'}}">   <p>Assignment of Team</p> </a>
                    </td>
                    @if($grpid == 'NA' || $grpid == 'DC' )
                    <!-- <td><a  href="{{asset('/employee/dashboard/processflow/assignmentofteam')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    <!-- <td><a href="{{asset('employee/dashboard/others/monitoring/teams')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>

                <tr>
                    <td>
                        <h1>8</h1>
                    </td>
                    <td>

                    <a href="{{ $grpid == 'NA' || $grpid == 'DC'  ? asset('/employee/dashboard/processflow/inspection')  : '#'}}"> <p>Inspection Schedule</p> </a>
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

                    <a href="{{ $grpid == 'NA' || $grpid == 'DC'  ? asset('/employee/dashboard/processflow/assessment')  : '#'}}"> <p>Assessment Tool</p> </a>
                    </td>
                    @if($grpid == 'NA' || $grpid == 'DC' )
                    <!-- <td><a href="{{asset('/employee/dashboard/processflow/inspection')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>10</h1>
                    </td>
                    <td>
                        <small><b>LO(HFSRB)/RLO(Region)</b></small>
                        <p> Inspection/Technical Evaluation</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;<small><sup>10</sup></small><small>.1</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>

                    <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('/employee/dashboard/processflow/evaluate/technical') : '#'}}"> <p>Technical Evaluation</p> </a>
                    </td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('/employee/dashboard/processflow/evaluate')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>


            </table>
        </td>
        <td style=" vertical-align:top">
            <table>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;<small><sup>10</sup></small><small>.2</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td><b>FDA</b></td>

                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><sup>10.2</sup></small><small>.1</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td><b>Radiation Facility</b></td>

                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><sup>10.2.1</sup></small><small>.1</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>  <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('employee/dashboard/processflow/pre-assessment/FDA/xray') : '#'}}"> Pre-Assessment </a></td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/pre-assessment/FDA/xray')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>10.2.1</sup></small></span><small>.2</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>    <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('/employee/dashboard/processflow/evaluate/FDA') : '#'}}">    Evaluation</a></td> 
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('/employee/dashboard/processflow/evaluate/FDA')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>10.2.1</sup></small></span><small>.3</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>  <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('employee/dashboard/processflow/FDA/recommendation/machines') : '#'}}"> Recommendation </a></td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/FDA/recommendation/machines')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>10.2.1</sup></small></span><small>.4</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>  <a href="{{  $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('employee/dashboard/processflow/FDA/approval/machines') : '#'}}">Final Decision </a></td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/FDA/approval/machines')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>10.2.1</sup></small></span><small>.5</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td> <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('employee/dashboard/processflow/FDA/monitoring/machines') :  '#'}}">Monitoring Tool </a></td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/FDA/monitoring/machines')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><sup>10.2</sup></small><small>.2</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td><b>Pharmacy</b></td>

                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<small><sup>10.2.2</sup></small><small>.1</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>    <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('employee/dashboard/processflow/pre-assessment/FDA/pharma') : '#'}}">Pre-Assessment </a></td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/pre-assessment/FDA/pharma')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>10.2.2</sup></small></span><small>.2</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>   <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('/employee/dashboard/processflow/evaluate/FDA/pharma') : '#'}}">  Evaluation </a></td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('/employee/dashboard/processflow/evaluate/FDA/pharma')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>10.2.1</sup></small></span><small>.3</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>  <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('employee/dashboard/processflow/FDA/recommendation/pharma') : '#'}}"> Recommendation </a></td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/FDA/recommendation/machines')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>10.2.2</sup></small></span><small>.4</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>  <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ? asset('employee/dashboard/processflow/FDA/approval/pharma') : '#'}}">  Final Decision </a></td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/FDA/approval/pharma')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="color: white;"><small><sup>10.2.2</sup></small></span><small>.5</small>&nbsp;&nbsp;</h1>
                    </td>
                    <td>    <a href="{{ $grpid == 'NA' || $grpid == 'PO' || $grpid == 'FDA' ?  asset('employee/dashboard/processflow/FDA/monitoring/pharma'): '#'}}"> Monitoring Tool </a></td>
                    @if ($grpid == 'NA' || $grpid == "PO" || $grpid == "FDA")
                    <!-- <td><a href="{{asset('employee/dashboard/processflow/FDA/monitoring/pharma')}}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>

            </table>
        </td>
        <td>
            &nbsp;&nbsp; &nbsp;&nbsp;
        </td>
        <td style=" vertical-align:top">
            <table>
                <tr>
                    <td>
                        <h1>11 &nbsp;&nbsp;</h1>
                    </td>
                    <td>
                        <small><b>Div Chief</b></small>
                        <a href="{{ $grpid == 'NA' || $grpid == 'DC' ? asset('/employee/dashboard/processflow/recommendation') : '#' }}"><p>Recommendation for Approval</p></a>
                    </td>
                    @if ($grpid == 'NA' || $grpid == "DC")
                    <!-- <td>&nbsp;&nbsp;<a href="{{ asset('/employee/dashboard/processflow/recommendation') }}"><i class="fa fa-angle-right" aria-hidden="true"></i></a></td> -->
                    @endif
                </tr>
                <tr>
                    <td>
                        <h1>12</h1>
                    </td>
                    <td>
                        <small><b>Director</b></small>
                        <a href="{{ $grpid == 'NA' || $grpid == 'DR' || $grpid == 'PO' ? asset('/employee/dashboard/processflow/approval') : '#'}}">  <p>Approval/Issuance of Certificate</p> </a>
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