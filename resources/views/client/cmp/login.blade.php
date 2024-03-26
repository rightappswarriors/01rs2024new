<head>
	<title>Department of Health | {{isset($curUser->facilityname) ? $curUser->facilityname :'Integrated DOH Licensing Information System'}}</title>
	<link rel="shortcut icon" href="https://doh.gov.ph/sites/default/files/favicon.ico" type="image/vnd.microsoft.icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="{{asset('ra-idlis/public/css/forall.css')}}">
	<style type="text/css">
		.loading {    
		    background-color: #ffffff;
		    background-image: url("{{ asset('ra-idlis/public/img/load.gif') }}");
		    background-size: 15px 15px;
		    background-position:right center;
		    background-repeat: no-repeat;
		}
	</style>
	<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
	<script type="text/javascript">
		"use strict";
		var curName = "", errMsg = "", errTtl = ""; var curNum = 0, pCurNum = 0;
		var bAds = [], cAds = [], pAds = [], rAds = [], _frMode = ["radio", "checkbox"], arrArr = undefined;
		function nextGroup(indOf) {
			if(curName != "") {
				curNum = (((curNum + indOf) > -1) ? (((curNum + indOf) < document.getElementsByName(curName).length) ? (curNum + indOf) : curNum) : curNum);
				var curCurNum = ((curNum > 0) ? (curNum - 1) : curNum); var numOfNoVal = 0;
				if(indOf > 0) {
					var _input = document.getElementsByName(curName)[curCurNum].getElementsByTagName('input');
					var _select = document.getElementsByName(curName)[curCurNum].getElementsByTagName('select');
					if(_input.length > 0) { for(var i = 0; i < _input.length; i++) {
						if(_input[i].value == "" || _input[i].value == null || _input[i].value == undefined) {
							if(_input[i].style.borderColor == '') {
								_input[i].style.borderColor = '#dc3545';
							}
							numOfNoVal++;
						} else {
							if(_input[i].style.borderColor == '') {
								_input[i].style.borderColor = '#28a745';
							}
						}
					} }
					if(_select.length > 0) { for(var i = 0; i < _select.length; i++) {
						if(_select[i].value == "" || _select[i].value == null || _select[i].value == undefined) {
							if(_select[i].style.borderColor == '') {
								_select[i].style.borderColor = '#dc3545';
							}
							numOfNoVal++;
						} else {
							if(_select[i].style.borderColor == '') {
								_select[i].style.borderColor = '#28a745';
							}
						}
					} }
					if(numOfNoVal > 0) {
						curNum = curCurNum;
					}
				}
				for(var i = 0; i < document.getElementsByName(curName).length; i++) {
					document.getElementsByName(curName)[i].setAttribute('hidden', true);
				}
				document.getElementsByName(curName)[curNum].removeAttribute('hidden');

				if(curNum < 1) {
					document.getElementById('btnprev').setAttribute('hidden', true);
					document.getElementById('btnnext').removeAttribute('hidden');
					document.getElementById('btnproc').setAttribute('hidden', true);
					document.getElementById('btnproc').removeAttribute('form');
				} else if(curNum == (document.getElementsByName(curName).length - 1)) {
					document.getElementById('btnnext').setAttribute('hidden', true);
					document.getElementById('btnprev').removeAttribute('hidden');
					document.getElementById('btnproc').removeAttribute('hidden');
					document.getElementById('btnproc').setAttribute('form', 'reg_form');
				} else {
					document.getElementById('btnprev').removeAttribute('hidden');
					document.getElementById('btnnext').removeAttribute('hidden');
					document.getElementById('btnproc').setAttribute('hidden', true);
					document.getElementById('btnproc').removeAttribute('form');
				}
				nextPrg(curNum);
			}
		}
		function nextPrg(cNum) {
			var pNum = Math.round(((100/(document.getElementsByName(curName).length - 1)) * cNum));
			if(pCurNum < pNum) {
				for(var i = pCurNum; i <= pNum; i++) {
					document.getElementById('progress_id').style.width = i+'%';
					document.getElementById('progress_id').setAttribute('aria-valuenow', i+'px');
					document.getElementById('progress_id').innerHTML = i+'%';
				}
			} else {
				for(var i = pCurNum; i >= pNum; i--) {
					document.getElementById('progress_id').style.width = i+'%';
					document.getElementById('progress_id').setAttribute('aria-valuenow', i+'px');
					document.getElementById('progress_id').innerHTML = i+'%';
				}
			}
			pCurNum = pNum;
		}
		function chAdUser(indOf, colCur) {
			var curSel = document.getElementsByClassName('adUser')[indOf];
			var curId = ""; var arrDt = [rAds, pAds, cAds, bAds]; var curArr = arrDt[indOf];
			var intOf = 0;
			if(indOf > 0) {
				var divSel = document.getElementsByClassName('adUser')[(indOf - 1)];
				curId = divSel.options[divSel.selectedIndex].value;
			}
			for(var i = (indOf + 1); i < document.getElementsByClassName('adUser').length; i++) {
				document.getElementsByClassName('adUser')[i].innerHTML = "<option value hidden disabled selected>Select</option>";
			}
			curSel.innerHTML = "<option value hidden disabled selected>Select</option>";
			while(intOf < curArr.length) {
				if(colCur.length > 2) {
					if(curArr[intOf][colCur[2]] == curId) {
						curSel.innerHTML += '<option id="'+curArr[intOf][colCur[2]]+'" value="'+curArr[intOf][colCur[0]]+'">'+curArr[intOf][colCur[1]]+'</option>';
					}
				} else {
					curSel.innerHTML += '<option value="'+curArr[intOf][colCur[0]]+'">'+curArr[intOf][colCur[1]]+'</option>';
				}
				intOf++
			}
		}
		function _fcChMode(chType) {
			for(var i = 0; i < document.getElementsByClassName('_fcMode').length; i++) {
				document.getElementsByClassName('_fcMode')[i].checked = false;
				document.getElementById(document.getElementsByClassName('_fcMode')[i].parentNode.id).setAttribute('hidden', true);
			}
			if(chType != null) {
				for(var i = 0; i < document.getElementsByClassName('_fcMode').length; i++) {
					var id = document.getElementsByClassName('_fcMode')[i].parentNode.id;
					if(document.getElementById(id).classList.contains(chType)) {
						document.getElementById(id).removeAttribute('hidden');
					}
				}
			}
		}
		function _togPwd() {
			var _find = ["fa-eye", "fa-eye-slash"], _change = ["fa-eye-slash", "fa-eye"], _type = ["text", "password"];
			if(document.getElementById('pwd') != null) {
				var bolGet = _find.indexOf(document.getElementById('pwd').classList[1]);
				if(bolGet > -1) {
					document.getElementById('pwd').classList.remove(_find[bolGet]);
					document.getElementById('pwd').classList.add(_change[bolGet]);
					if(document.getElementById('_togType') != null) { document.getElementById('_togType').type = _type[bolGet]; }
				}
			}
		}
		function CheckPasswordStrength(password) {
	        var password_strength = document.getElementById("_togMsg"); var regex = new Array(); regex.push("[A-Z]"); regex.push("[a-z]"); regex.push("[0-9]"); regex.push("[$@$!%*#?&]"); var passed = 0; var color = ""; var strength = "";
	        if (password.length == 0) {
	            password_strength.innerHTML = "";
	            return;
	        }
	        for (var i = 0; i < regex.length; i++) {
	            if (new RegExp(regex[i]).test(password)) {
	                passed++;
	            }
	        }
	        if (passed > 2 && password.length > 8) {
	            passed++;
	        }
	        switch (passed) {
	            case 0:
	            case 1:
	                strength = "Weak Password";
	                color = "red";
	                break;
	            case 2:
	                strength = "Good";
	                color = "darkorange Password";
	                break;
	            case 3:
	            case 4:
	                strength = "Strong Password";
	                color = "green";
	                break;
	            case 5:
	                strength = "Very Strong Password";
	                color = "darkgreen";
	                break;
	        }
	        password_strength.innerHTML = strength;
	        password_strength.style.color = color;
	    }
	    localStorage.setItem("setIntro", false);
	</script>
</head>