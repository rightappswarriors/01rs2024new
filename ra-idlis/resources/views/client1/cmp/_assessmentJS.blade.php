{{-- ///////////////////////  Lloyd - Nov 27 2018  //////////////////////////////////////// --}}
<script type="text/javascript">

	var regDom = document.getElementById('d_region');
	var regSelectedIndex = regDom.selectedIndex;

	var provDom = document.getElementById('d_prov');
	var provCount = provDom.childElementCount;

	var cmDom = document.getElementById('d_cm');
	var cmCount = cmDom.childElementCount;

	var brgyDom = document.getElementById('d_brgy');
	var brgyCount = brgyDom.childElementCount;
	
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
			// Typical action to be performed when the document is ready:

			var brgyData = JSON.parse(this.responseText);
			console.log(brgyData);

			while(brgyDom.firstChild) {
				brgyDom.removeChild(brgyDom.firstChild);
			}
			var node = document.createElement("option");
			node.setAttribute("hidden", "");
			node.setAttribute("disabled", "");
			node.setAttribute("selected", "");
			node.innerHTML="Barangay";
			brgyDom.appendChild(node);
			brgyDom.selected=0;

			for(i=0; i<brgyData.length; i++) {
				var node = document.createElement("option");
				node.setAttribute("value", brgyData[i]['brgyid']);
				node.setAttribute("id", brgyData[i]['cmid']);
				node.innerHTML=brgyData[i]['brgyname'];
				brgyDom.appendChild(node);
			}
	    }
	};
	
	function regionSelect() {
		// region
		if(regDom.value != "") {

			for(i=1; i<=provCount-1; i++) {
				if(provDom.children[i].id==regDom.value) {
					provDom.children[i].hidden=false;
				}
				else {
					provDom.selectedIndex=0;
					cmDom.selectedIndex=0;
					brgyDom.selected=0;
					provDom.children[i].hidden=true; //ends here
				}
			}

			for(i=1; i<cmCount-1; i++) {
				if(cmDom.children[i].id==provDom.value) {
					cmDom.children[i].hidden=false;
				}
				else {
					cmDom.selectedIndex=0;
					brgyDom.selected=0;
					cmDom.children[i].hidden=true;
				}
			}

			while(brgyDom.firstChild) {
				brgyDom.removeChild(brgyDom.firstChild);
			}
			var node = document.createElement("option");
			node.setAttribute("hidden", "");
			node.setAttribute("disabled", "");
			node.setAttribute("selected", "");
			node.innerHTML="Barangay";
			brgyDom.appendChild(node);
			brgyDom.selected=0;

		}
	}

	function provSelect() {
		// prov
		if(provDom.value != "") {

			for(i=1; i<cmCount-1; i++) {
				if(cmDom.children[i].id==provDom.value) {
					cmDom.children[i].hidden=false;
				}
				else {
					cmDom.selectedIndex=0;
					brgyDom.selected=0;
					cmDom.children[i].hidden=true;
				}
			}

			while(brgyDom.firstChild) {
				brgyDom.removeChild(brgyDom.firstChild);
			}
			var node = document.createElement("option");
			node.setAttribute("hidden", "");
			node.setAttribute("disabled", "");
			node.setAttribute("selected", "");
			node.innerHTML="Barangay";
			brgyDom.appendChild(node);
			brgyDom.selected=0;
		}
	}

	function cmSelect() {
		// cm
		if(cmDom.value != "") {
			xhttp.open("GET", "{{asset('employee/mf/barangay/getBarangayFiltered')}}"+cmDom.value, true);
			xhttp.send();
		} else {

		}
	}

	function a_button(dom) {
		var a_1=[], a_2=[], a_3=[];
		for(i=0; i<4; i++) {
			a_1[i] = document.getElementById('a_frist_'+i);
			a_1[i].disabled=true;
		}

		for(i=0; i<2; i++) {
			a_2[i] = document.getElementById('a_second_'+i);
			a_2[i].disabled=true;
		}

		for(i=0; i<1; i++) {
			a_3[i] = document.getElementById('a_third_'+i);
			a_3[i].disabled=true;
		}

		switch(dom.id) {
			case "a_first":
				for(i=0; i<a_1.length; i++) {
					if(dom.checked) {
						a_1[i].disabled=false;
					} else {
						a_1[i].disabled=true;
					}
				}
				break;

			case "a_second":
				for(i=0; i<a_2.length; i++) {
					if(dom.checked) {
						a_2[i].disabled=false;
					} else {
						a_2[i].disabled=true;
					}
				}
				break;

			case "a_third":
				for(i=0; i<a_3.length; i++) {
					if(dom.checked) {
						a_3[i].disabled=false;
					} else {
						a_3[i].disabled=true;
					}
				}
				break;
		}
	}

	function b_button(dom) {
		var b_1=[], b_2=[], b_3=[];
		for(i=0; i<1; i++) {
			b_1[i] = document.getElementById('b_first_'+i);
			b_1[i].disabled=true;
		}

		for(i=0; i<1; i++) {
			b_2[i] = document.getElementById('b_second_'+i);
			b_2[i].disabled=true;
		}

		for(i=0; i<1; i++) {
			b_3[i] = document.getElementById('b_third_'+i);
			b_3[i].disabled=true;
		}

		switch(dom.id) {
			case "b_first":
				for(i=0; i<b_1.length; i++) {
					if(dom.checked) {
						b_1[i].disabled=false;
					} else {
						b_1[i].disabled=true;
					}
				}
				break;

			case "b_second":
				for(i=0; i<b_2.length; i++) {
					if(dom.checked) {
						b_2[i].disabled=false;
					} else {
						b_2[i].disabled=true;
					}
				}
				break;

			case "b_third":
				for(i=0; i<b_3.length; i++) {
					if(dom.checked) {
						b_3[i].disabled=false;
					} else {
						b_3[i].disabled=true;
					}
				}
				break;
		}
	}

	function others_p(dom) {
		var textarea = document.getElementById('others_p_txt');

		if(dom.id == "others_p_rad") {
			if(dom.checked) {
				textarea.disabled = false;
			} else {
				textarea.value = "";
				textarea.disabled = true;
			}
		} else {
			textarea.value = "";
			textarea.disabled = true;
		}
	}

	function others_c(dom) {
		var textarea = document.getElementById('others_c_txt');
		var textareaP = document.getElementById('others_p_txt');
		var privates = document.getElementById('pv');

		if(dom.id == "others_c_rad") {
			if(dom.checked) {
				textarea.disabled = false;
			} else {
				textarea.value = "";
				textarea.disabled = true;
				textareaP.disabled = true;
			}
			privates.hidden = true;
		} else if(dom.id == "others_c_p") {
			privates.hidden = false;
		} else {
			textarea.value = "";
			textarea.disabled = true;
			textareaP.disabled = true;
			privates.hidden = true;
		}	
	}

</script>