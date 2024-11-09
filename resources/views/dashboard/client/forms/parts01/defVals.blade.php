<script>




 // console.log("received")

//  const base_url = '{{URL::to('/')}}';
   
function checkFacilityNameNew(e) {
   // const checkFacilityNameNew1 = async (e) => {

//        setTimeout(function(){  
//            document.getElementById("region").value = "03";
//  }, 1000);
//        console.log("whyyyy")

  

//    const facilityname = $('#facility_name').val() ? $('#facility_name').val() : e;
   const facilityname =  e;

   document.getElementById('facility_name').value = e;
console.log(e)
   console.log('EYYY, ', facilityname);
   if( facilityname ) {
       
       callApi('/api/application/validate-name/registered', {
       // callApi('/api/application/validate-name', {
           name: facilityname
       }, 'POST').then(ok => {

        if(ok.data.resp == "dontexist"){
           console .log("appdata")
           console.log(ok.data.message)
           localStorage.setItem('facilityname', facilityname)
           $("#facility_name").css('border', '1px solid green');
           $("#facility_name_feedback").removeClass('text-danger');
           $("#facility_name_feedback").addClass('text-success');
           $("#facility_name_feedback").html("Facility Name safe to use");

        //    document.getElementById("region").value = null;
        //    document.getElementById("province").value =null;
        //    document.getElementById("city_monicipality").value = null;
        //    document.getElementById("brgy").value = null;

        //    removeDefault()

       }else{
           var appdata = ok.data.appdata
           console .log("appdata")
           console .log(appdata)
           console .log("appdata")
           // alert(err.response.data.message)
           $("#facility_name").css('border', '1px solid red');
           $("#facility_name_feedback").removeClass('text-success');
           $("#facility_name_feedback").addClass('text-danger');
           $("#facility_name_feedback").html("Facility Already Exist");

   

     
          document.getElementById("region").value = appdata[0].rgnid;
          document.getElementById("province").value = appdata[0].provid;
          document.getElementById("city_monicipality").value = appdata[0].cmid;
          document.getElementById("brgy").value = appdata[0].brgyid;
          document.getElementById("ocid").value = appdata[0].ocid;
          fetchClassificationNew(appdata[0].ocid, appdata[0].classid)
          fetchSubClassNew(appdata[0].ocid, appdata[0].classid, appdata[0].subClassid)

          document.getElementById("facmode").value = appdata[0].facmode;
          document.getElementById("funcid").value = appdata[0].funcid;
          document.getElementById("approving_authority_pos").value = appdata[0].approvingauthoritypos;

          
          
          defaultValues(appdata[0])
          
           
       }

       }).catch(err => {
           // var appdata = err.data.appdata
           // console .log(appdata)
           // // alert(err.response.data.message)
           // $("#facility_name").css('border', '1px solid red');
           // $("#facility_name_feedback").removeClass('text-success');
           // $("#facility_name_feedback").addClass('text-danger');
           // $("#facility_name_feedback").html(err.response.data.message);
       })
   }
   else {
       $("#facility_name").css('border', '1px solid red');
       $("#facility_name_feedback").removeClass('text-success');
       $("#facility_name_feedback").addClass('text-danger');
       $("#facility_name_feedback").html('Facility name is required');
   }
  
   
}
function callApi(url, data, method) {
   const config = {
       method: method,
       url: `${base_url}${url}`,
       headers: { 
         'Content-Type': 'application/json'
       },
       data : data
   };
   return axios(config)
};

function defaultValues(data){
   console.log("Default value")
   console.log(data)


   document.getElementById("region_org").setAttribute("hidden", true)
   document.getElementById("region_ex").removeAttribute("hidden")
   document.getElementById("regionU").value=data.rgn_desc

   document.getElementById("prov_org").setAttribute("hidden", true)
   document.getElementById("prov_ex").removeAttribute("hidden")
   document.getElementById("provinceU").value=data.provname

   document.getElementById("cm_org").setAttribute("hidden", true)
   document.getElementById("cm_ex").removeAttribute("hidden")
   document.getElementById("city_monicipalityU").value=data.cmname

   document.getElementById("br_org").setAttribute("hidden", true)
   document.getElementById("br_ex").removeAttribute("hidden")
   document.getElementById("brgyU").value=data.brgyname

   document.getElementById("street_num").value = data.street_number;
   document.getElementById("street_name").value = data.street_name;
   document.getElementById("zip").value = data.zipcode;

   var areacode = JSON.parse(data.areacode);

   var arc = areacode[0];
   var farc = areacode[1];
   var proparc = areacode[2];

   document.getElementById("fac_mobile_number").value = data.contact;
   document.getElementById("areacode").value = arc;
   document.getElementById("landline").value = data.landline;
   document.getElementById("faxareacode").value = farc;
   document.getElementById("faxNumber").value = data.faxnumber;
   document.getElementById("fac_email_address").value = data.email;

   document.getElementById("owner").value = data.owner;
   document.getElementById("prop_mobile").value = data.ownerMobile;
   document.getElementById("prop_landline_areacode").value = proparc;
   document.getElementById("prop_landline").value = data.ownerLandline;
   document.getElementById("prop_email").value = data.ownerEmail;

   document.getElementById("official_mail_address").value = data.mailingAddress;


   document.getElementById("approving_authority_name").value = data.approvingauthority;


}

function removeDefault(){

   document.getElementById("region_ex").setAttribute("hidden", true)
   document.getElementById("region_org").removeAttribute("hidden")

   document.getElementById("prov_ex").setAttribute("hidden", true)
   document.getElementById("prov_org").removeAttribute("hidden")

   document.getElementById("cm_ex").setAttribute("hidden", true)
   document.getElementById("cm_org").removeAttribute("hidden")

   document.getElementById("br_ex").setAttribute("hidden", true)
   document.getElementById("br_org").removeAttribute("hidden")

   document.getElementById("street_num").value = null;
   document.getElementById("street_name").value = null;
   document.getElementById("zip").value = null;

   document.getElementById("fac_mobile_number").value = null;
   document.getElementById("areacode").value = null;
   document.getElementById("landline").value = null;
   document.getElementById("faxareacode").value = null;
   document.getElementById("faxNumber").value = null;
   document.getElementById("fac_email_address").value = null;

   document.getElementById("owner").value = null;
   document.getElementById("prop_mobile").value = null;
   document.getElementById("prop_landline_areacode").value = null;
   document.getElementById("prop_landline").value = null;
   document.getElementById("prop_email").value = null;

   document.getElementById("official_mail_address").value = null;


   document.getElementById("approving_authority_name").value = null;

   document.getElementById("region").value = null;
   document.getElementById("province").value = null;
   document.getElementById("city_monicipality").value = null;
   document.getElementById("brgy").value = null;
   document.getElementById("ocid").value = null;

   document.getElementById("facmode").value = null;
   document.getElementById("funcid").value = null;
   document.getElementById("approving_authority_pos").value = null;
   document.getElementById("classification").value = null;
   document.getElementById("subclass").value = null;

}


  
const fetchClassificationNew = async (e, classid) => {
    const ocid = e;
    console.log('EYYY, ', ocid);
    if( ocid ) {
        const data = { 'ocid' : ocid }
        callApi('/api/classification/fetch', data, 'POST').then(classification => {
            $("#classification").empty();
            $("#classification").append(`<option value=''>Please select</option>`);
            $("#classification").removeAttr('disabled');
            classification.data.map(c => {
               if(c.classid == classid){
                $("#classification").append(`<option selected value='${c.classid}'>${c.classname}</option>`);
               }else{
                $("#classification").append(`<option value='${c.classid}'>${c.classname}</option>`);
               }
              
            })
            $("#classification").selectpicker('refresh')
        })

        

    }
    else {
        $("#classification").addAttr('disabled')
    }

    
}
const fetchSubClassNew = async (ocidn, classidn, subclass) => {
    const ocid = ocidn;
    const classid =classidn
    if( subclass ) {
        const data = { 'ocid' : ocid, 'classid' : classid }
        callApi('/api/classification/fetch', data, 'POST').then(classification => {
            $("#subclass").empty();
            $("#subclass").append(`<option value=''>Please select</option>`);
            $("#subclass").removeAttr('disabled');
            classification.data.map(c => {
                if(c.classid == subclass){
                   $("#subclass").append(`<option selected value='${c.classid}'>${c.classname}</option>`);
                }else{
                    $("#subclass").append(`<option value='${c.classid}'>${c.classname}</option>`);
                }
            })
            $("#subclass").selectpicker('refresh')
        })
    }
    else {
        $("#subclass").addAttr('disabled')
    }
}


 
</script>