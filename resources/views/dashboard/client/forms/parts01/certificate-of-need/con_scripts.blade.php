<script>
var ghgpid = document.getElementsByName('hgpid')
var curAppid = ""
var mhfser_id = "CON"
var aptid = document.getElementById("aptidnew").value
console.log(aptid)
// var aptid = "IN"

window.addEventListener('change', function(e) {
        if(e.target.name == 'ocid'){
            setTimeout(function(){  
                   
                    getFacServCharge()
            }, 1000);
        }
    });
    
window.addEventListener('click', function(e) {
        initialCheck()
    });
initialCheck()
function initialCheck(){
        if(document.querySelector('input[name="facid"]:checked') === null){
            // if(document.getElementsByName("facid")[0].checked != true){
                var first = document.getElementsByName("facid")[0];
                first.checked = true;
                first.click();     
         }
      
}

var mserv_cap = JSON.parse('{!!addslashes($serv_cap)!!}')


// console.log(mserv_cap)
if('{!!isset($fAddress)&&(count($fAddress) > 0)!!}'){
console.log("typee")
console.log('{!! $apptypenew !!}')




    var servFacArray =JSON.parse('{!!((count($fAddress) > 0) ? $servfac: "")!!}');
    console.log("servFacArray")
    console.log(servFacArray)

    var appid ='{!!((count($fAddress) > 0) ? $fAddress[0]->appid: "")!!}';
    var cap_inv ='{!!((count($fAddress) > 0) ? $fAddress[0]->cap_inv: "")!!}';
    var lot_area ='{!!((count($fAddress) > 0) ? $fAddress[0]->lot_area: "")!!}';
    var noofbed ='{!!((count($fAddress) > 0) ? $fAddress[0]->noofbed: "")!!}';

 
//     console.log("condet")
//     console.log(condet)
//     console.log("exHosp")
//     console.log(exHosp)
  
     var apptypenew = '{!! $apptypenew !!}';

     if(apptypenew == "renewal"){

        document.getElementById("aptidnew").value = 'R';
        document.getElementById("appid").value = null;
        console.log(document.getElementById("renewal"))
        // document.getElementById("renewal").removeAttribute("hidden");
      

}else{
document.getElementById("appid").value = appid;
}

    
     document.getElementById("cap_inv").value = cap_inv;
     document.getElementById("lot_area").value = lot_area;
     document.getElementById("noofbed").value = noofbed;

     if(servFacArray[0].length > 0){
              var getHGPID = servFacArray[0];
              var dbhgpid = getHGPID[0].hgpid;

              var getFACID = servFacArray[1];
              var theFACID = getFACID[0].facid;
                     
               setTimeout(function(){ 
              

               
                     getFACID.map((h) => {

                            // console.log(h.facid)
                            var getFacidField = document.getElementById("facid_"+h.facid);
                            if(getFacidField){
                            document.getElementById("facid_"+h.facid).checked= true
                            }
                            
                     });
                
               }, 1000);

               setTimeout(function(){ 
                        getFacServCharge()
                        calculatepop()
                }, 1000);
       }





        // function getCheckedValue(groupName) {
        //         var radios;
        //         if (groupName == "anxsel") {
        //                 radios = document.getElementsByClassName(groupName);
        //         } else {
        //                 radios = document.getElementsByName(groupName);
        //         }


        //         var rad = []
        //         for (i = 0; i < radios.length; i++) {
        //                 if (radios[i].checked) {
        //                 rad.push(radios[i].value);

        //                 }
        //         }
        //         return rad;
        // }
        

      
   
    initialProPo()
    listHosps()

 
 
function initialProPo(){
        var condet =JSON.parse('{!!((count($condet[0]) > 0) ? $condet[0]: "")!!}');
        if(condet.length > 0 ){
            for(var i = 0; i < condet.length ; i++){
                // console.log(i)
                var newTr = document.createElement("tr");
                newTr.setAttribute("id", "rowEntry" + i);
                document.getElementById("projected_populations").appendChild(newTr);

                var list = document.getElementById("projected_populations");
                list.insertBefore(newTr, list.childNodes[0]);

                var newTd1 = document.createElement("td");
                newTd1.setAttribute("id", "colEntryA-" + i);
                document.getElementById("rowEntry" + i).appendChild(newTd1);

                var xbtn = document.createElement("button");
                xbtn.setAttribute("id", "btnx"+i);
                xbtn.setAttribute("class", "btn btn-danger btn-xs");
                xbtn.setAttribute("onclick", "removeProjectedPopulationRow("+i+")");
                document.getElementById("colEntryA-" + i).appendChild(xbtn);

                var xbtnicon = document.createElement("i");
                xbtnicon.setAttribute("class", "fa fa-times");
                document.getElementById("btnx"+i).appendChild(xbtnicon);

// ---
                var newTd2 = document.createElement("td");
                newTd2.setAttribute("id", "colEntryB-" + i);
                document.getElementById("rowEntry" + i).appendChild(newTd2);

                document.getElementById("colEntryB-" + i).innerHTML =condet[i].type == 0 ? "PRIMARY" : "SECONDARY";

                var inpt2hh = document.createElement("input");
                inpt2hh.setAttribute("type", "hidden");
                inpt2hh.setAttribute("name", "type[]");
                inpt2hh.value = condet[i].type ;
                document.getElementById("colEntryB-" + i).appendChild(inpt2hh);
// ---
                var newTd3 = document.createElement("td");
                newTd3.setAttribute("id", "colEntryC-" + i);
                document.getElementById("rowEntry" + i).appendChild(newTd3);

                var inpt2 = document.createElement("input");
                inpt2.setAttribute("type", "text");
                inpt2.setAttribute("class", "form-control locs");
                inpt2.setAttribute("name", "location[]");
                inpt2.value = condet[i].location ;
                document.getElementById("colEntryC-" + i).appendChild(inpt2);

                // document.getElementById("colEntryC-" + i).innerHTML ="Mee";

// ---
                var newTd4 = document.createElement("td");
                newTd4.setAttribute("id", "colEntryD-" + i);
                document.getElementById("rowEntry" + i).appendChild(newTd4);

                // document.getElementById("colEntryD-" + i).innerHTML ="Doooo";

                var inpt3 = document.createElement("input");
                inpt3.setAttribute("type", "number");
                inpt3.setAttribute("class", "form-control pops");
                inpt3.setAttribute("name", "population[]");
                inpt3.setAttribute("data-id", i);
                inpt3.setAttribute("onkeyup", "calculatepop()");
                // inpt3.setAttribute("onkeyup", "calculateProjectedPopulationCost(this)");
                inpt3.setAttribute("onload", "calculateProjectedPopulationCost(this)");
                inpt3.value = condet[i].population ;
                document.getElementById("colEntryD-" + i).appendChild(inpt3);

               

            }
        }

        setTimeout(function(){ 
                       
                        calculatepop()
                }, 1000);

    }

    function listHosps(){
        var exHosp =JSON.parse('{!!((count($condet[1]) > 0) ? $condet[1]: "")!!}');
        if(exHosp.length > 0 ){
                for(var i = 0; i < exHosp.length ; i++){
                        var newTr = document.createElement("tr");
                        newTr.setAttribute("id", "rowEntryHospital" + i);
                        newTr.setAttribute("class", "itemRow ");
                        document.getElementById("existing_hospitals").appendChild(newTr);

                        var newTd1 = document.createElement("td");
                        newTd1.setAttribute("id", "colEntryHA-" + i);
                       
                        document.getElementById("rowEntryHospital" + i).appendChild(newTd1);

                        var xbtn = document.createElement("button");
                        xbtn.setAttribute("id", "btnxh"+i);
                        xbtn.setAttribute("class", "btn btn-danger btn-xs");
                        xbtn.setAttribute("onclick", "removeExistingHospitalRow("+i+")");
                        document.getElementById("colEntryHA-" + i).appendChild(xbtn);

                        var xbtnicon = document.createElement("i");
                        xbtnicon.setAttribute("class", "fa fa-times");
                        document.getElementById("btnxh"+i).appendChild(xbtnicon);


                        for(var c = 0; c < 8 ; c++){
                                var newTd9 = document.createElement("td");
                                newTd9.setAttribute("id", "colEntryH"+c +"-" + i);
                                document.getElementById("rowEntryHospital" + i).appendChild(newTd9);


                                if(c == 0 || c == 1 || c == 2 || c == 4 || c == 5 || c == 6){
                                        var inpt2 = document.createElement("input");

                                        if(c == 0 || c == 1 || c == 2 || c == 4){
                                                inpt2.setAttribute("type", "text");
                                        }else{
                                                inpt2.setAttribute("type", "date");
                                        }
                                }else if(c == 3){
                                        var inpt2 = document.createElement("select");
                                        inpt2.setAttribute("id", "selcOpt"+ i);
                                }else if(c == 7){
                                        var inpt2 = document.createElement("textarea");
                                        inpt2.setAttribute("cols", 4);
                                }

                                var names = ["facilitynames[]", "locations[]", "bedcapacities[]", "cat_hos[]", "license[]", "validity[]", "date_operation[]", "remarks[]"];
                                 for(var n = 0 ; n < names.length; n++){
                                         if(n == c){
                                         inpt2.setAttribute("name", names[n]);
                                        }
                                 }
                                 var clas = ' ';
                                 if(c == 0){ inpt2.value = exHosp[i].facilityname ; clas = 'exfacn'
                                        inpt2.setAttribute("style", "width: 200px !important;");
                                }
                                 if(c == 1){ inpt2.value = exHosp[i].location1 ;clas = 'exloc'
                                        inpt2.setAttribute("style", "width: 250px !important;");
                                }
                                 if(c == 2){ inpt2.value = exHosp[i].noofbed1 ;clas = 'exbedcap'
                                        inpt2.setAttribute("style", "width: 100px !important;");
                                }
                                
                                 if(c == 4){ inpt2.value = exHosp[i].license ;clas = 'exlic'
                                        inpt2.setAttribute("style", "width: 150px !important;");
                                }
                                 if(c == 5){ inpt2.value = exHosp[i].validity ;clas = 'exval'
                                
                                }
                                 if(c == 6){ inpt2.value = exHosp[i].date_operation ;clas = 'exdatop'
                                
                                }
                                 if(c == 7){ inpt2.value = exHosp[i].remarks ;clas = 'exrem'
                                        inpt2.setAttribute("style", "width: 100px !important;");
                                }
                                //  var vals = ["facilityname", "location1", "noofbed1", "cat_hos", "license", "validity", "date_operation"]
                                //  for(var v = 0 ; v < vals.length; v++){
                                //         inpt2.value = condet[i].vals[v] ;
                                //  }
                               
                                

                                inpt2.setAttribute("class", "form-control ");
                                document.getElementById("colEntryH"+c +"-" + i).appendChild(inpt2);

                               
                        }

                       

                }

                var facidopt = [" ","H", "H2", "H3"];
                      for(var i = 0; i < exHosp.length ; i++){
                                
                                        facidopt.map((h) => {
                                                var opt = document.createElement("option");
                                                opt.value = h;
                                                opt.textContent = h == "H"? "Level 1 Hospital" : h == "H2"? "Level 2 Hospital" : h == "H3"? "Level 3 Hospital" : "Please select" ;
                                                document.getElementById("selcOpt"+ i).appendChild(opt);
                                        });

                                        for(var c = 0; c < 8 ; c++){
                                                if(c == 3){ 
                                                       var inpt2 = document.getElementById("selcOpt"+ i)
                                                        inpt2.value = exHosp[i].cat_hos ;
                                                }
                                        }
                        }
        }
    }


}

function getCheckedValue(groupName) {
                var radios;
                if (groupName == "anxsel") {
                        radios = document.getElementsByClassName(groupName);
                } else {
                        radios = document.getElementsByName(groupName);
                }


                var rad = []
                for (i = 0; i < radios.length; i++) {
                        if (radios[i].checked) {
                        rad.push(radios[i].value);

                        }
                }
                return rad;
        }

function getFacServCharge(val = null) {

var facids = getCheckedValue('facid')
// console.log("facids")
// console.log(facids)
var arrCol = facids;

let serv_chg = document.getElementById('serv_chg');
if (arrCol.length > 0) {
        let thisFacid = [],
                appendToPayment = ['groupThis'],
                hospitalFaci = ['H', 'H2', 'H3'];
        let sArr = ['_token=' + document.getElementsByName('_token')[0].value, 'appid=' + curAppid, 'hfser_id=' + mhfser_id, 'aptid=' + document.getElementById("aptidnew").value];
        console.log("sArr")
        console.log(sArr)
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

                        //appchargetemp
                                const distinctArr = Array.from(new Set(arr.map(s => s.facname))).map(facname => {
                               
                                        return {
                                        facname: facname,
                                        // amt: owns == "G" ? 0 :  arr.find(s =>
                                        // amt: subclass == "ND" ? 0 :  arr.find(s =>
                                        //         s.facname === facname).amt,
                                         amt: arr.find(s =>
                                                s.facname === facname).amt,
                                        chgapp_id: arr.find(s =>
                                                s.facname === facname).chgapp_id
                                }
                                })

                                
                                if (serv_chg != undefined || serv_chg != null) {
                                        if (distinctArr.length > 0) {
                                                serv_chg.innerHTML = '';
                                                for (let i = 0; i < distinctArr.length; i++) {
                                                        ta.push({reference : distinctArr[i]['facname'],amount: distinctArr[i]['amt'], chgapp_id:  distinctArr[i]['chgapp_id'] }) //appcharge
                                                        serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['facname'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas( (parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                                                        // serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['facname'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas(subclass == "ND" ? 0 : (parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                                                        // serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['facname'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas((parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                                                }

                                        } else {
                                                serv_chg.innerHTML = '<tr><td colspan="2">No Services selected.</td></tr>';
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

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function calculatepop(){
        const population    = $("input[name='population[]'");
        var calc= 0;
        for(let i  = 0; i < population.length; i++ ) {
               
                if(population[i].value){
                        calc += parseInt(population[i].value); 
                }
                
        }
        // console.log("calcs")
        // console.log(calc)

        document.getElementById("projectedPopulationCostN").innerHTML = calc.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")

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