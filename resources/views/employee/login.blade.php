@extends('mainEmployee')
@section('title', 'OLRS Login')
@if(session()->exists('employee_login'))
	<script type="text/javascript">window.location.href = '{{ asset('employee/dashboard') }}';</script>
@else
@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/login.css')}}">

<style>
	.field-icon {
	  float: right;
	  margin-left: -30px;
	  margin-top: 14px;
	  position: relative;
	  z-index: 2;
	}
</style>
<div class="container">

	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-lg-6 text-center">
			<a class="navbar-brand">
				<div class="row" style="margin-top: 20px;">
					<div class="col-xs-6">
						<img src="{{asset('ra-idlis/public/img/doh2.png')}}" class="login-doh-logo">
					</div>
					<div class="col-xs-6">
						<div class="republic">
						<p><small>Republic of the Philippines</small></p>    
						<p  style="margin-top: -10px;font-size: 18px;font-weight: 600">DEPARTMENT OF HEALTH</p>
						<p  style="margin-top: -10px;">Kagawaran ng Kalusugan</p>
						<p  style="margin-top: -10px;">{{empty(session()->get('directorSettings')) ? ""  : session()->get('directorSettings')->dohiso}}</p>
						</div>
					</div>
				</div>
			</a>
		</div>
		<div class="col-sm-3"></div>
    </div>

	<div class="row">
		<div class="col-sm-3"></div>
		<div class="col-sm-6">
			<div class="form-wrapss" style="max-width: 100% !important;">
		 				<div class="text-center" style="background-color: #e6e7e8;">
							<h5 style="padding: 20px;">OLRS Back Office Login</h5>
						</div>
		 					<div class="tabss-content">
					<div id="login-tab-content" class="active">
						<form class="login-form" action="{{asset('/employee')}}" method="POST" data-parsley-validate>
							{{ csrf_field()}}
							@if (session()->has('dohUser_login'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
							  <strong><i class="fas fa-exclamation"></i></strong> {!!session()->get('dohUser_login')!!}
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
							@endif
							@if (session()->has('dohUser_logout'))
							<div class="alert alert-info alert-dismissible fade show" role="alert">
							  <strong><i class="fas fa-exclamation"></i></strong> {{session()->get('dohUser_logout')}}
							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
							@endif
							@if (session()->has('unverified'))
								<div class="alert alert-info alert-danger fade show" role="alert">
								  <strong><i class="fas fa-exclamation"></i></strong> Account not yet verified, <a href="{{ asset('/employee/resend') }}/{{session()->get('unverified')}}">Resend Email</a>
								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>
								  </button>
								</div>
							@endif
							<div style="margin: 0 0 .8em 0;">
								<input type="text" class="input form-control" id="user_login" name="uname" autocomplete="off" data-parsley-required-message="<strong>*</strong>Username <strong>Required</strong>" placeholder="Username" value="{{old('uname')}}" required style="text-transform: uppercase;" autofocus>
							</div>
							<div style="margin: 0 0 .8em 0;">
							<span toggle="#user_pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
							<input type="password" style="margin: 0 0 .8em 0;" class="input form-control" id="user_pass" name="pass" autocomplete="off" data-parsley-required-message="<strong>*</strong>Password <strong>Required</strong>"e placeholder="Password" required>

							</div>
							{{-- <input type="checkbox" class="checkbox 	" id="remember_me">
							<label for="remember_me">Remember me</label> --}}
							<h6><a href="{{ asset('/employee/forgot') }}">Forgot Password</a></h6>
							<input type="submit" class="button" value="Login">
						</form><!--.login-form-->
						<div class="help-text">
							<p>Not a DOH employee?&nbsp;<a href="{{asset('/')}}">Go back home</a></p>
						</div><!--.help-text-->
					</div><!--.login-tab-content-->
				</div><!--.tabs-content-->
			</div><!--.form-wrap-->
		</div>
		<div class="col-sm-3"></div>
	</div>
</div>
<script>
	$(".toggle-password").click(function() {
	  $(this).toggleClass("fa-eye fa-eye-slash");
	  var input = $($(this).attr("toggle"));
	  if (input.attr("type") == "password") {
	    input.attr("type", "text");
	  } else {
	    input.attr("type", "password");
	  }
	});
</script>
@endsection
@endif