@if (session()->exists('uData'))  
	@extends('main')
	@section('content')
	@include('client1.cmp.__apply')
	<body>
		<style>
			a{
				text-decoration: none!important;
			}
			.legend {
			  background-color: #fff;
			  left: 80px;
			  padding: 20px;
			  border: 1px solid;
			}
			.legend h4 {
			  text-transform: uppercase;
			  font-family: sans-serif;
			  text-align: center;
			}
			.legend ul {
			  list-style-type: none;
			  margin: 0;
			  padding: 0;
			}
			.legend li { padding-bottom: 5px; }
			.legend span {
			  display: inline-block;
			  width: 12px;
			  height: 12px;
			  margin-right: 6px;
			}
			a.button6{
				border: 1px solid black;
			    display: inline-block;
			    padding: 2em 1.4em;
			    margin: 0 0.3em 0.3em 0;
			    border-radius: 0.15em;
			    box-sizing: border-box;
			    text-decoration: none;
			    font-family: 'Roboto',sans-serif;
			    text-transform: uppercase;
			    font-weight: 400;
			    color: #FFFFFF;
			    background-color: rgb(255,192,0);
			    box-shadow: inset 0 -0.6em 0 -0.35em rgba(0,0,0,0.17);
			    text-align: center;
			    position: relative;
			    color:black;
			    /*text-shadow: 1px 1px 1px #000, 3px 3px 5px black; */
			}
			.buttonOthers{
				border: 1px solid black;
			    display: inline-block;
			    padding: 2em 1.4em;
			    margin: 0 0.3em 0.3em 0;
			    border-radius: 0.15em;
			    box-sizing: border-box;
			    text-decoration: none;
			    font-family: 'Roboto',sans-serif;
			    text-transform: uppercase;
			    font-weight: 400;
			    color: #FFFFFF;
			    background-color: rgb(255,192,0);
			    box-shadow: inset 0 -0.6em 0 -0.35em rgba(0,0,0,0.17);
			    text-align: center;
			    position: relative;
				text-shadow: 1px 1px 1px #000, 3px 3px 5px black; 
			}
			a.button6:active{
			 top:0.1em;
			}
			@media all and (max-width:30em){
			 a.button6{
			  display:block;
			  margin:0.4em auto;
			 }
			}
		</style>
		@include('client1.cmp.nav')
		@include('client1.cmp.breadcrumb')
		@include('client1.cmp.msg')
		@include('client1.cmp.__wizard')
		<div class="container border pt-3 pb-3">
			@if(isset($head[0]->idForBack) || isset($customAddress))
				<div class="col-md mt-5">
					<a href="{{(isset($customAddress) ? $customAddress :url('client1/apply/'.$beforeAddress.'/'.$data->appid.'/'.$head[0]->idForBack.'/'.$isMon))}}">
						<i class="fas fa-arrow-alt-circle-left text-primary" style="font-size: 30px;"> Back</i>
					</a>
				</div>
			
			@endif
			
			<table>
				<tr>
					<td style="width: 25%;">
						
					</td>
					<td style="width: 50%;">
						<div class="col display-4 text-center mt-5">[{{$data->hfser_id}}R{{$data->rgnid}}-{{$data->appid}}]</div>
						<div class="col display-4 text-center font-weight-bold">{{$data->facilityname}}</div>
					</td>
					<td style="width: 25%;">
						<div class="legend">
						    <h4>Legend</h4>
						    <ul>
						        <li><span class="bg-success"></span>Assessed</li>
						        <li><span class="bg-warning"></span>Pending for Assessment</li>
						    </ul>
						</div>
					</td>
				</tr>
				
			</table>
			<div class="col text-center mt-3" style="font-size: 30px">{{($isMon ? 'Monitoring Tool' : 'Self-Assessment Tool')}}</div>

			<div class="row mt-2">
				<div class="col-md col-sm-12 text-center" style="font-size: 20px; margin-top:5px; font-style:Italic;">
					* Please click the Part/Header buttons below to fill up the assessment tool.<br/>
					Click Generate Report only if you finished to fill up.
				</div>
			</div>

			<div class="col text-center mt-2 font-weight-bold" style="font-size: 15px">
				@isset($crumb)
					@foreach($crumb as $key => $bread)
						{!! ($key == 0 ? '' : ' > ').'<a href="'.(($bread['beforeAddress'] == 'MAIN') ? url('client1/apply/assessmentReady/'.$data->appid) : url('client1/apply/'.$bread['beforeAddress'].'/'.$data->appid.'/'.$bread['id'].'/'.$isMon)).'">'.$bread['desc'].'</a>' !!}
					@endforeach
				@endisset
			</div>
			
			<div class="row p-5 text-center main">
				@php 
					$arrDat = array();
					$arrDat1 = array();
				@endphp
				<script>
				console.log('{{$head}}')
				</script>

				@foreach($head as $key => $value)
				
				
					@if(isset($headon) && ($value->h1HeadID == 'AOASPT2AT' || $value->h1HeadID == 'AOASPT1AT'))
				
					
						@if(!in_array($value->xid, $arrDat))
						@php 
							array_push($arrDat, $value->xid)
						@endphp 
						
						<div class="col-sm-12">
							<a href="{{$address.'/'.$value->id.'/'.$isMon.'?xid='.$value->xid.'&pid='.$value->id.'&hid='.(app('request')->input('pid')?app('request')->input('pid'): app('request')->input('hid'))}}" class="button6 btn-block {{$value->xid}}">{{$value->desc}}</a>
							<!-- <a href="{{$address.'/'.$value->id.'/'.$isMon.'?xid='.$value->xid}}" class="button6 btn-block {{$value->id}}">{{$value->desc}}</a> -->
						</div>
						@endif 
					@else					
						@if(!in_array($value->id, $arrDat1))
							@php 
								array_push($arrDat1, $value->id)
							@endphp 
						
							<div class="col-sm-12"> 
								<a href="{{$address.'/'.$value->id.'/'.$isMon.'?xid='.$value->xid.'&pid='.$value->id.'&hid='.(app('request')->input('pid')?app('request')->input('pid'): app('request')->input('hid'))}}" class="button6 btn-block {{$value->id}}">{{$value->desc}}</a>
								<!-- <a href="{{$address.'/'.$value->id.'/'.$isMon.'?xid='.$value->xid.'&pid='.$value->id.'&hid='.app('request')->input('pid')}}" class="button6 btn-block {{$value->xid}}">{{$value->desc}}</a> -->
								<!-- <a href="{{$address.'/'.$value->id.'/'.$isMon.'?xid='.$value->xid}}" class="button6 btn-block {{$value->id}}">{{$value->desc}}</a> -->
							</div>
						@endif
					@endif				
				@endforeach

				@isset($isMain)
				<div class="col-sm-12">
					<a href="{{url('client1/apply/GenerateReportAssessments/'.$data->appid)}}" class="button6 btn-block "><i class="fa fa-fw fa-print"></i> Generate Report</a>
				</div>
				{{-- @if($appform->hfser_id == 'LTO') --}}
				<!-- <div class="col-sm-12">
					<a href="{{url('client1/apply/app/'.$appform->hfser_id.'/'.$data->appid.'/hfsrb')}}" class="button6 btn-block ">Skip this step for now and proceed to Requirement lists</a>
				</div> -->
				{{-- @endif --}}
				@if($appform->hfser_id == 'COA')
				<div class="col-sm-12">
					<!-- <a href="{{url('client1/apply/attachment/'.$appform->hfser_id.'/'.$appform->appid)}}" class="button6 btn-block ">Proceed To Documentary Requirements</a> -->
				</div>
				@endif
				@endisset
				
			</div>
			<div class="container buttonHere">
				
			</div>
		</div>

	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	  <script src="{{asset('ra-idlis/public/js/forall.js')}}"></script>
		<script>
            $(function(){

		@if(app('request')->input('pid') == 'AOASPT1AT' || app('request')->input('pid') == 'AOASPT2AT')
                let assesed = {!!empty($assesednew) ? json_encode('none') : json_encode($assesednew) !!};
                if(assesed instanceof Array){
                    $.each(assesed,function(index, el) {
						console.log("el")
						console.log(el)
						// if(el != 'AOASPT1AT' && el != 'AOASPT2AT' && el != 298 && el != 299){

                        let textOnDiv = $('.'+el).text();
                        $('.'+el).replaceWith('<p class="buttonOthers btn-block done" style="background-color:#28A745;"><i class="fa fa-check-circle p-2" aria-hidden="true"></i>'+textOnDiv+'</p>');
                 	//    }
					
					});
                }
		@else

				let assesed = {!!empty($assesed) ? json_encode('none') : json_encode($assesed) !!};
                if(assesed instanceof Array){
                    $.each(assesed,function(index, el) {
						console.log("el1")
						console.log(el)
						// if(el != 'AOASPT1AT' && el != 'AOASPT2AT' && el != 298 && el != 299){

                        let textOnDiv = $('.'+el).text();
                        $('.'+el).replaceWith('<p class="buttonOthers btn-block done" style="background-color:#28A745;"><i class="fa fa-check-circle p-2" aria-hidden="true"></i>'+textOnDiv+'</p>');
                 	//    }
					
					});
                }

		@endif
				// let assesed = {!!empty($assesed) ? json_encode('none') : json_encode($assesed) !!};
                // if(assesed instanceof Array){
                //     $.each(assesed,function(index, el) {
				// 		console.log("el")
				// 		console.log(el)
				// 		if(el != 'AOASPT1AT' && el != 'AOASPT2AT' && el != 298 && el != 299){

                //         let textOnDiv = $('.'+el).text();
                //         $('.'+el).replaceWith('<p class="buttonOthers btn-block done" style="background-color:#28A745;"><i class="fa fa-check-circle p-2" aria-hidden="true"></i>'+textOnDiv+'</p>');
                //  	   }
					
				// 	});
                // }
                if($('.main div').length == $('.main p.done').length){
                	@if(!isset($isMain))
					$.ajax({
						url: '{{url('client1/apply/registerAssess')}}',
						method: 'POST',
						data: {_token: '{{csrf_token()}}',level: '{{$neededData['level']}}', appid: '{{$data->appid}}',id: '{{$neededData['id']}}'}
					})			
					@endif

				}

            })
        </script>
		@include('client1.cmp.footer')
	</body>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('client1/apply') }}";</script>
@endif
