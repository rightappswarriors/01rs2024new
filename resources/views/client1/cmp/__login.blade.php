<head>
	<title>Department of Health | Integrated DOH Licensing Information System</title>
	<link rel="shortcut icon" href="https://doh.gov.ph/sites/default/files/favicon.ico" type="image/vnd.microsoft.icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{asset('ra-idlis/public/css/forall.css')}}">
	<style type="text/css">
		.loading {    
		    background-color: #ffffff;
		    background-image: url("{{ asset('ra-idlis/public/img/load.gif') }}");
		    background-size: 15px 15px;
		    background-position:right center;
		    background-repeat: no-repeat;
		}
		.check {    
		    background-color: #ffffff;
		    background-image: url("{{ asset('ra-idlis/public/img/check.png') }}");
		    background-size: 15px 15px;
		    background-position:right center;
		    background-repeat: no-repeat;
		}
		.times {    
		    background-color: #ffffff;
		    background-image: url("{{ asset('ra-idlis/public/img/times.png') }}");
		    background-size: 15px 15px;
		    background-position:right center;
		    background-repeat: no-repeat;
		}
		:root {--input-padding-x: 1.5rem; --input-padding-y: .75rem; } /*body {background: #9CECFB;background: -webkit-linear-gradient(to right, #00d44b, #65f770, #b3fb9c); background: linear-gradient(to right, #00d44b, #65f770, #b3fb9c); }*/ .card-signin {border: 0; border-radius: 1rem; box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1); } .card-signin .card-title {margin-bottom: 2rem; font-weight: 300; font-size: 1.5rem; } .card-signin .card-body {padding: 2rem; } .form-signin {width: 100%; } .form-signin .btn {font-size: 80%; border-radius: 5rem; letter-spacing: .1rem; font-weight: bold; padding: 1rem; transition: all 0.2s; } .form-label-group {position: relative; margin-bottom: 1rem; } .form-label-group input, .form-label-group select {border-radius: 2rem; } .form-label-group>input, .form-label-group>select, .form-label-group>label {padding: var(--input-padding-y) var(--input-padding-x); } .form-label-group>label {position: absolute; top: 0; left: 0; display: block; width: 100%; margin-bottom: 0; /* Override default `<label>` margin */ line-height: 1.5; color: #495057; border: 1px solid transparent; border-radius: .25rem; transition: all .1s ease-in-out; } .form-label-group input::-webkit-input-placeholder, .form-label-group select::-webkit-input-placeholder {color: transparent; } .form-label-group input:-ms-input-placeholder, .form-label-group select:-ms-input-placeholder {color: transparent; } .form-label-group input::-ms-input-placeholder, .form-label-group select::-ms-input-placeholder {color: transparent; } .form-label-group input::-moz-placeholder, .form-label-group select::-moz-placeholder {color: transparent; } .form-label-group input::placeholder, .form-label-group select::placeholder {color: transparent; } .form-label-group input:not(:placeholder-shown), .form-label-group select:not(:placeholder-shown) {padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 1)); padding-bottom: calc(var(--input-padding-y) / 3); } .form-label-group input:not(:placeholder-shown)~label, .form-label-group select:not(:placeholder-shown)~label {padding-top: calc(var(--input-padding-y) / 3); padding-bottom: calc(var(--input-padding-y) / 3); font-size: 12px; color: #777; } .btn-google {color: white; background-color: #ea4335; } .btn-facebook {color: white; background-color: #3b5998; } select { height: 50px !important; }
	</style>
</head>