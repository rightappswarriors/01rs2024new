<script>
    function getAllInputs() {

        [...document.forms["ltoForm"].getElementsByTagName("input")].map(input => {
            console.log(input.name)
            console.log(input.value)
        })
    }

    const savePartialLto = async (e) => {

        var errors = 0;
        var ermsg = " ";
        var errorPar = 0;
        var ermsgP = " ";

        var invalids = 0;
        var invmssg = " ";

        if($('#facility_name').val() == ""){errorPar +=1;  errors +=1; ermsgP+= "\nFacility Name, "; ermsg += "\nFacility Name, "}

        // Disregard if update
        @if(count($fAddress) > 0) 
            if($('#region').val() == "Please select"){errorPar +=1; errors +=1; ermsgP += "Region, "; ermsg += "Region, "}
            if($('#province').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "Province, "; ermsg += "Province, "}
            if($('#city_monicipality').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "Municipality, "; ermsg += "Municipality, "}
            if($('#brgy').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "Baranggay, "; ermsg += "Baranggay, "}
        @else
            if($('#region').val() == ""){errorPar +=1; errors +=1; ermsgP += "Region, "; ermsg += "Region, "}
            if($('#province').val() == ""){errorPar +=1; errors +=1; ermsgP+= "Province, "; ermsg += "Province, "}
            if($('#city_monicipality').val() == ""){errorPar +=1; errors +=1; ermsgP+= "Municipality, "; ermsg += "Municipality, "}
            if($('#brgy').val() == ""){errorPar +=1; errors +=1; ermsgP+= "Baranggay, "; ermsg += "Baranggay, "}
        @endif
        // Disregard if update

        // if($('#street_name').val() == ""){errors +=1; ermsg += "Street Name, "}
        if($('#zip').val() == ""){errors +=1; ermsg += "\nZip Code, "}

        if($('#fac_mobile_number').val() == ""){errors +=1; ermsg += "\nFacility Mobile No., "}
        // if($('#areacode').val() == ""){errors +=1; ermsg += "Facility Landline Area code, "}
        // if($('#landline').val() == ""){errors +=1; ermsg += "Facility Landline, "}
        // if($('#faxareacode').val() == ""){errors +=1; ermsg += "Fax Area code, "}
        // if($('#faxNumber').val() == ""){errors +=1; ermsg += "Fax Number, "}
        if($('#fac_email_address').val() == ""){errors +=1; ermsg += "\nFacility Email, " }

        if($('#fac_email_address').val() != ""){
            var check = checkEmailValidity($('#fac_email_address').val()) 
           if(check == false){
             invalids +=1;   invmssg += "\nInvalid Facility Email Address, "
           } 
        }
        if($('#prop_email').val() != ""){
            var check = checkEmailValidity($('#prop_email').val()) 
           if(check == false){
             invalids +=1;   invmssg += "\nInvalid Proponent Email Address, "
           } 
        }
        
        if($('#fac_mobile_number').val() != ""){
            var check = checkNumberlValidity($('#fac_mobile_number').val()) 
           if(check == false){
             invalids +=1;   invmssg += "\nInvalid Facility Mobile Number, "
           } 
        }

        if($('#prop_mobile').val() != ""){
            var check = checkNumberlValidity($('#prop_mobile').val()) 
           if(check == false){
             invalids +=1;   invmssg += "\nInvalid Proponent Mobile Number, "
           } 
        }

        if($('#ocid').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "\nOwnership, "; ermsg += "\nOwnership, "}

        // Disregard if update
        if($('#classification').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "\nClassification, "; ermsg += "\nClassification, "}
        // if($('#subclass').val() == "Please select"){errorPar +=1; errors +=1; ermsgP+= "\nSub Classification, "; ermsg += "\nSub Classification, "}
        // Disregard if update

        if($('#facmode').val() == "Please select"){errors +=1; ermsg += "\nInstitutional Character, "}
        if($('#funcid').val() == "Please select"){errors +=1; ermsg += "\nFunction, "}
      
        if($('#owner').val() == ""){errors +=1; ermsg += "\nOwner, "}
        if($('#prop_mobile').val() == ""){errors +=1; ermsg += "\nProponent Mobile, "}
        // if($('#prop_landline_areacode').val() == ""){errors +=1; ermsg += "Proponent Landline Areacode, "}
        // if($('#prop_landline').val() == ""){errors +=1; ermsg += "Proponent Landline, "}
        if($('#prop_email').val() == ""){errors +=1; ermsg += "\nProponent Email, "}
        if($('#official_mail_address').val() == ""){errors +=1; ermsg += "\nOfficial Mailing Address, "}
        if($('#approving_authority_pos').val() == ""){errors +=1; ermsg += "\nApproving Authority Position, "}
        if($('#approving_authority_name').val() == ""){errors +=1; ermsg += "\nApproving Authority Name, "}


     
      
        if($('input[name="hgpid"]:checked').val() == undefined){
            errors +=1; ermsg += "\nFacilities/Type,"
        } else {
            var allFacids = getAllFacids();

            if($('input[name="hgpid"]:checked').val() == '34'){

            } else {
                if(allFacids.length <= 0)
                {
                    errors +=1; ermsg += "\nNo facilities/Services selected, "
                }
            }
        }
        
        if('{!!isset($fAddress)&&(count($fAddress) > 0)!!}'){
                var noofbed ='{!!((count($fAddress) > 0) ? $fAddress[0]->noofbed: "")!!}';
                console.log("noofbed")
                console.log(noofbed)
                console.log($('#noofbed').val())

                // console.log("noerrors")
                // if(parseInt($('#noofbed').val()) > parseInt(noofbed)){
                //     errors +=1; ermsg += "Authorized Bed Capacity should not exceed with the approved ABC";
                //     console.log("errors")
                //     console.log(errors)
                // }
        }
        if( $('input[name="hgpid"]:checked').val() == 6){
            var tram = document.getElementsByClassName('tr_amb')

            if(tram.length <= 0){
                errors +=1; ermsg += "\n No ambulance details,"
            }else{
            const ctyamb = document.getElementsByClassName("ctyamb") ;
            const cambt = document.getElementsByClassName("cambt") ;
            const cpn = document.getElementsByClassName("cpn") ;
            console.log("ctyamb")
            console.log(tram.length)
            console.log("ctyamb[xi].value")

            var haser = 'no';
            for(var xip = 1 ; xip <( tram.length +1); xip++){
                console.log("ctyamb[xi].value")
                console.log(ctyamb[xip].value +"-"+cambt[xip].value+"-"+cpn[xip].value)
                    if(
                            (ctyamb[xip].value == null || ctyamb[xip].value== undefined || ctyamb[xip].value == "" || !ctyamb[xip].value) ||
                            (cambt[xip].value == null || cambt[xip].value== undefined || cambt[xip].value == "" || !cambt[xip].value) ||
                            (cpn[xip].value == null || cpn[xip].value== undefined || cpn[xip].value == "" || !cpn[xip].value) 
                        
                        ){

                            var haser = 'yes';
                           
                        }
        
            }

            if(haser == 'yes'){
                errors +=1; ermsg += "\nIncomplete ambulance details,"
            }
        }

        }


        var os_list = document.getElementsByClassName('os_list')

        if(os_list.length > 0){
            if($('.os_list:checked').val() == undefined ){
                errors +=1; ermsg += "\nOther Clinical Services,"
            }
        }

        // if(errors > 0){
        //     alert("Please fill the following fields properly: " + ermsg)
        // }else{
        //     console.log("errors")
        //     console.log(errors)
        //     submitProper(e)
        // }

        

        if(e == 'final'){
            if(errors > 0){
                alert("Please fill the following fields properly: " + ermsg)
            }else{
                // console.log("errors")
                // console.log(errors)
                if(invalids > 0){
                    alert(invmssg)
                }else{
                    submitProper(e)
                }
            }
         }else{
            if(errorPar > 0){
                alert("Please fill the following required initial fields properly: " + ermsgP)
            }else{
                if(invalids > 0){
                    alert(invmssg)
                }else{
                    submitProper(e)
                }
            }
         }

      
        


   
    }


function submitProper(e){
    console.log("Saving Partial Form LTO ");
    const appid         = searchParams.get("appid");
    const types         = $("input[name='type[]']");
    const locations     = $("input[name='location[]'");
    const population    = $("input[name='population[]'");
    const con_catch     = [];

    const facilitynames     = $("input[name='facilitynames[]']");
    const loc               = $("input[name='locations[]']");
    const bedcapacities     = $("input[name='bedcapacities[]']");
    const cat_hos           = $("select[name='cat_hos[]']");
    const license           = $("input[name='license[]']");
    const validity          = $("input[name='validity[]']");
    const date_operation    = $("input[name='date_operation[]']");
    const remarks           = $("textarea[name='remarks[]']");

    const con_hospital  = [];
    for(let i  = 0; i < facilitynames.length; i++ ) {
        const con_hosp_data = {
            appid:          appid,
            facilityname:   facilitynames[i].value,
            location1:      loc[i].value,
            cat_hos:        cat_hos[i].value,
            noofbed1:       bedcapacities[i].value,
            license:        license[i].value,
            validity:       validity[i].value,
            date_operation: date_operation[i].value,
            remarks:        remarks[i].value
        }
        con_hospital.push(con_hosp_data)
    }
    console.log(con_hospital);

    for(let i  = 0; i < types.length; i++ ) {
        const con_catch_data = {
            appid:          appid,
            type:           types[i].value,
            location:       locations[i].value,
            population:     population[i].value,
            isfrombackend:  null
        }
        con_catch.push(con_catch_data)
    }

   
    var allFacids = getAllFacids();
    var allambdet = getallAmbDetails();
    var alladdondesc = getAddonDesc();
    // console.log("allFacids")
    // console.log(allFacids)
    // console.log("allambdet")
    // console.log(allambdet) 
    // console.log("alladdondesc")
    // console.log(alladdondesc)

  console.log("fac counts")
    console.log(allFacids.length)

  

    const facid = $('input[name="facid"]:checked').val();    
    const data = {
        // appid:                  appid,
        saveas:                  e == 'update' ? 'final' : e,
        // saveas:                  $('#saveasn').val(),
        aptid:                  $('#aptidnew').val(),
        appid:                  $('#appid').val(),
        hfser_id:               $('#typeOfApplication').val(),
        facilityname:           $('#facility_name').val(),
        facilitycode:           $('#facilitycode').val() == undefined ? '' : $('#facilitycode').val(),
        year:                   $('#year').val() == undefined ? '' : $('#year').val(),
        rgnid:                  $('#region').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->rgnid: "")!!}' : $('#region').val(),
        provid:                 $('#province').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->provid: "")!!}' : $('#province').val(),
        cmid:                   $('#city_monicipality').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->cmid: "")!!}' : $('#city_monicipality').val(),
        brgyid:                 $('#brgy').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->brgyid: "")!!}' : $('#brgy').val(),
        street_number:          $('#street_num').val(),
        street_name:            $('#street_name').val(),
        zipcode:                $('#zip').val(),
        contact:                $('#fac_mobile_number').val(),
        areacode:               `["${$('#areacode').val()}", "${$('#faxareacode').val()}", "${$('#prop_landline_areacode').val()}"]`,
        landline:               $('#landline').val(),
        faxnumber:              $('#faxNumber').val(),
        email:                  $('#fac_email_address').val(),
        uid:                    $("#uid").val(),
        cap_inv:                $('#cap_inv').val(),
        lot_area:               $('#lot_area').val(),
        noofbed:                $('#noofbed').val(),
        noofmain:               $('#noofmain').val(),
        noofsatellite:          $('#noofsatellite').val(),
        ocid:                   $('#ocid').val(),
        classid:                $('#classification').val()  == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->classid: "")!!}' : $('#classification').val() ,
        subClassid:             $('#subclass').val()  == "" ||  $('#subclass').val() == undefined ? '{!!((count($fAddress) > 0) ? $fAddress[0]->subClassid: "")!!}' : $('#subclass').val(),
        facmode:                $('#facmode').val(),
        funcid:                 document.querySelector('select[data-funcid="duplicate"]').value ? document.querySelector('select[data-funcid="duplicate"]').value : document.querySelector('select[data-funcid="main"]').value,
        // funcid:                 $('#funcid').val(),

        typeamb:                JSON.stringify(allambdet[0]),
        ambtyp:                 JSON.stringify(allambdet[1]),
        plate_number:           JSON.stringify(allambdet[2]),
        ambOwner:               JSON.stringify(allambdet[3]),
        addonDesc:              JSON.stringify(alladdondesc),
        // facid:                  "listfacids",
        facid:                  JSON.stringify(allFacids),
        owner:                  $('#owner').val(),
        ptcCode:                $('#ptcCode').val(),
        ownerMobile:            $('#prop_mobile').val(),
        ownerLandline:          $('#prop_landline').val(),
        ownerEmail:             $('#prop_email').val(),
        mailingAddress:         $('#official_mail_address').val(),
        approvingauthoritypos:  $('#approving_authority_pos').val(),
        approvingauthority:     $('#approving_authority_name').val(),
        // hfep_funded:            ($("#hfep_funded").is(":checked") ? 0 : null),
        hfep_funded:            ($('#hfep').prop('checked') ? 0 : null),
        draft:                  1,
        con_catch:              con_catch,
        con_hospital:           con_hospital,
        hgpid:                  $('input[name="hgpid"]:checked').val(),
        assignedRgn:             $('#assignedRgn').val(),//6-3-2021
        
        appchargenew:             $('#tempAppChargenew').val(),//appchargetemp
        appchargeHgpnew:             $('#tempAppChargeHgpidnew').val(),//appchargetemp
        appcharge:             $('#tempAppCharge').val(),//appchargetemp
        appchargeHgp:             $('#tempAppChargeHgpid').val(),//appchargetemp
        appChargeAmb:             $('#tempAppChargeAmb').val(),//appchargetemp,

        noofdialysis:           $('#noofdialysis').val(),
        remarks:             $('#remarks').val(),

        // tempAppChargeAmb
    }

    if(data.hfser_id == 'PTC')
    {
        if( $('input[name="hgpid"]:checked').val() == 1 || $('input[name="hgpid"]:checked').val() == 5 || $('input[name="hgpid"]:checked').val() == 8 || $('input[name="hgpid"]:checked').val() == 9 || $('input[name="hgpid"]:checked').val() == 12 || $('input[name="hgpid"]:checked').val() == 34 ){

            data.assignedRgn = 'hfsrb';
        }
    }

    if(data.hfser_id == 'LTO' || data.hfser_id == 'COA')
    {
        if( $('input[name="hgpid"]:checked').val() == 1 || $('input[name="hgpid"]:checked').val() == 2 || $('input[name="hgpid"]:checked').val() == 5 || $('input[name="hgpid"]:checked').val() == 8 || $('input[name="hgpid"]:checked').val() == 9 || $('input[name="hgpid"]:checked').val() == 10  || $('input[name="hgpid"]:checked').val() == 11  || $('input[name="hgpid"]:checked').val() == 12  || $('input[name="hgpid"]:checked').val() == 13 || $('input[name="hgpid"]:checked').val() == 34 ){

            data.assignedRgn = 'hfsrb';
        }

        if( $('input[name="facid"]:checked').val() == 'H2' || $('input[name="facid"]:checked').val() == 'H3' ){
            data.assignedRgn = 'hfsrb';
        }
    }
    
    console.log("data",data)
    if(confirm("Are you sure you want to proceed ?")){

        callApi('/api/application/lto/save', data, 'POST').then(d => {
            const id = d.data.id;
     
            const payment = d.data.payment;
            const appcharge = d.data.appcharge;
            const ambcharge = d.data.ambcharge;

        // window.location.replace(`${base_url}/client/dashboard/new-application?appid=${id}`);
            if(e == "final"){
                if(id){

                
                //   if( $('#aptidnew').val() == 'R'){
                //     // .$each[0]->hfser_id.'/')}}/each[0]->appid/hfsrb
                //     window.location.href="{{asset('client1/apply/app/')}}/"+$('#typeOfApplication').val()+'/'+ id+'/hfsrb'
                //     // window.location.href="{{url('client1/apply/attachment/')}}/"+$('#typeOfApplication').val()+'/'+ id
                //   }else{
                    window.location.href="{{asset('client1/apply/assessmentReady/')}}/"+ id
                //   }
               
                }
            
            }else{
                alert('Information now saved');
            }
        }
        ).then(error => {
            console.log(error);
        })

    }
}


function getAllFacids (){
    var addons =  getaddonsValues()
    var listAncs = getCheckedValue('anxsel')

    var listfacids = getCheckedValue('facid') 

    let thisFacid = []

    if(listfacids.length > 0){
        if(Array.isArray(listfacids)) {
						for(let i = 0; i < listfacids.length; i++) {
					  		// sArr.push('facid[]='+listfacids[i]); 
                            if(listfacids[i] != ""){
					  		thisFacid.push(listfacids[i]);
                            }
						} 
					}
    }
    if(listAncs.length > 0){
            if(Array.isArray(listAncs)) {
                for(let i = 0; i < listAncs.length; i++) {
                    // sArr.push('facid[]='+listAncs[i]); 
                    if(listAncs[i] != ""){
                    thisFacid.push(listAncs[i]);}
                } 
            }
    }

    if(addons.length > 0){
        if(Array.isArray(addons)) {
                for(let i = 0; i < addons.length; i++) {
                    // sArr.push('facid[]='+addons[i]); 
                    if(addons[i] != ""){
                    thisFacid.push(addons[i]);
                   }
                } 
            }
    }

    return thisFacid
   
}

function getallAmbDetails(){
   var ta = document.getElementsByName('typeamb');
   var at = document.getElementsByName('ambtyp');
   var pn = document.getElementsByName('plate_number');
   var ao = document.getElementsByName('ambOwner');

   var typeamb = [];
   var ambtyp = [];
   var plate_number = [];
   var ambOwner = [];

   for(var i =0 ; i < ta.length ; i++){
       typeamb.push(ta[i].value);
   }
   
   for(var i =0 ; i < at.length ; i++){
    ambtyp.push(at[i].value);
   }

   for(var i =0 ; i < pn.length ; i++){
    plate_number.push(pn[i].value);
   }

   for(var i =0 ; i < ao.length ; i++){
    ambOwner.push(ao[i].value);
   }

   var all = [];

   all.push(typeamb)
   all.push(ambtyp)
   all.push(plate_number)
   all.push(ambOwner)

   return all;


}

function getAddonDesc(){
   var ao = document.getElementsByName('addOnServ');
   var as = document.getElementsByName('aoservtyp');
   var aso = document.getElementsByName('aoservOwner');

    var alladdondesc =[];
    if(ao[0].options.length > 0){
    for(var i = 0 ; i < ao.length ; i++){
            const subs = {
                facid: ao[i].value,
                facid_name: ao[i].options[ao[i].selectedIndex].text,
                servtyp: as[i].value,
                servowner: aso[i].value
            }

            alladdondesc.push(subs);
    }
    }
   return alladdondesc
}
function checkEmailValidity(email) 
{
 if (/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email))
  {
    return (true)
  }
    return (false)
}

function checkNumberlValidity(number) 
{
 if (/^(09|\+639)\d{9}$/.test(number))
  {
    return (true)
  }
    return (false)
}
</script>