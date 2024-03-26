@php
    $fo_aptid = NULL;
    $fo_hfser_id = NULL;
    $fo_ocid = NULL;
    $fo_hgpid = NULL;
    $fo_status = NULL;
    $fo_uid = NULL;
    $fo_rgnid = NULL;
    $fo_assignedRgn = NULL;
    $fo_appid = NULL;
    $fo_facilityname = NULL;  

    $fo_rows = NULL;  
    $fo_pgno = NULL;  
    $fo_submit = NULL;  
    $fo_rowscnt = NULL;
    $fo_session_grpid = NULL;
@endphp

@if (isset($arr_fo) && !empty($arr_fo))
   @foreach ($arr_fo as $fo => $foval)
    @php
      if($fo == 'aptid') { $fo_aptid =  $foval; }
      if($fo == 'hfser_id') { $fo_hfser_id =  $foval; }
      if($fo == 'ocid') { $fo_ocid =  $foval; }
      if($fo == 'hgpid') { $fo_hgpid =  $foval; }
      if($fo == 'status') { $fo_status =  $foval; }
      if($fo == 'uid') { $fo_uid  =  $foval; }
      if($fo == 'rgnid') { $fo_rgnid =  $foval; }
      if($fo == 'assignedRgn') { $fo_assignedRgn =  $foval; }
      if($fo == 'appid') { $fo_appid =  $foval; }
      if($fo == 'facilityname') { $fo_facilityname =  $foval; }

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
  <input type='hidden' name='hfser_id' value="@if (isset($hfser_id)) {{$hfser_id}} @endif">
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

        <div class="col-md-4">
          <div class="form-group">
            <label>Applied Dates Within</label>            
            <div class="row">
              <div class="col-md-6"><input type="date" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_date_1" id="fo_date_1" value="2022-01-01"></div>
              <div class="col-md-6"><input type="date" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_date_2" id="fo_date_2" value="2022-12-31"></div>
            </div>
          </div>         

        </div>
        
        <div class="col-md-4">

          <div class="form-group">
            <label>Facility Type</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_hgpid" id="fo_hgpid"  @if (isset($d_hgpid)) @php $fo_hgpid = $d_hgpid; @endphp  disabled="disabled"   @endif>
              <option value="" @if (!isset($fo_hgpid))  selected @endif  >All</option>
              <option value="1"  @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '1' )  selected @endif @endif >Ambulatory Surgical Clinic</option>
              <option value="2"  @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '2' )  selected @endif @endif >Blood Center</option>
              <option value="4"  @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '4' )  selected @endif @endif >Clinical Laboratory</option>
              <option value="5"  @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '5' )  selected @endif @endif >Hemodialysis Clinic</option>
              <option value="6"  @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '6' )  selected @endif @endif >Hospital</option>
              <option value="7"  @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '7' )  selected @endif @endif >Psychiatric Care Facility</option>
              <option value="8"  @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '8' )  selected @endif @endif >Drug Testing Laboratory</option>
              <option value="9"  @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '9' )  selected @endif @endif >Drug Abuse Treatment & Rehabilitation Center (DATRC)</option>
              <option value="10" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '10' )  selected @endif @endif >Kidney Transplant Facility</option>
              <option value="11" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '11' )  selected @endif @endif >Laboratory for Drinking Water Analysis (LDWA)</option>
              <option value="12" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '12' )  selected @endif @endif >Medical Facility for Overseas Workers and Seafarer (MFOWS)</option>
              <option value="13" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '13' )  selected @endif @endif >Newborn Screening Center (NSC)</option>
              <option value="14" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '14' )  selected @endif @endif >Human Stem Cell and Cell-Based or Cellular Therapy...</option>
              <option value="16" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '16' )  selected @endif @endif >Special Clinical Lab</option>
              <option value="17" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '17' )  selected @endif @endif >Infirmary</option>
              <option value="18" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '18' )  selected @endif @endif >Birthing Home</option>
              <option value="18" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '19' )  selected @endif @endif >Dental Clinic</option>
              <option value="28" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '28' )  selected @endif @endif >Dental Laboratory</option>
              <option value="30" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '30' )  selected @endif @endif >BLood Station</option>
              <option value="32" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '32' )  selected @endif @endif >Blood Collection Unit</option>
              <option value="34" @if (isset($fo_hgpid)) @if ($fo_hgpid ==  '34' )  selected @endif @endif >Ambulance Service Provider</option>
            </select>
          </div>          
          
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label>Process Type</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_aptid" id="fo_aptid">
              <option value="" @if (!isset($fo_aptid))  selected @endif  >All</option>
              <option value="IN" @if (isset($fo_aptid)) @if ($fo_aptid ==  'IN' )  selected @endif @endif >Initial New</option>
              <option value="R" @if (isset($fo_aptid))  @if ($fo_aptid == 'R' )  selected  @endif @endif >Renewal</option>
              <option value="IC" @if (isset($fo_aptid))  @if ($fo_aptid == 'IC' )  selected  @endif @endif >Initial Change</option>
            </select>
          </div>
                    
        </div>         

      </div>
    

      <div class="row">

        <div class="col-md-4 ">
          <div class="form-group ">
          
          </div>
        </div>

        <div class="col-md-4 ">       
          <div class="form-group">
            <label>Facility Region</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_rgnid" id="fo_rgnid">
              <option value="" @if (!isset($fo_rgnid))  selected @endif  >All</option>
              <option value="1"  @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '1' )  selected @endif @endif >REGION I (ILOCOS REGION)</option>
              <option value="2"  @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '2' )  selected @endif @endif >REGION II (CAGAYAN VALLEY)</option>
              <option value="3"  @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '3' )  selected @endif @endif >REGION III (CENTRAL LUZON))</option>
              <option value="4A" @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '4A' )  selected @endif @endif >REGION IV-A (CALABARZON)</option>
              <option value="4B" @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '4B' )  selected @endif @endif >REGION IV-B (MIMAROPA)</option>
              <option value="5"  @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '5' )  selected @endif @endif >REGION V (BICOL REGION)</option>
              <option value="6"  @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '6' )  selected @endif @endif >REGION VI (WESTERN VISAYAS)</option>
              <option value="7"  @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '7' )  selected @endif @endif >REGION VII (CENTRAL VISAYAS)</option>
              <option value="8"  @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '8' )  selected @endif @endif >REGION VIII (EASTERN VISAYAS)</option>
              <option value="9"  @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '9' )  selected @endif @endif >REGION IX (ZAMBOANGA PENINSULA)</option>
              <option value="10" @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '10' )  selected @endif @endif >REGION X (NORTHERN MINDANAO)</option>
              <option value="11" @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '11' )  selected @endif @endif >REGION XI (DAVAO REGION)</option>
              <option value="12" @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '12' )  selected @endif @endif >REGION XII (SOCCSKSARGEN)</option>
              <option value="13" @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '13' )  selected @endif @endif >NATIONAL CAPITAL REGION (NCR)</option>
              <option value="14" @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '14' )  selected @endif @endif >CORDILLERA ADMINISTRATIVE REGION (CAR)</option>
              <option value="15" @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '15' )  selected @endif @endif >BANGSAMORO AUTONOMOUS REGION IN MUSLIM MINDANAO (BARMM)</option>
              <option value="16" @if (isset($fo_rgnid)) @if ($fo_rgnid ==  '16' )  selected @endif @endif >REGION XIII (CARAGA)</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 ">       
          
          
          <div class="form-group">
            <label>Assigned Region</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_assignedRgn" id="fo_assignedRgn" @if (isset($d_assignedRgn))  @if ($d_assignedRgn!='NA')  @php $fo_assignedRgn = $d_assignedRgn; @endphp  disabled="disabled"   @endif  @endif>
              <option value="" @if (!isset($fo_assignedRgn))  selected @endif  >All</option>
              <option value="1"  @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '1' )  selected @endif @endif >REGION I (ILOCOS REGION)</option>
              <option value="2"  @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '2' )  selected @endif @endif >REGION II (CAGAYAN VALLEY)</option>
              <option value="3"  @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '3' )  selected @endif @endif >REGION III (CENTRAL LUZON))</option>
              <option value="4A" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '4A' )  selected @endif @endif >REGION IV-A (CALABARZON)</option>
              <option value="4B" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '4B' )  selected @endif @endif >REGION IV-B (MIMAROPA)</option>
              <option value="5"  @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '5' )  selected @endif @endif >REGION V (BICOL REGION)</option>
              <option value="6"  @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '6' )  selected @endif @endif >REGION VI (WESTERN VISAYAS)</option>
              <option value="7"  @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '7' )  selected @endif @endif >REGION VII (CENTRAL VISAYAS)</option>
              <option value="8"  @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '8' )  selected @endif @endif >REGION VIII (EASTERN VISAYAS)</option>
              <option value="9"  @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '9' )  selected @endif @endif >REGION IX (ZAMBOANGA PENINSULA)</option>
              <option value="10" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '10' )  selected @endif @endif >REGION X (NORTHERN MINDANAO)</option>
              <option value="11" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '11' )  selected @endif @endif >REGION XI (DAVAO REGION)</option>
              <option value="12" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '12' )  selected @endif @endif >REGION XII (SOCCSKSARGEN)</option>
              <option value="13" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '13' )  selected @endif @endif >NATIONAL CAPITAL REGION (NCR)</option>
              <option value="14" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '14' )  selected @endif @endif >CORDILLERA ADMINISTRATIVE REGION (CAR)</option>
              <option value="15" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '15' )  selected @endif @endif >BANGSAMORO AUTONOMOUS REGION IN MUSLIM MINDANAO (BARMM)</option>
              <option value="16" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  '16' )  selected @endif @endif >REGION XIII (CARAGA)</option>
              <option value="FDA" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  'fda' )  selected @endif @endif >FDA CENTRAL OFFICE</option>
              <option value="HFSRB" @if (isset($fo_assignedRgn)) @if ($fo_assignedRgn ==  'hfsrb' )  selected @endif @endif >DOH Central Office</option>
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