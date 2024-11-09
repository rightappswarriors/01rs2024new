<script>


    window.addEventListener('change', function(e) {
        
        console.log("received ocid")
        if(e.target.name == 'ocid'){
            setTimeout(function(){  
                   console.log("received ocid")
                    getFacServCharge()
            }, 1000);
        }
    });
var ghgpid = document.getElementsByName('hgpid')
var curAppid = ""
var mhfser_id = "COA"
var aptid = document.getElementById("aptidnew").value

    var mserv_cap = JSON.parse('{!!addslashes($serv_cap)!!}')
    // console.log('mserv_cap')
    // console.log(mserv_cap)




 // INITIAL ONLY FOR COA
 var servFacArray =JSON.parse('{!!((count($fAddress) > 0) ? $servfac: "[]")!!}');
//  console.log("servFacArray")
//        console.log(servFacArray)
 if(servFacArray[0]){
    var getHGPID = servFacArray[0];
              var dbhgpid = getHGPID[0].hgpid;

              var getFACID = servFacArray[1];
              var theFACID = getFACID[0].facid;
                      
               setTimeout(function(){ 
                 type_of_fac(dbhgpid) //display facilities

                 getFCID(getFACID)
                 getGoAncillary()

                    setTimeout(function(){ 
                         getFCID(getFACID)
                    }, 1000);
               }, 1000);
 }

                 setTimeout(function(){ 
                         
                         getFacServCharge()
                    }, 1000);

 function getFCID(arr){
    arr.map((h) => {
                            // console.log(h.facid)
                            var getFacidField = document.getElementById(h.facid);
                            if(getFacidField){
                            document.getElementById(h.facid).checked= true
                            }
                            
                     });
 }

 var appid ='{!!((count($fAddress) > 0) ? $fAddress[0]->appid: "")!!}';
 document.getElementById("appid").value = appid;

//  console.log("appid")
//  console.log(appid)
 // INITIAL ONLY FOR COA





    function type_of_fac(selected) {
        // console.log("New func")
        const data = ["servCap", "coaAddon"];
        data.map((h) => {
            document.getElementById(h).setAttribute("hidden", "hidden")
        });
        // initila selection from db
        document.getElementById(selected).checked = true;

        if(selected == 12){
            document.getElementById('iny-hide').setAttribute("hidden", "hidden")
            document.getElementById('asc-hide').setAttribute("hidden", "hidden")
        } else {
            document.getElementById('iny-hide').setAttribute("hidden", "hidden")
            document.getElementById('asc-hide').setAttribute("hidden", "hidden")
        }

        document.getElementById('serv_chg').innerHTML = '<tr><td colspan="2">No Services Selected.</td></tr>';
        
        removeOtherServCont()
        removeOtherServContAdd()
        // selected == '16' ? ifSCL("show") : " ";
        getGoAncillary()
        getCapabilities(selected)
        getChargesPerApplication()

    }

    function getCapabilities(id) {
        getFacServCharge()
        const data = ["servCap", "coaAddon"];
        data.map((h) => {
            document.getElementById(h).removeAttribute("hidden")
        });

        // getChargesPerApplication()

        removeOtherServCont()
        // console.log(id)

        mserv_cap.map((it) => {
            if (it.hgpid == id) {
                var newDiv = document.createElement("div");
                newDiv.setAttribute("class", "custom-control custom-radio mr-sm-2");
                newDiv.setAttribute("id", "otherServe-" + it.facid);
                document.getElementById("otherServCont").appendChild(newDiv);

                var x = document.createElement("INPUT");
                x.setAttribute("id", it.facid);
                // x.setAttribute("onclick", "getFacServCharge()");
                x.setAttribute("onclick", "getGoAncillary()");
                x.setAttribute("type", "radio");
                x.setAttribute("value", it.facid);
                x.setAttribute("name", "facid");
                x.setAttribute("class", "custom-control-input");
                document.getElementById("otherServe-" + it.facid).appendChild(x);

                var label = document.createElement("Label");
                label.setAttribute("for", it.facid);
                label.setAttribute("class", "custom-control-label");
                label.innerHTML = it.facname;

                var newInput = document.getElementById(it.facid)
                insertAfter(newInput, label);

            }
        })
    }

    function removeOtherServCont() {
        var myobj = document.getElementById("otherServCont");
        if (myobj) {
            myobj.remove();
        }

        var newDiv = document.createElement("div");
        newDiv.setAttribute("id", "otherServCont");
        document.getElementById("maincap").appendChild(newDiv);
    }

function removeOtherServContAdd() {
        var myobj = document.getElementById("otherServContAdd");
        if (myobj) {
            myobj.remove();
        }

        var newDiv = document.createElement("div");
        newDiv.setAttribute("id", "otherServContAdd");
        document.getElementById("maincapAdd").appendChild(newDiv);
    }

    function insertAfter(referenceNode, newNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }
   

    function getGoAncillary() {
        getFacServCharge()
				let arrAddon = [];
				$.ajax({
					url: '{{asset('client1/request/customQuery/getAncillary')}}',
					dataType: "json", 
					method: 'POST',
					data: {_token:$("input[name=_token]").val(),id: $('[name=facid]:checked').val(), selected: $('[name=facid]:checked').val(), from: 6},
					success: function(arr){
                        // console.log("arr")
                        // console.log(arr)
						// let Anc = document.getElementById('oAnc'), theuseless = {  };
						// let apString = '<div class="row">'
						// if(arr.length > 0) { 
						
                            // console.log(data)
						// 	// apString += '<div class="row">';
						// 	for(let j = 0; j < data.length; j++) {
						// 		apString += '<div class="col-md-3"><div class="custom-control custom-checkbox mr-sm-2">'+
						// 				        '<input type="checkbox" class="custom-control-input" id="'+data[j]['facid']+'" name="addon" value="'+data[j]['facid']+'">'+
						// 				        '<label class="custom-control-label" for="'+data[j]['facid']+'">'+data[j]['facname']+'</label>'+
						// 				    '</div></div>';
						// 	}
						// }
						// apString += '</div>';
						// Anc.innerHTML = apString;
						// processAddon();

                        removeOtherServContAdd()
        // console.log(id)

                            if(arr.length > 0 ){
                                let data = JSON.parse(arr);
                                 data.map((it) => {
                                // if (it.hgpid == id) {
                                    var newDiv = document.createElement("div");
                                    newDiv.setAttribute("class", "custom-control mr-sm-2");
                                    newDiv.setAttribute("id", "otherServe-" + it.facid);
                                    document.getElementById("otherServContAdd").appendChild(newDiv);

                                    var x = document.createElement("INPUT");
                                    x.setAttribute("id", it.facid);
                                    x.setAttribute("onclick", "getFacServCharge()");
                                    // x.setAttribute("onclick", "getGoAncillary()");
                                    x.setAttribute("type", "checkbox");
                                    x.setAttribute("value", it.facid);
                                    x.setAttribute("name", "facid");
                                    x.setAttribute("class", "custom-control-input");
                                    document.getElementById("otherServe-" + it.facid).appendChild(x);

                                    var label = document.createElement("Label");
                                    label.setAttribute("for", it.facid);
                                    label.setAttribute("class", "custom-control-label");
                                    label.innerHTML = it.facname;

                                    var newInput = document.getElementById(it.facid)
                                    insertAfter(newInput, label);

                                // }
                            })
                        }else{
                            document.getElementById("otherServContAdd").innerHTML = "No add-ons available"
                        }
					}
				});
			}



function getFacServCharge(val = null) {

    getChargesPerApplication() 

    // console.log("rec ff")
    var curAppid = "";
    var mhfser_id = "COA";
    var aptid = document.getElementById("aptidnew").value;
        var facids = getCheckedValue('facid')

        var arrCol = facids;

        let serv_chg = document.getElementById('serv_chg');
        if (arrCol.length > 0) {
            let thisFacid = [],
                    appendToPayment = ['groupThis'],
                    hospitalFaci = ['H', 'H2', 'H3'];
            // let sArr = ['_token=' + document.getElementsByName('_token')[0].value, 'appid=' + curAppid, 'hfser_id=' + mhfser_id];
            let sArr = ['_token=' + document.getElementsByName('_token')[0].value, 'appid=' + curAppid, 'hfser_id=' + mhfser_id, 'aptid=' + aptid];
            if (Array.isArray(arrCol)) {
                    for (let i = 0; i < arrCol.length; i++) {
                            sArr.push('facid[]=' + arrCol[i]);
                            thisFacid.push(arrCol[i]);
                    }
            }
            // console.log("thisFacid")
            // console.log(thisFacid)

            setTimeout(function() {
                    sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/getServiceCharge')}}", "POST", true, {
                            functionProcess: function(arr) {

                            // console.log("arr")
                            // console.log(arr)
                            // tempAppCharge

                            const subclass = $('#subclass').val()  == "" ||  $('#subclass').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->subClassid: "")!!}' : $('#subclass').val();//appchargetemp
                            const owns = $('#ocid').val()  == "" ||  $('#ocid').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->ocid: "")!!}' : $('#ocid').val();//appchargetemp
 
                            // console.log("subclass")//appchargetemp
                            // console.log(subclass)//appchargetemp

                            var ta=[]; //appchargetemp
                                    // const distinctArr = [...new Set(arr.map(x => x.facname))];

                                    // console.log("fees")
                                    // console.log(arr)

                                    const distinctArr = Array.from(new Set(arr.map(s => s.facname))).map(facname => {
                               
                                        return {
                                        facname: facname,
                                        amt: subclass == "ND" ? 0 :  arr.find(s =>
                                        // amt: owns == "G" ? 0 :  arr.find(s =>
                                                s.facname === facname).amt,
                                        chgapp_id: arr.find(s =>
                                                s.facname === facname).chgapp_id
                                        }
                                        })



                                    if (serv_chg != undefined || serv_chg != null) {
                                        if (distinctArr.length > 0) {
                                                // serv_chg.innerHTML = '';
                                                // for (let i = 0; i < distinctArr.length; i++) {

                                                //         serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['facname'] + '</td><td>&#8369;&nbsp;<span>' + (parseInt(distinctArr[i]['amt'])).toFixed(2) + '</span></td></tr>';

                                                // }
                                                serv_chg.innerHTML = '';
                                                for (let i = 0; i < distinctArr.length; i++) {
                                                        ta.push({reference : distinctArr[i]['facname'],amount: distinctArr[i]['amt'], chgapp_id:  distinctArr[i]['chgapp_id'] }) //appcharge
                                                        serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['facname'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas(subclass == "ND" ? 0 : (parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                                                        // serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['facname'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas((parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                                                }
                                        } else {
                                                serv_chg.innerHTML = '<tr><td colspan="2">No Fee for this service.</td></tr>';
                                        }
                                    }
                                    // console.log("tadss")//appchargetemp
                                    // console.log(JSON.stringify(ta))//appchargetemp
                                    document.getElementById('tempAppCharge').value = JSON.stringify(ta)//appchargetemp
                            }
                    });
            }, 1000);

        } else {
            serv_chg.innerHTML = '<tr><td colspan="2">No Payment Necessary.</td></tr>';
        }
}

function getChargesPerApplication() {
        let sArr = ['_token=' + document.getElementsByName('_token')[0].value, 'appid=' + curAppid, 'aptid=' + document.getElementById("aptidnew").value],
        // let sArr = ['_token=' + document.getElementsByName('_token')[0].value, 'appid=' + curAppid, 'aptid=' + aptid, 'hfser_id=' + mhfser_id],
            ghgpid = document.getElementsByName('hgpid');

            // console.log(ghgpid)
        if (ghgpid != null || ghgpid != undefined) {
            for (let i = 0; i < ghgpid.length; i++) {
                if (ghgpid[i].checked) {
                    sArr.push('hgpid[]=' + ghgpid[i].value);
                }
            }
        }
        sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/getChargesPerApplication')}}", "POST", true, {
            functionProcess: function(arr) {

                // console.log("arrC")
                    //    console.log(arr)
                        // tempAppCharge

                        const subclass = $('#subclass').val()  == "" ||  $('#subclass').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->subClassid: "")!!}' : $('#subclass').val();//appchargetemp
                        // console.log("subclass")//appchargetemp
                        // console.log(subclass)//appchargetemp

                        var ta=[]; //appchargetemp

                         //appchargetemp
                         const distinctArr = Array.from(new Set(arr.map(s => s.chg_desc))).map(chg_desc => {
                               
                               return {
                                chg_desc: chg_desc,
                               amt: subclass == "ND" ? 0 :  arr.find(s =>
                                       s.chg_desc === chg_desc).amt,
                               chgapp_id: arr.find(s =>
                                       s.chg_desc === chg_desc).chgapp_id
                       }
                       })

                
                let not_serv_chg = document.getElementById('not_serv_chg');
                if (not_serv_chg != undefined || not_serv_chg != null) {
                    if (distinctArr.length > 0) {
                        // not_serv_chg.innerHTML = '';
                        // for (let i = 0; i < distinctArr.length; i++) {
                        //     not_serv_chg.innerHTML += '<tr><td>' + arr[i]['chg_desc'] + '</td><td>&#8369;&nbsp;<span>' + (parseInt(arr[i]['amt'])).toFixed(2) + '</span></td></tr>';
                        // }

                        not_serv_chg.innerHTML = '';
                        for (let i = 0; i < distinctArr.length; i++) {
                            ta.push({reference : distinctArr[i]['chg_desc'],amount: distinctArr[i]['amt'], chgapp_id:  distinctArr[i]['chgapp_id'] }) //appcharge
                            not_serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['chg_desc'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas(subclass == "ND" ? 0 : (parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                          
                            // not_serv_chg.innerHTML += '<tr><td>' + arr[i]['chg_desc'] + '</td><td>&#8369;&nbsp;<span>' + (parseInt(arr[i]['amt'])).toFixed(2) + '</span></td></tr>';
                        }

                    } else {
                        not_serv_chg.innerHTML = '<tr><td colspan="2">Chosen facility has no Registration fee Required.</td></tr>';
                    }
                    // console.log("tadssC")//appchargetemp
                    // console.log(JSON.stringify(ta))//appchargetemp
                    document.getElementById('tempAppChargeHgpid').value = JSON.stringify(ta)//appchargetemp
                }
            }
        });

    

    }
    function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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

    
    

</script>