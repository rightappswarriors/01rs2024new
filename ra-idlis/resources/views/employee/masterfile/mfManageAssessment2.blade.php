@if (session()->exists('employee_login'))
	@extends('mainEmployee')
	@section('title', 'Manage Assessment Master File')
	@section('content')
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				Manage Assessment <a href="#" title="Add New Assessment" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
				<div style="float:right;display: inline-block;">
					<form class="form-inline">
						<label>Filter : &nbsp;</label>
							<select name="" class="form-control" id="filterer0">
								<option value="">Select Application Type</option>
								<option value="1">Technical Requirements</option>
								<option value="0">Checklist</option>
							</select> &nbsp;
							<select style="width: auto;" class="form-control" id="filterer" onchange="filterGroup()">
								<option value="">Select Application Type ...</option>
								@if(isset($hfaci_serv_type))
									@foreach ($hfaci_serv_type as $owns)
										<option value="{{$owns->hfser_id}}">{{$owns->hfser_desc}}</option>
									@endforeach
								@endif
							</select> &nbsp;
							<select style="width: auto;" class="form-control" id="filterer1" onchange="filterGroup1()">
								<option value="">Select Facility ...</option>
							</select> &nbsp;
							<select style="width: auto;" class="form-control" id="filterer2" onchange="filterGroup2()">
								<option value="">Select Service ...</option>
							</select>
					</form>
				</div>
			</div>
			<div class="card-body">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th style="width: auto"><center>Code</center></th>
							<th style="width: auto"><center>Part</center></th>
							<th style="width: auto"><center>Header</center></th>
							<th style="width: 30%">Description</th>
							<th style="width: auto"><center>#</center></th>
							<th style="width: auto"><center>Options</center></th>
						</tr>
					</thead>
					<tbody id="FilterdBody">
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{{-- Add --}}
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #272b30;color: white;">
					<h5 class="modal-title text-center"><strong>Add New Assessment in Facility</strong></h5>
					<hr>
					<div class="container">
						<form class="row" id="addCls" data-parsley-validate>
							{{ csrf_field() }}
							<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
								<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
								<button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="col-sm-4">Application Type:<span class="text-danger">*</span></div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="OCID" data-parsley-required-message="*<strong>Application Type</strong> required" onchange="getFacilities()" class="form-control" required>  
								@if(isset($hfaci_serv_type))
									<option value="">Select Application Type..</option>
									@foreach ($hfaci_serv_type as $owns)
										<option value="{{$owns->hfser_id}}">{{$owns->hfser_desc}}</option>
									@endforeach
								@else
									<option value="">No Application Type registered..</option>
								@endif
								</select>
							</div>
							<div class="col-sm-4">Assessment Type:<span class="text-danger">*</span></div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select name="" data-parsley-required-message="*<strong>Assessment Type</strong> required" class="form-control" id="new_type" required="">
									<option value="">Select Assessment Type..</option>
									<option value="1">Technical Requirements</option>
									<option value="0">Checklist</option>
								</select>
							</div>
							<div class="col-sm-4">Facility:<span class="text-danger">*</span></div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="OCID1" data-parsley-required-message="*<strong>Facility</strong> required" onchange="getServices();" class="form-control" required>  
									<option value=""></option>
								</select>
							</div>
							<div class="col-sm-4">Service:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="OCID2" data-parsley-required-message="*<strong>Service</strong> required" class="form-control">  
									<option value=""></option>								
								</select>
							</div>
							<div class="col-sm-4">Part:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="new_part" class="form-control">
									@isset($part)
										<option value="">Select Part..</option>
										@foreach ($part as $p)
											<option value="{{$p->title_code}}">{{$p->title_name}}</option>
										@endforeach
									@else
										<option value="">No Part currently registered.</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-4">Assessment Column:<span class="text-danger">*</span> <span class="btn button-outline-primary" data-toggle="tooltip" title="Hold <code>Ctrl</code> as you click to select multiple Assessment Column" data-html="true" style="cursor: pointer"><i class="fa fa-question-circle" aria-hidden="true"></i></span></div>	
							<script type="text/javascript">$('[data-toggle="tooltip"]').tooltip();</script>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<select id="new_column" data-parsley-required-message="*<strong>Column</strong> required"" class="form-control" required multiple>
									@isset($colmn)
										@foreach ($colmn as $e)
											<option value="{{$e->asmt2c_id}}">{{$e->asmt2c_desc}} ({{$e->asmt2c_type}})</option>
										@endforeach
									@else
										<option value="">No Column registered.</option>
									@endisset
								</select>
							</div>
							<div class="col-sm-4">Has Remarks?</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<center>
									<input class="form-control" type="checkbox" value="" id="defaultCheck1">
								</center> 
							</div>
							<div class="col-sm-4">Assessment Code:<span class="text-danger">*</span></div>
							<div class="col-sm-8"  style="margin:0 0 .8em 0;">
								<input type="text" id="new_rgnid" list="test"  onchange="GetSingleAssessment()" data-parsley-required-message="*<strong>Assessment</strong> required" name="fname" class="form-control" required>
									<datalist id="test" hidden="">
										@isset ($asments)
											<option value="">Select Assessment Code:</option>
											@foreach ($asments as $e)
												<option value="{{$e->asmt2_id}}">{{$e->asmt2_desc}}</option> {{-- {{$e->asmt2_id}} -  --}}
											@endforeach
										@else
											<option value="">No Assessment registered.</option>
										@endisset
									</datalist>
							</div>
							{{-- <div class="col-sm-4">Assessment Title:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_title" class="form-control" disabled>
							</div> --}}
							<div class="col-sm-4">Assessment Header:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="new_header" class="form-control" disabled>
							</div>
							<div class="col-sm-4">Assessment Description:</div>
							<div class="col-sm-8" style="margin:0 0 .8em 0;">
								<input type="text" id="newDesc" class="form-control" disabled>
							</div>
							<div class="col-sm-12">Assessment Sub-Description:</div>
							<div class="col-sm-12" style="margin:0 0 .8em 0;">
								<textarea rows="5" id="newSubDesc" class="form-control" disabled></textarea>
							</div>
							<div class="col-sm-12">
								<button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
							</div> 
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="DelGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content" style="border-radius: 0px;border: none;">
		    <div class="modal-body" style=" background-color: #272b30;color: white;">
		      <h5 class="modal-title text-center"><strong>Delete Assessment from Facility</strong></h5>
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
	<div class="modal fade" id="ViewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="border-radius: 0px;border: none;">
        <div class="modal-body" style=" background-color: #272b30;
      color: white;">
          <h5 class="modal-title text-center"><strong>Assessment Information</strong></h5>
          <hr>
          <div class="container">
            <form  class="row" >
              <div class="col-sm-12" id="Error">
              </div>
              <div class="col-sm-4">Application Type:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewAppType" style="font-weight: bold;text-align: center"></span>
              </div>
              <div class="col-sm-4">Facility:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewFacility" style="font-weight: bold;text-align: center"></span>
              </div>
              <div class="col-sm-4">Service:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewService" style="font-weight: bold;text-align: center"></span>
              </div>
              <div class="col-sm-4">Code:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewAsmtCode" style="font-weight: bold;text-align: center"></span>
              </div>
              <div class="col-sm-4">Part:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewAsmtTitle" style="font-weight: bold;text-align: center"></span>
              </div>
              <div class="col-sm-4">Header:</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewAsmtHeader" style="font-weight: bold;text-align: center"></span>
              </div>
              <div class="col-sm-4"> Description</div>
              <div class="col-sm-8" style="margin:0 0 .8em 0;">
                <span id="ViewAsmtDesc" style="font-weight: bold;text-align: center"></span>
              </div>
              <div class="col-sm-12">Sub-Description:</div>
              <div class="col-sm-12" style="margin:0 0 .8em 0;">
                <textarea class="form-control" id="ViewSubDesc" ></textarea>
              </div>
              <div class="col-sm-12">
                <hr>
                <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
              </div> 
            </form>
         </div>
        </div>
      </div>
    </div>
  </div>
	<script type="text/javascript">
		$(function(){
	        var levels = ['OCID','new_type','OCID1','OCID2','new_part','new_column','defaultCheck1'];
	        levels.forEach( function(element) {
	          if(sessionStorage.getItem(element) != null){
	            var level = sessionStorage.getItem(element);
	            $("#"+element).val(level).trigger("change");
	          }
	        });
	        $('#OCID,#new_type,#OCID1,#OCID2,#new_part,#new_column,#defaultCheck1').change(function() { 
	          var dropVal = $(this).val();
	          sessionStorage.setItem($(this).attr('id'), dropVal);
	    	});
	    })
		$(document).ready(function() {
	         $('#example').DataTable();
	    });
	    function filterGroup(){ //filterer0
	        var id = $('#filterer').val();
	        var token = $('#token').val();
	        var apptype = $('#filterer0').val();
				if (apptype != '') {
					if (id != '') {
			    		$.ajax({
			    			url: '{{ asset('employee/mf/get_FaciOneType') }}',
			    			method: 'GET',
			    			data: {_token:$('#token').val(), id: id},
			    			success: function(data){
			    				if (data != 'ERROR') {
		    							$('#filterer1').empty();
		    							$('#filterer2').empty();
			    						if (data.length != 0) {
								    		$('#filterer1').append('<option value="">Select Facility...</option>');
								    		for (var i = 0; i < data.length; i++) {
								    			$('#filterer1').append('<option value="'+data[i].hgpid+'">'+data[i].hgpdesc+'</option>');
								    		}
			    						} else {
			    							$('#filterer1').append('<option value="">No Facilities registered.</option>');
			    						}
			    				} else {
			    					$('#ERROR_MSG2').show(100);
			    					$('#filterer1').empty();
			    					$('#filterer2').empty();
			    				}
			    			},
			    			error: function(a, b, c){
			    				console.log(c);
			    				$('#ERROR_MSG2').show(100);
			    			}
			    		});
			    	} else {
			    		$('#filterer1').empty();
			    		$('#filterer1').append('<option value=""></option>');
			    		$('#filterer2').empty();
			    		$('#filterer2').append('<option value=""></option>');
			    	}
				} else {
					alert('Please select Assessment type');
					$('#filterer0').focus();
				}
	    }
		function filterGroup1(){
	        var id = $('#filterer1').val();
	        var token = $('#token').val();
	        var part_id = $('#filterer0').val();
	        // $('#FilterdBody').empty();
	        // $('#FilterdBody').append('<option value="">Select Province ...</option>');
			if (id != '') {
	 				$.ajax({
	 					url : '{{ asset('employee/mf/get_ServOneFaci') }}',
	 					method: 'GET',
	 					data : {_token:$('#token').val(),id : id, part_id : part_id },
	 					success: function(data){
	 						$('#filterer2').empty();
	 						if (data != 'ERROR') {
	 							if (data.length != 0) {
	 								$('#filterer2').append('<option value="">Select Service...</option>');
	 								for (var i = 0; i < data.length; i++) {
	 									$('#filterer2').append('<option value="'+data[i].facid+'">'+data[i].facname+'</option>');
	 								}
	 							} else {
	 								$('#filterer2').append('<option value="">No Services registered.</option>');
	 							}
	 						}
	 					},
	 					error: function(a, b, c){
	 						console.log(c);
	 	    				$('#ERROR_MSG2').show(100);
	 					}
	  				});
	  				getAssessmentsFacility();
	 		} else {
	 			$('#filterer2').empty();
	     		$('#filterer2').append('<option value=""></option>');
	 		}
	    }
	    function getAssessmentsFacility(){
	    	var table = $('#example').DataTable();
	        table.clear().draw();
	    	$.ajax({
				url : '{{asset('employee/mf/get_AsmtOneFaci')}}',
				async: true,
				method: 'GET',
				data  : {_token:$('#token').val(),id : $('#filterer1').val(), hfser_id : $('#filterer').val()},
				success: function(data) 
				{
					if (data != 'ERROR') {
						if (data.length != 0) 
						{
							var totalLength = data.length;
							for (var i = 0; i < data.length; i++) {
								// console.log(data[i].seq_num);
								// var sq = '';
								if (data[i].srvasmt_seq >= 1) {
									if (data[i].srvasmt_seq == 1) {
										sq='&nbsp;<a href="#"><button onclick="Rearranged(\'down\',\''+data[i].hfser_id+'\','+data[i].srvasmt_seq+', \'\', \''+data[i].srvasmt_id+'\')" class="btn btn-outline-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';
									}
									else if (data[i].srvasmt_seq > 1 && data[i].srvasmt_seq < totalLength) {
										sq = '&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''+data[i].hfser_id+'\','+data[i].srvasmt_seq+', \'\', \''+data[i].srvasmt_id+'\')" class="btn btn-outline-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>&nbsp;<a href="#"><button  onclick="Rearranged(\'down\',\''+data[i].hfser_id+'\','+data[i].srvasmt_seq+', \'\', \''+data[i].srvasmt_id+'\')" class="btn btn-outline-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';
									}
									else {
										sq='&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''+data[i].hfser_id+'\','+data[i].srvasmt_seq+', \'\', \''+data[i].srvasmt_id+'\')" class="btn btn-outline-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>';
									}										
								}

								// var SUbDESC =  encodeURI(data[i].asmt2sd_desc);
								// var SUbDESC = data[i].asmt2sd_desc;
								// SUbDESC = SUbDESC.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
								// console.log(data[i].asmt2sd_desc);
								$('#example').DataTable().row
								.add([
										'<center>'+data[i].asmt2_id+'</center>',
										'<center>'+data[i].title_code+' - '+data[i].title_name+'</center>',
										'<center>'+data[i].asmt2_loc+' - '+data[i].asmt2l_desc+'</center>',
										data[i].asmt2_desc,
										'<center>'+data[i].srvasmt_seq+'</center>',
										'<center>' +
											'<button type="button" class="btn btn-outline-primary" onclick="showData(\''+data[i].hfser_desc+'\', \''+data[i].hgpdesc+'\', \''+data[i].facname+'\', \''+data[i].asmt2_id+'\', \''+data[i].title_code+' - '+data[i].title_name+'\', \''+data[i].asmt2l_id+' - '+data[i].asmt2l_desc+'\', \''+data[i].asmt2_desc+'\', \''+data[i].asmt2sd_id+'\');" data-toggle="modal" data-target="#ViewModal" title="More Information"><i class="fa fa-fw fa-eye"></i></button>&nbsp;' +
											'<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+data[i].srvasmt_id+'\', \''+data[i].asmt2_desc+'\');" data-toggle="modal" data-target="#DelGodModal" title="Remove Assessment"><i class="fa fa-fw fa-trash"></i></button>' + sq +
										'</center>' 
									])
								// '<button type="button" class="btn btn-outline-primary" onclick="showData(\''+data[i].hfser_desc+'\', \''+data[i].hgpdesc+'\', \''+data[i].facname+'\', \''+data[i].asmt2_id+'\', \''+data[i].title_code+' - '+data[i].title_name+'\', \''+data[i].asmt2l_id+' - '+data[i].asmt2l_desc+'\', \''+data[i].asmt2_desc+'\', \''+encodeURI(SUbDESC)+'\');" data-toggle="modal" data-target="#ViewModal" title="More Information"><i class="fa fa-fw fa-eye"></i></button>&nbsp;' +
								.draw();

							}
							$('#example').DataTable().order([4, 'asc']).draw();
						} else {
							console.log('No assessment registered.');
						}
					} else if(data == 'ERROR') {
						$('#ERROR_MSG2').show(100);
					}
				},
				error: function (a, b, c) {
					console.log(c);
    				$('#ERROR_MSG2').show(100);
				}
			});
	    }
	    function filterGroup2(){
			var id = $('#filterer').val();
	        var id2 = $('#filterer2').val();
	        var table = $('#example').DataTable();
	        var part_id = $('#filterer0').val();
	        table.clear().draw();
					if (id2 != '' && id != '') { // getAssessmentsFacility
						$.ajax({
							url: '{{asset('employee/mf/get_allAsmt')}}',
							method : 'GET',
							data : {_token:$('#token').val(), hfser_id:$('#filterer').val(), facid:$('#filterer2').val(), hgpid : $('#filterer1').val(), part_id : part_id},
							success : function(data){
								console.log(data);
								if (data != 'ERROR') {
									if (data.length != 0) 
									{
										var totalLength = data.length;
										for (var i = 0; i < data.length; i++) {
											// console.log(data[i].seq_num);
											// var sq = '';
											if (data[i].srvasmt_seq >= 1) {
												if (data[i].srvasmt_seq == 1) {
													sq='&nbsp;<a href="#"><button onclick="Rearranged(\'down\',\''+data[i].hfser_id+'\','+data[i].srvasmt_seq+', \''+data[i].facid+'\', \''+data[i].srvasmt_id+'\')" class="btn btn-outline-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';
												}
												else if (data[i].srvasmt_seq > 1 && data[i].srvasmt_seq < totalLength) {
													sq = '&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''+data[i].hfser_id+'\','+data[i].srvasmt_seq+', \''+data[i].facid+'\', \''+data[i].srvasmt_id+'\')" class="btn btn-outline-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>&nbsp;<a href="#"><button  onclick="Rearranged(\'down\',\''+data[i].hfser_id+'\','+data[i].srvasmt_seq+', \''+data[i].facid+'\', \''+data[i].srvasmt_id+'\')" class="btn btn-outline-info" title="Go Down"><i class="fa fa-sort-down"></i></button></a>';
												}
												else {
													sq='&nbsp;<a href="#"><button onclick="Rearranged(\'up\',\''+data[i].hfser_id+'\','+data[i].srvasmt_seq+', \''+data[i].facid+'\', \''+data[i].srvasmt_id+'\')" class="btn btn-outline-warning" title="Go Up"><i class="fa fa-sort-up"></i></button></a>';
												}										
											}

											// var SUbDESC =  encodeURI(data[i].asmt2sd_desc);
											// var SUbDESC = data[i].asmt2sd_desc;
											// SUbDESC = SUbDESC.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
											// console.log(data[i].asmt2sd_desc);
											$('#example').DataTable().row
											.add([
													'<center>'+data[i].asmt2_id+'</center>',
													'<center>'+data[i].title_code+' - '+data[i].title_name+'</center>',
													'<center>'+data[i].asmt2_loc+' - '+data[i].asmt2l_desc+'</center>',
													data[i].asmt2_desc,
													'<center>'+data[i].srvasmt_seq+'</center>',
													'<center>' +
														'<button type="button" class="btn btn-outline-primary" onclick="showData(\''+data[i].hfser_desc+'\', \''+data[i].hgpdesc+'\', \''+data[i].facname+'\', \''+data[i].asmt2_id+'\', \''+data[i].title_code+' - '+data[i].title_name+'\', \''+data[i].asmt2l_id+' - '+data[i].asmt2l_desc+'\', \''+data[i].asmt2_desc+'\', \''+data[i].asmt2sd_id+'\');" data-toggle="modal" data-target="#ViewModal" title="More Information"><i class="fa fa-fw fa-eye"></i></button>&nbsp;' +
														'<button type="button" class="btn btn-outline-danger" onclick="showDelete(\''+data[i].srvasmt_id+'\', \''+data[i].asmt2_desc+'\');" data-toggle="modal" data-target="#DelGodModal" title="Remove Assessment"><i class="fa fa-fw fa-trash"></i></button>' + sq +
													'</center>' 
												])
											// '<button type="button" class="btn btn-outline-primary" onclick="showData(\''+data[i].hfser_desc+'\', \''+data[i].hgpdesc+'\', \''+data[i].facname+'\', \''+data[i].asmt2_id+'\', \''+data[i].title_code+' - '+data[i].title_name+'\', \''+data[i].asmt2l_id+' - '+data[i].asmt2l_desc+'\', \''+data[i].asmt2_desc+'\', \''+encodeURI(SUbDESC)+'\');" data-toggle="modal" data-target="#ViewModal" title="More Information"><i class="fa fa-fw fa-eye"></i></button>&nbsp;' +
											.draw();

										}
										$('#example').DataTable().order([4, 'asc']).draw();
									} else {
										alert('No assessment registered.');
									}
								} else if(data == 'ERROR') {
									$('#ERROR_MSG2').show(100);
								}
							},
							error : function(a, b, c){
								console.log(c);
								$('#ERROR_MSG2').show(100);
							},
						});
					} else if (id2 == '' && id != '') {
						getAssessmentsFacility();
					}
		}
		function showData(AppType, Facility, Service, AsmtCode, Title, Header, Desc, sdId)
		{
			$('#ViewAppType').empty();
			$('#ViewAppType').append(AppType);

			$('#ViewFacility').empty();
			$('#ViewFacility').append(Facility);

			$('#ViewService').empty();
			if (Service == 'undefined') { Service = 'N/A';}
			$('#ViewService').append(Service);

			$('#ViewAsmtCode').empty();
			$('#ViewAsmtCode').append(AsmtCode);

			$('#ViewAsmtTitle').empty();
			$('#ViewAsmtTitle').append(Title);

			$('#ViewAsmtHeader').empty();
			$('#ViewAsmtHeader').append(Header);

			$('#ViewAsmtDesc').empty();
			$('#ViewAsmtDesc').append(Desc);
			
			if (sdId != '') {
				$.ajax({
					url : '{{ asset('employee/mf/assessment/getSingleAssessment2') }}',
					method : 'GET',
					data: {_token:$('#token').val(), id : sdId},
					success : function(data){
							if (data != 'ERROR') {
								$('#ViewSubDesc').summernote('code', data.asmt2sd_desc);
								$('#ViewSubDesc').summernote('disable');
								$('.note-toolbar').hide();

							}
					},
					error : function(a, b, c){
						console.log(c);
					}
				});
			} else {
				$('#ViewSubDesc').empty();
			}
		}
	    function showDelete (id, desc){
	        $('#DelModSpan').empty();
	        $('#DelModSpan').append(
	            '<div class="col-sm-12"> Are you sure you want to delete <span style="color:red"><strong>' + desc + '</strong></span>?' +
	            '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
	            '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
	            '</div>'
	          );
	    }
	    function deleteNow(){
		    var id = $("#toBeDeletedID").val();
		    var name = $("#toBeDeletedname").val();
		      $.ajax({
		        url : "{{ asset('employee/mf/del_ManageAssesment2') }}",
		        method: 'POST',
		        data: {_token:$('#token').val(),id:id,mod_id: $('#CurrentPage').val(), hfser_id:$('#filterer').val(), facid : $('#filterer2').val(), hgpid : $('#filterer1').val()},
		        success: function(data){
		          if (data == 'DONE') {
		            alert('Successfully deleted '+name);
		           	$('#DelGodModal').modal('toggle');
		           	 if ($('#filterer2').val() != '') { filterGroup2();}
		           	 else {
		           	 	getAssessmentsFacility();
		           	 }
		          } else if (data == 'ERROR'){
		            $('#DelErrorAlert').show(100);
		          }
		        }, error : function(XMLHttpRequest, textStatus, errorThrown){
		            console.log(errorThrown);
		            $('#DelErrorAlert').show(100);
		        }
		      });
	    }
	    $('#addCls').on('submit',function(event){
	        event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	        if (form.parsley().isValid()) {
	        	var ocid = $('#OCID').val();
	            var id = $('#new_rgnid').val();
	            // if (test == -1) { // Not in Array
	                $.ajax({
	                  method: 'POST',
	                  data: {
	                    _token : $('#token').val(),
	                    asmt2_id: $('#new_rgnid').val(),
	                    facid : $('#OCID2').val(),
	                    hgpid : $('#OCID1').val(),
	                    clm : $('#new_column').val(),
	                    hfser_id : $('#OCID').val(),
	                    part : $('#new_part').val(),
	                    hasRemarks : $('#defaultCheck1').is(':checked') ? 1 : 0,
	                    part_id : $('#new_type').val(),
	                    // mod_id: $('#CurrentPage').val()
	                  },
	                  success: function(data) {
	                    if (data == 'DONE') {
	                        alert('Successfully added an assessment in the selected facility.');
	                        location.reload();
	                        // filterGroup2();
	                    } else if (data == 'DUPLICATE'){
	                      alert('Assessment is already in the selected service.');
	                      $('#new_rgnid').focus();
	                    } else if (data == 'DUPLICATE2') {
	                    	alert('Assessment is already in the selected facility.');
	                      $('#OCID1').focus();
	                    } else if (data == 'ERROR') {
	                        $('#AddErrorAlert').show(100);
	                    }
	                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                      console.log(errorThrown);
	                      $('#AddErrorAlert').show(100);
	                  }
	              });
	            // } else {
	            //   alert('Assessment is already in the selected facility.');
	            //   $('#new_rgnid').focus();
	            // }
	        }
	    });
	    function getFacilities()
	    {
	    	var id = $('#OCID').val();
	    	var id2 = $('#filterer').val();
	    	if (id != '') {
	    		$.ajax({
	    			url: '{{ asset('employee/mf/get_FaciOneType') }}',
	    			method: 'GET',
	    			data: {_token:$('#token').val(), id: id},
	    			success: function(data){
	    				if (data != 'ERROR') {
    							$('#OCID1').empty();
	    						if (data.length != 0) {
						    		$('#OCID1').append('<option value="">Select Facility...</option>');
						    		for (var i = 0; i < data.length; i++) {				    			
						    			$('#OCID1').append('<option value="'+data[i].hgpid+'">'+data[i].hgpdesc+'</option>');
						    		}
	    						} else {
	    							$('#OCID1').append('<option value="">No Facilities registered.</option>');
	    						}
	    				} else {
	    					$('#AddErrorAlert').show(100); 
	    					$('#OCID1').empty();   					
	    				}
	    			},
	    			error: function(a, b, c){
	    				console.log(c);
	    				$('#AddErrorAlert').show(100);
	    			}
	    		});
	    	} else {
	    		$('#OCID1').empty();
	    		$('#OCID1').append('<option value=""></option>');
	    	}
	    }
	function getServices()
	{
		var id = $('#OCID1').val();
		if (id != '') {
				$.ajax({
					url : '{{ asset('employee/mf/get_ServOneFaci2') }}',
					method: 'GET',
					data : {_token:$('#token').val(),id : id },
					success: function(data){
						if (data != 'ERROR') {
							$('#OCID2').empty();
							if (data.length != 0) {
								$('#OCID2').append('<option value="">Select Service...</option>');
								for (var i = 0; i < data.length; i++) {	
									$('#OCID2').append('<option value="'+data[i].facid+'">'+data[i].facname+'</option>');
								}
							} else {
								$('#OCID2').append('<option value="">No Services registered.</option>');
							}
						}
					},
					error: function(a, b, c){
						console.log(c);
	    				$('#AddErrorAlert').show(100);
					}
 				});
		} else {
			$('#OCID2').empty();
    		$('#OCID2').append('<option value=""></option>');
		}
	}
	function GetSingleAssessment()
	{
		var id = $('#new_rgnid').val();
		if (id != '') {
			$.ajax({
				url :'{{ asset('employee/mf/get_SingleAsmt') }}' ,
				method : 'GET',
				data : {_token:$('#token').val(), id:id},
				success : function(data){
					if (data != 'ERROR') {
							// $('#new_title').val(data.asmt2_title + ' - ' + data.title_name);
							// asmt2_loc asmt2l_desc
							$('#new_header').val(data.asmt2_loc + ' - ' + data.asmt2l_desc);
							//
							$('#newDesc').val(data.asmt2_desc);
							//
							$('#newSubDesc').summernote('code', data.asmt2sd_desc);

					} else {
							// $('#new_title').val('');
							$('#new_header').val('');
							$('#newDesc').val('');
							$('#newSubDesc').summernote('code', ' ');
					}
					$('#newSubDesc').summernote('disable');
					$('.note-toolbar').hide();
				},
				error : function(a, b, c){
					console.log(c);
				}
			});
		} 
		else {

		}
	}
	//\'down\',\''+data[i].hfser_id+'\','+data[i].srvasmt_seq+','+data[i].srvasmt_seq+', \''+data[i].facid+'\', \''+data[i].srvasmt_id+'\'
	function Rearranged(type, hfser_id, seq, facid, id)
	{
		// var r = confirm("Are you sure you want to rearrange?");
		var r = true;
		if (r == true) {
			$.ajax({
				url: '{{ asset('employee/mf/manage/assessment/rearrange') }}', 
				method: 'POST',
				data : {_token:$('#token').val(), hfser_id : hfser_id, seq : seq, facid : facid, id : id, type: type},
				success : function(data){
					 if (data == 'DONE') {
					 	// alert('Successfully Rearranged');		
					 	filterGroup2();
						} else if (data == 'ERROR') {
		              $('#ERROR_MSG2').show(100);
		              $('#ERROR_MSG2').focus();
						}
				},
				error : function(a, b, c){
					console.log(c);
	             	$('#ERROR_MSG2').show(100);
	              	$('#ERROR_MSG2').focus();
				},
			});
		}
		
	}
	</script>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif