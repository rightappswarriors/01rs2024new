{{-- ///////////////////////  Lloyd - Nov 16 2018  //////////////////////////////////////// --}}

<script type="text/javascript">

	// var newColWidth = document.getElementsByTagName('td')[currentTDRow * currentTDCol].clientWidth;

	var clickOnClose = document.getElementById('clickOnClose');



	//////////////////////////////// CONSTANTS ////////////////////////////////



   	// Events

   	if(clickOnClose != null || clickOnClose != undefined) {

   		clickOnClose.addEventListener("click", close);

   	}



	$(document).ready(function() {
      // var table1 =  $('#examplem').DataTable();


      $.fn.dataTable.ext.search.push(
        function (settings, data, dataIndex) {
            var min = $('#min').datepicker('getDate');
            var max = $('#max').datepicker('getDate');
            var startDate = new Date(data[4]);
            // var startDate = new Date(data[4]);
            if (min == null && max == null) return true;
            if (min == null && startDate <= max) return true;
            if (max == null && startDate >= min) return true;
            if (startDate <= max && startDate >= min) return true;
            return false;
        }
    );

    $('#min').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });
    $('#max').datepicker({ onSelect: function () { table.draw(); }, changeMonth: true, changeYear: true });


  
      // $('#example').DataTable();
      
      var table = $('#example').DataTable();

$('#min, #max').change(function () {
 table.draw();
});


   
   });



   	// Function that toggles "readonly" attribute of textarea

   	function toggleForm(dom){

   		var textarea1 = document.getElementById('ot-others1');

         var textarea2 = document.getElementById('ot-others2');

   		var tog = dom.checked;



   		if(textarea != null) {

   			if(!tog) {

   				textarea1.setAttribute("readonly", true);

               textarea2.setAttribute("readonly", true);

   				textarea1.value='';

               textarea2.value='';

   			} else {

   				textarea1.removeAttribute("readonly");

               textarea2.removeAttribute("readonly");

   			}

   		}

   	}



   	function toggleDate(dom) {

   		var x = document.getElementById("conf-date");

   		var y = document.getElementById("conff-date");

   		if(!dom.value) {

   			if(x) {

   				x.setAttribute("readonly", "true");

   				x.value="";

   			} else if(y) {

   				y.setAttribute("readonly", "true");

   				y.value="";

   			}	

   		} else {

   			if(x) {

   				x.removeAttribute("readonly");

   				x.parentElement.style.backgroundColor="rgb(255, 255, 255)";

   			} else if(y) {

   				y.removeAttribute("readonly");

   				y.parentElement.style.backgroundColor="rgb(255, 255, 255)";

			   }

   		}

   	}



   	// Function that clamps a variable

   	function clamp(dom, min=0){

   		/* if(dom.value>max) dom.value=max;

   		else */if(dom.value<min) dom.value=min;

   	}   	



   	// Function to dynamically change Type of facility

   	function changeFaci(){;

   		// var data = $('select[name=name_of_faci]').val();

         var facId = document.getElementById('facName').value;

         document.getElementById('e_sappid').value=facId;

         //factype ajax

         if(facId != "") {

            facType.open("GET", "{{asset('employee/dashboard/others/getFacTypeByAppId')}}"+facId, true);

            facType.send();

         }

   	}



      function changeFaciSurveillance(){
// console.log("received")
         // var data = $('select[name=name_of_faci]').val();

         var facId = document.getElementById('factype').value;

         document.getElementById('e_sappid').value=facId;

         document.getElementById('facaddr').value="";

         //factype ajax

         if(facId != "") {

            // facName.open("GET", "{{asset('employee/dashboard/others/reg/getFacNameNotApprovedByFacid')}}"+facId, true);
            facName.open("GET", "{{asset('employee/dashboard/others/getFacNameNotApprovedByFacid')}}"+facId, true);

            facName.send();

         }

      }



      function getComplaintsDet(who){

         if($(who).val() != ""){

            $.ajax({

               url: '{{asset('employee/dashboard/others/surveillance/getComplaint')}}',

               method: "POST",

               data: {_token: $("input[name=_token]").val(),refno: $(who).val()},

               success: function(a){

                  let data = JSON.parse(a);

                  $("#compNameofFaci").empty().val(data['name_of_faci']);

                  $("#u_typeoffaci").empty().val(data['facid']);

                  $("#comTypeDisplay").empty().val(data['type_of_faci']);

                  $("#comType").empty().val(data['facid']);

                  $("#comLoc").empty().val(data['address_of_faci']);

                  $("#comComp").empty().val(data['properVio']);

                  $("#comAppid").empty().val(data['appid']);

                  $("#compid").empty().val(data['ref_no']);

               }



            })

         }

      }



      function changeFaciMonitoring(){;

         // var data = $('select[name=name_of_faci]').val();

         var facId = document.getElementById('factype').value;

         document.getElementById('e_sappid').value=facId;

         document.getElementById('facaddr').value="";

         document.getElementById('facr').value="";

         document.getElementById('facp').value="";

         document.getElementById('facc').value="";

         document.getElementById('facb').value="";

         //factype ajax

         if(facId != "") {

            facName.open("GET", "{{asset('employee/dashboard/others/getFacNameByFacid')}}"+facId, true);

            facName.send();

         }

      }



      function changeFaciSelect(){

         // var data = $('select[name=name_of_faci]').val();

         var facId = document.getElementById('xfacName').value;

         document.getElementById('e_sappid').value=facId;

         //factype ajax

         if(facId != "") {

            facTypeSelect.open("GET", "{{asset('employee/dashboard/others/getFacTypeByAppId')}}"+facId, true);

            facTypeSelect.send();

         }

      }



      function changeFaciType() {

         //facaddr ajax

         var facIdd = document.getElementById('facName').value;

         var facUid = document.getElementById('factype').value;

         // var facr = document.getElementById('facr');

         // var facp = document.getElementById('facp');

         // var facc = document.getElementById('facc');

         // var facc = document.getElementById('facc');


         if(facUid != "") {

            facAddr.open("GET", "{{asset('employee/dashboard/others/getAllFacAddr')}}", true);

            facAddr.send();

         }



         //appteam ajax

         if(facIdd != "" && facUid != "") {

            appTeam.open("GET", "{{asset('employee/dashboard/others/getAppTeamByAppId')}}", true);

            appTeam.send();

         }

      }



//////////////////////////// lloyd - Dec 7, 2018 //////////////////////////////

   function naturechange() {

      var togBtn = document.getElementById('togBtn');

      var hidType = document.getElementById('hidType');

      var reqsdiv = document.getElementById('reqsdiv');

      var compsdiv = document.getElementById('compsdiv');

      var form = document.getElementById('r-others-form');

      var xaction;



      switch(togBtn.checked) {

         case true:

            hidType.value="Request";

            $(".forAssistance").show();



            reqsdiv.hidden=false;

            compsdiv.hidden=true;



            for(i=0; i<reqsdiv.childElementCount; i++) {

               if(reqsdiv.children[i].tagName == "INPUT" || reqsdiv.children[i].tagName == "TEXTAREA") {

                  reqsdiv.children[i].disabled=false;

               }

            }



            for(i=0; i<compsdiv.childElementCount; i++) {

               if(compsdiv.children[i].tagName == "INPUT" || compsdiv.children[i].tagName == "TEXTAREA") {

                  compsdiv.children[i].disabled=true;

               }

            }

            xaction = form.getAttribute("action");

            xaction = xaction.split('/');



            xaction[xaction.length-1] = "5";

            xaction[xaction.length-2] = "req_submit";



            xaction = xaction.join('/');



            form.removeAttribute('action');

            form.setAttribute('action', xaction);



            break;

         case false:

            hidType.value="Complaints";



            reqsdiv.hidden=true;

            compsdiv.hidden=false;

            $(".forAssistance").hide();



            for(i=0; i<reqsdiv.childElementCount; i++) {

               if(reqsdiv.children[i].tagName == "INPUT" || reqsdiv.children[i].tagName == "TEXTAREA") {

                  reqsdiv.children[i].disabled=true;

               }

            }



            for(i=0; i<compsdiv.childElementCount; i++) {

               if(compsdiv.children[i].tagName == "INPUT" || compsdiv.children[i].tagName == "TEXTAREA") {

                  compsdiv.children[i].disabled=false;

               }

            }

            xaction = form.getAttribute("action");

            xaction = xaction.split('/');



            xaction[xaction.length-1] = "8";

            xaction[xaction.length-2] = "comp_submit";



            xaction = xaction.join('/');



            form.removeAttribute('action');

            form.setAttribute('action', xaction);



            break;

      }

   }



   function addMonitoringMember() {

      var group = document.getElementById('s_sign');

      var firstChild = group.children[0];

      var latestChild = group.children[group.childElementCount-1];



      var nextChildHTML = latestChild.innerHTML;

      var nextChildClass = latestChild.className;

      var nextChildId = latestChild.id;

            nextChildId = nextChildId.substring(0, nextChildId.length);

            var nextId = nextChildId.substring(nextChildId.length-1);

                  nextId = parseInt(nextId);

                  nextId++;

                  nextId = nextId.toString();

            nextChildId = nextChildId.substring(0, nextChildId.length-1)+nextId;





      var nextChild = document.createElement('div');

            nextChild.innerHTML = nextChildHTML;

            nextChild.setAttribute('class', nextChildClass);

            nextChild

            nextChild.id = nextChildId;



      var nextChildChild = nextChild.children[0];

            nextChildChildId = nextChildChild.id;

            nextChildChild.id = nextChildChildId.substring(0, nextChildChildId.length-3);

            var nextChildChildParentId = nextChildChildId.substring(nextChildChildId.length-3, nextChildChildId.length-2);

            var nextChildChildNextId = nextChildChildId.substring(nextChildChildId.length-1, nextChildChildId.length);

                  nextChildChildNextId = parseInt(nextChildChildNextId);

                  nextChildChildNextId++;

                  nextChildChildNextId.toString();

            nextChildChild.id = nextChildChild.id + nextChildChildParentId + "_" + nextChildChildNextId;





      nextChild.children[2].hidden=false;



      group.appendChild(nextChild);

   }



   function removeMonitoringMember(dom) {

      var group = document.getElementById('s_sign');

      var child = dom.parentElement.parentElement;



      group.removeChild(child);

   }



   function showHiddenInRecommendation(dom) {

      var selected = dom.value;

      var payment = document.getElementById('payment');

      var suspension = document.getElementById('suspension');

      var s_rec_others = document.getElementById('s_rec_others');



      switch(selected) {

         case "2":

            payment.hidden = false;

            payment.children[0].disabled = false;

            suspension.hidden = true;

            suspension.children[0].disabled = true;

            s_rec_others.hidden = true;

            s_rec_others.children[0].disabled = true;

            break;

         case "3":

            payment.hidden = true;

            payment.children[0].disabled = true;

            suspension.hidden = false;

            suspension.children[0].disabled = false;

            s_rec_others.hidden = true;

            s_rec_others.children[0].disabled = true;

            break;

         case "5":

            payment.hidden = true;

            payment.children[0].disabled = true;

            suspension.hidden = true;

            suspension.children[0].disabled = true;

            s_rec_others.hidden = false;

            s_rec_others.children[0].disabled = false;

            break;

         default:

            payment.hidden = true;

            payment.children[0].disabled = true;

            suspension.hidden = true;

            suspension.children[0].disabled = true;

            s_rec_others.hidden = true;

            s_rec_others.children[0].disabled = true;

            break;

      }

   }



   function showHiddenInVerdict(dom) {

      var ot = document.getElementById('s_ver_others');

      switch(dom.value) {

         case "ot":

            ot.hidden=false;

            ot.children[0].disabled=false;

            break;

         default:

            ot.hidden=true;

            ot.children[0].disabled=true;

            break;

      }

   }



   var appTeam = new XMLHttpRequest();

   appTeam.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:



         var appTeamData = JSON.parse(this.responseText);



         var parents = document.getElementsByTagName('select');



         for(i=0; i<parents.length; i++) {

            if(parents[i].name=="signs[]") {

               var parent = parents[i].id;

                     parent = parent.substring(parent.length-1, parent.length);

               var select = document.getElementById('s_signatures_0_'+parent);

               while(select.firstChild) {

                  select.removeChild(select.firstChild);

               }

            

               var node = document.createElement("option");

               node.setAttribute("hidden", "");

               node.setAttribute("disabled", "");

               node.setAttribute("selected", "");

               node.innerHTML="";

               select.appendChild(node);

               select.selected=0;





               for(j=0; j<appTeamData.length; j++) {

                  var node = document.createElement("option");

                  node.setAttribute("value", appTeamData[j]['uid']);

                  node.innerHTML=appTeamData[j]['uid'];

                  select.appendChild(node);

               }

            }   

         }    

      }

   };



   var facType = new XMLHttpRequest();

   facType.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:



         var facTypeData = JSON.parse(this.responseText);

         var textarea = document.getElementById('factype');



         if(textarea.tagName == "TEXTAREA") {

            textarea.value="";

            

            document.getElementById('facaddr').value="";



            if(facTypeData.length>0) {

               for(i=0; i<facTypeData.length; i++) {

                  textarea.value += "•"+facTypeData[i]['facname']+"\n";

               }

            } else {

               textarea.placeholder="No Facilities";

               textarea.value="";

            }

         } else if (textarea.tagName == "SELECT") {

            

         }



      

         facAddr.open("GET", "{{asset('employee/dashboard/others/getAllFacAddr')}}", true);

         facAddr.send();

      }

   };



   var facAddr = new XMLHttpRequest();

   facAddr.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {
         // Typical action to be performed when the document is ready:



         var facAddrData = JSON.parse(this.responseText);

         var input = document.getElementById('facaddr');

         var appid = document.getElementById('xfacName').value;

         for(i=0; i<facAddrData.length; i++) {



            if(facAddrData[i]['appid'] == appid && facAddrData[i]['brgyname'] != null) {

               input.value="";

               input.value+=facAddrData[i]['brgyname']+" ";

               input.value+=facAddrData[i]['cmname']+" ";

               input.value+=facAddrData[i]['provname']+" ";

               input.value+=facAddrData[i]['rgn_desc'];

               // document.getElementById('facr').value=facAddrData[i]['rgn_desc'];

               // document.getElementById('facp').value=facAddrData[i]['provname'];

               // document.getElementById('facc').value=facAddrData[i]['cmname'];

               // document.getElementById('facb').value=facAddrData[i]['brgyname'];

               // input.readonly = false;

            } else {

               // input.readonly = true;

            }

         }

      }

   };



   var facTypeSelect = new XMLHttpRequest();

   facTypeSelect.onreadystatechange = function() {

      if(this.readyState == 4 && this.status == 200) {

         var facAddrData = JSON.parse(this.responseText);

         var select = document.getElementById('factype');
         document.getElementById('facaddr').value="";

         var appid = document.getElementById('xfacName').value;

         while(select.firstChild) {

            select.removeChild(select.firstChild);

         }



         var node = document.createElement("option");

            node.setAttribute("hidden", "");

            node.setAttribute("disabled", "");

            node.setAttribute("selected", "");

            node.innerHTML="Select a Facility";

            select.appendChild(node);

            select.selected=0;



         if(facAddrData.length > 0) {

            for(i=0; i<facAddrData.length; i++) {

               var child = document.createElement("option");

               child.setAttribute("value", facAddrData[i]['uid']+"^"+facAddrData[i]['facname']);

               child.innerHTML=facAddrData[i]['facname'];

               select.appendChild(child);

            }

         } else {

            var child = document.createElement("option");

               child.setAttribute("hidden", "");

               child.setAttribute("disabled", "");

               child.setAttribute("selected", "");

               child.innerHTML="No facility";

               select.appendChild(child);

               select.selected=0;

         }

      }

   };



   var facName = new XMLHttpRequest();

   facName.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         // console.log(this.responseText);

         var facNameData = JSON.parse(this.responseText);

         var select = document.getElementById('facName');



         while(select.firstChild) {

            select.removeChild(select.firstChild);

         }



         if(facNameData.length > 0) {

            // console.log(facNameData)



            for(i=0; i<facNameData.length; i++) {

               // var namedivchild = document.createElement('DIV');

               //       namedivchild.setAttribute('class', 'input-group form-inline');

               // namediv.appendChild(namedivchild);



               // var next = document.createElement('INPUT');

               //       next.setAttribute('readonly', '');

               //       next.setAttribute('class', 'form-control mb-1');

               //       next.setAttribute('name', 'facname_'+i);

               //       next.setAttribute('id', 'facname_'+i);

               //       next.value = facNameData[i]['facilityname'];

               // namedivchild.appendChild(next);

               var option = document.createElement('OPTION');

                     option.setAttribute('value', facNameData[i]['appid']);

                     option.innerHTML=facNameData[i]['facilityname'];

               select.appendChild(option);

            }

         } else {

            var option = document.createElement('OPTION');

                  // option.setAttribute('hidden', '');

                  option.setAttribute('value', '');

                  option.setAttribute('disabled', '');

                  option.innerHTML='No Facility Found';

            select.appendChild(option);

         }

      }

   };



  //////////////////////////// modal - Dec 10, 2018 ////////////////////////////// 



   function editSurvOthers(dom) {

      if(dom.value == "ot") {

         document.getElementById('edit_ver_others').hidden=false;

         document.getElementById('edit_ver_others').children[0].disabled=false;

      } else {

         document.getElementById('edit_ver_others').hidden=true;

         document.getElementById('edit_ver_others').children[0].disabled=true;

      }

   }



   function getEditData(hfsrbno, name_of_faci, type_of_faci, date_added) {

      console.log("edit data")

      // document.getElementById('edit_ver_others').hidden=true;

      // document.getElementById('edit_ver_others').children[0].disabled=true;

      document.getElementById('hfsrbno').value=hfsrbno;

      document.getElementById('edit_nov').value=hfsrbno;

      document.getElementById('edit_date').value=date_added;

      document.getElementById('edit_name').value=name_of_faci;

      document.getElementById('edit_type').value=type_of_faci;

      // document.getElementById('edit_status').value=verdict;

      // document.getElementById('edit_ver_others').children[0].value=others;

      // document.getElementById('edit_violation').value=(offense == null)?"":offense;;

      // document.getElementById('edit_recommendation').value=recommendation;

      // switch(rec_id) {

      //    case '2':   document.getElementById('edit_recommendation_cont').value=payment;

      //                document.getElementById('edit_recommendation_cont').hidden = false; break;

      //    case '3':   document.getElementById('edit_recommendation_cont').value=suspension;;

      //                document.getElementById('edit_recommendation_cont').hidden = false; break;

      //    case '5':   document.getElementById('edit_recommendation_cont').value=r_rec_others;

      //                document.getElementById('edit_recommendation_cont').hidden = false; break;

      //    default: document.getElementById('edit_recommendation_cont').hidden = true; break;

      // }

      // document.getElementById('edit_monitoring').value=signs;

      

   }



   function getDelData(monid, name_of_faci) {

      document.getElementById('dmonid').value=monid;  

      document.getElementById('delMsg').innerText=name_of_faci;

   }



   function vReqComp(ref_no, type, name_of_comp, appid, name_of_faci, type_of_faci, reqs, comps) {

      document.getElementById('vcom').innerText = (reqs == "")?"Complainant:":"Client:";

      document.getElementById('vcom_name').innerText=name_of_comp;

      document.getElementById('vtype').innerText=type;

      document.getElementById('vname').innerText=name_of_faci;

      document.getElementById('vtypef').innerText=type_of_faci;

      if(type == "Request") {

         document.getElementById('rc').innerText="Requests:";

         document.getElementById('rqtextarea').value=reqs;

      }

      else if(type == "Complaints") {

         document.getElementById('rc').innerText="Complaints:";

         document.getElementById('rqtextarea').value=comps;

      }

   }



   function mReqComp(ref_no, type, name_of_comp, appid, name_of_faci, type_of_faci, reqs, comps) {

      

   }



   //////////////////////////// team modal - Dec 17, 2018 ////////////////////////////// 

   function getMonitoringData(appid, monid) {

      document.getElementById('atappid').value=appid;

      document.getElementById('atmonid').value=monid;

   }



   function viewTMonitoring(hfsrbno, appid, date_issued, name_of_faci, addr, type_of_faci) {

      document.getElementById('vthfsrbno').value=hfsrbno;

      document.getElementById('vtappid').value=appid;

      document.getElementById('vDate').value=date_issued;

      document.getElementById('vName').value=name_of_faci;

      document.getElementById('vAddr').innerText=addr;

      document.getElementById('vType').value=type_of_faci;
   }



   var novmembers = new XMLHttpRequest();

   novmembers.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         var nmembers = JSON.parse(this.responseText);

         var select = document.getElementById('novselect');

         while(select.firstChild) {

            select.removeChild(select.firstChild);

         }



         for(i=0; i<nmembers.length; i++) {

            var option = document.createElement('OPTION');

                  option.value=nmembers[i].uid;

                  option.innerText=nmembers[i].fname + " " + nmembers[i].lname;

                  select.appendChild(option);

         }

      }

   };



   var novmembersu = new XMLHttpRequest();

   novmembersu.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         var nmembers = JSON.parse(this.responseText);

         var select = document.getElementById('unovselect');

         while(select.firstChild) {

            select.removeChild(select.firstChild);

         }



         for(i=0; i<nmembers.length; i++) {

            var option = document.createElement('OPTION');

                  option.value=nmembers[i].uid;

                  option.innerText=nmembers[i].fname + " " + nmembers[i].lname;

                  select.appendChild(option);

         }

      }

   };



   function issueNOV(monid, appid, date, name, type, ast, violation, team, teamname) {



      $('#novsubdesc').summernote('code','<br><br>');    

      $('.note-toolbar').hide();

      $('#novsubdesc').summernote('disable');

      document.getElementById('novsubdesc').innerHTML = '';

      document.getElementById('novmonid').value = monid;

      document.getElementById('novappid').value = appid;

      document.getElementById('novdate').value = date;

      document.getElementById('novnameoffaci').value = name;

      document.getElementById('novtypeoffaci').value = type;

      document.getElementById('novteam').value = teamname;

      violation = violation.split('^ ');

      console.log('ywa');
      ast = ast.split(', ');


      var select = document.getElementById('novviolation');



      novmembers.open("GET", "{{asset('employee/dashboard/monitor/team/getMembersByNewTeamId')}}"+team, true);

      novmembers.send();







      while(select.firstChild) {

         select.removeChild(select.firstChild);

      }

  



      var first = document.createElement('option');

            first.setAttribute('selected', '');

            first.innerText='Select a Violation to View';

            first.setAttribute('hidden', '');

            first.setAttribute('readonly', '');

            first.setAttribute('disabled', '');

            first.setAttribute('value', '');

      select.appendChild(first);



      for(i=violation.length-1; i>=0; i--) {

         var option = document.createElement('option');

               option.setAttribute('value', ast[i]);

               option.innerText = violation[i];



         select.appendChild(option);

      }

   }



   function issueNOVu(monid, appid, date, name, type, ast, violation, team, teamname) {



      document.getElementById('unovmonid').value = monid;

      document.getElementById('unovappid').value = appid;

      document.getElementById('unovdate').value = date;

      document.getElementById('unovnameoffaci').value = name;

      document.getElementById('unovtypeoffaci').value = type;

      document.getElementById('unovteam').value = teamname;



      novmembersu.open("GET", "{{asset('employee/dashboard/monitor/team/getMembersByNewTeamId')}}"+team, true); //////////////////// web naka sunodZ  

      novmembersu.send();

   }



   function recommendationModal(monid, appid, date, name, type, nov) {

      document.getElementById('recmonid').value = monid;

      document.getElementById('recappid').value = appid;

      document.getElementById('recnameoffaci').value = name;

      document.getElementById('rectypeoffaci').value = type;

   }



   function urecommendationModal(monid, appid, date, name, type, nov) {

      document.getElementById('urecmonid').value = monid;

      document.getElementById('urecappid').value = appid;

      document.getElementById('urecnameoffaci').value = name;

      document.getElementById('urectypeoffaci').value = type;

   }



   function selectVio(dom, type) {

      var value = dom.value;

      var monid = document.getElementById('novmonid').value;

      // var url = 'employee/dashboard/monitor/getRemarks'+value

      if(type == "M"){

         violationRemark.open("GET", "{{asset('employee/dashboard/monitor/getRemarks')}}"+value+'/'+monid, true); //////////////////// web naka sunodZ  

         violationRemark.send();

      } else {

         violationRemark.open("GET", "{{asset('employee/dashboard/monitor/getRemarksByAstSurveillance')}}"+value+'/'+monid, true); //////////////////// web naka sunodZ  

         violationRemark.send();

      }



      violationDesc.open("GET", "{{asset('employee/dashboard/monitor/getRemarksDesc')}}"+value, true); //////////////////// web naka sunod  

      violationDesc.send();

   }   



   var violationRemark = new XMLHttpRequest();

   violationRemark.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         var vioRem = JSON.parse(this.responseText);

         

         if(vioRem == "") 

            document.getElementById('novremarks').value = '';

         else

            document.getElementById('novremarks').value = vioRem;

      }

   };



   var violationDesc = new XMLHttpRequest();

   violationDesc.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         var vioDesc = JSON.parse(this.responseText);

         if(vioDesc[0] == null) {

            $('#novsubdesc').summernote('code','Not Available');

            document.getElementById('novsubdesc').innerHTML = '';

         } else {

            $('#novsubdesc').summernote('code',vioDesc[0].asmt2sd_desc);

            // document.getElementById('novsubdesc').innerHTML= vioDesc[0].asmt2sd_desc;

            $('.note-toolbar').hide();

            $('#novsubdesc').summernote('disable');

         }

      }

   };



   var extras = new XMLHttpRequest();

   extras.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         var ex = JSON.parse(this.responseText);



         document.getElementById('extras').innerHTML=ex[0].rec_extra;

      }

   };



   var uextras = new XMLHttpRequest();

   uextras.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         var ex = JSON.parse(this.responseText);



         document.getElementById('uextras').innerHTML=ex[0].rec_extra;

      }

   };



   function recextra(dom){

      extras.open("GET", "{{asset('employee/dashboard/monitor/getRecommendation')}}"+dom.value, true);

      extras.send();

   }



   function urecextra(dom){

      uextras.open("GET", "{{asset('employee/dashboard/monitor/getRecommendation')}}"+dom.value, true);

      uextras.send();

   }



   function teamselect(dom) {

      teammembers.open("GET", "{{asset('employee/dashboard/monitor/getMembersByTeamId')}}"+dom.value, true);

      teammembers.send();

   }



   var novext = new XMLHttpRequest();

   novext.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         var ex = JSON.parse(this.responseText);



         document.getElementById('novextras').innerHTML=ex[0].novextra;

      }

   };



   var novextu = new XMLHttpRequest();

   novextu.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         var ex = JSON.parse(this.responseText);



         document.getElementById('unovextras').innerHTML=ex[0].novextra;

      }

   };



   function novextra(dom){

      novext.open("GET", "{{asset('employee/dashboard/monitor/getNovDirection')}}"+dom.value, true);

      novext.send();

   }



   function novextrau(dom){

      novextu.open("GET", "{{asset('employee/dashboard/monitor/getNovDirection')}}"+dom.value, true);

      novextu.send();

   }



   var teammembers = new XMLHttpRequest();

   teammembers.onreadystatechange = function() {

      if (this.readyState == 4 && this.status == 200) {

         // Typical action to be performed when the document is ready:

         var members = JSON.parse(this.responseText);



         var textarea = document.getElementById('selectmember');



         while(textarea.firstChild) {

            textarea.removeChild(textarea.firstChild);

         }



         for(i=0; i<members.length; i++) {

            var option = document.createElement('option'); 

            option.value=members[i].uid;

            option.innerText=members[i].fname+" "+members[i].lname;

            textarea.appendChild(option);

         }



      }

   };



   function showteam(teamid, teamname) {

      document.getElementById('steam').value=teamname;

      showteamB.open("GET", "{{asset('employee/dashboard/monitor/team/getMembersByNewTeamId')}}"+teamid, true);

      showteamB.send();

   }



   var showteamB = new XMLHttpRequest();

   showteamB.onreadystatechange = function() {

      if(this.readyState == 4 && this.status == 200) {

         var teamB = JSON.parse(this.responseText);

         // console.log(teamB);

         var textarea = document.getElementById('smember');



         while(textarea.firstChild) {

            textarea.removeChild(textarea.firstChild);

         }



         for(i=0; i<teamB.length; i++) {

            var option = document.createElement('option'); 

            option.value=teamB[i].uid;

            option.innerText=teamB[i].fname+" "+teamB[i].lname;

            textarea.appendChild(option);

         }

      }

   }



   // function addEmployee(type) {

   //    var employeeValue = (type == 'WT')?document.getElementById('newEmployee').value:document.getElementById('newEmployeeWO').value;

   //    // console.log(employeeValue);

   //    var tbody = document.getElementById('newTbody');

   //    var tbodychild = tbody.childElementCount;



   //    var wholename=employeeValue.substr(employeeValue.indexOf('/')+1);

   //          var temp = wholename.substr(wholename.indexOf('^'));

   //          wholename = wholename.substr(0, wholename.indexOf(temp));

   //    var uid = employeeValue.substr(0, employeeValue.indexOf('/'));

   //    var position = employeeValue.substr(employeeValue.indexOf('^')+1);



   //    var hiddeninput = document.getElementById('mon_addteammember');



   //    // Check if team is not blank

   //    if(document.getElementById('teams').value == "") {

   //       alert('Select a team');

   //       return;

   //    }



   //    // Check if member select is empty

   //    if(type == 'WT') {

   //       if(document.getElementById('newEmployee').value=="") {

   //          alert('Select an employee to add');

   //          return;

   //       }

   //    } else if (type == "WOT") {

   //       if(document.getElementById('newEmployeeWO').value=="") {

   //          alert('Select an employee to add');

   //          return;

   //       }

   //    }



   //    // Check if employee is already on the list.

   //    for(i=0; i<tbodychild; i++) {

   //       if(tbody.children[i].id == employeeValue.substr(0, employeeValue.indexOf('/'))) {

   //          alert('Selected Employee is already in the list.');

   //          return;

   //       }

   //    }



   //    var tr = document.createElement('TR');

   //          tr.setAttribute('id', employeeValue.substr(0, employeeValue.indexOf('/')));



   //    var td1 = document.createElement('TD');

   //          // td1.innerText = employeeValue.substr(employeeValue.indexOf('/')+1);

   //          // var temp = td1.innerText.substr(td1.innerText.indexOf('^'));

   //          // td1.innerText = td1.innerText.substr(0, td1.innerText.indexOf(temp));

   //          td1.innerText=wholename;

   //          td1.setAttribute('style', 'color: green; font-weight: bold');

   //          tr.appendChild(td1);



   //    var td2 = document.createElement('TD');

   //          // var textarea = document.createElement('TEXTAREA');

   //          //       textarea.setAttribute('class', 'form-control w-100');

   //          //       textarea.setAttribute('name', 'empremarks'+tbodychild);

   //          //       textarea.setAttribute('rows', '2');

   //          //       td2.appendChild(textarea);



   //          // var hiddeninput = document.createElement('INPUT');

   //          //       hiddeninput.setAttribute('type', 'hidden');

   //          //       hiddeninput.setAttribute('hidden', '');

   //          //       hiddeninput.setAttribute('name', 'emp'+tbodychild);

   //          //       hiddeninput.setAttribute('value', uid);

   //          //       td2.appendChild(hiddeninput);



   //          tr.appendChild(td2);



   //    var td3 = document.createElement('TD');

   //          td3.setAttribute('class', 'text-center');

   //          var div = document.createElement('DIV');

   //                div.setAttribute('class', 'btn-group');

   //                div.setAttribute('role', 'group');

   //                   var infobtn = document.createElement('BUTTON');

   //                         infobtn.setAttribute('type', 'button');

   //                         infobtn.setAttribute('style', 'width: 36px;');

   //                         infobtn.setAttribute('class', 'btn btn-outline-info');

   //                         infobtn.setAttribute('title', 'Position: '+position);

   //                         infobtn.setAttribute('data-toggle', 'popover');

   //                         infobtn.setAttribute('data-placement', 'top');

   //                         infobtn.setAttribute('data-content', 'Position: '+position);

   //                         var ifirst = document.createElement('I');

   //                               ifirst.setAttribute('class', 'fa fa-info');

   //                               infobtn.appendChild(ifirst);

   //                         div.appendChild(infobtn);

   //                   var delbtn = document.createElement('BUTTON');

   //                         delbtn.setAttribute('type', 'button');

   //                         delbtn.setAttribute('class', 'btn btn-outline-danger');

   //                         delbtn.setAttribute('style', 'width: 36px;');

   //                         delbtn.setAttribute('title', 'Delete from list');

   //                         delbtn.setAttribute('onclick', "$('#"+employeeValue.substr(0, employeeValue.indexOf('/'))+"').remove();");

   //                         var isecond = document.createElement('I');

   //                               isecond.setAttribute('class', 'fa fa-trash');

   //                               delbtn.appendChild(isecond);

   //                         div.appendChild(delbtn);

   //                   td3.appendChild(div);

   //             tr.appendChild(td3);

   //       tbody.appendChild(tr);



   //       // apending the member in the hidden text

   //       // hiddeninput.value += uid + ",";

   //       // hiddeninput.value = hiddeninput.value.substr(0, hiddeninput.value.length-1);

   // }



   function showLOE(loe) {

      document.getElementById('loehtml').innerHTML = loe;

   }



   function recextrachange(dom) {

      vid = document.getElementById('recvselect').value;

      recext.open("GET", "{{asset('employee/dashboard/monitor/getVerdict')}}"+vid, true);

      recext.send();

   }



   function urecextrachange(dom) {

      vid = document.getElementById('urecvselect').value;

      urecext.open("GET", "{{asset('employee/dashboard/monitor/getVerdict')}}"+vid, true);

      urecext.send();

   }



   var recext = new XMLHttpRequest();

   recext.onreadystatechange = function() {

      if(this.readyState == 4 && this.status == 200) {

         var ex = JSON.parse(this.responseText);

         document.getElementById('recextra').innerHTML = ex[0].vdescextra;

      }

   }



   var urecext = new XMLHttpRequest();

   urecext.onreadystatechange = function() {

      if(this.readyState == 4 && this.status == 200) {

         var ex = JSON.parse(this.responseText);

         

         document.getElementById('urecextra').innerHTML = ex[0].vdescextra;

      }

   }

      

</script>



<script type="text/javascript">

   $(function () {

      $('[data-toggle="popover"]').popover();

      $('[data-toggle="popover"]').popover();

      $('[data-toggle="tooltip"]').tooltip();

    })

</script>

