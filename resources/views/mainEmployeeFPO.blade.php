<!DOCTYPE html>

<html>

<head>

	<title>@yield('title') | Integrated DOH Online Licensing and Regulatory System</title>
	
	@include('employee.cmp._head') {{-- LINKS --}}

	@include('employee.cmp._style') {{-- CUSTOM STYLES --}}

</head>

<body class="bg-light" 
	@if(session()->exists('employee_login'))
		style="overflow: auto; height: auto; min-height: 100%;"  
	@else	
		style="background: linear-gradient(to bottom left, #228B22, #84bd82);padding: 1px 1px 1px 1px;"
	@endif	>
	<div id="LOADERSDIV"><div class="loader" >Loading...</div></div>
	<input type="text" id="token" value="{{ Session::token() }}" hidden>

	@if(session()->exists('employee_login'))

		@php  $employeeData = session('employee_login');  @endphp

	@else

		<link rel="stylesheet" href="{{asset('ra-idlis/public/css/forall.css')}}">
		{{--- @include('employee.cmp._nav')   --}}
		
			
	@endif

	@include('employee.cmp._error') {{-- ERROR --}}
		
	@yield('content') {{-- MAIN CONTAINER --}}

	@if(session()->exists('employee_login'))
		
		

	@else
		@include('employee.cmp._foot') {{-- FOOTER --}}
		@include('employee.cmp._right') {{-- RIGHTS --}}
	@endif
	@include('employee.cmp._toTop') {{--TO TOP --}}
	@include('employee.cmp.msg')

	
	<script type="text/javascript">
		$(document).on('keyup','input[type=number]',function(){
			if(this.value < 0){
				$(this).val(0);
			}
			$(this).attr('min',0);
		})


		$('input[type="number"]').on('keypress',function(e){
	      evt = (e) ? e : window.event;
	      var charCode = (evt.which) ? evt.which : evt.keyCode;
	      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	          return false;
	      }
	      return true;
	    })

		// $("input[type=date]").each(function(index, el) {
		// 	$(this).removeAttr('type').datepicker({ dateFormat: 'mm-dd-yy' });
		// });
		

		$(document).ready(function(){
			$('#LOADERSDIV').delay(300).hide(300);
			GroupRightsActivate();
		});
		$(document).ajaxStart(function(){
		    $('#LOADERSDIV').show();
		});

		$(document).ajaxComplete(function(){
		    $('#LOADERSDIV').delay(300).fadeOut(300);
		});
		function GroupRightsActivate()
		{
		var CurrentPage = $('#CurrentPage').val();
        $.ajax({
	      url: " {{asset('employee/getRights')}}",
	      data : {_token: $('#token').val()},
	      method: 'GET',
	      success: function(data) {
	        for (var i = 0; i < data.length; i++) {
	            var moduleSelected = data[i];
	            if (moduleSelected.mod_id == CurrentPage) {
	                if (moduleSelected.allow == "0") {
	                    window.location.href = "{{asset('employee')}}";
	                }
	            }
	            if (moduleSelected.ad_d == "0") {
	                $('.'+moduleSelected.mod_id+'_add').empty();
	            }
	            if (moduleSelected.cancel == "0") {
	                $('.'+moduleSelected.mod_id+'_cancel').empty();
	            }
	            if (moduleSelected.print == "0") {
	                $('.'+moduleSelected.mod_id+'_print').empty();
	            }
	            if (moduleSelected.allow == "0") {
	                $('.'+moduleSelected.mod_id+'_allow').empty();
	            }
	            if (moduleSelected.upd == "0") {
	                $('.'+moduleSelected.mod_id+'_update').empty();
	            }
	            if (moduleSelected.view == "0") {
	                $('.'+moduleSelected.mod_id+'_view').empty();
	            }
	        }
	      },
	      error: function(a, b, c){
	      	console.log(c);
	      }
	  });
	}

		// let pageHere = $('#CurrentPage').val();
		// $.ajaxSetup({
		//     beforeSend: function() {
		//         console.log('fired');
		//     }
		// });
	function logActions(message){
		let pageHere = $('#CurrentPage').val();
		$.ajax({
			url: '{{asset('/employee/dashboard/activityLogs')}}',
			method: 'POST',
			data: {
				_token: $('#token').val(),
				mod_id: pageHere,
				activity: message
			}
		});	
	}


	// 1st param = less than
	function validateDateLessGreat(fromDateDom, toDateDom){
		var d1 = new Date(fromDateDom.val());
		var d2 = new Date(toDateDom.val());
		if(d2 <= d1){
			alert('Invalid Date. Please input proper date');
			toDateDom.val('');
		}
	}

		function GoBackWithRefresh(event) {
		if ('referrer' in document) {
			window.location = document.referrer;
			/* OR */
			//location.replace(document.referrer);
		} else {
			window.history.back();
		}
	}
	
	</script>

	
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.0.3/css/dataTables.dateTime.min.css" />
<link rel="stylesheet" type="text/css" href='{{asset("ra-idlis/public/css/__adjustment.css")}}' />

</body>
	
</html>