<head>
	<title>Apply | {{isset($curUser->facilityname) ? $curUser->facilityname : 'Department of Health'}}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="{{asset('ra-idlis/public/css/forall.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<style type="text/css">
		.loading {    
		    background-color: #ffffff;
		    background-image: url("{{ asset('ra-idlis/public/img/load.gif') }}");
		    background-size: 15px 15px;
		    background-position:right center;
		    background-repeat: no-repeat;
		}
	</style>
	<script type="text/javascript">
		"use strict";
		var clArr = [], owArr = [], fnArr = [], subArr = [], fnDesc = [], retDrr = [];
		var clDesc = "", owDesc = "", subClDesc = "";
		var curInOf = 0, _hasReturned = 0, _hasTask = 0, _newHasTask = 0, _newGetHasTask = 0;
		function __chApt(clVal) {
			var arrClr = ['bg-info', 'bg-warning', 'bg-danger', 'bg-success'];
			for(var i = 0; i < document.getElementsByName('__hfaci').length; i++) {
				for(var j = 0; j < arrClr.length; j++) {
					document.getElementsByName('__hfaci')[i].classList.remove(arrClr[j]);
				}
				if(clVal != '') {
					if(document.getElementsByName('__hfaci')[i].classList.contains(clVal)) {
						if(document.getElementsByName('__hfaci')[i].classList.contains(clVal+'_0')) {
							document.getElementsByName('__hfaci')[i].classList.add(arrClr[1]);
							document.getElementsByName('__hfaci')[i].setAttribute('onclick', 'window.location.href = "{{asset('/client/apply/view/')}}/'+document.getElementsByName('__hfaci')[i].id+'";');
						} else if(document.getElementsByName('__hfaci')[i].classList.contains(clVal+'_1')) {
							document.getElementsByName('__hfaci')[i].classList.add(arrClr[2]);
							document.getElementsByName('__hfaci')[i].setAttribute('onclick', 'window.location.href = "{{asset('/client/apply/new/')}}/'+document.getElementsByName('__hfaci')[i].id+'";');
						} else if(document.getElementsByName('__hfaci')[i].classList.contains(clVal+'_2 ')) {
							document.getElementsByName('__hfaci')[i].classList.add(arrClr[3]);
							document.getElementsByName('__hfaci')[i].setAttribute('onclick', 'window.location.href = "{{asset('/client/apply/view/')}}/'+document.getElementsByName('__hfaci')[i].id+'";');
						} else {
							document.getElementsByName('__hfaci')[i].classList.add(arrClr[0]);
							document.getElementsByName('__hfaci')[i].setAttribute('onclick', 'window.location.href = "{{asset('/client/apply/new/')}}/'+document.getElementsByName('__hfaci')[i].id+'";');
						}
					} else {
						document.getElementsByName('__hfaci')[i].classList.add(arrClr[0]);
						document.getElementsByName('__hfaci')[i].setAttribute('onclick', 'window.location.href = "{{asset('/client/apply/new/')}}/'+document.getElementsByName('__hfaci')[i].id+'";');
					}
				} else {
					document.getElementsByName('__hfaci')[i].classList.add(arrClr[0]);
					document.getElementsByName('__hfaci')[i].removeAttribute('onclick');
				}
			}
		}
		function __chCl(owVal, clVal, subClVal) {
			document.getElementsByName('owTbl').value = ""; document.getElementsByName('clTbl').value = "";
			if(owVal == null || owVal == "" || owVal == undefined) {
				document.getElementsByName('owTbl_s')[0].innerHTML = '<option hidden selected disabled value>Select Ownership</option>';
				for(var i = 0; i < owArr.length; i++) {
					document.getElementsByName('owTbl_s')[0].innerHTML += '<option value="'+owArr[i]["ocid"]+'">'+owArr[i]["ocdesc"]+'</option>';
				}
				document.getElementsByName('owTbl_s')[0].removeAttribute('hidden');
				document.getElementsByName('owTbl')[0].setAttribute('hidden', true);
				document.getElementsByName('clTbl_s')[0].innerHTML = '<option hidden selected disabled value>Select Class</option>';
				document.getElementsByName('clTbl_s')[0].removeAttribute('hidden');
				document.getElementsByName('clTbl')[0].setAttribute('hidden', true);
				document.getElementsByName('subClTbl_s')[0].innerHTML = '<option hidden selected disabled value>Select Class</option>';
				document.getElementsByName('subClTbl_s')[0].removeAttribute('hidden');
				document.getElementsByName('subClTbl')[0].setAttribute('hidden', true);
			} else {
				document.getElementsByName('owTbl_s')[0].removeAttribute('hidden'); document.getElementsByName('owTbl')[0].setAttribute('hidden', true); document.getElementsByName('clTbl_s')[0].removeAttribute('hidden'); document.getElementsByName('clTbl')[0].setAttribute('hidden', true); var clBol = true;
				for(var i = 0; i < owArr.length; i++) {
					if(owVal == owArr[i]["ocid"]) {
						document.getElementsByName('owTbl_s')[0].selectedIndex = (i + 1);
						if(owArr[i]["oc_getDesc"] == 1) {
							document.getElementsByName('owTbl')[0].removeAttribute('hidden');
							document.getElementsByName('owTbl_s')[0].setAttribute('hidden', true);
							document.getElementsByName('owTbl')[0].value = ((owDesc != "") ? owDesc : "");
							clBol = false;
						}
					}
				}
				document.getElementsByName('clTbl_s')[0].innerHTML = '<option hidden selected disabled value>Select Class</option>';
				for(var i = 0; i < clArr.length; i++) {
					if(clArr[i]['ocid'] == owVal) {
						document.getElementsByName('clTbl_s')[0].innerHTML += '<option value="'+clArr[i]['classid']+'">'+clArr[i]['classname']+'</option>';
						if(clArr[i]["class_getDesc"] == 1) {
							document.getElementsByName('clTbl')[0].removeAttribute('hidden');
							document.getElementsByName('clTbl_s')[0].setAttribute('hidden', true);
							document.getElementsByName('clTbl')[0].value = ((clDesc != "") ? clDesc : "");
							clBol = false;
						}
					}
				}

				document.getElementsByName('subClTbl_s')[0].innerHTML = '<option hidden selected disabled value>Select Sub-class</option>';
				for(var i = 0; i < subArr.length; i++) {
					if(subArr[i]['isSub'] == clVal) {
						document.getElementsByName('subClTbl_s')[0].innerHTML += '<option value="'+subArr[i]['classid']+'">'+subArr[i]['classname']+'</option>';
						if(subArr[i]["class_getDesc"] == 1) {
							document.getElementsByName('subClTbl')[0].removeAttribute('hidden');
							document.getElementsByName('subClTbl_s')[0].setAttribute('hidden', true);
							document.getElementsByName('subClTbl')[0].value = ((subClDesc != "") ? subClDesc : "");
							clBol = false;
						}
					}
				}
				// if(document.getElementsByName('clTbl')[0].options.length > 1) {
				// 	document.getElementsByName('clTbl')[0].selectedIndex = 1;
				// }
			}
			if(clVal != null || clVal != undefined || clVal != "") {
				document.getElementsByName('clTbl_s')[0].removeAttribute('hidden'); document.getElementsByName('clTbl')[0].setAttribute('hidden', true); var clBol = true;
				for(var i = 0; i < document.getElementsByName('clTbl_s')[0].options.length; i++) {
					if(clVal == document.getElementsByName('clTbl_s')[0].options[i].value) {
						document.getElementsByName('clTbl_s')[0].selectedIndex = i;
					}
				}
				for(var i = 0; i < clArr.length; i++) {
					if(clArr[i]['classid'] == clVal) {
						if(clArr[i]["class_getDesc"] == 1) {
							document.getElementsByName('clTbl')[0].removeAttribute('hidden');
							document.getElementsByName('clTbl_s')[0].setAttribute('hidden', true);
							document.getElementsByName('clTbl')[0].value = ((clDesc != "") ? clDesc : "");
						}
					}
				}
			}
			if(subClVal != null || subClVal != undefined || subClVal != "") {
				document.getElementsByName('subClTbl_s')[0].removeAttribute('hidden'); document.getElementsByName('subClTbl')[0].setAttribute('hidden', true); var clBol = true;
				for(var i = 0; i < document.getElementsByName('subClTbl_s')[0].options.length; i++) {
					if(subClVal == document.getElementsByName('subClTbl_s')[0].options[i].value) {
						document.getElementsByName('subClTbl_s')[0].selectedIndex = i;
					}
				}
				for(var i = 0; i < subArr.length; i++) {
					if(subArr[i]['classid'] == subClVal) {
						if(subArr[i]["class_getDesc"] == 1) {
							document.getElementsByName('subClTbl')[0].removeAttribute('hidden');
							document.getElementsByName('subClTbl_s')[0].setAttribute('hidden', true);
							document.getElementsByName('subClTbl')[0].value = ((subClDesc != "") ? subClDesc : "");
						}
					}
				}
			}
		}
		function __clFrm(inOf) {
			document.getElementsByName('drafts')[0].value = ""; document.getElementById('_inputDraft').value = "";
			for(var i = 0; i < document.getElementsByClassName('__clFrmCl').length; i++) {
				document.getElementsByClassName('__clFrmCl')[i].setAttribute('hidden', true);
			}
			if(inOf == 2) {
				document.getElementById('mdFot').setAttribute('hidden', true);
			} else {
				document.getElementById('mdFot').removeAttribute('hidden');
			}
			document.getElementsByClassName('__clFrmCl')[inOf].removeAttribute('hidden');
		}
		function __frCls(clsNm, inOf) {
			curInOf = (((curInOf + inOf) < 0) ? curInOf : (((curInOf + inOf)) >= document.getElementsByClassName(clsNm).length) ? curInOf : (curInOf + inOf));
			for(var i = 0; i < document.getElementsByClassName(clsNm).length; i++) {
				document.getElementsByClassName(clsNm)[i].setAttribute('hidden', true);
			}
			document.getElementsByClassName(clsNm)[curInOf].removeAttribute('hidden');
			window.scrollTo({
			    top: document.getElementsByClassName('container')[0].offsetTop,
			    behavior: "smooth"
			});
			if(curInOf < 1) {
				document.getElementById('btnprv').setAttribute('hidden', true);
				if(document.getElementsByClassName(clsNm).length < 2) {
					document.getElementById('btnsub').removeAttribute('hidden');
					document.getElementById('btnnxt').setAttribute('hidden', true);
				} else {
					document.getElementById('btnnxt').removeAttribute('hidden');
					document.getElementById('btnsub').setAttribute('hidden', true);
				}
			} else if(curInOf == (document.getElementsByClassName(clsNm).length - 1)) {
				document.getElementById('btnnxt').setAttribute('hidden', true);
				document.getElementById('btnprv').removeAttribute('hidden');
				document.getElementById('btnsub').removeAttribute('hidden');
			} else {
				document.getElementById('btnprv').removeAttribute('hidden');
				document.getElementById('btnnxt').removeAttribute('hidden');
				document.getElementById('btnsub').setAttribute('hidden', true);
			}
		}
		function __chInp(bool, id) {
			if(bool == true) {
				document.getElementById('remarks_'+id).setAttribute('hidden', true);
				// document.getElementById('remarks_'+id).removeAttribute('required');
				// document.getElementById('file_'+id).setAttribute('required', true);
			} else {
				document.getElementById('remarks_'+id).removeAttribute('hidden');
				// document.getElementById('remarks_'+id).setAttribute('required', true);
				// document.getElementById('file_'+id).removeAttribute('required');
			}
		}
		function __addClone(idName, divIdName) {
			var bolArr = Array.isArray(idName);
			if(bolArr == true) {
				for(var i = 0; i < idName.length; i++) {
					var _origL = document.getElementById(idName[i]);
					var _cloneL = _origL.cloneNode(true);
					_cloneL.classList.add('removeClone');
					document.getElementById(divIdName[i]).appendChild(_cloneL);
				}
			} else {
				var _origL = document.getElementById(idName);
				var _cloneL = _origL.cloneNode(true);
				_cloneL.classList.add('removeClone');
				document.getElementById(divIdName).appendChild(_cloneL);
			}
		}
		function __removeClone(divIdName) {
			var bolArr = Array.isArray(divIdName);
			if(bolArr == true) {
				for(var i = 0; i < divIdName.length; i++) {
					document.getElementById(divIdName[i]).innerHTML = "";
				}
			} else {
				document.getElementById(divIdName).innerHTML = "";
			}
		}
		function __clFn(fnId) {
			if(fnId != null) {
				var fnCurId = -1;
				for(var i = 0; i < fnArr.length; i++) {
					if(fnArr[i]['funcid'] == fnId) {
						fnCurId = (i+1);
					}
				}
				if(fnCurId > -1) {
					document.getElementsByName('funcId')[0].selectedIndex = fnCurId;
				}
			} else {
				document.getElementsByName('funcId')[0].innerHTML = "<option hidden selected disabled value>Select Function</option>";
				for(var i = 0; i < fnArr.length; i++) {
					document.getElementsByName('funcId')[0].innerHTML += '<option value="'+fnArr[i]['funcid']+'">'+fnArr[i]['funcdesc']+'</option>';
				}
			}
		}
		function sendRequest(arr_data, loc, type, bolRet) {
			try {
				type = type.toUpperCase();
				var xhttp = new XMLHttpRequest();
				if(bolRet == true) {
					xhttp.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
				    		retDrr = JSON.parse(this.responseText);
				    		_hasReturned = 1;
					    }
					};
				}
				xhttp.open(type, loc, bolRet);
				if(type != "GET") {
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send(arr_data.join('&'));
				} else {
					xhttp.send();
				}
				if(bolRet == false) {
					retDrr = JSON.parse(xhttp.responseText);
					_hasReturned = 1;
				}
			} catch(errMsg) {
				console.log(errMsg);
	    	}
		}
		function sendRequestRetArr(arr_data, loc, type, bolRet, objFunction) {
			try {
				type = type.toUpperCase();
				var xhttp = new XMLHttpRequest();
				if(bolRet == true) {
					xhttp.onreadystatechange = function() {
					    if (this.readyState == 4 && this.status == 200) {
				    		objFunction.functionProcess(JSON.parse(this.responseText));
					    }
					};
				}
				xhttp.open(type, loc, bolRet);
				if(type != "GET") {
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send(arr_data.join('&'));
				} else {
					xhttp.send();
				}
				if(bolRet == false) {
					objFunction.functionProcess(JSON.parse(xhttp.responseText));
					_hasReturned = 1;
				}
			} catch(errMsg) {
				console.log(errMsg);
	    	}
		}
		function retNameReqSelect(data, elName) {
			try {
				_hasTask = 1;
				document.getElementsByName(elName)[0].classList.add('loading');
				sendRequestRetArr(data[0], data[1], data[2], data[3], {
					functionProcess: function(arr) {
						document.getElementsByName(elName)[0].innerHTML = '<option value hidden>None</option>';
						var _arrTables = ["region_s", "province_s", "city_s", "barangay_s", "facilitytype_s", "servicecapabilities_s", "facMode"], _arrCols = [["rgnid", "rgn_desc"], ["provid", "provname"], ["cmid", "cmname"], ["brgyid", "brgyname"], ["hgpid", "hgpdesc"], ["facid", "facname"], ["facmid", "facmdesc"]];
						var inOfArr = _arrTables.indexOf(elName);
						if(inOfArr > -1) {
							for(var i = 0; i < arr.length; i++) {
								document.getElementsByName(elName)[0].innerHTML += '<option value="'+arr[i][_arrCols[inOfArr][0]]+'">'+arr[i][_arrCols[inOfArr][1]]+'</option>';
							}
						}
						if(inOfArr == 3) {
							_newHasTask = 1;
						}
						_hasTask = 0;
						document.getElementsByName(elName)[0].classList.remove('loading');
					}
				});
			} catch(errMsg) {
				console.log(errMsg);
			}
		}
		function retNameReqCheckBox(data, elName, appid, hfser_id) {
			try {
				_hasTask = 1;
				document.getElementsByName(elName)[0].classList.add('loading');
				sendRequestRetArr(data[0], data[1], data[2], data[3], {
					functionProcess: function(arr) {
						var _arrTables = ["facilitytype_s1", "servicecapabilities_s1"], _arrCols = [["hgpid", "hgpdesc"], ["facid", "facname"]];
						var inOfArr = _arrTables.indexOf(elName);
						if(inOfArr > -1) {
							let _newLength = Math.ceil((arr.length/4));
							document.getElementsByName(elName)[0].innerHTML = '';
							if(arr.length > 0) {
								for(var i = 0; i < _newLength; i++) {
									document.getElementsByName(elName)[0].innerHTML += '<div class="row"></div>';
									
								}
								for(var j = 0; j < _newLength; j++) {
									let _newMin = (j * 4), _newMax = (((_newMin + 4) > arr.length) ? arr.length : (_newMin + 4));
									for(var i = _newMin; i < _newMax; i++) {
										document.getElementsByName(elName)[0].getElementsByClassName('row')[j].innerHTML += '<div class="col-sm-3"><div class="custom-control custom-checkbox my-1 mr-sm-2"><input type="checkbox" class="custom-control-input" id="checkbox'+arr[i][_arrCols[inOfArr][0]]+'" name="'+_arrTables[inOfArr]+'[]" value="'+arr[i][_arrCols[inOfArr][0]]+'" required><label class="custom-control-label" for="checkbox'+arr[i][_arrCols[inOfArr][0]]+'">'+arr[i][_arrCols[inOfArr][1]]+'</label></div></div>';
										
									}
								}
								if(appid != null) {
									retNameCheckCheck([["_token="+document.getElementsByName('_token')[0].value, "appid="+appid, "hfser_id="+hfser_id], "{{asset('/client/request/customQuery/getFacility')}}", "POST", true], _arrTables[inOfArr]);
								}
								
							}
						}
						_hasTask = 0;
						if(inOfArr == 1) { _newGetHasTask = 1; }
						document.getElementsByName(elName)[0].classList.remove('loading');
					}
				});
			} catch(errMsg) {
				console.log(errMsg);
			}
		}
		function retNameCheckCheck(data, elName) {
			try {
				_hasTask = 1;
				sendRequestRetArr(data[0], data[1], data[2], data[3], {
					functionProcess: function(arr) {
						var _arrTables = ["facilitytype_s1", "servicecapabilities_s1"], _arrCols = [["hgpid", "hgpdesc"], ["facid", "facname"]];
						var inOfArr = _arrTables.indexOf(elName);
						if(inOfArr > -1) {
							var _newData = document.getElementsByName(_arrTables[inOfArr]+'[]');
							if(arr.length > 0) {
								if(arr[inOfArr] != null || arr[inOfArr] != undefined) { if(Array.isArray(arr[inOfArr])) {
									for(var i = 0; i < _newData.length; i++) {
										for(var j = 0; j < arr[inOfArr].length; j++) {
											if(arr[inOfArr][j][_arrCols[inOfArr][0]] == _newData[i].value) {
												_newData[i].checked = true;
											}
										}
									}
									var event = document.createEvent('Event');
									event.initEvent('click', false, true);
									document.getElementsByName(_arrTables[inOfArr])[0].dispatchEvent(event);
								} }
							}
						}
						_hasTask = 0;
					}
				});
			} catch(errMsg) {
				console.log(errMsg);
			}
		}
		function retNameRequirements(data, elName) {
			try {
				_hasTask = 1;
				sendRequestRetArr(data[0], data[1], data[2], data[3], {
					functionProcess: function(arr) {
						let tBodyRequirement = document.getElementById('tBodyRequirement');
						if(tBodyRequirement != null || tBodyRequirement != undefined) {
							tBodyRequirement.innerHTML = '';
							if(arr.length > 0) {
								for(let i = 0; i < arr.length; i++) {
									let firstColumn = '<td>'+arr[i]['updesc']+'</td>', 

									secondColumn = '<td>'+((arr[i]['filepath'] != null) ? ((arr[i]['evaluation'] != null) ? ((arr[i]['evaluation'] == 1) ? '<i class="fa fa-check-circle"> Approved</i>' : '<i class="fa fa-times-circle"> Approved</i>') : '<i class="fa fa-spinner"> Pending</i>') : '<input type="file" class="form-control" name="upid['+arr[i]['upid']+']" '+((arr[i]['isrequired'] != null) ? ((arr[i]['isrequired'] == 1) ? 'required autocomplete="off"' : '') : '')+'>')+'</td>';

									tBodyRequirement.innerHTML += '<tr>'+firstColumn+''+secondColumn+'</tr>';
								}
							} else {
								tBodyRequirement.innerHTML = '<tr><td colspan="2">No requirements to upload</td></tr>';
							}
						}
					}
				});
			} catch(errMsg) {
				console.log(errMsg);
			}
		}
		function actBtn(elId, curId) {
			var divClass = document.getElementById(elId);
			if(divClass != null || divClass != undefined) {
				var buttons = divClass.getElementsByTagName('button');
				for(var i = 0; i < buttons.length; i++) {
					buttons[i].classList.remove('active');
				}
				document.getElementById(curId).classList.add('active');
			}
		}
		function checkServiceCapabilities() {
			let dom = document.getElementsByName('cheatServiceCapabilitites')[0], checkBox = document.getElementsByName('facilitytype_s1[]'), checkBox1 = document.getElementsByName('servicecapabilities_s1[]'), count = 0, count1 = 0;
			if(checkBox.length > 0) {
				for(let i = 0; i < checkBox.length; i++) {
					if(checkBox[i] != null || checkBox[i] != undefined) { if(checkBox[i].checked == true) {
						count++;
					} }
				}
			}
			for(let i = 0; i < checkBox.length; i++) {
				if(checkBox[i] != null || checkBox[i] != undefined) { if(count < 1) {
					checkBox[i].setAttribute('required', true);
				} else {
					checkBox[i].removeAttribute('required');
				} }
			}
			if(checkBox1.length > 0) {
				for(let i = 0; i < checkBox1.length; i++) {
					if(checkBox1[i] != null || checkBox1[i] != undefined) { if(checkBox1[i].checked == true) {
						count1++;
					} }
				}
			}
			for(let i = 0; i < checkBox1.length; i++) {
				if(checkBox1[i] != null || checkBox1[i] != undefined) { if(count1 < 1) {
					checkBox1[i].setAttribute('required', true);
				} else {
					checkBox1[i].removeAttribute('required');
				} }
			}
		}
		function __removeHidden(clName, indOf) {
			var className = document.getElementsByClassName(clName);
			if(className.length > 0) {
				for(var i = 0; i < className.length; i++) {
					className[i].setAttribute('hidden', true);
				}
				className[indOf].removeAttribute('hidden');
			}
		}
	</script>
</head>