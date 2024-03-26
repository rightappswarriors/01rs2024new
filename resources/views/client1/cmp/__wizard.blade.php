{{-- <div class="box"> --}}
	{{-- <div class="box-title">Progress in Application</div> --}}
	<style type="text/css">
/* Step Navigation
------------------------------------------------------------------------- */
	
	.stepNav {
	  margin: 30px 20px;
		height: 43px;
		padding-right: 20px;
		position: relative;
		z-index: 0;
		list-style: none;
		}
	
	/* z-index to make sure the buttons stack from left to right */
	
	.stepNav li {
		float: left;
		position: relative;
		-webkit-box-shadow: 0 1px 1px rgba(0,0,0,0.12);
		   -moz-box-shadow: 0 1px 1px rgba(0,0,0,0.12);
				    box-shadow: 0 1px 1px rgba(0,0,0,0.12);
		}
		
	.stepNav li:first-child {
		-webkit-border-radius: 5px 0 0 5px;
		   -moz-border-radius: 5px 0 0 5px;
	   	      border-radius: 5px 0 0 5px;
		}
	
	
	/* different widths */
	.stepNav.fivewide li { width: 25%; }
	
	   /* step links */
	
	.stepNav a, .stepNav a:visited {
		width: 100%;
		height: 43px;
		padding: 0 0 0 25px;
		color: #717171;
		text-align: center;
		text-shadow: 0 1px 0 #fff;
		line-height: 43px;
		white-space: nowrap;
		border: 1px solid #cbcbcb;
		text-decoration: none;
		border-top-color: #dddddd;
		border-right: 0;
		background-color: #fbfbfb;
		background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(251, 251, 251)), to(rgb(233, 233, 233)));
		background-image: -webkit-linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -moz-linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -o-linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -ms-linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: linear-gradient(top, rgb(251, 251, 251), rgb(233, 233, 233));
		float: left;
		position: relative;
		-webkit-box-sizing: border-box;
		   -moz-box-sizing: border-box;
			      box-sizing: border-box;
		}
		
	.stepNav li:first-child a {
		padding-left: 12px;
		-webkit-border-radius: 5px 0 0 5px;
		   -moz-border-radius: 5px 0 0 5px;
	   	      border-radius: 5px 0 0 5px;
		}
	
	.stepNav a:before {
		content: "";
		width: 29px;
		height: 29px;
		border-right: 1px solid #dddddd;
		border-bottom: 1px solid #cbcbcb;
		background-image: -webkit-gradient(linear, right top, left bottom, from(rgb(251, 251, 251)), to(rgb(233, 233, 233)));
		background-image: -webkit-linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -moz-linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -o-linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: -ms-linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		background-image: linear-gradient(right top, rgb(251, 251, 251), rgb(233, 233, 233));
		display: block;
		position: absolute;
		top: 6px;
		right: -16px;
		z-index: 1;
		-webkit-transform: rotate(-45deg);
		   -moz-transform: rotate(-45deg);
		     -o-transform: rotate(-45deg);
			 	    transform: rotate(-45deg);
		}
		
	.stepNav a:hover {
		color: #2e2e2e;
		background-color: #f5f5f5;
		background-image: -webkit-gradient(linear, left top, left bottom, from(rgb(242, 242, 242)), to(rgb(217, 217, 217)));
		background-image: -webkit-linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -moz-linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -o-linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -ms-linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: linear-gradient(top, rgb(242, 242, 242), rgb(217, 217, 217));
		}
		
	.stepNav a:hover:before {
		background-image: -webkit-gradient(linear, right top, left bottom, from(rgb(242, 242, 242)), to(rgb(217, 217, 217)));
		background-image: -webkit-linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -moz-linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -o-linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: -ms-linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		background-image: linear-gradient(right top, rgb(242, 242, 242), rgb(217, 217, 217));
		}
	
	/* selected */
		
	.stepNav li.selected {
		-webkit-box-shadow: none;
		   -moz-box-shadow: none;
				    box-shadow: none;
		}
								
	.stepNav li.selected a, .stepNav li.selected a:before {
		background: #ebebeb;
		}
		
	.stepNav li.selected a {
		border-top-color: #bebebe;
		-webkit-box-shadow: inset 2px 1px 2px rgba(0,0,0,0.12);
		   -moz-box-shadow: inset 2px 1px 2px rgba(0,0,0,0.12);
				    box-shadow: inset 2px 1px 2px rgba(0,0,0,0.12);
		}
		
	.stepNav li.selected a:before {
		border-right: 1px solid #bebebe;
		border-bottom: 1px solid #cbcbcb;
		-webkit-box-shadow: inset -1px -1px 1px rgba(0,0,0,0.1);
		   -moz-box-shadow: inset -1px -1px 1px rgba(0,0,0,0.1);
				    box-shadow: inset -1px -1px 1px rgba(0,0,0,0.1);
		}
	</style>
	<!-- <div class="wizard">
		<div class="wizard-step">
			<div class="wizard-step-child wizardcount">1</div>
		</div>
		<div class="wizard-step">
			<div class="wizard-step-child wizardcount">2</div>
		</div>
		<div class="wizard-step">
			<div class="wizard-step-child wizardcount">3</div>
		</div>
		<div class="wizard-step">
			<div class="wizard-step-child wizardcount">4</div>
		</div>
		<div class="wizard-step">
			<div class="wizard-step-child wizardcount">5</div>
		</div>
	</div>
	<div class="container mt-4 text-center h3" id="stepDetails">
		
	</div> -->


	<!-- <ul class="stepNav fivewide" style="margin: 0px 30px" id="navBarWiz">
	    <li id="s1"><a title="Step 1: Basic Details"><p style="font-size: 14px;">1. Basic Info</p></a></li>
		<li id="s2"><a title="Step 2: Application Details"><p style="font-size: 14px;">2. Application Details</p></a></li>
		{{-- <li id="s3"><a title="Step 3: Pre-assessment/Checklist"><p style="font-size: 14px;">3. Pre-assessment/Checklist</p></a></li> --}}
		<li id="s3"><a title="Step 3: Submission of Requirements"><p style="font-size: 14px;">3. Submission of Requirements</p></a></li>
		<li id="s4"><a title="Step 4: Releasing Certificate"><p style="font-size: 14px;">4. Releasing of Certificate</p></a></li>
	</ul> -->

	<div class="container-fluid" id="wiz_container">
    <nav class="navbar navbar-light" >
        <div class="row" >
            <div class="col-lg-4 text-center bg-secondary"><a href="javascript: void(0)" class="text-white">
                <i class="fa fa-file-text-o" aria-hidden="true"></i> Application Details</a>
            </div>
            <div class="col-lg-4 text-center bg-primary">
                <a href="javascript: void(0)" class="text-white"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Submission of Requirement</a>
            </div>
            <div class="col-lg-4 text-center bg-secondary">
                <a href="javascript: void(0)" class="text-white"> <i class="fa fa-check-circle" aria-hidden="true"></i> Releasing of Certificate</a>
            </div>
        </div>
    </nav>
</div>
<style>
    #wiz_container .row {
        width: 100% !important;
        margin: 0px;
    }
    #wiz_container nav.navbar {
        padding: 0px;
    }
    #wiz_container .row .col-lg-4:hover {
        cursor: pointer;
        background-color: #999!important;
    }
    #wiz_container .row .col-lg-4 {
        padding: 20px;
    }
    #wiz_container nav.navbar a:hover {
        text-decoration:  none;
    }
</style>
{{-- </div> --}}