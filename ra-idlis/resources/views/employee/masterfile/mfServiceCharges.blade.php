	@if (session()->exists('employee_login'))
	@extends('mainEmployee')
	@section('title', 'Service Charges Master File')
	@section('content')
	<input type="text" id="CurrentPage" hidden="" value="">
	<div class="content p-4">
		<datalist id="rgn_list">
			@if (isset($apptype))
				@foreach ($apptype as $apptypes)
					<option value="{{$apptypes->aptid}}">{{$apptypes->aptdesc}}</option>
				@endforeach
			@endif
		</datalist>
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				Service Charges <span class=""><a href="#" title="Add New Service Charge" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
				<div style="float:right;display: inline-block;">
					<form class="form-inline">
						 <label>Filter : &nbsp;</label>
						 <select  id="filterer1" class="form-control" onchange="getServices2();">
						 	@isset($facilities)
								<option value="">Select Application Type...</option>
									@foreach($facilities as $s)
										<option value="{{$s->hfser_id}}">{{$s->hfser_desc}} ({{$s->hfser_id}})</option>
									@endforeach
								@else
								<option value="">No registered Application Type</option>
							@endisset
						 </select> &nbsp;
						 {{-- <select id="filterer2" class="form-control" onchange="getServiceCharges();"><option value=""></option></select> --}}
					</form>
				</div>
			</div>
			<div class="card-body">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th style="width: auto">Application Type</th>
							<th style="width: auto">FACID</th>
							<th style="width: auto">CHARGE ID</th>
							<th style="width: auto">Code</th>
							<th style="width: auto">Type</th>
							<th style="width: auto">Service</th>
							<th style="width: auto">Amount</th>
							<th style="width: auto">Institutional Character</th>
							<th style="width: auto">Hospital Level</th>
							<th style="width: 25%"><center>Options</center></th>
						</tr>
					</thead>
					<tbody>
						{{-- @if (isset($apptype))
							@foreach ($apptype as $apptypes)
							<tr>
								<td scope="row"> {{$apptypes->apt_seq}}</td>
								<td scope="row"> {{$apptypes->aptid}}</td>
								<td scope="row"> {{$apptypes->aptid}}</td>
								<td>{{$apptypes->aptdesc}}</td>
								<td>
									@isset($apptypes->apt_reqid)
										<strong>{{$apptypes->apt_req_name}}</strong>
									@else
									None
									@endisset
								</td>
								<td>
									@isset($apptypes->apt_isUpdateTo)
										<strong>{{$apptypes->apt_upd_name}}</strong>
									@else
									None
									@endisset
								</td>
								<td>
								<center>
									<span class="AP002_update">
									<button type="button" class="btn btn-outline-warning" onclick="showData('{{$apptypes->aptid}}', '{{$apptypes->aptdesc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>
									</span>
								<span class="AP002_cancel">
									<button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$apptypes->aptid}}', '{{$apptypes->aptdesc}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
									</span>
								</center>
								</td>
							</tr>
							@endforeach
						@endif --}}
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{{-- Add --}}
	<div class="modal fade " id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body text-justify" >
					<h5 class="modal-title text-center"><strong>Add New Service Charge</strong></h5>
					<hr>
					<div class="container">
						<form id="addRgn" class="row"  data-parsley-validate>
							{{ csrf_field() }}
							<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
								<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
								<button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div> 
							<div class="col-sm-4">Application Type:<span class="text-danger">*</span></div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" id="faciType" class="form-control" data-parsley-required-message="*<strong>Facility Type</strong> required" required>
								@isset($facilities)
									<option value="">Select Application Type...</option>
										@foreach($facilities as $s)
											<option value="{{$s->hfser_id}}">{{$s->hfser_desc}} ({{$s->hfser_id}})</option>
										@endforeach
									@else
									<option value="">No registered Application Type</option>
								@endisset
								</select>
							</div>
							<div class="col-sm-4">Facility:<span class="text-danger">*</span></div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" id="new_faci" class="form-control" onchange="getServices();" data-parsley-required-message="*<strong>Facility</strong> required" required>
								@isset($faci)
									<option value="">Select Facility...</option>
										@foreach($faci as $s)
											<option value="{{$s->hgpid}}">{{$s->hgpdesc}}</option>
										@endforeach
									@else
									<option value="">No registered Facility</option>
								@endisset
								</select>
							</div>
							<div class="col-sm-4">Services:<span class="text-danger">*</span></div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" id="new_serv" class="form-control" data-parsley-required-message="*<strong>Services</strong> required" required>
									<option value=""></option>
								</select>
							</div>
							<div class="col-sm-4">Institutional Character:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" id="ic" class="form-control">
									<option value>Please select</option>
									@foreach($facmode as $fac)
									<option value="{{$fac->facmid}}">{{$fac->facmdesc}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-4">Hospital Level:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" id="extrahgpid" class="form-control">
									<option value>Please select</option>
									@foreach($hosp as $h)
									<option value="{{$h->facid}}">{{$h->facname}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-sm-4">Order of Payment:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" id="new_oop" class="form-control" onchange="getCharges();" required>
									@isset($oop)
									<option value="">Select Order of Payment...</option>
										@foreach($oop as $s)
											<option value="{{$s->oop_id}}">{{$s->oop_desc}}</option>
										@endforeach
									@else
									<option value="">No registered Order of Payment</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-4">Charge Code:<span class="text-danger">*</span></div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgn_desc" list="codelist" class="form-control" data-parsley-required-message="*<strong>Charge</strong> required" onchange="getChargeDetails();" required>
								<datalist id="codelist"></datalist>
							</div>
							<div class="col-sm-4">Charge Description:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_chg_desc" class="form-control" data-parsley-required-message="*<strong>Charge</strong> required" disabled>
							</div>
							<div class="col-sm-4">Charge Explanation:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<textarea type="text" rows="4" id="new_chg_exp" class="form-control" data-parsley-required-message="*<strong>Charge</strong> required" disabled></textarea>
							</div>
							<div class="col-sm-4">Charge Remarks:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_chg_rmks" class="form-control" data-parsley-required-message="*<strong>Charge</strong> required" disabled>
							</div>
							<div class="col-sm-4">Initial New Amt:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_chg_amt" class="form-control" data-parsley-required-message="*<strong>Charge</strong> required" disabled>
							</div>

							<div class="col-sm-4">Renewal Amount:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_chg_amt_renew" class="form-control" data-parsley-required-message="*<strong>Charge</strong> required" disabled>
							</div>

							<div class="col-sm-4">Renewable Period</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="renew_year" class="form-control" data-parsley-required-message="*<strong>Charge</strong> required" disabled>
							</div>

							<div class="col-sm-4">Penalty</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="checkbox" id="chk_penalty" class="form-control" data-parsley-required-message="*<strong>Charge</strong> required" >
							</div>

							{{-- <div class="col-sm-4">Update to:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" id="new_upd" class="form-control">
									@isset($isUpdate)
									<option value="">None</option>
										@foreach($isUpdate as $s)
											<option value="{{$s->aptid}}">{{$s->aptdesc}}</option>
										@endforeach
									@else
									<option value="">No registered Application Status</option>
									@endisset
								</select>
							</div> --}}
							<div class="col-sm-12">
								&nbsp;
							</div> 
							<div class="col-sm-12">
								<button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
							</div> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- Delete --}}
	<div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #272b30;color: white;">
					<h5 class="modal-title text-center"><strong>Delete Service Charge</strong></h5>
					<hr>
					<div class="container">
						<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
							<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
							<button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<span id="DelModSpan">
						</span>
						<hr>
						<div class="row">
							<div class="col-sm-6">
								<button type="button" onclick="deleteNow();" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Yes</button>
							</div> 
							<div class="col-sm-6">
								<button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>No</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable({
				// dom: 'Bfrtip',
				// buttons: ['csvHtml5', 'excelHtml5', 'pdfHtml5', 'print'],
			});
		} );
		function getCharges(){
			// employee/mf/get_manageChargesOOPFiltered
			var id = $('#new_oop').val();
			if(id != ''){
				$.ajax({
					url : '{{ asset('employee/mf/get_manageChargesOOPFiltered') }}',
					method : 'POST',
					data: { _token : $('#token').val(),id : id},
					success : function(data){
						$('#codelist').empty();
						if(data == 'NONE'){

						} else {
							if(data.data.length != 0){
								for (var i = 0; i < data.data.length; i++) {
									var d = data.data[i];
									d.chg_exp = (d.chg_exp == null) ? 'N/A' : d.chg_exp;
									d.chg_rmks = (d.chg_rmks == null) ? 'N/A' : d.chg_rmks;
									$('#codelist').append('<option value="'+d.chg_code+'-'+d.chgapp_id+'" selectedid="'+d.chgapp_id+'" selectedamt="'+d.amt+'" selectedexp="'+d.chg_exp+'" selectedrmks="'+d.chg_rmks+'">'+d.chg_desc+'</option>');
								}
							}
						}
					},
					error : function(a, b, c){
						console.log(c);
					}
				});
			} else {

			}
		}
		function getServices(){ // employee/mf/get_ServOneFaci
			var id = $('#new_faci').val();
			if(id != ''){
				$.ajax({
					url: '{{ asset('employee/mf/get_ServOneFaci2') }}',
					method: 'GET',
					data: {_token:$('#token').val(), id: id},
					success : function(data){
						if(data != 'ERROR') {
							$('#new_serv').empty();
							if (data.length != 0) { //  data[i]
								$('#new_serv').append('<option value="">Select Service...</option>');
								for (var i = 0; i < data.length; i++) {
									$('#new_serv').append('<option value="'+data[i].facid+'">' + data[i].facid + '-' + data[i].facname+'</option>');
								}
							} else {
								$('#new_serv').append('<option value="">No registered services...</option>');
							}
						} else if(data == 'ERROR'){

						}
					},
					error : function(a,b,c){

					}
				});
			} else {
				alert('No Facility selected..');
				$('#new_serv').empty();
			}
		}
		function getServices2(){ // employee/mf/get_ServOneFaci
			var id = $('#filterer1').val();
			if(id != ''){
				$.ajax({
					url: '{{ asset('employee/mf/get_ServOneFaci') }}',
					method: 'GET',
					data: {_token:$('#token').val(), id: id},
					success : function(data){
						if(data != 'ERROR') {
							$('#example').DataTable().clear().draw();
	  						if (data.length != 0) {
	  							for (var i = 0; i < data.length; i++) {
	  								var amt = numberWithCommas((data[i].amt != null ? data[i].amt : 0));
  									$('#example').DataTable()
		                            	.row
		                            	.add([
		                            			'<strong>'+data[i].hfser_id+'</strong>',
												'<strong>'+data[i].facid+'</strong>',
												'<strong>'+data[i].chgapp_id+'</strong>',
		                            			'<strong>'+data[i].chg_code+'</strong>',
		                            			data[i].hfser_desc,
		                            			data[i].facname,
		                            			amt + ' PHP',
		                            			data[i].facmdesc,
		                            			data[i].extrahgpid,
		                            			'<center>' +
		                            				'<span>' +
		                            					'<button  data-toggle="modal" data-target="#DelGodModal" onclick="showDelete('+data[i].id+',\''+data[i].chg_code+'\', \''+data[i].facname+'\')" class="btn btn-outline-danger" title="Remove Charge"><i class="fa fa-trash"></i></button>'+
		                            				'</span>' +
		                            			'</center>',
		                            		])
		                            	.draw();
	  							}
	  						} else {
	  							alert('No Charges in the selected Service.');
	  						}
							// $('#filterer2').empty();
							// if (data.length != 0) { //  data[i]
							// 	$('#filterer2').append('<option value="">Select Service...</option>');
							// 	for (var i = 0; i < data.length; i++) {
							// 		$('#filterer2').append('<option value="'+data[i].facid+'">'+data[i].facname+'</option>');
							// 	}
							// } else {
							// 	$('#filterer2').append('<option value="">No registered services...</option>');
							// }
						} else if(data == 'ERROR'){
							$('#ERROR_MSG2').show(100);
						}
					},
					error : function(a,b,c){

					}
				});
			} else {
				alert('No Facility selected..');
				$('#filterer').focus();
				$('#filterer2').empty();
			}
		}
		function getChargeDetails(){
			var id = $('#new_rgn_desc').val();
			if (id != '') {
				var selectedArray = id.split('-');
				var selectedLength = selectedArray.length - 1;
				var id = selectedArray[selectedLength];
				var selectedamt =  numberWithCommas($('#codelist option[selectedid="'+id+'"]').attr('selectedamt'));
				var selectedDesc = $('#codelist option[selectedid="'+id+'"]').text();
				var selectedExp = $('#codelist option[selectedid="'+id+'"]').attr('selectedexp'); // selectedrmks
				var selectedReMks = $('#codelist option[selectedid="'+id+'"]').attr('selectedrmks');
				$('#new_chg_amt').val(selectedamt+' PHP'); 
				$('#new_chg_desc').val(selectedDesc);
				$('#new_chg_exp').val(selectedExp);
				$('#new_chg_rmks').val(selectedReMks);
			} else {
				$('#new_chg_amt').val(''); 
				$('#new_chg_desc').val('');
				$('#new_chg_exp').val('');
				$('#new_chg_rmks').val('');
			}
		}
	 //	 function showData(id,desc){
	 //      $('#EditBody').empty();
	 //      $('#EditBody').append(
	 //          '<div class="col-sm-4">ID:</div>' +
	 //          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	 //            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
	 //          '</div>' +
	 //          '<div class="col-sm-4">Description:</div>' +
	 //          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	 //            '<input type="text" id="edit_desc" value="'+desc+'" data-parsley-required-message="<strong>*</strong>Description <strong>Required</strong>" placeholder="'+desc+'" class="form-control" required>' +
	 //          '</div>' + 
	 //          '<div class="col-sm-4">Required:</div>' 
	 //        );
	 //    }
	  	function getServiceCharges()
	  	{
	  		var service = $('#filterer2').val();
	  		if (service != '') 
	  		{
	  			$.ajax({
	  				url : '{{ asset('employee/mf/assessment/get_ServiceCharges') }}',
	  				method : 'GET',
	  				data : {_token : $('#token').val(), id : service},
	  				success : function(data){
	  					if (data != 'ERROR') {
	  						$('#example').DataTable().clear().draw();
	  						if (data.length != 0) {
	  							for (var i = 0; i < data.length; i++) {
	  								var amt = numberWithCommas(data[i].amt);
  									$('#example').DataTable()
		                            	.row
		                            	.add([
		                            			'<strong>'+data[i].chg_code+'</strong>',
		                            			data[i].chg_desc,
		                            			amt + ' PHP',
		                            			'<center>' +
		                            				'<span>' +
		                            					'<button  data-toggle="modal" data-target="#DelGodModal" onclick="showDelete('+data[i].id+',\''+data[i].chg_code+'\', \''+data[i].chg_desc+'\')" class="btn btn-outline-danger" title="Remove Charge"><i class="fa fa-trash"></i></button>'+
		                            				'</span>' +
		                            			'</center>',
		                            		])
		                            	.draw();
	  							}
	  						} else {
	  							alert('No Charges in the selected Service.');
	  						}
	  					} else {
	  						$('#ERROR_MSG2').show(100);
	  					}
	  				},
	  				error : function(a, b, c){
	  					$('#ERROR_MSG2').show(100);
	  					console.log(c);
	  				},
	  			});
	  		} 
	  		else {
	  				alert('No Service Selected');
	  				$('#filterer2').focus();
	  			}
	  	}
	    function showDelete (id,code, desc){
	        $('#DelModSpan').empty();
	        $('#DelModSpan').append(
	            '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + code + ' ('+desc+')</strong></span>?' +
	              // <input type="text" id="edit_desc2" class="form-control"  style="margin:0 0 .8em 0;" required>
	            '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
	            '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+code+'" hidden>'+
	            '</div>'
	          );
	    }
	    function deleteNow(){
	      var id = $("#toBeDeletedID").val();
	      var name = $("#toBeDeletedname").val();
	      $.ajax({
	        url : "{{ asset('employee/mf/assessment/del_ServiceCharges') }}",
	        method: 'POST',
	        data: {_token:$('#token').val(),id:id,mod_id : $('#CurrentPage').val()},
	        success: function(data){
	          if (data == 'DONE') {
	            alert('Successfully deleted '+name);
	            location.reload();
	          } else if (data == 'ERROR') {
	            $('#DelErrorAlert').show(100);
	          }
	        }, error : function (XMLHttpRequest, textStatus, errorThrown){
	            console.log(errorThrown);
	            $('#DelErrorAlert').show(100);
	        }
	      });
	    }
	    $('#addRgn').on('submit',function(event){
	        event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	        if (form.parsley().isValid()) {
	        	var faciType = $('#faciType').val();
	            var id = $('#new_rgn_desc').val();
				var selectedArray = id.split('-');
				var selectedLength = selectedArray.length - 1;
				var id2 = selectedArray[selectedLength];
	            var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
	            // var test = $.inArray(id,arr);
	            // if (test == -1) { // Not in Array
	                $.ajax({
	                  method: 'POST',
	                  data: {
	                    _token : $('#token').val(),
	                    faciType : faciType,
	                    id: id2,
	                    facid : $('#new_serv').val(),
	                    facmid: $("#ic").val(),
	                    extrahgpid : $("#extrahgpid").val()
	                  },
	                  success: function(data) {
	                    if (data == 'DONE') {
	                        alert('Successfully Added New Charge in Service.');
	                        location.reload();
	                    } else if (data == 'ERROR'){
	                      $('#AddErrorAlert').show(100);
	                    }
	                    else if(data == 'SAME')
	                    {
	                    	alert('Charge is already in the selected Service.');
			            	$('#new_rgn_desc').focus();
	                    }
	                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                      console.log(errorThrown);
	                      $('#AddErrorAlert').show(100);
	                  },
	              });
	            // } else {
	            //   alert('Application Status ID is already been taken');
	            //   $('#new_rgnid').focus();
	            // }
	        }
	    }); 
	    $('#EditNow').on('submit',function(event){
	      event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();  
	         if (form.parsley().isValid()) {
	           var x = $('#edit_name').val();
	           var y = $('#edit_desc').val();
	           $.ajax({
	              url: "{{ asset('employee/mf/save_appstatus') }}",
	              method: 'POST',
	              data : {_token:$('#token').val(),id:x,name:y,mod_id : $('#CurrentPage').val()},
	              success: function(data){
	                  if (data == "DONE") {
	                      alert('Successfully Edited Application Status');
	                      window.location.href = "{{ asset('/employee/dashboard/mf/appstatus') }}";
	                  } else if (data == 'ERROR') {
	                      $('#EditErrorAlert').show(100);
	                  }
	              }, error : function (XMLHttpRequest, textStatus, errorThrown){
	                  console.log(errorThrown);
	                  $('#EditErrorAlert').show(100);
	              }
	           });
	         }
	    });
	</script> 
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif