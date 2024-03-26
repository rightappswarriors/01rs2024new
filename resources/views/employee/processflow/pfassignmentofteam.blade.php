@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Assignment of Team Process Flow')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PF010">
  @php
     $employeeData = session('employee_login');
     $employeeGRP = $employeeData->grpid;
     $employeeREGION = $employeeData->rgnid;
  @endphp
  <datalist id="rgn_list">
                  @foreach ($regions as $region)
                    <option value="{{$region->rgn_desc}}">{{$region->rgnid}}</option>
                  @endforeach
                </datalist>
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             <h3>Assignment of Teams</h3>
             <a style="float: right; margin-left:10px;" href="{{ asset('employee/dashboard/mf/team') }}" class="btn btn-primary"> Team</a>
             <a style="float: right;" href="{{ asset('employee/dashboard/mf/manage/teams') }}" class="btn btn-primary"> Manage Team</a>
                     
          </div>
          
          <form  class="filter-options-form">
            @include('employee.tableDataFilter') 
          </form>
          <div class="card-body table-responsive backoffice-list">
              <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col" width="auto" style="text-align:center">Process</th>
                      <th scope="col" width="auto" style="text-align:center">Type</th>
                      <th scope="col" width="auto" style="text-align:center">Code</th>
                      <th scope="col" width="auto" style="text-align:center">Name of Facility</th>
                      <th scope="col" width="auto" style="text-align:center">Facility Type</th>
                      <th scope="col" width="auto" style="text-align:center">Current Assigned Team</th>
                      <td scope="col" width="auto" style="text-align: center;">Payment Confirmation Date</td>
                      <td scope="col" width="auto" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection</td>
                      <td scope="col" width="auto" style="text-align: center;">Actual Inspection Date</td>
                      <td scope="col" width="auto" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Current Status</th>
                      <th scope="col" width="auto" style="text-align:center">Options</th>
                    </tr>
                  </thead>
                  <tbody id="FilterdBody">
                  @if (isset($BigData))
                        @if(count($BigData) > 0)
                    @foreach ($BigData as $data)
                    <script>
						console.log("{!! $data->hasAssessors.'---'. $data->facilityname.'---' . AjaxController::canProcessNextStepFDA($data->appid,'isCashierApproveFDA','isCashierApprovePharma') !!}")
						</script>

                    @php
                      $status = ''; $color = '';
                      $paid = $data->appid_payment;
                      $reco = $data->status;

                      if ($reco == 'P') {
                        $status = 'Pending';
                      }
                    @endphp

            <script>
						  console.log("{!! $data->hasAssessors.'---'. $data->facilityname.'---' . AjaxController::canProcessNextStepFDA($data->appid,'isCashierApproveFDA','isCashierApprovePharma') !!}")
						</script>
                      <tr>
                        <td class="text-center">{{$data->aptdesc}}</td>
                        <td style="text-align:center; font-weight: bold;">{{$data->hfser_id}}</td>
                        <td style="text-align:center; text-transform: uppercase;">{{$data->hfser_id}}R{{$data->assignedRgn}}-{{$data->appid}}</td>
                        <td style="text-align:left"><strong>{{$data->facilityname}}</strong></td>
                        <td style="text-align:left">{{$data->hgpdesc}}</td>
                        <td style="text-align:center">
                          <strong>
                            @isset($data->hasAssessors) 
                              @if($data->hasAssessors == 'F') 
                                <span style="color:red;">Not Yet Assigned</span> 
                              @else
                                 <button class="btn btn-info" data-toggle="modal" data-target="#GoddestModal" onclick="getAllMembers({{$data->appid}});"><i class="fa fa-fw fa-eye"></i> Show Team</button>
                              @endif 
                            @endisset
                          </strong></td>
                          
                        <td style="text-align:left">@if(isset($data->CashierApproveformattedDate)){{$data->CashierApproveformattedDate}} @else <span style="color:red;">{{ 'Not Officially Applied Yet' }}</span> @endif </td>
                        <td style="text-align:left; border-left: darkgray;border-left-width: thin;border-left-style: solid;">@if(isset($data->CashierApproveformattedDate)){{date("F j, Y", strtotime($data->CashierApproveformattedDate. ' + 14 days')) }} @endif </td>
                        <td style="text-align:left">@if(isset($data->formattedInspectedDate)){{$data->formattedInspectedDate}} @endif </td>
                        <td style="text-align:left;border-left: darkgray;border-left-width: thin;border-left-style: solid;">{{$data->trns_desc}}</td>

                        <td style="text-align:center">
                          @isset($data->hasAssessors) 
                            {{-- @if($data->hasAssessors == 'F') --}}
                                @if($employeeData->grpid == 'NA' || $employeeData->grpid == 'DC')
                                  <button  title="Add Assessors" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#GoddessModal" onclick="showChangeRgnLO({{$data->appid}}, '{{$employeeGRP}}', {{(is_numeric($employeeREGION) ? $employeeREGION : "'".$employeeREGION."'")}}, '{{$data->rgn_desc}}', '{{$data->assignedRgn}}');"><i class="fa fa-fw fa-plus"></i></button>&nbsp;
                                @endif
                                @if ($employeeData->grpid == 'RA')
                                  <button style="background-color: #00ff1ff7" title="Assign LO" data-target="#GoderModal" data-toggle="modal" type="button" class="btn btn-outline-success" onclick="PutAppID({{$data->appid}}, '{{$data->assignedRgn}}', '{{$employeeGRP}}')"><i class="fa fa-fw fa-plus" ></i></button>&nbsp;
                                @endif
                                <button  title="Transfer to Region" type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#transferModal" onclick="$('[name=appid]').val('{{$data->appid}}')"><i class="fas fa-exchange-alt" aria-hidden="true"></i></button>&nbsp;
                            {{-- @else --}}
                            {{-- @endif  --}}
                          @endisset
                          
                          <button type="button" title="View detailed information for {{$data->facilityname}}" class="btn btn-outline-info" onclick="showData({{$data->appid}},'{{$data->aptdesc}}', '{{$data->authorizedsignature}}','{{$data->brgyname}}', '{{$data->classname}}' ,'{{$data->cmname}}', '{{$data->email}}', '{{$data->facilityname}}','{{$data->hgpdesc}}', '{{$data->formattedDate}}', '{{$data->formattedTime}}', '{{$data->hfser_desc}}', '{{$data->ocdesc}}', '{{$data->provname}}','{{$data->rgn_desc}}', '{{$data->street_name}}', '{{$data->zipcode}}', '{{$data->isrecommended}}', '{{$data->hfser_id}}', '{{$data->appid_payment}}', '{{$data->trns_desc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-eye"></i></button>&nbsp;
                        {{-- <button style="background-color: #00f9f9" title="View Change Region and LO History" type="button" class="btn-defaults" data-toggle="modal" data-target="#ShowHistory" onclick="ShowHistoryDetailsNow('{{$data->facilityname}}', {{$data->appid}})"><i class="fa fa-fw fa-history"></i></button>&nbsp; --}}
                        </td>
                      </tr>
                    @endforeach
                    @else
                      <tr><td colspan="11" class="text-center">No data available in table</td></tr>              
                    @endif 
                  @else
                    <tr><td colspan="11" class="text-center">No data available in table</td></tr>   
                  @endif
                  </tbody>

                  <tfoot>
                    <tr>
                      <th scope="col" width="auto" style="text-align:center">Process</th>
                      <th scope="col" width="auto" style="text-align:center">Type</th>
                      <th scope="col" width="auto" style="text-align:center">Code</th>
                      <th scope="col" width="auto" style="text-align:center">Name of Facility</th>
                      <th scope="col" width="auto" style="text-align:center">Facility Type</th>
                      <th scope="col" width="auto" style="text-align:center">Current Assigned Team</th>
                      <td scope="col" width="auto" style="text-align: center;">Payment Confirmation Date</td>
                      <td scope="col" width="auto" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Target Last Day of Inspection</td>
                      <td scope="col" width="auto" style="text-align: center;">Actual Inspection Date</td>
                      <td scope="col" width="auto" style="text-align: center; border-left: darkgray;border-left-width: thin;border-left-style: solid;">Current Status</th>
                      <th scope="col" width="auto" style="text-align:center">Options</th>
                    </tr>
                  </tfoot>

              </table>
          </div>
      </div>
  </div>
  <div class="modal fade" id="GodModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog {{-- modal-lg --}}" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>View Application</strong></h5>
                <hr>
                <div class="container">
                      <form id="ViewNow" data-parsley-validate>
                      <span id="ViewBody">
                      </span>
                      <hr>
                      <div class="row">
                        <div class="col-sm-6">
                        {{-- <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button> --}}
                      </div> 
                      <div class="col-sm-6">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                      </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
     <div class="modal fade" id="GoddessModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Assign Assessors {{-- Changed Assigned Region @if ($employeeData->grpid != 'RA') and LO  @endif --}}</strong></h5>
                <hr>
                <div class="container">
                      <form id="ChangeRegLO" data-parsley-validate>
                        <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
                              <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                              <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div> 
                      <input type="text" id="appIDHere" hidden="">
                      <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">Region : <span class="text-danger">*</span>
                            </div>
                            <input type="text" id="SelectedAppFormID" value="" hidden>
                            <input type="text" id="SelectedEmployeeGrpID" value="" hidden>
                            <input type="text" id="SelectedEmployeeRgnID" value="" hidden>
                            <div class="col-sm-7" id="RgnInputHrere">
                            </div>
                        </div>
                      </div>
                      @if ($employeeData->grpid != 'RA')<br>@endif
                      <div class="col-sm-12" @if ($employeeData->grpid == 'RA') hidden="" @endif>
                          <div class="row">
                            <div class="col-sm-5">Teams:
                            </div>
                            <div class="col-sm-7" id="LOInputHere">
                            </div>
                        </div>
                        <br>
                      </div>
                      <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">Employees:
                            </div>
                            <div class="col-sm-6" id="">
                                <select class="form-control" id="EmployeeWithTeam">
                                  
                                </select>
                            </div>
                            <div class="col-sm-1">
                              <button type="button" onclick="AddNewMember(1)" title="Add selected employee" class="btn btn-outline-success" style="width:36px;"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                      </div>
                      <hr>
                      <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">Employee/s without Team:
                            </div>
                            <div class="col-sm-6" id="">
                                <select class="form-control" id="EmployeeWithOutTeam">
                                  
                                </select>
                            </div>
                            <div class="col-sm-1">
                              <button type="button" onclick="AddNewMember(0)" title="Add selected employee" class="btn btn-outline-success" style="width:36px;"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                      </div>
                      <hr>
                      <hr>
                        <div class="col-sm-12">
                          <center>To be Added Members</center>
                        </div>
                        <hr>
                        <div class="col-sm-12" id="PutTableHERE">
                          
                        </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-6">
                        <button type="button" class="btn btn-outline-success form-control" style="border-radius:0;" onclick="SubmitChangeRgnLO()"><span class="fa fa-sign-up"></span>Save</button>
                      </div> 
                      <div class="col-sm-6">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                      </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>

         <div class="modal fade" id="transferModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <form action="{{url('employee/dashboard/processflow/assignmentofteam')}}" method="POST">
                <div class="modal-body" style=" background-color: #272b30;color: white;">
                  <h5 class="modal-title text-center"><strong>Transfer Inspection</strong></h5>
                  <hr>
                  <input type="hidden" name="appid">
                  <input type="hidden" name="action" value="transfer">
                  {{csrf_field()}}
                  <div class="container">
                    <div class="col-sm-12">
                      <p class="text-center" style="font-size: 30px;">
                        Region List
                      </p>
                    </div>
                  </div>
                  <div class="container">
                    <select name="regions" required="" class="form-control">
                      <option value="">Please Select</option>
                      @isset($regions)
                        @foreach($regions as $region)
                        <option value="{{$region->rgnid}}">{{$region->rgn_desc}}</option>
                        @endforeach
                      @endisset
                    </select>
                  </div>
                  <div class="container mt-3 text-center">
                    <div class="row">
                      <div class="col-md"><button class="btn btn-outline-success form-control">Submit</button></div>
                      <div class="col-md"><button onclick="$('[name=appid]').val('')" type="button" data-dismiss="modal" class="btn btn-outline-danger form-control">Cancel</button></div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
  <div class="modal fade" id="GoderModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog {{-- modal-lg --}}" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Assign/Change Licensing Officer</strong></h5>
                <hr>
                <div class="container">
                      <div class="col-sm-12">
                        <form id="AssChageLO" data-parsley-validate>
                        <div class="row">
                            <input type="text"  id="GetAppIdHere" hidden>
                            <input type="text"  id="GetRgnIdHere" hidden>
                            <input type="text"  id="GetGrpIdHere" hidden>
                            <div class="col-sm-5">Licensing Officer:<span style="color:red">*</span> :
                            </div>
                            <div class="col-sm-7" id="LOHere"></div>
                        </div>
                      </form>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-sm-6">
                        <button type="button" class="btn btn-outline-success form-control" style="border-radius:0;" onclick="SubmitLO()"><span class="fa fa-sign-up"></span>Save</button>
                      </div> 
                      <div class="col-sm-6">
                        <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
                      </div>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </div>
  <div class="modal fade" id="GoddestModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog {{-- modal-lg --}}" role="document">
            <div class="modal-content" style="border-radius: 0px;border: none;">
              <div class="modal-body" style=" background-color: #272b30;color: white;">
                <h5 class="modal-title text-center"><strong>Assessors</strong></h5>
                <hr>
                {{-- <div class="container"> --}}
                      <div class="col-sm-12 table-responsive" >
                        <form id="" data-parsley-validate>
                          <input type="text" id="anotherSelectedID4Members" hidden>
                          <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="TeamAsseErrorAlert" role="alert">
                              <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                              <button type="button" class="close" onclick="$('#TeamAsseErrorAlert').hide(1000);" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div> 
                         <table class="table">
                            <thead id="GoderModalTHead">
                              
                            </thead>
                            <tbody id="GoderModalTBody">
                              
                            </tbody>
                         </table> 
                        </form>
                      </div>
                      <hr>
                      <div class="row" id="GoderModalButtons">
                        
                      </div>
                    </form>
                {{-- </div> --}}
              </div>
            </div>
          </div>
        </div>
        
  <script type="text/javascript">
    $(document).ready(function() {
      var table = $('#example').DataTable();
      $("#example thead .select-filter").each( function ( i ) {
      var e = 4;
        var select = $('<select><option value=""></option></select>')
            .appendTo( $(this).empty() )
            // .appendTo( $(this).empty() )
            .on( 'change', function () {
                table.column( e )
                    .search( $(this).val() )
                    .draw();
            } );
 
        table.column(e).data().unique().sort().each( function ( d, j ) {
            select.append( '<option value="'+d+'">'+d+'</option>' )
        } );


    } );
    });
    // var ToBeAddedMembers = [];
    $(function () {
      $('[data-toggle="popover"]').popover();
    })
    function showData(appid, aptdesc, authorizedsignature, brgyname, classname, cmname, email, facilityname, facname, formattedDate, formattedTime, hfser_desc, ocdesc, provname, rgn_desc, streetname, zipcode, isrecommended, hfser_id, appid_payment, transStatus){
          var status = '';
          var paid = appid_payment;
          // if (isrecommended == null) {
          //     status = "For Evaluation";
          //   }else if (isrecommended == 1) {
          //     status = '<span style="color:green;font-weight:bold;">Application Approved</span>';
          //   }
          // if (paid == null) {
          //      status = '<span style="color:red;font-weight:bold;">For Evaluation (Not Paid)</span>';
          //   } 
          $('#ViewBody').empty();
          $('#ViewBody').append(
              '<div class="row">'+
                  '<div class="col-sm-4">Facility Name:' +
                  '</div>' +
                  '<div class="col-sm-8">' + facilityname +
                  '</div>' +
              '</div>' +
              // '<br>' + 
              '<div class="row">'+
                  '<div class="col-sm-4">Address:' +
                  '</div>' +
                  '<div class="col-sm-8">' + streetname + ', ' + brgyname + ', ' + cmname + ', ' + provname + ' - ' + zipcode +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Owner:' +
                  '</div>' +
                  '<div class="col-sm-8">' + authorizedsignature + 
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Applying for:' +
                  '</div>' +
                  '<div class="col-sm-8">' + hfser_id + ' ('+hfser_desc+') - ' + aptdesc +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Time and Date:' +
                  '</div>' +
                  '<div class="col-sm-8">' + formattedTime + ' - ' + formattedDate +
                  '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Status:' +
                  '</div>' +
                  '<div class="col-sm-8">' +transStatus +
                  '</div>' +
              '</div>'
            );
      }
      function showChangeRgnLO(apid,EmployeeGrp,EmployeeRgn,region,assignedRgn){
         //RgnInputHrere   LOInputHere
         // console.log(region);
         $('#RgnInputHrere').empty();
         $('#RgnInputHrere').append(
          // '<input type="text" id="SelectedRgnS" class="form-control" list="rgn_list"  onchange="SelectedRgn();" >'
          '<select id="SelectedRgnS" class="form-control" onchange="SelectedRgn();">'+
            @foreach ($regions as $region)
              '<option value="{{$region->rgnid}}">{{$region->rgn_desc}}</option>'+
            @endforeach
          '</select>'
          );
         // data-parsley-required-message="*<strong>Region</strong> required." required
         $('#LOInputHere').empty();
         $('#LOInputHere').append('<select class="form-control" id="ShowLO" onchange="getMembers()"><option value=""></option></select>');
         $('#SelectedAppFormID').attr('value','');
         $('#SelectedAppFormID').attr('value',apid);
         $('#SelectedEmployeeGrpID').attr('value', '');
         $('#SelectedEmployeeGrpID').attr('value', EmployeeGrp);

         $('#SelectedEmployeeRgnID').attr('value', EmployeeRgn);

         $('#EmployeeWithTeam').empty();
         $('#EmployeeWithTeam').append('<option value=""></option>');

         $('#EmployeeWithOutTeam').empty();
         $('#EmployeeWithOutTeam').append('<option value=""></option>');

         $('#PutTableHERE').empty();
         $('#PutTableHERE').append(
            '<table class="table">' + 
              '<thead>' +
                  '<tr>' + 
                    '<th style="width: auto;text-align: center">Name</th>' +
                    '<th style="width: auto;text-align: center">Remarks</th>' +
                    '<th style="width: auto;text-align: center">&nbsp;</th>' +
                    // '<th style="width: 15%;text-align: center">Status</th>' +
                  '</tr>' +
              '</thead>' +
              '<tbody id="MembersTable">' +
              '</tbody>' +
            '</table>'
          );

         $('#appIDHere').val(apid);
         // console.log(assignedRgn);
         $('#SelectedRgnS').val(assignedRgn.toUpperCase()).trigger('change');
      }
      function SelectedRgn(){
         var id = $('#SelectedRgnS').val();
                  var arr2 = $('#rgn_list option[value]').map(function () {return this.text}).get();
                  var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
                  var test = $.inArray(id,arr2);
                  if (test != -1) {
                     var selectedID = arr2[test];
                     // console.log();
                     $.ajax({
                          url : '{{ asset('employee/dashboard/processflow/get_teams') }}',  // {{ asset('mf/getGetLO') }}
                          method : 'POST',
                          data : {_token : $('#token').val(), rgn : selectedID},
                          success : function(data){
                            $('#ShowLO').empty();
                            if (data != 'NONE') {
                                  if (data.length != 0) {
                                    $('#ShowLO').append('<option value="">Select Team...</option>');
                                    for (var i = 0; i < data.length; i++) {
                                        var d = data[i];
                                        $('#ShowLO').append('<option value="'+d.teamid+'">'+d.teamdesc+'</option>');
                                    }
                                  } else {
                                    $('#ShowLO').empty();
                                    $('#ShowLO').append('<option value="">Currently no registered Teams</option>');
                                  }
                            } else {
                              $('#ShowLO').empty();
                              $('#ShowLO').append('<option value="">Currently no registered employee.</option>');
                            }
                          },
                     });
                     getEmployeeWithoutTeams(arr2[test]);
                  } else {
                    alert("Error : Region didn't exists.");
                    $('#ShowLO').empty();
                    $('#EmployeeWithTeam').empty();
                    $('#EmployeeWithOutTeam').empty();
                  }
                
      }
      function getEmployeeWithoutTeams(regn)
      {
        var region = regn;
        if (region != '') {
          $.ajax({
            url : '{{ asset('employee/dashboard/processflow/get_memWithoutTeam') }}',
            method : 'POST',
            data : {_token:$('#token').val(), rgn: region, id : $('#SelectedAppFormID').val()},
            success : function(data){
                if (data != 'ERROR') {
                     $('#EmployeeWithOutTeam').empty();
                    if (data.length != 0) {
                        $('#EmployeeWithOutTeam').append('<option value="">Select Employee..</option>');
                        for (var i = 0; i < data.length; i++) {
                          $('#EmployeeWithOutTeam').append('<option value="'+data[i].uid+'" position="'+data[i].position+'">'+data[i].wholename+'</option>');
                        }
                    } else {
                     $('#EmployeeWithOutTeam').append('<option value="">No employee available.</option>');
                    }
                } else  {
                  $('#AddErrorAlert').show(100);
                }
            }, 
            error : function(a, b, c){
              console.log(c);
              $('#AddErrorAlert').show(100);
            }

        });
        }
      }
      function getMembers(){
        var selectedTeam = $('#ShowLO').val();
        // ToBeAddedMembers
        if (selectedTeam != '') {
            $.ajax({
                url : '{{ asset('employee/dashboard/processflow/get_members') }}',
                method : 'POST',
                data : {_token : $('#token').val(), teamid : selectedTeam, id : $('#SelectedAppFormID').val()},
                success : function(data){
                    if (data != 'ERROR') {
                     $('#EmployeeWithTeam').empty();
                    if (data.length != 0) {
                        $('#EmployeeWithTeam').append('<option value="">Select Employee..</option>');
                        for (var i = 0; i < data.length; i++) {
                          $('#EmployeeWithTeam').append('<option value="'+data[i].uid+'" position="'+data[i].position+'">'+data[i].wholename+'</option>');
                        }
                    } else {
                     $('#EmployeeWithTeam').append('<option value="">No employee available.</option>');
                    }
                } else  {
                  $('#AddErrorAlert').show(100);
                }
                },
                error : function(a,b,c){
                    console.log(c);
                    $('#AddErrorAlert').show(100);
                },
            });
        }
      }
      function AddNewMember(WithOrWithout)
      {
        var employee = (WithOrWithout == 1) ? $('#EmployeeWithTeam').val() : $('#EmployeeWithOutTeam').val();   
        var team = (WithOrWithout == 1) ? $('#ShowLO').val() : '';
        var position = (WithOrWithout == 1) ? $('#EmployeeWithTeam option:selected').attr('position') : $('#EmployeeWithOutTeam option:selected').attr('position');
        var wholename = (WithOrWithout == 1) ? $('#EmployeeWithTeam option:selected').text() : $('#EmployeeWithOutTeam option:selected').text();
        if(employee != ''){
          var arr = $('#MembersTable  tr[id]').map(function () {return $(this).attr('member')}).get();;
          var test = $.inArray(employee,arr);
          if(test == -1){
            $('#MembersTable').append(
                '<tr class="Checkling" id="mem_'+employee+'" member="'+employee+'" team="'+team+'">' +
                  '<td id="text_'+employee+'" style="color:green;font-weight:bold;text-align:center;">'+wholename+'</td>' +
                  '<td><textarea id="rmk_'+employee+'" rows="2" class="form-control"></textarea></td>' +
                  '<td><center>' +
                    '<div class="btn-group" role="group" aria-label="Basic example">' + 
                      '<button onclick=""  type="button" class="btn btn-outline-info" style="width:36px" data-toggle="popover" data-placement="top" data-content="Position: '+position+'"><i class="fa fa-info"></i></button>&nbsp;'+
                      '<button type="button" onclick="$(\'#mem_' + employee +'\').remove();" class="btn btn-outline-danger" style="width:36px" title="Delete from List"><i class="fa fa-trash"></i></button>' +
                    '</div>' +
                  '</center></td>' +
                '</tr>'
              );
            $('[data-toggle="popover"]').popover();
          } else {
            alert('Selected Employee is already in the list.');
          }
        } else {

        }
      }
      function SubmitChangeRgnLO(){
        var rmks = []; 
        var form = $('#ChangeRegLO');
        var SelectedId = $('#appIDHere').val();
        form.parsley().validate();
        // $('#MembersTable  tr[id]').map(function () {return $(this).attr('member')}).get();
        // $('#MembersTable  tr[class="Checkling"]').map(function () {return this.id}).get();
        // $('#MembersTable  tr[class="Checkling"]').map(function () {return $(this).attr('member')}).get();
        if (form.parsley().isValid()) {
          var getIds = $('#MembersTable  tr[class="Checkling"]').map(function () {return $(this).attr('member')}).get();
          var teams = $('#MembersTable  tr[class="Checkling"]').map(function () {return $(this).attr('team')}).get();
          if (getIds.length == 0) {
            alert('No members are to be added.');
          } else {
            for(var i = 0; i < getIds.length; i++){
                rmks[i] = $('#rmk_'+getIds[i]).val() ;
              }

              $.ajax({
                  method : 'POST',
                  data : {_token:$('#token').val(),rmks:rmks,ids:getIds,SelectedID : SelectedId, teams: teams},
                  success : function(data){
                      if (data == 'ERROR') {
                        $('#AddErrorAlert').show(100);
                      } else if (data == 'DONE'){
                        alert('Successfully added assessor/s.')
                        location.reload();
                      }
                  },
                  error : function(a,b,c){
                    console.log(c);
                    $('#AddErrorAlert').show(100);
                  },
              });
          }
        }
      }
      function AddremoveMember( test, uid){
        if (test == 1) {
          $('#chk_mem_' + uid).removeAttr('onclick');
          $('#chk_mem_' + uid).attr('onclick', 'AddremoveMember(0, \''+uid+'\')');

          $('#chk_mem_' + uid).attr('title', 'Remove');
          $('#chk_mem_' + uid).removeClass('btn-outline-success');
          $('#chk_mem_' + uid).addClass('btn-outline-danger');

          $('#chk_mem_' + uid+ ' i').removeClass('fa-check');
          $('#chk_mem_' + uid+ ' i').addClass('fa-times');

          $('#stat_' + uid).text('SELECTED');
          $('#mem_' + uid).addClass('Checkling');
        //   $('#mem_' + uid).remove();
        } else {
          $('#chk_mem_' + uid).removeAttr('onclick');
          $('#chk_mem_' + uid).attr('onclick', 'AddremoveMember(1, \''+uid+'\')');

          $('#chk_mem_' + uid).attr('title', 'Add');

          $('#chk_mem_' + uid).removeClass('btn-outline-danger');
          $('#chk_mem_' + uid).addClass('btn-outline-success');
          
          $('#chk_mem_' + uid+ ' i').removeClass('fa-times');
          $('#chk_mem_' + uid+ ' i').addClass('fa-check');

          $('#stat_' + uid).text('');
          $('#cmem_' + uid).removeClass('Checkling');
        }
      }
      function getAllMembers(appid){
        $('#GoderModalTBody').empty();
        $('#anotherSelectedID4Members').val(appid);

        $('#GoderModalTHead').empty();
        $('#GoderModalTHead').append(
              '<tr>' +
              '<th width="auto" class="text-center" scope="col">Name</th>' +
              '<th width="auto" class="text-center" scope="col">Remarks</th>' +
              '<th width="auto" class="text-center memberEditMode" style="display:none" scope="col">Options</th>' + 
            '</tr>'
          );

        $('#GoderModalButtons').empty();
          $('#GoderModalButtons').append(
             ' <div class="col-sm-6">'+ 
              '<button type="button" class="btn btn-outline-warning form-control memberEditModeNot" style="border-radius:0;" onclick="EditTeamMode(1);">Edit</button>' +
                '<button type="button" class="btn btn-outline-success memberEditMode form-control" style="border-radius:0;display: none" onclick="saveEditMode()">Save</button>' +
              '</div>' + 
              '<div class="col-sm-6">' +
                '<button type="button" class="btn btn-outline-warning memberEditMode form-control" style="border-radius:0;display: none" onclick="EditTeamMode(0);"><span class="fa fa-sign-up"></span>Cancel</button>' +
                  '<button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control memberEditModeNot" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>'+
                '</div>'
            ); 

        $.ajax({
            url : '{{ asset('employee/dashboard/processflow/get_assignedmembers') }}',
            method : 'POST',
            data : {_token : $('#token').val(), appid : appid},
            success : function(data){
              if (data == 'ERROR'){
                  $('#TeamAsseErrorAlert').show(100);
              } else if(data == 'NONE'){
                alert('No data to be viewed or to be updated. Page will reload after a few seconds.');
                window.location.reload();
              } else {
                  for (var i = 0; i < data.length; i++) {
                    var rmk  = data[i].remarks;
                    if (data[i].remarks == null) {
                        rmk = ' ';
                    }
                    $('#GoderModalTBody').append(
                        '<tr id="editMode_'+data[i].apptid+'" selectedapptId="'+data[i].apptid+'">' +
                            '<td class="text-center">'+data[i].wholename+'</td>' +
                            '<td><textarea rows="2" class="form-control editModeTextArea" id="theRMK_'+data[i].apptid+'"  disabled="">'+rmk+'</textarea></td>' +
                            '<td class="memberEditMode" style="display:none"><center>'+
                              '<button type="button" class="btn btn-outline-danger" title="Remove" onclick="deleteMemberNow('+data[i].apptid+', \''+data[i].appid+'\', \''+data[i].wholename+'\', \''+data[i].uid+'\')"><i class="fa fa-fw fa-trash"></i></button>' + 
                            '</center></td>' +
                        '</tr>'
                      );
                    
                  }
              } 
            },
            error : function(a,b,c){
              console.log(c);
              $('#TeamAsseErrorAlert').show(100);
            }
        });
      }
      function EditTeamMode(YesNo){
        if (YesNo == 1) {
          $('.memberEditMode').show();
          $('.memberEditModeNot').hide();
          $('.editModeTextArea').removeAttr('disabled');
        } else {
          $('.memberEditMode').hide();
          $('.memberEditModeNot').show();
          $('.editModeTextArea').attr('disabled','');
        }
      }
      function deleteMemberNow(apptid, appid, name, uid){
        if (window.confirm("Do you really want to delete "+name+" from the team?")) { 
            $.ajax({
               url : '{{ asset('employee/dashboard/processflow/del_assignedmember') }}',
               method : 'POST',
               data : {_token: $('#token').val(), id : apptid, usid : uid},
               success : function(data){
                  if (data == 'DONE') {
                      alert('Successfully deleted ' + name + ' from the team.');
                      getAllMembers(appid);
                  } else if (data == 'ERROR') {
                      $('#TeamAsseErrorAlert').show(100);
                  }
               },
               error : function(a, b, c){
                  console.log(c);
                  $('#TeamAsseErrorAlert').show(100);
               },
            });
        }
      }
      function saveEditMode(){
        var getIds = $('#GoderModalTBody tr').map(function () {return $(this).attr('selectedapptId')}).get();
        var SelectedAppId = $('#anotherSelectedID4Members').val();
        var theGodRmk = [];
        if (getIds.length != 0) {
            for (var i = 0; i < getIds.length; i++) {
              theGodRmk[i] = $('#theRMK_'+getIds[i]).val();
            }

            $.ajax({
                url : '{{ asset('employee/dashboard/processflow/save_assignedmembers') }}',
                method : 'POST',
                data : {_token:$('#token').val(),rmk : theGodRmk, ids : getIds},
                success : function(data){
                    if (data == 'DONE') {
                        alert('Successfully edited');
                        getAllMembers(SelectedAppId);
                    } else if (data == 'ERROR'){
                      $('#TeamAsseErrorAlert').show(100);
                    }
                },
                error : function(a, b, c){
                    console.log(c);
                    $('#TeamAsseErrorAlert').show(100);
                },
            });
        } else {
          alert('No data to be updated. Page will reload after a few seconds.');
          window.location.reload();
        }
      }

   $('select').select2({
    width: '100%'
   });
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
