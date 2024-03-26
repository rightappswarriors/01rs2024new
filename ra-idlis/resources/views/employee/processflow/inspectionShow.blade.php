@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'Inspection Schedule')
  <style>
    .weekend, .drp-calendar thead tr:nth-child(2) th:nth-child(1), th:nth-child(6),  th:nth-child(7){
      display:none
    }
  </style>
  @section('content')
  <input type="text" id="CurrentPage" hidden="" value="PF011">
		<div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">
          Inspection Schedule <button class="btn btn-primary" onclick="window.history.back();">Back</button>
        </div>
        <div class="card-body">
        @if(isset($appdata))


        	<div class="col-sm-12">
            	<h2>@isset($appdata) {{$appdata->facilityname}} @endisset</h2>
            	<!-- <h5>@isset($appdata) {{strtoupper($appdata->streetname)}}, {{strtoupper($appdata->brgyname)}}, {{$appdata->cmname}}, {{$appdata->provname}} @endisset</h5> -->
            	<h5>@isset($appdata) 
              {{
                    $appdata->street_number?  strtoupper($appdata->street_number).',' : ' '
                  }}
                  {{
                    $appdata->streetname?  strtoupper($appdata->streetname).',': ' '
                  }}
                     {{strtoupper($appdata->brgyname)}}, 
                     {{$appdata->cmname}}, {{$appdata->provname}} 
                
              @endisset</h5>
            	<h5>Code: <span class="font-weight-bold">{{$appdata->hfser_id.'R'.$appdata->rgnid.'-'.$appdata->appid}}</span></h5>
                <h6>Institutional Character: 
                  @if(isset($appdata) && isset($appdata->facmdesc))<strong>{{$appdata->facmdesc}}</strong>@else<span style="color:red">Not Available</span>@endif &nbsp;
                <h6>@isset($appdata) Status: @if ($appdata->isrecommended === null) <span style="color:blue">For Evaluation</span> @elseif($appdata->isrecommended == 1)  <span style="color:green">Accepted Evaluation</span> @elseif($appdata->isrecommended === 0) <span style="color:red">Disapprove Evaluation</span> @else <span style="color:orange">Evaluated, for Revision</span> @endif @endisset</h6>
              </h6>
            </div>

            <div class="container">
              @if(!isset($appdata->proposedWeek))
                <form method="POST">
                  {{csrf_field()}}
                  {{-- <input type="hidden" name="time"> --}}
                  <input type="hidden" name="date">
                  <div class="row mt-5">
                    <div class="col-md">
                      <a style="font-size: 30px;">Please choose date</a><br>
                      <small class="text-danger">*Note: By selecting date, whole week (exempting weekends) will be selected*</small>
                    </div>
                    <div class="col-md mt-3">
                      <input required type="text" id="datepicker" class="form-control" placeholder="Click Me" readonly="">
                      {{-- <input required type="time" class="form-control" onchange="tConv24(this.value)"> --}}
                    </div>
                  </div>
                  <div class="col-md mt-5 text-center" style="border:1px solid black;">
                    <div class="row">
                      <div class="col-md">
                        <p class="lead">Dates Selected: </p>
                        <p id="dates" style="font-size: 25px;">Will Display Dates here</p>
                      </div>
                      {{-- <div class="col-md">
                        <p class="lead">Time Selected: </p>
                        <p id="time" style="font-size: 25px;">Will Display Time here</p>
                      </div> --}}
                    </div>
                  </div>
                        
                 
                  <div class="d-flex justify-content-center mt-5 {{$appdata->noofmain}}">
                    <button type="submit" class="btn btn-primary p-3">Submit</button>
                  </div>
                 

                </form>
        
              @else
              <div class="row mt-5">
                <div class="col-md text-center">
                  <p style="font-size: 30px;">Inspection will be on this following dates:</p>
                  {{-- {{dd(json_decode($appdata->proposedWeek,true))}} --}}
                  <span style="font-size: 20px;">{!!str_replace('<br>,', '<br>', json_decode($appdata->proposedWeek))!!}</span><br>
                </div>
              </div>
                @if(count($teams) > 0)
                <div class="col-md text-center" style="font-size: 30px;">With Inspectors:</div>
                <div class="row mt-3 text-center" style="border: 1px solid black">
                  @foreach($teams as $ins)
                  <div class="col-md-4 mt-4 mb-3" style="font-size: 20px;">{{$ins->wholename}}</div>
                  @endforeach
                </div>
                @endif
              @endif
            </div> 
            @else

            {{dd('Forbidden')}}
            @endif
          </div>
        </div>
      </div>
	  
	  {{-- <script type="text/javascript">
      function tConv24(time24) {
        var ts = time24;
        var H = +ts.substr(0, 2);
        var h = (H % 12) || 12;
        h = (h < 10)?("0"+h):h;
        var ampm = H < 12 ? " AM" : " PM";
        ts = h + ts.substr(2, 3) + ampm;
        $("#time").empty().append(ts);
        $("input[name=time]").empty().val(ts);
      };
      
      var weekday = new Array(7);
      var dated;
      weekday[0] =  "Sun";
      weekday[1] = "Mon";
      weekday[2] = "Tue";
      weekday[3] = "Wed";
      weekday[4] = "Thu";
      weekday[5] = "Fri";
      weekday[6] = "Sat";
      var weekEnd = Array(weekday[6],weekday[7]);
	  	$(document).ready(function(){
	  		$('#example').DataTable();
        $("#datepicker").datepicker();
        $("#datepicker").on('change',function(){
          var allowed = Array();
          var nowDate = new Date($(this).val());
          var newdate = new Date(nowDate);
          for (var i = 0; i < 7; i++) {
            if($.inArray(weekday[(newdate.getDay() + i) > 7 ? (newdate.getDay() + i) - 7 : newdate.getDay() + i], weekEnd) == -1){
              allowed.push(months[newdate.getMonth()] +' '+ (newdate.getDate() + i) + ', '+newdate.getFullYear() + '<br>');
            }
          }
          $(dates).empty().append(allowed);
          $("input[name=date]").empty().val(allowed);
        })
	  	});
	</script> --}}

    <script>
      var months = ["January","February","March","April","May","June","July","August","September","October","November","December"];
      var excludedDay = [0, 6];
      $("#datepicker").daterangepicker({
        "showDropdowns": true,
        beforeShowDay: $.datepicker.noWeekends,
        dateLimit: { days: 6 },
        format:'YYYY-MM-DD',
        locale:  moment.locale('en', {
            week: { dow: 1 }
        }),
      });
      $("#datepicker").change(function(event) {
        var allowed = Array();
        for (var day = $("#datepicker").data('daterangepicker').startDate._d; day <= $("#datepicker").data('daterangepicker').endDate._d; day.setDate(day.getDate() + 1)) {
          console.log(day.getDay());
          if($.inArray(day.getDay(), excludedDay) < 0){
            console.log(day.getDay(),'included');

            allowed.push(months[new Date(day).getMonth()] +' '+ (new Date(day).getDate()) + ', '+new Date(day).getFullYear() + '<br>');
          } else {
            console.log(day.getDay(),'excluded');
          }

        }
        $('#dates').empty().append(allowed);
        $("input[name=date]").empty().val(allowed);
      });


    </script>
  @endsection
@else
  <script type="text/javascript">window.location.href = "{{ asset('employee') }}";</script>
@endif
