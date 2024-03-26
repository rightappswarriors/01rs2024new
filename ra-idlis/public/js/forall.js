// (function() {
	var unNull = {null: null, undefined: undefined};
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
	function sRetData(arrData) {
		var bolStat = Array.isArray(arrData);
		if(bolStat == true) {
			var method = ((arrData[0] != undefined || arrData[0] != null) ? arrData[0] : "GET");
			var loc = ((arrData[1] != undefined || arrData[1] != null) ? arrData[1] : "nolocation");
			var dsend = ((arrData[2] != undefined || arrData[2] != null) ? arrData[2] : null);
			var boolS = ((arrData[3] != undefined || arrData[3] != null) ? arrData[3] : false);
			var vRec = ((arrData[4] != undefined || arrData[4] != null) ? arrData[4] : "");
		    var xhttp = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest();
		    if(boolS == true) {
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
					   	window[vRec] = JSON.parse(this.response);
					} else {
						window[vRec] = [];
					}
				};
			}
			xhttp.open(method, loc, boolS);
			if(method.toUpperCase() == "GET") {
				xhttp.send();
			} else {
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send(dsend);
			}
			if(boolS == false) {
				window[vRec] = JSON.parse(xhttp.response);
			}
		} else {
			window[vRec] = [];
		}
	}
	function insDataFunction(fSend, uData, tSend, functionDisp) {
		if(!(functionDisp in {null: null, undefined: undefined})) {
			let formData = new FormData();
			if(Array.isArray(fSend)) {
				if(Array.isArray(fSend[0]) && Array.isArray(fSend[1])) {
					for(var i = 0; i < fSend[0].length; i++) {
						formData.append(fSend[0][i], fSend[1][i]);
					}
				}
			}
	    	let _curArr = [];
			jQuery.ajax({
		        type: tSend,
		        enctype: 'multipart/form-data',
		        url: uData,
		        data: formData,
		        processData: false,
		        contentType: false,
		        cache: false,
		        success: function(text) {
		        	try {
		        		_curArr = JSON.parse(text);
		        	} catch(err) {
		        		_curArr = [];
		        		insErrMsg(err, "danger");
		        	}
	        		functionDisp.functionProcess(_curArr);
		        },
		        error: function(e) {
		        	functionDisp.functionProcess([]);
		            insErrMsg("ERROR: " + e, "danger");
		        }
		    });
		}
	}
	function insErrMsg(errClr, errMsg) {
		let _div = document.getElementById('_errMsg');
		if(!(_div in {null: null, undefined: undefined})) {
			_div.innerHTML =  '<div class="alert alert-'+errClr+' alert-dismissible fade show" role="alert">'+
			  '<strong>Message:</strong> '+errMsg+''+
			  '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
			    '<span aria-hidden="true">&times;</span>'+
			  '</button>'+
			'</div>';
		} else {
			console.log(errMsg);
		}
	}
	function logoutUser(data) {
		if(Array.isArray(data)) {
			if(data.length > 2) {
				sendRequestRetArr([], data[0], data[1], true, {
		            functionProcess: function(arr) {
		              if(arr == true) {
		                insErrMsg('success', 'Successfully logged out! Redirecting');
		                setTimeout(function() {
		                	window.location.href = data[2];
		                }, 1000);
		              } else {
		                insErrMsg('danger', arr);
		              }
		            }
		        });
		    }
		}
	}
	function arrayChunk(array, chunk) {
		let chunked_array = [], chunk_size = 0;
		if(!(array in unNull) && !(chunk in unNull)) {
			if(Array.isArray(array)) {
				if(! isNaN(chunk)) {
					let cChunk_size = Math.ceil(array.length / chunk); chunk_size = ((chunk_size < 0) ? 1 : chunk_size);
					for(let i = 0; i < cChunk_size; i++) {
						sMin = i * chunk; sMax = sMin + chunk; sArr = [];
						for(let j = sMin; j < sMax; j++) {
							if(array[j] in unNull) {
								continue;
							}
							sArr.push(array[j]);
						}
						chunked_array.push(sArr);
					}
					return chunked_array;
				}
				return array; //"Size is not an integer." + typeof chunk; //
			}
			return array; //"Please provide an array"; //
		}
		return array; //"Array and/or size is null."; //
	}
	function getLatestAppformId(sLoc, sLocAdd) {
		sendRequestRetArr([], sLoc, "GET", true, {
			functionProcess: function(arr) {
				if(arr.length > 0) {
					window.location.href = sLocAdd + '/' + arr[0]['hfser_id'] + '/' + arr[0]['appid'];
				}
			}
		});
	}
	function checkFields(arrFields) {
	  let retBool = true;
	  if(Array.isArray(arrFields)) {
	    for(let i = 0; i < arrFields.length; i++) {
	      if(arrFields[i] == undefined || arrFields[i] == null) {
	        retBool = false;
	      }
	    }
	  } else {
	    retBool = false;
	  }
	  return retBool;
	}
	function addNewRow(elId, insRow) {
	  	let dom = document.getElementById(elId);
	  	if(checkFields([dom])) {
	    	dom.innerHTML += insRow;
	  	}
	}
	function deleteCurrentRow(eDom) {
		if(checkFields([eDom])) {
		    eDom.parentNode.removeChild(eDom);
		}
	}
	function giveTotal(inName, idIns) {
		let inNameArr = ((Array.isArray(inName)) ? inName : [inName]), nTotal = 0, insDom = document.getElementById(idIns);
		inNameArr.forEach(function(a, b, c) {
			let dom = document.getElementsByName(a);
			if(checkFields([dom])) {
			  	for(let i = 0; i < dom.length; i++) {
			    	let cTotal = parseFloat(dom[i].value);
			    	nTotal = nTotal + ((isNaN(cTotal)) ? 0 : cTotal);
			  	}
			}
		});
		if(checkFields([insDom])) { if(insDom.tagName.toUpperCase() == "INPUT") { insDom.value = nTotal.toFixed(2); } else { insDom.innerHTML = nTotal.toFixed(2); } }
	}
	function checkLineAmount(inName, chkName, defName) {
		let inNameArr = ((Array.isArray(inName)) ? inName : [inName]), chkNameArr = ((Array.isArray(chkName)) ? chkName : [chkName]), defNameArr = ((Array.isArray(defName)) ? defName : [defName]);
		let setAmount = function(eDom, amnt) {
			if(checkFields([eDom])) { if(eDom.tagName.toUpperCase() == "INPUT") { eDom.value = amnt; } else { eDom.innerHTML = amnt; } }
		};
		for(let i = 0; i < inNameArr.length; i++) {
			let dom = document.getElementsByName(inNameArr[i]);
			if(checkFields([dom])) { for(let j = 0; j < dom.length; j++) {
				if(checkFields([defNameArr[i]])) { let defDom = document.getElementsByName(defNameArr[i])[j]; if(checkFields([defDom])) {
					let cAmount = ((dom[j].value == "" || dom[j].value == null) ? "0.00" : dom[j].value), amountLess = parseFloat(defDom.value) - parseFloat(cAmount);
					if(amountLess < 0) { setAmount(dom[j], (parseFloat(defDom.value)).toFixed(2)); if(checkFields([document.getElementsByName(chkNameArr[i])[j]])) { setAmount(document.getElementsByName(chkNameArr[i])[j], (parseFloat("0.00")).toFixed(2)); } } else { setAmount(dom[j], (parseFloat(dom[j].value)).toFixed(2)); if(checkFields([document.getElementsByName(chkNameArr[i])[j]])) { setAmount(document.getElementsByName(chkNameArr[i])[j], (amountLess).toFixed(2)); } }
				} else { setAmount(dom[j], "0.00"); } } else { setAmount(dom[j], "0.00"); }
			} }
		}
	}
// })();