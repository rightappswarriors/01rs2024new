@if (session()->exists('employee_login'))
    @extends('mainEmployee')
    @section('title', 'Dashboard')
    @section('content')
    <input type="hidden" id="token" value="{{ Session::token() }}" hidden>
    @include('employee.__dashboard')
    <div class="content p-4 d-none">
        <h2 class="mb-4">Dashboard</h2>
        <div class="flex-grow-1 bg-white p-4">
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-white font-weight-bold">
                          Application Status
                        </div>
                        <div class="container mt-3">
                            <button type="button" id="ALL" class="btn-primary btn p-3 mb-2 text-white font-weight-bold" style="text-shadow: 1px 2px 4px #000000;">Show All</button>
                             |&nbsp;<button type="button" id="P" class="btn p-3 mb-2 text-white font-weight-bold" style="text-shadow: 1px 2px 4px #000000; background-color: yellow">On Process</button>
                             |&nbsp;<button type="button" id="PP" class="btn p-3 mb-2 text-white font-weight-bold" style="text-shadow: 1px 2px 4px #000000; background-color: yellow">Paid, Pending</button>
                             |&nbsp;<button type="button" id="FI" class="btn p-3 mb-2 text-white font-weight-bold" style="text-shadow: 1px 2px 4px #000000; background-color: yellow">For Inspection</button>
                             |&nbsp;<button type="button" id="FA" class="btn p-3 mb-2 text-white font-weight-bold" style="text-shadow: 1px 2px 4px #000000; background-color: yellow">For Approval</button>
                             |&nbsp;<button type="button" id="FR" class="btn p-3 mb-2 text-white font-weight-bold" style="text-shadow: 1px 2px 4px #000000; background-color: red">For Recommendation</button>
                             |&nbsp;<button |&nbsp;<button="" type="button" id="A" class="btn p-3 mb-2 text-white font-weight-bold" style="text-shadow: 1px 2px 4px #000000; background-color: green">Approved</button>
                             |&nbsp;<button type="button" id="RE" class="btn p-3 mb-2 text-white font-weight-bold" style="text-shadow: 1px 2px 4px #000000; background-color: red">Evaluation Disapproved</button>
                            {{-- for presentation only --}}
                            {{-- @foreach($filters as $eachFilters)
                                |&nbsp;<button type="button" id="{{$eachFilters['statID']}}" class="btn p-3 mb-2 text-white font-weight-bold" style="text-shadow: 1px 2px 4px #000000; background-color: {{$eachFilters['color']}}">{{$eachFilters['original']}}</button>
                            @endforeach --}}
                        </div>
                        <!-- div class="card-body">
                            <div  class="table-responsive"  id="chart_div_3" style="width: 100%; height: auto;">
                                <table id="displayTable" class="table" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">Type</th>
                                            <th class="text-center" scope="col">Code</th>
                                            <th class="text-center" scope="col">Name Facility</th>
                                            <th class="text-center" scope="col">Facility Type</th>
                                            <th class="text-center" scope="col">Service Capabilities</th>
                                            @if(isset($grpid) && $grpid == 'LO')
                                                <th class="text-center" scope="col">Deadline of Inspection</th>
                                            @endif
                                            <th class="text-center" scope="col">Application Status</th>
                                            <th class="text-center" scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- {{dd($subdesc)}} --}}
                                        @isset($BigData)
                                            @for($i = 0; $i < count($BigData); $i++)
                                                <tr class="{{$BigData[$i]->status}}">
                                                    <td class="text-center">{{$BigData[$i]->hfser_id}}</td>
                                                    <td class="text-center">{{$BigData[$i]->hfser_id}}R{{$BigData[$i]->rgnid}}-{{$BigData[$i]->appid}}</td>
                                                    <td class="text-center font-weight-bold">{{$BigData[$i]->facilityname}}</td>
                                                    <td class="text-center">
                                                        <?php// $curSubDesc = []; if(count($subdesc[$i]) > 0) { if(isset($subdesc[$i][0])) { if(count($subdesc[$i][0]) > 0) { $hgpdescRow = []; foreach($subdesc[$i][0] AS $subdescRow) { array_push($hgpdescRow, $subdescRow->hgpdesc); } echo '<strong>'.implode(', ', $hgpdescRow).'</strong>'; } else { echo 'No Facility Name'; } } else { echo 'No Facility Name'; } } else { echo 'No Facility Name'; } ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php //$curSubDesc = []; if(count($subdesc[$i]) > 0) { if(isset($subdesc[$i][1])) { if(count($subdesc[$i][1]) > 0) { $facnameRow = []; foreach($subdesc[$i][1] AS $subdescRow) { array_push($facnameRow, $subdescRow->facname); } echo '<strong>'.implode(', ', $facnameRow).'</strong>'; } else { echo 'No Service Capabilities'; } } else { echo 'No Service Capabilities'; } } else { echo 'No Service Capabilities'; } ?>
                                                    </td>
                                                    @if(isset($grpid) && $grpid == 'LO')
                                                        @isset($d->proposedInspectiondate) 
                                                            <td class="text-center font-weight-bold" style="color:{{$BigData[$i]->checkInspectDate}}">{{$d->formattedDateInspection}}</td> {{-- Recommended Date of Inspection --}}
                                                        @else
                                                            <td class="text-center font-weight-bold">Not yet Added</td>
                                                        @endisset
                                                    @endif
                                                    <td class="text-center">{{$BigData[$i]->aptdesc}}</td>
                                                    <td class="text-center" style="background-color: @isset($BigData[$i]->statColor){{$BigData[$i]->statColor}}@endisset;color: white;font-weight: bold;text-shadow: 2px 2px 4px #000000">
                                                        {{$BigData[$i]->trns_desc}}
                                                    </td>
                                                </tr>
                                            @endfor
                                        @else
                                        <tr>
                                            <td colspan="7">No Applicant(s) yet.</td>
                                        </tr>
                                        @endisset
                                    </tbody>
                                </table>
                            </div>
                        </div !--->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#displayTable').DataTable({
                paging: false
            });
         });
        // $(document).on('click','#{{implode(',#',array_keys($filters))}},#ALL',function() {
        //     let filterID = $(this).attr('id');
        //     $("#displayTable tbody tr").each(function(el) {
        //         if(filterID != 'ALL'){
        //            if(!$(this).hasClass(filterID)){
        //             $(this).hide();
        //            } else {
        //             $(this).show();
        //            }
        //         } else {
        //             $(this).show();
        //         }
        //     });
        // });
    </script>
@endsection
@else
<script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
