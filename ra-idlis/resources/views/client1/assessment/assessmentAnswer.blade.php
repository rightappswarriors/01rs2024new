@if (session()->exists('uData'))  
  @extends('main')
  @section('content')
  @include('client1.cmp.__apply')
  <body>
  @include('client1.cmp.nav')
  @include('client1.cmp.breadcrumb')
  @include('client1.cmp.msg')
  @include('client1.cmp.__wizard')

  <style type="text/css">
     #return-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: rgb(0, 0, 0);
        background: rgba(0, 0, 0, 0.7);
        width: 50px;
        height: 50px;
        display: block;
        text-decoration: none;
        -webkit-border-radius: 35px;
        -moz-border-radius: 35px;
        border-radius: 35px;
        display: none;
        -webkit-transition: all 0.3s linear;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    #return-to-top i {
        color: #fff;
        margin: 0;
        position: relative;
        left: 16px;
        top: 13px;
        font-size: 19px;
        -webkit-transition: all 0.3s ease;
        -moz-transition: all 0.3s ease;
        -ms-transition: all 0.3s ease;
        -o-transition: all 0.3s ease;
        transition: all 0.3s ease;
    }
    #return-to-top:hover {
        background: rgba(0, 0, 0, 0.9);
    }
    #return-to-top:hover i {
        color: #fff;
        top: 5px;
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
      /*position: relative;*/
      padding-left: 20px;
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
      <div class="card">
        <div class="card-header bg-white font-weight-bold">
                Assessment 
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
                    {!! ($key == 0 ? '' : ' / ').'<a href="'.(($bread['beforeAddress'] == 'MAIN') ? url('client1/apply/assessmentReady/'.$data->appid)  : url('client1/apply/'.$bread['beforeAddress'].'/'.$data->appid.'/'.$bread['id'].'/'.$isMon)).'">'.$bread['desc'].'</a>' !!}
                  @endforeach
                @endisset
              </div>
              <div class="container">
                <form action="{{url('client1/apply/SaveAssessments')}}" method="POST">
                  {{csrf_field()}}
                 
                  <input type="hidden" name="appid" value="{{$data->appid}}">
                  <input type="hidden" name="part" value="{{$part}}">
                  <input type="hidden" name="hid" value="{{ app('request')->input('hid') }}">
                  <input type="hidden" name="xid" value=" {{ app('request')->input('xid') }}">
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
                                                                  <input value="true" type="radio" name="{{$head[$j]->id}}[comp]"  />
                                                                  <div class="control__indicator"></div>
                                                              </label>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="control-group">
                                      <label class="control control--radio">
                                        <i class="fa fa-times text-danger"></i>
                                                                  <input value="false" type="radio" name="{{$head[$j]->id}}[comp]" />
                                                                  <div class="control__indicator"></div>
                                                              </label>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="control-group">
                                      <label class="control control--radio">
                                        <span class="text-danger">N/A</span>
                                                                  <input value="NA" type="radio" name="{{$head[$j]->id}}[comp]" checked=""/>
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
                                          <button type="button" onclick="toggleRemarks(this)" class=" btn btn-primary">Add Remarks</button>
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
      <a href="javascript:" id="return-to-top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
    <script>
      var ___div = document.getElementById('__applyBread'), ___wizardcount = document.getElementsByClassName('wizardcount');
      if(___wizardcount != null || ___wizardcount != undefined) {
        for(let i = 0; i < ___wizardcount.length; i++) {
          if(i < 1) {
            ___wizardcount[i].parentNode.classList.add('past');
          }
          if(i == 1) {
            ___wizardcount[i].parentNode.classList.add('active');
          }
        }
      }
      if(___div != null || ___div != undefined) {
        ___div.classList.remove('active');  ___div.classList.add('text-primary');
      }
    </script>
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
                  //  accept = true;
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
            scrollTop: $("#"+id).offset().top
          },'slow');
        }

      $(window).scroll(function() {
          if ($(this).scrollTop() >= 50) {        // If page is scrolled more than 50px
              $('#return-to-top').fadeIn(200);    // Fade in the arrow
          } else {
              $('#return-to-top').fadeOut(200);   // Else fade out the arrow
          }
      });
       function toggleRemarks(element){
        if($(element).length > 0 && $(element).parent().next().next().length > 0){
          let currentRemark = $(element).parent().next().next();
          currentRemark.toggle();
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
      $('#return-to-top').click(function() {      // When arrow is clicked
          $('body,html').animate({
              scrollTop : 0                       // Scroll to top of body
          }, 500);
      });
    </script>
    @include('client1.cmp.footer')
  </body>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif
