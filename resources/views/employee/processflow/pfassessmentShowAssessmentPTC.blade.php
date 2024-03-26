@if (session()->exists('employee_login'))  
	@extends('mainEmployee')
	@section('title', 'Evaluation Tool')
	@section('content')
	<style type="text/css">
	  .custom-radio .custom-control-input:checked~.custom-control-label.check::before {
	    background-color: #28a745!important;
	  }
	  .custom-radio .custom-control-input:checked~.custom-control-label.times::before {
	    background-color: #dc3545!important;
	  }
	  .custom-radio .custom-control-input:checked~.custom-control-label.na::before {
	    background-color: #FFFF00!important;
	  }
	  a{
		text-decoration: none!important;
	  }
	  .control-group {
	    display: inline-block;
	    vertical-align: top;
	    background: #fff;
	    text-align: left;
	    margin: 10px;
	  }
	  .control {
	    display: block;
	    position: relative;
	    padding-left: 40px;
	    margin-bottom: 15px;
	    cursor: pointer;
	    font-size: 18px;
	  }
	  .control input {
	    position: absolute;
	    z-index: -1;
	    opacity: 0;
	  }
	  .control__indicator {
	    position: absolute;
	    top: 2px;
	    left: 0;
	    height: 30px;
	    width: 30px;
	    background: #e6e6e6;
	  }
	  .control--radio .control__indicator {
	    border-radius: 50%;
	  }
	  .control:hover input ~ .control__indicator,
	  .control input:focus ~ .control__indicator {
	    background: #ccc;
	  }
	  .control input:checked ~ .control__indicator {
	    background: #2aa1c0;
	  }
	  .control:hover input:not([disabled]):checked ~ .control__indicator,
	  .control input:checked:focus ~ .control__indicator {
	    background: #0e647d;
	  }
	  .control input:disabled ~ .control__indicator {
	    background: #e6e6e6;
	    opacity: 0.6;
	    pointer-events: none;
	  }
	  .control__indicator:after {
	    content: '';
	    position: absolute;
	    display: none;
	  }
	  .control input:checked ~ .control__indicator:after {
	    display: block;
	  }
	  .control--checkbox .control__indicator:after {
	    left: 8px;
	    top: 4px;
	    width: 3px;
	    height: 8px;
	    border: solid #fff;
	    border-width: 0 2px 2px 0;
	    transform: rotate(45deg);
	  }
	  .control--checkbox input:disabled ~ .control__indicator:after {
	    border-color: #7b7b7b;
	  }
	  .control--radio .control__indicator:after {
	    left: 7px;
	    top: 7px;
	    height: 16px;
	    width: 16px;
	    border-radius: 50%;
	    background: #fff;
	  }
	  .control--radio input:disabled ~ .control__indicator:after {
	    background: #7b7b7b;
	  }
	  .select {
	    position: relative;
	    display: inline-block;
	    margin-bottom: 15px;
	    width: 100%;
	  }
	  .select select {
	    display: inline-block;
	    width: 100%;
	    cursor: pointer;
	    padding: 10px 15px;
	    outline: 0;
	    border: 0;
	    border-radius: 0;
	    background: #e6e6e6;
	    color: #7b7b7b;
	    appearance: none;
	    -webkit-appearance: none;
	    -moz-appearance: none;
	  }
	  .select select::-ms-expand {
	    display: none;
	  }
	  .select select:hover,
	  .select select:focus {
	    color: #000;
	    background: #ccc;
	  }
	  .select select:disabled {
	    opacity: 0.5;
	    pointer-events: none;
	  }
	  .select__arrow {
	    position: absolute;
	    top: 16px;
	    right: 15px;
	    width: 0;
	    height: 0;
	    pointer-events: none;
	    border-style: solid;
	    border-width: 8px 5px 0 5px;
	    border-color: #7b7b7b transparent transparent transparent;
	  }
	  .select select:hover ~ .select__arrow,
	  .select select:focus ~ .select__arrow {
	    border-top-color: #000;
	  }
	  .select select:disabled ~ .select__arrow {
	    border-top-color: #ccc;
	  }
      .shadow-textarea textarea.form-control::placeholder {
        font-weight: 300;
      }
      .shadow-textarea textarea.form-control {
          padding-left: 0.8rem;
      }
      .z-depth-1{
        -webkit-box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12)!important;
        box-shadow: 0 2px 5px 0 rgba(0,0,0,.16),0 2px 10px 0 rgba(0,0,0,.12)!important;
      }
  </style>

	<div class="content p-4">
		<input type="text" id="CurrentPage" hidden="" value="PF013">
		<div class="card">
			<div class="card-header bg-white font-weight-bold">
	            {{$isMon ? 'Monitoring' : 'Assessment'}} 
	            <button class="btn btn-primary" onclick="window.history.back();">Back</button>
	        </div>
	        <div class="card-body">
	        	<div class="container">
	        		<div class="row">
	        			<div class="col-sm-8 mb-3 ml-3"> 
		                	<h2>{{$data->facilityname}}</h2>
		                <b>	<h5>{{$getFacType}}</h5></b>
		                	<h5>{{$data->streetname .' '. $data->brgyname . ' ' . $data->cmname . ' ' . $data->provname}}</h5>
		                	Scope of Work: {{($ptcTable->construction_description ?? 'USER DID NOT SPECIFIED')}}  
		               	</div>
	        		</div>
	        	</div>
	        	<div class="container">
		        	<div class="row pt-1" style="font-size: 20px;">
						<div class="offset-8 col-md-6">
							<div class="row">
								<div class="col-md-3">Review:</div>
								<div class="col-md-9 text-left font-weight-bold">
									1<sup>st</sup><span id="1">____</span>  
									2<sup>nd</sup><span id="2">____</span>
									{{-- 3<sup>rd</sup><span id="3">____</span> --}}
								</div>
							</div>
						</div>
					</div>
				</div>
	        	<div class="col text-center mt-3 mb-3 font-weight-bold" style="font-size: 15px">
					@isset($crumb)
						@foreach($crumb as $key => $bread)
							{!! ($key == 0 ? '' : ' / ').'<a href="'.(($bread['beforeAddress'] == 'MAIN') ? url('employee/dashboard/processflow/parts/'.$data->appid)  : url('employee/dashboard/processflow/'.$bread['beforeAddress'].'/'.$data->appid.'/'.$bread['id'].'/'.$isMon)).'">'.$bread['desc'].'</a>' !!}
						@endforeach
					@endisset
					
				</div>
				<script>
				console.log("part")
				console.log('{!! $part !!}')
				</script>
	        	<div class="container">
	        		<form id="form1" name="form1" action="{{(isset($toSaveUrl) ? $toSaveUrl : url('employee/dashboard/processflow/SaveAssessments/'))}}" method="POST">
	        			{{csrf_field()}}
	        			<input type="hidden" name="appid" value="{{$data->appid}}">
	        			<input type="hidden" name="part" value="{{$part}}">
	        			{!!($isMon ? '<input type="hidden" name="monid" value="'.$isMon.'">' :'')!!}
	        			<div class="container divs">
	        				<div class="container divs">
        					@if(count($head) > 0)
				            @php 
				              $joinedDataCount = count($head);
				              $headerCheck = null;
				              $header2Check = null;
				              $divide = $joinedDataCount / 30;
				              $divHeaderCount = (is_int($divide) ? $divide : (int)$divide); 
				              $check = 29;
				              $indexSecondHeader = 0;
				              $actions = $rowSize = $remarksHead = null;
				              $arrLvl1 = $arLvl2 = $arLvl3 = $arLvl4 = $newArr = $arrHeaderOneLable = array();
				            @endphp
				            @for ($i = 0; $i <= $divHeaderCount; $i++)
				            <div class="container divContent border rounded">
							
				                @for ($j = $indexSecondHeader; $j <= $check; $j++)
					                @php
					                	$rowSize = 1;
					                @endphp
									
					                {{-- start object exist --}}
					                @if(isset($head[$j]))
					                	{{-- start not empty id --}}
						                @if(!empty($head[$j]->id))
								<div class="row">
								@if(!in_array($head[$j]->h3HeadID, $arrLvl1))
								<div class="col-md text-uppercase font-weight-bold">
									{{-- header 1 --}}
									@if(!in_array($head[$j]->h2HeadBack, $arrHeaderOneLable))
									
									<a style="font-size: 20px;">{{$head[$j]->h2HeadBack}}</a>
									@php
									array_push($arrHeaderOneLable, $head[$j]->h2HeadBack);
									@endphp
									
									@endif
								</div>
								@php 
								array_push($arrLvl1,$head[$j]->h3HeadID); 

								foreach($head as $newTry){

								if($newTry->h3HeadID == $head[$j]->h3HeadID){
								$newArr[] = $newTry;
								if(!in_array($newTry->h2idReal, $arLvl2)){
								array_push($arLvl2,$newTry->h2idReal);
								@endphp
								<div class="container">
								<div class="row">
								<div class="container">
								<div class="col-md font-weight-bold pl-5 pt-2">
									{{-- header 2 --}}
								@if($newTry->isdisplay == 1)
									{{$newTry->h3HeadBack}}
								@endif
								</div>
								@php
									foreach($head as $thirdHeader){
										
									// dd($head);
										if(!in_array($newTry->h3idReal, $arLvl3)){
											array_push($arLvl3,$newTry->h3idReal);
											// if($thirdHeader->h4HeadID == $newTry->h4HeadID){
											@endphp
											<div class="container border">
											<div class="row">
											<div class="container">
											{{-- <div class="col-md" style="padding-left: 3rem!important;">{{$newTry->h4HeadBack}}</div> --}}
											@php
											//dd($head);
											foreach($head as $fourthHeader){
											if($fourthHeader->h4HeadID == $newTry->h4HeadID)
											{
												if(!isset($fourthHeader->subFor))
												{
												@endphp
												<div class="col-md-12">
												<!-- <script>
													var num = {
														id: '{{$fourthHeader->id}}',
														lvl1 : '{{$fourthHeader->h1idReal}}',
														lvl2: '{{$fourthHeader->h2idReal}}',
														lvl3: '{{$fourthHeader->h3idReal}}',
														part: '{{$fourthHeader->partidReal}}',

													}
														console.log(num)
														</script> -->
													<div class="pt-3" style="padding-left: {{($fourthHeader->isAlign != 1 ? '4rem!important;' : '1rem!important;')}}">
														<div class="row operations" id="{{$fourthHeader->id}}" >
															<div class="col-md-3">
																<div class="form-check form-check-inline">
																	{{-- yes --}}
																	<div class="custom-control custom-radio">															
																		<input required type="text" name="{{$fourthHeader->id}}[lvl1]" class="custom-control-input" value="{{$fourthHeader->h1idReal}}">
																		<input required type="text" name="{{$fourthHeader->id}}[lvl2]" class="custom-control-input" value="{{$fourthHeader->h2idReal}}">
																		<input required type="text" name="{{$fourthHeader->id}}[lvl3]" class="custom-control-input" value="{{$fourthHeader->h3idReal}}">
																		<input required type="text" name="{{$fourthHeader->id}}[part]" class="custom-control-input" value="{{$fourthHeader->partidReal}}">
																		<input required type="radio" name="{{$fourthHeader->id}}[comp]" class="custom-control-input" value="true" id="customCheck1{{$fourthHeader->id}}" checked="">
																		<label class="custom-control-label text-success check" for="customCheck1{{$fourthHeader->id}}"><i class="fa fa-check" aria-hidden="true"></i></label>
																	</div> &nbsp;&nbsp;
																	{{-- end yes --}}
																	{{-- no --}}
																	<div class="custom-control custom-radio">
																		<input type="radio" name="{{$fourthHeader->id}}[comp]" onclick="showRemark(this,{{$fourthHeader->id}})" class="custom-control-input" value="false" id="customCheck2{{$fourthHeader->id}}">
																		<label class="custom-control-label text-danger times"  for="customCheck2{{$fourthHeader->id}}"><i class="fa fa-times" aria-hidden="true"></i></label>
																	</div>&nbsp;&nbsp;
																	{{-- end no --}}
																	{{-- na --}}
																	<div class="custom-control custom-radio">
																		<input type="radio" name="{{$fourthHeader->id}}[comp]" class="custom-control-input" value="NA" id="customCheck3{{$fourthHeader->id}}">
																		<label class="custom-control-label text-danger na"  for="customCheck3{{$fourthHeader->id}}">N/A</label>
																	</div>
																	{{-- end na --}}
																</div>
															</div>
															<div class="col-md">
																{{-- assessment combined --}}
																{!!$fourthHeader->description ?? ""!!}
															</div>
															<div class="col-md-2   text-right" id="el{{$fourthHeader->id}}">
																{{-- assessment remarks --}}
																<textarea name="{{$fourthHeader->id}}[remarks]" hidden=""></textarea>
																<a class="text-primary " onclick="showRemark(this,{{$fourthHeader->id}})" style="cursor: pointer;">Add Remarks</a>
																
															</div>
														</div>
													</div>
												</div>

												@php
												} else if(isset($fourthHeader->subFor)){
												@endphp
												<div class="col-md-12">
													<div class="pt-4" style="padding-left: 11.2rem!important;">
														<div class="row operations" id="{{$fourthHeader->id}}">
															<div class="col-md-3">
																<div class="form-check form-check-inline">
																	{{-- yes --}}
																	<div class="custom-control custom-radio">		
																		<input required type="text" name="{{$fourthHeader->id}}[lvl1]" class="custom-control-input" value="{{$fourthHeader->h1idReal}}">
																		<input required type="text" name="{{$fourthHeader->id}}[lvl2]" class="custom-control-input" value="{{$fourthHeader->h2idReal}}">
																		<input required type="text" name="{{$fourthHeader->id}}[lvl3]" class="custom-control-input" value="{{$fourthHeader->h3idReal}}">
																		<input required type="text" name="{{$fourthHeader->id}}[part]" class="custom-control-input" value="{{$fourthHeader->partidReal}}">
																		<input required type="radio" name="{{$fourthHeader->id}}[comp]" class="custom-control-input" value="true" id="customCheck1{{$fourthHeader->id}}" checked>
																		<label class="custom-control-label text-success check" for="customCheck1{{$fourthHeader->id}}"><i class="fa fa-check" aria-hidden="true"></i></label>
																	</div> &nbsp;&nbsp;
															
																	{{-- end yes --}}
																	{{-- no --}}
																	<div class="custom-control custom-radio">
																		<input type="radio" name="{{$fourthHeader->id}}[comp]" onclick="showRemark(this,{{$fourthHeader->id}})" class="custom-control-input" value="false" id="customCheck12{{$fourthHeader->id}}">
																		<label class="custom-control-label text-danger times" for="customCheck12{{$fourthHeader->id}}"><i class="fa fa-times" aria-hidden="true"></i></label>
																	</div>&nbsp;&nbsp;
																	{{-- end no --}}
																	{{-- NA --}}
																	<div class="custom-control custom-radio">
																		<input type="radio" name="{{$fourthHeader->id}}[comp]" class="custom-control-input" value="NA" id="customCheck13{{$fourthHeader->id}}">
																		<label class="custom-control-label text-danger na"  for="customCheck13{{$fourthHeader->id}}">N/A</label>
																	</div>
																	{{-- end NA --}}
																</div>
															</div>
															<div class="col-md">
																{{-- assessment combined --}}
															{!!$fourthHeader->description ?? ""!!}

															</div>
															<div class="offset-1 col-md-2 text-right" id="el{{$fourthHeader->id}}">
																{{-- assessment remarks --}}
																<textarea name="{{$fourthHeader->id}}[remarks]" hidden=""></textarea>
																<a class="text-primary " onclick="showRemark(this,{{$fourthHeader->id}})" style="cursor: pointer;">Add Remarks</a>
																
															</div>
														</div>
													</div>
												</div>
												@php
												}
											}

											}
											@endphp

											</div>
											</div>
											</div>
											@php
											// }
										}
									}
								@endphp
								</div>
								</div>
								</div>
								@php
								}
								}
								}
								@endphp
								{{-- <div class="row"> --}}
								{{-- </div> --}}
								@endif
								</div>
						                @endif
						                {{-- end not empty id --}}
					                @endif
					                {{-- end object exist --}}
				                @endfor
				            </div>
				            @php
	                        	$check = ($check + 30 < $joinedDataCount ? $check + 30 :$joinedDataCount);
              					$indexSecondHeader +=30;
	                        @endphp
				            @endfor
					        @endif
					        <div class="container mt-5 text-center">
								<span class="display-4">Comments</span>
								<textarea name="comment" cols="30" rows="10" class="form-control mb-3 mt-3"></textarea>
							</div>
	        				</div>
	        				<hr>

	        				@if(!empty($head))
				              <div class="container">    
				                <center class="d-flex justify-content-center">
				                   <nav aria-label="Page navigation example">
				                      <ul class="pagination">
				                        <div class="col-3">
				                          <span>
				                            <div class="btn-group">
				                              {{-- <li id="prev" class="page-item">
				                                <button disabled class="btn btn-success mr-1 p-3" type="button"><i class="fa fa-chevron-left"></i> Previous</button>
				                              </li> --}}
				                              <li {{-- id="next" --}} class="page-item">
				                                {{-- <button class="btn btn-success mr-1 p-3" type="button">Next <i class="fa fa-chevron-right"></i></button> --}}
				                            <!-- <buton onclick="getAll()">Get</buton> -->
											    <button class="btn btn-primary mr-1 p-3" type="submit">Submit <i class="fa fa-chevron-right"></i></button>
				                              </li>
				                            </div>
				                          </span>
				                        </div>
				                      </ul>
				                    </nav>
				                </center>
				                <div class="container" id="errorsDiv">
				                  
				                </div>
				              </div>
				            @endif
	        			</div>
	        		</form>
	        	</div>
	        </div>
    	</div>
	</div>

	<div class="modal fade" id="addRemarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 0px;border: none;">
          <div class="modal-body" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center">
            	<span id="labelBeforeDetails" style="font-size: 25px;">Add Remarks on:</span>
            	<p class="font-weight-bold lead" style="font-size: 20px;" id="detailsOfItem"></p>
            </h5>
            <hr>
			<form id="dummyTextarea">
	            <div class="col-sm-12">
	              <input type="hidden" name="idOfRemarks">
	              <textarea class="form-control" name="dummyTextarea" id="" cols="30" rows="10"></textarea>
	            </div>
	            <div class="col-sm-12 d-flex justify-content-center pt-3 pb-3">
	              <div class="row">
	              	<div class="col-md-5">
	              		<button type="submit" class="btn btn-primary">Submit</button>
	              	</div>
	              	<div class="col-md-5">
	              		<button class="btn btn-danger" data-dismiss="modal">Cancel</button>
	              	</div>
	              </div>
	            </div>
			</form>
          </div>
        </div>
      </div>
    </div>
	{{-- {{dd($arrLvl1, $arLvl2 ,$arLvl3, $arLvl4, $newArr,$head)}} --}}
<script>
function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}


	$('#form12').on('submit', function(event){
		event.preventDefault();
// 		var $form = $("#form1");
// var data = getFormData($form);
// data = JSON.stringify(data);
// console.log(data)



	// let data = new FormData(this);
    // var arr = $(this).serializeArray();
    // console.log("arr");
    // console.log($("#form1").serialize()+'&form_name='+$("#form1").attr("name"));

	var form_data = $(this).serialize()
// console.log(form_data)
	$.ajax({
							url: '{{asset('/api/ptc/save/asessment')}}',
							dataType: "json", 
	    					// async: false,
							type: 'POST',
							data:form_data,
							// data:$("#form1").serialize()+'&form_name='+$("#form1").attr("name"),

							success: function(a){
								console.log("request")
								console.log(a.request)
							},
							fail: function(a,b,c){
								console.log("fail")
								console.log([a,b,c]);
							}
						})





    return false; //      /<-- Only, if you don't want the form to be submitted after above commands


});
</script>
		<script type="text/javascript">
		    let errorField, messageToUser;
		    $(document).ready(function(){
		    	@if(isset($evalFromOthers) && isset($isOtherUid))
		    	$.ajax({
		    		method: 'POST',
		    		data: {_token: $("[name=_token]").val(), getRemark: 'get'},
		    		success: function(a){
		    			$('textarea[name=comment]').text(JSON.parse(a)['details']);
		    		}
		    	})
		    	
		    	let fromOthersData = {!!json_encode($evalFromOthers)!!};
		    	let onSwitch;
		    	$.each(fromOthersData, function (index, item) {
		    		switch (item['evaluation']) {
		    			case "0":
		    				onSwitch = false;
		    				break;
		    			case "1":
		    				onSwitch = true;
		    				break;
		    			default:
		    				onSwitch = 'NA';
		    				break;
		    		}
				  $('div#'+index).find('input[name="'+index+'[comp]"][value="'+onSwitch+'"]').prop('checked',true);
				  // $('div#'+index).find('textarea[name="'+index+'[remarks]"]').text(item['remarks']);
				  if(item['remarks'] != null && $.trim(item['remarks']) != ""){
					$('form#dummyTextarea').find('input[name=idOfRemarks]').val(index)
					$('form#dummyTextarea').find('textarea').text(item['remarks']);
					$('form#dummyTextarea').submit();
				  }
				});
		    	@endif
		      $(".divs .divContent").each(function(e) {
		        // if (e != 0)
		          // $(this).hide();
		      });
		      $(document).on('click','#next',function(){
		          let accept = true;
		          let errorElement = [];
		          let compiledError = [];
		          let remarksText = null;
		          $('.operations', $('.divs .divContent:visible')).each(function () {
		            remarksText = $(this).find('textarea');
		            let errorCurrent = $(this).attr('id');
		            $('.booleans', $(this)).each(function(){
		              if(typeof($(this).find("input[type=radio]:checked").val()) == 'undefined'){
		                $(this).find("input[type=radio]").parent().parent().parent().parent().css({
		                    'border': 'solid 1px red'
		                  });
		                errorField = 'field';
		                if(remarksText.length > 0 && $.trim(remarksText.val()) == ""){
		                    remarksText.css({
		                     'border': 'solid 1px red'
		                    })
		                    errorField = 'remarks';
		                } else {
		                    remarksText.css({
		                     'border': 'solid 1px #ced4da'
		                    })
		                }
		                accept = false;
		                if (errorElement.indexOf(errorCurrent) === -1) {
		                    errorElement.push(errorCurrent);
		                }
		              } else if($(this).find("input[type=radio]").length > 0 && $(this).find('input[type=radio]:checked').val() == 'false'){
		                  if($(this).find("input[type=radio]:checked").val() == 'false' && remarksText.length > 0 && $.trim(remarksText.val()) == ""){
		                      $(this).find("input[type=radio]").parent().parent().parent().parent().css({
		                       'border': 'solid 0px black'
		                      });
		                      remarksText.css({
		                       'border': 'solid 1px red'
		                      })
		                      errorField = 'remarks';
		                      accept = false;
		                        if (errorElement.indexOf(errorCurrent) === -1) {
		                            errorElement.push(errorCurrent);
		                        }
		                  } else {
		                      $(this).find("input[type=radio]").parent().parent().parent().parent().css({
		                        'border': 'solid 0px black'
		                      });
		                      remarksText.css({
		                       'border': 'solid 1px #ced4da'
		                      })
		                  }
		              } else if($(this).find("input[type=radio]").length > 0 && $(this).find('input[type=radio]:checked').val() == 'true'){
		                  if($(this).parent().parent().find("input[value=false]:checked",typeof("input[type=radio]") == 'undefined').length > 0 && $.trim(remarksText.val()) == ""){
		                      remarksText.css({
		                       'border': 'solid 1px red'
		                      })
		                      errorField = 'remakrs';
		                  } else {
		                      $(this).find("input[type=radio]").parent().parent().parent().parent().css({
		                       'border': 'solid 0px black'
		                      });
		                      remarksText.css({
		                        'border': '1px solid #ced4da'
		                      });
		                  }

		              } 
		              else if(remarksText.length > 0 && $.trim(remarksText.val()) != "" && $(this).find("input[type=radio]").length > 0 && $(this).find('input[type=radio]:checked').val() == 'false'){
		                  remarksText.css({
		                    'border': '1px solid #ced4d'
		                  });
		                  errorField = 'remarks';
		                  accept = false;
		                  if (errorElement.indexOf(errorCurrent) === -1) {
		                    errorElement.push(errorCurrent);
		                  }
		                } else {
		                  accept = true;
		                }
		              // else {
		              // 	accept = true;
		              // }   
		            })
		          });

		          if(accept == false){
		            compiledError = [];
		            errorElement.forEach(function(item) {
		              compiledError.push('<a style="cursor:pointer" onclick="gotoElement('+item+')">'+item+'</a>')
		            });
		              messageToUser = 'Please provide answer on all requirements.';
		            if(errorField == 'remarks'){
		              messageToUser = 'Please Provide a remarks if facility does not comply on requirements and provide answer on all requirements.';
		            }
		            $('#errorsDiv').html(
		              '<div class="alert alert-danger" role="alert">'+
		                '<span class="text-primary">Error(s) where found on question(s):</span><br>'+
		                compiledError.join(', ')+'<br><br>'+
		                messageToUser+
		              '</div>'
		              )
		          } else {
		            $('#errorsDiv').empty();
		          }

		          if ($(".divs .divContent:visible").next().length != 0 && accept == true){
		            if($("#prev").children().attr('disabled') == 'disabled'){
		              $("#prev").children().removeAttr('disabled');
		            }
		            $(".divs .divContent:visible").next().show().prev().hide();
		          }
		          else if(accept == true){
		              $(this).children().attr('disabled','');
		              $(this).replaceWith('<button class="btn btn-primary mr-1 p-3" type="submit">Submit <i class="fa fa-chevron-right"></i></button>');
		          }
		          return false;
		      });
		      $(document).on('click','#prev',function(){
		          if ($(".divs .divContent:visible").prev().length != 0){
		              if($("#next").children().attr('disabled') == 'disabled'){
		                $("#next").children().removeAttr('disabled');
		              } else if($("#prev").next().prop('type') == 'submit'){
		                $("#prev").next().replaceWith(
		                  '<li id="next" class="page-item"><button class="btn btn-success mr-1 p-3" type="button">Next <i class="fa fa-chevron-right"></i></button></li>'
		                  );
		              }
		              $(".divs .divContent:visible").prev().show().next().hide();
		          }
		          else {
		              $(this).children().attr('disabled','');
		          }
		          return false;
		      });
		    });

			$("#dummyTextarea").submit(function(event) {
				event.preventDefault();
				let idOFElement = $(this).find('input[name=idOfRemarks]').val();
				$("textarea[name='"+idOFElement+"[remarks]']").text($(this).find('textarea').val());
				$('div#el'+idOFElement).find('a').replaceWith('<a class="text-primary" onclick="showRemarkWithAnswer(this,'+idOFElement+')" style="cursor: pointer;">Show Remarks</a>');
				$('#addRemarks').modal('hide');
			});

		    function gotoElement(id){
		      $('html,body').animate({
		        scrollTop: $("#"+id).offset().top
		      },'slow');
		    }

		    function showRemark(element,idOfElement){
		    	$("textarea[name=dummyTextarea]").val('');
		    	$('input[name=idOfRemarks]').val('');
		    	$('#addRemarks').modal('show');
		    	$("#detailsOfItem").empty().text($(element).parent().prev().text());
		    	$("input[name=idOfRemarks]").val(idOfElement);
		    	$("#dummyTextarea").find('button[type=submit]').text('Save');
		    	$("#labelBeforeDetails").text('Add Remarks on:');
		    }

		    function showRemarkWithAnswer(element,idOfElement){
		    	$("textarea[name=dummyTextarea]").val($(element).prev().val());
		    	$('#addRemarks').modal('show');
		    	$("#detailsOfItem").empty().text($(element).parent().prev().text());
		    	$("input[name=idOfRemarks]").val(idOfElement);
		    	$("#dummyTextarea").find('button[type=submit]').text('Update');
		    	$("#labelBeforeDetails").text('Update Remarks on:');
		    }
		    
		    @isset($revision)
			$("#"+{{$revision}}).replaceWith('<i class="p-3 fa fa-check" aria-hidden="true"></i>');
			@endisset
  	</script>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
