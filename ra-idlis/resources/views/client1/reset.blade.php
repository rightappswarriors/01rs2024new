@extends('main')
@section('content')
@include('client1.cmp.__forgot')
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/parsley.css')}}">
</head>
<body>
  {{csrf_field()}}
  @include('client1.cmp.msg')
  <div class="container mt-5">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center"><img src="{{asset('ra-idlis/public/img/doh2.png')}}" style="width: 100%; max-height: 120px; object-fit: contain; margin-top: -90px;">Department of Health</h5>
            <div id="errMsg"></div>
            <div class="form-signin">
				<form id="LOGINNOW" class="login-form" data-parsley-validate>
					{{csrf_field()}}
	              <div class="form-label-group">
	                <input type="password" name="pwd" id="pwd" class="form-control" placeholder="Old Password" required autofocus>
	                <label for="pwd">Old Password</label>
	              </div>
	              <hr class="my-4">
	              <div class="form-label-group">
	                <input type="password" name="pass" id="ThePassWord" onkeyup="checkPassword()" class="form-control" placeholder="New Password" required autofocus>
	                <label for="ThePassWord">New Password</label>
	              </div>
	              <div class="form-label-group">
	                <input type="password" name="ThePassWord1" id="ThePassWord1" onkeyup="checkPassword()" class="form-control" placeholder="Confirm Password" required>
	                <label for="ThePassWord1">Confirm Password</label>
	              </div>
	              <hr class="my-4">
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
	              <br>
	              <button class="btn btn-lg btn-primary btn-block text-uppercase" id="chgpass" type="submit">Change Password</button>
				</form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.8.1/parsley.min.js"></script>
  <script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
  <script type="text/javascript">
    "use strict";
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
	        		data : $(this).serialize(),
	        		success : function(data){
	        			if (data == 'DONE') {
	        				alert('Successfully changed password. Redirecting to client Login Page');
	        				window.location.href = "{{ asset('/client1') }}";
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
</body>
@endsection