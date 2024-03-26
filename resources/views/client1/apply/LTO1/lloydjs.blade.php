<script type="text/javascript">

	// function hfsrbChange(lString, asset) {
	// 	// static sets
	// 	document.getElementById('viewModalLabel').innerHTML = lString;

	// 	// global vars
	// 	var div = document.getElementById('viewAll');

	// 	// clear
	// 	while(div.firstChild) {
	// 		div.removeChild(div.firstChild);
	// 	}

	// 	switch(lString) {

	// 		case "LIST OF PERSONNEL (Annex A)":

	// 			//region span
	// 			var span = document.createElement('span');
	// 				span.setAttribute('id', 'viewModalHeader');

	// 			var addBtn = document.createElement('button');
	// 				addBtn.setAttribute('class', 'btn btn-primary mb-5');
	// 				addBtn.setAttribute('type', 'button');
	// 				addBtn.setAttribute('style', 'width:100px');
	// 				addBtn.setAttribute('data-toggle', 'modal');
	// 				addBtn.setAttribute('data-target', '#addModal');
	// 				addBtn.setAttribute('onclick', 'addTitle("NEW PERSONNEL (Do NOT include Pharmacy/X-Ray'+')", "'+asset+'")');
	// 				addBtn.setAttribute('id', 'addBtn');
	// 				addBtn.innerHTML='Add';
	// 				span.appendChild(addBtn);
	// 			//endregion span

	// 			//region table
	// 			var table = document.createElement('table');
	// 				table.setAttribute('class', 'table table-hover');
	// 				table.setAttribute('style', 'font-size: 13px')
	// 				table.setAttribute('id', 'tApp');

	// 			var thead = document.createElement('thead');
	// 				thead.setAttribute('style', 'background-color: #428bca; color: white')

	// 			var tr = document.createElement('tr');

	// 			var th1 = document.createElement('th');
	// 				th1.innerHTML = 'Surname';
	// 				tr.appendChild(th1);

	// 			var th2 = document.createElement('th');
	// 				th2.innerHTML = 'First Name';
	// 				tr.appendChild(th2);

	// 			var th3 = document.createElement('th');
	// 				th3.innerHTML = 'Middle Name';
	// 				tr.appendChild(th3);

	// 			var th4 = document.createElement('th');
	// 				th4.innerHTML = 'Profession*';
	// 				tr.appendChild(th4);

	// 			var th5 = document.createElement('th');
	// 				th5.innerHTML = 'PRC No.';
	// 				tr.appendChild(th5);

	// 			var th6 = document.createElement('th');
	// 				th6.innerHTML = 'Specialty';
	// 				tr.appendChild(th6);

	// 			var th7 = document.createElement('th');
	// 				th7.innerHTML = 'Date of Birth';
	// 				tr.appendChild(th7);

	// 			var th8 = document.createElement('th');
	// 				th8.innerHTML = 'Sex';
	// 				tr.appendChild(th8);

	// 			var th9 = document.createElement('th');
	// 				th9.innerHTML = 'Employment';
	// 				tr.appendChild(th9);
	// 				thead.appendChild(tr);

	// 			table.appendChild(thead);
	// 			div.appendChild(span);
	// 			div.appendChild(table);

	// 			data.open("GET", "{{asset('client1/apply/app/LTO/48/hfsrb/getAllAnnexA')}}", true);
 //      			data.send();

	// 			// var tbody = document.createElement('tbody');
	// 			// var tr2 = document.createElement('tr');
	// 			// for(i=0; i<9; i++) {
	// 			// 	var td = document.createElement('td');
	// 			// 		td.innerHTML="test";
	// 			// 		tr2.appendChild(td);
	// 			// }
	// 			// tbody.appendChild(tr2);
	// 			// table.appendChild(tbody);

	// 			//endregion table


	// 			//region add

	// 			//endregion add

	// 			break;
	// 	}

	// }

	// var data = new XMLHttpRequest();
 //   	data.onreadystatechange = function() {
 //    	if (this.readyState == 4 && this.status == 200) {
 //        	// Typical action to be performed when the document is ready:
 //        	var x = JSON.parse(this.responseText);

 //        	var table = document.getElementById('tApp');
 //        	var tbody = document.createElement('tbody');
 //        	var tr = document.createElement('tr');
        	
 //        	Array.from(x).forEach(function(v) {
 //        		var td = document.createElement('td');
 //        			td.innerHTML=v.surname;
 //        			tr.appendChild(td);

 //        		var td = document.createElement('td');
 //        			td.innerHTML=v.firstname;
 //        			tr.appendChild(td);

 //        		var td = document.createElement('td');
 //        			td.innerHTML=v.middlename;
 //        			tr.appendChild(td);

 //        		var td = document.createElement('td');
 //        			td.innerHTML=v.prof;
 //        			tr.appendChild(td);

 //        		var td = document.createElement('td');
 //        			td.innerHTML=v.prcno;
 //        			tr.appendChild(td);

 //        		var td = document.createElement('td');
 //        			td.innerHTML=v.speciality;
 //        			tr.appendChild(td);

 //        		var td = document.createElement('td');
 //        			td.innerHTML=v.dob;
 //        			tr.appendChild(td);

 //        		var td = document.createElement('td');
 //        			td.innerHTML=v.sex;
 //        			tr.appendChild(td);

 //        		var td = document.createElement('td');
 //        			td.innerHTML=v.employement;
 //        			tr.appendChild(td);
 //        	});

 //        	tbody.appendChild(tr);
 //        	table.appendChild(tbody);
 //      	}
 //   	};

	// function addTitle(title, asset) {

	// 	// static
	// 	document.getElementById('addModalLabel').innerText = title;

	// 	// globals
	// 	var div = document.getElementById('addAll');

	// 	// clear
	// 	while(div.firstChild) {
	// 		div.removeChild(div.firstChild);
	// 	}

	// 	switch(title) {

	// 		case "NEW PERSONNEL (Do NOT include Pharmacy/X-Ray)":

	// 			var form = document.createElement('form');
	// 				form.setAttribute('method', 'POST');
	// 				form.setAttribute('action', asset);
	// 				form.setAttribute('id', 'form');
	// 				form.setAttribute('data-parsley-validate' , '');
	// 				form.setAttribute('novalidate' , '');

	// 			var container = document.createElement('div');
	// 				container.setAttribute('class', 'container');

	// 			var row = document.createElement('div');
	// 				row.setAttribute('class', 'row mb-3');

	// 			var col = document.createElement('div');
	// 				col.setAttribute('class', 'col-sm-12');

	// 			var b = document.createElement('b');
	// 				b.innerHTML="Basic Information";

	// 			var csrf = document.getElementsByName('_token')[0];
	// 			var appid = document.getElementById('appid');


	// 				col.appendChild(b);
	// 				row.appendChild(col);
	// 				container.appendChild(row);

	// 					row.setAttribute('class', 'row mb-2');
	// 						col.setAttribute('class', 'col-sm-12');
	// 						col.innerHTML="<b>Basic Information</b>";
	// 					row.appendChild(col);
	// 				container.appendChild(row);

	// 					var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="First Name:";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var input2 = document.createElement('input');
	// 								input2.setAttribute('class', 'form-control w-100');
	// 								input2.setAttribute('name', 'add_fname');
	// 								input2.setAttribute('required', '');
	// 								input2.setAttribute('data-parsley', '');
	// 								input2.setAttribute('data-parsley-required-message', '<b>*First Name</b> required');
	// 						col2.appendChild(input2);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="Middle Name:";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var input2 = document.createElement('input');
	// 								input2.setAttribute('class', 'form-control w-100');
	// 								input2.setAttribute('name', 'add_mname');
	// 								input2.setAttribute('required', '');
	// 								input2.setAttribute('data-parsley', '');
	// 								input2.setAttribute('data-parsley-required-message', '<b>*Middle Name</b> required');
	// 							col2.appendChild(input2);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="Surname:";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var input2 = document.createElement('input');
	// 								input2.setAttribute('class', 'form-control w-100');
	// 								input2.setAttribute('name', 'add_lname');
	// 								input2.setAttribute('required', '');
	// 								input2.setAttribute('data-parsley', '');
	// 								input2.setAttribute('data-parsley-required-message', '<b>*Last Name</b> required');
	// 							col2.appendChild(input2);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="Sex:";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var col3 = document.createElement('div');
	// 								col3.setAttribute('class', 'custom-control custom-radio custom-control-inline');
	// 								var input2 = document.createElement('input');
	// 									input2.setAttribute('type', 'radio');
	// 									input2.setAttribute('id', 'customRadioInline1');
	// 									input2.setAttribute('name', 'add_sex');
	// 									input2.setAttribute('value', 'Male');
	// 									input2.setAttribute('class', 'custom-control-input');
	// 									input2.setAttribute('required', '');
	// 									input2.setAttribute('data-required', 'true');
	// 									input2.setAttribute('data-parsley-required-message', '<b>*Sex</b> required');
	// 								var label = document.createElement('label');
	// 									label.setAttribute('class', 'custom-control-label');
	// 									label.setAttribute('for', 'customRadioInline1');
	// 									label.innerHTML="Male";
	// 								col3.appendChild(input2);
	// 								col3.appendChild(label);
	// 							var col4 = document.createElement('div');
	// 								col4.setAttribute('class', 'custom-control custom-radio custom-control-inline');
	// 								var input3 = document.createElement('input');
	// 									input3.setAttribute('type', 'radio');
	// 									input3.setAttribute('id', 'customRadioInline2');
	// 									input3.setAttribute('name', 'add_sex');
	// 									input2.setAttribute('value', 'Female');
	// 									input3.setAttribute('class', 'custom-control-input');
	// 									input3.setAttribute('required', '');
	// 									input3.setAttribute('data-required', 'true');
	// 									input3.setAttribute('data-parsley-required-message', '<b>*Sex Name</b> required');
	// 								var label1 = document.createElement('label');
	// 									label1.setAttribute('class', 'custom-control-label');
	// 									label1.setAttribute('for', 'customRadioInline2');
	// 									label1.innerHTML="Female";
	// 								col4.appendChild(input3);
	// 								col4.appendChild(label1);
	// 							col2.appendChild(col3);
	// 							col2.appendChild(col4);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="Date of Birth:";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var input2 = document.createElement('input');
	// 								input2.setAttribute('class', 'form-control w-100');
	// 								input2.setAttribute('name', 'add_bdate');
	// 								input2.setAttribute('type', 'date');
	// 								input2.setAttribute('required', '');
	// 								input2.setAttribute('data-required', 'true');
	// 								input2.setAttribute('data-parsley-required-message', '<b>*Date of Birth</b> required');
	// 							col2.appendChild(input2);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="Profession:";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var select = document.createElement('select');
	// 								select.setAttribute('class', 'form-control w-100');
	// 								select.setAttribute('name', 'add_profession');
	// 								select.setAttribute('id', 'add_profession');
	// 								select.setAttribute('required', '');
	// 								select.setAttribute('data-required', 'true');
	// 								select.setAttribute('data-parsley-required-message', '<b>*Profession</b> required');
	// 							col2.appendChild(select);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				container.appendChild(document.createElement('hr'));

	// 				var row = document.createElement('div');
	// 					row.setAttribute('class', 'row mb-2');
	// 					var col = document.createElement('div');
	// 						col.setAttribute('class', 'col-sm-12');
	// 						col.innerHTML="<b>Educational Background</b>";
	// 					row.appendChild(col);
	// 				container.appendChild(row);

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="Highest Education Attainment:";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var input2 = document.createElement('input');
	// 								input2.setAttribute('class', 'form-control w-100');
	// 								input2.setAttribute('name', 'add_highestatt');
	// 								input2.setAttribute('required', '');
	// 								input2.setAttribute('data-required', 'true');
	// 								input2.setAttribute('data-parsley-required-message', '<b>*Highest Education Attainment</b> required');
	// 							col2.appendChild(input2);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="Specialty Board Certificate (for physicians), specify (if applicable):";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var input2 = document.createElement('input');
	// 								input2.setAttribute('class', 'form-control w-100');
	// 								input2.setAttribute('name', 'add_specialty');
	// 							col2.appendChild(input2);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				container.appendChild(document.createElement('hr'));

	// 				var row = document.createElement('div');
	// 					row.setAttribute('class', 'row mb-2');
	// 					var col = document.createElement('div');
	// 						col.setAttribute('class', 'col-sm-12');
	// 						col.innerHTML="<b>PRC</b>";
	// 					row.appendChild(col);
	// 				container.appendChild(row);

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="PRC No.:";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var input2 = document.createElement('input');
	// 								input2.setAttribute('class', 'form-control w-100');
	// 								input2.setAttribute('name', 'add_prcno');
	// 								input2.setAttribute('required', '');
	// 								input2.setAttribute('data-required', 'true');
	// 								input2.setAttribute('data-parsley-required-message', '<b>*PRC No.</b> required');
	// 							col2.appendChild(input2);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				// var row1 = document.createElement('div');
	// 				// 	row1.setAttribute('class', 'row mb-2');
	// 				// 		var col1 = document.createElement('div');
	// 				// 			col1.setAttribute('class', 'col-sm-12');
	// 				// 			col1.innerHTML="Valid until:";
	// 				// 	row1.appendChild(col1);
	// 				// 		var col2 = document.createElement('div');
	// 				// 			col2.setAttribute('class', 'col-sm-6');
	// 				// 			var input2 = document.createElement('input');
	// 				// 				input2.setAttribute('class', 'form-control w-100');
	// 				// 				input2.setAttribute('name', 'add_validity');
	// 				// 				input2.setAttribute('type', 'date');
	// 				// 				input2.setAttribute('required', '');
	// 				// 				input2.setAttribute('data-required', 'true');
	// 				// 				input2.setAttribute('data-parsley-required-message', '<b>*Validity</b> required');
	// 				// 			col2.appendChild(input2);
	// 				// 	row1.appendChild(col2);
	// 				// container.appendChild(row1);

	// 				container.appendChild(document.createElement('hr'));

	// 				var row = document.createElement('div');
	// 					row.setAttribute('class', 'row mb-2');
	// 					var col = document.createElement('div');
	// 						col.setAttribute('class', 'col-sm-12');
	// 						col.innerHTML="<b>Employment</b>";
	// 					row.appendChild(col);
	// 				container.appendChild(row);

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="Status:";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var select = document.createElement('select');
	// 								select.setAttribute('class', 'form-control w-100');
	// 								select.setAttribute('name', 'add_status');
	// 								select.setAttribute('id', 'add_status');
	// 								select.setAttribute('required', '');
	// 								select.setAttribute('data-required', 'true');
	// 								select.setAttribute('data-parsley-required-message', '<b>*Status</b> required');
	// 							col2.appendChild(select);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 				container.appendChild(document.createElement('hr'));

	// 				var row1 = document.createElement('div');
	// 					row1.setAttribute('class', 'row mb-2');
	// 						var col1 = document.createElement('div');
	// 							col1.setAttribute('class', 'col-sm-12');
	// 							col1.innerHTML="&nbsp;";
	// 					row1.appendChild(col1);
	// 						var col2 = document.createElement('div');
	// 							col2.setAttribute('class', 'col-sm-6');
	// 							var button = document.createElement('button');
	// 								button.setAttribute('class', 'btn btn-success w-100');
	// 								button.setAttribute('type', 'submit');
	// 								button.innerHTML='SUBMIT';
	// 							col2.appendChild(button);
	// 					row1.appendChild(col2);
	// 				container.appendChild(row1);

	// 			form.appendChild(csrf);
	// 			form.appendChild(appid);
	// 			form.appendChild(container);
	// 			div.appendChild(form);

	// 			prof.open("GET", "{{asset('client1/apply/app/LTO/48/hfsrb/getAllProfessions')}}", true);
 //      			prof.send();

 //      			emp.open("GET", "{{asset('client1/apply/app/LTO/48/hfsrb/getAllEmploymentStatus')}}", true);
 //      			emp.send();

	// 			break;
	// 	}
	// }

	// // Anex A

	// var prof = new XMLHttpRequest();
 //   	prof.onreadystatechange = function() {
 //    	if (this.readyState == 4 && this.status == 200) {
 //        	// Typical action to be performed when the document is ready:
 //        	var x = JSON.parse(this.responseText);

 //        	var select = document.getElementById('add_profession');
 //        	var opt = document.createElement('option');
 //        		opt.setAttribute('hidden', '');
 //        		opt.setAttribute('selected', '');
 //        		opt.setAttribute('disabled', '');
 //        		opt.setAttribute.innerHTML="";
 //        		select.appendChild(opt);
        	
 //        	Array.from(x).forEach(function(v) {
 //        		var option = document.createElement('option');
 //        			option.setAttribute('value', v.pworkid);
 //        			option.innerText=v.pworkname;
 //        		select.appendChild(option);
 //        	});
 //      	}
 //   };

 //    var emp = new XMLHttpRequest();
 //   	emp.onreadystatechange = function() {
 //    	if (this.readyState == 4 && this.status == 200) {
 //        	// Typical action to be performed when the document is ready:
 //        	var x = JSON.parse(this.responseText);

 //        	var select = document.getElementById('add_status');
 //        	var opt = document.createElement('option');
 //        		opt.setAttribute('hidden', '');
 //        		opt.setAttribute('selected', '');
 //        		opt.setAttribute('disabled', '');
 //        		opt.setAttribute.innerHTML="";
 //        		select.appendChild(opt);
        	
 //        	Array.from(x).forEach(function(v) {
 //        		var option = document.createElement('option');
 //        			option.setAttribute('value', v.pworksid);
 //        			option.innerText=v.pworksname;
 //        		select.appendChild(option);
 //        	});
 //      	}
 //   	};

</script>