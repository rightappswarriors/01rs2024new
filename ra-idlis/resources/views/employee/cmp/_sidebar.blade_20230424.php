<div class="d-flex">

        <div class="sidebar sidebar-dark bg-dark" id="wrapper">

            <ul class="list-unstyled">

                <li class="MOD01_allow"><a href="{{asset('/employee/dashboard')}}"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                

                {{-- @if ($employeeData->grpid == 'NA' || $employeeData->grpid == 'RA')  --}}

                   <span class="MOD02_allow">

                       <li>

                        <a href="#sm_base" data-toggle="collapse">

                            <i class="fa fa-fw fa-wrench"></i> Master File

                        </a>

                        <ul id="sm_base" class="list-unstyled collapse">

                            <span class="MF001_allow">

                                <li><a href="#Tean" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-users"></i>&nbsp;Team</a>

                                    <ul id="Tean" class="list-unstyled collapse">

                                        <span class="TM001_allow">

                                            <li class="#"><a href="{{ asset('/employee/dashboard/mf/team') }}">&nbsp;&nbsp;&nbsp;&nbsp;Team</a></li>

                                        </span>

                                        <span class="TM002_allow">

                                        <li class="#"><a href="{{ asset('/employee/dashboard/mf/manage/teams') }}">&nbsp;&nbsp;&nbsp;&nbsp;Manage Team</a></li>

                                        </span>

                                    </ul>

                                </li>

                            </span>

                            <span class="MF002_allow">

                                <li><a href="#AppMenu" data-toggle="collapse">&nbsp;&nbsp;<i class="fas fa-clipboard-list"></i>&nbsp;Application</a>

                                    <ul id="AppMenu" class="list-unstyled collapse">

                                       {{-- @if ($employeeData->grpid == 'NA') --}}

                                        <span class="AP001_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/apptype') }}">&nbsp;&nbsp;&nbsp;&nbsp;Application Type</a></li>

                                        </span>
                                        
                                        <span class="AP001_allow">

                                            <li class="#"><a href="{{ asset('employee/regfacility') }}">&nbsp;&nbsp;&nbsp;&nbsp;Registered Facilities</a></li>

                                        </span>

                                        {{-- new --}}

                                        {{-- <span class="AP001_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/licenseValidity') }}">&nbsp;&nbsp;&nbsp;&nbsp;License Validity</a></li>

                                        </span> --}}

                                        <span class="AP002_allow"> 

                                            <li><a href="{{ asset('/employee/dashboard/mf/appstatus') }}">&nbsp;&nbsp;&nbsp;&nbsp;Application Status</a></li>

                                        </span>

                                        <span class="AP003_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/class') }}">&nbsp;&nbsp;&nbsp;&nbsp;Class</a></li>

                                        </span>

                                        {{-- @endif --}}

                                        <span class="AP004_allow">

                                            <li class=""><a href="{{ asset('/employee/dashboard/mf/holidays') }}">&nbsp;&nbsp;&nbsp;&nbsp;Holidays</a></li>

                                        </span>

                                       {{-- @if ($employeeData->grpid == 'NA')  --}}

                                        <span class="AP005_allow">

                                            <li><a href ="{{ asset('/employee/dashboard/mf/ownership') }}">&nbsp;&nbsp;&nbsp;&nbsp;Ownership</a></li>

                                        </span>

                                        <span class="AP006_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/functions') }}">&nbsp;&nbsp;&nbsp;&nbsp;Functions</a></li>

                                        </span>

                                        <span class="AP007_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/institutionalcharacter') }}">&nbsp;&nbsp;&nbsp;&nbsp;Institutional Character</a></li>

                                        </span>

                                        <span class="AP008_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/facility') }}">&nbsp;&nbsp;&nbsp;&nbsp;Facilities</a></li>

                                        </span>

                                        {{-- new 2/19/2019 --}}

                                        <span class="AP015_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/servicetype') }}">&nbsp;&nbsp;&nbsp;&nbsp;Service Type</a></li>

                                        </span>

                                        <span class="AP016_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/services') }}">&nbsp;&nbsp;&nbsp;&nbsp;Services</a></li>

                                        </span>

                                        <span class="AP016_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/For-Ambulance') }}">&nbsp;&nbsp;&nbsp;&nbsp;Ambulance Services</a></li>
                                            
                                        </span>

                                        {{-- new, start --}}
                                        <span class="AP016_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/servicesuploads') }}">&nbsp;&nbsp;&nbsp;&nbsp;Services Uploads</a></li>

                                        </span>


                                        <span class="AP019_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/manage/facilities') }}">&nbsp;&nbsp;&nbsp;&nbsp;Manage Facilities</a></li>

                                        </span>

                                        {{-- new --}}

                                        <span class="AP014_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/group/facilities') }}">&nbsp;&nbsp;&nbsp;&nbsp;Group Facilities</a></li>

                                        </span>



                                        {{-- new 2/20/2019 --}}

                                        <span class="AP017_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/applylocation') }}">&nbsp;&nbsp;&nbsp;&nbsp;Apply Location</a></li>

                                        </span>

                                        <span class="AP018_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/chargelocation') }}">&nbsp;&nbsp;&nbsp;&nbsp;Charge Location</a></li>

                                        </span>

                                        <span class="AP20_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/servicetype') }}">&nbsp;&nbsp;&nbsp;&nbsp;Payment Facility</a></li>

                                        </span>

                                        {{--<span class="PY009_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/payment/location') }}">&nbsp;&nbsp;&nbsp;&nbsp;Payment Location</a></li>

                                        </span>--}}

                                        {{-- end --}}



                                        {{-- <span class="">

                                            <li><a href="{{ asset('/employee/dashboard/mf/manage/services') }}">&nbsp;&nbsp;&nbsp;&nbsp;Manage Services</a></li>

                                        </span> --}}

                                        <span class="AP011_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/manage/requirements') }}">&nbsp;&nbsp;&nbsp;&nbsp;Manage Requirements</a></li>

                                        </span>

                                        <span class="AP012_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/transactionstatus') }}" >&nbsp;&nbsp;&nbsp;&nbsp;Transaction Status</a></li>

                                        </span>

                                        <span class="AP013_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/uploads') }}">&nbsp;&nbsp;&nbsp;&nbsp;Uploads</a></li>

                                        </span>

                                      {{--  @endif   ---}}

                                    </ul>

                                </li>

                            </span>

                             {{-- @if ($employeeData->grpid == 'NA')  --}}

                            <li><a href="#PersoMenu" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-users"></i>&nbsp;Personnel</a>

                                <span class="MF003_allow">

                                    <ul id="PersoMenu" class="list-unstyled collapse">

                                        <span class="PR001_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/department') }}">&nbsp;&nbsp;&nbsp;&nbsp;Department</a></li>

                                        </span>

                                        <span class="PR002_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/section') }}">&nbsp;&nbsp;&nbsp;&nbsp;Section</a></li>

                                        </span>

                                        <li class="" style="display: none"><a href="{{-- {{ asset('/employee/dashboard/mf/personnel') }} --}}#">&nbsp;&nbsp;&nbsp;&nbsp;Personnel</a></li>

                                        <li class="" style="display: none"><a href="{{-- {{ asset('/employee/dashboard/mf/litype') }} --}}#">&nbsp;&nbsp;&nbsp;&nbsp;Education/Trainings</a></li>

                                        <span class="PR003_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/position') }}">&nbsp;&nbsp;&nbsp;&nbsp;Position</a></li>

                                        </span>

                                        <span class="PR003_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/profession') }}">&nbsp;&nbsp;&nbsp;&nbsp;Profession</a></li>

                                        </span>

                                        <span class="PR004_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/workstatus') }}">&nbsp;&nbsp;&nbsp;&nbsp;Work Status</a></li>

                                        </span>

                                        <li class="" style="display:none"><a href="{{-- {{ asset('/employee/dashboard/mf/eligibility') }} --}}#">&nbsp;&nbsp;&nbsp;&nbsp;Eligibility</a></li>

                                        <span class="PR005_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/licensetype') }}">&nbsp;&nbsp;&nbsp;&nbsp;License Type</a></li>

                                        </span>

                                        <span class="PR006_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/training') }}">&nbsp;&nbsp;&nbsp;&nbsp;Training</a></li>

                                        </span>

                                    </ul>

                                </span>

                            </li>

                            <span class="MF004_allow">

                                <li><a href="#phil" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-flag"></i>&nbsp;Places</a>

                                    <ul id="phil" class="list-unstyled collapse">

                                        <span class="PL001_allow">

                                            <li><a href="{{ asset('/employee/dashboard/ph/regions') }}">&nbsp;&nbsp;&nbsp;&nbsp;Regions</a></li>

                                        </span>

                                        <span class="PL002_allow">

                                            <li><a href="{{ asset('/employee/dashboard/ph/provinces') }}">&nbsp;&nbsp;&nbsp;&nbsp;Provinces</a></li>

                                        </span>

                                        <span class="PL003_allow">

                                            <li><a href="{{ asset('/employee/dashboard/ph/citymunicipality') }}">&nbsp;&nbsp;&nbsp;&nbsp;City/Municipalities</a></li>

                                        </span>

                                        <span class="PL004_allow">

                                            <li><a href="{{ asset('/employee/dashboard/ph/barangay') }}">&nbsp;&nbsp;&nbsp;&nbsp;Barangay</a></li>

                                        </span>

                                    </ul>

                                </li>

                            </span>

                            <span class="MF005_allow">

                                <li><a href="#pay" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-credit-card"></i>&nbsp;Payment</a>

                                    <ul id="pay" class="list-unstyled collapse">

                                        <span class="PY001_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/orderofpayment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Order of Payment</a></li>

                                        </span>

                                        <span class="PY001_allow">

                                        <li><a href="{{ asset('/employee/dashboard/mf/surcharge') }}">&nbsp;&nbsp;&nbsp;&nbsp;Surcharge</a></li>

                                        </span>

                                        <span class="PY001_allow">

                                        <li><a href="{{ asset('/employee/dashboard/mf/discount') }}">&nbsp;&nbsp;&nbsp;&nbsp;Discount</a></li>

                                        </span>

                                        <span class="PY002_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/category') }}">&nbsp;&nbsp;&nbsp;&nbsp;Category</a></li>

                                        </span>

                                        <span class="PY003_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/charges') }}">&nbsp;&nbsp;&nbsp;&nbsp;Charges</a></li>

                                        </span>

                                        <span class="PY004_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/charge_fees') }}">&nbsp;&nbsp;&nbsp;&nbsp;Charges Fees</a></li>

                                        </span> 
                                        
                                        <span class="PY004_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/manage/charges') }}">&nbsp;&nbsp;&nbsp;&nbsp;Manage Charges</a></li>

                                        </span> 

                                        {{-- NEW --}}

                                        <span class="PY007_allow">

                                            <li><a href="{{ asset('employee/dashboard/mf/uacs') }}">&nbsp;&nbsp;&nbsp;&nbsp;UACS</a></li>

                                        </span>

                                        <span class="PY005_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/modeofpayment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Mode of Payment</a></li>

                                        </span>

                                        {{-- <span class="PY006_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/defaultpayment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Default Payment</a></li>

                                        </span> --}}

                                        

                                        <span class="PY008_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/service_charges') }}">&nbsp;&nbsp;&nbsp;&nbsp;Service Charges</a></li>

                                        </span>
                                        {{--  new 2/20/2019 --}}
                                        <span class="PY008_allow">
                                            <li><a href="{{ asset('/employee/dashboard/mf/service_fees') }}">&nbsp;&nbsp;&nbsp;&nbsp;Service Fees</a></li>

                                        </span>
                                        {{-- <span class="PY008_allow">
                                            <li><a href="{{ asset('/employee/dashboard/mf/category_fees') }}">&nbsp;&nbsp;&nbsp;&nbsp;Category Fees</a></li>

                                        </span> --}}

                                    </ul>                           

                                </li>

                            </span>

                            <span class="MF006_allow">

                                <li><a href="#AssMenu" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-tasks"></i>&nbsp;Assessment</a>

                                    <ul id="AssMenu" class="list-unstyled collapse">

                                        {{-- <span class="AT001_allow"> --}}

                                            {{-- <li><a href="{{ asset('/employee/dashboard/mf/part') }}">&nbsp;&nbsp;&nbsp;&nbsp;Part</a></li> --}}

                                        {{-- </span> --}}

                                        {{-- <span class="AT002_allow"> --}}

                                            {{-- <li><a href="{{ asset('/employee/dashboard/mf/cat_assessment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Category</a></li> --}}

                                        {{-- </span> --}}

                                        {{-- <li class=""><a href="{{ asset('/employee/dashboard/mf/csuba_assessment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Subcategory A</a></li> --}}

                                        {{-- <li class=""><a href="{{ asset('/employee/dashboard/mf/csubb_assessment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Subcategory B</a></li> --}}

                                        {{-- <span class="AT003_allow"> --}}

                                            {{-- <li><a href="{{ asset('/employee/dashboard/mf/assessment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Assessment</a></li> --}}

                                        {{-- </span> --}}

                                        {{-- <span class="AT004_allow"> --}}

                                            {{-- <li><a href="{{ asset('/employee/dashboard/mf/manage/assessment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Manage Assessment</a></li> --}}

                                        {{-- </span> --}}

                                      <span class="AT001_allow">

                                           <li><a href="{{ asset('/employee/mf/assessmentpart') }}">&nbsp;&nbsp;&nbsp;&nbsp;Part</a></li>

                                       </span>
                                        
                                      <span class="AT001_allow">

                                           <li><a href="{{ asset('employee/mf/headerOne') }}">&nbsp;&nbsp;&nbsp;&nbsp;Header 1</a></li>

                                       </span>

                                       <span class="AT001_allow">

                                           <li><a href="{{ asset('employee/mf/headerTwo') }}">&nbsp;&nbsp;&nbsp;&nbsp;Header 2</a></li>

                                       </span>

                                       <span class="AT001_allow">

                                           <li><a href="{{ asset('employee/mf/headerThree') }}">&nbsp;&nbsp;&nbsp;&nbsp;Header 3</a></li>

                                       </span>

                                       <span class="AT001_allow">

                                           <li><a href="{{ asset('employee/mf/AssessmentCombine') }}">&nbsp;&nbsp;&nbsp;&nbsp;Assessment Combine</a></li>

                                       </span>


                                       {{-- <span class="AT002_allow">

                                           <li><a href="{{ asset('/employee/mf/assessmentheader') }}">&nbsp;&nbsp;&nbsp;&nbsp;Header</a></li>

                                       </span> --}}

                                       {{-- <span class="AT005_allow">

                                           <li><a href="{{ asset('/employee/dashboard/mf/assessment/sub_description') }}">&nbsp;&nbsp;&nbsp;&nbsp;Sub-Description</a></li>

                                       </span> --}}

                                      {{--  <span class="AT006_allow">

                                           <li><a href="{{ asset('employee/mf/assessment/column') }}">&nbsp;&nbsp;&nbsp;&nbsp;Columns</a></li>

                                       </span> --}}

                                       {{-- <span class="AT003_allow">

                                           <li><a href="{{ asset('/employee/dashboard/mf/assessment2') }}">&nbsp;&nbsp;&nbsp;&nbsp;Assessment</a></li>

                                       </span> --}}

                                      {{--  <span class="AT004_allow">

                                           <li><a href="{{ asset('employee/dashboard/mf/manage/assessment2') }}">&nbsp;&nbsp;&nbsp;&nbsp;Manage Assessment</a></li>

                                       </span> --}}

                                      {{--  <span class="AT004_allow">

                                           <li><a href="{{ asset('employee/dashboard/mf/manage/preview_assessment') }}">&nbsp;&nbsp;&nbsp;&nbsp;View Assessment</a></li>

                                       </span> --}}
                                       
                                      {{--  <span class="AT007_allow">

                                           <li><a href="{{ asset('employee/dashboard/mf/manage/preview_unmanaged_assessment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Preview Unmanaged Assessment</a></li>

                                       </span> --}}

                                    </ul>

                                </li>

                            </span>

                            {{-- new --}}

                            <span class="MF009_allow">

                                <li><a href="#MFDA" data-toggle="collapse">&nbsp;&nbsp;<i class="fas fa-tablets"></i>&nbsp;FDA</a>

                                    <ul id="MFDA" class="list-unstyled collapse">

                                        <span class="FD010_allow">

                                           <li><a href="{{ asset('/employee/mf/FDA/ranges') }}">&nbsp;&nbsp;&nbsp;&nbsp;Price Range</a></li>

                                        </span>

                                        <span class="FD005_allow">

                                           <li><a href="{{ asset('employee/dashboard/mf/FDA/pharma_charges') }}">&nbsp;&nbsp;&nbsp;&nbsp;Pharma Charges</a></li>

                                        </span>

                                        <span class="FD007_allow">

                                           <li><a href="{{ asset('employee/mf/FDA/xraytype') }}">&nbsp;&nbsp;&nbsp;&nbsp;X-Ray Type</a></li>

                                        </span>

                                         <span class="FD003_allow">

                                           <li><a href="{{ asset('employee/mf/FDA/xrayloc') }}">&nbsp;&nbsp;&nbsp;&nbsp;X-Ray Location</a></li>

                                        </span>

                                        <span class="FD004_allow">

                                           <li><a href="{{ asset('employee/mf/FDA/xraycat') }}">&nbsp;&nbsp;&nbsp;&nbsp;X-Ray Category</a></li>

                                        </span>

                                        <span class="FD006_allow">

                                           <li><a href="{{ asset('employee/mf/FDA/xrayserv') }}">&nbsp;&nbsp;&nbsp;&nbsp;X-Ray Service</a></li>

                                        </span>

                                        <span class="FD012_allow">

                                           <li><a href="{{ asset('/employee/mf/FDA/machines/requirements') }}">&nbsp;&nbsp;&nbsp;&nbsp;Radiation Facility Requirements</a></li>
                                           <!-- <li><a href="{{ asset('/employee/mf/FDA/machines/requirements') }}">&nbsp;&nbsp;&nbsp;&nbsp;Machine Requirements</a></li> -->

                                        </span>

                                    </ul>

                                </li>

                            </span>

                            <span class="MF007_allow">

                                <li><a href="#OthMenu" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-clipboard"></i>&nbsp;Others</a>

                                    <ul id="OthMenu" class="list-unstyled collapse">

                                        <span class="OH003_allow">

                                            <li><a href="{{ asset('/employee/dashboard/ph/branch') }}">&nbsp;&nbsp;&nbsp;&nbsp;Regional Offices</a></li>

                                        </span>

                                        <span class="OH001_allow">

                                            <li><a href="{{ asset('/employee/dashboard/mf/complaints') }}">&nbsp;&nbsp;&nbsp;&nbsp;Complaints</a></li>

                                        </span>

                                        <span class="OH002_allow">

                                            <li class=""><a href="{{ asset('/employee/dashboard/mf/requestforassistance') }}">&nbsp;&nbsp;&nbsp;&nbsp;Request for Assistance</a></li>

                                        </span>

                                        <span class="OH002_allow">

                                            <li class=""><a href="{{ asset('employee/dashboard/ph/notificationMessages') }}">&nbsp;&nbsp;&nbsp;&nbsp;Notification Messages</a></li>

                                        </span>

                                    </ul>

                                </li>

                            </span>

                         {{--   @endif --}} 

                        </ul>

                    </li>

                   </span>

               {{-- @endif --}} 

                <span class="MOD03_allow">

                    <li><a href="#ProFlowMenu" data-toggle="collapse"><i class="fa fa-sitemap"></i> Licensing </a>

                        <ul id="ProFlowMenu" class="list-unstyled collapse">

                            {{-- @if($employeeData->grpid != 'CS' || $employeeData->grpid != "C") --}}

                            <span class="PF001_allow">

                                <li><a href="{{asset('/employee/dashboard/processflow/view')}}">&nbsp;&nbsp;&nbsp;&nbsp;View Application Status</a></li>

                            </span>
                            
                            {{-- @endif --}}

                            {{-- @if ($employeeData->grpid == 'NA' || $employeeData->grpid == "PO" || $employeeData->grpid == "FDA") --}}

                            <span class="PF002_allow">

                                <li><a href="{{asset('/employee/dashboard/processflow/evaluate')}}">&nbsp;&nbsp;&nbsp;&nbsp;Documentary Evaluation</a></li>

                            </span>
                             <span class="PF002_allow">

                                <li><a href="{{asset('/employee/dashboard/processflow/evaluate/technical')}}">&nbsp;&nbsp;&nbsp;&nbsp;Technical Evaluation</a></li>

                            </span>

                            <span class="PF002_allow">

                            <li><a href="{{asset('/employee/dashboard/processflow/compliance')}}">&nbsp;&nbsp;&nbsp;&nbsp;For Compliance</a></li>

                            </span>

                            {{-- @endif --}}

                            {{-- @if($employeeData->grpid == 'NA' || $employeeData->grpid == 'CS' || $employeeData->grpid == 'FDA' || $employeeData->grpid == 'PO') --}}

                            <!-- <span class="PF003_allow">

                                <li><a href="{{ asset('employee/dashboard/processflow/orderofpayment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Order of Payment</a></li>

                            </span> -->

                            {{-- @endif --}}

                            {{-- @if($employeeData->grpid == 'NA' || $employeeData->grpid == 'DC') --}}

                            <span class="text-white PF014_allow"></span>
                            <span class="PF014_allow">

                                <li class="border-top"><a href="{{asset('/employee/dashboard/processflow/assignmentofcommittee')}}">&nbsp;&nbsp;&nbsp;&nbsp;CON Committee Assignment</a></li>

                            </span>

                            <span class="PF015_allow">

                                <li><a href="{{asset('employee/dashboard/processflow/conevaluation')}}">&nbsp;&nbsp;&nbsp;&nbsp;CON Evaluation</a></li>

                            </span>
                            <span class="text-white PF012_allow"></span>

                            {{-- new 2/22/2019 --}}

                            <span class="PF012_allow">

                                <li class="border-top"><a href="{{asset('/employee/dashboard/processflow/assignmentofhferc')}}">&nbsp;&nbsp;&nbsp;&nbsp;HFERC Operations </a></li>

                            </span>

                             <span class="PF013_allow">

                                <li><a href="{{asset('employee/dashboard/processflow/evaluation')}}">&nbsp;&nbsp;&nbsp;&nbsp;Checklist for review of Floor Plan</a></li>

                            </span>

                            <span class="text-white PF010_allow"></span>



                            <span class="PF010_allow">

                                <li class="border-top"><a href="{{asset('/employee/dashboard/processflow/assignmentofteam')}}">&nbsp;&nbsp;&nbsp;&nbsp;Assignment of Team</a></li>

                            </span>


                            {{-- new --}}

                            <span class="PF011_allow">

                                <li><a href="{{asset('/employee/dashboard/processflow/inspection')}}">&nbsp;&nbsp;&nbsp;&nbsp;Inspection Schedule</a></li>

                            </span>

                            {{-- @endif --}}

                            {{-- @if($employeeData->grpid == 'NA' || $employeeData->grpid == 'FDA' || $employeeData->grpid == 'TE' || $employeeData->grpid == 'LO') --}}

                            <span class="PF009_allow">

                                <li><a href="{{asset('/employee/dashboard/processflow/assessment')}}">&nbsp;&nbsp;&nbsp;&nbsp;Assessment Tool</a></li>

                            </span>

                            {{-- <span class="PF009_allow">

                                <li><a href="{{asset('/employee/dashboard/processflow/assessment')}}">&nbsp;&nbsp;&nbsp;&nbsp;For Compliance</a></li>

                            </span> --}}
                            
                            <span class="text-white PF006_allow"></span>
                            {{-- new 2/23/2019 --}}


                            {{-- @endif --}}

                            {{-- @if ($employeeData->grpid == 'NA' || $employeeData->grpid == "DC") --}}

                            <span class="PF006_allow">

                                <li class="border-top"><a href="{{ asset('/employee/dashboard/processflow/recommendation') }}">&nbsp;&nbsp;&nbsp;&nbsp;Recommendation For Approval</a></li>

                            </span>

                            {{-- @endif --}}

                            {{-- @if($employeeData->grpid == 'NA' || $employeeData->grpid == 'DR' || $employeeData->grpid == 'PO') --}}

                            <span class="PF007_allow">

                                <li><a href="{{asset('/employee/dashboard/processflow/approval')}}">&nbsp;&nbsp;&nbsp;&nbsp;For Approval and Issuance of Certificate</a></li>

                            </span>

                            {{-- @endif --}}

                            {{-- @if($employeeData->grpid != 'CS' || $employeeData->grpid != "C") --}}

                            <span class="PF008_allow">

                                <li><a href="{{asset('/employee/dashboard/processflow/failed')}}">&nbsp;&nbsp;&nbsp;&nbsp;Failed Applications</a></li>

                            </span>

                            {{-- @endif --}}

                        </ul>

                    </li>

                </span>



                {{-- new --}}

                <span class="MOD010_allow">

                    <li><a href="#cashier" data-toggle="collapse"><i class="far fa-money-bill-alt"></i> 

                     Cashiering</a>

                        <ul  id="cashier" class="list-unstyled collapse">

                            <span class="PF004_allow">

                                <li><a href="{{asset('employee/dashboard/processflow/cashier')}}">&nbsp;&nbsp;&nbsp;&nbsp;Cashiering </a></li>

                            </span>

                            <span class="FDACM_allow">

                                <li><a href="{{asset('employee/dashboard/processflow/FDA/cashier')}}">&nbsp;&nbsp;&nbsp;&nbsp;FDA Cashiering (Radiation Facility)</a></li>

                            </span>

                            <span class="FD011_allow">

                                <li><a href="{{asset('employee/dashboard/processflow/FDA/pharma/cashier')}}">&nbsp;&nbsp;&nbsp;&nbsp;FDA Cashiering (Pharmacy)</a></li>

                            </span>

                        </ul>

                    </li>

                </span>



                {{-- new --}}

                <span class="MOD011_allow">

                    <li><a href="#FDA" data-toggle="collapse"><i class="fa fa-sitemap"></i> FDA</a>

                        <ul class="list-unstyled">
                            <ul id="FDA" class="list-unstyled collapse">
                                {{-- machines --}}
                                <li class="FDAM_allow"><a href="#machines" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Radiation facility</a>
                                <!-- <li class="FDAM_allow"><a href="#machines" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-cog" aria-hidden="true"></i>&nbsp;Machines</a> -->
                                    <ul id="machines" class="list-unstyled collapse">

                                        <span class="FD008_allow">

                                            {{-- <li><a href="{{ asset('employee/dashboard/processflow/FDA/machines/orderofpayment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Order of Payment</a></li> --}}

                                        </span>

                                        <span class="FDAMPA_allow">

                                            <li><a href="{{asset('employee/dashboard/processflow/pre-assessment/FDA/xray')}}">&nbsp;&nbsp;&nbsp;&nbsp;Pre-Assessment</a></li>

                                        </span>

                                        <span class="FDAME_allow">

                                            <li><a href="{{asset('/employee/dashboard/processflow/evaluate/FDA')}}">&nbsp;&nbsp;&nbsp;&nbsp;Inspection</a></li>
                                            <!-- <li><a href="{{asset('/employee/dashboard/processflow/evaluate/FDA')}}">&nbsp;&nbsp;&nbsp;&nbsp;Evaluation</a></li> -->

                                        </span>

                                        <span class="FDAMR_allow">

                                            <li><a href="{{asset('employee/dashboard/processflow/FDA/recommendation/machines')}}">&nbsp;&nbsp;&nbsp;&nbsp;Recommendation</a></li>

                                        </span>

                                        <span class="FDAMF_allow">

                                            <li><a href="{{asset('employee/dashboard/processflow/FDA/approval/machines')}}">&nbsp;&nbsp;&nbsp;&nbsp;Final Decision</a></li>

                                        </span>

                                        <span class="FDAMMON_allow">

                                            <li><a href="{{asset('employee/dashboard/processflow/FDA/monitoring/machines')}}">&nbsp;&nbsp;&nbsp;&nbsp;Monitoring Tool</a></li>

                                        </span>
                                        
                                    </ul>

                                </li>
                                {{-- phama --}}
                                <li class="FDAP_allow"><a href="#pharma" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-medkit" aria-hidden="true"></i>&nbsp;Pharmacy</a>
                                    <ul id="pharma" class="list-unstyled collapse">

                                        <span class="FD008_allow">

                                            {{-- <li><a href="{{ asset('employee/dashboard/processflow/FDA/pharma/orderofpayment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Order of Payment</a></li> --}}

                                        </span>

                                        <span class="FDAPPA_allow">

                                            <li><a href="{{asset('employee/dashboard/processflow/pre-assessment/FDA/pharma')}}">&nbsp;&nbsp;&nbsp;&nbsp;Pre-Assessment</a></li>

                                        </span>

                                        <span class="FDAPE_allow">

                                            <li><a href="{{asset('/employee/dashboard/processflow/evaluate/FDA/pharma')}}">&nbsp;&nbsp;&nbsp;&nbsp;Inspection</a></li>
                                            <!-- <li><a href="{{asset('/employee/dashboard/processflow/evaluate/FDA/pharma')}}">&nbsp;&nbsp;&nbsp;&nbsp;Evaluation</a></li> -->

                                        </span>

                                        <span class="FDAPR_allow">

                                            <li><a href="{{asset('employee/dashboard/processflow/FDA/recommendation/pharma')}}">&nbsp;&nbsp;&nbsp;&nbsp;Recommendation</a></li>

                                            </span>

                                        <span class="FDAPF_allow">

                                            <li><a href="{{asset('employee/dashboard/processflow/FDA/approval/pharma')}}">&nbsp;&nbsp;&nbsp;&nbsp;Final Decision</a></li>

                                        </span>

                                        <span class="FDAPMON_allow">

                                            <li><a href="{{asset('employee/dashboard/processflow/FDA/monitoring/pharma')}}">&nbsp;&nbsp;&nbsp;&nbsp;Monitoring Tool</a></li>

                                        </span>
                                        
                                    </ul>

                                </li>

                            </ul>


                        </ul>

                    </li>

                </span>



                {{-- //////////////////////// Lloyd - Nov 26, 2018////////////////////////// --}}

                {{--

                <span class="MOD07_allow">

                    <li>

                        <a href="#AssessmentMenu" data-toggle="collapse"><i class="fa fa-cogs" aria-hidden="true"></i> Assessment Tool</a>

                        <ul id="AssessmentMenu" class="list-unstyled collapse">

                            <span class="AS001_allow">

                                <li>

                                    <span class="HP001_allow">

                                        <li><a href="#Hospital" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-hospital-o" aria-hidden="true"></i>&nbsp;Hospital</a>

                                            <ul id="Hospital" class="list-unstyled collapse">

                                                <span class="PT004">

                                                    <li>

                                                        <a href="#Part02" data-toggle="collapse">

                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-list-ul" aria-hidden="true">

                                                            </i>&nbsp;Part II

                                                        </a>

                                                        <ul id="Part02" class="list-unstyled collapse">

                                                            <span class="HNS001">

                                                                <li class="#">

                                                                    <a href="{{ asset('/employee/dashboard/assessment/nursingservice') }}">

                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nursing Service

                                                                    </a>

                                                                </li>

                                                            </span>

                                                        </ul>



                                                        <a href="#Part03" data-toggle="collapse">

                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-list-ul" aria-hidden="true">

                                                            </i>&nbsp;Part III

                                                        </a>

                                                        <ul id="Part03" class="list-unstyled collapse">

                                                            <span class="HPP001">

                                                                <li class="#">

                                                                    <a href="{{ asset('/employee/dashboard/assessment/physicalplant') }}">

                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Physical Plant

                                                                    </a>

                                                                </li>

                                                            </span>

                                                        </ul>



                                                        <a href="#Part04" data-toggle="collapse">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-list-ul" aria-hidden="true"></i>&nbsp;Part IV</a>

                                                        <ul id="Part04" class="list-unstyled collapse">

                                                            <span class="LV001_allow">

                                                                <li class="#">

                                                                    <a href="{{ asset('/employee/dashboard/assessment/hospitallevel1') }}">

                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Level 1

                                                                    </a>

                                                                </li>

                                                            </span>

                                                            <span class="LV002_allow">

                                                                <li class="#">

                                                                    <a href="{{ asset('/employee/dashboard/assessment/hospitallevel2') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Level 2</a>

                                                                </li>

                                                            </span>

                                                            <span class="LV003_allow">

                                                                <li class="#">

                                                                    <a href="{{ asset('/employee/dashboard/assessment/hospitallevel3') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Level 3</a>

                                                                </li>

                                                            </span>

                                                        </ul>

                                                    </li>

                                                </span>       

                                            </ul>

                                        </li>

                                        <li>

                                            <a href="#HF" data-toggle="collapse">&nbsp;&nbsp;<i class="fa fa-hospital-o" aria-hidden="true"></i>&nbsp;Health Facilities</a>

                                            <ul id="HF" class="list-unstyled collapse">

                                                <span class="DC001">

                                                    <li class="#">

                                                        <a href="{{ asset('/employee/dashboard/assessment/dialysisclinic') }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dialysis Clinic</a>

                                                    </li>

                                                </span>

                                                <span class="SC001">

                                                    <li class="#">

                                                        <a href="{{ asset('/employee/dashboard/assessment/ambsurclinic')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Surgical Clinic</a>

                                                    </li>

                                                </span>

                                            </ul>

                                        </li>

                                    </span>

                                </li>

                            </span>

                        </ul>

                    </li>

                </span> --}}



                <!-- Monitoring -->

                <span class="MOD08_allow">

                    <li><a href="#MonitorMenu" data-toggle="collapse"><i class="fa fa-desktop" aria-hidden="true"></i> Monitoring</a>

                        <ul id="MonitorMenu" class="list-unstyled collapse">

                            <span class="MO001_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/monitoring')}}">&nbsp;&nbsp;Monitoring Entry</a>

                                </li>

                            </span>

                            <span class="MO002_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/monitoring/teams')}}">&nbsp;&nbsp;Assignment of Team</a>

                                </li>

                            </span>

                            <span class="MO003_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/monitoring/inspection')}}">&nbsp;&nbsp;HF Assessment Tool</a>

                                </li>

                            </span>

                            <span class="MO003_5_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/monitoring/technical')}}">&nbsp;&nbsp;Technical Findings</a>

                                </li>

                            </span>

                            {{-- <span class="MO004_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/monitoring/recommendation')}}">&nbsp;&nbsp;Recommendation of <br>&nbsp;&nbsp;Technical Staff</a>

                                </li>

                            </span> --}}

                            <span class="MO004_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/monitoring/updatestatus')}}">&nbsp;&nbsp;Update Status of CA</a>

                                </li>

                            </span>

                            {{-- <span class="MO005_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/monitoring/')}}">&nbsp;&nbsp;Evaluation</a>

                                </li>

                            </span>

                            <span class="MO006_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/monitoring/')}}">&nbsp;&nbsp;Send Letter</a>

                                </li>

                            </span> --}}

                        </ul>

                    </li>

                </span>



                {{-- /////////////////////////////////////////////////////////////////////// --}}



                <span class="MOD04_allow">

                    <li><a href="#MonitorxMenu" data-toggle="collapse"><i class="fa fa-handshake-o" aria-hidden="true"></i> RFA/Complaints</a>

                        <ul id="MonitorxMenu" class="list-unstyled collapse">

                            {{-- <span class="OT001_allow">

                                <li><a href="{{asset('employee/dashboard/others/monitoring')}}">&nbsp;&nbsp;&nbsp;&nbsp;Monitoring</a></li>

                            </span> --}}

                            {{-- <span class="OT001_allow">

                                <li><a href="{{asset('employee/dashboard/others/monitoring')}}">&nbsp;&nbsp;&nbsp;&nbsp;Monitoring</a></li>

                            </span> --}}

                            <span class="OT001_allow">

                                <!--<li>

                                    <a href="#Monitoring" data-toggle="collapse"><i class="fa fa-desktop" aria-hidden="true"></i> Monitoring</a>

                                    <ul id="Monitoring" class="list-unstyled collapse">

                                        <li>

                                            <a href="{{asset('employee/dashboard/others/monitoring')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dashboard</a>

                                        </li>

                                        {{-- <li>

                                            <a href="{{asset('employee/dashboard/others/recommendationviolation')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Violations/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recommendation</a>

                                        </li> --}}

                                        <li>

                                            <a href="{{asset('employee/dashboard/others/monitoring/teams')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Assignment of Team</a>

                                        </li>

                                        {{-- <li>

                                            <a href="{{asset('employee/dashboard/others/monitoring/inspection')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Inspection</a>

                                        </li> --}}

                                        <li>

                                            <a href="{{asset('employee/dashboard/others/monitoring/recommendation')}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Recommendation</a>

                                        </li>

                                    </ul>

                                </li>-->

                            </span>

                            {{-- <span class="OT002_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/surveillance')}}"><i class="fa fa-video-camera" aria-hidden="true"></i> Surveillance</a>

                                </li>

                            </span> --}}

                            <span class="OT003_allow">

                                <li><a href="{{asset('employee/dashboard/others/roacomplaints/regfac')}}"> RFA/Complaints Entry</a></li>
                                <!-- <li><a href="{{asset('employee/dashboard/others/roacomplaints')}}"> ROA/Complaints Entry</a></li> -->

                            </span>

                            {{-- <span class="OT004_allow">

                                <li><a href="{{asset('employee/dashboard/others/complaints')}}">&nbsp;&nbsp;&nbsp;&nbsp;Complaints</a></li>

                            </span> --}}

                        </ul>

                    </li>

                </span>


                <!-- Surveillance -->

                <span class="MOD09_allow">

                    <li><a href="#SurveillanceMenu" data-toggle="collapse"><i class="fa fa-video-camera" aria-hidden="true"></i> Surveillance</a>

                        <ul id="SurveillanceMenu" class="list-unstyled collapse">

                            <span class="SU001_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/surveillance')}}">&nbsp;&nbsp;Surveillance Entry</a>

                                </li>

                            </span>

                            <span class="SU002_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/surveillance/teams')}}">&nbsp;&nbsp;Assignment of Team</a>

                                </li>

                            </span>

                            {{-- <span class="SU003_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/surveillance/inspection')}}">&nbsp;&nbsp;Inspection</a>

                                </li>

                            </span> --}}

                            <span class="SU004_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/surveillance/survact')}}">&nbsp;&nbsp;Recommendation</a>
                                    <!-- <a href="{{asset('employee/dashboard/others/surveillance/survact')}}">&nbsp;&nbsp;Surveillance Activity</a> -->

                                </li>

                            </span>

                            {{-- new --}}

                         {{--   <span class="SU005_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/surveillance/clientActionTaken')}}">&nbsp;&nbsp;Client's action taken</a>

                                </li>

                            </span>--}}
                            {{--
                            <span class="SU006_allow">

                                <li>

                                    <a href="#">&nbsp;&nbsp;Surveillance Recommendation</a>
                                    <!-- <a href="#">&nbsp;&nbsp;Surveillance Tracking of Unlicensed HF</a> -->

                                </li>

                            </span>
                            --}}
                            <span class="SU007_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/surveillance/recommendation')}}">&nbsp;&nbsp;Verdict</a>
                                    <!-- <a href="{{asset('employee/dashboard/others/surveillance/recommendation')}}">&nbsp;&nbsp;Recommendation</a> -->
                                    <!-- <a href="{{asset('employee/dashboard/others/surveillance/recommendation')}}">&nbsp;&nbsp;Status Report of Surveyed HF</a> -->

                                </li>

                            </span>

                            {{-- end new --}}

                            {{-- <span class="MO005_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/surveillance/')}}">&nbsp;&nbsp;Evaluation</a>

                                </li>

                            </span>

                            <span class="MO006_allow">

                                <li>

                                    <a href="{{asset('employee/dashboard/others/surveillance/')}}">&nbsp;&nbsp;Send Letter</a>

                                </li>

                            </span> --}}

                        </ul>

                    </li>

                </span>


                <span class="MOD05_allow">

                    <li><a href="#ReportMenu" data-toggle="collapse"><i class="fa fa-chart-bar"></i> Reports</a>

                        <ul id="ReportMenu" class="list-unstyled collapse">
                            <span class="R0001_allow">
                                <li><a href="#ReportMasterfile" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;Masterfile Reports</a>

                                    <ul id="ReportMasterfile" class="list-unstyled collapse">
                                        <span class="RMF001_allow">
                                            <li class="#"><a href="{{ asset('employee/reports/masterfile/assessment') }}">&nbsp;&nbsp;&nbsp;&nbsp;Master List of Assessment Tool</a></li>
                                        </span>
                                         {{-- <span class="RMF002_allow">
                                            <li class="#"><a href="{{ asset('employee/reports/masterfile/mffees') }}">&nbsp;&nbsp;&nbsp;&nbsp;Master List of Fees</a></li> 
                                        </span>--}}

                                    </ul>
    
                                </li>
                            </span>
                            <span class="R0002_allow">
                                <li><a href="#ReportHHRDB" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;HHRDB</a>

                                    <ul id="ReportHHRDB" class="list-unstyled collapse">
                                        <span class="RHR001_allow">
                                            <li class="#"><a href="{{ asset('employee/hhrdb/applist') }}">&nbsp;&nbsp;&nbsp;&nbsp;List of Personnel</a></li>
                                        </span>
                                    </ul>
                                </li>  
                            </span>
                            <span class="R0003_allow">
                                <li><a href="#ReportApplication" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Application Reports</a>
                                    <ul id="ReportApplication" class="list-unstyled collapse">
                                        <span class="RAR001_allow">
                                            <li><a  href="{{ asset('employee/reports/applist/CON') }}" >&nbsp;&nbsp;&nbsp;CON Application Report</a></li>
                                        </span>
                                        <span class="RAR002_allow">
                                            <li><a  href="{{ asset('employee/reports/applist/PTC') }}" >&nbsp;&nbsp;&nbsp;PTC Application Report</a></li>
                                        </span>
                                        <span class="RAR003_allow">
                                            <li><a  href="{{ asset('employee/reports/applist/LTO') }}" >&nbsp;&nbsp;&nbsp;LTO Application Report</a></li>
                                        </span>
                                        <span class="RAR004_allow">
                                            <li><a  href="{{ asset('employee/reports/applist/COA') }}" >&nbsp;&nbsp;&nbsp;COA Application Report</a></li>
                                        </span>
                                        <span class="RAR005_allow">
                                            <li><a  href="{{ asset('employee/reports/applist/ATO') }}" >&nbsp;&nbsp;&nbsp;ATO Application Report</a></li>
                                        </span>
                                        <span class="RAR006_allow">
                                            <li><a  href="{{ asset('employee/reports/applist/COR') }}" >&nbsp;&nbsp;&nbsp;COR Application Report</a></li>
                                        </span>
                                        <span class="RAR007_allow">
                                            <li><a href="{{ asset('employee/reports/applist/appledger') }}">&nbsp;&nbsp;&nbsp;Applications Ledger</a></li>
                                        </span>
                                    </ul>
                                <li>
                            </span>
                            <span class="R0004_allow">
                                <li><a href="#ReporEvaluation" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Evaluation Reports</a>
                                    <ul id="ReporEvaluation" class="list-unstyled collapse">
                                        <span class="RER001_allow">
                                            <li><a  href="{{ asset('employee/reports/ptcevaluation/checklist') }}" >&nbsp;&nbsp;&nbsp;Checklist For Review Of Floor Plans</a></li>
                                        </span>
                                        <span class="RER002_allow">
                                            <li><a  href="{{ asset('employee/reports/ptcevaluation/logsheetptc') }}" >&nbsp;&nbsp;&nbsp;Log Sheet PTC Report</a></li>
                                         </span>
                                    </ul>
                                <li>
                            </span>
                            <span class="R0005_allow">
                                <li><a href="#ReporInspection" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Inspection Reports</a>
                                    <ul id="ReporInspection" class="list-unstyled collapse">
                                        <span class="RIR001_allow">
                                            <li><a  href="{{ asset('employee/reports/inspection/generalinspection') }}" >&nbsp;&nbsp;&nbsp;General Inspection Logsheet Report</a></li>
                                        </span>
                                        <span class="RIR002_allow">
                                            <li><a  href="{{ asset('employee/reports/inspection/hospitalinspection') }}" >&nbsp;&nbsp;&nbsp;Inspection of Hospital Logsheet Report</a></li>
                                        </span>
                                        <span class="RIR003_allow">
                                            <li><a  href="{{ asset('employee/reports/inspection/aspinspection') }}" >&nbsp;&nbsp;&nbsp;Ambulance Service Provider Logsheet Report</a></li>
                                        </span>
                                    </ul>
                                <li>                            
                            </span>
                            <span class="R0006_allow">
                                <li><a href="#ReportLicense" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Licensed Reports</a>
                                    <ul id="ReportLicense" class="list-unstyled collapse">
                                        <span class="RLR001_allow">
                                            <li><a  href="{{ asset('employee/reports/license/Certificates/facilities') }}" >&nbsp;&nbsp;&nbsp;View Certificates</a></li>
                                        </span>
                                        <span class="RLR002_allow">
                                            <li><a  href="{{ asset('employee/reports/license/facilities') }}" >&nbsp;&nbsp;&nbsp;Licensed Facilities Report</a></li>
                                        </span>
                                        <span class="RLR003_allow">
                                            <li><a  href="{{ asset('employee/reports/license/infirmary') }}" >&nbsp;&nbsp;&nbsp;List Of Licensed/No Renewal Infirmary Facilities</a></li></a></li>
                                        </span>
                                        <span class="RLR004_allow">
                                            <li><a  href="{{ asset('employee/reports/license/birthing') }}" >&nbsp;&nbsp;&nbsp;List Of Licensed/No Renewal LTO Birthing Facilities</a></li></a></li>
                                        </span>
                                        <span class="RLR005_allow">
                                            <li><a  href="{{ asset('employee/reports/license/ldwa') }}" >&nbsp;&nbsp;&nbsp;List Of Accredited Laboratories For Drinking Water Analysis</a></li></a></li>
                                        </span>
                                        <span class="RLR006_allow">
                                            <li><a  href="{{ asset('employee/reports/license/psychiatric') }}" >&nbsp;&nbsp;&nbsp;List Of Licensed/No Issuance LTO Psychiatric Care Facilities</a></li></a></li>
                                        </span>
                                    </ul>
                                <li>
                            </span>
                            <span class="R0007_allow">
                                <li><a href="#ReportNonIssuance" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Non-Issuancee Reports</a>
                                    <ul id="ReportNonIssuance" class="list-unstyled collapse">
                                        <span class="RNIR001_allow">
                                            <li><a  href="{{ asset('employee/reports/nonissuance/applist') }}" >&nbsp;&nbsp;&nbsp;Non Issuance Applications Report</a></li>
                                        </span>
                                        <span class="RNIR002_allow">
                                            <li><a  href="{{ asset('employee/reports/nonissuance/ldwa') }}" >&nbsp;&nbsp;&nbsp;No Issuance Report of Accredited Laboratories For Drinking Water Analysis</a></li>
                                         </span>
                                    </ul>
                                <li>
                            </span>
                            
                            {{-- <span class="R0002_allow">
                                <li><a href="#ReportMonitoring" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Monitoring</a>

                                    <ul id="ReportMonitoring" class="list-unstyled collapse">

                                        <li class="#"><a href="asset('/employee/dashboard/mf/team')">&nbsp;&nbsp;&nbsp;&nbsp;Test</a></li>

                                    </ul>

                                </li>
                            </span>
                            <span class="R0002_allow">                            
                                <li><a href="#ReportSurveillance" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Surveillance</a>

                                    <ul id="ReportSurveillance" class="list-unstyled collapse">

                                        <li class="#"><a href="asset('/employee/dashboard/mf/team')">&nbsp;&nbsp;&nbsp;&nbsp;Test</a></li>

                                    </ul>

                                </li>
                            </span>
                            <span class="R0002_allow">

                                <li><a href="#ReportHandling" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Handling</a>

                                    <ul id="ReportHandling" class="list-unstyled collapse">

                                        <li class="#"><a href=" asset('/employee/dashboard/mf/team') ">&nbsp;&nbsp;&nbsp;&nbsp;Test</a></li>

                                    </ul>

                                </li> 
                            </span>--}}
                            
                            <span class="R0011_allow">
                            <li><a href="#ReportDOHCashier" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;Cashier</a>

                                <ul id="ReportDOHCashier" class="list-unstyled collapse">
                                    <span class="RDC001_allow">
                                        <li class="#"><a href="{{ asset('employee/reports/cashier/paidapplicantbydate') }}">&nbsp;&nbsp;&nbsp;&nbsp;List of Paid Application</a></li>
                                    </span>
                                </ul>
                            </li>
                            </span>
                            <span class="R0012_allow">

                                <li><a href="#ReportFDA" data-toggle="collapse"><i class="fa fa-circle-o"></i>&nbsp;&nbsp;FDA</a>

                                    <ul id="ReportFDA" class="list-unstyled collapse">
                                        <span class="RFDA001_allow">
                                            <li class="#"><a href="{{ asset('employee/reports/fda/xray/list') }}">&nbsp;&nbsp;&nbsp;&nbsp;Application with Radiation Facility</a></li>
                                        </span>
                                        <span class="RFDA002_allow">
                                            <li class="#"><a href="{{ asset('employee/reports/fda/pharma/list') }}">&nbsp;&nbsp;&nbsp;&nbsp;Application with Pharmacy</a></li>
                                        </span>
                                    </ul>
                                </li>
                            </span>
                        </ul>

                    </li>  

                </span>             

                <span class="MOD06_allow">

                    <li>

                        <a href="#ManMenu" data-toggle="collapse"><i class="fas fa-fw fa-cog"></i> Manage</a>

                            <ul id="ManMenu" class="list-unstyled collapse">

                                {{-- @if ($employeeData->grpid == 'NA') --}}

                                <span class="MG001_allow">

                                    <li><a href="{{asset('employee/dashboard/manage/grouprights')}}"><i class="fa fa-fw fa-check"></i> Group Rights</a></li>

                                </span>

                                <span class="MF008_allow">

                                    <li><a href="{{ asset('/employee/dashboard/mf/settings')}}"><i class="fa fa-gears"></i>&nbsp;System Settings</a></li>

                                </span>

                                {{-- @endif --}}

                                <span class="MG002_allow">

                                    <li><a href="{{ asset('/employee/dashboard/manage/system_users') }}"><i class="fa fa-user-circle"></i> System Users</a></li>

                                </span> 
                                <span class="MG002_allow">

                                <li><a href="{{ asset('/employee/dashboard/manage/system_users_fda') }}"><i class="fa fa-user-circle"></i> System Users FDA</a></li>

                                </span> 
                                <span class="MG002_allow">

                                    <li><a href="{{ asset('/employee/dashboard/manage/client_users') }}"><i class="fa fa-user-circle"></i> Client Users</a></li>

                                </span>

                                <span class="MG003_allow">

                                    <li><a href="{{ asset('employee/dashboard/manage/applicants') }}"><i class="fa fa-users"></i> Applicant Accounts</a></li>

                                </span>

                                <span class="MG004_allow">

                                    <li><a href="{{ asset('employee/dashboard/manage/system_logs') }}"><i class="fa fa-history"></i> System Logs</a></li>

                                </span>

                                {{-- <li> --}}

                                    {{-- @if($employeeData->grpid == 'NA' || $employeeData->grpid == 'RA') --}}

                                    

                                    {{-- @endif --}}

                                    

                                    {{-- @if ($employeeData->grpid == 'NA') --}}

                                    

                                    {{-- @endif --}}

                                {{-- </li> --}}

                                {{-- <li><a href="#perso" data-toggle="collapse"><i class="fa fa-fw fa-users"></i> Users

                                    </a>

                                        <ul id="perso" class="list-unstyled collapse">

                                            <li class="UG01_allow"><a href="{{asset('employee/dashboard/personnel/regional')}}">&nbsp;&nbsp;&nbsp;&nbsp;Regional Admins</a></li>

                                            <li class="UG02_allow"><a href="{{asset('employee/dashboard/personnel/fda')}}">&nbsp;&nbsp;&nbsp;&nbsp;Food and Drug Authority</a></li>

                                                <li class="UG03_allow"><a href="{{asset('employee/dashboard/personnel/lo')}}">&nbsp;&nbsp;&nbsp;&nbsp;Licensing Officers</a></li>

                                        </ul>

                                </li> --}}

                              

                            </ul>

                    </li>

                </span>

                <li hidden><a href="{{asset('/employee/dashboard/lps')}}"><i class="fa fa-fw fa-spinner"></i> Licensing Process Status</a></li>

                <li class="IDTOMIS_allow"><a href="{{asset('/employee/idtomis')}}"><i class="fas fa-tachometer-alt"></i> IDTOMIS</a></li>
                <li class="OHSRS_allow"><a href="{{asset('/employee/dashboard')}}"><i class="fas fa-tachometer-alt"></i> OHSRS</a></li>

                <li> <a href="#NHFR" data-toggle="collapse"><i class="fas fa-tachometer-alt"></i> NHFR</a>
                    <ul id="NHFR" class="list-unstyled collapse">
                        <li class="#"><a href="{{ asset('employee/nhfr') }}">&nbsp;&nbsp;&nbsp;&nbsp;Current Import NHFR</a></li>
                        <li class="#"><a href="{{ asset('employee/regfacility') }}">&nbsp;&nbsp;&nbsp;&nbsp;Registered Facility List</a></li>
                    </ul>
                </li>
                
                <li> <a href="#NDHRHIS" data-toggle="collapse"><i class="fas fa-tachometer-alt"></i> NDHRHIS</a>
                    <ul id="NDHRHIS" class="list-unstyled collapse">
                            <li class="#"><a href="{{ asset('employee/hhrdb/applist') }}">&nbsp;&nbsp;&nbsp;&nbsp;List of Personnel By Application</a></li>
                            <li class="#"><a href="{{ asset('employee/reports/ndhrhis/byregisteredfacilities') }}">&nbsp;&nbsp;&nbsp;&nbsp;List of Personnel By Registered Facilities</a></li>
                    </ul>
                </li>    
                <span class="PF002_allow">
                    <li>
                        <a href="#ArchiveMenu" data-toggle="collapse"><i class="fas fa-fw fa-folder"></i> Archive</a>
                        
                        <ul id="ArchiveMenu" class="list-unstyled collapse">
                            <li><a href="{{asset('/employee/dashboard/processflow/archive')}}"><i class="fa fa-fw fa-folder"></i> Archive of Files</a></li>
                            <li><a href="{{asset('/employee/dashboard/processflow/archive')}}"><i class="fa fa-fw fa-wrench"></i> Archive Settings</a></li>
                        </ul>
                    
                    </li>
                </span>

            </ul>

        </div>

<div class="modal fade" id="ChgPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

    <div class="modal-dialog" role="document">

        <div class="modal-content" style="border-radius: 0px;border: none;">

            <div class="modal-body text-justify" style=" background-color: #272b30;

                color: white;">

                <h5 class="modal-title text-center"><strong>Change Password</strong></h5>

                <hr>

                <div class="container">

                    <form id="ChgPass_form" class="row" data-parsley-validate>

                        {{ csrf_field() }}

                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="GlobalChangePassErrorAlert" role="alert">

                            <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.

                            <button type="button" class="close" onclick="$('#GlobalChangePassErrorAlert').hide(1000);" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                        <div class="col-sm-4">Old Password:</div>

                        <div class="col-sm-8" style="margin:0 0 .8em 0;">

                            <input type="password" id="old_pass" data-parsley-required-message="*<strong>Old Password</strong> required"  class="form-control" onkeyup="" required>

                        </div>

                        <div class="col-sm-4">New Password:</div>

                        <div class="col-sm-8" style="margin:0 0 .8em 0;">

                            <input type="password" id="new_pass" data-parsley-required-message="*<strong>New Password</strong> required"  class="form-control" onkeyup="checkPassword2();" required>

                        </div>

                        <div class="col-sm-4">Retype Password:</div>

                        <div class="col-sm-8" style="margin:0 0 .8em 0;">

                            <input type="password" id="retype_pass" data-parsley-required-message="*<strong>Retype Password</strong> required"  class="form-control" onkeyup="checkPassword2()" required>

                            <span class="text-warning">Password must <strong>all</strong> have the following:</span>

                          <ul style=" list-style-type: none;padding: 0">

                            <li id="li2_lngth" class="text-danger"><i class="fa fa-times" id="chk2_lngth" aria-hidden="true"></i> <strong>10 to 32</strong> characters in length</li>

                            <li id="li2_up" class="text-danger"><i class="fa fa-times" id="chk2_up" aria-hidden="true"></i> Upper Case</li>

                            <li id="li2_lc" class="text-danger"><i class="fa fa-times" id="chk2_lc" aria-hidden="true"></i> Lower Case</li>

                            <li id="li2_nym" class="text-danger"><i class="fa fa-times" id="chk2_nym" aria-hidden="true"></i> Number</li>

                            <li id="li2_sy" class="text-danger"><i class="fa fa-times" id="chk2_sy" aria-hidden="true"></i> Symbol ( <strong>= ? < > @ 

                            # $ * !</strong> )</li>

                            <li id="li2_mn" class="text-danger"><i class="fa fa-times" id="chk2_mn" aria-hidden="true"></i> Match password</li>

                          </ul>

                        </div>

                        <div class="col-sm-4">

                            Password Strength: <input type="text" id="passStr2" hidden>

                        </div>

                        <div class="col-sm-8 text-center" style="margin:0 0 .8em 0;text-align: center" ><span id="result2">&nbsp;</span></div>

                        <div class="col-sm-12">

                            <div class="row">

                                <input type="text" id="ChangePassSTR" hidden>

                                <div class="col-sm-6">

                                    <button type="button" onclick="$('#ChgPass_form').submit();" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>

                                </div>

                                <div class="col-sm-6">

                                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<script type="text/javascript">

    var finalPassStr22 = 0;

    function checkPassword2(){

            var password = $('#new_pass').val();

            var password1 = $('#retype_pass').val();

            var strength = 0;

            var resultName = '';

            if (password != "") {

                if (password.length >= 10) strength += 1;

            

                //If password contains both lower and uppercase characters, increase strength value.

                if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1;

                //If it has numbers and characters, increase strength value.

                if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 ;

                //If it has one special character, increase strength value.

                if (password.match(/([=,?,<,>,@,#,$,*,!])/))  strength += 1;

                

                //if it has two special characters, increase strength value.

                // if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;

                //Calculated strength value, we can return messages

                //If value is less than 2

                if (password.match(/([a-z])/)) { // Lower Case

                    checkPassWork2('lc', 1);

                    strength += 1;

                  } else {

                    checkPassWork2('lc', 0);

                    strength -= 1;

                  }



                if (password.match(/([A-Z])/))  { // Upper case

                    checkPassWork2('up', 1);

                    strength += 1;

                  } else {

                    checkPassWork2('up', 0);

                    strength -= 1;

                  }



                if (password.match(/([0-9])/)) { // Number

                    checkPassWork2('nym', 1);

                    strength += 1;

                  } else {

                    checkPassWork2('nym', 0);

                    strength -= 1;

                  }

                if (password.match(/([=,?,<,>,@,#,$,*,!])/)){ // Symbols

                      checkPassWork2('sy', 1);

                      strength += 1;            

                  } else {

                      checkPassWork2('sy', 0);

                      strength -= 1;

                  }

                if  ((password.length >= 10) && (password.length <= 32)) { // Length

                    checkPassWork2('lngth', 1);

                    strength += 1;

                  } else {

                    checkPassWork2('lngth', 0);

                    strength -= 1;

                  }

                 if (password == password1) {

                    checkPassWork2('mn', 1);

                    strength += 1;

                 } else {

                    checkPassWork2('mn', 0);

                    strength -= 1;

                 }

                //

                

                if (strength < 2 )

                {

                    $('#result2').removeClass();

                    $('#result2').addClass('weak');

                    resultName = 'Weak' ;       

                }

                else if (strength == 5 )

                {

                    $('#result2').removeClass();

                    $('#result2').addClass('good');

                    resultName = 'Good' ;   

                }

                else if (strength == 8) 

                {

                    $('#result2').removeClass();

                    $('#result2').addClass('strong');

                    resultName = 'Strong';

                } else if (strength > 3) {

                    $('#result2').removeClass();

                    $('#result2').addClass('strong');

                    resultName = 'Very Strong';

                }



                if (password.length < 10) { 

                    $('#result2').removeClass();

                    $('#result2').addClass('short');

                    resultName = 'Too short' ;

                }

            } else {

                $('#result2').removeClass();

                resultName = '&nbsp;&nbsp;';

                checkPassWork2('lc', 0);

                checkPassWork2('up', 0);

                checkPassWork2('nym', 0);

                checkPassWork2('sy', 0);

                checkPassWork2('lngth', 0);

                checkPassWork2('mn', 0);

            }

            

            $('#ChangePassSTR').attr('value', '');

            $('#ChangePassSTR').attr('value', strength);

            $('#result2').empty();

            $('#result2').append(resultName);

        }

    function checkPassWork2(name, isCheck)

    {

      if (isCheck == 1) { // Check

        $('#li2_' + name).removeClass('text-danger');

        $('#li2_' + name).addClass('text-success');



        $('#chk2_' + name).removeClass('fa-times');

        $('#chk2_' + name).addClass('fa-check');

      } else { // Wrong

        $('#li2_' + name).removeClass('text-success');

        $('#li2_' + name).addClass('text-danger');



        $('#chk2_' + name).addClass('fa-times');

        $('#chk2_' + name).removeClass('fa-check');

      }

    }

    $('#ChgPass_form').on('submit',function(e){

        e.preventDefault();

        var form = $(this);

        var passSTR = parseInt($('#ChangePassSTR').val());

        var passSTRMsg = $('#result2').text();

        form.parsley().validate();

        if (form.parsley().isValid()){

            if (passSTR >= 10) 

            {

                $.ajax({

                    url : '{{ asset('employee/change_pass') }}' ,

                    method : 'POST',

                    data : {_token:$('#token').val(),password:$('#new_pass').val(), oldpass : $('#old_pass').val()},

                    success : function(data){

                        if (data =='DONE') {

                            alert('Sucessfully Changed Password, you will be force to logout.');

                            // location.reload();

                            document.getElementById('employeeLogout').submit();

                        }

                        else if (data == 'ERROR') {

                             $('#GlobalChangePassErrorAlert').show(100);

                        } else if (data == 'WRONGPASS') {

                            alert('Incorrect Old Password');

                        } else if (data == 'USEDPASSWORD') {

                             alert('Password is already used before.');

                        }

                    },

                    error : function(a, b, c){

                        console.log(c);

                        $('#GlobalChangePassErrorAlert').show(100);

                    },



                });

            }

            else 

            {

                alert('Error, check password requirements.');

                $('#new_pass').focus();

            }

        }

    });

</script>