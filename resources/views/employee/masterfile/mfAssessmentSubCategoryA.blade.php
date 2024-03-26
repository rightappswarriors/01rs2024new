@extends('mainEmployee')
@section('title', 'Subcategory A (Assessment) Master File')
@section('content')
<div class="content p-4">
    <div class="card">
        <div class="card-header bg-white font-weight-bold">
           Subcategory A (Assessment)&nbsp;<a href="#" title="Add New Subcategory A" data-toggle="modal" data-target="#myModal"><button class="btn-primarys"><i class="fa fa-plus-circle"></i>&nbsp;Add new</button></a>
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
           <table id="example" class="table" style="overflow-x: scroll;" >
              <thead>
                <tr>
                  <th style="width: auto;text-align: center;">ID</th>
                  <th style="width: auto;text-align: center;">Category</th>
                  <th style="width: auto;text-align: center;">Description</th>
                  <th style="width: 10%;">Options</th>
                </tr>
              </thead>
              <tbody id="FilterdBody">
                {{-- @isset ($asments)
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
                @endisset --}}
              </tbody>
            </table>
        </div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="border-radius: 0px;border: none;">
      <div class="modal-body text-justify" style=" background-color: #272b30;
    color: white;">
        <h5 class="modal-title text-center"><strong>Add New Subcategory A (Assessment)</strong></h5>
        <hr>
        <div class="container">
          <form id="addRgn" class="row"  data-parsley-validate>
            {{ csrf_field() }}
            <div class="col-sm-12 alert alert-danger alert-dismissible fade show" style="display:none" id="AddErrorAlert" role="alert">
                <strong><i class="fas fa-exclamation"></i></strong>&nbsp;An <strong>error</strong> occurred. Please contact the system administrator.
                <button type="button" class="close" onclick="$('#AddErrorAlert').hide(1000);" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="col-sm-4">Category:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
            	<select class="form-control">
            		<option value="">Select Category..</option>
            	</select>
            </div>
            <div class="col-sm-4">ID:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" id="new_rgnid" data-parsley-required-message="*<strong>ID</strong> required"  class="form-control"  required>
            </div>
            <div class="col-sm-4">Description:</div>
            <div class="col-sm-8" style="margin:0 0 .8em 0;">
              <input type="text" id="new_rgn_desc" class="form-control" data-parsley-required-message="*<strong>Description</strong> required" required>
            </div>
            <div class="col-sm-12">
              <button type="submit" class="btn btn-outline-success form-control"  style="border-radius:0;"><span class="fa fa-sign-up"></span>Save</button>
            </div> 
          </form>
       </div>
      </div>
    </div>
  </div>
</div>
@endsection