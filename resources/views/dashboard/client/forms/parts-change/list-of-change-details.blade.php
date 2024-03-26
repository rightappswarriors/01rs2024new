<div class="row">
    <div class="col-md-12"><hr/></div>
    <div class="col-md-12 lead pt-3 pb-2 text-center text-uppercase font-weight-bold" style="font-size:30px ;">List of Details for Change</div>
    <div class="col-md-12">
        <table id="homeTbl" class="table dataTable no-footer" role="grid" aria-describedby="homeTbl_info">
            <thead>
                <tr role="row">
                    <th style="white-space: nowrap; width: 195.229px;" class="sorting_disabled" rowspan="1" colspan="1">Line No.</th>
                    <th style="white-space: nowrap; width: 236.125px;" class="sorting_disabled" rowspan="1" colspan="1">Type of Change</th>
                    <th style="white-space: nowrap; width: 461.458px;" class="sorting_disabled" rowspan="1" colspan="1">Remarks</th>
                    <th style="white-space: nowrap; width: 100px;" class="sorting_disabled" rowspan="1" colspan="1">Options</th>
                </tr>
            </thead>
            <tbody class="">
                
            @if (isset($appform_changeaction)) 
            @php $i=1;  @endphp
                @foreach ($appform_changeaction as $data)
                <tr class="odd" role="row">
                    <td class="font-weight-bold">{{$i++}} [{{$data->cat_id}}]</td>
                    <td>{{$data->description}}</td>
                    <td>{{$data->remarks}}</td>
                    <td>
                        <a class="btn btn-app btn-danger" type="button" href="#">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr> 
                @endforeach
            @endif        
            </tbody>
        </table>
    </div>
</div>