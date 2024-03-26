@if (session()->exists('employee_login'))   
  @extends('mainEmployee')
  @section('title', 'View CON Evaluation Result')
  @section('content')
  <style>
    .table, td, th, tr{
      border: 1px solid black!important;
    }
  </style>
  <input type="text" id="CurrentPage" hidden="" value="PF014">
  <div class="content p-4">
  	<div class="card">
  		<div class="card-header bg-white font-weight-bold">
         	View CON Evaluation Result 
         	<button class="btn btn-primary" onclick="window.history.back();">Back</button>
      	</div>
      	<div class="container-fluid border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">1. BED TO POPULATION RATIO</p>
      	<table class="table table-bordered mt-3 DT">
      		<thead>
      			<tr>
      				<th colspan="4">Determination of Projected Primary and Secondary Catchment Population (P)</th>
      			</tr>
      			<tr>
      				<td></td>
      				<td>Barangay/Municipality/District/Province/Region</td>
      				<td>Projected Population (5<sup>th</sup> year) of Catchment Area</td>
              <td>Projected Population recommendation</td>
      			</tr>
      		</thead>
          <!--  $total += $b->population; $totalinpt+= $b->eval_est; -->
      		<tbody>
      			@php $total = 0; $totalinpt= 0; @endphp
            @if(!empty($brp[0]))
      			@foreach($brp[0] as $b)
      			@php $total += $b->population; $totalinpt+= $b->eval_est; @endphp
  				<tr>
  					<td>
  						{{($b->type == 1 ? 'Secondary' : 'Primary')}}
  					</td>
  					<td>
  						{{$b->location}}
  					</td>
  					<td>
  						{{number_format($b->population)}}
  					</td>
            <td>
  						{{number_format($b->eval_est)}}
  					</td>
  				</tr>
      			@endforeach
            @endif
      			<tr class="bg-info text-white font-weight-bold">
      				<td>Total</td>
      				<td class="text-center font-weight-bold">Projected Primary and Secondary Catchment Population(P) = </td>
      				<td class="font-weight-bold">{{number_format($total)}}</td>
      				<td class="font-weight-bold">{{number_format($totalinpt)}}</td>
      			</tr>
      		</tbody>
      	</table>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">A. Existing Hospitals</p>
      	<table class="table table-bordered mt-3 DT">
          <thead>
            <tr>
              <td>Existing Hospitals</td>
              <td>Location</td>
              <td>ABC</td>
              <td>Level of Hospital</td>
            </tr>
          </thead>
          <tbody>
          	@php $existTotal = 0; @endphp
            @foreach($hospitalData as $data)
            @if(!empty($data->tya) && !empty($data->aya) && !empty($data->apty) & !empty($data->ttph))
            <tr>
            	@php $existTotal += $data->noofbed; @endphp
            	<td>{{$data->facilityname}}</td>
            	<td>{{$data->location}}</td>
            	<td>{{$data->noofbed}}</td>
            	<td>{{($data->facname ?? 'N/A')}}</td>
            </tr>	
            @endif
            @endforeach
            <tr class="font-weight-bold bg-info text-white">
            	<td>TOTAL</td>
            	<td>SubTotal ABC (1)</td>
            	<td>{{number_format($existTotal)}}</td>
            	<td></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">B. Hospitals Currently Applying for License to Operate</p>
      	<table class="table table-bordered mt-3 DT">
          <thead>
            <tr>
              <td>Hospitals</td>
              <td>Location</td>
              <td>ABC</td>
              <td>Level of Hospital</td>
            </tr>
          </thead>
          <tbody>
          	@php $LTOTotal = 0; @endphp
            @foreach($hospitalData as $data)
            @if(empty($data->tya) && empty($data->aya) && empty($data->apty) & empty($data->ttph))
            <tr>
            	@php $LTOTotal += $data->noofbed; @endphp
            	<td>{{$data->facilityname}}</td>
            	<td>{{$data->location}}</td>
            	<td>{{$data->noofbed}}</td>
            	<td>{{($data->facname ?? 'N/A')}}</td>
            </tr>	
            @endif
            @endforeach
            <tr class="font-weight-bold bg-info text-white">
            	<td>TOTAL</td>
            	<td>SubTotal ABC (2)</td>
            	<td>{{number_format($LTOTotal)}}</td>
            	<td></td>
            </tr>
          </tbody>
        </table>
      </div>

       <div class="container-fluid table-responsive border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">Determination of Bed-to-Population Ratio (BPR) = IHB / P x 1,000</p>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td class="font-weight-bold">IHB</td>
					<td>{{$evalRes->ihb}}</td>
				</tr>
				<tr>
					<td class="font-weight-bold">P</td>
					<td>{{number_format($totalinpt)}}</td>
		{{--			<td>{{number_format($total)}}</td>--}}
				</tr>
				<tr class="bg-info font-weight-bold text-white">
					<td>BPR</td>
					<td>{{$evalRes->bpr}}</td>
				</tr>
			</tbody>
		</table>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">Determination of Projected Bed Need (PBN) = P x 1/1,000</p>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td class="font-weight-bold">P</td>
          <td>{{number_format($totalinpt)}}</td>
					{{--			<td>{{number_format($total)}}</td>--}}
				</tr>
				<tr class="bg-info font-weight-bold text-white">
					<td class="font-weight-bold">PBN</td>
					<td>{{$evalRes->pbn}}</td>
				</tr>
			</tbody>
		</table>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
        <p class="font-weight-bold lead pt-2">Determination of Unmet Bed Need (UBN) = PBN - IHB</p>
        <table class="table table-bordered mt-3">
          <tbody>
            <tr>
              <td class="font-weight-bold">PBN</td>
              <td>{{$evalRes->pbn}}</td>
            </tr>
            <tr>
              <td class="font-weight-bold">IHB</td>
              <td>{{$evalRes->ihb}}</td>
            </tr>
            <tr class="bg-info text-white">
              <td class="font-weight-bold">UBN</td>
              <td>{{$evalRes->pbn - $evalRes->ihb}}</td>
              <!-- <td>{{$evalRes->ubn}}</td> -->
            </tr>
          </tbody>
        </table>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
        <p class="font-weight-bold lead pt-2">Determination of Occupancy Rates of Existing Hospitals in Primary and Secondary Catchment Areas</p>
        <table class="table table-bordered mt-3 DT">
          <thead>
            <tr>
                <th rowspan="2">Existing Hospitals</th>
                <th rowspan="2">ABC</th>
                <th colspan="3" class="text-center">Occupancy Rate</th>
            </tr>
            <tr>
                <th>2 Years Ago</th>
                <th>A Year Ago</th>
                <th>Average for the past 2 years</th>
            </tr>
        </thead>
          <tbody>
          	@foreach($hospitalData as $data)
            @if(!empty($data->tya) && !empty($data->aya) && !empty($data->apty) & !empty($data->ttph))
            <tr>
            	<td>{{$data->facilityname}}</td>
            	<td>{{$data->noofbed}}</td>
            	<td class="text-center">{{$data->tya}}</td>
            	<td class="text-center">{{$data->aya}}</td>
            	<td class="text-center">{{$data->apty}}</td>
            </tr>	
            @endif
            @endforeach
            <tr class="font-weight-bold bg-info text-white">
            	<td>TOTAL</td>
            	<td></td>
            	<td></td>
            	<td>Overall Average Occupancy Rate of Existing Hospitals for Past 2 Years</td>
            	<td class="text-center">{{$evalRes->psc. ' %'}}</td>
            </tr>
          </tbody>
        </table>
      </div>
	  
	  @if($evalRes->psc > 84)
      <div class="container-fluid table-responsive border mb-3 pt-3">
        <p class="font-weight-bold lead pt-2">
        	2. Travel Time
    	</p>
        <table class="table table-bordered mt-3 DT">
          <thead>
          	<tr class="text-center">
          		<th colspan="3">Determination of Travel Time from Proposed Hospital to Existing Hospitals in Primary and Secondary Catchment Areas</th>
          	</tr>
            <tr>
                <th>Existing Hospitals</th>
                <th>Location</th>
                <th class="text-center">Travel time to Proposed Hospital</th>
            </tr>
        </thead>
          <tbody>
            @foreach($hospitalData as $data)
            @if(!empty($data->tya) && !empty($data->aya) && !empty($data->apty) & !empty($data->ttph))
            <tr>
            	<td>{{$data->facilityname}}</td>
            	<td>{{$data->location}}</td>
            	<td>{{$data->ttph}}</td>
            </tr>	
            @endif
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
        <p class="font-weight-bold lead pt-2">
        	3. ACCEESSIBILITY AND STRATEGIC LOCATION
    	</p>
        <table class="table table-bordered mt-3 DT">
          <thead>
          	<tr class="text-center">
          		<th colspan="4">Accessibility and Strategic Location of the Proposed Hospital</th>
          	</tr>
            <tr>
              <th></th>
              <th class="text-center">Yes/NO</th>
              <th class="text-center">Remarks</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                Accessibility (Accessible by the usual means of transportation during most part of the year)
              </td>
              <td class="text-center">
                {{($evalRes->acc == 1 ? 'Yes' : 'No')}}
              </td>
              <td>
              	{{$evalRes->remarksacc}}
              </td>
            </tr>
            <tr>
              <td>
                Strategic Location
              </td>
              <td class="text-center">
                {{($evalRes->st == 1 ? 'Yes' : 'No')}}
              </td>
              <td>
              	{{$evalRes->remarksst}}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
        <p class="font-weight-bold lead pt-2">
        	4. INTEGRATION WITH PROVINCIAL HOSPITAL DEVELOPMENT PLAN
    	</p>
        <table class="table table-bordered mt-3 DT">
          <thead>
          	<tr class="text-center">
          		<th colspan="4">Integration with Local (Provincial) Hospital Development Plan (if available)</th>
          	</tr>
            <tr>
              <th></th>
              <th class="text-center">Yes/NO</th>
              <th class="text-center">Remarks</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                There is a Local (Provincial) Hospital Development Plan that is Approved by the Department of Health.
              </td>
              <td class="text-center">
                {{$evalRes->hdp == 1 ? 'Yes' : 'No'}}
              </td>
              <td>
              	{{$evalRes->remarkshdp}}
              </td>
            </tr>
            <tr>
              <td>
                The Proposed hospital is integrated with the Local (Provincial) Hospital Development Plan
              </td>
              <td class="text-center">
                {{$evalRes->tph  == 1 ? 'Yes' : 'No'}}
              </td>
              <td>
              	{{$evalRes->remarkstph}}
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">
        	5. TRACK RECORD
    	</p>
        <table class="table table-bordered mt-3 DT">
          <thead>
            <tr class="font-weight-bold">
              <td>Name of Existing Hospital Currently Being Operated/ Managed by Proponent, if any. *</td>
              <td>Location</td>
              <td class="text-center">Good Compliance to licensing Requirement</td>
              <td class="text-center">Few Verified Complaints</td>
              <td class="text-center">Remarks</td>
            </tr>
          </thead>
          <tbody>
            @foreach($existHosp as $tracks)
            <tr>
              <td>{{$tracks->facilityname}}</td>
              <td>{{$tracks->location1}}</td>
              <td class="text-center">
                {{$tracks->compliance  == 1 ? 'Yes' : 'No'}}
              </td>
              <td class="text-center">
                {{$tracks->complaints  == 1 ? 'Yes' : 'No'}}
              </td>
              <td>
                {{$tracks->evalRemarks}}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">
        	SUMMARY
    	</p>
        <table class="table table-bordered mt-3 DT">
          <thead>
            <tr class="font-weight-bold">
              <td>Criteria</td>
              <td class="text-center">Satisfied</td>
              <td>Remarks</td>
            </tr>
          </thead>
           <tbody>
            <tr>
              <td>
                1. Bed-to-Population Ratio
              </td>
              <td class="text-center">
               {{$evalRes->bpp  == 1 ? 'Yes' : 'No'}}
              </td>
              <td>
                {{$evalRes->remarksbpp}}
              </td>
            </tr>
            <tr>
              <td>
                2. Travel Time At least one hour away by the usual means of transportation during the most part of the year from the nearest existing hospital
              </td>
              <td class="text-center">
               {{$evalRes->tt  == 1 ? 'Yes' : 'No'}}
              </td>
              <td>
                {{$evalRes->remarkstt}}
              </td>
            </tr>
            <tr>
              <td>
                3. Accessibility and Strategic Location
              </td>
              <td class="text-center">
               {{$evalRes->asl  == 1 ? 'Yes' : 'No'}}
              </td>
              <td>
                {{$evalRes->remarksasl}}
              </td>
            </tr>
            <tr>
              <td>
                4. Integration with local (provincial) hospital development plan, if available
              </td>
              <td class="text-center">
               {{$evalRes->ilh  == 1 ? 'Yes' : 'No'}}
              </td>
              <td>
                {{$evalRes->remarksilh}}
              </td>
            </tr>
            <tr>
              <td>
                5. Acceptable Track Record
              </td>
              <td class="text-center">
               {{$evalRes->atr  == 1 ? 'Yes' : 'No'}}
              </td>
              <td>
                {{$evalRes->remarksatr}}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      @endif

      <div class="container-fluid table-responsive border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">
        	Remarks
        	<!-- Comments -->
    	</p>
    	<div class="container-fluid border border-secondary rounded input" style="min-width: 300px; min-height: 300px">
    		{{$evalRes->comments}}
		</div>
      </div>

      <div class="container-fluid table-responsive border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">
        	RECOMMENDATION
    	</p>
    	<div class="container lead" style="font-size: 30px;">
    		<u>To <strong>{{($appdata->concommittee_eval == 1 ? 'GRANT' : 'DISAPPROVE')}}</strong> the Certificate of Need to <strong>{{ucwords($appdata->facilityname)}}</strong></u>
    	</div>
       </div>
       <div class="container-fluid mt-1 mb-2">
        With Approved bed capacity of:
        <input type="text" style="width: 30%;" disabled value="{{$evalRes->ubn}}" class="form-control" name="ubnval">
      </div>
       
       <div class="container-fluid table-responsive border mb-3 pt-3">
      	<p class="font-weight-bold lead pt-2">
        	Committee Members:
    	</p>
    	<table class="table table-bordered mt-3 DT">
          <thead>
            <tr class="font-weight-bold">
              <th>PRINTED NAME</th>
			  <th>POSITION</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($members))
            @php
              $pageNos = array();
            @endphp
              @foreach($members as $mem)
                @php
                $pageno = $mem->fname .' '. ($mem->mname ?? $mem->mname.'.') . ' ' . $mem->lname;
                @endphp
                   @if(!in_array($pageno, $pageNos))

              <tr>
              	<td>{{$mem->fname .' '. ($mem->mname ?? $mem->mname.'.') . ' ' . $mem->lname}}</td>
              	<td>
                  @if($mem->pos == 'C')
                    Chief
                  @elseif($mem->pos == 'LO')
                    Licensing Officer
                  @else
                    Medical Officer
                  @endif
                
              </td>
              </tr>
                    @php
                      array_push($pageNos,$pageno);
                    @endphp
                  @endif
              @endforeach
            @endif
          </tbody>
        </table>
       </div>


  	</div>
  </div>
  <script type="text/javascript">
  	$(document).ready(function(){
  		$('.DT').DataTable();
  	});
  </script>
  @endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
