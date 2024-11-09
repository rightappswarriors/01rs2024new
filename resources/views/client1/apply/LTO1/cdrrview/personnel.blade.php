@if (session()->exists('employee_login'))     

	@extends('mainEmployee')	
    @section('title', 'Tag Pharmacy Personnel')
	@include('client1.cmp.__apply')
	@section('content')

		<div class="content p-4">
		
			<div class="card">
				<div class="card-header bg-white font-weight-bold">
					<input type="text" id="NumberOfRejected" value="@isset ($numOfX) {{$numOfX}} @endisset" hidden>
					<input type="" id="token" value="{{ Session::token() }}" hidden>             
					{{--<button class="btn btn-primary  ml-3 pb-2 pt-2 mt-2 mb-2 font-weight-bold" onclick="window.history.back();">Back</button>&nbsp;--}}
					&nbsp; 
					<span>
						<a href="{{asset('employee/dashboard/processflow/evaluate/')}}/{{$AppData->appid}}/pharma">Pre-assessment (Pharmacy)</a> > Pharmacist Tagging
					</span>
				</div>

				<div class="card-body">
					<div class="col-sm-12">
						<h2>@isset($AppData)[<strong>{{$AppData->hfser_id}}R{{$AppData->rgnid}}-{{$AppData->appid}}</strong>]
						&nbsp;{{$AppData->facilityname}} @endisset</h2>
						<h5>
							@isset($AppData)
								{{ $AppData->street_number?  strtoupper($AppData->street_number).',' : ' ' }}
								{{ $AppData->streetname?  strtoupper($AppData->streetname).',': ' '}}
								{{strtoupper($AppData->brgyname)}}, 
								{{$AppData->cmname}}, {{$AppData->provname}} 
							@endisset
						</h5>
						<label>Process Type:&nbsp;</label>
						<span class="font-weight-bold">
							@if($AppData->aptid == 'R'){{'Renewal'}}@elseif($AppData->aptid == 'IN'){{'Initial New'}}@else{{'Unidentified'}}@endif
							@if(isset($AppData->hfser_id)){{' '.$AppData->hfser_id}}@endif
						</span><br/>
						<label>Institutional Character:&nbsp;</label>
						<span class="font-weight-bold">
							{{' '.$AppData->facmdesc}}
						</span><br/>
						<label>Status:&nbsp;</label>
						<span class="font-weight-bold">
							{{' '.$AppData->trns_desc}}
						</span>
					</div>

					@if($tag)
						<div class="col-sm-12">
							<div class="container display-4 mb-3 text-center">Pharmacist Tagging</div>
						</div>
					@endif

					<div class="table-responsive  backoffice-list">
						<table class="table table-hover" id="tApp">
							<thead style="background-color: #428bca; color: white" id="theadapp">
								<tr>
									@if($tag)
										<th class="text-center">Connected with<br/>other HF?</th>
									@endif
									<th class="text-center">Name of Personnel</th>
									<th class="text-center">Designation<br/>/Position</th>
									<th class="text-center">Qualification</th>
									<th class="text-center">Date of Birth,<br/>Email Address,<br/>TIN No.</th>
									<th class="text-center">Area of<br/>Assignment</th>
									<th class="text-center">PRC Reg.No.</th>
									<th class="text-center">Validity<br/>Date</th>
									<th class="text-center">PRC</th>							
									<th class="text-center">Certificate<br/>of Training</th>
									@if($tag)
										<th class="text-center">Option</th>
									@endif

									<th class="text-center">Remarks</th>
									<th class="text-center">Tagged By</th>
								</tr>
							</thead>
							<tbody id="loadHere">
								@foreach($cdrrpersonnel as $personnel)

									<tr>
										@if($tag)
											<th class="text-center">{!!$personnel->isTag == 1 ? '<span class="text-danger">Yes</span>' : '<span class="text-dark">No</span>'!!}</th>
										@endif
										<td class="text-center">
											@if($personnel->isTag == 1)<i class="fa fa-tag" aria-hidden="true" style="color:red"></i>&nbsp; @endif
											{{ucwords($personnel->name)}}
											@if($personnel->isTag == 1)<br/><span style="font-size: xx-small; color: red;">[ T a g g e d ]</span>@endif
										</td>
										<td class="text-center">{{ucwords($personnel->designation)}}</td>
										<td class="text-center">
											@php 
												$personel_professions = json_decode($personnel->profession);

												if($personel_professions != NULL){
													foreach($personel_professions as $personel_profession){
														if(isset($profession[$personel_profession.'-Pharmacy'])){
															echo $profession[$personel_profession.'-Pharmacy'].'<br>';
														}
													}
												}
											@endphp
										</td>
										<td>DOB: {{$personnel->dob}}<br/>Email: {{$personnel->email}}<br/>TIN#: {{$personnel->tin}}</td>
										<td class="text-center">{{$personnel->area}}</td>
										<td class="text-center">{{$personnel->prcno}}</td>
										<td class="text-center">{{$personnel->validity}}</td>
										<td class="text-center">
											<a target="_blank" href="{{ route('OpenFile', $personnel->prc)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
										</td>
										<td class="text-center">
											<a target="_blank" href="{{ route('OpenFile', $personnel->coe)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
										</td>

										@if($tag)
											@switch($personnel->isTag)
												@case(1)
													<td class="text-center">
														<button data-toggle="modal" data-target="#tag_untag_Modal" class="btn btn-primary" onclick="showData(0,'{{$personnel->id}}', '{{ucwords($personnel->name)}}')"><i class="fa fa-times" aria-hidden="true"></i> Un-tag</button>
													</td>
												@break;
												@default
													<td class="text-center">
														<button data-toggle="modal" data-target="#tag_untag_Modal" class="btn btn-danger" onclick="showData(1,'{{$personnel->id}}', '{{ucwords($personnel->name)}}')"><i class="fa fa-tag" aria-hidden="true"></i> Tag</button>
													</td>
												@break
											@endswitch
										@endif

										<td>{{$personnel->remarkstag}}</td>
										<td class="text-center">{{$personnel->tagBy}}</td>
									</tr>

								@endforeach
							</tbody>  
						</table>
					</div>  
				</div>    
				
			</div>
			<br>
		</div>


		<div class="modal fade" id="tag_untag_Modal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
			{{csrf_field()}}
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				
				<div class="modal-content bg-dark">
					
					<form id="tag_untag">
						
					</form>

				</div>       

			</div>
		</div>
	
	  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
		<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>

		<script>
			$(document).ready(function() {
			    $('.js-example-basic-multiple').select2();
			});
			$(function(){
				$("#tApp").dataTable();
			})

			function showData(choice,id, personnel){
				let submitname = '', submitbtn = '', title = '', actiondesc = '';

				switch (choice) {
					case 0:
						title = 'Untagged';
						actiondesc = 'untag';
						submitname = 'Untag';
						submitbtn = 'primary';
						break;
					case 1:
						title = 'Tagged';
						actiondesc = 'tag';
						submitname = 'Tag';
						submitbtn = 'danger';
						break;
				}

				$("#tag_untag").empty().append(
					'<div class="modal-header" id="viewHead">' +
							'<h5 class="modal-title text-white" id="viewModalLabel">'+title+' Personnel</h5>' +
							'<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">' +
								'<span aria-hidden="true">&times;</span>' +
							'</button>' +
						'</div>' +

							'<div class="modal-body bg-white">' +
								'<div class="container">' +
									'<div class="col-md text-center text-warning">' +
										'<i class="fa fa-exclamation-circle mt-5 mb-3" style="font-size: 200px;" aria-hidden="true"></i>' +
									'</div>' +
									'<div class="col-md text-center">' +
										'<span style="font-size: 30px;">Are you sure you want to '+actiondesc+' '+personnel+'?</span>' +
										'<br>' +
										'{{csrf_field()}}' +
										'<input type="hidden" name="id" value="'+id+'">' +
										'<input type="hidden" name="action" value="'+choice+'">' +

										'<span style="font-size: 30px;">Remarks:</span>' +
										'<textarea class="w-100 form-control" name="remarkstag" cols="30" rows="10"></textarea>' +
									'</div>' +
								'</div>' +
							'</div>' +

						'<div class="modal-footer">' +
							'<button class="btn btn-'+submitbtn+' p-3" name="submit" type="submit"><i class="fa fa-tag" aria-hidden="true"></i> '+submitname+'</button>' +
							'<button class="btn btn-default p-3" type="button" data-dismiss="modal">Close</button>' +
						'</div>'
					);
			}

			
			$(document).on('submit','#tag_untag',function(event){
				event.preventDefault();
				let data = $(this).serialize();
				$.ajax({
					type: 'POST',
					data:data,
					success: function(a){
						if(a == 'DONE'){
								alert('Selected Operation successful');
							location.reload();
						} else {
							console.log(a);
						}
					}
				})
			})

			function submit(choice,id){
				let r;
				switch (choice) {
					case 0:
						r = confirm('Are you sure you want to Untag this Personnel?');
						break;
					case 1:
						r = confirm('Are you sure you want to tag this Personnel?');
						break;
				}
				if(r){
					$.ajax({
						method: 'POST',
						data: {action : choice,id: id, _token: '{{csrf_token()}}'},
						success: function(a){
							if(a == 'DONE'){
								alert('Selected Operation successful');
								location.reload();
							} else {
								console.log(a);
							}
						}
					})
				}
			}
			
		</script>
    @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif