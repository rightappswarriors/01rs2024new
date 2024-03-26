<center><h1>DOHOLRS Password Recovery</h1></center>
<p>Dear <strong>{{ $uid }}</strong>, </p>
<p>A password recovery request has been initiated.</p>
<p>If this is you, click the link below.</p>
<p>If this is not you, kindly disregard this email.</p>
<a href="{{ asset('client1/forgot/') }}/{{$uid}}/a/{{$token}}">Click this Link to change your password.</a>