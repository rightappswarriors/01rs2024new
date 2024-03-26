	@include('client1.cmp.__apply')
	<style>

	.customButton {
    display: inline-block;
    text-align: center;
    vertical-align: middle;
    padding: 10px 13px;
    border: 2px solid #2ba908;
    border-radius: 20px;
    background: #46ff0e;
    background: -webkit-gradient(linear, left top, left bottom, from(#46ff0e), to(#2ba908));
    background: -moz-linear-gradient(top, #46ff0e, #2ba908);
    background: linear-gradient(to bottom, #46ff0e, #2ba908);
    text-shadow: #1f7906 1px 0px 1px;
    font: normal normal bold 17px times new roman;
    color: #ffffff;
    text-decoration: none;
	}
	.customButton:hover,
	.customButton:focus {
	    border: 2px solid ##3df20c;
	    background: #54ff11;
	    background: -webkit-gradient(linear, left top, left bottom, from(#54ff11), to(#34cb0a));
	    background: -moz-linear-gradient(top, #54ff11, #34cb0a);
	    background: linear-gradient(to bottom, #54ff11, #34cb0a);
	    color: #ffffff;
	    text-decoration: none;
	}
	.customButton:active {
	    background: #2ba908;
	    background: -webkit-gradient(linear, left top, left bottom, from(#2ba908), to(#2ba908));
	    background: -moz-linear-gradient(top, #2ba908, #2ba908);
	    background: linear-gradient(to bottom, #2ba908, #2ba908);
	}
	.customButton:before{
	    content:  "\0000a0";
	    display: inline-block;
	    height: 24px;
	    width: 24px;
	    line-height: 24px;
	    margin: 0 4px -6px -4px;
	    position: relative;
	    top: 0px;
	    left: 0px;
	    background: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAAA7EAAAOxAGVKw4bAAABXElEQVRIibWWQWrDMBBFX4SOUErXxqscolBygSxKVsXnyKrg3KYxlF7AGHqILnOAkk3IMqmThWRHGau2bOwPg0ey5ksjaWY0AxT/IwZegQUwBx5t/y/wA+TAFti1cNQTKEdiIANOwKVDTnZsLHhqbtcDBSTAMYBYytHa3pFLD9YDiKWsxaJrl5IRyCtJHN56z4dsS9t2Ra4HWYBR6nidBozPAKXt6peEoe1KSyyBSGPuuQ40KntMoIGVwgTRVFhoTIT6sBHtgtsWFZ7x756+OcAf/kOCZhC26d4o7zq0sqfegMYkrifPv1S0C+Db6s/AS8fiAPZgMmJI8PSNgwuQKzvBVMgVJp+fAw3cVNyFM7BVmGLxFWhUEh5sn5Z7kmR3QCQ7GDddvyHSdfUds+A0KlqlDy2ZB2fld/AV/Yh+Rf/D2igpM6u4N6NqVxOtuD1bHuyYPc1nSym4FFBeAVZW/dD9guL7AAAAAElFTkSuQmCC") no-repeat left center transparent;
	    background-size: 100% 100%;
	}

		.uploadpreview{
		  width:150px;
		  height:150px;
		  display:block;
		  border:1px solid #ccc;
		  margin:0 auto 15px;
		  background-size:100% auto;
		  background-repeat:no-repeat;
		  background-position:center;
		}

		.upload-wrap{
		  float:left;
		  width:200px;
		}

		input[type="file"] {
		    color: transparent;
		    width: 120px;
		    margin: 0 auto;
		    display: block;
		}

		.removePadding{
			margin-top: 10px!important;
			padding-left: 0px!important;
    		padding-right: 15px!important
		}
	</style>
	@extends('main')
	@if (session()->exists('uData'))  
		@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
	@endif
	@section('content')
	<?php $needToAdress = true;  $toCheckForData = 'hasLOE'; $hideifMon = false?>
	{{-- settings --}}
	@switch($from)
		@case ('mon')
			<?php 
			$hideifMon = (isset($data->forResubmit) ? false : !$data->$toCheckForData); $loRemarkField = 'monitorRemark'; 
			$message = 'Your Response Area';
			?>
		@break

		@case ('surv')
			<?php 
			$loRemarkField = 'surveillanceRemark'; 
			$message = 'Your Response Area';
			?>
		@case ('fdamonitoring')
		<?php 
		$hideifMon = false; 
		$message = 'Client’s Compliance';
		?>
		@break

	@endswitch

	<body>
		<form id="sendAll" method="POST" enctype="multipart/form-data">
			{{csrf_field()}}
			<div class="container pb-3 pt-3">
			@isset($data->isApproved)
				<span class="font-weight-bold"> CA Status:</span>
				<u>
					@if($data->isApproved == 1)
					<p class="lead text-success">Compliant</p>
					@else
					<p class="lead text-danger">Not Compliant</p>
					@endif
				</u>
			@endisset
			{{-- @if(isset($data->hasLOE) && !isset($reco))
				<p class="lead">Status: Waiting for Evaluation</p>
			@elseif(isset($reco))
				<p class="lead">Status: Verdict has been Made</p>
			@endif --}}
			{{-- @if(isset($data->isApproved))
				<p class="lead">Status: Verdict has been Made</p>
			@else
				<p class="lead">Status: Waiting for Evaluation</p>
			@endif --}}
			</div>
			
			@if(isset($reco) && !in_array($from,['mon']))
			<div class="container pb-3 pt-3 border rounded">
				<span class="font-weight-bold">VERDICT:</span>
				<div class="container pt-3 font-weight-bold">
					@foreach($reco as $key => $value)
					{{$key}} {{$value ?? ''}}
					@endforeach
				</div>
			</div>
			@endif

			<div class="container pb-3 pt-3">
				@switch($from)
				@case ('mon')

				@case ('surv')

					
						<p class="lead">After an assessment has been made on your facility, a Letter of Explanation has been Ordered due to the following Reported Violations: </p>
						@if($from == 'surv')
						@if(isset($data->violation))
						<div class="container border rounded bg-secondary" style="min-height: 100px;">
							<p class="lead text-white pt-1">{{$data->violation}}</p>
						</div>
						@endif
						<p class="lead pt-3">Surveillance Comments</p>
						<div class="container border rounded bg-info" style="min-height: 100px;">
							<p class="lead text-white pt-1">{{$data->comments}}</p>
						</div>
						<p class="lead font-weight-bold pt-3">Images</p>
				      	<div class="container pt-3">
							@if(!empty($data->$LO))
								@php 
									$images = explode(',',$data->$LO);
									$perDiv = (12 % count($images) == 0 ? '-'.(12 / count($images)) : '-3');
								@endphp
								<div class="row">
								@foreach($images as $image)
									<div class="col{{$perDiv}} mt-3">
										{{-- <img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}" style="cursor: pointer;"> --}}
										<img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{($image ? asset('ra-idlis/storage/app/public/uploaded/'.$image) : url('ra-idlis/public/img/no-preview-available.png'))}}" style="cursor: pointer;">
									</div>
								@endforeach
								</div>
							@else
								<div class="container text-center font-weight-bold ">No Image Uploaded</div>
							@endif
				      	</div>
				      	@elseif($from == 'mon')
						<div class="container mt-5">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Lack/Violation</th>
										<th>Remarks from Inspectors</th>
									</tr>
								</thead>
								<tbody>
									@foreach($vio as $key=>$value)
									<tr>
										<td class="font-weight-bold">{!!$key!!}</td>
										<td>{{($value ?? '(No Remarks)')}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
				      	@endif
				      	@if((isset($data->forResubmit) && trim($data->forResubmit) != "" || isset($data->surveillanceRemark)))
						<p class="lead"><u>{{$from == 'mon' ? 'Monitoring' : ($from == 'surv' ? 'Surveillance' : '')}} Team remarks</u></p>
						<textarea disabled="" class="form-control w-100" name="" id="" cols="30" rows="10">{{$data->$loRemarkField}}</textarea>
						@endif

				      	@if(isset($extraDetails))
						<div class="container mt-5">
							<span class="font-weight-bold">History of Sent Explanation and Images</span>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th>Explanation</th>
										<th>Images</th>
										<th>Date/Time changes</th>
									</tr>
								</thead>
								<tbody>
									@foreach($extraDetails as $ex)
									<tr>
										<td class="font-weight-bold">{{$ex->LOE}}</td>
										<td>
											<div class="row">
											@php 
												$images = explode(',',$ex->attached_filesUser);
												$perDiv = (12 % count($images) == 0 ? '-'.(12 / count($images)) : '-3');
											@endphp
											@foreach($images as $image)
												<div class="col{{$perDiv}} mt-3">
													{{-- <img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}" style="cursor: pointer;"> --}}
													<img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{($image ? asset('ra-idlis/storage/app/public/uploaded/'.$image) : url('ra-idlis/public/img/no-preview-available.png'))}}" style="cursor: pointer;">
												</div>
											@endforeach
											</div>
										</td>
										<td class="font-weight-bold">{{Date('F j, Y',strtotime($ex->dateTransfered))}}</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							
							
						</div>
						@endif
					


				@break

				@case ('fdamonitoring')
				<?php $toCheckForData = 'hasReplyFlag'; ?>
				<p class="lead">You have been Monitored by the FDA Montoring team and came up to a conclusion: </p>
				<div class="container border rounded text-center" style="min-height: 100px;">
					@if($data->decision == 'C')
						<p class="display-4 text-success"><u>Compliant</u></p>	
						<small class="text-primary">No action is necessary</small>
						{{-- <div class="container mt-5 rounded " style="min-height: 100px;">
							Remarks from FDA:
							<p class="lead text-dark pt-1">{!!($vio['fromPO']->remark ?? '<span class="text-success">No Remarks</span>')!!}</p>
						</div> --}}
						<?php $needToAdress = false; ?>
					@else
						<p class="display-4 text-danger"><u>For Compliance</u></p>
						<p class="lead pt-3">Monitoring Remarks</p>
						<div class="container border rounded " style="min-height: 100px;">
							<p class="lead text-dark pt-1">{{$vio['fromPO']->remark}}</p>
						</div>
						<p class="lead pt-3">File attachments:</p>
						<div class="container border rounded " style="min-height: 100px;">
							<a href="{{url('file/open/'.$vio['fromPO']->fileName)}}" class="btn btn-primary p-3 mt-3">Monitoring Report</a>
						</div>
						@if(isset($vio['fromPO']->otherfilename))
						<div class="container border rounded " style="min-height: 100px;">
							<a href="{{url('file/open/'.$vio['fromPO']->otherfilename)}}" class="btn btn-primary p-3 mt-3">Other Report File</a>
						</div>
						@endif
					@endif
				</div>
				@break

				@endswitch

			</div>

			@if($needToAdress)
				<div class="text-center container mt-5 font-weight-bold display-4">{{$message}}</div>
				
				
				@if(!isset($data->LOE))
				
				<!-- if(!isset($data->$toCheckForData)) -->
				<div class="container pb-3 pt-3">
					<p class="lead">
						Explanation
					</p>
				</div>	
				
				<div class="container pb-3">
					
					<textarea name="exp" cols="30" rows="10" class="form-control w-100" required="">{{($data->explanation ?? "")}}</textarea>
				
<!-- 					
					<div class="row mt-4 removePadding" id="appendArea" @if($hideifMon) hidden="" @endif>
						
						<div class="col-md-2 removePadding">
							<div class="upload-wrap">
							  <div class="uploadpreview 1"></div>
							  <div class="container text-center pb-3 filename 1"></div>
							  <input name="images[]" id="1" type="file">
							</div>
						</div>
						
						<div class="col-md-2 removePadding">
							<div class="d-flex justify-content-center mt-5">
							  <button type="button" onclick="processImages()" class="customButton">Add More Image</button>
							</div>
						</div>

					</div> -->

				</div>
				


				<div class="d-flex justify-content-center mt-3 pb-5" >
					<button class="btn btn-primary">Submit</button>
					{{-- @if($from == 'mon')
					<button type="button" class="btn btn-primary ml-3">Save as Draft</button>
					@endif --}}
				</div>


				@else


					@switch($from)
						@case ('mon')
							@if($data->$toCheckForData != null || $data->forResubmit == 1)
							<div class="container pb-3">
							<b>	Explanation </b>
							<p>{{($data->LOE ?? "")}}</p>
							<br>
							<br>
								<textarea name="exp" id="imgexp" cols="30" rows="10" class="form-control" required="">{{($data->explanation ?? "")}}</textarea>
								<!-- <textarea name="exp" cols="30" rows="10" class="form-control" required="">{{($data->LOE ?? "")}}</textarea> -->
							</div>
							
							@if($data->attached_filesUser == null || $data->forResubmit == 1)


								<div class="row mt-4 removePadding" id="appendArea" @if($hideifMon) hidden="" @endif>
						
									<div class="col-md-2 removePadding">
										<div class="upload-wrap">
										  <div class="uploadpreview 1"></div>
										  <div class="container text-center pb-3 filename 1"></div>
										  <input name="images[]" id="1" type="file">
										</div>
									</div>
									
									<div class="col-md-2 removePadding">
										<div class="d-flex justify-content-center mt-5">
										  <button type="button" onclick="processImages()" class="customButton">Add More Attachment</button>
										  <!-- <button type="button" onclick="processImages()" class="customButton">Add More Photos</button> -->
										</div>
									</div>

								</div>



								
					          	<div class="d-flex justify-content-center mt-3 pb-5" >
									<button class="btn btn-primary">Submit</button>
								</div>
							@else
								@if(empty($user))
								<div class="container text-center font-weight-bold ">No Image Uploaded</div>
								@else
									<div class="container pt-3">
										@if(!empty($data->$user))
											@php 
												$images = explode(',',$data->$user);
												$perDiv = (12 % count($images) == 0 ? '-'.(12 / count($images)) : '-3');
											@endphp
											<div class="container pb-3 pt-3">
												<p class="lead">
													Photos You Submitted
												</p>
											</div>
											<div class="row">
												@php
												
												$arrContextOptions=array(
													"ssl"=>array(
														"verify_peer"=>false,
														"verify_peer_name"=>false,
													),
												);

												@endphp
											@foreach($images as $image)
												<div class="col{{$perDiv}} mt-3">
													{{--<img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image, false, stream_context_create($arrContextOptions))}}')" class="w-100" src="{{(is_array(getimagesize(url('ra-idlis/storage/app/public/uploaded/'.$image, false, stream_context_create($arrContextOptions)))) ? asset('ra-idlis/storage/app/public/uploaded/'.$image, false, stream_context_create($arrContextOptions)) : url('ra-idlis/public/img/no-preview-available.png', false, stream_context_create($arrContextOptions)))}}" style="cursor: pointer;"> --}}
													<img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{( $image ? asset('ra-idlis/storage/app/public/uploaded/'.$image) : url('ra-idlis/public/img/no-preview-available.png'))}}" style="cursor: pointer;">
													{{--<!-- <img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{(is_array(getimagesize(url('ra-idlis/storage/app/public/uploaded/'.$image))) ? asset('ra-idlis/storage/app/public/uploaded/'.$image) : url('ra-idlis/public/img/no-preview-available.png'))}}" style="cursor: pointer;"> --> --}}
												</div>
											@endforeach
											</div>
										@else
											<div class="container text-center font-weight-bold ">No Image Uploaded</div>
										@endif
							      	</div>
								@endif
							@endif
							@endif
						@break
						@case ('surv')

							@if(empty($user))
								<div class="container text-center font-weight-bold ">No Image Uploaded</div>
							@else
								<div class="container pt-3">
									@if(!empty($data->$user))
										@php 
											$images = explode(',',$data->$user);
											$perDiv = (12 % count($images) == 0 ? '-'.(12 / count($images)) : '-3');
										@endphp
										<div class="container pb-3 pt-3">
											<p class="lead">
												Photos You Submitted
											</p>
										</div>
										<div class="row">
										@foreach($images as $image)


											<div class="col{{$perDiv}} mt-3">

												<img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{( $image ? asset('ra-idlis/storage/app/public/uploaded/'.$image) : url('ra-idlis/public/img/no-preview-available.png'))}}" style="cursor: pointer;">

											</div>
										@endforeach
										</div>
									@else
										<div class="container text-center font-weight-bold ">No Image Uploaded</div>
									@endif
						      	</div>
							@endif
						@break


						@case ('fdamonitoring')
							<div class="container pt-3">
								@if(isset($vio['fromUser']))
									<div class="container pb-3 pt-3">
										<p class="lead">
											Photos You Submitted so far
										</p>
									</div>
									

									@foreach($vio['fromUser'] as $key => $value)
										<div class="row">
											@php 
												$images = explode(',',$value->fileName);
												$perDiv = (12 % count($images) == 0 ? '-'.(12 / count($images)) : '-3');
											@endphp
											@foreach($images as $image)
												<div class="col{{$perDiv}} mt-3">

													{{-- <img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}" style="cursor: pointer;"> --}}
													<img onclick="window.open('{{asset('ra-idlis/storage/app/public/uploaded/'.$image)}}')" class="w-100" src="{{($image ? asset('ra-idlis/storage/app/public/uploaded/'.$image) : url('ra-idlis/public/img/no-preview-available.png'))}}" style="cursor: pointer;">
												</div>
											@endforeach
										</div>
									@endforeach

									

								@else
									<div class="container text-center font-weight-bold ">No Image Uploaded</div>
								@endif
					      	</div>
						@break


					@endswitch



				@endif


			@endif
		</form>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script>
			let increment = 1;
			function processImages(){
				increment++;
				$("#appendArea").prepend(
				'<div class="col-md-2 removePadding">'+
				    '<div class="upload-wrap">'+
				      '<div class="uploadpreview '+increment+'"></div>'+
				      '<div class="container text-center pb-3 filename '+increment+'"></div>'+
				      '<input name="images[]" id="'+increment+'" type="file">'+
				    '</div>'+
				'</div>'
				);
			}


			function previewImages() {
			  var $preview = $('#preview').empty();
			  if (this.files) $.each(this.files, readAndPreview);
			  function readAndPreview(i, file) {
			    if (!/\.(jpe?g|png|gif)$/i.test(file.name)){
			      return alert(file.name +" is not an image");
			    }
			    var reader = new FileReader();
			    $(reader).on("load", function() {
			      $preview.append($("<img/>", {src:this.result, height:100,width:100})) ;
			    });
			    reader.readAsDataURL(file);
			  }
			}
			$('#file-input').on("change", previewImages);

			$("#sendAll").submit(function(event) {
				event.preventDefault();
				let data = new FormData(this);
				$.ajax({
					method: "POST",
					data: data,
					contentType: false,
					processData: false,
					success: function(a){
						if(a == 'done'){
							alert('Submitted Successfully. Please wait for our response on the findings');
							location.reload();
						} else {
							contains('a');
						} 
					}
				})
			});

			$(document).ready(function(){
				$(document).on('change','.upload-wrap input[type=file]',function(){
					var id = $(this).attr("id");
					var newimage = new FileReader();
					newimage.readAsDataURL(this.files[0]);
					if(this.files[0].type.match('image.*')){
						newimage.onload = function(e){
							$('.uploadpreview.' + id ).css('background-image', 'url(' + e.target.result + ')' );
						}
					} else {
						$('.uploadpreview.' + id ).css('background-image', "url('{{url('ra-idlis/public/img/no-preview-available.png')}}')" );
						
					}
					$('.filename.' + id ).text(this.files[0].name);
				});
			})

			@if(!isset($data->explanation))

				document.getElementById("imgexp").value = " ";
			@endif



		</script>
		@include('client1.cmp.footer')
	</body>
	@endsection
