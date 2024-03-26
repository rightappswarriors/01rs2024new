<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Facility Name</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
        <div class="row mb-3">
            <div class="col-sm-8">
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="tApp">
                <thead class="thead-dark">
                    <tr>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Facility Name</th>
                        <th colspan="4" style="vertical-align: middle; text-align: center;">Location</th>
                    </tr>
                    <tr>
                        <th style="vertical-align: middle; text-align: center;">Region</th>
                        <th style="vertical-align: middle; text-align: center;">Province</th>
                        <th style="vertical-align: middle; text-align: center;">City/Municipality</th>
                        <th style="vertical-align: middle; text-align: center;">Barangay</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($appFacName) > 0) @foreach($appFacName AS $each)
                    <tr>
                        <td><a data-dismiss="modal" onclick="checkFacilityNameNew('{{$each->facilityname}}')" href="javascript:void(0);">{{$each->facilityname}}</a></td>
                        <!-- <td><a data-dismiss="modal" onclick="document.getElementsByName('facilityname')[0].value = '{{$each->facilityname}}';" href="javascript:void(0);">{{$each->facilityname}}</a></td> -->
                        <td>{{$each->rgn_desc}}</td>
                        <td>{{$each->provname}}</td>
                        <td>{{$each->cmname}}</td>
                        <td>{{$each->brgyname}}</td>
                    </tr>
                @endforeach @else
                    <tr>
                        <td colspan="2">No Facility</td>
                    </tr>
                @endif
            </table>
        </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
    </div>
    </div>
</div>