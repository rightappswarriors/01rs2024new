@if (session()->exists('employee_login'))  	
	@extends('mainEmployee')
	@section('title', 'Manage Teams Master File')
	@section('content')
	<input type="text" id="CurrentPage" hidden="" value="TM002">
	<div class="content p-4">
	    <div class="card">
	        <div class="card-header bg-white font-weight-bold">
	           Manage Teams 
	           <span class="TM002_add">
	           	<a href="" title="Add New" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>  
	           </span>
	        </div>
	        <div class="card-body">
	          <div style="float:left;margin-bottom: 5px">
	            <form class="form-inline">
	              <label>Filter : &nbsp;</label>
	              <select class="form-control" id="filterer" onchange="filterGroup(1)">
	              	<option value="">Select Region</option>
	                @if (isset($regions))
	                  @foreach ($regions as $type)
	                    <option value="{{$type->rgnid}}">{{$type->rgn_desc}}</option>
	                  @endforeach
	                @endif
	              </select>
	              &nbsp;
	              <select class="form-control" id="SelectedTeam" onchange="filterGroup2(1)">
	              	<option value="">Select Team</option>
	              </select>
	              </form>
	           </div>
	          <span id="showSucc">
	          </span>
	          <div class="table-responsive">
	            <table class="table table-hover" id="example" style="overflow-x: scroll;" >
	              <thead>
	                <tr>
	                  <th style="width: auto">ID</th>
	                  <th style="width: auto">Name</th>
	                  <th style="width: auto">Type</th>
	                  <th style="width: auto">Position</th>
	                  {{-- <th style="width: 35%"><center>Order of Payment</center></th> --}}
	                  <th style="width: auto"><center>Option</center></th>
	                </tr>
	              </thead>
	              <tbody id="FilterdBody">
	              </tbody>
	            </table>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	      <div class="modal-dialog" role="document">
	        <div class="modal-content" style="border-radius: 0px;border: none;">
	          <div class="modal-body" style=" background-color: #272b30;
	        color: white;">
	            <h5 class="modal-title text-center"><strong>Add New Member </strong></h5>
	            <hr>
	            <div class="container">
	              <form id="addRgn" class="row"  data-parsley-validate>
	                <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="AddErrorAlert" role="alert">
	                  <div class="row">
	                  </div><strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
	                    <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
	                        <span aria-hidden="true">&times;</span>
	                    </button>
	                </div>
	                {{ csrf_field() }}
	                <div class="col-sm-4">Region:</div>
	                <div class="col-sm-8" style="margin:0 0 .8em 0;">
	                	<select class="form-control" id="selectedRegionAdd" onchange="filterGroup(2)" data-parsley-required-message="*<strong>Region</strong> required" required="">
			              	<option value="">Select Region</option>
			                @if (isset($regions))
			                  @foreach ($regions as $type)
			                    <option value="{{$type->rgnid}}">{{$type->rgn_desc}}</option>
			                  @endforeach
			                @endif
			              </select>
	                </div>
	                <div class="col-sm-4">Team:</div>
	                <div class="col-sm-8" style="margin:0 0 .8em 0;">
	                	<select class="form-control" id="SelectedTeamAdd" data-parsley-required-message="*<strong>Team</strong> required"  required="">
			              	<option value="">Select Team</option>
			              </select>
	                </div>
	                <div class="col-sm-4">Employee:</div>
	                <div class="col-sm-8" style="margin:0 0 .8em 0;">
	                	<select class="form-control" id="SelectedName" data-parsley-required-message="*<strong>Employee</strong> required"  required="" onchange="getSelectedEmployeeData();">
			              	<option value="">Select Employee..</option>
			              </select>
			              <datalist id="selectedEmployeeData">
			              </datalist>
	                </div>
	                <div class="col-sm-12">
	                	<center>Selected Employee Information</center>
	                </div>
	                <div class="col-sm-4">Type:</div>
	                <div class="col-sm-8" style="margin:0 0 .8em 0;">
	                	<input type="text" id="SelectedEmployeeType" class="form-control" disabled="">
	                </div>
	                <div class="col-sm-4">Position:</div>
	                <div class="col-sm-8" style="margin:0 0 .8em 0;">
	                	<input type="text" id="SelectedEmployeePosition" class="form-control" disabled="">
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
	<div class="modal fade" id="IfActiveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content" style="border-radius: 0px;border: none;">
	        <div class="modal-body text-justify" style=" background-color: #272b30;
	      color: white;">
	          <h5 class="modal-title text-center"><strong><span id="ifActiveTitle">Remove Member in Team</span></strong></h5>
	          <hr>
	          <div class="container">
	            <form  id="RemoveMember" class="row" data-parsley-validate>
	              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none;margin:5px" id="DeleteErrorAlert" role="alert">
	                    <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
	                    <button type="button" class="close" onclick="$('#DeleteErrorAlert').hide(1000);" aria-label="Close">
	                        <span aria-hidden="true">×</span>
	                    </button>
	                </div>
	              <div class="col-sm-12" id="Error">
	                <p>Are you sure you want to delete <span style="font-weight: bold;color:red" id="selectedFacility"></span> from <span style="font-weight: bold;color:red" id="selectedTypeX"></span>? </p>
	                <input type="text" id="ToBeRemovedFacility" hidden="" value="">
	              </div>
	              <div class="col-sm-12">
	                <hr>
	                <div class="row">
	                  <div class="col-sm-6">
	                    <button type="submit" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Remove</button>
	                  </div>
	                  <div class="col-sm-6">
	                    <button type="button" data-dismiss="modal" class="btn btn-outline-warning form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Cancel</button>
	                  </div>
	                </div>
	              </div> 
	            </form>
	         </div>
	        </div>
	      </div>
	    </div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){$('#example').DataTable();});
		function filterGroup(selected)
		{
			if (selected == 1) {
				$.ajax({
					url : '{{ asset('employee/dashboard/processflow/get_teams') }}',
					method : 'POST',
					data : {_token:$('#token').val(), rgn: $('#filterer').val()},
					success : function(data){
						if (data != 'ERROR') 
						{
							if (data.length != 0) 
							{
								$('#SelectedTeam').empty();
								$('#SelectedTeam').append('<option value="">Select Team</option>');
								for (var i = 0; i < data.length; i++) 
								{
									$('#SelectedTeam').append('<option value="'+data[i].teamid+'">'+data[i].teamdesc+'</option>');
								}
							} 
							else 
							{ // NONE
								$('#SelectedTeam').empty();
								$('#SelectedTeam').append('<option value="">No teams currently registered.</option>');
							}
						} 
						else 
						{
							$('#ERROR_MSG2').show();
						}
					},
					error : function(a, b, c){
						console.log(c);
						$('#ERROR_MSG2').show();
					},
				});
			} else if (selected == 2) 
			{
				$.ajax({
					url : '{{ asset('employee/dashboard/processflow/get_teams') }}',
					method : 'POST',
					data : {_token:$('#token').val(), rgn: $('#selectedRegionAdd').val()},
					success : function(data){
						if (data != 'ERROR') 
						{
							if (data.length != 0) 
							{
								$('#SelectedTeamAdd').empty();
								$('#SelectedTeamAdd').append('<option value="">Select Team</option>');
								for (var i = 0; i < data.length; i++) 
								{
									$('#SelectedTeamAdd').append('<option value="'+data[i].teamid+'">'+data[i].teamdesc+'</option>');
								}
							} 
							else 
							{ // NONE
								$('#SelectedTeamAdd').empty();
								$('#SelectedTeamAdd').append('<option value="">No team is currently registered.</option>');
							}
						} 
						else 
						{
							$('#AddErrorAlert').show(100);
						}
					},error : function(a, b, c){
						console.log(c);
						$('#AddErrorAlert').show(100);
					}
				});

				$.ajax({
					url : '{{ asset('employee/mf/getEmployeeWithoutTeam') }}',
					method : 'POST',
					data : {_token:$('#token').val(), rgn: $('#selectedRegionAdd').val()},
					success : function(data){
						if (data != 'ERROR') 
						{
							if (data.length != 0) 
							{
								$('#selectedEmployeeData').empty();
								$('#SelectedName').empty();
								$('#SelectedName').append('<option value="">Select Employee..</option>');
								for (var i = 0; i < data.length; i++) 
								{
									$('#SelectedName').append('<option value="'+data[i].uid+'">'+data[i].wholename+'</option>');
									$('#selectedEmployeeData').append('<option id="'+data[i].uid+'_data" seltype="'+data[i].grp_desc+'" selpos="'+data[i].position+'"></option>');
								}
							} 
							else 
							{ // NONE
								$('#SelectedName').empty();
								$('#SelectedName').append('<option value="">No employee is currently available.</option>');
							}
						} 
						else 
						{
							$('#AddErrorAlert').show(100);
						}
					},error : function(a, b, c){
						console.log(c);
						$('#AddErrorAlert').show(100);
					}
				});
			}
		}
		function filterGroup2(selected)
		{
			// employee/mf/getMembersInTeam
			if (selected == 1) {
				$.ajax({
					url : '{{ asset('employee/mf/getMembersInTeam') }}',
					method : 'POST',
					data : {_token: $('#token').val(), id : $('#SelectedTeam').val()},
					success : function(data){
						 $('#example').DataTable().clear().draw();
						 if (data != 'ERROR') {
						 	for (var i = 0; i < data.length; i++) {
						 		$('#example').DataTable().row.add([
						 			data[i].uid, data[i].wholename, data[i].grp_desc, data[i].position,
						 			'<center><span class="TM002_cancel"><button class="btn btn-outline-danger" data-toggle="modal" data-target="#IfActiveModal" onclick="ShowDelete(\''+data[i].uid+'\', \''+data[i].wholename+'\')"><i class="fa fa-fw fa-trash"></i></button></span><center>'

						 			]).draw();
		                      GroupRightsActivate();
						 	}
						 } else if (data == 'ERROR') {
						 	$('#ERROR_MSG2').show()
						 }
					},
					error : function(a, b, c){
						console.log(c);
						$('#ERROR_MSG2').show();
					},
				});
			}
		}
		function getSelectedEmployeeData()
		{
			var selected = $('#SelectedName').val();
			$('#SelectedEmployeeType').empty();
			$('#SelectedEmployeePosition').empty();
			if (selected != '') {
				var selectedType = $('#'+selected+'_data').attr('seltype');
				var selectedPos = $('#'+selected+'_data').attr('selpos');
				$('#SelectedEmployeeType').val(selectedType);
				$('#SelectedEmployeePosition').val(selectedPos);
			}
		}
		$('#addRgn').on('submit', function(e){
			e.preventDefault();
			var form = $(this);
		    form.parsley().validate();
		    if (form.parsley().isValid()) {
		    	$.ajax({
		    		method : 'POST',
		    		data : {_token:$('#token').val(), id : $('#SelectedName').val(), team : $('#SelectedTeamAdd').val()},
		    		success : function(data){
		    			if (data == 'DONE') {
		    				logActions('Added manage team with ID: '+ $('#SelectedName').val());
		    				alert('Successfully added a member in the team');
		    				location.reload();
		    			} else if (data == 'ERROR') {
		    				$('#AddErrorAlert').show(100);
		    			}

		    		},
		    		error : function(a,b,c){
		    			console.log(c);
		    			$('#AddErrorAlert').show(100);
		    		},
		    	});
		    }
		});
		function ShowDelete(id, faciname){
	        // selectedFacility, selectedTypeX, ToBeRemovedFacility
	        $('#ToBeRemovedFacility').val('');
	        $('#ToBeRemovedFacility').val(id);

	        $('#selectedFacility').text('');
	        $('#selectedFacility').text(faciname);

	        var team = $('#SelectedTeam option:selected').text();
	        $('#selectedTypeX').text('');
	        $('#selectedTypeX').text(team);
	    }
	    $('#RemoveMember').on('submit', function(e){
	    	e.preventDefault();
	    	$.ajax({
	    		url : '{{ asset('employee/mf/delMemberInTeam') }}',
	    		method : 'POST',
	    		data : {_token:$('#token').val(), id : $('#ToBeRemovedFacility').val()},
	    		success : function(data){
	    			if (data == 'DONE') {
	    				logActions('Deleted manage team with ID: '+$('#ToBeRemovedFacility').val());
	    				alert('Successfully deleted a member');
	    				filterGroup2(1);
	    				$('#IfActiveModal').modal('toggle');
	    			} else if (data == 'ERROR') {
	    				$('#DeleteErrorAlert').show(100);
	    			}
	    		},
	    		error : function(a, b, c){
	    			console.log(c);
	    			$('#DeleteErrorAlert').show(100);
	    		},
	    	});
	    });
	</script>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif