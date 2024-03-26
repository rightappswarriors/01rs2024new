@if (session()->exists('employee_login')) 	
	@extends('mainEmployee')
	@section('title', 'Notification')
	@section('content')
	<div class="content p-4">
	    <div class="card">
	        <div class="card-header bg-white font-weight-bold">
	           Notification
	        </div>
	        <div class="card-body" id="AllBody">
	        	{{--@isset ($AllData)
	        	    @foreach ($AllData as $e)
	        	    	<div class="card">
						  <div class="card-body bg-secondary">
						   <div class="row">
							   	<div class="col-sm-11">
								   	<blockquote class="blockquote mb-1">
								      <p>{{$e->message}}</p>
								      <footer style="color:white" class="blockquote-footer"><cite title="{{$e->formattedTime}} {{$e->formattedDate}}">{{$e->DifferenceFromHumans}}</cite>
								      </footer>
								    </blockquote>
							   </div>
							   <div class="col-sm-1"> 
							   		<center><i class="fa fa-circle" aria-hidden="true"></i></center> 
							   		<center><i class="fa fa-circle-o" aria-hidden="true"></i></center>
							   </div>
						   </div>
						  </div>
						</div>
	        	    @endforeach
	        	@endisset --}}
	        </div>
	        {{-- <div class="modal fade" id="AddGodModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		        <div class="modal-dialog" role="document">
		          <div class="modal-content" style="border-radius: 0px;border: none;">
		            <div class="modal-body" style=" background-color: #272b30;color: white;">
		              <h5 class="modal-title text-center"><strong>Notification</strong></h5>
		              <hr>
		              <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display: none" id="AddErrorAlert" role="alert">
		                        <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
		                        <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
		                            <span aria-hidden="true">&times;</span>
		                        </button>
		                    </div>
		              <div class="">
		                <form id="addRgn" data-parsley-validate>
		               		<div class="col-sm-12">
		               			Message
		               		</div>
		                  	<div class="col-sm-12" style="margin:0 0 .8em 0;">
		               			<textarea class="form-control" rows="4" disabled="" id="msgTxtBox"></textarea>
		               		</div>
		               		<div class="col-sm-12">
		               			<span class="float-right" id="msgDetailsSpan"></span> 
							</div>
		                </form>
		                <hr>
		                    <div class="row">
		                      	<div class="col-sm-6">
		                      		&nbsp;
			                     <button type="button" class="btn btn-outline-success form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Add</button> 
			                    </div> 
			                    <div class="col-sm-6">
			                      <button type="button" data-dismiss="modal" class="btn btn-outline-danger form-control" style="border-radius:0;"><span class="fa fa-sign-up"></span>Close</button>
			                    </div>
		                    </div>
		              </div>
		            </div>
		          </div>
		        </div>
	      </div> --}}
	<script type="text/javascript">
		$(document).ready(function(){
			laDisplay();
			// setInterval(function(){ laDisplay(); }, 3000);
		});
		function laDisplay() {
			$.ajax({
	        url: '{{asset('/view/notification')}}',
	        type: 'POST',
	        async: false,
	        data: {_token: $("input[name='_token']").val(), uid: '{{session()->get('employee_login')->uid}}'},
	  		success : function(a){
	  			let data = JSON.parse(a);
	  			if(data != 'ERROR')
	  			{			
					var allData = data['data'];
					$('#AllBody').empty();
					for (var i = 0; i < allData.length; i++) {
						var checkRead = (allData[i].status ==  0) ? 'list-group-item-info' : 'list-group-item-dark' ; // if unread
						var checkRead2 = (allData[i].status ==  0) ? '(Unread)' : '(Read)' ; // if unread
						// var str = allData[i].message;
						// str = str.replace(/'/g, "\\'");
						// str = escape(str);
						$('#AllBody').append(
							 '<a href="'+allData[i].adjustedlink+'" class="list-group-item list-group-item-action '+checkRead+'" style=";cursor: pointer;">' + // background-color: #4C4F51;color: white
			                     '<div class="d-flex w-100 justify-content-between">' +
			                       '<h5 class="mb-1">&nbsp;</h5>' + // Title
			                       '<small>'+allData[i].adjustedmonth+'</small>' + // Difference
			                     '</div>' + 
								 '<p class="mb-1">Application ID: <strong>'+allData[i].appid+'</strong></p>' + 
			                     '<p class="mb-1">'+allData[i].msg_desc+'</p>' + // Message // .substr(0, 20)
			                     '<small>'+allData[i].notifdatetime+'</small>' + // Time Date
			                   '</a>'
						);
					}
	  			}
	  			else if (data == 'ERROR') {
	  				$('#ERROR_MSG2').show(100);
	  			}
	  		},
	  		error : function(a,b,c){
	  			console.log(c);
	  			$('#ERROR_MSG2').show(100);
	  		}
	  	});
		}
		function ViewMessage(id, status, message, fTime, fDate)
		{
			$('#msgTxtBox').empty();
			$('#msgTxtBox').append(message);

			$('#msgDetailsSpan').text('');
			$('#msgDetailsSpan').text(fTime + ' ' + fDate);

			if (status == 0) 
			{
				$.ajax({
					url : "{{ asset('employee/notification/toggle') }}",
					method : "POST",
					data : {_token:$('#token').val(), id:id, tgl: 1},
					success : function(data) 
					{
						if (data == 'DONE') 
						{
							laDisplay();
						}
						else if (data == 'ERROR') {
							$('#AddErrorAlert').show();
						}
					},
					error : function(a, b, c)
					{
						console.log(c);
						$('#AddErrorAlert').show();
					}
				});
			}
		}
	</script>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif