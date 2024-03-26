<style type="text/css">
  .drop:before{
    content: "";
    position: absolute;
    top: 1px;
    right: 0;
    width: 0;
    height: 0;
    transform: translate(-1rem, -100%);
    border-left: .75rem solid transparent;
    border-right: .75rem solid transparent;
    border-bottom: .75rem solid white;
  }
  .uinfo > div.row > div > p {
        font-size: 13px;
  }
  .dropdown-toggle::after {
    margin-left: 0!important;
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(to bottom left, #228B22, #84bd82);">
  <div class="container-fluid">
  <div class="row">
    <div class="col-xs-6">
      <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="width: auto; height: 90px; object-fit: contain;">
    </div>
    <div class="col-xs-6">
      <div class="republic">
        <p style="margin: 0"><small>Republic of the Philippines</small></p>    
        <p style="margin: 0;margin-top: -5px"><strong>DEPARTMENT OF HEALTH</strong></p>
        <p style="margin: 0;margin-top: -5px"><small>Kagawaran ng Kalusugan</small></p>
        <p style="margin: 0;margin-top: -5px"><small>{{empty(session()->get('directorSettings')) ? ""  : session()->get('directorSettings')->dohiso}}</small></p>
      </div>
    </div>
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="{{asset('client1/home')}}">HOME <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{asset('client1/FAQ')}}">FAQs</a>
      </li>
      <li class="nav-item dropdown" id="notifArea">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <p class="fa fa-bell">
            <span class="mt-5" style="color:red;font-size:10px; font-family: ', cursive, sans-serif', cursive, sans-serif" id="unread"></span>
          </p>
        </a>
        <div class="dropdown-menu drop dropdown-menu-right" aria-labelledby="navbarDropdown" id="notifBody">
          

          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">See all</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="fa fa-user"></span>
        </a>
        <div class="dropdown-menu drop dropdown-menu-right" aria-labelledby="navbarDropdown">
          
          <a class="dropdown-item" data-toggle="modal" data-target="#userInfModal" href="javascript:void(0);">View Information</a>
          @if(session()->has('uData'))
          <a class="dropdown-item" href="{{url('client1/changePass/')}}">Change Password</a>
          @endif
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" onclick="logoutUser(['{{asset('client1/request/customQuery/logoutUser')}}', 'GET', '{{asset('logout')}}'])" href="javascript:void(0);" id="logoutUser">Logout</a>
          <!-- <a class="dropdown-item" onclick="logoutUser(['{{asset('client1/request/customQuery/logoutUser')}}', 'GET', '{{asset('client1/')}}'])" href="javascript:void(0);" id="logoutUser">Logout</a> -->
        </div>
      </li>
    </ul>
  </div>
  </div>
</nav>

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

<div class="modal fade" id="userInfModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <form id="ClientUserInfoUpdate" class="login-form" data-parsley-validate>
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel" style="color: #84929f;">User Information</h5>
          <button type="button" style="width: 45px; height: 45px; line-height: 45px; text-align: center;
            padding: 0;  border-radius: 50%;color: #fff;
            background-color: #dc3545;
            border-color: #dc3545;margin: -8px;" class="close" data-dismiss="modal" aria-label="Close">
            {{-- <span aria-hidden="true">&times;</span> --}}<i aria-hidden="true" class="fa fa-times"></i>
          </button>
        </div>
        <div class="modal-body uinfo">
          @if(session()->has('fornav')) @foreach(session()->get('fornav') AS $each)
          
          <div class="row">
            <div style="padding-right: 0;" class="col-sm-4">
              <p>Username:</p>
            </div>
            <div style="padding-left: 0" class="col-sm-8">
              <p style="padding: 3px; margin-bottom: 0; border-bottom: 1px solid #484848;"><strong>{{$each->uid}}</strong></p>
              <input type="hidden" id="uid" value="{{$each->uid}}" hidden>
            </div>
          </div>
          <div class="row">
            <div style="padding-right: 0;" class="col-sm-4">
              <p>Recovery Email Address:</p>
            </div>
            <div style="padding-left: 0" class="col-sm-8">
              <input type="text" value="{{$each->email}}" name="email" id="email" class="form-control" style="padding: 3px; margin-bottom: 0; border-bottom: 1px solid #484848; width:100%; border:0; font-size:13px;"  required>
            </div>
          </div>

          <hr>
          <p>Default Information</p>

          <div class="row">
            <div style="padding-right: 0;" class="col-sm-4">
              <p>Name of Company/Owner:</p>
            </div>
            <div style="padding-left: 0" class="col-sm-8">
              <p><strong>{{$each->nameofcompany}}</strong></p>
            </div>
          </div>

          <div class="row">
            <div style="padding-right: 0;" class="col-sm-4">
              <p>Approving Authority:</p>
            </div>
            <div style="padding-left: 0" class="col-sm-8">
              <input type="text" value="{{$each->authorizedsignature}}" name="authorizedsignature" id="authorizedsignature" class="form-control" style="padding: 3px; margin-bottom: 0; border-bottom: 1px solid #484848; width:100%; border:0; font-size:13px;" required>
            </div>
          </div>

          <div class="row">
            <div style="padding-right: 0;" class="col-sm-4">
              <p>Position/Designation:</p>
            </div>
            <div style="padding-left: 0" class="col-sm-8">
              <input type="text" value="{{$each->assign}}" name="assign" id="assign" class="form-control" style="padding: 3px; margin-bottom: 0; border-bottom: 1px solid #484848; width:100%; border:0; font-size:13px;" required>
            </div>
          </div>

          <div class="row">
            <div style="padding-right: 0;" class="col-sm-4">
              <p>Mobile Phone Number:</p>
            </div>
            <div style="padding-left: 0" class="col-sm-8">
              <input type="text" value="{{$each->contact}}" name="contact" id="contact" class="form-control" style="padding: 3px; margin-bottom: 0; border-bottom: 1px solid #484848; width:100%; border:0; font-size:13px;" required>
            </div>
          </div>
          {{--
          <hr>
           <div class="row">
            <div style="padding-right: 0;" class="col-sm-4">
              <p>Last Password Changed:  </p>
            </div>
            <div style="padding-left: 0" class="col-sm-8">
              <p><strong>@if(isset($each->lastChangePassDate)){{$each->lastChangePassDate}} @endif @if(isset($each->lastChangePassTime)) {{$each->lastChangePassTime}} @endif</strong></p>
              <p><a href="client1/changePass">Change Password</a></p>
            </div>
          </div>
           <button class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Edit email"><i class="fa fa-edit"></i></button> 
          --}}
          @endforeach @endisset
        </div>
        <div class="modal-footer" style="    padding: .5rem;">
          <button type="button" class="btn btn-md btn-secondary" data-dismiss="modal">Close</button>&nbsp;&nbsp;
          <button type="submit" class="btn btn-md btn-primary" data-dismiss="modal">Save</button>&nbsp;&nbsp;
        </div>
      </form>
    </div>
  </div>
</div>


  <script type="text/javascript">
	
    $('#ClientUserInfoUpdate').on('submit', function(event){
		event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        
        if (form.parsley().isValid()) {
        	
          $.ajax({
            method : 'POST',
            data : $(this).serialize(),
            success : function(data){
              if (data == 'DONE') {
                alert('Successfully updated your information.');
                //window.location.href = "{{ asset('/client1') }}";
              } else if (data == 'ERROR') {
                $('#NOACCOUNTINEMAIL').show(100);
              } else {
                alert(data);
              }
            },
            error : function (a, b, c){
              $('#NOACCOUNTINEMAIL').show();
            }
          });
        }
	});
  </script>