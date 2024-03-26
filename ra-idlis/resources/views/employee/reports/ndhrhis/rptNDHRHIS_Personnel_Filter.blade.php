@php
    $fo_surname = NULL;
    $fo_firstname = NULL;
    $fo_middlename = NULL;

    $fo_prcno = NULL;
    $fo_pos = NULL;
    $fo_prof = NULL;
    $fo_employement = NULL;
    $fo_status = NULL;  

    $fo_rows = NULL;  
    $fo_pgno = NULL;  
    $fo_submit = NULL;  
    $fo_rowscnt = NULL;
    $fo_session_grpid = NULL;
@endphp

@if (isset($arr_fo) && !empty($arr_fo))
   @foreach ($arr_fo as $fo => $foval)
    @php
      if($fo == 'surname') { $fo_surname =  $foval; }

      if($fo == 'firstname') { $fo_firstname =  $foval; }
      if($fo == 'middlename') { $fo_middlename =  $foval; }
      if($fo == 'prcno') { $fo_prcno =  $foval; }
      if($fo == 'pos') { $fo_pos  =  $foval; }
      if($fo == 'prof') { $fo_prof =  $foval; }
      if($fo == 'employement') { $fo_employement =  $foval; }
      if($fo == 'status') { $fo_status =  $foval; }

      if($fo == 'fo_rows') { $fo_rows =  $foval; }
      if($fo == 'fo_pgno') { $fo_pgno =  $foval; }
      if($fo == 'fo_submit') { $fo_submit =  $foval; }

      if($fo == 'fo_rowscnt') { $fo_rowscnt =  $foval; }
      if($fo == 'fo_session_grpid') { $fo_session_grpid =  $foval; }
    @endphp
    @endforeach
@endif
<form method="POST" action="{{asset($fo_action)}}" data-parsley-validate>
  
{{@csrf_field()}}
<div id="getData1" class="getDataClass">
  <div class="box box-solid">
    <div class="box-header">
      <i class="fa fa-th"></i>

      <span> Report Filter Options</span>
      
      <div class="box-tools pull-right">
        <button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <!-- button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
        </button -->
        
      </div>
    </div>
    <div class="box-body border-radius-none">

      <div class="row">

        <div class="col-md-3">
          <div class="form-group">

            <label class="control-label">Surname</label>
            <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_surname" id="fo_surname" value="@if(isset($fo_surname)){{$fo_surname}}@endif">
          
          </div>
        </div>
        
        
        <div class="col-md-3">
          <div class="form-group">
              <label>First Name</label>
              <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_firstname" id="fo_firstname" value="@if(isset($fo_firstname)){{$fo_firstname}}@endif">          
          </div>
        </div> 

        <div class="col-md-3">
          <div class="form-group">
              <label>Middle Name</label>
              <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_middlename" id="fo_middlename" value="@if(isset($fo_middlename)){{$fo_middlename}}@endif">          
          </div>
        </div> 

        <div class="col-md-3">
          <div class="form-group">
              <label>PRC No.</label>
              <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_prcno" id="fo_prcno" value="@if(isset($fo_prcno)){{$fo_prcno}}@endif">          
          </div>
        </div> 
        
        

      </div>
    

      <div class="row">
                
        <div class="col-md-3">

          <div class="form-group">
            <label>Position</label>
            <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_pos" id="fo_pos" value="@if(isset($fo_pos)){{$fo_pos}}@endif">          
          </div>          
          
        </div>

        <div class="col-md-3 ">       
          <div class="form-group">
            <label>Profession</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_prof" id="fo_prof">
              <option value="" @if (!isset($fo_prof))  selected @endif  >All</option>
              <option value="1"  @if (isset($fo_prof)) @if ($fo_prof ==  '1' )  selected @endif @endif >Chief X-Ray Technologist</option>
              <option value="2"  @if (isset($fo_prof)) @if ($fo_prof ==  '2' )  selected @endif @endif >Radiation Protection Officer</option>
              <option value="3"  @if (isset($fo_prof)) @if ($fo_prof ==  '3' )  selected @endif @endif >Radiation Protection Officer</option>
              <option value="4"  @if (isset($fo_prof)) @if ($fo_prof ==  '4' )  selected @endif @endif >CMP-ROMP</option>
              <option value="5"  @if (isset($fo_prof)) @if ($fo_prof ==  '5' )  selected @endif @endif >ROMP</option>
              <option value="6"  @if (isset($fo_prof)) @if ($fo_prof ==  '6' )  selected @endif @endif >Chief Dentist</option>
              <option value="7"  @if (isset($fo_prof)) @if ($fo_prof ==  '7' )  selected @endif @endif >Chief Radiation Oncologist</option>
              <option value="8"  @if (isset($fo_prof)) @if ($fo_prof ==  '8' )  selected @endif @endif >Head of Radiology</option>
              <option value="9"  @if (isset($fo_prof)) @if ($fo_prof ==  '9' )  selected @endif @endif >Assistant Radiation Officer</option>
              <option value="10" @if (isset($fo_prof)) @if ($fo_prof ==  '10' )  selected @endif @endif >Certified Medical Physicist/Oncological Medical Hhysicist</option>
              <option value="11" @if (isset($fo_prof)) @if ($fo_prof ==  '11' )  selected @endif @endif >Radiotherapy Technologist</option>
              <option value="12" @if (isset($fo_prof)) @if ($fo_prof ==  '12' )  selected @endif @endif >Chief Radiotherapy Technologist</option>
              <option value="13" @if (isset($fo_prof)) @if ($fo_prof ==  '13' )  selected @endif @endif >Radiation Oncology Medical Physicist</option>
              <option value="14" @if (isset($fo_prof)) @if ($fo_prof ==  '14' )  selected @endif @endif >Chief Pharmacist</option>
            </select>
          </div>
        </div>

        
        <div class="col-md-3">

          <div class="form-group">
            <label>Employment Status</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_employement" id="fo_employement" >
              <option value="" @if (!isset($fo_employement))  selected @endif  >All</option>
              <option value="CAS"  @if (isset($fo_employement)) @if ($fo_employement ==  'CAS' )  selected @endif @endif >Casual</option>
              <option value="CON"  @if (isset($fo_employement)) @if ($fo_employement ==  'CON' )  selected @endif @endif >Contractual</option>
              <option value="PER"  @if (isset($fo_employement)) @if ($fo_employement ==  'PER' )  selected @endif @endif >Permanent</option>
              <option value="OTH"  @if (isset($fo_employement)) @if ($fo_employement ==  'OTH' )  selected @endif @endif >Others</option>
            </select>
          </div>          
          
        </div>  

        <div class="col-md-3 ">           
          
          <div class="form-group">
            <label>Status</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_status" id="fo_status">
              <option value="" @if (!isset($fo_status))  selected @endif  >All</option>
              <option value="0"  @if (isset($fo_status)) @if ($fo_status ==  '0' )  selected @endif @endif >Inactive Working</option>
              <option value="1"  @if (isset($fo_status)) @if ($fo_status ==  '1' )  selected @endif @endif >Active Working</option>
            </select>
          </div>
        </div>

      </div>

    </div>

  </div>

  <div class="box-footer col-md-12">
      <div class="row">

        <div class="col-md-6">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <select class="page-link" name="fo_rows" id="fo_rows">
                    <option value="10"   @if (isset($fo_rows)) @if ($fo_rows ==  '10' )  selected @endif @endif >10 Rows</option>
                    <option value="25"   @if (isset($fo_rows)) @if ($fo_rows ==  '25' )  selected @endif @endif >25 Rows</option>
                    <option value="50"   @if (isset($fo_rows)) @if ($fo_rows ==  '50' )  selected @endif @endif >50 Rows</option>
                    <option value="75"   @if (isset($fo_rows)) @if ($fo_rows ==  '75' )  selected @endif @endif >75 Rows</option>
                    <option value="100"  @if (isset($fo_rows)) @if ($fo_rows ==  '100' )  selected @endif @endif >100 Rows</option>
                    <option value="200"  @if (isset($fo_rows)) @if ($fo_rows ==  '200' )  selected @endif @endif >200 Rows</option>
                    <option value="500"  @if (isset($fo_rows)) @if ($fo_rows ==  '500' )  selected @endif @endif >500 Rows</option>
                    <option value="1000"  @if (isset($fo_rows)) @if ($fo_rows ==  '1000' )  selected @endif @endif >1000 Rows</option>
                  </select>
                  <input type="hidden" class="page-link text-center" style="width:50px;" name="fo_pgno"  id="fo_pgno" value="@if (isset($fo_pgno)) {{$fo_pgno}} @else {{'1'}} @endif " ReadOnly="ReadOnly" />
              </li>
              
              <li class="page-item">&nbsp;&nbsp;&nbsp;</li>
              <li class="page-item"><button type="submit" class="page-link" name="fo_submit" id="fo_submit" value="prev">Previous</button></li>
              <li class="page-item"><a class="page-link" href="#">@if (isset($fo_pgno)) {{$fo_pgno}} @else {{'1'}} @endif </a></li>
              <li class="page-item"><button type="submit" class="page-link" name="fo_submit" id="fo_submit" value="next">Next</button></li>
            </ul>
          </nav> 
        </div>

        <div class="col-md-6 row">
          <div class="col-md-4 text-right">
            Total Rows Result: <strong>@if (isset($fo_rowscnt)) {{number_format($fo_rowscnt)}} @else {{'0'}} @endif</strong>
          </div>
          <div class="col-md-4 text-right">
            <div class="form-group">
              <button type="submit" class="btn btn-info" name="fo_submit" id="fo_submit" value="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg> Preview Data
              </button>
            </div>
          </div>
          <div class="col-md-4 text-left" >
            <div class="form-group">
              <button type="submit" class="btn btn-info" name="fo_submit" id="fo_submit" value="csv">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filetype-csv" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2h-1v-1h1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5L14 4.5ZM3.517 14.841a1.13 1.13 0 0 0 .401.823c.13.108.289.192.478.252.19.061.411.091.665.091.338 0 .624-.053.859-.158.236-.105.416-.252.539-.44.125-.189.187-.408.187-.656 0-.224-.045-.41-.134-.56a1.001 1.001 0 0 0-.375-.357 2.027 2.027 0 0 0-.566-.21l-.621-.144a.97.97 0 0 1-.404-.176.37.37 0 0 1-.144-.299c0-.156.062-.284.185-.384.125-.101.296-.152.512-.152.143 0 .266.023.37.068a.624.624 0 0 1 .246.181.56.56 0 0 1 .12.258h.75a1.092 1.092 0 0 0-.2-.566 1.21 1.21 0 0 0-.5-.41 1.813 1.813 0 0 0-.78-.152c-.293 0-.551.05-.776.15-.225.099-.4.24-.527.421-.127.182-.19.395-.19.639 0 .201.04.376.122.524.082.149.2.27.352.367.152.095.332.167.539.213l.618.144c.207.049.361.113.463.193a.387.387 0 0 1 .152.326.505.505 0 0 1-.085.29.559.559 0 0 1-.255.193c-.111.047-.249.07-.413.07-.117 0-.223-.013-.32-.04a.838.838 0 0 1-.248-.115.578.578 0 0 1-.255-.384h-.765ZM.806 13.693c0-.248.034-.46.102-.633a.868.868 0 0 1 .302-.399.814.814 0 0 1 .475-.137c.15 0 .283.032.398.097a.7.7 0 0 1 .272.26.85.85 0 0 1 .12.381h.765v-.072a1.33 1.33 0 0 0-.466-.964 1.441 1.441 0 0 0-.489-.272 1.838 1.838 0 0 0-.606-.097c-.356 0-.66.074-.911.223-.25.148-.44.359-.572.632-.13.274-.196.6-.196.979v.498c0 .379.064.704.193.976.131.271.322.48.572.626.25.145.554.217.914.217.293 0 .554-.055.785-.164.23-.11.414-.26.55-.454a1.27 1.27 0 0 0 .226-.674v-.076h-.764a.799.799 0 0 1-.118.363.7.7 0 0 1-.272.25.874.874 0 0 1-.401.087.845.845 0 0 1-.478-.132.833.833 0 0 1-.299-.392 1.699 1.699 0 0 1-.102-.627v-.495Zm8.239 2.238h-.953l-1.338-3.999h.917l.896 3.138h.038l.888-3.138h.879l-1.327 4Z"/>
</svg> Export CSV Data
              </button>
            </div>
          </div>
          
        </div>

      </div>

    </div>
  
</div>
</form>