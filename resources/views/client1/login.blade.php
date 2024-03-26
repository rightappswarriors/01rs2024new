@extends('main')
@section('content')
@include('client1.cmp.__login')
<style>
    html,
  body {
    font: 100% "Lato", sans-serif;
    font-weight: 300;
    height: 100%;
    background-color: #f7fbff;
  }

  .blue-bg {
    background-color: #f7fbff;
    color: #1e3056;
    height: 100%;
  }

  .circle {
    font-weight: bold;
    padding: 15px 20px;
    border-radius: 50%;
    background-color: seagreen;
    color: #fff;
    max-height: 50px;
    z-index: 2;
  }

  .how-it-works.row {
    display: flex;
  }
  .how-it-works.row .col-2 {
    display: inline-flex;
    align-self: stretch;
    align-items: center;
    justify-content: center;
  }
  .how-it-works.row .col-2::after {
    content: "";
    position: absolute;
    border-left: 3px solid seagreen;
    z-index: 1;
  }
  .how-it-works.row .col-2.bottom::after {
    height: 50%;
    left: 50%;
    top: 50%;
  }
  .how-it-works.row .col-2.full::after {
    height: 100%;
    left: calc(50% - 3px);
  }
  .how-it-works.row .col-2.full3::after {
    height: 100%;
    left: calc(53% - 3px);
  }
  .how-it-works.row .col-2.top::after {
    height: 50%;
    left: 50%;
    top: 0;
  }
  .how-it-works.row .col-2.top4::after {
    height: 50%;
    left: 47%;
    top: 0;
  }

  .timeline div {
    padding: 0;
    height: 40px;
  }
  .timeline hr {
    border-top: 3px solid seagreen;
    margin: 0;
    top: 17px;
    position: relative;
  }
  .timeline .col-2 {
    display: flex;
    overflow: hidden;
  }
  .timeline .corner {
    border: 3px solid seagreen;
    width: 100%;
    position: relative;
    border-radius: 15px;
  }
  .timeline .top-right {
    left: 50%;
    top: -50%;
  }
  .timeline .left-bottom {
    left: -50%;
    top: calc(50% - 3px);
  }
  .timeline .top-left {
    left: -50%;
    top: -50%;
  }
  .timeline .right-bottom {
    left: 50%;
    top: calc(50% - 3px);
  }

  .field-icon {
    float: right;
    margin-right: 10px;
    margin-top: -33px;
    position: relative;
    z-index: 2;
  }

  @media only screen and (max-width: 1125px){
    .how-it-works.row .col-2.full3::after {
    height: 100%;
    left: calc(52% - 3px);
  }
  }
  @media only screen and (max-width: 990px){
    .how-it-works.row .col-2.full3::after {
    height: 100%;
    left: calc(53% - 3px);
  }
  }
   @media only screen and (max-width: 375px){
    .how-it-works.row .col-2.full3::after {
    height: 100%;
    left: calc(54% - 3px);
  }
  }
  @media only screen and (max-width: 1125px){
    .how-it-works.row .col-2.top4::after {
    height: 50%;
    left: 48%;
    top: 0;
  }
  }
  @media only screen and (max-width: 805px){
    .how-it-works.row .col-2.top4::after {
    height: 50%;
    left: 47%;
    top: 0;
  }
  }
  @media only screen and (max-width: 375px){
    .how-it-works.row .col-2.top4::after {
    height: 50%;
    left: 46%;
    top: 0;
  }
  }


  div .weak{
            font-weight:bold;
            color:orange;
            font-size:larger;
        }
        div .good{
            font-weight:bold;
            color:#2D98F3;
            font-size:larger;
        }
        div .strong{
            font-weight:bold;
            color: limegreen;
            font-size:larger;
        }
</style>
<script src="https://cdn.jsdelivr.net/npm/ua-parser-js@0/dist/ua-parser.min.js"></script>
		<script type="text/javascript">
		function chkbrowser()
		{
			var parser = new UAParser();
			var result = parser.getResult();
			var brow = result.browser.name;     
			var disp = document.getElementById("form_Append");

			if(brow != "Chrome") {
				document.getElementById('form_Append').style.display= 'none';
				document.getElementById('msgbrowser').style.display= 'block';
			}
			else{
				document.getElementById('form_Append').style.display= 'block';
				document.getElementById('msgbrowser').style.display= 'none';
			}
			// {name: "Chromium", version: "15.0.874.106"}
			//var msgbrow = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-info"></i> Important Reminder!</h4>You are required to use the <strong><a href="https://www.google.com/chrome/">GOOGLE CHROME</a></strong> Browser to work <strong>all the features</strong> here at its best. Some features will not load correctly if you are not using Google Chrome. 	<br/>If you have no chrome browser, please click this <a href="https://www.google.com/chrome/">link</a> to download.';
			//var tag_id = document.getElementById('msgbrowser');
			
		}
		</script>
		
<body onload="chkbrowser()">


<div id="msgbrowser"  class="text-center text-justify alert alert-info alert-dismissible">
	<h4><i class="icon fa fa-info"></i>&nbsp;&nbsp;&nbsp;Important Notice! </h4> <br/>
	You are required to use the <strong><a href="https://www.google.com/chrome/">GOOGLE CHROME</a></strong> Browser to <strong>access</strong> this system.
	<br/><br/>
	<p>If you have no chrome browser, please click this <a href="https://www.google.com/chrome/">link</a> to download.</p>
</div>
  {{csrf_field()}}
  @include('client1.cmp.msg')
  <div class="container mt-5 mb-5">
    {{-- <h4 class="card-title text-center"></h4> --}}
    <div class="row mb-5">
      <div class="col-lg-2">
        <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="width: 100%; max-height: 120px; object-fit: contain;">
      </div>
      <div class="col-lg-8">
        <center><h2 class="pb-3 pt-2" style="margin-top: 35px;">DOH Online Licensing Regulatory System</h2></center>
      </div>
      <div class="col-lg-2">
        {{-- <img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="width: 100%; max-height: 120px; object-fit: contain;"> --}}
      </div>
    </div>
    <div class="row">
      <div id="now_Append" class="col-sm-12 col-md-9 col-lg-7 mx-auto">
          <!--first section-->
          <div class="row align-items-center how-it-works">
            <div class="col-2 text-center bottom">
              <div class="circle"><i class="far fa-edit"></i></div>
            </div>
            <div class="col-6">
              <h5>Step 1.</h5>
              <small>Create an Account</small>
              
            </div>
          </div>
          <!--path between 1-2-->
          <div class="row timeline">
            <div class="col-2">
              <div class="corner top-right"></div>
            </div>
            <div class="col-8">
              <hr/>
            </div>
            <div class="col-2">
              <div class="corner left-bottom"></div>
            </div>
          </div>
          <!--second section-->
          <div class="row align-items-center justify-content-end how-it-works">
            <div class="col-6 text-right">
              <h5>Step 2.</h5>
              <small>Apply for desired Facility or Services</small>
            </div>
            <div class="col-2 text-center full">
              <div class="circle"><i class="fas fa-sign-in-alt"></i></div>
            </div>
          </div>
          <!--path between 2-3-->
          <div class="row timeline">
            <div class="col-2">
              <div class="corner right-bottom"></div>
            </div>
            <div class="col-8">
              <hr/>
            </div>
            <div class="col-2">
              <div class="corner top-left"></div>
            </div>
          </div>
          <!--third section-->
          <div class="row align-items-center how-it-works">
            <div class="col-2 text-center full3">
              <div class="circle">3</div>
            </div>
            <div class="col-6">
              <h5>Step 3.</h5>
              <small>Submit Requirements, pay fees then wait for result</small>
            </div>
          </div>
          <div class="row timeline">
            <div class="col-2">
              <div class="corner top-right"></div>
            </div>
            <div class="col-8">
              <hr/>
            </div>
            <div class="col-2">
              <div class="corner left-bottom"></div>
            </div>
          </div>
          <div class="row align-items-center justify-content-end how-it-works">
            <div class="col-6 text-right">
              <h5>Step 4.</h5>
              <small>Get notification on the result</small>
            </div>
            <div class="col-2 text-center top4">
              <div class="circle">4</div>
            </div>
          </div>
      </div>
      
	  
		
	  
      {{-- Log in Details --}}
      <div id="form_Append" class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin" style="margin-top: -20px;">
          <div class="card-body">
            {{-- <h5 class="card-title text-center"><img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="width: 100%; max-height: 120px; object-fit: contain; margin-top: -90px;">Department of Health</h5> --}}
            
            <div id="errMsg"></div>
            <div class="form-signin">
              <div id="onEnter" class="tabs" hidden>
                <div class="form-label-group">
                  <input type="text" style="text-transform: uppercase;" id="inputEmail" class="form-control" placeholder="Username" required autofocus autocomplete="off">
                  <label for="inputEmail">Username</label>
                </div>
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                  <label for="inputPassword">Password</label>
                  <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                <p style="float: right;"><a class="fortabs" href="javascript:void(0);">Forgot password?</a></p>
                <button class="btn btn-lg btn-primary btn-block text-uppercase" id="signIn" type="button">Sign in</button>
                <hr class="my-4">
                <button class="btn btn-lg btn-google btn-block text-uppercase fortabs" onclick="document.getElementById('form_Append').setAttribute('class', 'col-sm-12 col-md-9 col-lg-7 mx-auto'); document.getElementById('now_Append').setAttribute('class', 'col-sm-9 col-md-7 col-lg-5 mx-auto');" type="button">Register <i class="fa fa-arrow-right"></i></button>
              </div>
              <div id="onEnter1" class="tabs" hidden>
                <div class="form-label-group">
                  <input type="email" id="inputEmailEmail" class="form-control" placeholder="Official Email Address" required>
                  <label for="inputEmailEmail">Official Email Address</label>
                </div>
                <p style="float: left;"><a class="fortabs" href="javascript:void(0);"><i class="fa fa-arrow-left"></i> Back</a></p>
                <button class="btn btn-lg btn-info btn-block text-uppercase" id="forgotpassword" type="button">Send Verification</button>
              </div>
              <div id="onEnter2" class="tabs " hidden>
                <div class="register">
                 {{--  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-label-group">
                        <div class="container text-center pb-1">
                          <small class="lead req">Region</small>
                        </div>
                        <select id="rgnid" name="rgnid" class="form-control" required autocomplete="off">
                          <option value selected disabled hidden>Please select Region</option>
                          @if(count($region) > 0) @foreach($region AS $each)
                          <option value="{{$each->rgnid}}">{{$each->rgn_desc}}</option>
                          @endforeach @endif
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-label-group">
                        <div class="container text-center pb-1">
                          <small class="lead req">Province</small>
                        </div>
                        <select id="provid" name="provid" class="form-control" placeholder="Province" required autocomplete="off">
                          <option value selected disabled hidden>Please select Province</option>
                        </select>
                      </div>
                    </div>
                  </div> --}}
                  {{-- <div class="row">
                    <div class="col-sm-6">
                      <div class="form-label-group">
                        <div class="container text-center pb-1">
                          <small class="lead req">City/Municipality</small>
                        </div>
                        <select id="cmid" name="cmid" class="form-control" placeholder="City/Municipality" required autocomplete="off">
                          <option value selected disabled hidden>Please select City/Municipality</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-label-group">
                        <div class="container text-center pb-1">
                          <small class="lead req">Barangay</small>
                        </div>
                        <select id="brgyid" name="brgyid" class="form-control" placeholder="Barangay" required autocomplete="off">
                          <option value selected disabled hidden>Please select Barangay</option>
                        </select>
                      </div>
                    </div>
                  </div> --}}
                 {{--  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-label-group">
                        <div class="container text-center pb-1">
                          <small class="lead">Street Number</small>
                        </div>
                        <input style="text-transform: uppercase;" type="text" id="street_number" class="form-control" placeholder="Steet Number" required autocomplete="off">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-label-group">
                        <div class="container text-center pb-1">
                          <small class="lead">Street Name</small>
                        </div>
                        <input style="text-transform: uppercase;" type="text" id="streetname" class="form-control" placeholder="Steet Name" required autocomplete="off">
                      </div>
                    </div>
                  </div> --}}
                  {{-- <div class="row">
                    <div class="col-sm-12">
                      <div class="form-label-group text-center">
                        <div class="container text-center pb-1">
                          <small class="lead req">Zip Code</small>
                        </div>
                        <span class="text-danger">NOTE:</span> for reference, please follow this <a target="_blank" href="https://www.phlpost.gov.ph/zip-code-search.php">link</a>
                        <input type="text" id="zipcode" class="form-control" placeholder="Zip" required autocomplete="off">
                      </div>
                    </div>
                  </div> --}}
                </div>
                <div class="register">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-label-group">
                        {{-- <input type="text" id="assign" class="form-control" placeholder="Designation" required autocomplete="off"> --}}
                        <div class="container text-center pb-1">
                          <small class="lead req">Position/Designation</small>
                        </div>
                        <select id="assign" class="form-control" required autocomplete="off" style="padding-top:calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3))">
                          <option value="President">President</option>
                          <option value="Owner">Owner</option>
                          <option value="Head of Facility">Head of Facility</option>
                          {{-- <option value="others">Others</option> --}}
                        </select>
                        {{-- <label for="assign" class="req">Position/Designation</label> --}}
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-label-group">
                        <input type="text" id="nameofcompany" class="form-control" placeholder="Name of Company" required autocomplete="off">
                        <label for="nameofcompany" class="req">Name of Company / Facility</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-label-group">
                        <input type="text" id="authorizedsignature" class="form-control" placeholder="Name of Applicant" required autocomplete="off">
                        <label for="authorizedsignature" class="req">Name of Applicant / Personnel</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    
                    <div class="col-sm-12">
                      <div class="form-label-group">
                        <input type="number" id="contact" class="form-control" placeholder="Mobile Phone Number" required autocomplete="off">
                        <label for="contact" class="req">Mobile Phone Number</label>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="form-label-group">
                        <input type="email" id="email" class="form-control" placeholder="Official Email Address" required autocomplete="off">
                        <label for="email" class="req">Official Email Address</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-label-group">
                        <input onkeyup="this.value = this.value.toUpperCase();" style="text-transform: uppercase;" type="text" id="uid" class="form-control" placeholder="Username" required autocomplete="off">
                        <label for="uid" class="req">Username</label>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-label-group">
                        <input type="password" onkeyup="checkPassword()" id="pwd" class="form-control" placeholder="Password" required autocomplete="off">
                        <label for="pwd" class="req">Password</label>
                        
                      </div>
                      {{-- <div class="col-sm-8" style="margin:0 0 .8em 0;"> --}}
                        {{-- <input type="password" name="pass" onkeyup="checkPassword()" id="ThePassWord" class="form-control" data-parsley-required-message="*<strong>Password</strong> required" data-parsley-maxlength="32" data-parsley-maxlength-message="<strong>Password</strong> should be at least 10-32 characters."  data-parsley-minlength="10" data-parsley-minlength-message="<strong>Password</strong> should be at least 10-32 characters." required> --}}
                      {{-- </div> --}}
                    </div>
                    <div class="col-sm-6">
                      <div class="form-label-group">
                        <input type="password" id="retypepwd" class="form-control" placeholder="Confirm Password" required autocomplete="off">
                        <label for="retypepwd" class="req">Confirm Password</label>
                        <div class="d-flex justify-content-center mt-3">
                         <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" onclick="myFunction()" id="customRadio" name="example1" value="customEx">
                            <label class="custom-control-label" for="customRadio">Show Password</label>
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="offset-2 colsm-12">
                      <span class="text-warning">Password must have <strong>all</strong> of the following:</span>
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
                    <div class="offset-2 col-sm-4">
                      Password Strength: <input type="text" id="passStr" hidden>
                    </div>
                    <div class="pt-2 col-sm-6 text-center" style="margin:0 0 .8em 0;text-align: center" ><span id="result">&nbsp;</span></div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-6" hidden>
                    <button class="btn btn-lg btn-facebook btn-block text-uppercase" id="previous" type="button">Previous</button>
                  </div>
                  <div class="col-sm">
                    <button class="btn btn-lg btn-facebook btn-block text-uppercase regproc" id="next" type="button">Next</button>
                    <button class="btn btn-lg btn-google btn-block text-uppercase regproc" onclick="unch()" id="register" type="button" style="margin-top: -1px;" data-toggle="modal" data-target="#TOC" hidden>Register</button>
                  </div>
                </div>
                <hr class="my-4">
                <button class="btn btn-lg btn-primary btn-block text-uppercase fortabs" type="button" id="forSignIn" onclick="document.getElementById('form_Append').setAttribute('class', 'col-sm-9 col-md-7 col-lg-5 mx-auto'); document.getElementById('now_Append').setAttribute('class', 'col-sm-12 col-md-9 col-lg-7 mx-auto');"><i class="fa fa-arrow-left"></i> Sign in</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="TOC" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">IDLIS Terms and Condition</h5>
          <button type="button"  onclick="unch()" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container">
            <p>
              1. Access to this website , maintained by Department of Health - Knowledge Management and Information Technology Service , is free to applicants applying for a License to Operate, Certificate of Accreditation, and Permit to Construct under the One Stop Shop Strategy.
            </p>
            <p>
              2. Safeguard of the created and registered account user name and password , which shall be used as reference for all transactions in this website, shall be the responsibility of the applicant.
            </p>
            <p>
              3. Correctness of the data encoded into the system must be assured by the applicant. Otherwise, corrections of data submitted can only be done by the administrators .
            </p>
            <p>  
              4. Viewing of the status of the application can only be accessed by the concerned applicant or his representative
            </p>
            <p>
              5. All entries shall be treated with utmost confidentiality and in accordance to the data privacy act of 2012 (A.O. 10173). 
            </p>  
          </div>
        </div>
        <div class="modal-footer">
          <div class="container">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" id="agreed">
              <label class="custom-control-label" for="agreed">I Agree to the Terms and Conditions</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
  <script type="text/javascript">
     /* <![CDATA[ */
    "use strict";

    function unch(){
      document.getElementById("agreed").checked = false;
    }

    $(".required, .req").each(function(index, el) {
      $(el).append('<span class="text-danger" style="font-size: 20px;">*</span>');
    });

    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $("#inputPassword");
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

    function myFunction() {
        let x = document.getElementById("pwd"), y = document.getElementById('retypepwd');
        if (x.type === "password") {
          x.type = "text";
          y.type = "text";
        } else {
          x.type = "password";
          y.type = "password";
        }
      }
    let canRegister = false;
    (function() {
      $("#assign").change(function(){
        if($(this).val() == 'others'){
          $(this).replaceWith('<input type="text" id="assign" class="form-control" placeholder="Authorized Signature" required autocomplete="off">');
        }
      });
      let dispTabs = [1, 2, 0, 0], curDispTabs = 0, theNewLet = [['onEnter', 'onEnter1', 'onEnter2'], ['signIn', 'forgotpassword', 'register']];
      let fortabs = document.getElementsByClassName('fortabs');
      let _obj = {rgnid: "province", provid: "city_muni", cmid: "barangay"}, _arrName = {rgnid: "provid", provid: "cmid", cmid: "brgyid"}, _arrCol = {rgnid: ["provid", "provname"], provid: ["cmid", "cmname"], cmid: ["brgyid", "brgyname"]}, _arrQCol = {rgnid: "rgnid", provid: "provid", cmid: "cmid"}, _allObj = ["rgnid", "provid", "cmid", "brgyid"];
     
      function getCurInd(cInd, cName) {
        let tabs = document.getElementsByClassName(cName);
        for(let i = 0; i < tabs.length; i++) {
          tabs[i].setAttribute('hidden', true);
        }
        tabs[cInd].removeAttribute('hidden');
      }

      function getIndCurTabs(inAdd, cnName) {
        let curCnName = document.getElementsByClassName(cnName), regproc = document.getElementsByClassName('regproc'), fnTotal = [curCnName.length - 1]; curDispTabs = (((curDispTabs + inAdd) > (curCnName.length - 1)) ? curDispTabs : (((curDispTabs + inAdd) < 0) ? curDispTabs : (curDispTabs + inAdd))); let arFind = fnTotal.indexOf(curDispTabs);
        if(cnName == 'register') {
          if(curDispTabs < 1) {
            document.getElementById('previous').setAttribute('hidden', true);
          } else {
            document.getElementById('previous').removeAttribute('hidden');
          }
          for(let i = 0; i < regproc.length; i++) {
            regproc[i].setAttribute('hidden', true);
          }
          regproc[arFind + 1].removeAttribute('hidden');
        }
        getCurInd(curDispTabs, cnName);
      }
      function procAfter(tName) {
        if(tName in _arrName) {
          let curDom = document.getElementsByName(_arrName[tName])[0], curInOf = _allObj.indexOf(tName);
          curDom.classList.add('loading');
          if(curInOf > -1) {
            for(var i = (curInOf + 1); i < _allObj.length; i++) {
              document.getElementsByName(_allObj[i])[0].innerHTML = '<option value hidden selected disabled>Please select</option>';
            }
          }
          // console.log(["_token="+document.getElementsByName('_token')[0].value, "rTbl="+_arrQCol[tName], "rId="+document.getElementsByName(tName)[0].value], "{{asset('client/request')}}/"+_obj[tName])
          sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "rTbl="+_arrQCol[tName], "rId="+document.getElementsByName(tName)[0].value], "{{asset('client/request')}}/"+_obj[tName], "POST", true, {
            functionProcess: function(arr) {            
              if(curDom != undefined || curDom != null) {
                curDom.innerHTML = '<option value hidden selected disabled>Please select</option>';
                arr.forEach(function(a, b, c) {
                  curDom.innerHTML += '<option value="'+a[_arrCol[tName][0]]+'">'+a[_arrCol[tName][1]]+'</option>';
                });
                curDom.classList.remove('loading');
                // canProc = 1;
              }
            }
          });
        }
      }
      function sendMessage(alt, msg) {
        let errMsg = document.getElementById('errMsg');
        if(errMsg != undefined || errMsg != null) {
          errMsg.innerHTML = '<div class="alert alert-'+alt+' alert-dismissible fade show" role="alert">'+
            '<strong>Message:</strong> '+msg+''+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
              '<span aria-hidden="true">&times;</span>'+
            '</button>'+
          '</div>';
        } else {
          console.log(msg);
        }
      }
      window.addEventListener('click', function(e) {
        var _target = e.target || window.event.target;
        switch(_target.id) {
          case 'signIn':
            sendMessage('info', 'Verifying credentials');
            if((document.getElementById('inputEmail') != null || document.getElementById('inputEmail') != undefined) && (document.getElementById('inputPassword') != null || document.getElementById('inputPassword') != undefined)) {
              sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "_userName="+document.getElementById('inputEmail').value, "_userPass="+document.getElementById('inputPassword').value], "{{asset('client1/request/customQuery/checkUser')}}", 'POST', true, {
                functionProcess: function(arr) {
                  if(arr == true) {
                    sendMessage('success', 'Welcome!');
                    window.location.href = "{{asset('client1/home')}}";
                  } else {
                    sendMessage('danger', arr);
                  }
                }
              });
            } else {
              sendMessage('warning', 'Input for username and password not found!');
            }
            break;
          case 'forgotpassword':
            sendMessage('info', 'Verifying Email');
            if((document.getElementById('inputEmailEmail') != null || document.getElementById('inputEmailEmail') != undefined)) {
              document.getElementById('inputEmailEmail').classList.add('loading');
              sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "_email="+document.getElementById('inputEmailEmail').value], "{{asset('client1/request/customQuery/fPassword')}}", 'POST', true, {
                functionProcess: function(arr) {
                  document.getElementById('inputEmailEmail').classList.remove('loading');
                  if(arr == true) {
                    sendMessage('success', 'Successfully sent verification to this email! Please check your email account.');
                  } else {
                    sendMessage('danger', arr);
                  }
                }
              });
            } else {
              sendMessage('warning', 'Input for email not found!');
            }
            break;
          case 'next':
            getIndCurTabs(1, 'register');
            break;
          case 'previous':
            getIndCurTabs(-1, 'register');
            break;
          case 'agreed':
           
            if(canRegister){


              if((/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(document.getElementById('contact').value)) && /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(document.getElementById('email').value)){

                if(document.getElementById(_target.id).checked) {
                  $("#TOC").modal('toggle');
                  sendMessage('info', 'Sending Registration Request. Please wait');
                  let /*rgnid = document.getElementById('rgnid'), provid = document.getElementById('provid'), cmid = document.getElementById('cmid'), brgyid = document.getElementById('brgyid'), streetname = document.getElementById('streetname'),street_number = document.getElementById('street_number'), zipcode = document.getElementById('zipcode'),*/ 
                  authorizedsignature = document.getElementById('authorizedsignature'), assign = document.getElementById('assign'), email = document.getElementById('email'), contact = document.getElementById('contact'), uid = document.getElementById('uid'), pwd = document.getElementById('pwd'), retypepwd = document.getElementById('retypepwd'), nameofcomapny = document.getElementById('nameofcompany') ,unNull = {null: null, undefined: undefined};
                  if(!(/*rgnid in unNull && provid in unNull && cmid in unNull && brgyid in unNull && streetname in unNull && zipcode in unNull && */
                  authorizedsignature in unNull && assign in unNull && email in unNull && contact in unNull && uid in unNull && pwd in unNull && retypepwd in unNull)) { 
                    if(retypepwd.value == pwd.value) {
                    document.getElementById('inputEmailEmail').classList.add('loading');
                    sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value,'authorizedsignature='+authorizedsignature.value, 'assign='+assign.value, 'email='+email.value, 'contact='+contact.value, 'uid='+uid.value, 'pwd='+pwd.value ,'nameofcompany='+encodeURIComponent(nameofcomapny.value)], "{{asset('client1/request/customQuery/fRegister')}}", 'POST', true, {
                      functionProcess: function(arr) {
                        document.getElementById('inputEmailEmail').classList.remove('loading');
                        if(arr == true) {
                          document.getElementById('forSignIn').click();
                          sendMessage('success', 'Successfully registerered account.');
                          // sendMessage('success', 'Successfully registerered account. Please verify account through the email you provided.'); //6-29-2021
                        } else {
                          sendMessage('danger', arr);
                        }
                      }
                    });
                  } else {
                    sendMessage('danger', 'Passwords doesnt match.');
                    $("#agreed").prop('checked',false)
                  }
                } else { sendMessage('warning', 'Passwords doesnt match.'); $("#agreed").prop('checked',false) } } else {
                  sendMessage('warning', 'Some or all input(s) required for registration not found!');
                  $("#agreed").prop('checked',false)
                }
              } else {
                sendMessage('danger', 'Please input email and contact number in proper format.');
                $("#agreed").prop('checked',false)
              }



            } else {
              alert('Please match your password with the requirements');
            }

    
            break;
          default:
            break;
        }
      });
      // document.getElementById('email').addEventListener('blur', function() {
      //   if(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(this.value)){
      //     this.classList.add('loading'); this.classList.remove('check'); this.classList.remove('times'); this.style.borderColor = 'gold';
      //     sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, '_cEmail='+this.value], "{{asset('client1/request/customQuery/fEmail')}}", 'POST', true, {
      //       functionProcess: function(arr) {
      //         document.getElementById('email').classList.remove('loading');
      //         if(arr == true) {
      //           document.getElementById('email').style.borderColor = 'green';
      //           document.getElementById('email').classList.add('check');
      //         } else {
      //           document.getElementById('email').style.borderColor = 'red';
      //           document.getElementById('email').classList.add('times');
      //         }
      //       }
      //     });
      //     $("#errMsg").empty();
      //   } else {
      //     sendMessage('danger', 'Please input email in proper format!');
      //     this.style.borderColor = 'red';
      //   }
      // });
      document.getElementById('contact').addEventListener('blur', function() {
        if((/(\+?\d{2}?\s?\d{3}\s?\d{3}\s?\d{4})|([0]\d{3}\s?\d{3}\s?\d{4})/g.test(this.value))){
          this.style.borderColor = 'green';
          $("#errMsg").empty();
        } else {
          sendMessage('danger', 'Please input mobile phone number in proper format!');
          this.style.borderColor = 'red';
        }
      });
      document.getElementById('uid').addEventListener('blur', function() {
        this.classList.add('loading'); this.classList.remove('check'); this.classList.remove('times'); this.style.borderColor = 'gold';
        sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, '_cUid='+this.value], "{{asset('client1/request/customQuery/fUid')}}", 'POST', true, {
          functionProcess: function(arr) {
            document.getElementById('uid').classList.remove('loading');
            if(arr == true) {
              document.getElementById('uid').style.borderColor = 'green';
              document.getElementById('uid').classList.add('check');
            } else {
              document.getElementById('uid').style.borderColor = 'red';
              document.getElementById('uid').classList.add('times');
            }
          }
        });
      });
      document.getElementById('email').addEventListener('focus', function() {
        this.classList.remove('loading'); this.classList.remove('check'); this.classList.remove('times'); this.style.borderColor = 'gold';
      });
      document.getElementById('uid').addEventListener('focus', function() {
        this.classList.remove('loading'); this.classList.remove('check'); this.classList.remove('times'); this.style.borderColor = 'gold';
      });
      for(let i = 0; i < fortabs.length; i++) {
        fortabs[i].addEventListener('click', function() {
          getCurInd(dispTabs[i], 'tabs');
        });
      }
      // for(let i = 0; i < _allObj.length; i++) {
      //   document.getElementsByName(_allObj[i])[0].addEventListener('change', function() {
      //     procAfter(this.name);
      //   });
      // }
      for(let i = 0; i < theNewLet[0].length; i++) {
        document.getElementById(theNewLet[0][i]).addEventListener('keyup', function(e) {
          if(theNewLet[1][i] != undefined) { if(e.keyCode == 13) {
            let cDom = document.getElementById(theNewLet[1][i]);
            if(cDom != undefined || cDom != null) { cDom.click(); }
          } }
        });
      }
      getIndCurTabs(1, 'register');
      getCurInd(dispTabs[2], 'tabs');
    })();
    function checkPassword(){
            var password = $('#pwd').val();
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
          if (password == $('input[name="inputEmail"]').val()) {
            checkPassWork('same', 0);
          } else { checkPassWork('same', 1);}
          if (strength < 2 )
          {
            $('#result').removeClass();
            $('#result').addClass('weak');
            resultName = 'Weak' ;   
          }
          else if (strength == 2 )
          {
            $('#result').removeClass();
            $('#result').addClass('good');
            resultName = 'Good' ; 
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
            canRegister = true;
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
      $('input[type="number"]').keyup(function(e)
      {
      if (!/\D/g.test(this.value))
      {
        this.value = this.value.replace(!/\D/g, '');
      }
    });
  /* ]]> */
  </script>
</body>
@endsection