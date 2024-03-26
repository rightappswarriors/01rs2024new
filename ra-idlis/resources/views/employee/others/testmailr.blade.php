<center><h1>Recommendatory Action on Issued Notice of Violation</h1></center>
<h3>Good Day, {{$name}}!</h3>
<p>We would like to thank you for responding on our notice.</p>
{{-- <p>However, the monitoring team has found violations in accordance to their terms.</p> --}}
@php $url = "employee/dashboard/others/raoin/".$nov; @endphp
<p>The team has sent you a <a href="{{asset($url)}}">Recommendation Action on Issued Notice of Violation</a> to inform you.</p>
{{-- <a href="{{ asset('/employee/verify') }}/{{ $token }}">Verify account</a>
<p disabled>Note: <strong>Unverified Accounts</strong> are restricted from logging in</p> --}}
<p>Regards,</p>
<p>DOH Support</p>