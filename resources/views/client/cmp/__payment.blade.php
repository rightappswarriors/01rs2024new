<head>
	<title>Payment | {{isset($curUser->facilityname) ? $curUser->facilityname : 'Department of Health'}}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="{{asset('ra-idlis/public/css/forall.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script type="text/javascript">
		"use strict";
		var arrChg = [], arrDesc = [], arrAmt = [], _nArr = [];
		var _tPg = ""; var inCOf = 0; var _gBol = false;
		function _addCh(arrRec) {
			var indOf = arrChg.indexOf(arrRec[0]);
			if(indOf < 0) {
				arrChg.push(arrRec[0]);
				arrDesc.push(arrRec[1]);
				arrAmt.push(arrRec[2]);
			}
			 _loadCh();
		}
		function _loadCh() {
			if(arrChg.length > 0) {
				document.getElementById('tBody').innerHTML = ''; var _total = 0;
				for(var i = 0; i < arrChg.length; i++) {
					document.getElementById(arrChg[i]).classList.remove('fa-plus-circle'); document.getElementById(arrChg[i]).classList.add('fa-check-circle'); _total = _total +(parseInt(arrAmt[i]));
					document.getElementById('tBody').innerHTML += '<tr> <td>'+arrDesc[i]+'</td><td>&#8369; '+arrAmt[i]+'</td><td><i class="fa fa-times-circle" style="cursor: pointer;" onclick="_delCh(\''+arrChg[i]+'\')"></i></td> <input type="hidden" name="chgapp_id[]" value="'+arrChg[i]+'"><input type="hidden" name="desc[]" value="'+arrDesc[i]+'"><input type="hidden" name="amt[]" value="'+arrAmt[i]+'"></tr>';
				}
				document.getElementById('tlPayment').innerHTML = _total;
			} else {
				document.getElementById('tBody').innerHTML = '<tr> <td colspan="3">None</td> </tr>';
				document.getElementById('tlPayment').innerHTML = '0';
			}
		}
		function _delCh(inOf) {
			var indOf = arrChg.indexOf(inOf);
			if(indOf > -1) {
				document.getElementById(arrChg[indOf]).classList.add('fa-plus-circle');
				document.getElementById(arrChg[indOf]).classList.remove('fa-check-circle');
				arrChg.splice(indOf, 1);
				arrDesc.splice(indOf, 1);
				arrAmt.splice(indOf, 1);
			}
			_loadCh();
		}
		function _nxtCh(inOf) {
			for(var i = 0; i < document.getElementsByClassName('pp1').length; i++) {
				document.getElementsByClassName('pp1')[i].setAttribute('hidden', true);
			}
			document.getElementsByClassName('pp1')[inOf].removeAttribute('hidden');
		}
		function _fWalkIn(bool) {
			if(bool == true) {
				document.getElementById('_fWlkBtn').setAttribute('form', '_fWlk');
			} else {
				document.getElementById('_fWlkBtn').removeAttribute('form');
			}
		}
		function _fNext(clName, inOf) {
			inCOf = (((inCOf + inOf) < 0) ? inCOf : (((inCOf + inOf) >= _nArr.length) ? inCOf : (inCOf + inOf)));
			var bolArr = Array.isArray(clName);
			if(bolArr == true) {
				for(var i = 0; i < clName.length; i++) {
					for(var j = 0; j < document.getElementsByClassName(clName[i]).length; j++) {
						document.getElementsByClassName(clName[i])[j].setAttribute('hidden', true);
					}
				}
			} else {
				for(var i = 0; i < document.getElementsByClassName(clName).length; i++) {
					document.getElementsByClassName(clName)[i].setAttribute('hidden', true);
				}
			}
			if(document.getElementsByName(_nArr[inCOf]) != null || document.getElementsByName(_nArr[inCOf]) != undefined) {
				for(var i = 0; i < document.getElementsByName(_nArr[inCOf]).length; i++) {
					document.getElementsByName(_nArr[inCOf])[i].removeAttribute('hidden');
				}
			}
			if((document.getElementsByClassName(_tPg)[0] != undefined && document.getElementsByClassName(_tPg)[1] != undefined)) {
				document.getElementsByClassName(_tPg)[0].innerHTML = (inCOf + 1);
				document.getElementsByClassName(_tPg)[1].innerHTML = _nArr.length;
			}
		}
		window.addEventListener('keyup', function() {
			var e = this.e || this.event;
			if(_gBol == true) {
				if(e.keyCode == 37) {
					_fNext('_fPayment', -1);
				} 
				if(e.keyCode == 39) {
					_fNext('_fPayment', 1);
				}
			}
		});
	</script>
</head>