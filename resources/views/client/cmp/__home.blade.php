<head>
	<title>Welcome | {{isset($curUser->facilityname) ? $curUser->facilityname : 'Department of Health'}}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="{{asset('ra-idlis/public/css/introjs.css')}}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript" src="{{asset('ra-idlis/public/js/intro.js')}}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="{{asset('ra-idlis/public/css/forall.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<style type="text/css">
		#aniImg {
			position: fixed;
			bottom: 0;
			z-index: 1000000000;
		}
		.aniImgLeft {
			left: 0 !important;
		}
		.aniImgRight {
			-webkit-transform: scaleX(-1) !important;
    		transform: scaleX(-1) !important;
			right: 0 !important;
		}
		.speech-bubble-left {
			position: relative;
			background: #00aabb;
			border-radius: .4em;
			padding: 10px;
			position: fixed;
			z-index: 1000000000;
		}
		.speech-bubble-left:after {
			content: '';
			position: absolute;
			left: 0;
			top: 50%;
			width: 0;
			height: 0;
			border: 20px solid transparent;
			border-right-color: #00aabb;
			border-left: 0;
			border-bottom: 0;
			margin-top: -10px;
			margin-left: -20px;
		}
		.speech-bubble-right {
			position: relative;
			background: #00aabb;
			border-radius: .4em;
			padding: 10px;
			position: fixed;
			z-index: 1000000000;
		}
		.speech-bubble-right:after {
			content: '';
			position: absolute;
			right: 0;
			top: 50%;
			width: 0;
			height: 0;
			border: 20px solid transparent;
			border-left-color: #00aabb;
			border-right: 0;
			border-bottom: 0;
			margin-top: -10px;
			margin-right: -20px;
		}
	</style>
	<script type="text/javascript">
		'use strict';
		var introGet = localStorage.getItem("setIntro"); var getIntro = ((introGet != null || introGet != undefined) ? introGet : null);
		var __cWidth = 0, __cHeight = 0, __countDisabled = 0;
		var _toggleDolores = ['aniImgRight', 'aniImgLeft'], _toggleMessageBox = ['speech-bubble-right', 'speech-bubble-left'], _curToggle = 0;
		var arrDisp = ["Click here to apply", "After applying, add payment to the applied application", "Check if your application is already Evaluated regularly.", "Click here to check the status of the uploaded file(s) in Assessment", "If all of the steps met the required data, you can proceed in printing your application"], arrClass = ["introjs-showElement", "introjs-relativePosition"];
		function __dispIntro() {
			var div = document.getElementsByClassName('_forIntro'); var _incFail = 0;
			if(div != null || div != undefined) {
				if(getIntro != null) {
					for(var i = 0; i < div.length; i++) {
						div[i].setAttribute('data-intro', arrDisp[i]);
						div[i].setAttribute('data-step', (i + 1));
						for(var j = 0; j < arrClass.length; j++) {
							div[i].classList.add(arrClass[j]);
						}
						if(!div[i].hasAttribute('data-intro') && !div[i].hasAttribute('data-step')) {
							_incFail++;
						}
					}
					if(_incFail < 1) {
						localStorage.clear();
						introJs().start();
					}
				}
			}
		}
		function __doloresDisp() {
			let aniImg = document.getElementById('aniImg'), aniDlg = document.getElementById('aniDlg');
			if(getIntro != null) {
				aniImg.removeAttribute('hidden'); aniDlg.removeAttribute('hidden');
				if(aniImg != null || aniImg != undefined) {
					function __doloresResize() {
						__cWidth = document.body.clientWidth, __cHeight = document.body.clientHeight;
						if(__cWidth < 992) {
							_curToggle = 0;
						} else {
							_curToggle = 1;
						}
						_toggleDolores.forEach(function(a, b, c) {
							if(aniImg.classList.contains(a)) {
								aniImg.classList.remove(a);
							}
						});
						aniImg.classList.add(_toggleDolores[_curToggle]);

						if(__cWidth < 401) {
							aniImg.style.width = (__cWidth - 100) + 'px';
							aniImg.style.height = 'auto';
						} else {
							aniImg.style.height = (__cHeight - document.getElementsByTagName('nav')[0].clientHeight) + 'px';
							aniImg.style.width = 'auto';
						}
						__moveDolores();
					}
					window.addEventListener('resize', __doloresResize);
					 __doloresResize();
				}
			} else {
				aniImg.parentNode.removeChild(aniImg); aniDlg.parentNode.removeChild(aniDlg);
			}
		}
		function __moveDolores() {
			let aniImg = document.getElementById('aniImg'), aniDlg = document.getElementById('aniDlg');
			if(aniImg != undefined || aniImg != null) {
				_toggleDolores.forEach(function(a, b, c) {
					aniImg.classList.remove(a);
				});
				aniImg.classList.add(_toggleDolores[_curToggle]);
			}
			if(aniDlg != undefined || aniDlg != null) {
				_toggleMessageBox.forEach(function(a, b, c) {
					aniDlg.classList.remove(a);
				});
				aniDlg.classList.add(_toggleMessageBox[_curToggle]);
				aniDlg.style.top = (aniImg.offsetTop + aniDlg.clientHeight);
				aniDlg.style.left = (Math.abs(aniImg.offsetLeft + ((aniImg.clientWidth/2)/2 - aniImg.clientWidth)));
			}
		}
		function __initEvent() {
			document.body.addEventListener('click', function(e) {
				let toElement = e.target || event.target;
				if(toElement.classList.contains('introjs-button')) {
					if(__cWidth > 991) {
						if(toElement.classList.contains('introjs-nextbutton')) {
							if(toElement.classList.contains('introjs-disabled')) {
								if(__countDisabled < 1) {
									__countDisabled = 1;
									_curToggle = _curToggle + ((_curToggle < 1) ? 1 : -1);
								}
							} else {
								__countDisabled = 0;
								_curToggle = _curToggle + ((_curToggle < 1) ? 1 : -1);
							}
						} else if(toElement.classList.contains('introjs-prevbutton')) {
							__countDisabled = 0;
							_curToggle = _curToggle + ((_curToggle < 1) ? 1 : -1);
						}
					}
					if(toElement.classList.contains('introjs-skipbutton')) {
						document.getElementById('aniImg').parentNode.removeChild(document.getElementById('aniImg'));
					}
				} else if(toElement.classList.contains('goIntro')) {
					_curToggle = 0; localStorage.clear();
					document.getElementById('aniDlg').parentNode.removeChild(document.getElementById('aniDlg'));
					__dispIntro();
				} else if(toElement.classList.contains('noIntro')) {
					localStorage.clear();
					document.getElementById('aniImg').parentNode.removeChild(document.getElementById('aniImg')); document.getElementById('aniDlg').parentNode.removeChild(document.getElementById('aniDlg'));
				} else {
					// document.getElementById('aniImg').parentNode.removeChild(document.getElementById('aniImg'));
				}
				__moveDolores();
			});
			__initEvent = undefined;
		}
	</script>
</head>