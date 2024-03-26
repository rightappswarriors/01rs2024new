<script>

    
    if ('{!!isset($fAddress)&&(count($fAddress) > 0)!!}') {
      console.log("typee")
      console.log('{!! $apptypenew !!}')

      var aptidnew ='{!!((count($fAddress) > 0) ? $fAddress[0]->aptid: "")!!}';
  document.getElementById("aptidnew").value = aptidnew;
      var appid ='{!!((count($fAddress) > 0) ? $fAddress[0]->appid: "")!!}';
      // document.getElementById("appid").value = appid;
      var apptypenew = '{!! $apptypenew !!}';

      if(apptypenew == "renewal"){

      document.getElementById("aptidnew").value = 'R';
      document.getElementById("appid").value = null;
      }else{
      document.getElementById("appid").value = appid;
      }

        var mserv_cap = JSON.parse('{!!addslashes($serv_cap)!!}')
        var areacode = JSON.parse('{!!((count($fAddress) > 0) ? $fAddress[0]->areacode: "")!!}');

        if (areacode.length > 0) {

            var arc = areacode[0];
            var farc = areacode[1];
            var proparc = areacode[2];
            var arcode = document.getElementById('areacode');
            arcode.value = arc

            var farcode = document.getElementById('faxareacode');
            farcode.value = farc

            var propcode = document.getElementById('prop_landline_areacode');
            propcode.value = proparc
        }

        var uid ='{!!((count($fAddress) > 0) ? $fAddress[0]->uid: "")!!}';
        var con_number ='{!!((count($fAddress) > 0) ? $fAddress[0]->con_number: "")!!}';
        var ocid ='{!!((count($fAddress) > 0) ? $fAddress[0]->ocid: "")!!}';
        var subclassid ='{!!((count($fAddress) > 0) ? $fAddress[0]->subClassid: "")!!}';
        var classid ='{!!((count($fAddress) > 0) ? $fAddress[0]->classid: "")!!}';
        var facmode ='{!!((count($fAddress) > 0) ? $fAddress[0]->facmode: "")!!}';
        var funcid ='{!!((count($fAddress) > 0) ? $fAddress[0]->funcid: "")!!}';
        var owner ="{!!((count($fAddress) > 0) ? $fAddress[0]->owner: '')!!}";
        // var owner ='{!!((count($fAddress) > 0) ? $fAddress[0]->owner: "")!!}';
        var ownerMobile ='{!!((count($fAddress) > 0) ? $fAddress[0]->ownerMobile: "")!!}';
        var ownerLandline ='{!!((count($fAddress) > 0) ? $fAddress[0]->ownerLandline: "")!!}';
        var ownerEmail ='{!!((count($fAddress) > 0) ? $fAddress[0]->ownerEmail: "")!!}';
        var mailingAddress ='{!!((count($fAddress) > 0) ? $fAddress[0]->mailingAddress: "")!!}';
        var approvingauthoritypos ='{!!((count($fAddress) > 0) ? $fAddress[0]->approvingauthoritypos: "")!!}';
        var approvingauthority ='{!!((count($fAddress) > 0) ? $fAddress[0]->approvingauthority: "")!!}'; 
        var hfep ='{!!((count($fAddress) > 0) ? $fAddress[0]->hfep_funded: "")!!}';
        var comments ='{!!((count($fAddress) > 0) ? $fAddress[0]->appComment: "")!!}';

        console.log("classid")
        console.log(classid)

        // setTimeout(function(){  
  var ocidInpt = document.getElementById("ocid");
  ocidInpt.value = ocid;
        // ocidInpt.setAttribute("disabled", "disabled")
        //  }, 1000);
if(ocid){
     setTimeout(function(){  
        
        fetchClassification1()
     }, 1000);

    setTimeout(function(){ 

        document.getElementById("classification").value=classid;
        document.getElementById("subclass").value=subclassid;
        
 }, 2000);
 setTimeout(function(){ 
    fetchSubClass1()
 console.log(classid)
 console.log(subclassid)
 document.getElementById("classification").value=classid;
       
 }, 3000);
 setTimeout(function(){ 
    document.getElementById("subclass").value=subclassid;
// console.log(classid)
// console.log(subclassid)
        // document.getElementById("classification").value=classid;
       
 }, 4000);
}

const fetchClassification1 = async (e) => {
    const ocid = $("#ocid").val();
    console.log('EYYY, ', ocid);
    if( ocid ) {
        const data = { 'ocid' : ocid }
        callApi('/api/classification/fetch', data, 'POST').then(classification => {
            $("#classification").empty();
            $("#classification").append(`<option value=''>Please select</option>`);

            @if(app('request')->input('cont') != 'yes')
            //   $("#classification").removeAttr('disabled');
            @endif

            classification.data.map(c => {
                $("#classification").append(`<option value='${c.classid}'>${c.classname}</option>`);
            })
            // $("#classification").selectpicker('refresh')
        })

        

    }
    else {
    //    $("#classification").addAttr('disabled')
    }

    
}

const fetchSubClass1 = async (e) => {
    console.log("received")
    const ocido = $("#ocid").val();
    const classido = $("#classification").val();
    console.log("classid")
    console.log(classido)
    if(ocido ) {
        const data = { 'ocid' : ocid, 'classid' : classid }
        callApi('/api/classification/fetch', data, 'POST').then(classification => {
            $("#subclass").empty();
            $("#subclass").append(`<option value=''>Please select</option>`);
            
            @if(app('request')->input('cont') != 'yes')
                 //$("#subclass").removeAttr('disabled');
            @endif
            classification.data.map(c => {
                $("#subclass").append(`<option value='${c.classid}'>${c.classname}</option>`);
            })
            // $("#subclass").selectpicker('refresh')
        })
    }
    else {
        //$("#subclass").addAttr('disabled')
    }
}





        console.log("hfep")
        console.log(hfep)
        setTimeout(function(){
          if(hfep === '0'){
          document.getElementById("hfep").checked = true;
          }
        }, 2000);

        document.getElementsByName('funcid')[0].value = funcid;
       
        document.getElementById("uid").value = uid;
        document.getElementById("facmode").value = facmode;
        document.getElementById("owner").value = owner;
        document.getElementById("prop_mobile").value = ownerMobile;
        document.getElementById("prop_landline").value = ownerLandline;
        document.getElementById("prop_email").value = ownerEmail;
        document.getElementById("official_mail_address").value = mailingAddress;
        document.getElementById("approving_authority_pos").value = approvingauthoritypos;
        document.getElementById("approving_authority_name").value = approvingauthority;
        var cmmt =  document.getElementById("remarks")

        if(cmmt){
            cmmt.value = comments;
        }
        var checcon = document.getElementById("connumber");

        if(checcon){
        document.getElementById("connumber").value = con_number;
        }

        var ocidInpt = document.getElementById("ocid");
        ocidInpt.value = ocid;
        // ocidInpt.setAttribute("disabled", "disabled")

        console.log("subclassid")
        console.log(subclassid)

        const data = { 'ocid' : ocid, 'classid' : classid }
        if(subclassid != ""){
        $.ajax({
						url: '{{asset('api/classification/fetch')}}',
						dataType: "json", 
	    				async: false,
						method: 'POST',
						data: data,
						success: function(a){
                          
                            var result = a.filter(function(v) {
                                    return v.classid == subclassid;
                            })
                            document.getElementById("subclass").placeholder = result[0].classname;
                            
						}
					});
        }
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

@if(app('request')->input('grplo') == 'rlo')
//document.getElementById("ocid").setAttribute("disabled", "disabled")
//document.getElementById("facmode").setAttribute("disabled", "disabled")
//document.getElementById("funcid").setAttribute("disabled", "disabled")
setTimeout(function(){  
    //document.getElementById("classification").setAttribute("disabled", "disabled")
    setTimeout(function(){ 
      //  document.getElementById("subclass").setAttribute("disabled", "disabled")
 }, 3000);

 }, 3000);
setTimeout(function(){  
 var ffc = document.getElementsByName("facid")
 var hhg = document.getElementsByName("hgpid")

 if(ffc){
     for(var fc = 0; fc < ffc.length; fc++){
         ffc[fc].disabled = true;
     }
 }

if(hhg){
     for(var hh = 0; hh < ffc.length; hh++){
        hhg[hh].disabled = true;
     }
 }
}, 3000);
@endif

</script>