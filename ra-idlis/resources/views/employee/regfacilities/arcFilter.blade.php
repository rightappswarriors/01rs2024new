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

    @endphp
    @endforeach
@endif

{{@csrf_field()}}
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
          
          <div class="form-group">
            <label>Ownership Type</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_ocid" id="fo_ocid">
              <option value="" @if (!isset($fo_ocid))  selected @endif  >All</option>
              <option value="G" @if (isset($fo_ocid)) @if ($fo_ocid ==  'G' )  selected @endif @endif >Government</option>
              <option value="P" @if (isset($fo_ocid)) @if ($fo_ocid ==  'P' )  selected @endif @endif >Private</option>
            </select>
          </div>
        
        </div>  
        
        <div class="col-md-3">
          <div class="form-group">            
            <label>NHFR Code</label>
            <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_nhfr" id="fo_facilityname" value="@if(isset($fo_facilityname)){{$fo_facilityname}}@endif">          
          </div>
          
          <div class="form-group">            
            <label>System Registered Facility ID</label>
            <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_nhfr" id="fo_facilityname" value="@if(isset($fo_facilityname)){{$fo_facilityname}}@endif">          
          </div>
        </div>

        <div class="col-md-3">
          <div class="form-group">

            <div class="form-group">            
              <label>Facility Name</label>
              <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_facilityname" id="fo_facilityname" value="@if(isset($fo_facilityname)){{$fo_facilityname}}@endif">          
            </div>

            <label>Client Username</label>
            <input type="text" class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_uid" id="fo_uid"  value="@if(isset($fo_uid)){{$fo_uid}}@endif">
          
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
          <div class="form-group">
            <label>Assigned Region</label>
            <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" name="fo_assignedRgn" id="fo_assignedRgn">
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