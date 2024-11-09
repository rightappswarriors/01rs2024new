<script>
   
  
    
    
    var ghgpid = document.getElementsByName('hgpid')
    var curAppid = ""
    var mhfser_id = "PTC"
    var aptid =  document.getElementById("aptidnew").value
    // var aptid = "IN"

    var mservfac = JSON.parse('{!!addslashes($serv_cap)!!}')
   
    console.log('1111')
   

    createDefaultsNew()


    window.addEventListener('click', function(e) {
        initialCheck()
    });
    initialCheck()
    function initialCheck(){
            if(document.querySelector('input[name="facid"]:checked') === null){
                // if(document.getElementsByName("facid")[0].checked != true){
                    var first = document.getElementsByName("facid")[0];
                if(first){
                    first.checked = true;
                    first.click();     
                    console.log("Recs")
                    }
            }
        
    }
    

    function createDefaultsNew(){
        if('{!!isset($fAddress)&&(count($fAddress) > 0)!!}'){
            inputtedDataInitial()
        }else{
            newFormdefaultRadio()
        }
       
    }
    function inputtedDataInitial(){
        var apptypenew = '{!! $apptypenew !!}';

        if(apptypenew == "renewal"){
        
        document.getElementById("aptidnew").value = 'R';
        document.getElementById("appid").value = null;
        }else{
        document.getElementById("appid").value = appid;
        }

        console.log("typeehhhh")
        console.log('{!! $apptypenew !!}')

        // console.log("data from db")

        // var ptcorg =JSON.parse('!!((count(ptc) > 0) ? ptc : "")!!');
        var ptcorg = JSON.parse('{!!((count($fAddress) > 0) ? addslashes($ptc): "")!!}');
      var  ptc = ptcorg[0]
        // console.log("ptc")
        console.log(ptc);
     
       

        var servFacArray =JSON.parse('{!!((count($fAddress) > 0) ? $servfac: "[]")!!}');
    

        console.log("servFacArray")
        console.log(servFacArray)

        if(servFacArray[0].length > 0){
              var getHGPID = servFacArray[0];
              var dbhgpid = getHGPID[0].hgpid;

              var getFACID = servFacArray[1];
              

            //   console.log("getHGPID")
            //   console.log(getHGPID)
            console.log("dbhgpid")
            console.log(dbhgpid)
            setTimeout(function(){ 
                typeofFacs(dbhgpid)
            }, 1000);

        
                setTimeout(function(){ 

                    for (let i = 0; i < getFACID.length; i++) {
                    theFACID = getFACID[i].facid;
                    var gefc = document.getElementById(theFACID);
                    
                    if(gefc){
                        document.getElementById(theFACID).checked = true
                    }
                }

                }, 1000);
            


          
        
            }

        setTimeout(function(){ 
            getFacServCharge()
        }, 1000);
       

        if(ptcorg.length > 0){
            document.getElementById("construction_description").value = ptc.construction_description;
            document.getElementById("propbedcap").value = ptc.propbedcap;
            document.getElementById("propbedcapview").innerText  = ptc.propbedcap;
            document.getElementById("singlebed").value = ptc.singlebed;
            document.getElementById("singlebedview").innerText  = ptc.singlebed;
            document.getElementById("doubledeck").value = ptc.doubledeck;
            document.getElementById("doubledeckview").innerText  = ptc.doubledeck;
            document.getElementById("renoOption").value = ptc.renoOption;
            document.getElementById("incbedcapfrom").value = ptc.incbedcapfrom;
            document.getElementById("incbedcapto").value = ptc.incbedcapto;
            document.getElementById("ltonum").value = ptc.ltoCode;
            document.getElementById("connum").value = ptc.conCode;
            document.getElementById("incstationfrom").value = ptc.incstationfrom;
            document.getElementById("incstationto").value = ptc.incstationto;
            document.getElementById("noofdialysis").value = '{!!((count($fAddress) > 0) ? $fAddress[0]->noofdialysis: "")!!}';
        }
        
        getPTCtype(ptc.type)

       
    }

    function newFormdefaultRadio(){

        document.getElementsByName("type")[0].checked = true
        document.getElementsByName("hgpid")[0].checked = true
      
        var ttype = document.getElementsByName("type")[0];

        var hgpidSel = document.getElementsByName("hgpid")[0];
        typeofFacs(hgpidSel.id)

        setTimeout(function(){ 
            document.getElementsByName("facid")[0].checked = true
            getPTCtype(ttype.value)
        }, 1000);

       

        setTimeout(function(){ 
            getFacServCharge()
        }, 2000);

     
    }

    function getServCap(selected) {
        var result = mservfac.filter(function(v) {
            return v.hgpid == selected && v.hfser_id != 'LTO';
        })

        removeOtherServCap()
        getServicesCap(result, selected)

       
    }

    function typeofFacs(selected){
        document.getElementById(selected).checked = true

        if(selected == 5){
            document.getElementById("noDal").removeAttribute("hidden")
        }else{
            document.getElementById("noDal").setAttribute("hidden", "hidden")
            document.getElementById("noofdialysis").value = null;
        }

        if(selected == 6 || selected == 17 || selected == 18){
            document.getElementById("NPtc").removeAttribute("hidden")
        }else{
            document.getElementById("NPtc").setAttribute("hidden", "hidden")
            document.getElementById("propbedcap").value = null;
        }


        if(selected == 9){
            document.getElementById("NSB").removeAttribute("hidden")
            document.getElementById("NDD").removeAttribute("hidden")
        }else{
            document.getElementById("NSB").setAttribute("hidden", "hidden")
            document.getElementById("singlebed").value = null;
            document.getElementById("NDD").setAttribute("hidden", "hidden")
            document.getElementById("doubledeck").value = null;
        }

        document.getElementById('serv_chg').innerHTML = ' ';


    
      
        getServCap(selected)
        getChargesPerApplication()
        getOptions(selected)

        setTimeout(function(){ 
            if(document.querySelector('input[name="facid"]:checked') === null){
            // if(document.getElementsByName("facid")[0].checked != true){
                document.getElementsByName("facid")[0].checked = true
           
            }
          
        }, 500);

        setTimeout(function(){ 
            getFacServCharge();
        }, 1000);


    }

    function removeOtherServCap() {
        var myobj = document.getElementById("ServCapCont");
        if (myobj) {
            myobj.remove();
        }        

        var newDiv = document.createElement("div");
        newDiv.setAttribute("id", "ServCapCont");
        document.getElementById("mainServCap").appendChild(newDiv);
    }

    function getServicesCap(data, selected) {

        data.map((it) => {
            if(it.facid != 'ASC' && it.facid != 'H-S-TPO' && it.facid != 'H-S-TPS' && it.facid != 'H-S-TPSP' && it.facid != 'BH-REGIS'  && it.facid != 'INY-REGIS'){
            
               var newDiv = document.createElement("div");
               newDiv.setAttribute("class", "custom-control custom-radio mr-sm-2");
               newDiv.setAttribute("id", "otherServe-" + it.facid);
               document.getElementById("ServCapCont").appendChild(newDiv);

                    var x = document.createElement("INPUT");
                    x.setAttribute("id", it.facid);
                    x.setAttribute("onclick", "getFacServCharge()");

                    if(selected == 1){
                            x.setAttribute("type", "checkbox");
                    }
                    else{
                            x.setAttribute("type", "radio");
                    }
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

   function insertAfter(referenceNode, newNode) {
        referenceNode.parentNode.insertBefore(newNode, referenceNode.nextSibling);
    }

    function getChargesPerApplication() {
        let sArr = ['_token=' + document.getElementsByName('_token')[0].value, 'appid=' + curAppid, 'aptid=' +  document.getElementById("aptidnew").value],
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
                //         console.log(arr)
                        // tempAppCharge

                        const subclass = $('#subclass').val()  == "" ||  $('#subclass').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->subClassid: "")!!}' : $('#subclass').val();//appchargetemp
                        // console.log("subclass")//appchargetemp
                        // console.log(subclass)//appchargetemp
console.log("arr app")
console.log(arr)
                        var ta=[]; //appchargetemp

                        //appchargetemp
                        const distinctArr = Array.from(new Set(arr.map(s => s.chg_desc))).map(chg_desc => {
                               
                               return {
                                chg_desc: chg_desc,
                               amt: arr.find(s =>
                                       s.chg_desc === chg_desc).amt, 
                            //  amt: subclass == "ND" ? 0 :  arr.find(s =>
                            //            s.chg_desc === chg_desc).amt,
                               chgapp_id: arr.find(s =>
                                       s.chg_desc === chg_desc).chgapp_id
                       }
                       })
                
                let not_serv_chg = document.getElementById('not_serv_chg');
                if (not_serv_chg != undefined || not_serv_chg != null) {

                    if (distinctArr.length > 0) {
                        not_serv_chg.innerHTML = '';
                        for (let i = 0; i < distinctArr.length; i++) {
                            
                            ta.push({reference : distinctArr[i]['chg_desc'],amount: distinctArr[i]['amt'], chgapp_id:  distinctArr[i]['chgapp_id'] }) //appcharge
                            not_serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['chg_desc'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas( (parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                            // not_serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['chg_desc'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas(subclass == "ND" ? 0 : (parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                            // not_serv_chg.innerHTML += '<tr><td>' + distinctArr[i]['chg_desc'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas((parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                        }
                    } else {
                        not_serv_chg.innerHTML = '<tr><td colspan="2">Chosen facility has no Registration fee Required.</td></tr>';
                    } 
                    
                    // if (arr.length > 0) {
                    //     not_serv_chg.innerHTML = '';
                    //     for (let i = 0; i < arr.length; i++) {
                    //         not_serv_chg.innerHTML += '<tr><td>' + arr[i]['chg_desc'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas((parseInt(arr[i]['amt'])).toFixed(2)) + '</span></td></tr>';
                    //     }
                    // } else {
                    //     not_serv_chg.innerHTML = '<tr><td colspan="2">Chosen facility has no Registration fee Required.</td></tr>';
                    // }

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

    function getPTCtype(selected){
        // console.log("receive type " + selected)

        document.getElementById(selected == 0 ? "type0" : "type1").checked = true

        // if(selected == 0){
        //     document.getElementById("NPtc").removeAttribute("hidden")
        // }else{
        //     document.getElementById("NPtc").setAttribute("hidden", "hidden")
        //     document.getElementById("propbedcap").value = null;
        // }

        if(selected == 1){
            document.getElementById("RPtc").removeAttribute("hidden")
        }else{
            document.getElementById("RPtc").setAttribute("hidden", "hidden")
            document.getElementById("renoOption").value = null;
            document.getElementById("incbedcapfrom").value = null;
            document.getElementById("incbedcapto").value = null;
            document.getElementById("incstationfrom").value = null;
            document.getElementById("incstationto").value = null;
            document.getElementById("ltonum").value = null;

            var chcoa =  document.getElementById("coanum");
            if(chcoa){
            document.getElementById("coanum").value = null;
            }
        }
    }

 function getOptions(selected){
            // console.log("hgpid")
            // console.log($('input[name="hgpid"]:checked').val())

           if(selected != 5){
                 document.getElementById("othersReqrenew").removeAttribute("hidden")
           }else{
                 document.getElementById("othersReqrenew").setAttribute("hidden", "hidden")
                 document.getElementById("renoOption").value = null;
                 document.getElementById("incbedcapfrom").value = null;
                 document.getElementById("incbedcapto").value = null;
           }

           if(selected == 5){
            document.getElementById("dialysisReqrenew").removeAttribute("hidden")
                
           }else{
            document.getElementById("dialysisReqrenew").setAttribute("hidden", "hidden")
            document.getElementById("incstationfrom").value = null;
            document.getElementById("incstationto").value = null;
           }            
 }

    function getCheckedValue( groupName ) {
        var radios;
        if(groupName == "anxsel"){
             radios = document.getElementsByClassName( groupName );
        }else{
             radios = document.getElementsByName( groupName );
        }
        

        var rad = []
        for( i = 0; i < radios.length; i++ ) {
            if( radios[i].checked ) {
                rad.push(radios[i].value);
                
            }
        }
        return rad;
    }

    function getFacServCharge(val = null) {
        
        getChargesPerApplication()
   
        var facids = getCheckedValue('facid')
      
        let serv_chg = document.getElementById('serv_chg');

        var ascType = document.getElementById("1");


        if( ascType.checked) 
        {
            facids.push('ASC'); 
        }

        var arrCol = facids;


        if (arrCol.length > 0) {

            let thisFacid = [],
                appendToPayment = ['groupThis'],
                hospitalFaci = ['H', 'H2', 'H3'];
            let sArr = ['_token=' + document.getElementsByName('_token')[0].value, 'appid=' + curAppid, 'hfser_id=' + mhfser_id, 'aptid=' +  document.getElementById("aptidnew").value];
            
            if (Array.isArray(arrCol)) {
                    for (let i = 0; i < arrCol.length; i++) {
                            sArr.push('facid[]=' + arrCol[i]);
                            thisFacid.push(arrCol[i]);
                    }
            }
            console.log("sArr")
            console.log(sArr)


            setTimeout(function() {
                    sendRequestRetArr(sArr, "{{asset('client1/request/customQuery/getServiceCharge')}}", "POST", true, {
                        functionProcess: function(arr) {

                            // const distinctArr = [...new Set(arr.map(x => x.facname))];
                            // console.log("fees")
                            // console.log(arr)

                            const subclass = $('#subclass').val()  == "" ||  $('#subclass').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->subClassid: "")!!}' : $('#subclass').val();//appchargetemp
                            const owns = $('#ocid').val()  == "" ||  $('#ocid').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->ocid: "")!!}' : $('#ocid').val();//appchargetemp

                            // console.log("subclass")//appchargetemp
                            // console.log(subclass)//appchargetemp

                            var ta=[]; //appchargetemp

                            console.log("arr")
                            console.log(arr)

                            const distinctArr = Array.from(new Set(arr.map(s => s.facname))).map(facname => {
                        
                                return {
                                    facname: facname,
                                    amt: arr.find(s =>
                                    // amt: subclass == "ND" ? 0 :  arr.find(s =>
                                    // amt: owns == "G" ? 0 :  arr.find(s =>
                                        s.facname === facname).amt,
                                    chgapp_id: arr.find(s =>
                                        s.facname === facname).chgapp_id
                                }
                            })

                            if (serv_chg != undefined || serv_chg != null) {

                                if (distinctArr.length > 0) {
                                    serv_chg.innerHTML = '';
                                    console.log('hgpid asc')
                                    console.log(document.getElementsByName("hgpid")[0].checked);

                                     
                                    for (let i = 0; i < distinctArr.length; i++) {
                                        ta.push({reference : distinctArr[i]['facname'],amount: distinctArr[i]['amt'], chgapp_id:  distinctArr[i]['chgapp_id'] }) //appcharge
                                        serv_chg.innerHTML += '<tr><td>'+ distinctArr[i]['facname'] + '</td><td>&#8369;&nbsp;<span>' + numberWithCommas((parseInt(distinctArr[i]['amt'])).toFixed(2)) + '</span></td></tr>';

                                   
                                    }   
                                        
                                    
                                                             
                                } else {
                                        serv_chg.innerHTML = '<tr><td colspan="2">No Services selected.</td></tr>';
                                }
                            }
               
                            document.getElementById('tempAppCharge').value = JSON.stringify(ta)//appchargetemp
                        }
                    });
            }, 1000);

        } else {
            serv_chg.innerHTML = '<tr><td colspan="2">No Payment Necessary.</td></tr>';
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

window.addEventListener('change', function(e) {
        

        if(e.target.name == 'ocid'){
            setTimeout(function(){  
                   
                    getFacServCharge()
            }, 1000);
        }
    });


@if(app('request')->input('cont') == 'yes')
  

 document.getElementById("type0").checked = true

 document.getElementById("6").checked = true
//  document.getElementById("propbedcap").disabled = true
 document.getElementById("propbedcap").setAttribute('hidden', 'hidden')
 document.getElementById("propbedcapview").removeAttribute('hidden')


//   setTimeout(function(){ 
//   inputtedDataInitial()
//    }, 1000);
  var hg = document.getElementsByName('hgpid');
  var fc = document.getElementsByName('facid');

  for(var h = 0 ; h< hg.length; h++){
    hg[h].disabled = true;
  }
  
   setTimeout(function(){
  for(var f = 0 ; f< fc.length; f++){
    fc[f].disabled = true;
  }
   }, 1000);
@endif


jQuery(document).ready(function(){


    jQuery('.hfaci_service_type').click(function(){

        selected = jQuery(this).val();

        if(selected == 6){
            jQuery('.con-number').css('display', 'block');
        } else {
            jQuery('.con-number').css('display', 'none');
        }

        typeofFacs(selected);
    });

    


});
   

</script>