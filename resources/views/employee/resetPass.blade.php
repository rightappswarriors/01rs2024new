@extends('mainEmployee')
@section('title', 'Change Password')
@if(session()->exists('employee_login'))
	<script type="text/javascript">window.location.href = '{{ asset('employee/dashboard') }}';</script>
@else
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/login.css')}}">
<div class="container">
	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<div class="form-wrapss" style="max-width: 100% !important;">
		 				<div class="text-center" style="background-color: #e6e7e8;">
							<h3 style="padding: 20px;">Change Password</h3>
						</div>
		 					<div class="tabss-content">
					<div id="login-tab-content" class="active">
						<form id="LOGINNOW" class="login-form" data-parsley-validate>
							{{ csrf_field()}}
							{{-- @if (session()->has('dohUser_login')) --}}
							<div id="NOACCOUNTINEMAIL" class="alert alert-danger fade show" role="alert" style="display: none">
							  <strong><i class="fas fa-exclamation"></i></strong> An error occured. Please contact the system administrator.
							  <button type="button" class="close" {{-- data-dismiss="alert" --}} onclick="$('#NOACCOUNTINEMAIL').hide(200);" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<input type="text" id="uid" hidden="" value="@isset($uid){{$uid}}@endisset">
							{{-- @endif --}}
							{{-- @if (session()->has('dohUser_logout'))
							<div class="alert alert-info alert-dismissible fade show" role="alert">
							  <strong><i class="fas fa-exclamation"></i></strong> {{session()->get('dohUser_logout')}}
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
							@endif --}}
							{{-- @if (session()->has('unverified'))
								<div class="alert alert-info alert-danger fade show" role="alert">
								  <strong><i class="fas fa-exclamation"></i></strong> Account not yet verified, <a href="{{ asset('/employee/resend') }}/{{session()->get('unverified')}}">Resend Email</a>
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div>
							@endif --}}
							{{-- <div style="margin: 0 0 .8em 0;">
								<input type="email"  class="input form-control" id="forgot_email" name="uname" autocomplete="off" data-parsley-required-message="<strong>*</strong>Email <strong>Required</strong>" data-parsley-type-message="must be a <strong>valid</strong> email address" placeholder="Email" value="{{old('uname')}}" required>
							</div> --}}
							<div class="col-sm-12">
								<div class="row" style="margin: 0 0 .8em 0;">
									<div class="col-sm-5">Old Password:</div>
									<div class="col-sm-7">
										<input type="password" id="pwd" class="form-control" required="">
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="row" style="margin: 0 0 .8em 0;">
									<div class="col-sm-5">New Password:</div>
									<div class="col-sm-7">
										<input type="password" onkeyup="checkPassword()" id="ThePassWord" class="form-control" required="">
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="row" style="margin: 0 0 .8em 0;">
									<div class="col-sm-5">Re-type Password:</div>
									<div class="col-sm-7">
										<input type="password" onkeyup="checkPassword()" class="form-control" id="ThePassWord1" required="">
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="row" style="margin: 0 0 .8em 0;">
									<div class="col-sm-5">Password should contain <strong>all</strong> of the following:</div>
									<div class="col-sm-7">
										<ul style=" list-style-type: none;padding: 0">
					                        <li id="li_lngth" class="text-danger"><i class="fa fa-times" id="chk_lngth" aria-hidden="true"></i> <strong>10 to 32</strong> characters in length</li>
					                        <li id="li_up" class="text-danger"><i class="fa fa-times" id="chk_up" aria-hidden="true"></i> Upper Case</li>
					                        <li id="li_lc" class="text-danger"><i class="fa fa-times" id="chk_lc" aria-hidden="true"></i> Lower Case</li>
					                        <li id="li_nym" class="text-danger"><i class="fa fa-times" id="chk_nym" aria-hidden="true"></i> Number</li>
					                        <li id="li_sy" class="text-danger"><i class="fa fa-times" id="chk_sy" aria-hidden="true"></i> Symbol ( <strong>= ? < > @ # $ * !</strong> )</li>
					                        <li id="li_mn" class="text-danger"><i class="fa fa-times" id="chk_mn" aria-hidden="true"></i> Match password</li>
					                    </ul>
									</div>
								</div>
							</div>
							{{-- <div style="margin: 0 0 .8em 0;">
							<input type="password" style="margin: 0 0 .8em 0;" class="input form-control" id="user_pass" name="pass" autocomplete="off" data-parsley-required-message="<strong>*</strong>Password <strong>Required</strong>"e placeholder="Password" required>
							</div> --}}
							{{-- <input type="checkbox" class="checkbox 	" id="remember_me">
							<label for="remember_me">Remember me</label> --}}
							{{-- <h6><a href="{{ asset('/employee/forgot') }}">Forgot Password</a></h6> --}}
							<input type="submit" class="button" value="Ok">
						</form><!--.login-form-->
						<div class="help-text">
							<p><a href="{{ asset('employee') }}">Go back to employee login page.</a></p>
						</div><!--.help-text-->
					</div><!--.login-tab-content-->
				</div><!--.tabs-content-->
			</div><!--.form-wrap-->
		</div>
		<div class="col-sm-3"></div>
	</div>
</div>
<script>
	var passSTR = 0;
	function checkPassword(){
		var password = $('#ThePassWord').val();
		var password1 = $('#ThePassWord1').val();
		var finalPassStr = 0;
		if (password != '') {
			if (password.match(/([a-z])/)) { // Lower Case
	            checkPassWork('lc', 1);
	            finalPassStr += 1;
	          } else {
	            checkPassWork('lc', 0);
	            finalPassStr -= 1;
	          }

	        if (password.match(/([A-Z])/))  { // Upper case
	            checkPassWork('up', 1);
	            finalPassStr += 1;
	          } else {
	            checkPassWork('up', 0);
	            finalPassStr -= 1;
	          }

	        if (password.match(/([0-9])/)) { // Number
	            checkPassWork('nym', 1);
	            finalPassStr += 1;
	          } else {
	            checkPassWork('nym', 0);
	            finalPassStr -= 1;
	          }
	        if (password.match(/([=,?,<,>,@,#,$,*,!])/)){ // Symbols
	              checkPassWork('sy', 1);
	              finalPassStr += 1;            
	          } else {
	              checkPassWork('sy', 0);
	              finalPassStr -= 1;
	          }
	        if  ((password.length >= 10) && (password.length <= 32)) { // Length
	            checkPassWork('lngth', 1);
	            finalPassStr += 1;
	          } else {
	            checkPassWork('lngth', 0);
	            finalPassStr -= 1;
	          }
	         if (password == password1) {
	         	checkPassWork('mn', 1);
	         	finalPassStr += 1;
	         } else {
	         	checkPassWork('mn', 0);
	         	finalPassStr -= 1;
	         }
	     } else {
	     	checkPassWork('lc', 0);
	     	checkPassWork('up', 0);
	     	checkPassWork('nym', 0);
	     	checkPassWork('sy', 0);
	     	checkPassWork('lngth', 0);
	     	checkPassWork('mn', 0);
	     }
	    passSTR = finalPassStr;
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

    $('#LOGINNOW').on('submit', function(event){
		event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
        	if (passSTR > 5) {
	        	$.ajax({
	        		method : 'POST',
	        		data : {_token: $('#token').val(), pass : $('#ThePassWord').val(), pwd: $("#pwd").val()},
	        		success : function(data){
	        			if (data == 'DONE') {
	        				alert('Successfully changed password. Redirecting to Employee Login Page');
	        				window.location.href = "{{ asset('/employee') }}";
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
        	} else {
        		alert('Please complete the password requirements to continue.');
        	}
        }
	});
</script>
@endsection
@endif