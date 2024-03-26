@if (session()->exists('employee_login'))  
  @extends('mainEmployee')
  @section('title', 'System Settings Master File')
  @section('content')
  <div class="content p-4">
  	<datalist id="rgn_list">
        @if (isset($hfstypes))
          @foreach ($hfstypes as $hfstype)
            <option value="{{$hfstype->hfser_id}}">{{$hfstype->hfser_desc}}</option>
          @endforeach
        @endif
      </datalist>
      <div class="card">
      	<div class="card-header bg-white font-weight-bold">
      		<div class="card-header bg-white font-weight-bold">Settings&nbsp;&nbsp;        
            <button type="button" onclick="$('.editMode').toggle();$('.form-control').attr('disabled', false);" class="btn editMode btn-warning"><i class="fa fa-fw fa-edit"></i>&nbsp;Edit</button>&nbsp;
            <button type="button" onclick="$('.editMode').toggle();$('.form-control').attr('disabled', true);" class="btn editMode btn-danger" style="display: none"><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Cancel</button>&nbsp;   
            <button type="button" onclick="$('#SaveForm').submit()" class="btn editMode btn-success" style="display: none"><i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save</button>
                 
          </div>   
          <br>  
          <form id="SaveForm" data-parsley-validate>
          <h4>System</h4>
      		<div class="card">
            <div class="card-body">
              <div class="row" style="margin:0 0 .8em 0;">
                <div class="col-sm-6" style="font-weight: bolder">Secretary of Health</div>
                <div class="col-sm-6" style="margin:0 0 .8em 0;">
                  <input type="text" id="sec_name" class="form-control" value="@isset($BigData->sec_name) {{$BigData->sec_name}} @endisset" disabled="">
                </div>
              </div>
              <div class="row" style="margin:0 0 .8em 0;">
                  <div class="col-sm-6">
                    <strong>Start of Validity</strong> :</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  </div>
                  <div class="col-sm-6" style="margin:0 0 .8em 0;">
                    <select class="form-control" id="mtny" disabled="">
                        <option value="">Select Month..</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                  </div>
                  @isset($BigData->mtny)
                      <script type="text/javascript">$('#mtny option[value="{{$BigData->mtny}}"]').prop('selected', 'selected').change();</script>
                  @endisset
              </div>
              <div class="row" style="margin:0 0 .8em 0;">
                    <div class="col-sm-6">License Expiration:</div>
                    <div class="col-sm-6">
                      <div class="row form-inline">
                        <div class="col-sm-6">
                          Month :&nbsp;
                          <select class="form-control" id="app_exp_mn" disabled="">
                            <option value="">Select Month..</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                          </select>
                        </div>
                        <div class="col-sm-6">
                          Day :&nbsp;
                          <select class="form-control" id="app_exp_dy" disabled="">
                            <option value="">Select Day..</option>
                            @for($i = 0, $x = 1 ; $i < 31; $i++)
                              <option value="{{$x}}">{{$x}}</option>
                              @php $x++ @endphp
                            @endfor
                          </select>
                          @isset($BigData->app_exp)
                            @php
                              $test3 = explode('-', $BigData->app_exp);
                            @endphp
                            <script type="text/javascript">
                              $('#app_exp_mn option[value="{{$test3[0]}}"]').prop('selected', 'selected').change();
                              $('#app_exp_dy option[value="{{$test3[1]}}"]').prop('selected', 'selected').change();
                            </script>
                          @endisset
                        </div>
                      </div>
                    </div>
              </div>
            </div>
          </div>
          <br>
          <h4>Licensing Process</h4>
          <div class="card">
            <div class="card-body">
              <h5>Evaluation</h5>
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin:0 0 .8em 0;">
                    <div class="col-sm-6">Number of tries:</div>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="no_tries" data-parsley-required-message="Should be a valid number." required="" min="0" value="{{$BigData->no_tries}}" disabled="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <h4>Deadlines</h4>
          <div class="card">
            <div class="card-body">
              <div class="card">
                <div class="card-body">
                  <div class="row" style="margin:0 0 .8em 0;">
                    <div class="col-sm-6">Application Deadlines (Per Day):</div>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" id="appDead" data-parsley-required-message="Should be a valid number." required="" min="1" value="{{$BigData->appdeadline}}" disabled="">
                    </div>
                  </div>
                  <div class="row" style="margin:0 0 .8em 0;">
                    <div class="col-sm-6">Near Deadline (Per Day):</div>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" id="nearDead" data-parsley-required-message="Should be a valid number." required="" min="1" value="{{$BigData->neardeadline}}" disabled="">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <h4>Users</h4>
          <div class="card">
            <div class="card-body">
              <h5>General</h5>
              <div class="card GENERAL" > 
                <div class="card-body">
                  <div class="row" style="margin:0 0 .8em 0;">
                    <div class="col-sm-6">Account Expiration:</div>
                    <div class="col-sm-6">
                      <div class="row form-inline">
                        <div class="col-sm-4">
                          @php 
                            if (isset($BigData->acc_exp)) {
                                $test = explode('-', $BigData->acc_exp);
                                $yr = $test[0]; $month = $test[1]; $dy = $test[2];
                            } 
                          @endphp
                          Years : 
                          <input class="form-control" type="number" data-parsley-required-message="Should be a valid number." name="" id="yr" required="" value="@isset($yr){{$yr}}@else{{0}}@endisset" min="0" placeholder="Number of Years" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" disabled="">
                        </div>
                        <div class="col-sm-4">
                          Months : 
                          <input class="form-control" type="number" data-parsley-required-message="Should be a valid number." name="" id="mn" required="" value="@isset($month){{$month}}@else{{0}}@endisset" min="0" placeholder="Number of Months" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" disabled="">
                        </div>
                        <div class="col-sm-4">
                          Days : 
                          <input class="form-control" type="number" data-parsley-required-message="Should be a valid number." name="" id="dy" required="" value="@isset($dy){{$dy}}@else{{0}}@endisset" min="0" placeholder="Number of Days" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" disabled="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div> 
              <br>
              <h5>Password</h5>
              <div class="card PASSWORD">
                <div class="card-body">
                  <div class="row" style="margin:0 0 .8em 0;">
                    <div class="col-sm-6">Maximum number tries for failed login: </div>
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-6">
                          Temporary Ban:&nbsp;  <input class="form-control" name="" data-parsley-type="number" id="tb" type="number" placeholder="Number of tries" value="@isset($BigData->sec_name){{$BigData->pass_temp}}@else{{0}}@endisset" required="" data-parsley-required-message="Should be a valid number." min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" disabled="">
                          Number of Minutes: (Temporary ban)&nbsp;  <input class="form-control" data-parsley-type="number" name="" id="nm" type="number" placeholder="Number of minutes" value="@isset($BigData->sec_name){{$BigData->pass_min}}@else{{0}}@endisset" required="" data-parsley-required-message="Should be a valid number." min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" disabled="">
                        </div>
                        <div class="col-sm-6">
                          Permanent Ban:&nbsp;  <input class="form-control" name="" data-parsley-type="number" id="pb" type="number" placeholder="Number of tries" value="@isset($BigData->sec_name){{$BigData->pass_ban}}@else{{0}}@endisset" required="" data-parsley-required-message="Should be a valid number." min="0" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" disabled="">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row" style="margin:0 0 .8em 0;">
                    <div class="col-sm-6">Password Expiration:</div>
                    <div class="col-sm-6">
                      <div class="row form-inline">
                        <div class="col-sm-4">
                          @php 
                            if (isset($BigData->pass_exp)) {
                                $test = explode('-', $BigData->pass_exp);
                                $yr2 = $test[0]; $month2 = $test[1]; $dy2 = $test[2];
                            } 
                          @endphp
                          Years : 
                          <input class="form-control" type="number" data-parsley-required-message="Should be a valid number." name="" id="yr2" required="" value="@isset($yr2){{$yr2}}@else{{0}}@endisset" min="0" placeholder="Number of Years" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" disabled="">
                        </div>
                        <div class="col-sm-4">
                          Months : 
                          <input class="form-control" type="number" data-parsley-required-message="Should be a valid number." name="" id="mn2" required="" value="@isset($month2){{$month2}}@else{{0}}@endisset" min="0" placeholder="Number of Months" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" disabled="">
                        </div>
                        <div class="col-sm-4">
                          Days : 
                          <input class="form-control" type="number" data-parsley-required-message="Should be a valid number." name="" id="dy2" required="" value="@isset($dy2){{$dy2}}@else{{0}}@endisset" min="0" placeholder="Number of Days" onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" disabled="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <h5>Misc</h5>
          <div class="card MISC">
              <div class="card-body">
                <div class="row" style="margin:0 0 .8em 0;">
                  <div class="col-sm-6">DOH ISO Certification: </div>
                  <div class="col-sm-6">
                    <input type="text" id="iso" class="form-control" value="@isset($BigData->dohiso) {{$BigData->dohiso}} @endisset" disabled="">
                  </div>
                </div>
              </div>
          </div>
        </form>
      	</div>
      </div>
  </div>
  <script type="text/javascript">
  	$('#SaveForm').on('submit',function(event){
          event.preventDefault();
          var form = $(this);
          form.parsley().validate();
          if (form.parsley().isValid()) {
            var yr = $('#yr').val(), mn = $('#mn').val(), dy = $('#dy').val();
            var yr2 = $('#yr2').val(), mn2 = $('#mn2').val(), dy2 = $('#dy2').val();
            var test = yr + '-' + mn + '-' + dy;
            var test2 = yr2 + '-' + mn2 + '-' + dy2;
            var test3 = $('#app_exp_mn').val() + '-' + $('#app_exp_dy').val();
            $.ajax({
                method : 'post',
                data : {
                      _token : $('#token').val(),
                      sec_name : $('#sec_name').val(),
                      mtny : $('#mtny').val(),
                      app_exp : test3,
                      acc_exp : test,
                      pass_exp : test2,
                      pass_temp : $('#tb').val(),
                      pass_min : $('#nm').val(),
                      pass_ban : $('#pb').val(),
                      no_tries : $('#no_tries').val(),
                      isoCert  : $('#iso').val(),
                      appDead  : $('#appDead').val(),
                      nearDead  : $('#nearDead').val()
                    },
                success : function (data){
                    if (data == 'DONE') {
                      alert('Successfully saved system settings');
                      location.reload();
                    } else if (data == 'ERROR'){
                        $('#ERROR_MSG2').show(100);
                    }
                },
                error : function(a,b,c){
                  console.log(c);
                  $('#ERROR_MSG2').show(100);
                }
            });
          }
        });
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif