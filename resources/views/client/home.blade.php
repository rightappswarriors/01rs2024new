@extends('main')
@include('client.cmp.__home')
@section('content')
<body>
	@include('client.cmp.nav')
	@include('client.cmp.__msg')
	@include('client.cmp.breadcrumb')
	<script type="text/javascript">
		var ___div = document.getElementById('__homeBread');
		if(___div != null || ___div != undefined) {
			___div.classList.remove('active');
			___div.classList.add('text-primary');
		}
	</script>
	<img src="{{asset('ra-idlis/public/img/loimg.png')}}" id="aniImg" hidden>

	<div id="aniDlg" class="speech-bubble-left" hidden>
		<p>Need a guide for first-time visitors?</p>
		<div class="doloresGuide" style="float: right;">
			<button class="btn btn-success btn-sm goIntro">Yes</button>
			<button class="btn btn-danger btn-sm noIntro">No</button>
		</div>
	</div>

	<div style="height: 60px;"></div>
	<div class="container">
		<div class="row">
			<div class="_forIntro col-lg-6">
	          <div class="card flex-lg-row mb-4 box-shadow h-lg-250">
	            <div class="card-body d-flex flex-column align-items-start">
	              <strong class="d-inline-block mb-2 text-primary">Step 1</strong>
	              <h3 class="mb-0">
	                <a class="text-dark" href="{{asset('/client/apply')}}">Apply</a>
	              </h3>
	              <div class="mb-1 text-muted">Last applied: @if($lsApl != NULL) {{date("M jS, Y", strtotime($lsApl->t_date))}} @else N/A @endif</div>
	              <p class="card-text mb-auto">Fill-in application form and submit requirements online.</p>
	              <a href="{{asset('/client/listing')}}">View all Application(s) applied</a>
	            </div>
	            <img class="card-img-right flex-auto d-none d-lg-block" data-src="Payment" alt="Payment" style="width: 200px; height: 250px; object-fit: cover;" src="{{asset('ra-idlis/public/img/apply.jpg')}}" data-holder-rendered="true">
	          </div>
	        </div>
			<div class="_forIntro col-lg-6">
	          <div class="card flex-lg-row mb-4 box-shadow h-lg-250">
	            <div class="card-body d-flex flex-column align-items-start">
	              <strong class="d-inline-block mb-2 text-primary">Step 2</strong>
	              <h3 class="mb-0">
	                <a class="text-dark" href="{{asset('/client/payment')}}">Payment</a>
	              </h3>
	              <div class="mb-1 text-muted"></div>
	              <p class="card-text mb-auto">You need to pay for the evaluation and inspection process.</p>
	              {{-- <a href="{{asset('/client/payment')}}">Continue in this step</a> --}}
	            </div>
	            <img class="card-img-right flex-auto d-none d-lg-block" data-src="Payment" alt="Payment" style="width: 200px; height: 250px; object-fit: cover;" src="{{asset('ra-idlis/public/img/payment.jpg')}}" data-holder-rendered="true">
	          </div>
	        </div>
	        <div></div>
	    </div>
		<div class="row">
			<div class="_forIntro col-lg-6">
	          <div class="card flex-lg-row mb-4 box-shadow h-lg-250">
	            <div class="card-body d-flex flex-column align-items-start">
	              <strong class="d-inline-block mb-2 text-primary">Step 3</strong>
	              <h3 class="mb-0">
	                <a class="text-dark" href="{{asset('/client/evaluation')}}">Evaluation</a>
	              </h3>
	              <div class="mb-1 text-muted"></div>
	              <p class="card-text mb-auto">DOH will evaluate your submitted documents and notify your schedule of inspection.</p>
	              <a href="{{asset('/client/evaluation')}}">View your evaluation status</a>
	            </div>
	            <img class="card-img-right flex-auto d-none d-lg-block" data-src="Payment" alt="Payment" style="width: 200px; height: 250px; object-fit: cover;" src="{{asset('ra-idlis/public/img/evaluation.jpg')}}" data-holder-rendered="true">
	          </div>
	        </div>
			<div class="_forIntro col-lg-6">
	          <div class="card flex-lg-row mb-4 box-shadow h-lg-250">
	            <div class="card-body d-flex flex-column align-items-start">
	              <strong class="d-inline-block mb-2 text-primary">Step 4</strong>
	              <h3 class="mb-0">
	                <a class="text-dark" href="{{asset('/client/inspection')}}">Inspection</a>
	              </h3>
	              <div class="mb-1 text-muted"></div>
	              <p class="card-text mb-auto">DOH will conduct inspection and notify the status of your application.</p>
	              <a href="{{asset('/client/inspection')}}">View your inspection status</a>
	            </div>
	            <img class="card-img-right flex-auto d-none d-lg-block" data-src="Payment" alt="Payment" style="width: 200px; height: 250px; object-fit: cover;" src="{{asset('ra-idlis/public/img/inspection.jpg')}}" data-holder-rendered="true">
	          </div>
	        </div>
	        <div></div>
	    </div>
	    <div class="row">
			<div class="_forIntro col-lg-6">
	          <div class="card flex-lg-row mb-4 box-shadow h-lg-250">
	            <div class="card-body d-flex flex-column align-items-start">
	              <strong class="d-inline-block mb-2 text-primary">Step 5</strong>
	              <h3 class="mb-0">
	                <a class="text-dark" href="{{asset('/client/issuance')}}">Issuance</a>
	              </h3>
	              <div class="mb-1 text-muted"></div>
	              <p class="card-text mb-auto">You can now print your application online.</p>
	              <a href="{{asset('/client/issuance')}}">Continue with this step</a>
	            </div>
	            <img class="card-img-right flex-auto d-none d-lg-block" data-src="Payment" alt="Payment" style="width: 200px; height: 250px; object-fit: cover;" src="{{asset('ra-idlis/public/img/issuance.jpg')}}" data-holder-rendered="true">
	          </div>
	        </div>
	    </div>
	</div>
</body>
<script type="text/javascript">
	__doloresDisp(); __initEvent();
</script>
@include('client.cmp.foot')
@endsection