@if (session()->exists('employee_login'))     
  @extends('mainEmployee')
  @section('title', 'System Users - Manage')
  @section('content')

  <input type="text" id="CurrentPage" hidden="" value="MG002">
  <div class="content p-4">
      <div class="card">
        
          <div class="card-header bg-white font-weight-bold">
             System Users <span class="MG002_add"><a href="#" title="Add New Region" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
             {{-- <span style="float:right">Filter : 
                <select class="form-control" id="filterer" onchange="filterGroup()">
                  <option value="">Select Region ...</option>
                  <option value="All">All Region</option>
                  @foreach ($region as $regions)
                    <option value="{{$regions->rgnid}}">{{$regions->rgnid}}</option>
                  @endforeach
                </select>
                <input type="" id="token" value="{{ Session::token() }}" hidden>
             </span> --}}
          </div>
          <div class="card-body">
            <span id="success_add">
              
            </span>
            <table class="table" id="example" style="overflow-x: scroll;" >
                <thead>
                  <tr>
                    <th >User ID</th>
                    <th >Name</th>
                    <th >Type</th>
                    <th  class="text-center">Position</th>
                    <th ><center>Region</center></th>
                    <th ><center>Status</center></th>
                    <th ><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                @if(isset($users))
                @foreach ($users as $user)
                  <tr>
                    <td>{{$user->uid}}</td>
                    <td style="font-weight: bold">{{$user->fname}} @if ($user->mname != "") {{substr($user->mname,0,1)}}. @endif {{$user->lname}}
                    </td>
                    <td>{{$user->grp_desc}}</td>
                    <td style="text-align: center">@if($user->position != ''){{$user->position}} @else NONE @endif</td>
                    <td><center>{{$user->rgn_desc}}</center></td>
                    <td>
                      <center>
                        @if ($user->isActive == 1)
                          <font style="color:green">Active</font>
                        @else
                          <font style="color:red">Deactived</font>
                        @endif
                      </center>
                    </td>
                  <td>
                      <center>
                          <div class="btn-group" role="group" aria-label="Basic example">
                          <a href="#" ><button type="button" data-toggle="modal" data-target="#ViewModal" onclick="showData('{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}','{{$user->contact}}','{{$user->rgn_desc}}', '{{$user->email}}', '{{$user->grp_desc}}', '{{$user->position}}', '{{$user->teamdesc}}', '{{$user->facidesc}}')" class="btn btn-outline-primary" title="View Account">&nbsp;<i class="fa fa-eye"></i>&nbsp;</button></a>
                          @if ($user->isActive == 1)
                          <span class="MG002_update">
                            <a href="#"><button data-toggle="modal" onclick="showIfActive({{$user->isActive}},'{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}',  '{{($user->isTempBanned ?? null)}}')" data-target="#IfActiveModal" class="btn btn-outline-danger" title="Deactivate Account">&nbsp;<i class="fa fa-toggle-off"></i>&nbsp;</button></a>
                          </span>
                          @else
                          <span class="MG002_update">
                            <a href="#"><button type="button" data-toggle="modal" onclick="showIfActive({{$user->isActive}},'{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}')" data-target="#IfActiveModal" class="btn btn-outline-success" title="Reactivate Account">&nbsp;<i class="fa fa-toggle-on"></i>&nbsp;</button></a>
                          </span>
                        @endif
                        <span class="MG002_update">
                          <a href="#"><button type="button" data-target="#editMODAL" onclick="ShowEdit('{{$user->uid}}','{{$user->pre}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}','{{$user->suf}}','{{$user->contact}}','{{$user->rgnid}}', '{{$user->email}}', '{{$user->grpid}}', '{{$user->position}}', '{{$user->team}}', '{{$user->rgnid}}', '{{$user->grpid}}', '{{($user->teamid ?? null)}}',  '{{($user->facid ?? null)}}',  '{{($user->isTempBanned ?? null)}}')"; data-toggle="modal" class="btn btn-outline-warning" title="Edit Account">&nbsp;<i class="fa fa-edit"></i>&nbsp;</button></a>&nbsp;
                        </span>
                        </div>
                      </center>                    
                    </td>
                  </tr>
                @endforeach
                @endif
                </tbody>
              </table>
              @if (!isset($users))
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation"></i></strong> No <strong>System Users</strong> are currently registered!
              </div>
              @endif
          </div>

      </div>
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>System Users Registration</strong></h5>
          <hr>
          
          <div class="container">
              <form id="RAdmin" autocomplete="off" class="" data-parsley-validate>
              <input autocomplete="false" name="hidden" type="text" style="display:none;">
                  <div class="row">
                    <div class="col-sm-12" id="ACCError"></div>
                  </div>
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show text-left" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
                          <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                              <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                     </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">Prefix:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <!-- <input type="text" name="pre" class="form-control"> -->
                    <select name="pre" class="form-control">
											<option value="" selected>None</option>
                      <option value="Adm">Adm</option>
                      <option value="Ar">Ar</option>
                      <option value="Atty">Atty</option>
                      <option value="Capt">Capt</option>
                      <option value="Chief">Chief</option>
                      <option value="Cmdr">Cmdr</option>
                      <option value="Col">Col</option>
                      <option value="Dean">Dean</option>
                      <option value="Dr">Dr</option>
                      <option value="Engr">Engr</option>
                      <option value="Gen">Gen</option>
                      <option value="Gov">Gov</option>
                      <option value="Hon">Hon</option>
                      <option value="Lt Col">Lt Col</option>
                      <option value="Maj">Maj</option>
                      <option value="Mr">Mr</option>
											<option value="Mrs">Mrs</option>
                      <option value="Ms">Ms</option>
                      <option value="MSgt">MSgt</option>
											<option value="Prof">Prof</option>
										</select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">First Name:<span class="text-danger">*</span></div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" name="fname" class="form-control" data-parsley-required-message="*<strong>First name</strong> required"  required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4" >Middle Name:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" name="mname" class="form-control">
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-4">Last Name:<span class="text-danger">*</span></div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" name="lname" class="form-control" data-parsley-required-message="*<strong>Last name</strong> required"  required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">Suffix:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" name="suf" class="form-control">
                    </div>
                  </div>
      
                  <div class="row">
                    <div class="col-sm-4" >Region:<span class="text-danger">*</span></div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <select class="form-control" name="rgn" id="pos_val" data-parsley-required-message="*<strong>Region</strong> required" required="" onchange="getTeams();">
                    <option value=""></option>  
                        @if (isset($region))
                          @foreach ($region as $regions)
                            <option value="{{$regions->rgnid}}">{{$regions->rgn_desc}}</option>
                          @endforeach
                        @endif
                    </select> 
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">Type:<span class="text-danger">*</span></div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    
                      <select class="form-control" name="typ" data-parsley-required-message="*<strong>Type</strong> required" onchange="getTeams(); ;" required=""> {{--getDefFaci()--}}
                        <option value=""></option>
                      }
                      @if (isset($types))
                        @foreach ($types as $type123)
                        <option value="{{$type123->grp_id}}">{{$type123->grp_desc}}</option>
                        @endforeach   
                      @endif  
                      </select>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">Position:<span class="text-danger">*</span></div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" name="position" class="form-control" data-parsley-required-message="*<strong>Position</strong> required" required>
                    </div>
                  </div>

                  <div id="TeamDiv" class="row">
                    <div class="col-sm-4">Team:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                       <select class="form-control" name="team">
                       	<option value=""></option>
                       </select>
                    </div> 
                  </div>

                  <div id="DefFaciDiv" class="row">
                    <div class="col-sm-4">Default Facility Assignment:</div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                       <select class="form-control" name="def_faci">
                          <option value=""></option>
                          @isset ($facilitys)
                              @foreach ($facilitys as $f)
                                <option value="{{$f->hgpid}}">{{$f->hgpdesc}}</option>
                              @endforeach
                          @endisset
                       </select>
                    </div> 
                  </div>

                  <div class="row">
                    <div class="col-sm-4">Email Address:<span class="text-danger">*</span></div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="email" name="email" class="form-control" data-parsley-required-message="*<strong>Email</strong> required" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">Contact No.:<span class="text-danger">*</span></div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                    <input type="text" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" name="cntno" class="form-control" data-parsley-required-message="*<strong>Contact no.</strong> required" required>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm-4">
                      Username:<span class="text-danger">*</span>
                    </div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <input type="text" autocomplete="off" name="uname" class="form-control" data-parsley-required-message="*<strong>Username</strong> required" required>
                    </div>
                  </div>  
                  
                  <div class="row">
                    <div class="col-sm-4">
                      Password:<span class="text-danger">*</span>
                    </div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <input type="password" autocomplete="off" name="pass" onkeyup="checkPassword()" id="ThePassWord" class="form-control" data-parsley-required-message="*<strong>Password</strong> required" data-parsley-maxlength="32" data-parsley-maxlength-message="<strong>Password</strong> should be at least 10-32 characters."  data-parsley-minlength="10" data-parsley-minlength-message="<strong>Password</strong> should be at least 10-32 characters." required>
                      <span class="text-warning">Password must <strong>all</strong> have the following:</span>
                      <ul style=" list-style-type: none;padding: 0">
                        <li id="li_lngth" class="text-danger"><i class="fa fa-times" id="chk_lngth" aria-hidden="true"></i> <strong>10 to 32</strong> characters in length</li>
                        <li id="li_up" class="text-danger"><i class="fa fa-times" id="chk_up" aria-hidden="true"></i> Upper Case</li>
                        <li id="li_lc" class="text-danger"><i class="fa fa-times" id="chk_lc" aria-hidden="true"></i> Lower Case</li>
                        <li id="li_nym" class="text-danger"><i class="fa fa-times" id="chk_nym" aria-hidden="true"></i> Number</li>
                        <li id="li_sy" class="text-danger"><i class="fa fa-times" id="chk_sy" aria-hidden="true"></i> Symbol ( <strong>= ? < > @ # $ * !</strong> )</li>
                        <li id="li_same" class="text-danger"><i class="fa fa-times" id="chk_same" aria-hidden="true"></i> Should not be the same as your Username</li>
                      </ul>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-4">
                      Password Strength: <input type="text" id="passStr" hidden>
                    </div>
                    <div class="col-sm-8 text-center" style="margin:0 0 .8em 0;text-align: center" ><span id="result">&nbsp;</span></div>
                  </div>
                  
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add New System User</button>
                  </div>
              </form>
          </div>
          </div>
        </div>
      </div>
  </div>
  <div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;
      color: white;">
          <h5 class="modal-title text-center"><strong>System User Information</strong></h5>
          <hr>
          <div class="container">
            <form  class="row" >
              <div class="col-sm-12" id="Error">
              </div>
              <div class="col-sm-4">First Name:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewFname" style="font-weight: bold"></span>
              </div>
              <div class="col-sm-4">Middle Name:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewMname" style="font-weight: bold">&nbsp;</span>
              </div>
              <div class="col-sm-4">Last Name:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewLname" style="font-weight: bold"></span>
              </div>
              <div class="col-sm-4">Region:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewRegion" style="font-weight: bold"></span>
              </div>
              <div class="col-sm-4">Type:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewType" style="font-weight: bold"></span>
              </div>
              <div class="col-sm-4">Position:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewPosi" style="font-weight: bold"></span>
              </div>

              <div class="col-sm-4">Team:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewTeam" style="font-weight: bold"></span>
              </div>
              
              <div class="col-sm-4" style="margin:0 0 .8em 0;;text-align: left">Default Facility Assignment:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewDefFaci" style="font-weight: bold"></span>
              </div>

              <div class="col-sm-4">Email Address:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewEmail" style="font-weight: bold"></span>
              </div>
              <div class="col-sm-4">Contact No:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewCntNo" style="font-weight: bold"</span>
              </div>
              <div class="col-sm-12">
                <hr>
                <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
              </div> 
            </form>
         </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="editMODAL" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
          <h5 class="modal-title text-center"><strong>Edit System Users Information</strong></h5>
          <hr>
          <div class="container">
              <form id="EditAdmin" autocomplete="off" class="" data-parsley-validate>
              <input autocomplete="false" name="hidden" type="text" style="display:none;">
                  {{ csrf_field() }}
                  <div class="row">
                    <div class="col-sm-12 alert alert-danger alert-dismissible fade show text-left" style="display:none;margin:5px" id="EditErrorAlert" role="alert">
                          <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                              <button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                     </div>
                  </div>
                  <input type="text" id="edit_uid" value="" hidden>
                  <div class="col-sm-4"> <input type="checkbox" name="banned" id="istempbanned" value="1" onclick="setBanning()" />&nbsp;User Banned</div>
                 <hr/>


                    <div class="col-sm-4">Prefix:</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                    <!-- <input type="text" id="edit_pre" class="form-control"> -->
                    <select name="edit_pre" class="form-control">
											<option value="" selected>None</option>
                      <option value="Adm">Adm</option>
                      <option value="Ar">Ar</option>
                      <option value="Atty">Atty</option>
                      <option value="Capt">Capt</option>
                      <option value="Chief">Chief</option>
                      <option value="Cmdr">Cmdr</option>
                      <option value="Col">Col</option>
                      <option value="Dean">Dean</option>
                      <option value="Dr">Dr</option>
                      <option value="Engr">Engr</option>
                      <option value="Gen">Gen</option>
                      <option value="Gov">Gov</option>
                      <option value="Hon">Hon</option>
                      <option value="Lt Col">Lt Col</option>
                      <option value="Maj">Maj</option>
                      <option value="Mr">Mr</option>
											<option value="Mrs">Mrs</option>
                      <option value="Ms">Ms</option>
                      <option value="MSgt">MSgt</option>
											<option value="Prof">Prof</option>
										</select>
                    </div>
                  
                  {{-- <div class="row"> --}}
                    <div class="col-sm-4">First Name:</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                    <input type="text" id="edit_fname"  class="form-control" data-parsley-required-message="*<strong>First name</strong> required"  required>
                    </div>
                  {{-- </div> --}}

                  {{-- <div class="row"> --}}
                    <div class="col-sm-4" >Middle Name:</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                    <input type="text" id="edit_mname" class="form-control">
                    </div>
                  {{-- </div> --}}
                  
                  {{-- <div class="row"> --}}
                    <div class="col-sm-4">Last Name:</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                    <input type="text" id="edit_lname" class="form-control" data-parsley-required-message="*<strong>Last name</strong> required"  required>
                    </div>
                  {{-- </div> --}}

                    <div class="col-sm-4">Suffix:</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                    <input type="text" id="edit_suf" class="form-control">
                    </div>
      
                  {{-- <div class="row"> --}}
                    <div class="col-sm-12" >Region: (<span id="edit_rgnSPN"></span>)</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                    <select class="form-control" id="edit_rgn" onchange="getTeams();">
                    <option value=""></option>  
                        @if (isset($region))
                          @foreach ($region as $regions)
                            <option value="{{$regions->rgnid}}">{{$regions->rgn_desc}}</option>
                          @endforeach
                        @endif
                    </select> 
                    </div>
                  {{-- </div> --}}

                  {{-- <div class="row"> --}}
                    <div class="col-sm-12">Type: (<span id="edit_typSPN"></span>)</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                      <select class="form-control" id="edit_typ" onchange="getTeams2();"> {{--  getDefFaci2(); --}}
                        <option value=""></option>
                      }
                      @if (isset($types))
                        @foreach ($types as $type123)
                        <option value="{{$type123->grp_id}}">{{$type123->grp_desc}}</option>
                        @endforeach   
                      @endif  
                      </select>
                    </div>
                  {{-- </div> --}}

                  {{-- <div class="row"> --}}
                    <div class="col-sm-4">Position:</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                    <input type="text" id="edit_pos" class="form-control" data-parsley-required-message="*<strong>Position</strong> required" required>
                    </div>
                  {{-- </div> --}}

                  <div id="TeamDiv2">
                    <div class="col-sm-12">Team: (<span id="edit_teamSPN"></span>)</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                       <select class="form-control" id="Team2Select">
                       </select>
                    </div> 
                  </div>

                  <div id="DefFaciDiv2">
                    <div class="col-sm-12" style="text-align: left">Default Facility Assignment: (<span id="edit_faciSPN"></span>)</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                       <select class="form-control" id="def_faci2">
                          <option value=""></option>
                          @isset ($facilitys)
                              @foreach ($facilitys as $f)
                                <option value="{{$f->hgpid}}">{{$f->hgpdesc}}</option>
                              @endforeach
                          @endisset
                       </select>
                    </div> 
                  </div>

                  {{-- <div class="row"> --}}
                    <div class="col-sm-4">Email Address:</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                      <input type="email" id="edit_email" class="form-control" data-parsley-required-message="*<strong>Email</strong> required" required>
                    </div>
                  {{-- </div> --}}

                  {{-- <div class="row"> --}}
                    <div class="col-sm-4">Contact No:</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                    <input type="text" id="edit_contno" class="form-control" data-parsley-required-message="*<strong>Contact no.</strong> required" required>
                    </div>
                  {{-- </div> --}}
                  
                  {{-- <div class="row">
                    <div class="col-sm-4">
                      Username:
                    </div>
                    <div class="col-sm-8" style="margin:0 0 .8em 0;">
                      <input type="text" class="form-control" data-parsley-required-message="*<strong>Username</strong> required" required>
                    </div>
                  </div>  --}}
                  
                  <!-- <div class="row">
                    <div class="col-sm-4">
                      Password:
                    </div>
                    <div class="col-sm-10" style="margin:0 0 .8em 0;">
                      <input type="password" name="editpass" onkeyup="checkPassword()" id="ThePassWord" class="form-control" data-parsley-required-message="*<strong>Password</strong> required" required>
                    </div>
                  </div> -->

                  <div class="col-sm-4"> Password:</div>
                    <div class="col-sm-12" style="margin:0 0 .8em 0;">
                    <input type="password" autocomplete="off" readonly onfocus="this.removeAttribute('readonly');" onblur="this.setAttribute('readonly','');" name="editpass" onkeyup="checkPassword1()" id="ThePassWord1" class="form-control"  >
                   
                    </div>

                  
                  <div class="row">
                    <div class="col-sm-4">
                      Password Strength: <input type="text" id="passStr1" hidden>
                    </div>
                    <div class="col-sm-8 text-center" style="margin:0 0 .8em 0;text-align: center" ><span id="result1">&nbsp;</span></div>
                  </div> 
                  
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-outline-warning form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Update System User</button>
                  </div>
              </form>
          </div>
          </div>
        </div>
      </div>
  </div>
  <div class="modal fade" id="IfActiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body text-justify" style=" background-color: #272b30;
      color: white;">
          <h5 class="modal-title text-center"><strong><span id="ifActiveTitle"></span></strong></h5>
          <hr>
          <div class="container">
            <form  class="row" >
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show text-left" style="display:none;margin:5px" id="ActiveErrorAlert" role="alert">
                  <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                    <button type="button" class="close" onclick="$('#ActiveErrorAlert').hide(1000);" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
               </div>
              <div class="col-sm-12" id="Error"></div>
              <div class="col-sm-12" id="IfActiveModalBody">
              </div>
              <div class="col-sm-12">
                <hr>
                <div class="row">
                  <div class="col-sm-6">
                    <button type="button" onclick="ChangeActiveStateNow()" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
                  </div>
                  <div class="col-sm-6">
                    <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
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




  	$(document).ready(function() {
           $('#example').DataTable({
           	searchDelay: 350
           });
        });
    function checkPassWork(name, isCheck)
    {
      if (isCheck == 1) { // Check
        $('#li_' + name).removeClass('text-danger');
        $('#li_' + name).addClass('text-success');

        $('#chk_' + name).removeClass('fa-times');
        $('#chk_' + name).addClass('fa-check');
      } else { // Wrong
        $('#li_' + name).removeClass('text-success');
        $('#li_' + name).addClass('text-danger');

        $('#chk_' + name).addClass('fa-times');
        $('#chk_' + name).removeClass('fa-check');
      }
    }
  	function showEr(){
            $('#ACCError').empty();
            $('#ACCError').append(
            '<center>'+
                  '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                    '<strong><i class="fas fa-times"></i></strong> <strong>  Username</strong> is already been taken.'+
                  '</div>'+
                '</center>'
            );
          }
      function showData(id,fname,mname,lname,cntno,rgn,email,accType,posi, team, defaci){
            $('#ViewFname').text(fname.toUpperCase());
            var MnameText = (mname == '') ? '' : mname;
            $('#ViewMname').append(MnameText.toUpperCase());
            $('#ViewLname').text(lname.toUpperCase());
            $('#ViewRegion').text(rgn.toUpperCase());
            $('#ViewEmail').text(email);
            $('#ViewCntNo').text(cntno);
            $('#ViewType').text(accType);
            $('#ViewTeam').text(team);
            $('#ViewDefFaci').text(defaci);
            var AccPosi = (posi == '') ? 'NONE' : posi;
            $('#ViewPosi').text(AccPosi);
          }
      function showIfActive(state,id,fname,mname,lname, isTempBanned){
        if(isTempBanned == "1"){
              $('#istempbanned').prop('checked', true);
            }


            var title,name,message;
            if (mname != "") {
                mname = mname.charAt(0)+'.';
            } else {
                mname = '';
            }
            name = fname + ' ' + mname + ' ' + lname;
            if (state == 1) {
              title = "Deactivate Account";
              message = "Are you sure you want to deactivate <strong>" + name.toUpperCase() + "</strong> account?";
            } else {
              title = "Reactivate Account";
              message = "Are you sure you want to reactivate <strong>" + name.toUpperCase() + "</strong> account?";
            }
            $('#ifActiveTitle').text(title);
            $('#IfActiveModalBody').empty();
            $('#IfActiveModalBody').append(message+'<span id="ifActiveState" hidden>'+state+'</span><span id="ifActiveID" hidden>'+id+'</span>');
          }
      function getTeams(){
            // data-parsley-required-message="*<strong>Team</strong> required"
            var rgn = $('select[name="rgn"]').val();
            var grp = $('select[name="typ"]').val();
            // $('select[name="team"]').attr('data-parsley-required-message','');
            // $('select[name="team"]').removeAttr('required');
            // console.log('RGN :' + rgn + ', GRP : '+grp);
            if (rgn != '') {
               $.ajax({
                  url : '{{ asset('employee/dashboard/processflow/get_teams') }}',
                  method : 'POST',
                  data: {_token:$('input[name="_token"]').val(),rgn:rgn,grp:grp},
                  success: function(data){
                  if (data == 'ERROR') {
                    $('#ACCError').show(100);
                  } else {
                    $('select[name="team"]').empty();
                    $('select[name="team"]').append('<option value=""></option>');

                      for(var i = 0; i < data.length; i++){
                          $('select[name="team"]').append('<option value="'+data[i].teamid+'">'+data[i].teamdesc+'</option>');
                      }
                  }
                }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    $('#ACCError').show(100);
                }
               });

            } else {
              // $('#TeamDiv').hide();
              // $('select[name="team"]').attr('data-parsley-required-message','');
              // $('select[name="team"]').removeAttr('required');
            }
          }
      function checkPassword(){
          	var password = $('#ThePassWord').val();
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
            checkPassWork('lc', 1);
          } else {
            checkPassWork('lc', 0);
          }

          if (password.match(/([A-Z])/))  { // Upper case
            checkPassWork('up', 1);
          } else {
            checkPassWork('up', 0);
          }

          if (password.match(/([0-9])/)) { // Number
            checkPassWork('nym', 1);
          } else {
            checkPassWork('nym', 0);
          }

          if (password.match(/([=,?,<,>,@,#,$,*,!])/)){ // Symbols
              checkPassWork('sy', 1);            
          } else {
              checkPassWork('sy', 0);
          }

          if  ((password.length >= 10) && (password.length <= 32)) { // Length
            checkPassWork('lngth', 1);
          } else {
            checkPassWork('lngth', 0);
          }
          
          if (password == $('input[name="uname"]').val()) {
            checkPassWork('same', 0);
          } else { checkPassWork('same', 1);}

  				if (strength < 2 )
  				{
  					$('#result').removeClass();
  					$('#result').addClass('weak');
  					resultName = 'Weak'	;		
  				}
  				else if (strength == 2 )
  				{
  					$('#result').removeClass();
  					$('#result').addClass('good');
  					resultName = 'Good'	;	
  				}
  				else if (strength == 3) 
  				{
  					$('#result').removeClass();
  					$('#result').addClass('strong');
  					resultName = 'Strong';
  				} else if (strength > 3) {
  					$('#result').removeClass();
  					$('#result').addClass('strong');
  					resultName = 'Very Strong';
  				}

  				if (password.length < 10) { 
  					$('#result').removeClass();
  					$('#result').addClass('short');
  					resultName = 'Too short' ;
  				}



          	} else {
          		$('#result').removeClass();
          		resultName = '&nbsp;&nbsp;';
              checkPassWork('lc', 0);
                checkPassWork('up', 0);
                checkPassWork('nym', 0);
                checkPassWork('sy', 0);
                checkPassWork('lngth', 0);
                checkPassWork('same', 0);
          	}
          	$('#passStr').attr('value','');
  			     $('#result').empty();
  	        $('#result').append(resultName);
  	        $('#passStr').attr('value',strength);
          }

 function checkPassword1(){
          	var password = $('#ThePassWord1').val();
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
            checkPassWork('lc', 1);
          } else {
            checkPassWork('lc', 0);
          }

          if (password.match(/([A-Z])/))  { // Upper case
            checkPassWork('up', 1);
          } else {
            checkPassWork('up', 0);
          }

          if (password.match(/([0-9])/)) { // Number
            checkPassWork('nym', 1);
          } else {
            checkPassWork('nym', 0);
          }

          if (password.match(/([=,?,<,>,@,#,$,*,!])/)){ // Symbols
              checkPassWork('sy', 1);            
          } else {
              checkPassWork('sy', 0);
          }

          if  ((password.length >= 10) && (password.length <= 32)) { // Length
            checkPassWork('lngth', 1);
          } else {
            checkPassWork('lngth', 0);
          }
          
          if (password == $('input[name="uname"]').val()) {
            checkPassWork('same', 0);
          } else { checkPassWork('same', 1);}

  				if (strength < 2 )
  				{
  					$('#result1').removeClass();
  					$('#result1').addClass('weak');
  					resultName = 'Weak'	;		
  				}
  				else if (strength == 2 )
  				{
  					$('#result1').removeClass();
  					$('#result1').addClass('good');
  					resultName = 'Good'	;	
  				}
  				else if (strength == 3) 
  				{
  					$('#result1').removeClass();
  					$('#result1').addClass('strong');
  					resultName = 'Strong';
  				} else if (strength > 3) {
  					$('#result1').removeClass();
  					$('#result1').addClass('strong');
  					resultName = 'Very Strong';
  				}

  				if (password.length < 10) { 
  					$('#result1').removeClass();
  					$('#result1').addClass('short');
  					resultName = 'Too short' ;
  				}



          	} else {
          		$('#result1').removeClass();
          		resultName = '&nbsp;&nbsp;';
              checkPassWork('lc', 0);
                checkPassWork('up', 0);
                checkPassWork('nym', 0);
                checkPassWork('sy', 0);
                checkPassWork('lngth', 0);
                checkPassWork('same', 0);
          	}
          	$('#passStr1').attr('value','');
  			     $('#result1').empty();
  	        $('#result1').append(resultName);
  	        $('#passStr1').attr('value',strength);
          }
      




      $('#RAdmin').on('submit', function(e){
            e.preventDefault();
                var form = $(this);
                var passSTR = parseInt($('#passStr').val());
                var passSTRMsg = $('#result').text();
                form.parsley().validate();
                if(!/\s/.test($('input[name="uname"]').val())){

                  if (form.parsley().isValid()){
                    if (passSTR >= 4) {
                       $.ajax({
                        method: 'POST',
                        data: {
                          _token : $('input[name="_token"]').val(),
                          pre : $('input[name="pre"]').val(),
                          fname : $('input[name="fname"]').val(),
                          mname : $('input[name="mname"]').val(),
                          lname : $('input[name="lname"]').val(),
                          suf : $('input[name="suf"]').val(),
                          rgn :  $('select[name="rgn"]').val(),
                          typ :  $('select[name="typ"]').val(),
                          team : $('select[name="team"]').val(),
                          defaci : $('select[name="def_faci"]').val(),
                          email : $('input[name="email"]').val(),
                          cntno : $('input[name="cntno"]').val(),
                          uname : $('input[name="uname"]').val(),
                          posti : $('input[name="position"]').val(),
                          pass :   $('input[name="pass"]').val(),
                        },
                        success: function(data) {
                          if (data === 'DONE') {
                              alert('Successfully Added New System User. Please check your email for verification');
                             location.reload();
                          } else if (data == 'SAME') {
                            $('input[name="uname"]').focus();
                            showEr();
                          } else if (data == 'ERROR') {
                           $('#AddErrorAlert').show(100);
                          } else if (data == 'SAME_EMAIL') {
                              alert('Email already used');
                              $('input[name="email"]').focus();
                          } else if(data == 'uidExist'){
                            alert('Username Already Exist. Please choose Other Username');
                            $('input[name="uid"]').focus();
                          }
                        }, error : function(XMLHttpRequest, textStatus, errorThrown){
                           console.log(errorThrown);
                           $('#AddErrorAlert').show(100);
                        }
                    });
                    } else {
                       alert('Password is ' + passSTRMsg + ', please try another password (Must be Very Strong).');
                       $('input[name="pass"]').focus();
                    }
                }

                } else {
                  alert('Usernames should have no spaces');
                }
          });
    	function ChangeActiveStateNow(){
            var state = $('#ifActiveState').text();
            var id = $('#ifActiveID').text();
            $.ajax({
              url: "{{ asset('employee/dashboard/manage/saveIfActive') }}",
              method: "POST",
              data: {_token:$('input[name="_token"]').val(),isActive:state,id:id},
              success: function(data){
                  if (data == 'DONE') {
                      alert('Successfully change state of the selected');
                      location.reload();
                  } else if (data == 'ERROR') {
                  	$('#ActiveErrorAlert').show(100);
                  }
                }, error : function(XMLHttpRequest, textStatus, errorThrown){
                		$('#ActiveErrorAlert').show(100);
                }
            });
          }
      function ShowEdit(selectedID,pre,fname,mname,lname,suf,cntno,rgndesc,email,grp_desc,position, teamdesc, rgnid, posID, teamid, facidesc, isTempBanned){

            console.log("isTempBanned")
            console.log(isTempBanned)

            if(isTempBanned == "1"){
              $('#istempbanned').prop('checked', true);
            }

              $('#edit_uid').val(selectedID);
              $('#edit_pre').val(pre);
              $('#edit_fname').val(fname);
              $('#edit_mname').val(mname);
              $('#edit_lname').val(lname);
              $('#edit_suf').val(suf);
              $('#edit_contno').val(cntno);
              $('#edit_rgnSPN').text(rgndesc);
              $("#edit_rgn").val(rgndesc).trigger('change');
              $('#edit_email').val(email);
              $('#edit_typSPN').text(grp_desc);
              $("#edit_typ").val(grp_desc).trigger('change');
              $('#edit_pos').val(position);
              $('#edit_faciSPN').text(facidesc);
              $('#edit_faci').val(facidesc).trigger('change');

              $('#Team2Select').empty();

              if (teamdesc != "NONE") {
                  $('#TeamDiv2').show();
                  $('#edit_teamSPN').text(teamdesc);
                  
                  $('#Team2Select').append('<option value=""></option>');
                  $.ajax({
                    url : '{{ asset('employee/dashboard/processflow/get_teams') }}',
                    method : 'POST',
                    data: {_token:$('input[name="_token"]').val(),rgn:rgnid,grp:posID},
                    success: function(data){
                        if (data != 'ERROR') {
                            for(var i = 0; i < data.length; i++){
                                $('#Team2Select').append('<option value="'+data[i].teamid+'">'+data[i].teamdesc+'</option>');
                            }
                        }
                    }
                  });


              } 
          }
        
        function setBanning(){
          const cb = document.getElementById('istempbanned');
          const uid = document.getElementById('edit_uid');
          console.log("cb")
          console.log(uid.value)
          console.log(cb.checked)

          var msg = 'Are you sure you want to ban this user?';
          var ban = 0;
          if(!cb.checked ){
            msg = 'Are you sure you want to unbanned this user?';
            ban = 1;
          }

          if(confirm(msg)){


            // $.ajax({
            //         url : '{{ asset('employee/dashboard/setbanning') }}',
            //         method : 'POST',
            //         data: {banned: ban , uid:uid },
            //         success: function(data){
            //             if (data != 'ERROR') {
            //               alert(data.banned)
            //             }
            //         }
            //       });
            // // 

            var data =  {banned: ban , uid:uid.value };
           console.log(data)

            callApi('/api/user/setbanning', data, 'POST').then(d => {
                  
              // alert(d.data.banned)
         
                  if(cb.checked ){
                    alert('User succesfully banned')
                  $('#istempbanned').prop('checked', true);
                }else{
                  alert('User succesfully unbanned')
                  $('#istempbanned').prop('checked', false);
                }

              }).then(error => {
                  console.log(error);
              })



          }else{

            if(!cb.checked ){
              $('#istempbanned').prop('checked', true);
            }else{
              $('#istempbanned').prop('checked', false);
            }
           


          }
        }

const base_url = '{{URL::to('/')}}';

function callApi(url, data, method) {
    const config = {
        method: method,
        url: `${base_url}${url}`,
        headers: { 
          'Content-Type': 'application/json'
        },
        data : data
    };
    return axios(config)
};

      function getTeams2() {
            var rgn = $('#edit_rgn').val();
            var grp = $('#edit_typ').val();
            // TeamDiv2

            if (rgn != '') {

                 $.ajax({
                  url : '{{ asset('employee/dashboard/processflow/get_teams') }}',
                  method : 'POST',
                  data: {_token:$('input[name="_token"]').val(),rgn:rgn,grp:grp},
                  success: function(data){
                  if (data == 'ERROR') {
                    $('#EditErrorAlert').show(100);
                  } else {
                    $('#Team2Select').empty();
                    $('#Team2Select').append('<option value=""></option>');

                      for(var i = 0; i < data.length; i++){
                          $('#Team2Select').append('<option value="'+data[i].teamid+'">'+data[i].teamdesc+'</option>');
                      }
                  }
                }, error : function(XMLHttpRequest, textStatus, errorThrown){
                    $('#EditErrorAlert').show(100);
                }
               });

            } else {
              $('#Team2Select').attr('data-parsley-required-message','');
              $('#Team2Select').removeAttr('required');

              $('#TeamDiv2').hide();
            }
          }
      $('#EditAdmin').on('submit', function(event){
              event.preventDefault();
              var form = $(this);
              form.parsley().validate();
              if (form.parsley().isValid()){
                  $.ajax({
                    url : '{{asset('employee/dashboard/manage/saveUser')}}',
                    method : 'POST',
                    data : {
                        _token:$('input[name="_token"]').val(),
                        pre : $('#edit_pre').val(),
                        fname : $('#edit_fname').val(),
                        mname : $('#edit_mname').val(),
                        lname : $('#edit_lname').val(),
                        suf : $('#edit_suf').val(),
                        rgn : $('#edit_rgn').val(),
                        typ : $('#edit_typ').val(),
                        posi : $('#edit_pos').val(),
                        team : $('#Team2Select').val(),
                        email : $('#edit_email').val(),
                        contno : $('#edit_contno').val(),
                        id :  $('#edit_uid').val(),
                        deffaci :$('#def_faci2').val(),
                        editpass :$('#ThePassWord1').val(),
                    },
                    success : function(data){
                      if (data == 'DONE') {
                          alert('Successfully Modified a User');
                          location.reload();
                      } else if (data == 'ERROR'){
                          $('#EditErrorAlert').show(100);
                      }
                    },
                    error : function(a,b,c){
                        console.log(c);
                        $('#EditErrorAlert').show(100);
                    }
                  });
              }
          });
  </script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif