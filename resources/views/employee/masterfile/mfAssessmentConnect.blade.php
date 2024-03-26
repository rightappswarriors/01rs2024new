@if (session()->exists('employee_login'))	
	@extends('mainEmployee')
	@section('title', 'Assessment Combine Master File')
	@section('content')
	<input type="text" id="CurrentPage" hidden value="header">
	<div class="content p-4">
		<script type="text/javascript">
		</script>
		<datalist id="rgn_list">
			@if (isset($allData))
				@foreach ($allData as $hfstype)
					<option value="{{$hfstype->asmtH3ID}}">{{$hfstype->h2name}}</option>
				@endforeach
			@endif
		</datalist>
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
			Assessment Combine <span class="header_add"><a href="#" title="Add New Assessment Combine" data-toggle="modal" data-target="#myModal" onclick='$("#newserv").val("").trigger("change");
	      	$("#new_rgnid").summernote("code", ""); $("#new_headText").summernote("code", "");'><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a></span>
	      	<div class="float-right">
	      		Show 
	      		<select name="show" class="form-control" onchange="window.location.href = '{{url('employee/mf/AssessmentCombine/')}}/'+ this.value; ">
	      			<option value="20">20</option>
	      			<option value="50">50</option>
	      			<option value="100">100</option>
	      			<option value="200">200</option>
	      			<option value="300">300</option>
	      			<option value="all">all</option>
	      		</select>
	      		entries
	      	</div>

			</div>
			<div class="card-body">

				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th class="text-center" hidden readonly>ID</th>
							<th class="text-center">Sub Category</th>
							<th class="text-center">Assessment</th>
							<th class="text-center">Sub Header</th>
							<th class="text-center">Added By</th>
							<th class="text-center">Added On</th>
							<th class="text-center">Option</th>
						</tr>
					</thead>
					<tbody>
						@if (!empty($allData))
							@foreach($allData as $titleData)
								<tr>
									<td scope="row" hidden readonly>
										{{$titleData->asmtComb}}
									</td>
									<td scope="row">
										{{$titleData->h3name}}
									</td>
									<td scope="row">
										{!!$titleData->assessmentName!!}
									</td>
									<td>
										{!!addslashes($titleData->headingText)!!}
									</td>
									<td>
										{!!addslashes($titleData->fname. ' ' .$titleData->lname)!!}
									</td>
									<td>
										{!!addslashes(Date('F j, Y',strtotime($titleData->addedtimedate)))!!}
									</td>
									<td>
										<div class="d-flex justify-content-center">
											<div class="">
												<button type="button" class="btn btn-outline-primary" onclick="viewData('{{addslashes( $titleData->title_name )}}', '{{addslashes( $titleData->h1name )}}', '{{addslashes( $titleData->h2name )}}', '{{addslashes( $titleData->h3name )}}', '{{addslashes( $titleData->facname ) }}');" data-toggle="modal" data-target="#viewModal"><i class="fa fa-fw fa-eye"></i></button>&nbsp;
											</div>
											<div class="">
												<button type="button" class="btn btn-outline-warning" onclick="showData('{{addslashes( $titleData->asmtComb )}}', '{{addslashes( $titleData->asmtH3ID_FK )}}', '{{addslashes( $titleData->isAlign )}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
											</div>
											<div class="">
												<button type="button" class="btn btn-outline-danger" onclick="showDelete('{{addslashes( $titleData->asmtComb )}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>&nbsp;
											</div>
											<div class="">
												<button type="button" class="btn btn-outline-primary" onclick="showData('{{addslashes( $titleData->asmtComb )}}', '{{addslashes( $titleData->asmtH3ID_FK )}}' , '{{addslashes( $titleData->isAlign )}}',true);" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-clone"></i></button>&nbsp;
											</div>
											<div class="">
												<button type="button" class="btn btn-outline-success" onclick="showDataForRearrange('{{addslashes( $titleData->asmtH3ID_FK )}}','{{addslashes( $titleData->asmtComb )}}');" data-toggle="modal" data-target="#rearrangeModal"><i class="fa fa-sort" aria-hidden="true"></i></button>&nbsp;
											</div>
										</div>
									</td>
								</tr>
							@endforeach
						@endisset
					</tbody>
				</table>
			</div>
		</div>
	</div>
	{{-- rearrange Modal --}}
	<div class="modal fade" id="rearrangeModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body text-justify" style=" background-color: #F7FBFF;
				color: black;">
					<h5 class="modal-title text-center"><strong>Rearrange Assessment</strong></h5>
					<hr>
					<div class="container pt-3 pb-5 text-center" style="font-size: 30px;">
						Move <span id="forRearrange"></span>
					</div>

					<div class="container pt-3 pb-5 text-center" style="font-size: 20px;">
						After
					</div>

					<div class="container">
						<table class="table display" id="example1" style="overflow-x: scroll;" >
							<thead>
								<tr>
									<th class="text-center">Assessment</th>
									<th class="text-center">Sub Header</th>
									<th class="text-center">Select this?</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- Add --}}
	<div class="modal fade" id="myModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<form id="addRgn" class="row"  data-parsley-validate>
				<div class="modal-content" style="border-radius: 0px;border: none;">
					<div class="modal-body text-justify" style="background-color: #C2CAD0; color: black;">
						<h5 class="modal-title text-center"><strong>Add New Assessment Combine</strong></h5>
						<hr>
						<div class="container">
							<div class="row">
								<div class="col-md-6">
									<div class="pb-3" style="font-size: 20px;">Sub Category:</div>
									<div>
										<select name="newserv" required="" onchange="getDetails(this.value)" id="newserv" class="form-control">
											<option value disabled readonly hidden="" selected="" value="">Please Select</option>
											@foreach($part[2] as $se)
											<option value="{{$se->asmtH3ID}}">{{$se->h3name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">

									<div class="row">
										<div class="col-md-4 font-weight-bold">Services: </div>
										<div class="col-md-8" id="facname">
											Please select Sub Category First
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 font-weight-bold">Part: </div>
										<div class="col-md-8" id="title_name">
											Please select Sub Category First
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 font-weight-bold">Header 1: </div>
										<div class="col-md-8" id="h1name">
											Please select Sub Category First
										</div>
									</div>
									<div class="row">
										<div class="col-md-4 font-weight-bold">Header 2: </div>
										<div class="col-md-8" id="h2name">
											Please select Sub Category First
										</div>
									</div>

								</div>
							</div>
							<div class="container mt-4 mb-2" id="txtHeadParent">
							<div class="text-center" style="font-size: 30px;">Text Header</div>
								<div class="d-flex justify-content-center" style="margin:0 0 .8em 0;">
									<textarea class="form-control" id="new_headText" cols="3t" rows="10"></textarea>
								</div>
							</div>

							<div class="container mt-4 mb-2">
							<div class="text-center" style="font-size: 30px;">Assessment Data</div>
								<div class="d-flex justify-content-center" style="margin:0 0 .8em 0;">
									<textarea class="form-control" id="new_rgnid" cols="3t" rows="10" data-parsley-required-message="*<strong>Assessment Data</strong> required" required></textarea>
								</div>
							</div>
							<div class="container mt-4 mb-2">
							<div class="text-center" style="font-size: 30px;">Is Aligned on Header One?</div>
							<div class="text-center text-danger">NOTE: This is only for PTC Checklist</div>
								<div class="d-flex justify-content-center">
									<div class="row">
										<div class="col-md-4">
											{{-- <div class="row"> --}}
												<div class="col-md">
													<label class="form-check-label" for="exampleRadios3">
														Yes
														<input type="radio" class="form-control" id="exampleRadios3" name="isAligned" value="1">
													</label>
												</div>
											{{-- </div> --}}
										</div>
										<div class="col-md-3">
											{{-- <div class="row"> --}}
												<div class="col-md">
													<label class="form-check-label" for="exampleRadios4">
														No
														<input type="radio" class="form-control" id="exampleRadios4" name="isAligned" value="0" checked>
													</label>
												</div>
											{{-- </div> --}}
										</div>
									</div>
								</div>
							</div>
							<div class="container mt-4 mb-2">
							<div class="text-center" style="font-size: 30px;">Is Sub Assessment?</div>
								<div class="d-flex justify-content-center">
									<div class="row">
										<div class="col-md-4">
											{{-- <div class="row"> --}}
												<div class="col-md">
													<label class="form-check-label" for="exampleRadios1">
														Yes
														<input type="radio" class="form-control" id="exampleRadios1" name="isAssess" value="1">
													</label>
												</div>
											{{-- </div> --}}
										</div>
										<div class="col-md-3">
											{{-- <div class="row"> --}}
												<div class="col-md">
													<label class="form-check-label" for="exampleRadios2">
														No
														<input type="radio" class="form-control" id="exampleRadios2" name="isAssess" value="0" checked>
													</label>
												</div>
											{{-- </div> --}}
										</div>
									</div>
								</div>
							</div>
							<div class="container mt-4 mb-2" id="toHideIfNo" hidden>
								<input type="hidden" name="subAssessment">
								<div class="container">
									<table class="table display" id="example2" style="overflow-x: scroll;" >
										<thead>
											<tr>
												<th class="text-center">Assessment</th>
												<th class="text-center">Sub Header</th>
												<th class="text-center">Sub assessment to this?</th>
											</tr>
										</thead>
										<tbody>
											
										</tbody>
									</table>
								</div>
							</div>
							<div class="container">
								<button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
							</div> 
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	{{-- Edit --}}
	<div class="modal fade" id="GodModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #272b30;color: white;">
					<h5 class="modal-title text-center"><strong>Edit Assessment Combine</strong></h5>
					<hr>
					<div>
						<form id="EditNow" data-parsley-validate>
							<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="EditErrorAlert" role="alert">
								<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
								<button type="button" class="close" onclick="$('#EditErrorAlert').hide(1000);" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div> 
							<span id="EditBody">
							</span>
							<div class="row">
								<div class="col-sm-6">
									<button type="submit" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
								</div> 
								<div class="col-sm-6">
									<button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="DelGodModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="border-radius: 0px;border: none;">
				<div class="modal-body" style=" background-color: #272b30;color: white;">
					<h5 class="modal-title text-center"><strong>Delete Asessment Header Two</strong></h5>
					<hr>
						<div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
							<strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
							<button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					<div class="container">
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

	<div class="modal fade" id="viewModal" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content" style="border-radius: 0px;border: none;">
	      <div class="modal-body" style=" background-color: #272b30;color: white;">
	        <h5 class="modal-title text-center"><strong>View Combined assessment Details</strong></h5>
	        <hr>
	        <div class="container">
	              <form id="ViewNow" data-parsley-validate>
	              <span id="ViewBody">
	              </span>
	              <hr>
	              <div class="row">
	                <div class="col-sm-6">
	                  &nbsp;
	              </div> 
	              <div class="col-sm-6">
	                <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
	              </div>
	              </div>
	            </form>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#new_headText').summernote({
				height: 150,
				width: 900
			});
			$('#new_rgnid').summernote({
				height: 150,
				width: 900
			});

			$('#edit_desc').summernote({
				height: 300,
				width: 900
			});
			
			$('#example').dataTable( {
		       "order": [ 0, "ASC" ]
			} );
			$('#example1').dataTable();

			$('[name=show]').select2({ width: '100%', tags: true });
		} );

		function getDetails(val){
			if($.trim(val) != "" && val > -1){
				let arr = ['facname','title_name','h1name','h2name'];
				$.ajax({
					method: "post",
					data: { _token: $("input[name=_token]").val(), id: val, action: 'getCombined' },
					success: function(a){
						if(a.length > 0){
							let details = a[0];
							arr.forEach(function(index, el) {
								if($('#'+index).length > 0){
									$('#'+index).text(details[index]);
								}
							});
						} else {
							if($('#'+index).length > 0){
								$('#'+index).text('Data Not found');
							}
						}
					}, 
					error: function(a,b,c){
						console.log([a,b,c]);
					}
				});
			}
		}

		function viewData(title_name,h1name,h2name,h3name,facname){
          $('#ViewBody').empty();
          $('#ViewBody').append(
              '<div class="row">'+
                  '<div class="col-sm-4">Title Name:' +
                  '</div>' +
                  '<div class="col-sm-8">' + title_name +
                  '</div>' +
              '</div>' +
              // '<br>' + 
              '<div class="row">'+
                  '<div class="col-sm-4">Header 1:' +
                  '</div>' +
                  '<div class="col-sm-8">' + h1name + '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Header 2:' +
                  '</div>' +
                  '<div class="col-sm-8">' + h2name + '</div>'+
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Area:' +
                  '</div>' +
                  '<div class="col-sm-8">' + h3name + '</div>' +
              '</div>' +
              '<div class="row">'+
                  '<div class="col-sm-4">Service:' +
                  '</div>' +
                  '<div class="col-sm-8">' + facname +'</div>' +
              '</div>'
            );
      }

      function showDataForRearrange(h3id,currentID){
      	if($.trim(h3id) != ''){
      		$.ajax({
      			method: 'POST',
      			data: {_token: $('input[name=_token]').val(), id: h3id, action: 'rearrange'},
      			success: function(data){
      				data = JSON.parse(data);
      				$('#example1').DataTable().clear().draw();
      				if (data.length != 0) {
						for (var i = 0; i < data.length; i++) {

							if(currentID != data[i].asmtComb){
								$('#example1').DataTable().row.add([
									data[i].assessmentName + ' <span class="font-weight-bold">(' + data[i].h3name + ')</span>',
									data[i].headingText,
									'<div class="text-center">'+
										'<button type="button" class="btn btn-outline-success" onclick="showDialogForRearrange('+data[i].assessmentSeq+','+data[i].asmtComb+','+currentID+')"><i class="fa fa-check" aria-hidden="true"></i></button>'+
									'</div>'
								]).draw();
							} else {
								$("#forRearrange").empty().html(data[i].assessmentName);
							}

						}
					}
      			}
      		})
      	}
      }

      function showDialogForRearrange(seqNum,id,curID){
      	Swal.fire({
		  title: 'Are you sure?',
		  text: "This will change order of items lited on assessment tool",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, Move it!'
		}).then((result) => {
		  if (result.value) {
		   $.ajax({
      			method: 'POST',
      			data: {_token: $('input[name=_token]').val(), id: id, currentID: curID, action: 'arrange'},
      			success: function(data){
      				if (data == 'DONE') {
      					alert('Assessment Re-configured');
      					location.reload();
      				}
      			}
      		})
		  }
		})
      }

      function showDialogForAddSub(seqNum,curID){
      	Swal.fire({
		  title: 'Are you sure that this item is a sub assessment? This kind of items is often found on PTC Checklist.',
		  text: "This will make this Assessment as a sub assessment",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Yes, I\'m Sure!'
		}).then((result) => {
		  if (result.value) {
		  	$("input[name=subAssessment]").val(curID);
		  }
		})
      }


		function showData(id,serv,aligned,isDuplicate = false){
		if(!isDuplicate){
	      $('#EditBody').empty();
	      $('#EditBody').append(
      		  '<div class="container mt-3">'+
				'<div class="text-center" style="font-size: 30px;">Text Header</div>'+
					'<div class="d-flex justify-content-center" style="margin:0 0 .8em 0;">'+
						'<textarea class="form-control" id="edit_headText" cols="3t" rows="10"></textarea>'+
					'</div>'+
				'</div>'+
	          '<div class="col-sm-4" hidden>Header Two Code:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;" hidden>' +
	            '<input type="text" id="edit_name" value="'+id+'" class="form-control disabled" disabled>' +
	          '</div>' +
	          '<div class="text-center" style="font-size: 30px;">Assessment Data</div>' +
		          '<div class="d-flex justify-content-center" style="margin:0 0 .8em 0;">'+
						'<textarea class="form-control" id="edit_desc" data-parsley-required-message="*<strong>Assessment Data</strong> required" required></textarea>'+
					'</div>'+
	          '<div class="col-sm-12  text-center">Is Aligned on Header One?</div>' +
	          '<div class="col-sm-12 text-center text-danger">NOTE: This is only for PTC Checklist</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	           ' <div class="row">'+
					'<div class="col-md-6 d-flex justify-content-end">'+
							'<label class="form-check-label" for="exampleRadios5">'+
								'Yes'+
								'<input type="radio" class="form-control" id="exampleRadios5" name="isAlignedEdit" value="1">'+
							'</label>'+
					'</div>'+
					'<div class="col-md-6">'+
							'<label class="form-check-label" for="exampleRadios6">'+
								'No'+
								'<input type="radio" class="form-control" id="exampleRadios6" name="isAlignedEdit" value="0" checked>'+
							'</label>'+
					'</div>'+
				'</div>'+
	          '<div class="col-sm-4">Header level 1:</div>' +
	          '<div class="col-sm-12" style="margin:0 0 .8em 0;">' +
	            '<select name="newserv" id="newserv_edit" class="form-control" required>'+
					'<option value disabled readonly hidden="" selected="" value="">Please Select</option>'+
					@foreach($part[2] as $se)
					'<option value="{{$se->asmtH3ID}}">{{$se->h3name}}</option>'+
					@endforeach
				'</select>'+
	          '</div>'+
	          '</div>'
	        );
	      $("#newserv_edit").val(serv);
	      $("[name=isAlignedEdit][value = "+aligned+"]").prop('checked',true);
	      $('#edit_headText').summernote({
			height: 150,
			width: 900
		  });
		  $.ajax({
		  	method: 'POST',
		  	data: {id: id, _token: $("input[name=_token]").val(),action:'getExtraDetails'},
		  	success: function(a){
		  		let data = JSON.parse(a);
		  		$("#edit_desc").summernote("code", data['assessmentName']);
		  		$("#edit_headText").summernote("code", data['headingText']);
		  	}
		  })

	      } else {
	      	$("#newserv").val(serv).trigger('change');
	      	$.ajax({
			  	method: 'POST',
			  	data: {id: id, _token: $("input[name=_token]").val(),action:'getExtraDetails'},
			  	success: function(a){
			  		let data = JSON.parse(a);
			  		$("#new_rgnid").summernote("code", data['assessmentName']);
			  		$("#new_headText").summernote("code", data['headingText']);
			  	}
			})
			$("[name=isAligned][value = "+aligned+"]").prop('checked',true);
	      }

	    }

		$('#addRgn').on('submit',function(event){
	        event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	        if (form.parsley().isValid()) {
	            var id = $('#new_rgnid').val();
	            var arr = $('#rgn_list option[value]').map(function () {return this.value}).get();
	            var test = $.inArray(id,arr);
	            if (test == -1) { // Not in Array
	                $.ajax({
	                  method: 'POST',
	                  data: {
	                    _token : $('#token').val(),
	                    id: $('#new_rgnid').val(),
	                    name : $('#new_rgn_title').val(),
	                    serv :  $('#newserv').val(),
	                    // view : $('#new_view_title').val(),
	                    mod_id : $('#CurrentPage').val(),
	                    seq : $('#new_rgn_seq').val(),
	                    txtHead: $('#new_headText').val(),
	                    sub: $("input[name=subAssessment]").val(),
	                    aligned: $("[name=isAligned]:checked").val(),
	                    action: 'add'
	                  },
	                  success: function(data) {
	                    if (data != 'ERROR') {
	                        alert('Successfully Added New Assessment Combine');
	                        for (var i = 0; i < data.length; i++) {
	                        $('#example').DataTable().row.add([
								'<span hidden class="toDeleteAfterDisplay">'+data[i].asmtComb+'</span>',
								data[i].h3name,
								data[i].assessmentName,
								data[i].headingText,
								data[i].uid,
								data[i].addedtimedate,
								'<div class="d-flex justify-content-center">'+
									'<div class="">'+
										'<button type="button" class="btn btn-outline-primary" onclick="viewData('+data[i].title_name+', '+data[i].h1name+', '+data[i].h2name+', '+data[i].h3name+', '+data[i].facname+');" data-toggle="modal" data-target="#viewModal"><i class="fa fa-fw fa-eye"></i></button>&nbsp;'+
									'</div>'+
									'<div class="">'+
										'<button type="button" class="btn btn-outline-warning" onclick="showData('+data[i].asmtComb+', '+data[i].asmtH3ID_FK+');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;'+
									'</div>'+
									'<div class="">'+
										'<button type="button" class="btn btn-outline-danger" onclick="showDelete('+data[i].asmtComb+');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>&nbsp;'+
									'</div>'+
									'<div class="">'+
										'<button type="button" class="btn btn-outline-primary" onclick="showData('+data[i].asmtComb+', '+data[i].asmtH3ID_FK+',true);" data-toggle="modal" data-target="#myModal"><i class="fa fa-fw fa-clone"></i></button>&nbsp;'+
									'</div>'+
									'<div class="">'+
										'<button type="button" class="btn btn-outline-success" onclick="showDataForRearrange('+data[i].asmtH3ID_FK+','+data[i].asmtComb+');" data-toggle="modal" data-target="#rearrangeModal"><i class="fa fa-sort" aria-hidden="true"></i></button>&nbsp;'+
									'</div>'+
								'</div>'
							]).draw();
							$(".toDeleteAfterDisplay").parent().hide();
							}
	                    } else if(data == 'ERROR'){
	                      $('#AddErrorAlert').show(100);
	                    }
	                  }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                      console.log(errorThrown);
	                      $('#AddErrorAlert').show(100);
	                  }
	              });
	            } else {
	              alert('Assessment Code is already taken');
	              $('#new_rgnid').focus();
	            }
	        }
	    });

		function showDelete (id,desc){
	        $('#DelModSpan').empty();
	        $('#DelModSpan').append(
	            '<div class="col-sm-12"> Are you sure you want to delete this item?' +
	            '<input type="text" id="toBeDeletedID" class="form-control"  style="margin:0 0 .8em 0;" value="'+id+'" hidden>'+
	            '<input type="text" id="toBeDeletedname" class="form-control"  style="margin:0 0 .8em 0;" value="'+desc+'" hidden>'+
	            '</div>'
	          );
	    }
	    function deleteNow(){
	      var id = $("#toBeDeletedID").val();
	      var name = $("#toBeDeletedname").val();
	      $.ajax({
	        method: 'POST',
	        data: {_token:$('#token').val(),id:id, mod_id : $('#CurrentPage').val(),action:'delete'},
	        success: function(data){
	          if (data == 'DONE') {
	            alert('Successfully deleted '+name);
	            location.reload();
	          }
	          else if (data == 'ERROR'){
	              $('#DelErrorAlert').show(100);
	          }
	        }, error : function(XMLHttpRequest, textStatus, errorThrown){
	            console.log(errorThrown);
	            $('#DelErrorAlert').show(100);
	        }
	      });
	    }

	    $('#EditNow').on('submit',function(event){
	      event.preventDefault();
	        var form = $(this);
	        form.parsley().validate();
	         if (form.parsley().isValid()) {
	           var y = $('#edit_desc').val();
	           var x = $('#edit_name').val();
	           var a = $('#edit_ui').val();
	           var z = $('#edit_headText').val();
	           var b = $('[name=isAlignedEdit]:checked').val();
	           $.ajax({
	              method: 'POST',
	              data : {_token:$('#token').val(),id:x,name:y,filename:a,serv: $("#newserv_edit").val(),aligned: b,txtHead:z,action:'edit'},
	              success: function(data){
	                  if (data == "DONE") {
	                      alert('Editing Successful');
	                      location.reload();
	                  } else if (data == "ERROR") {
	                      $('#EditErrorAlert').show(100);
	                  }
	              }, error : function(XMLHttpRequest, textStatus, errorThrown){
	                  console.log(errorThrown);
	                  $('#EditErrorAlert').show(100);
	              },
	           });
	         }
	    });


	    $('input[name=isAssess]').change(function(event) {
	    	if($(this).val() == 1){
	    		$("#toHideIfNo").removeAttr('hidden');
	    		$.ajax({
	      			method: 'POST',
	      			data: {_token: $('input[name=_token]').val(), action: 'rearrange'},
	      			success: function(data){
	      				data = JSON.parse(data);
	      				$('#example2').DataTable().clear().draw();
	      				if (data.length != 0) {
							for (var i = 0; i < data.length; i++) {
								$('#example2').DataTable().row.add([
									data[i].assessmentName,
									data[i].headingText,
									'<div class="text-center">'+
										'<button type="button" class="btn btn-outline-success" onclick="showDialogForAddSub('+data[i].assessmentSeq+','+data[i].asmtComb+')"><i class="fa fa-check" aria-hidden="true"></i></button>'+
									'</div>'
								]).draw();
							}
						}
	      			}
	      		})
	    	} else {
	    		$("input[name=subAssessment]").val('');
	    		$("#toHideIfNo").attr('hidden',true);
	    	}

	    });

	</script>


	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif


