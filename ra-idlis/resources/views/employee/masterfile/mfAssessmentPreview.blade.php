@if (session()->exists('employee_login'))
	@extends('mainEmployee')
	@section('title', 'Preview Assessment')
	@section('content')
	<div class="content p-4">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
				<div class="container-fluid">
					Preview Assessment
				</div>
			</div>
			<div class="card-body">
				<table class="table display" id="example" style="overflow-x: scroll;" >
					<thead>
						<tr>
							<th>Title Code</th>
							<th>Title Name</th>
							<th class="text-center">View Compiled</th>
						</tr>
					</thead>
					<tbody id="FilterdBody">
						@foreach($titles as $title)
						<tr>
							<td class="font-weight-bold">
								{{$title->title_code}}
							</td>
							<td>
								{{$title->title_name}}
							</td>
							<td class="text-center">
								<button onclick="$('#partID').removeAttr('href').attr('href','{{asset('employee/dashboard/mf/manage/preview_assessment/')}}' +'/' + '{{$title->title_code}}')" data-toggle="modal" data-target="#modal" class="btn btn border border-primary border-primary btn btn primary text-success">
									<i class="fa fa-eye"></i>
								</button>
								{{-- <a target="_blank" href="{{asset('employee/dashboard/mf/manage/preview_assessment/'.$title->title_code)}}" class="border border-primary btn btn primary text-success"><i class="fa fa-eye"></i></a> --}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	
	<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="border-radius: 0px;border: none;">
            <div class="modal-body" style=" background-color: #272b30;color: white;">
              <h5 class="modal-title text-center"><strong>Show Assessment</strong></h5>
              <hr>
              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="DelErrorAlert" role="alert">
                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                        <button type="button" class="close" onclick="$('#DelErrorAlert').hide(1000);" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
              <div class="container">
                   <div class="col-md-12">
                   	<div class="container text-center">
                   		Show Via Service Capabilities<br>
                   		<select name="fac" class="form-control mt-3 mb-1" onchange="$('#togo').removeAttr('href').attr('href','{{asset('employee/dashboard/mf/manage/preview_assessment/')}}' +'/' + $(this).val())">
                   			<option value="" hidden>Please Select</option>
                   			@foreach($fac as $f)
                   			<option value="{{$f->facid}}">{{$f->facname}}</option>
                   			@endforeach
                   		</select><br>
						<a id="togo" class="btn p-3 w-50 btn-primary" target="_blank">Go</a>
                   	</div>
                   </div>
                   <div class="col-md-12 border text-center mt-4">
                   </div>
                   <div class="col-md-12 text-center pt-3 pb-3 font-weight-bold">
                   	OR
                   </div>
                   <div class="col-md-12 border text-center mb-4">
                   </div>
                   <div class="col-md-12">
                   	<div class="container text-center">
                   		Show Via Part Code<br>
                   		<a id="partID" target="_blank" class="border border-primary btn btn primary text-success mt-3"><i class="fa fa-eye"></i></a>
                   	</div>
                   </div>
              </div>
            </div>
          </div>
        </div>
      </div>

	<script>
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
	</script>
	@endsection

@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif