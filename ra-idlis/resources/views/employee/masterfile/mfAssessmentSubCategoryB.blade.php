@extends('mainEmployee')
@section('title', 'Subcategory B (Assessment) Master File')
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Sub Category B (Assessment) <a href="#" title="Add New Assessment" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
           {{-- <div style="float:right;display: inline-block;">
            <form class="form-inline">
              <label>Filter : &nbsp;</label>
              <select style="width: auto;" class="form-control" id="filterer">
                <option value="">Select Part ...</option>
                @if (isset($parts))
                  @foreach ($parts as $part)
                    <option value="{{$part->partid}}">{{$part->partdesc}}</option>
                  @endforeach
                @endif
              </select>
            </form>
           </div> --}}
        </div>
        <div class="card-body table-responsive">
           {{-- <table id="example" class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: auto;text-align: center;">Facility</th>
                  <th style="width: 10%;text-align: center;">Part</th>
                  <th style="width: 10%;text-align: center;">Category</th>
                  <th style="width: 10%;text-align: center;">ID</th>
                  <th style="width: auto;text-align: center;">Description</th>
                  <th style="width: 10%;">Options</th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
                @isset ($asments)
                  @foreach ($asments as $e)
                    <tr>
                      <td style="text-align: center">{{$e->hgpdesc}}</td>
                      <td style="text-align: center">{{$e->partid}}</td>
                      <td style="text-align: center">{{$e->caid}}</td>
                      <td style="text-align: center">{{$e->asmt_id}}</td>
                      <td>{{$e->asmt_name}}</td>
                      <td><center>
                        <div class="row">
                          <span class="MA18_update">
                            <button type="button" class="btn btn-outline-warning" onclick="showData('{{$e->asmt_id}}', '{{$e->asmt_name}}', '{{$e->categorydesc}}', '{{$e->hgpdesc}}', '{{$e->partdesc}}');" data-toggle="modal" data-target="#GodModal"><i class="fa fa-fw fa-edit"></i></button>&nbsp;
                            </span>
                            <span class="MA18_cancel">
                            <button type="button" class="btn btn-outline-danger" onclick="showDelete('{{$e->asmt_id}}', '{{$e->asmt_name}}');" data-toggle="modal" data-target="#DelGodModal"><i class="fa fa-fw fa-trash"></i></button>
                          </span>
                        </div>
                      </center></td>
                    </tr>
                  @endforeach
                @endisset
              </tbody>
            </table> --}}
        </div>
@endsection