@extends('mainEmployee')
@section('title', 'Surveillance')
@section('content')
  <div class="content p-4">
    <div class="card">
      <div class="card-header bg-white font-weight-bold">
           @include('employee.cmp._survHead')
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover" style="font-size: 13px;" id="example">
          <thead>
            <tr>
              <th scope="col" style="text-align: center; width:auto;">ID</th>
              <th scope="col" style="text-align: center; width:auto">Name of Facility</th>
              <th scope="col" style="text-align: center; width:150px;">Location/ <br>Address</th>
              <th scope="col" style="text-align: center; width:auto">Facility Code</th>
              <th scope="col" style="text-align: center; width:auto">Date of <br> Surveillance</th>
              <th scope="col" style="text-align: center; width:auto">Span of <br> Surveillance</th>
              <th scope="col" style="text-align: center; width:auto;">NOV <br>Reference<br> number</th>
              <th scope="col" style="text-align: center; width:auto">Options</th>
            </tr>
          </thead>
          <tbody>
            @isset($AllData)
              @foreach($AllData as $key => $value)
              {{-- {{dd($AllData)}} --}}
                <tr>
                  <td style="text-align:center">{{$value->survid}}</td>
                  <td style="text-align:center">{{$value->name_of_faci}}</td>
                  <td style="text-align:center">{{$value->address_of_faci}}</td>
                  <td style="text-align:center">{{$value->facname}}</td>
                  <td style="text-align:center">
                    @if($value->date_surveillance != "") 
                      <b>{{\Carbon\Carbon::parse($value->date_surveillance)->format('M d, Y')}}</b> to
                      <b>{{\Carbon\Carbon::parse($value->date_surveillance_end)->format('M d, Y')}}</b>
                    @endif
                  </td>
                  <td style="text-align:center">
                    @if($value->date_surveillance != "") 
                      {{-- {{\Carbon\Carbon::parse($value->date_monitoring)->format('M d, Y')}} --}}
                      @php
                        $date_start = new DateTime($value->date_surveillance);
                        $date_end = new DateTime($value->date_surveillance_end);
                        $interval = $date_start->diff($date_end);
                        $interval->d = $interval->d;
                      @endphp
                      @if($interval->d > 1)
                        {{$interval->d}} days
                      @else
                        {{$interval->d}} day
                      @endif
                    @endif
                  </td>
                  <td style="text-align:center">{{$value->hfsrbno}}</td>
                  

                  <td style="text-align:center">
                    <center>
                      <button class="btn btn-outline-info" data-toggle="modal" data-target="#sMonModal" onclick="showData('{{$value->violation}}','{{addslashes($value->LOE)}}','{{$value->survid}}','{{addslashes($value->comments)}}')" title="View Client Response of {{$value->name_of_faci}}">
                        <i class="fa fa-fw fa-eye"></i>
                      </button>

                      @if($value->team != "")
                        @php
                          $url = 'employee/dashboard/processflow/assessment/'.$value->survid.'/SURV/'.$value->type_of_faci;
                        @endphp
                        {{-- <button class="btn btn-outline-primary" title="Inspect {{$value->name_of_faci}}" onclick="window.location.href='{{url($url)}}'">
                          <i class="fa fa-search" aria-hidden="true"></i>
                        </button> --}}
                      @endif

                      @if($value->team == "")
                        <button class="btn btn-outline-danger" data-toggle="modal" data-target="#dMonModal" onclick="getDelData(
                          '{{$value->survid}}', '{{$value->name_of_faci}}'
                          )" title="Delete {{$value->name_of_faci}}">
                          <i class="fa fa-fw fa-trash"></i>
                        </button>
                      @endif
                    </center>
                  </td>
                </tr>
              @endforeach
            @endisset
          </tbody>
        </table>
      </div>
    </div>
  </div>  

  <div class="modal fade" id="sMonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <form method="POST">
        {{csrf_field()}}
        <input type="hidden" name="setToRevise">
        <input type="hidden" name="survid">
        <div class="modal-content " style="border-radius: 0px;border: none;">
          <div class="modal-body text-justify" style=" background-color: #272b30;color: white;">
            <h5 class="modal-title text-center lead"><strong>Client Action Taken</strong></h5>
            <hr>
            	<div class="container">
            		<div class="col-md-12 lead pb-3 text-center font-weight-bold">Client Action Comment</div>
            		<div class="container border rounded pt-1" id="cDetails" style="min-height: 100px;">
            			<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt nam sed, accusamus alias incidunt, magnam sint. Expedita corporis officiis amet omnis facere labore alias, odio veniam dicta suscipit ipsum assumenda. -->
            		</div>
            	</div>
            	<div class="container">
            		<div class="col-md-12 lead  pt-3 pb-3 text-center font-weight-bold">Violation Details</div>
            		<div class="container border rounded pt-1" id="vDetails" style="min-height: 100px;">
            			<!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt nam sed, accusamus alias incidunt, magnam sint. Expedita corporis officiis amet omnis facere labore alias, odio veniam dicta suscipit ipsum assumenda. -->
            		</div>
            	</div>

              <div class="container">
                <div class="col-md-12 lead  pt-3 pb-3 text-center font-weight-bold">Surveillance Committee Comments</div>
                <div class="container border rounded pt-1" id="survCom" style="min-height: 100px;">
                  <!-- Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt nam sed, accusamus alias incidunt, magnam sint. Expedita corporis officiis amet omnis facere labore alias, odio veniam dicta suscipit ipsum assumenda. -->
                </div>
              </div>
            	
  			<div class="col-md-12 lead pt-3 pb-3 text-center font-weight-bold">Client Action Proofs</div>
            	<div class="container pt-3 border" id="view">
  				
  	      	</div>
            <div class="container pt-3 border">
              Remarks
              <textarea required class="form-control w-100 mt-3 mb-3" name="remark" rows="5"></textarea>
            </div>
          </div>
          <div class="modal-footer" style="background-color: #272b30;color: white;">
            <button type="submit" class="btn btn-primary">Set as Not accepted</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </form>
    </div>
  </div>


  <script type="text/javascript">
    function showData(vio,resp,survid,com){
      $('[name=survid]').val(survid);
      $("#vDetails").empty().parent().show();
      if($.trim(vio) != ''){
    	 $("#vDetails").html(vio);
      } else {
        $("#vDetails").parent().hide();
      }
    	$("#cDetails").empty().html(resp);
      $("#survCom").empty().html(com);
    	let aString = '<div class="row">';
    	let sView = $("#view");
		$.ajax({
			url: '{{url('employee/dashboard/others/surveillance/getSurvAct')}}',
			method: 'POST',
			data: {_token: $('input[name=_token]').val(), survid: survid},
			success: function(a){
				let det = JSON.parse(a);
				sView.empty().html('<div class="container text-center font-weight-bold ">No Image Uploaded</div>');
				if(det['attachments'] != "" && det['attachments'] != null){
          let validImageTypes = ["gif", "jpeg", "png", "jpg"];
					let splited = det['attachments'].split(',');
					let perDiv = (12 % splited.length == 0 ? '-' + 12 / splited.length : '-3');
					for (var i = 0;  i < splited.length; i++) {
						let link = '{{asset('ra-idlis/storage/app/public/uploaded/')}}/'+splited[i]+'';
            // let srcLink = ($.inArray(fileType, validImageTypes) < 0 ? :)
						aString  += '<div class="col'+perDiv+' mt-3">'+
            '<img onclick="window.open('+"\'"+ link+'\')" " class="w-100" src="'+($.inArray(link.split('.').pop(), validImageTypes) < 0 ? '{{url('ra-idlis/public/img/no-preview-available.png')}}' : link)+'" style="cursor: pointer;">'+
            '</div>';
					}
					aString +='</div>';
					sView.empty().append(aString);
				}	
			}
		})
    }

    @isset($optid)
    $(document).ready(function(){
      $('#example_filter input').val('{{$optid}}').trigger('keyup');
    })
    @endisset
  </script>

  @include('employee.cmp._othersJS')
@endsection