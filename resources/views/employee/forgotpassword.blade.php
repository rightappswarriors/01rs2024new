@extends('mainEmployee')
@section('title', 'Forgot Password')
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
							<h3 style="padding: 20px;">Forgot Password</h3>
						</div>
		 					<div class="tabss-content">
					<div id="login-tab-content" class="active">
						<form id="LOGINNOW" class="login-form" action="{{asset('/employee/forgot')}}" method="POST" data-parsley-validate>
							{{ csrf_field()}}
							{{-- @if (session()->has('dohUser_login')) --}}
							<div id="NOACCOUNTINEMAIL" class="alert alert-danger fade show" role="alert" style="display: none">
							  <strong><i class="fas fa-exclamation"></i></strong> No account bound to this email.
							  <button type="button" class="close" {{-- data-dismiss="alert" --}} onclick="$('#NOACCOUNTINEMAIL').hide(200);" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
							</div>
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
							<div style="margin: 0 0 .8em 0;">
								<input type="email"  class="input form-control" id="forgot_email" name="uname" autocomplete="off" data-parsley-required-message="<strong>*</strong>Email <strong>Required</strong>" data-parsley-type-message="must be a <strong>valid</strong> email address" placeholder="Email" value="{{old('uname')}}" required>
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
	$('#LOGINNOW').on('submit', function(event){
		event.preventDefault();
        var form = $(this);
        form.parsley().validate();
        if (form.parsley().isValid()) {
        	$.ajax({
        		method : 'POST',
        		data : {_token: $('#token').val(), email : $('#forgot_email').val()},
        		success : function(data){
        			if (data == 'NOACCOUNT') {
        				$('#NOACCOUNTINEMAIL').show(100);
        				$('#forgot_email').focus();
        			} else if (data == 'DONE') {
        				alert('Kindly check your email. Thank you.');
        				window.location.href="{{ asset('/employee') }}";
        			}
        		},
        		error : function (a, b, c){
        			console.log(c);
        			$('#ERROR_MSG2').show();
        		}
        	});
        }
	});
</script>
@endsection
@endif