@php
    $fo_date_sel = 'APP';
    $fo_date_1 = date('Y').'-01-31';
    $fo_date_2 = date('Y').'-12-31';

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
    $fo_proofpaystatMach = NULL; 
    $fo_proofpaystatPhar = NULL; 

    $fo_rows = NULL;  
    $fo_pgno = NULL;  
    $fo_submit = NULL;  
    $fo_rowscnt = NULL;
@endphp

@if (isset($arr_fo) && !empty($arr_fo))
   @foreach ($arr_fo as $fo => $foval)
    @php
      if($fo == 'fo_date_sel') { $fo_date_sel =  $foval; }
      if($fo == 't_date_1') { $fo_date_1 =  $foval; }
      if($fo == 't_date_2') { $fo_date_2 =  $foval; }
      
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

      
      if($fo == 'proofpaystatMach') { $fo_proofpaystatMach =  $foval; }      
      if($fo == 'proofpaystatPhar') { $fo_proofpaystatPhar =  $foval; }

      if($fo == 'fo_rows') { $fo_rows =  $foval; }
      if($fo == 'fo_pgno') { $fo_pgno =  $foval; }
      if($fo == 'fo_submit') { $fo_submit =  $foval; }

      if($fo == 'fo_rowscnt') { $fo_rowscnt =  $foval; }

    @endphp
    @endforeach
@endif

{{@csrf_field()}}
<input type="hidden" name="fo_aptid" id="fo_aptid" value="">
<input type="hidden" name="fo_hfser_id" id="fo_apfo_hfser_idtid" value="">
<input type="hidden" name="fo_ocid" id="fo_ocid" value="">
<input type="hidden" name="fo_hgpid" id="fo_hgpid" value="">
<input type="hidden" name="fo_status" id="fo_status" value="">
<input type="hidden" name="fo_assignedRgn" id="fo_assignedRgn" value="">
<div id="getData1" class="getDataClass filter-options">
  <div class="box box-solid">
    <div class="box-header">
      <i class="fa fa-th"></i>

      <span> General Filter Options</span>
      
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
                
              <select name="fo_date_sel" id="fo_date_sel" class="form-control" style="width: 100%;"  tabindex="-1" aria-hidden="true">
                  <option value="APP" @if (!isset($fo_date_sel))  selected @elseif (isset($fo_date_sel)) @if ($fo_date_sel ==  'APP' )  selected @endif @endif>Applied Dates Within</option>
                  {{--  <option value="ISS" @if (!isset($fo_date_sel))  selected @elseif (isset($fo_date_sel)) @if ($fo_date_sel ==  'ISS' )  selected @endif @endif>Issued Dates Within</option>
                  <option value="PAY" @if (isset($fo_date_sel)) @if ($fo_date_sel ==  'PAY' )  selected @endif @endif>Payment Confirmed Dates Within</option>
                  <option value="INS" @if (isset($fo_date_sel)) @if ($fo_date_sel ==  'INS' )  selected @endif @endif>Inspection/Evaluation Dates Within</option>
                  <option value="REC" @if (isset($fo_date_sel)) @if ($fo_date_sel ==  'REC' )  selected @endif @endif>Recommended Dates Within</option>
                  <option value="APR" @if (isset($fo_date_sel)) @if ($fo_date_sel ==  'APR' )  selected @endif @endif>Issuance/Non Issuance Dates Within</option> --}}
              </select> 

            </div>
          </div>

          <div class="col-md-3">
            <div class="form-group"> 

              <div class="row">
                <div class="col-md-6"><input type="date" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_date_1" id="fo_date_1" value="@if(isset($fo_date_1)){{$fo_date_1}}@endif"></div>
                <div class="col-md-6"><input type="date" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_date_2" id="fo_date_2" value="@if(isset($fo_date_2)){{$fo_date_2}}@endif"></div>
              </div>

            </div>
          </div>
      </div>

      <div class="row">

        <div class="col-md-3">
          <div class="form-group">

            <label class="control-label">Application Code</label>
            <input type="number" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_appid" id="fo_appid" value="@if(isset($fo_appid)){{$fo_appid}}@endif">
            </div>
        </div>
            <div class="col-md-3">
            <div class="form-group">
              <label>Facility Name</label>
              <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_facilityname" id="fo_facilityname" value="@if(isset($fo_facilityname)){{$fo_facilityname}}@endif">          
            </div>
        </div>

        <div class="col-md-3">
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
        
        <div class="col-md-2" style="display:none">
          <div class="form-group">
            <label>X-Ray Payment Status</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_proofpaystatMach" id="fo_proofpaystatMach">
              <option value=""  @if (!isset($fo_proofpaystatMach))  selected @endif>All</option>
              <option  value="posting"  @if (isset($fo_proofpaystatMach)) @if ($fo_proofpaystatMach ==  'posting' )  selected @endif @endif>For Posting</option>
              <option  value="posted"  @if (isset($fo_proofpaystatMach)) @if ($fo_proofpaystatMach ==  'posted' )  selected @endif @endif>Posted</option>
              <option  value="insufficient"  @if (isset($fo_proofpaystatMach)) @if ($fo_proofpaystatMach ==  'insufficient' )  selected @endif @endif>Insufficient Payment</option>
            </select>
          </div>
        </div> 

        <div class="col-md-2" style="display:none">
          <div class="form-group">
            <label>Pharma Payment Status</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_proofpaystatPhar" id="fo_proofpaystatPhar">
              <option value=""  @if (!isset($fo_proofpaystatPhar))  selected @endif>All</option>
              <option  value="posting"  @if (isset($fo_proofpaystatPhar)) @if ($fo_proofpaystatPhar ==  'posting' )  selected @endif @endif>For Posting</option>
              <option  value="posted"  @if (isset($fo_proofpaystatPhar)) @if ($fo_proofpaystatPhar ==  'posted' )  selected @endif @endif>Posted</option>
              <option  value="insufficient"  @if (isset($fo_proofpaystatPhar)) @if ($fo_proofpaystatPhar ==  'insufficient' )  selected @endif @endif>Insufficient Payment</option>
            </select>
          </div>
        </div> 

      </div>

    </div>

  </div>

  <div class="col-md-12 box-footer ">
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
              <li class="page-item"><button type="submit" class="page-link" name="fo_submit" id="fo_submit" value="first"> << </button></li>
              <li class="page-item"><button type="submit" class="page-link" name="fo_submit" id="fo_submit" value="prev"> < </button></li>
              <li class="page-item"><a class="page-link" href="#">@if (isset($fo_pgno)) {{$fo_pgno}} @else {{'1'}} @endif </a></li>
              <li class="page-item"><button type="submit" class="page-link" name="fo_submit" id="fo_submit" value="next"> > </button></li>
              <li class="page-item"><button type="submit" class="page-link" name="fo_submit" id="fo_submit" value="end"> >> </button></li>
            </ul>
          </nav> 
        </div>

        <div class="col-md-6 text-right">
          <nav aria-label="Page navigation example">
            <ul class="pagination">
              
              <li class="page-item">Total Records Result:&nbsp;&nbsp;&nbsp;</li>
              <li class="page-item text-bold">@if (isset($fo_rowscnt)) {{number_format($fo_rowscnt)}} @else {{'0'}} @endif</li>
              <li class="page-item">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</li>
              <li class="page-item"><button type="submit" class="btn btn-info submit-search" name="fo_submit" id="fo_submit" value="submit">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                  <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
                </svg> Submit
              </button></li>
            </ul>
          </nav>          
        </div>

      </div> <!-- end of row -->

    </div><!-- end of box-footer -->
  
</div>