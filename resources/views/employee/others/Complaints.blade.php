@extends('mainEmployee')
@section('title', 'Complaints')
@section('content')
  <div class="content p-4">
    <div class="card">
      <div class="card-header bg-white font-weight-bold">
         Complaints
         <a href="#" title="Add New Complaint" data-toggle="modal" data-target="#compModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover" style="font-size:13px;" id="example">
          <thead>
            <tr>
              <th scope="col" style="text-align: center; width:auto">Ref No.</th>
              <th scope="col" style="text-align: center; width:auto" class="w-25">Type of Facility</th>
              <th scope="col" style="text-align: center; width:auto" class="w-25">Request Date</th>
              <th scope="col" style="text-align: center; width:auto" class="w-50">Requests</th>
            </tr>
          </thead>
          <tbody>
            @isset($AllData)
              @foreach($AllData as $all => $a)
                <tr>
                  <td style="text-align:center">{{$a->ref_no}}</td>
                  <td style="text-align:center">{{$a->type_of_faci}}</td>
                  <td style="text-align:center">{{$a->req_date}}</td>
                  <td style="text-align:center">
                    <ul style="list-style-type: none;">
                      @for($i=0; $i<count($a->comps); $i++)
                        <li class="text-left">
                          {{"•".$a->comps[$i]}}
                        </li>
                      @endfor
                    </ul>
                  </td>
                </tr>
              @endforeach
            @endisset
          </tbody>
        </table>            
      </div>
    </div>
  </div>
  @include('employee.others.OthersModal')
  @include('employee.cmp._othersJS') {{-- Javascript for this Module --}}
@endsection