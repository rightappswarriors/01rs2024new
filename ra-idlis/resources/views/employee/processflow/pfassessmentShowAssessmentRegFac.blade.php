@if (session()->exists('employee_login'))  
	@extends('mainEmployee')
	@section('title', 'Assessment Tool')
	@section('content')
	<style type="text/css">
	  a{
		/*text-decoration: none!important;*/
	  }
	  .control-group {
	    display: inline-block;
	    vertical-align: top;
	    background: #fff;
	    text-align: left;
	    /*margin: 10px;*/
	  }
	  .control {
	    display: block;
	    position: relative;
	    padding-top: 5px;
	    padding-left: 37px;
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

      #errorsDiv {
		    position: fixed;
		    top: 50%;
		    left: -12px;
		    width: 18%;
		}
		#inner-message {
		    margin: 0 auto;
		}
  </style>
		<div class="content p-4">
			<div class="card">
				{{-- <div id="message">
				    <div style="padding: 5px;">
				        <div id="inner-message" class="alert alert-error">
				            <button type="button" class="close" data-dismiss="alert">&times;</button>
				            test error message
				        </div>
				    </div>
				</div> --}}
				{{-- <div id="dialog" title="Basic dialog" style="float:right;">
				  <p>This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.</p>
				</div> --}}
				<div class="card-header bg-white font-weight-bold">
		            {{$isMon ? 'Monitoring' : 'Assessment'}} 
		            <button class="btn btn-primary" onclick="window.history.back();">Back</button>
		        </div>
		        <div class="card-body">
		        	<div class="container">
		        		<div class="row">
		        			<div class="col-sm-8 mb-3 ml-3"> 
			                	<h2>{{$data->facilityname}}</h2>
			                	<h5>{{$data->streetname .' '. $data->brgyname . ' ' . $data->cmname . ' ' . $data->provname}}</h5> 
			               	</div>
		        		</div>
		        	</div>
		        	<div class="col text-center mt-3 mb-3 font-weight-bold" style="font-size: 15px">
						@isset($crumb)
							@foreach($crumb as $key => $bread)
								{!! ($key == 0 ? '' : ' / ').'<a href="'.(($bread['beforeAddress'] == 'MAIN') ? url('employee/dashboard/processflow/parts/'.$regfac_id)  : url('employee/dashboard/processflow/'.$bread['beforeAddress'].'/'.$regfac_id.'/'.$bread['id'].'/'.$isMon)).'">'.$bread['desc'].'</a>' !!}
							@endforeach
						@endisset
					</div>
		        	<div class="container-fluid">
		        		<form action="{{(isset($toSaveUrl) ? $toSaveUrl : url('employee/dashboard/processflow/SaveAssessments/regfac/'))}}" method="POST">
		        			{{csrf_field()}}
		        			<input type="hidden" name="regfac_id" value="{{$regfac_id}}">
		        			<input type="hidden" name="part" value="{{$part}}">
							<input type="hidden" name="hid" value="{{ app('request')->input('hid') }}">
                 		    <input type="hidden" name="xid" value=" {{ app('request')->input('xid') }}">
                 		    <input type="hidden" name="pid" value=" {{ app('request')->input('pid') }}">
                 		    <input type="hidden" name="monid" value=" {{$isMon}}">
		        			{!!($isMon ? '<input type="hidden" name="monid" value="'.$isMon.'">' :'')!!}
		        			<div class="container-fluid divs">
		        				<div class="container-fluid divs">
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
						            @endphp
						            @for ($i = 0; $i <= $divHeaderCount; $i++)
						            <div class="container-fluid divContent border rounded">
						                @for ($j = $indexSecondHeader; $j <= $check; $j++)
							                @php
							                	$rowSize = 10;
							                @endphp
							                {{-- start object exist --}}
							                @if(isset($head[$j]))
							                	{{-- start not empty id --}}
								                @if(!empty($head[$j]->id))
													<div class="row border-bottom">
														@if($head[$j]->otherHeading && trim(strip_tags($head[$j]->otherHeading)) != '')
														<div class="container-fluid border-bottom" style="background-color: rgb(196,188,150);">
															{!!(isset($head[$j]->otherHeading) ? '<span class="font-weight-bold">'. $head[$j]->otherHeading.'</span>' :  "")!!}
														</div>
														@endif

														<div class="col-md-7 border-right">
															<div class="pt-3">
															

															{!!$head[$j]->description ?? ""!!}
															</div>
														</div>
														<div class="col-md-5 operations" id="{{$head[$j]->id}}">
															<div class="col text-center mt-3">
						                                      <span class="display-4"></span>
						                                    </div>
															<div class="col-md pt-3">
																{{-- <input type="hidden" name="{{$head[$j]->id}}[header]" value="{{addslashes($head[$j]->otherHeading) ?? ""}}"> --}}
																<div class="row booleans">
																	<div class="col-md-3">
																		<div class="control-group">
																			<label class="control control--radio">
																				<i class="fa fa-check text-success"></i>
							                                                    <input value="true" type="radio" onclick="toggleRemarks(document.getElementById('{{$head[$j]->id}}showrem'), 'check')" name="{{$head[$j]->id}}[comp]" checked=""/>
							                                                    <div class="control__indicator"></div>
							                                                </label>
																		</div>
																	</div>
																	<div class="col-md-3">
																		<div class="control-group">
																			<label class="control control--radio">
																				<i class="fa fa-times text-danger"></i>
							                                                    <input value="false" type="radio" onclick="toggleRemarks(document.getElementById('{{$head[$j]->id}}showrem'), 'wrong')" name="{{$head[$j]->id}}[comp]" />
							                                                    <div class="control__indicator"></div>
							                                                </label>
																		</div>
																	</div>
																	<div class="col-md-2">
																		<div class="control-group">
																			<label class="control control--radio">
																				<span class="text-danger">N/A</span>
							                                                    <input value="NA" type="radio" onclick="toggleRemarks(document.getElementById('{{$head[$j]->id}}showrem'), 'na')" name="{{$head[$j]->id}}[comp]" />
							                                                    <div class="control__indicator"></div>
							                                                </label>
																		</div>
																	</div>
																	<div class="col-md-3">
																		<div class="control-group">
																			<div class="form-group shadow-textarea">
																				<div class="text-center">
																					<div class="">
																						<span class="text-danger" style="display: none;">*Remarks Available*</span>
																					</div>
																					<button type="button" onclick="toggleRemarks(this)"  id="{{$head[$j]->id}}showrem" class=" btn btn-primary">Add Remarks</button>
																				</div>
																				<label for="comp{{$head[$j]->id}}"></label>
									                                        	<textarea class="form-control z-depth-1" name="{{$head[$j]->id}}[remarks]" id="comp{{$head[$j]->id}}" rows="{{$rowSize}}" placeholder="" style="display: none;"></textarea>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
															{{-- <div class="col-md border-top border-secondary">
																<div class="form-group shadow-textarea" id="remarksDiv">
																	<div class="mt-3 text-center">
																		<div class="pb-2">
																			<span class="text-danger" style="display: none;">*Remarks Available*</span>
																		</div>
																		<button type="button" onclick="toggleRemarks(this)" class="btn-block btn btn-primary">Show Remarks Field</button>
																	</div>
						                                        	<label for="comp{{$head[$j]->id}}"></label>
						                                        	<textarea class="form-control z-depth-1" name="{{$head[$j]->id}}[remarks]" id="comp{{$head[$j]->id}}" rows="{{$rowSize}}" placeholder="" style="display: none;"></textarea>
						                                      	</div>
															</div> --}}
														</div>
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
					                              <li id="prev" class="page-item">
					                                <button disabled class="btn btn-success mr-1 p-3" type="button"><i class="fa fa-chevron-left"></i> Previous</button>
					                              </li>
					                              <li id="next" class="page-item">
					                                <button class="btn btn-success mr-1 p-3" type="button">Next <i class="fa fa-chevron-right"></i></button>
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

		<script type="text/javascript">
		    let errorField, messageToUser;
		    $(document).ready(function(){
		    	@isset($evalFromOthers)
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
		    			case "2":
		    				onSwitch = 'NA';
		    				break;
		    		}
		    		// console.log(typeof(item['evaluation']));
				  $('div#'+index).find('input[name="'+index+'[comp]"][value="'+onSwitch+'"]').prop('checked',true);
				  $('div#'+index).find('textarea[name="'+index+'[remarks]"]').text(item['remarks']);
				});
		    	@endisset
		      $(".divs .divContent").each(function(e) {
		        // if (e != 0)
		        //   $(this).hide();
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
		                  	  if(remarksText.is(':visible') == false){
		                  	  	remarksText.parent().find('button').click();
		                  	  }
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
		            errorElement.forEach(function(item,ind) {
		              if(ind == 0){
		              	gotoElement(item);
		              }
		              compiledError.push('<u><a style="cursor:pointer" onclick="gotoElement('+item+')">'+item+'</a></u>')
		            });
		              messageToUser = 'Please provide answer on all requirements.';
		            if(errorField == 'remarks'){
		              messageToUser = 'Please Provide a remarks if facility does not comply on requirements and provide answer on all requirements.<br><div id="otherButtonParent" class="d-flex justify-content-center mt-3"><button id="otherButton" class="btn btn-success mr-1 p-3" type="button">Check</button></div>';
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
		            $('#otherButtonParent').html('<span class="text-success">No errors were found.</span>')
		          }

		          if ($(".divs .divContent:visible").next().length != 0 && accept == true){
		            if($("#prev").children().attr('disabled') == 'disabled'){
		              $("#prev").children().removeAttr('disabled');
		            }
		            // show next if no errors
		            document.documentElement.scrollTop = 0;
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
		              // previous if available
		              document.documentElement.scrollTop = 0;
		              $(".divs .divContent:visible").prev().show().next().hide();
		          }
		          else {
		              $(this).children().attr('disabled','');
		          }
		          return false;
		      });

		      $(document).on('click','#otherButton',function(){
		      	$('#next:visible').click();
		      })
		    });

		    function gotoElement(id){
		      $('html,body').animate({
		        scrollTop: $("#"+id).offset().top
		      },'slow');
		    }

		    function toggleRemarks(element , type = 'but'){
		    	if($(element).length > 0 && $(element).parent().next().next().length > 0){
		    		let currentRemark = $(element).parent().next().next();
		    		// currentRemark.toggle();
					if(type == 'wrong'){
						currentRemark.toggle(true);
					}else if(type == 'check' || type == 'na'){
						currentRemark.toggle(false);
					}else{
						currentRemark.toggle();
					}


		    		if($(currentRemark).is(":visible")){
		    			$(element).text('Hide Remarks');
		    		} else {
		    			$(element).text('Add Remarks');
		    		}
		    		
		    		if ($.trim($(currentRemark).val())) {
		    			$(element).prev().find('span').toggle();
		    		}
		    	} else {
		    		alert('textarea not found');
		    	}
		    }
  	</script>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
