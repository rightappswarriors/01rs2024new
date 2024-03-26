@if (session()->exists('employee_login'))  
	@extends('mainEmployee')
	@section('title', 'Choose assessment file')
	@section('content')
		<style>
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
			    text-shadow: 1px 1px 1px #000, 3px 3px 5px black; 
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
		<script>
			$(function(){
				let assesed = {!!empty($assesed) ? json_encode('none') : $assesed !!};
				if(assesed instanceof Array){
					$.each(assesed,function(index, el) {
						let textOnDiv = $('.'+el).text();
						$('.'+el).replaceWith('<p class="buttonOthers btn-block done" style="background-color:#28A745;"><i class="fa fa-check-circle p-2" aria-hidden="true"></i>'+textOnDiv+'</p>');
					});
				}
				if($('.main div').length == $('.main p.done').length){
					$('.buttonHere').empty().append('<a href="{{asset('employee/dashboard/processflow/assessment/compiled/'.$appId.'/'.$apptype.'/')}}" class="button6 btn-block">Display Summary of Reports</a>').append('<a href="{{asset('employee/dashboard/processflow/assessment/compiled/'.$appId.'/'.$apptype.'/false/displayDynamic')}}" class="button6 btn-block">Display Summary of Reports (Auto Generated Report) </a>');
				}

			})
		</script>
		<div class="container border">
			<div class="col display-4 text-center mt-5 font-weight-bold">{{$AppData->facilityname}}</div>
			<div class="col text-center mt-3" style="font-size: 30px">Assessment Tool</div>
			<div class="row p-5 text-center main">
				@foreach($headers as $key => $value)
					@if($key !== 'hasNull')
						<div class="col-sm-12">
							<a href="{{$address.'/'.$value->asmt2l_id.'/'.$realMontype}}" class="button6 btn-block {{$value->asmt2l_id}}">{{$value->asmt2l_desc}}</a>
						</div>
					@elseif($headers['hasNull'] === true)
						<div class="col-sm-12">
							<a href="{{$address.'/'.'OTHERS'.'/'.$realMontype}}" class="button6 btn-block OTHERS">Others</a>
						</div>
					@endif
				@endforeach
			</div>
			<div class="container buttonHere">
				
			</div>
		</div>
	@endsection
@else
  <script type="text/javascript">window.location.href= "{{ asset('employee') }}";</script>
@endif
