@if (session()->exists('employee_login'))       
  @extends('mainEmployee')
  @section('title', 'Applicant Accounts - Manage')
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="MG003">
  <div class="content p-4">
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             Application Accounts {{-- <span class=""><a href="#" title="Add New Region" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span> --}}
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
                    <th style="width: 15%">User ID</th>
                    <th style="width: 25%">Name</th>
                    <th style="width: 20%">Address</th>
                    {{-- <th style="width: 10%;" class="text-center">Position</th> --}}
                    <th style="width: 25%"><center>Region</center></th>
                    {{-- <th style="width: 10%"><center>Status</center></th> --}}
                    <th style="width: 15%"><center>Options</center></th>
                  </tr>
                </thead>
                <tbody>
                @if(isset($users))
                @foreach ($users as $user)
                  <tr>
                    <td>{{$user->uid}}</td>
                    <td style="font-weight: bold">{{$user->facilityname}}
                    </td>
                    <td>{{$user->streetname}}, {{$user->brgyname}}, {{$user->cmname}}, {{$user->provname}}</td>
                    {{-- <td style="text-align: center">@if($user->position != ''){{$user->position}} @else NONE @endif</td> --}}
                    <td><center>{{$user->rgn_desc}}</center></td>
                    {{-- <td>
                      <center>
                        @if ($user->isActive == 1)
                          <font style="color:green">Active</font>
                        @else
                          <font style="color:red">Deactived</font>
                        @endif
                      </center>
                    </td> --}}
                  <td>
                          <center>
                          <a href="#" ><button data-toggle="modal" data-target="#ViewModal" onclick="showData('{{$user->uid}}','{{$user->streetname}}','{{$user->brgyname}}','{{$user->cmname}}','{{$user->provname}}','{{$user->rgn_desc}}', '{{$user->email}}', '{{$user->contactperson}}', '{{$user->contact}}', '{{$user->facilityname}}')" class="btn btn-outline-primary" title="View Account">&nbsp;<i class="fa fa-eye"></i>&nbsp;</button></a>
                         {{--  @if ($user->isActive == 1)
                            <a href="#"><button data-toggle="modal" onclick="showIfActive({{$user->isActive}},'{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}')" data-target="#IfActiveModal" class="btn btn-danger" title="Deactivate Account" disabled>&nbsp;<i class="fa fa-toggle-off"></i>&nbsp;</button></a>
                          @else
                            <a href="#"><button data-toggle="modal" onclick="showIfActive({{$user->isActive}},'{{$user->uid}}','{{$user->fname}}','{{$user->mname}}','{{$user->lname}}')" data-target="#IfActiveModal" class="btn btn-success" title="Reactivate Account" disabled>&nbsp;<i class="fa fa-toggle-on"></i>&nbsp;</button></a>
                        @endif --}}
                          {{-- <a href="#"><button class="btn btn-warning" title="View Pre-Assessment">&nbsp;<i class="fa fa-search"></i>&nbsp;</button></a>&nbsp; --}}
                        </center>
                      
                    </td>
                  </tr>
                @endforeach
                @endif
                </tbody>
              </table>
              {{-- @if (!isset($users))
               <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><i class="fas fa-exclamation"></i></strong> No <strong>System Users</strong> are currently registered!
              </div>
              @endif --}}
          </div>

      </div>
  </div>
  <div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;
      color: white;">
          <h5 class="modal-title text-center"><strong>System User Information</strong></h5>
          <hr>
          <div class="container">
            <form  class="row" >
              <div class="col-sm-12" id="Error">
              </div>
              <div class="col-sm-4" style="display: none;">Facility Name:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;display: none">
                <span id="ViewFname" style="font-weight: bold"></span>
              </div>
              <div class="col-sm-4">Address:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewMname" style="font-weight: bold"></span>
              </div>
              {{-- <div class="col-sm-4">Type:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewType" style="font-weight: bold"></span>
              </div> --}}
              {{-- <div class="col-sm-4">Address:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewPosi" style="font-weight: bold"></span>
              </div> --}}
              <div class="col-sm-4">Region:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewRegion" style="font-weight: bold"></span>
              </div>
              <div class="col-sm-4">Email Address:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewEmail" style="font-weight: bold"></span>
              </div>
              <div class="col-sm-4">Contact Person:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewLname" style="font-weight: bold"></span>
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
  <script type="text/javascript">
  	$(document).ready(function(){$('#example').DataTable();});
  	function showData(id,fname,mname,lname,cntno,rgn,email,accType,posi,facilityname){
            $('#ViewFname').text(facilityname.toUpperCase());
            $('#ViewMname').text(fname.toUpperCase() + ', '+ mname.toUpperCase() + ', ' + lname.toUpperCase() + ', '+ cntno.toUpperCase());
            $('#ViewLname').text(accType.toUpperCase());
            $('#ViewRegion').text(rgn.toUpperCase());
            $('#ViewEmail').text(email);
            $('#ViewCntNo').text(posi);
            // $('#ViewType').text(accType);
            var AccPosi = (posi == '') ? 'NONE' : posi;
            $('#ViewPosi').text(AccPosi);
          }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif