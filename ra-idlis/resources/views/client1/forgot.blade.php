@extends('main')
@section('content')
@include('client1.cmp.__forgot')
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
              <div class="form-label-group" hidden>
                <input type="password" id="oldpass" class="form-control" placeholder="Old Password" required autofocus>
                <label for="oldpass">Old Password</label>
              </div>
              <hr class="my-4">
              <div class="form-label-group">
                <input type="password" id="newpass" onkeyup="checkPassword()" class="form-control" placeholder="New Password" required autofocus>
                <label for="newpass">New Password</label>
              </div>
              <div class="form-label-group">
                <input type="password" id="confirmpass" onkeyup="checkPassword()" class="form-control" placeholder="Confirm Password" required>
                <label for="confirmpass">Confirm Password</label>
              </div>
              <br>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" id="chgpass" type="button">Change Password</button>
            </div>
            
            <div class="col-sm-12 pt-4">
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

          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
  <script type="text/javascript">
    "use strict";

    var passSTR = 0;
  function checkPassword(){
    var password = $('#newpass').val();
    var password1 = $('#confirmpass').val();
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
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    (function() {
      let curUser = JSON.parse('{!!$appDet!!}');
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
      document.getElementById('oldpass').addEventListener('blur', function() {
        this.classList.add('loading'); this.style.borderColor = 'warning';
        this.classList.remove('check'); this.classList.remove('times');
        sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "_oPass="+this.value, "_oUid="+curUser[0]['uid']], "{{asset('client1/request/customQuery/oldPass')}}", 'POST', true, {
          functionProcess: function(arr) {
            document.getElementById('oldpass').classList.remove('loading');
            if(arr in {true: true, false: false}) {
              if(arr == true) {
                document.getElementById('oldpass').style.borderColor = 'green';
                document.getElementById('oldpass').classList.add('check');
              } else {
                document.getElementById('oldpass').style.borderColor = 'red';
                document.getElementById('oldpass').classList.add('times');
              }
            } else {
              document.getElementById('oldpass').style.borderColor = '';
            }
          }
        });
      });
      document.getElementById('newpass').addEventListener('blur', function() {
        this.classList.add('loading'); this.style.borderColor = 'warning';
        this.classList.remove('check'); this.classList.remove('times');
        sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "_oPass="+this.value, "_oUid="+curUser[0]['uid']], "{{asset('client1/request/customQuery/oldPass')}}", 'POST', true, {
          functionProcess: function(arr) {
            document.getElementById('newpass').classList.remove('loading');
            if(arr in {true: true, false: false}) {
              if(arr == true) {
                document.getElementById('newpass').style.borderColor = 'red';
                document.getElementById('newpass').classList.add('times');
              } else {
                document.getElementById('newpass').style.borderColor = 'green';
                document.getElementById('newpass').classList.add('check');
              }
            } else {
              document.getElementById('newpass').style.borderColor = '';
            }
          }
        });
      });
      document.getElementById('confirmpass').addEventListener('keyup', function() {
        this.classList.remove('check'); this.classList.remove('times');
        if(document.getElementById('newpass').value != this.value) {
          this.style.borderColor = 'red';
          document.getElementById('confirmpass').classList.add('times');
        } else {
          this.style.borderColor = 'green';
          document.getElementById('confirmpass').classList.add('check');
        }
      });
      document.getElementById('chgpass').addEventListener('click', function() {
        let confirmpass = document.getElementById('confirmpass'), newpass = document.getElementById('newpass'), oldpass = document.getElementById('oldpass');
        sendMessage("info", "Sending request.");
        if(confirmpass.classList.contains('check') && newpass.classList.contains('check') && passSTR > 5) { // && oldpass.classList.contains('check')
          sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "_oPass="+oldpass.value, "_nPass="+newpass.value, "_oUid="+curUser[0]['uid']], "{{asset('client1/request/customQuery/chgPass')}}", 'POST', true, {
            functionProcess: function(arr) {
              document.getElementById('newpass').classList.remove('loading');
              if(arr == true) {
                sendMessage("success", "Successfully changed password. Redirected to login page");
                setTimeout(function() {
                  window.location.href = "{{asset('client1')}}";
                }, 1000);
              } else {
                sendMessage("warning", arr);
              }
            }
          });
        } else {
          sendMessage("danger", "Please check your password if it contains all requirements or that it has never been used before");
        }
      });


      document.body.addEventListener('focus', function(e) {
        let target = e.target || window.event.target, acpId = { oldpass: 'oldpass', newpass: 'newpass', confirmpass: 'confirmpass' };
        if(target.id in acpId) {
          document.getElementById(target.id).classList.remove('loading');
          document.getElementById(target.id).classList.remove('check'); document.getElementById(target.id).classList.remove('times');
        }
      });
      sendMessage('warning', 'If your username is not <strong>'+curUser[0]['uid']+'</strong>, please click <a href="{{asset('client1/')}}">here</a>');
    })();
  </script>
</body>
@endsection