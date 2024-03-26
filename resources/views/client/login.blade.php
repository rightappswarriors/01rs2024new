@extends('main')
@section('content')
@include('client.cmp.login')
<body>
	@include('client.cmp.nav')
	@include('client.cmp.__msg')
	<div class="container mt-5">
		{{-- <small>DOH Employee? Click <a href="{{asset('employee')}}">here</a></small> --}}
		{{-- <br> --}}
		<div class="row">
			<div id="__steps" class="col-md-6 mt-5">
				<h1>DOH Licensing Process</h1><br>
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				  {{-- <ol class="carousel-indicators">
				    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
				  </ol> --}}
				  <div class="carousel-inner">
				    <div class="carousel-item active">
						{{-- <div class="carousel-caption d-none d-md-block"></div> --}}
					    <h4><i class="fa fa-registered"></i>&nbsp;<strong>Step 1:</strong>&nbsp;Registration</h4>
					    <p>Sign-up for your health facility. Get your username and password.</p>
					    <h4><i class="fa fa-address-book"></i>&nbsp;<strong>Step 2:</strong>&nbsp;Apply</h4>
					    <p>Fill-in application form and submit requirements online.</p>
					    <h4><i class="fa fa-credit-card"></i>&nbsp;<strong>Step 3:</strong>&nbsp;Payment</h4>
					    <p>You need to pay for the evaluation and inspection process.</p>
				    </div>
				    <div class="carousel-item">
					    <h4><i class="fa fa-check"></i>&nbsp;<strong>Step 4:</strong>&nbsp;Evaluation</h4>
					    <p>DOH will evaluate your submitted documents and notify your schedule of inspection.</p>
					    <h4><i class="fa fa-search"></i>&nbsp;<strong>Step 5:</strong>&nbsp;Inspection</h4>
					    <p>DOH will conduct inspection and notify the status of your application.</p>
					    <h4><i class="fa fa-print"></i>&nbsp;<strong>Step 6:</strong>&nbsp;Issuance</h4>
					    <p>You can now print your application online.</p>
				    </div>
				  </div>
				  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				    <span class="" aria-hidden="true"></span>
				    <span class="sr-only">Previous</span>
				  </a>
				  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				    <span class="" aria-hidden="true"></span>
				    <span class="sr-only">Next</span>
				  </a>
				</div>
				{{-- carousel-control-prev-icon
				carousel-control-next-icon --}}
			</div>
			<div id="__register" class="col-md-6">
				<h1>Register</h1>
				<h5>Sign Up for free!</h5>
				<div class="progress">
				  	<div id="progress_id" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
				</div>
				<form id="reg_form" method="POST" action="{{asset('/')}}">
					{{csrf_field()}}
					{{-- name="grp_id" --}}
					<div hidden>
						<div class="row">
							<div class="col-md-12">
								<label>Facility Name:</label>
								<input class="form-control"  type="text" name="text2" placeholder="Facility Name">
							</div>
						</div>
						<div class="row">
							<div class="col-md-7">
								<label>Facility Type:</label>
								{{-- <input class="form-control" list="dt0" name="text3"> --}}
								<div class="row">
									<div class="col-md-2">
										<button class="btn btn-info" type="button" class="btn btn-primary" data-toggle="modal" data-target="#selFacMode"><i class="fa fa-plus"></i></button>
									</div>
									<div class="col-md-10">
										<select class="form-control" name="text3" onchange="_fcChMode(this.value)">
											<option value hidden disabled selected id>Select Type</option>
											@isset($cmpLoc)
												@isset($cmpLoc['fAds'])
													@foreach($cmpLoc['fAds'] AS $fAds)
														<option value="{{$fAds->hgpid}}">{{$fAds->hgpdesc}}</option>
													@endforeach
												@endisset
											@endisset
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<label>Bed Capacity:</label>
								<input class="form-control" type="number" name="text4" placeholder="Bed Capacity">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Institutional Character:</label>
								<select class="form-control" name="text32">
									@isset($cmpLoc['ffAds']) 
									<option value disabled selected hidden>Select</option>
									@foreach($cmpLoc['ffAds'] AS $ffAdsRow)
									<option value="{{$ffAdsRow->facmid}}">{{$ffAdsRow->facmdesc}}</option>
									@endforeach @else
									<option value disabled selected hidden>No data.</option>
									@endisset
								</select>
							</div>
							<script type="text/javascript">_fcChMode();</script>
						</div>
					</div>
					<div name="grp_id">
						<div class="row">
							<div class="col-md-6">
								<label>Region:</label>
								<div class="input-group mb-3">
								  <div class="input-group-prepend" style="cursor: pointer;" data-toggle="modal" data-target="#exampleModal">
								    <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker" style="color: maroon;"></i></span>
								  </div>
								  <select class="form-control adUser" name="text16" onchange="chAdUser(1, ['provid', 'provname', 'rgnid'])">
								  	<option value hidden disabled selected>Select</option>
								  </select>
								</div>
								{{-- <input class="form-control" list="dt4" name="text16"> --}}
							</div>
							<div class="col-md-6">
								<label>Province:</label>
								{{-- <input class="form-control" list="dt3" name="text13"> --}}
								<select class="form-control adUser" name="text13" onchange="chAdUser(2, ['cmid', 'cmname', 'provid'])">
									<option value hidden disabled selected>Select</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>City/Municipality:</label>
								{{-- <input class="form-control" list="dt2" name="text12"> --}}
								<select class="form-control adUser" name="text12" onchange="chAdUser(3, ['brgyid', 'brgyname', 'cmid'])">
									<option value hidden disabled selected>Select</option>
								</select>
							</div>
							<div class="col-md-6">
								<label>Barangay:</label>
								{{-- <input class="form-control" list="dt1" name="text11"> --}}
								<select class="form-control adUser" name="text11">
									<option value hidden disabled selected>Select</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-md-8">
								<label>Street Name:</label>
								<input class="form-control" type="text" name="text10" placeholder="Street Name">
							</div>
							<div class="col-md-4">
								<label>Zip Code:</label>
								<input class="form-control" type="text" name="text14" placeholder="Zip Code">
							</div>
						</div>
					</div>
					<div name="grp_id">
						<div class="row">
							<div class="col-md-8">
								<label>Contact Person's Name:</label>
								<input class="form-control"  type="text" name="text7" placeholder="Contact Person's Name">
							</div>
							<div class="col-md-4">
								<label>Number:</label>
								<input class="form-control" type="number" name="text8" placeholder="Number">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Email Address: <small id="eMsg" class="text-danger"></small></label>
								<input class="form-control"  type="email" name="text6" placeholder="Email Address">
							</div>
							<div class="col-md-6">
								<label>Authorized Signatory:</label>
								<input class="form-control"  type="text" name="text5" placeholder="Authorized Signatory">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<label>Username: <small id="userMsg" class="text-danger"></small></label>
								<input class="form-control" type="text" name="text0" placeholder="Username">
							</div>
							<div class="col-md-6">
								{{-- <label>Password:</label>
								<input class="form-control" type="password" name="text1" placeholder="Password"> --}}
							    <label for="validationDefaultUsername">Password: <small id="_togMsg"></small></label>
							    <div class="input-group">
							        <div class="input-group-prepend">
							          	<span class="input-group-text" id="inputGroupPrepend2" onclick="_togPwd();" style="cursor: pointer;"><i id="pwd" class="fa fa-eye"></i></i></span>
							        </div>
							        <input type="password" class="form-control" id="_togType" placeholder="Password" aria-describedby="inputGroupPrepend2" name="text1" onkeyup="CheckPasswordStrength(this.value)">
							    </div>
							</div>
						</div>
					</div>
					<div name="grp_id">
						<p>Are you sure you want to submit?</p>
						<small>By clicking <strong>Yes</strong>, you agree on the <a data-toggle="modal" data-target="#termsCond" href="javascript:void(0)">Terms and Conditions</a> of this site.</small>
					</div>
					<input class="form-control" type="hidden" name="text19" value="{{$_SERVER['REMOTE_ADDR']}}">
					<input class="form-control" type="hidden" name="text20" value="{{date('Y-m-d')}}">
					<input class="form-control" type="hidden" name="text21" value="{{date('h:i:s')}}">
					<input class="form-control" type="hidden" name="text17" value="C">
					<input class="form-control" type="hidden" name="text31" value="{{Illuminate\Support\Str::random(40)}}">
					<div class="modal fade" id="selFacMode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					  <div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Choose Facility Type</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					      	<div id="facMode">
					      		@isset($cmpLoc) @isset($cmpLoc['hAds']) @foreach($cmpLoc['hAds'] AS $hAds)
					      		<div id="{{$hAds->facid}}" class="custom-control custom-checkbox {{$hAds->hgpid}}" hidden>
								    <input type="checkbox" class="custom-control-input _fcMode" id="customControlValidation{{$hAds->facid}}" name="facid[]" value="{{$hAds->facid}}">
								    <label class="custom-control-label" for="customControlValidation{{$hAds->facid}}">{{$hAds->facname}}</label>
								</div>
					      		@endforeach @endisset @endisset
					      	</div>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
				</form>
				<hr>
				<button id="btnprev" class="btn btn-sm btn-info" style="float: left;" onclick="nextGroup(-1)">Prev</button>
				<button id="btnnext" class="btn btn-sm btn-info" style="float: right;" onclick="nextGroup(1)">Next</button>
				<button id="btnproc" type="submit" class="btn btn-sm btn-success" style="float: right;">Yes, I agree</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<br>
				<button class="btn btn-block btn-success">CLICK HERE TO SCAN FOR VERIFICATION OF CERTIFICATION</button>
				<br>
			</div>
			<div class="col-md-6">
				<br>
				<a href="{{asset('employee')}}" style="text-decoration: none;"><button class="btn btn-block btn-success">CLICK HERE TO GO TO DOH EMPLOYEE LOG IN PAGE</button></a>
				<br>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="termsCond" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Terms and Conditions</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <p style="line-height: 1.5; font-size: 14px;">
	        	1. Access to this website , maintained by Department of Health - Knowledge Management and Information Technology Service , is free to applicants applying for a License to Operate under the One Stop Shop Strategy.
	        	<br>
				2. Safeguard of the created and registered account user name and password , which shall be used as reference for all transactions in this website, shall be the responsibility of the applicant.
				<br>
				3. Correctness of the data encoded into the system must be assured by the applicant. Otherwise, corrections of data submitted can only be done by the administrators .
				<br>
				4. Viewing of the status of the application can only be accessed by the concerned applicant or his representative
				<br>
				5. All entries shall be treated with utmost confidentiality.
			</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Map</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div id="map"></div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      </div>
	    </div>
	  </div>
	</div>
</body>
<script type="text/javascript">
	var map, infoWindow;
	var sInt, _TimVal; curName = "grp_id"; nextGroup(0);
	(function() {
		var _obj = {text16: "province", text13: "city_muni", text12: "barangay"}, _arrName = {text16: "text13", text13: "text12", text12: "text11"}, _arrCol = {text16: ["provid", "provname"], text13: ["cmid", "cmname"], text12: ["brgyid", "brgyname"]}, _arrQCol = {text16: "rgnid", text13: "provid", text12: "cmid"}, _allObj = ["text16", "text13", "text12", "text11"];
		document.body.addEventListener('change', function(e) {
			let _target = e.target || window.event.target, curDom = document.getElementsByName(_arrName[_target.name])[0], curInOf = _allObj.indexOf(_target.name);
			if(_target.name in _obj) {
				if(_allObj > -1) {
					for(var i = _allObj[curInOf]; i < _allObj.length; i++) {
						document.getElementsByName(_allObj[curInOf])[0].innerHTML = '<option value hidden selected disabled>Select</option>';
					}
				}
				curDom.classList.add('loading');
				sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "rTbl="+_arrQCol[_target.name], "rId="+document.getElementsByName(_target.name)[0].value], "{{asset('client/request')}}/"+_obj[_target.name], "POST", true, {
					functionProcess: function(arr) {						
						if(curDom != undefined || curDom != null) {
							curDom.innerHTML = '<option value hidden selected disabled>Select</option>';
							arr.forEach(function(a, b, c) {
								curDom.innerHTML += '<option value="'+a[_arrCol[_target.name][0]]+'">'+a[_arrCol[_target.name][1]]+'</option>';
							});
							curDom.classList.remove('loading');
						}
					}
				});
			}
		});
		document.body.addEventListener('keyup', function(e) {
			let _target = e.target || window.event.target, _obj = {text6: "email", text0: "uid"}, _objMsg = {text6: "eMsg", text0: "userMsg"}, _objContent = {text6: "Email already used.", text0: "Username already used"}, _objContent1 = {text6: "Input email address", text0: "Input username"}; _objMask = {text8: "+639999999999"}
			if(_target.name in _obj) {
				if(document.getElementsByName(_target.name)[0] != undefined || document.getElementsByName(_target.name)[0] != null) {
					arrArr = undefined;
					document.getElementsByName(_target.name)[0].style.borderColor = 'gold';
					if(document.getElementsByName(_target.name)[0].value != "") {
						clearTimeout(_TimVal);
						_TimVal = setTimeout(function() {
							sendRequestRetArr(["_token="+document.getElementsByName('_token')[0].value, "rTbl="+_obj[_target.name], "rId="+document.getElementsByName(_target.name)[0].value], "{{asset('client/request/x08')}}", "POST", true, {
								functionProcess: function(arr) {
									if(arr != undefined) {
										console.log(arr.length);
										if(arr.length > 0) {
											document.getElementById(_objMsg[_target.name]).innerHTML = _objContent[_target.name];
											document.getElementsByName(_target.name)[0].style.borderColor = 'red';
										} else {
											document.getElementById(_objMsg[_target.name]).innerHTML = '';
											document.getElementsByName(_target.name)[0].style.borderColor = 'green';
										}
									}
								}
							});
						}, 500);
					} else {
						document.getElementById(_objMsg[_target.name]).innerHTML = _objContent1[_target.name];
						document.getElementsByName(_target.name)[0].style.borderColor = 'red';
					}
				}
			}
			if(_target.name in _objMask) {
				
			}
		});
		document.getElementsByName('text16')[0].classList.add('loading');
		sendRequestRetArr([], "{{asset('client/request/region')}}", "GET", true, {
			functionProcess: function(arr) {
				let curDom = document.getElementsByName('text16')[0];
				if(curDom != undefined || curDom != null) {
					curDom.innerHTML = '<option value hidden selected disabled>Select</option>';
					arr.forEach(function(a, b, c) {
						curDom.innerHTML += '<option value="'+a['rgnid']+'">'+a['rgn_desc']+'</option>';
					});
					curDom.classList.remove('loading');
				}
			}
		});
	})();
		
	function initMap() {
	    map = new google.maps.Map(document.getElementById('map'), {
	      center: {lat: -34.397, lng: 150.644},
	      zoom: 6
	    });
	    infoWindow = new google.maps.InfoWindow;

	    // Try HTML5 geolocation.
	    if (navigator.geolocation) {
	      navigator.geolocation.getCurrentPosition(function(position) {
	        var pos = {
	          lat: position.coords.latitude,
	          lng: position.coords.longitude
	        };

	        infoWindow.setPosition(pos);
	        infoWindow.setContent('Location found.');
	        infoWindow.open(map);
	        map.setCenter(pos);
	      }, function() {
	        handleLocationError(true, infoWindow, map.getCenter());
	      });
	    } else {
	      // Browser doesn't support Geolocation
	      handleLocationError(false, infoWindow, map.getCenter());
	    }
	}

	function handleLocationError(browserHasGeolocation, infoWindow, pos) {
	    infoWindow.setPosition(pos);
	    infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
	    infoWindow.open(map);
 	}
</script>
{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBE7IlYmz12J_ME_ePczAF6NKr2Ha9ss5w&callback=initMap"> </script> --}}
@include('client.cmp.foot')
@endsection