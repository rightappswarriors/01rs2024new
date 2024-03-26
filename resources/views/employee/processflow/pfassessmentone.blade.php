@if (session()->exists('employee_login'))  
  @if(empty($joinedData))
    {!!'<script>alert("No Services Selected. Please select and Try again.");window.location = "/doholrs4/employee/dashboard/processflow/assessment"</script>'!!}
  @endif
  @extends('mainEmployee')
  @section('title', (isset($linkToSend) ? 'Evaluation' :'Assessment Process Flow'))
  @section('content')
  <style type="text/css">
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
    padding-left: 30px;
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
    height: 20px;
    width: 20px;
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
    height: 6px;
    width: 6px;
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
      <div class="card">
          <div class="card-header bg-white font-weight-bold">
             {{(isset($linkToSend) ? 'Evaluation' :'Assessment')}} 
             <button class="btn btn-primary" onclick="window.history.back();">Back</button>
          </div>
          <div class="card-body">
            <div class="container"> 
              <div class="row">
                <div class="col-sm-8 mb-3 ml-3"> 
                  @if(isset($AppData))
                      <h2>{{$AppData->facilityname}}</h2>
                      <h5>{{strtoupper($AppData->streetname)}}, {{strtoupper($AppData->brgyname)}}, {{$AppData->cmname}}, {{$AppData->provname}} {{$AppData->zipcode}}</h5>
                      {{-- <h6>Status:@if ($AppData->isInspected === null) <span style="color:blue">For Inspection</span> @elseif($AppData->isInspected == 1)  <span style="color:green">Accepted Inspection</span> @else <span style="color:red">Rejected Inspection</span> @endif</h6> --}}
                  @else
                  @endif
                </div>
              </div>  
            </div>
             <div class="container">
            <form id="assessmentSend" action="{{(isset($linkToSend) ? $linkToSend  : asset('/employee/dashboard/processflow/assessment/view/'.$appId.'/'.$apptype))}}" method="POST">
              {{csrf_field()}}
              <input type="text" id="header" name="header" value="@isset($header){{ $header }}@endisset" hidden readonly="">
              <input type="text" id="monType" name="monType" value="@isset($monType){{$monType}}@endisset" hidden readonly="">
              <input type="text" id="AppID" name="appID" value="@isset($appId){{$appId}}@endisset" hidden readonly="">
              <input type="text" id="org" name="org" value="@isset($org){{$org}}@endisset" hidden readonly="">
                <input type="text" id="facilityname" name="facilityname" value="@isset($AppData->uid){{$AppData->uid}}@endisset" hidden readonly="">
                <input type="text" id="filename" name="filename" value="@isset($filenames){{ implode(',',$filenames) }}@endisset" hidden readonly="">
              <input type="text" id="assessor" name="assessor" value="@isset($assessor){{$assessor}}@endisset" hidden readonly="">
            <div class="container divs">
            <div class="container divs">
              @if(count($joinedData) > 0)
                @php 
                  $joinedDataCount = count($joinedData);
                  $headerCheck = null;
                  $header2Check = null;
                  $divide = $joinedDataCount / 30;
                  $divHeaderCount = (is_int($divide) ? $divide : (int)$divide); 
                  $check = 29;
                  $indexSecondHeader = $countForSort = 0;
                  $actions = $rowSize = $remarksHead = null;
                @endphp
                @for ($i = 0; $i <= $divHeaderCount; $i++)
                  {{-- check exist facname --}}
                    <div class="container divContent border">
                    @for ($j = $indexSecondHeader; $j <= $check; $j++)
                      @php
                        $rowSize = null;
                      @endphp
                       {{-- if array exist --}}
                       @if(array_key_exists($j,$joinedData))
                          {{-- if not not empty appid --}}
                          @if(!empty($joinedData[$j]['appid']))
                          {{-- if not empty hospitalType --}}
                            {{-- @if(!empty($joinedData[$j]['hospitalType'])) --}}
                            {{-- @if($joinedData[$j]['asmt2_id'] != 'APP002') --}}
                            @php
                              $actions = json_decode($joinedData[$j]['srvasmt_col']);
                            @endphp
                             <div class="container">
                                {{-- serv_id: {{$joinedData[$j]['srvasmt_id']}}<br> --}}
                                {{-- seq num : {{$joinedData[$j]['srvasmt_seq']}}<br> --}}
                              </div>
                              <div class="col-md text-center mt-3">
                                {{-- part --}}
                                @if($headerCheck != $joinedData[$j]['title_name'])
                                  <span class="display-3">{{$joinedData[$j]['title_name']}}</span><br><br>
                                @endif
                              </div> {{-- PART --}}
                                {{-- end check exist --}}
                                <div class="container text-center pt-3" id="{{$joinedData[$j]['asmt2_id']}}">
                                  {{-- header --}}
                                  <span class="h3 mt-1 header">{{$joinedData[$j]['asmt2l_desc']}}</span><br> {{--header--}}
                                </div>
                                <div class="col text-center pb-2">
                                  {{-- assessment --}}
                                  <span class="lead">
                                    <br>{{$joinedData[$j]['asmt2_desc']}}<br> {{-- assessment --}}
                                    {!!(!empty($joinedData[$j]['asmt2l_sdesc'] && $joinedData[$j]['asmt2l_sdesc'] != 'null')? '<span class="h5 pt-1">'.$joinedData[$j]['asmt2l_sdesc'].'</span><br>':"")!!} 
                                    {{-- subdesc --}}
                                  </span>
                                </div>
                                <div class="row">
                                  <div class="col-8 border">
                                    <div class="container mt-3">
                                      <strong class="text-center">
                                      {{($joinedData[$j]['asmt2sd_desc'] !== null ? 'MUST BE/HAVE' : 'AREA')}}
                                      </strong>
                                    </div>
                                    <span>
                                      {!!($joinedData[$j]['asmt2sd_desc'] !== null ? $joinedData[$j]['asmt2sd_desc'] : '<div class="container pt-2 pr-5">'.$joinedData[$j]['asmt2l_desc'].'</div>' )!!}<br><br>
                                    </span>
                                  </div>
                                  <div class="col-4 border operations">
                                    <div class="col text-center mt-3">
                                      <span class="display-4">Complied?</span>
                                    </div>
                                    @foreach($actions as $action)
                                      @switch($joinedData[$action."Type"])
                                      {{-- boolean type --}}
                                        @case('Boolean')
                                          @php
                                            $rowSize = 8;
                                            $remarksHead = 'Remarks';
                                          @endphp
                                          <div class="col">
                                            {{(!empty($joinedData[$action."Desc"])?($joinedData[$action."Desc"] != 'Complied'?$joinedData[$action."Desc"].":":""):"")}}
                                          </div>
                                          <div class="d-flex justify-content-center" id="{{$joinedData[$j]['asmt2_id'].$joinedData[$j]['hospitalType'].$action.$joinedData[$j]['asmt2_desc']}}">
                                            <div class="row booleans">
                                               @php $countForSort++; @endphp
                                              <div class="col-6">
                                                <div class="control-group">
                                                  <label class="control control--radio">Yes
                                                    <input value="true" type="radio" name="seq{{$joinedData[$j]['srvasmt_seq']}}!/*{{'comp'.$joinedData[$j]['asmt2_id'].'!/*count'.$countForSort.'!/*part'.$joinedData[$j]['facid'].'!/*headCode'.$joinedData[$j]['headCode'].'!/*assessment'.$joinedData[$j]['hospitalType'].$action.$joinedData[$j]['asmt2_desc'].'!/*isArea'.(isset($joinedData[$j]['asmt2sd_desc']) ? 'false' : 'true').'!/*desc'.$joinedData[$j]['asmt2sd_desc'].'!/*header'.$joinedData[$j]['asmt2l_desc'].'!/*'}}" checked="" />
                                                    <div class="control__indicator"></div>
                                                  </label>
                                                </div> 
                                              </div>
                                              <div class="col-6">
                                                <div class="control-group">
                                                  <label class="control control--radio">No
                                                    <input value="false" type="radio" name="seq{{$joinedData[$j]['srvasmt_seq']}}!/*{{'comp'.$joinedData[$j]['asmt2_id'].'!/*count'.$countForSort.'!/*part'.$joinedData[$j]['facid'].'!/*headCode'.$joinedData[$j]['headCode'].'!/*assessment'.$joinedData[$j]['hospitalType'].$action.$joinedData[$j]['asmt2_desc'].'!/*isArea'.(isset($joinedData[$j]['asmt2sd_desc']) ? 'false' : 'true').'!/*desc'.$joinedData[$j]['asmt2sd_desc'].'!/*header'.$joinedData[$j]['asmt2l_desc'].'!/*'}}"/>
                                                    <div class="control__indicator"></div>
                                                  </label>
                                                </div> 
                                              </div>
                                            </div>
                                          </div>
                                        @break
                                        {{-- end of boolean --}}

                                        {{-- textarea --}}
                                        @case('Text')
                                          @php
                                            $remarksHead = $joinedData[$j]['asmt2_desc'];
                                            $rowSize = 20;
                                          @endphp
                                        @break
                                        {{-- end of textarea --}}
                                      @endswitch
                                    @endforeach
                                    @if($joinedData[$j]['hasRemarks'] == 1 || $rowSize === 20)
                                      <div class="form-group shadow-textarea" id="remarksDiv{{$joinedData[$j]['srvasmt_seq'].$joinedData[$j]['asmt2_id']}}">
                                        <label for="comp{{$joinedData[$j]['srvasmt_seq'].$joinedData[$j]['asmt2_id'].$joinedData[$j]['hospitalType'].$joinedData[$j]['asmt2_desc'].'!/*isArea'.(isset($joinedData[$j]['asmt2sd_desc']) ? 'false' : 'true').'!/*desc'.$joinedData[$j]['asmt2sd_desc'].'!/*-remarks'}}">{{$remarksHead}}</label>
                                        @php $countForSort++; @endphp
                                        <textarea class="form-control z-depth-1" name="seq{{$joinedData[$j]['srvasmt_seq']}}!/*{{'remarks'.$joinedData[$j]['asmt2_id'].'!/*count'.$countForSort.'!/*part'.$joinedData[$j]['facid'].'!/*headCode'.$joinedData[$j]['headCode'].'!/*'.$joinedData[$j]['hospitalType'].$joinedData[$j]['asmt2_desc'].'!/*isArea'.(isset($joinedData[$j]['asmt2sd_desc']) ? 'false' : 'true').'!/*desc'.$joinedData[$j]['asmt2sd_desc'].'!/*-remarks'}}" id="comp{{$joinedData[$j]['srvasmt_seq'].$joinedData[$j]['asmt2_id'].$joinedData[$j]['hospitalType'].$joinedData[$j]['asmt2_desc'].'!/*isArea'.(isset($joinedData[$j]['asmt2sd_desc']) ? 'false' : 'true').'!/*desc'.$joinedData[$j]['asmt2sd_desc'].'!/*-remarks'}}" rows="{{$rowSize}}" placeholder="{{$remarksHead}}"></textarea>
                                      </div> 
                                    @endif
                                  </div>
                                </div>
                                {{-- end empty  hospitaltype --}}
                            {{-- @endif   --}}
                            {{-- end empty if appid --}}
                          @endif
                          {{-- end array exist if --}}
                           @php
                              $headerCheck = $joinedData[$j]['facname']; 
                              $header2Check =  $joinedData[$j]['asmt2l_desc'];
                          @endphp
                       @endif
                       {{-- end array exist --}}
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
            @if(!empty($joinedData))
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
      </div>
  </div>
  <script type="text/javascript">
    let errorField, messageToUser;
    $(document).ready(function(){
      $(".divs .divContent").each(function(e) {
        if (e != 0)
          $(this).hide();
      });
      $(document).on('click','#next',function(){
          let accept = true;
          let errorElement = [];
          let compiledError = [];
          let remarksText = null;
          $('.operations', $('.divs .divContent:visible')).each(function () {
            remarksText = $(this).find('textarea');
            let errorCurrent = $(this).parent().prev().prev().attr('id');
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

              } else if(remarksText.length > 0 && $.trim(remarksText.val()) != ""){
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

    function gotoElement(id){
      $('html,body').animate({
        scrollTop: $(id).offset().top
      },'slow');
    }

    function checkButtons(){
    }
    var CheckedOrNot = [], Remarks = [], GetAsMentId=[], SelectedId = [];
        var numOfAssMents = @isset($numOfAssMents) {{$numOfAssMents}} @else 0 @endisset, test =0, hasNotApproved = 0;
        $(document).ready(function(){
            for (var i = 0; i < numOfAssMents; i++) {
            CheckedOrNot[i] = null;
            Remarks[i] = "";
            GetAsMentId[i] = $('#app_'+i+'_div').attr('selectedId');
          }
        });
      function btnClicked(YesNo, AssMentID){
        if(YesNo == 1){
          var name1 = '#app_'+AssMentID+'_yes';
          var name2 = '#app_'+AssMentID+'_no';
          var name3 = '#app_'+AssMentID+'_rmk';
          $(name3).removeAttr('required');
          $(name3).removeAttr('data-parsley-required-message');
        } else {
          var name1 = '#app_'+AssMentID+'_no';
          var name2 = '#app_'+AssMentID+'_yes';
          var name3 = '#app_'+AssMentID+'_rmk';
          $(name3).removeAttr('required');
          $(name3).attr('required', '');
          $(name3).removeAttr('data-parsley-required-message');
          $(name3).attr('data-parsley-required-message', "<strong>Remark</strong> required");
        }
        CheckedOrNot[AssMentID] = YesNo;
        $(name1).addClass('active')
        $(name2).removeClass('active');
      }
      function SubmitNow(){
        var indicatorLenght = $(".indicator").length;
        var stackedItems = Array();
      }
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
