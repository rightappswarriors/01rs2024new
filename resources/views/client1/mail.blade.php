<center><h1>Account Registration Activation</h1></center>
<br>
<p>Dear Mr./Ms. {{ (isset($authorizedsignature) ? $authorizedsignature : 'User') }},</p>
<br>
<p>Thank you for using DOH OLRS. You have successfully registered in the system. </p>
<br>
<p>Please activate your account by clicking on the link bellow.</p>
<br>
<p><a href="{{ asset('/client1/register/verify') }}/{{ $token }}">Activate DOH OLRS Account</a></p>
<br>
<p>You may login to the system after account activation by encoding the following log-in information:</p>
<br>
<p>User ID: <u>{{ $name }}</u></p>
{{ (isset($password) ?'Password: ' .$password:'')}}
<br>
<p>You are responsible for ensuring that your User ID and Password are secure and your DOH OLRS Account will not be accessed by unauthorized persons.</p>
<br>
<p>If you need more assistance in accessing your account, please email us at <m99.doh_email>, indicating your DOH OLRS User ID and facility name to facilitate verification or call the DOH OLRS Hotline at <m99.doh_contactno> (available 8am to 5pm from Monday to Friday except during holidays).</p>
<br>
<p>Thank you for using DOH OLRS System.</p>
<br>
<p>This is a system-generated e-mail. Please do not reply.</p>