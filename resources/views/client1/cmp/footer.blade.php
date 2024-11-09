<style type="text/css">
  #style-15::-webkit-scrollbar-track
{
  -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.1);
  background-color: #F5F5F5;
  border-radius: 10px;
}

#style-15::-webkit-scrollbar
{
  width: 10px;
  background-color: #F5F5F5;
}

#style-15::-webkit-scrollbar-thumb
{
  border-radius: 10px;
  background-color: #FFF;
  background-image: -webkit-gradient(linear,
                     40% 0%,
                     75% 84%,
                     from(#4D9C41),
                     to(#19911D),
                     color-stop(.6,#54DE5D))
}

</style>
<footer id="_footBottom" class="footer" style="background: linear-gradient(to bottom left, #228B22, #84bd82);">
<div class="container bottom_border align">
  <div class="row">
    <div class=" col-sm-6 col-md col-sm-6  col-12 col">
	<h5 class="headin5_amrc col_white_amrc pt2">Online Chat Support</h5>
	    <div class="row">
	  
      <!--headin5_amrc-->
	  <div class=" col-sm-6 col-md col-sm-6  col-12 col">
		  <ul class="footer_ul_amrc">
			<li><a href="https://olrs.doh.gov.ph/helpdesk01/"> Region 1 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk02/"> Region 2 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk03/"> Region 3 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk04a/"> Region 4A Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk04b/"> Region 4B Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk05/"> Region 5 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk06/"> Region 6 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk07/"> Region 7 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk08/"> Region 8 Support</li>
		</ul>
      </div>
	<div class=" col-sm-6 col-md col-sm-6  col-12 col">
		<ul class="footer_ul_amrc">
			<li><a href="https://olrs.doh.gov.ph/helpdesk09/"> Region 9 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk10/"> Region 10 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk11/"> Region 11 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk12/"> Region 12 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdesk13/"> Region 13 Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdeskncr/"> NCR Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdeskcar/"> CAR Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdeskbarmm/"> BARMM Support</li>
			<li><a href="https://olrs.doh.gov.ph/helpdeskhfsrb/"> HFSRB Support</li>
		  </ul>
      </div>
	  </div>
    </div>
	
    <div class=" col-sm-6 col-md  col-6 col">
      <h5 class="headin5_amrc col_white_amrc pt2">Quick links</h5>
      <!--headin5_amrc-->
      <ul class="footer_ul_amrc">
      <li><a href="javascript:void(0)"><i class="fa fa-phone"></i>
        Telephone No. (632) 651-7800
        Fax (632) 711-6744</a>
      </li>
      <li><a href="javascript:void(0)"><i class="fa fa-phone"></i>
        DOH Call Center
        Telephone No: (632) 651-7800 local 5003-5004 
        (632) 165-364</a>
      </li>
      <li><a href="javascript:void(0)"><i class="fa fa-mobile-phone"></i> Mobile No: +63918-8888364</a></li>
      <li><a href="javascript:void(0)"><i class="fa fa-envelope"></i> Email Address: callcenter@doh.gov.ph</a></li>
      <li><a href="javascript:void(0)"><i class="fa fa-search"></i> San Lazaro Compound, Tayuman, Sta. Cruz, Manila Philippines 1003</a></li>
      </ul>
	  
      <!--footer_ul_amrc ends here-->
    </div>
  </div>
</div>
{{csrf_field()}}

<div class="container">
{{-- <ul class="foote_bottom_ul_amrc">
<li><a href="">Home</a></li>
<li><a href="">FAQs</a></li>
<li><a href="">About Us</a></li>
</ul> --}}
<!--foote_bottom_ul_amrc ends here-->
<p class="text-center" style="margin: 8px 8px">Copyright @<?php echo Date('Y'); ?> | HFSRB | DOH Online Licensing Regulatory System | Version {{env('APP_VERSION')}}</p>

{{-- <ul class="social_footer_ul">
<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
<li><a href=""><i class="fab fa-twitter"></i></a></li>
<li><a href=""><i class="fab fa-linkedin"></i></a></li>
<li><a href=""><i class="fab fa-instagram"></i></a></li>
</ul> --}}
<!--social_footer_ul ends here-->
</div>

</footer>

<script type="text/javascript">

  $(document).on('keyup','input[type=number]',function(){
    if(this.value < 0){
      $(this).val(0);
    }
    $(this).attr('min',0);
  })
  
  $(document).ready(function(){
    $(".required, .req").each(function(index, el) {
      $(el).append('<span class="text-danger" style="font-size: 20px;">*</span>');
    });

    $('input[type="number"]').on('keypress',function(e){
      evt = (e) ? e : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
      }
      return true;
    })

  })

  @if(session()->has('uData'))
    $(function(){
      getNotification();
    })
  //  let getNotifSec = setInterval(function() {
  //    getNotification()
  // }, 5000);


  function getNotification(){
    let arrInNotif = [];
    let stringToAppend = '<h3 style="text-transform: uppercase;font-size: 85%;font-weight: 700;   color: #84929f; padding: 1rem 2rem;margin:0;">Notification</h3><div id="style-15" class="scrollbar" style="height:auto;overflow:auto; max-height: 300px;width: 400px;">';
    $.ajax({
      url: '{{asset('/view/notification')}}',
      type: 'POST',
      async: false,
      data: {_token: $("input[name='_token']").val(), uid: '{{session()->get('uData')->uid}}'},
      success: function(a){

        let data = JSON.parse(a);
        $("#unread").empty().append(data['unread']);
        data['data'].forEach( function(element, index) {
          stringToAppend += '<a style="border-top: 1px solid rgba(0, 0, 0, 0.1);font-size: 75%;padding: 1.125rem 4rem 0.75rem 2rem;white-space:normal;" href="'+element['adjustedlink']+'" class="dropdown-item">'+element['msg_desc'] +' | '+ element['adjustedmonth']+'</a>';
        });
      }
    })
    stringToAppend += '</div>';
    $("#notifBody").empty().prepend(stringToAppend);
    // clearInterval(getNotifSec);
  }
  $("#notifArea").click(function(event) {
    $.ajax({
      url: '{{asset('/update/notification')}}',
      type: 'POST',
      data: {_token: $("input[name='_token']").val(), uid: '{{session()->get('uData')->uid}}'},
    });  
  });

  function onStep(step){
    let classes = Array('s1','s2','s3','s4','s5'); 
    if($("#s"+step).length > 0 && classes.indexOf("s"+step) > -1){
      while (step > 0) {
        classes.splice(classes.indexOf("s"+step),1);
        step -=1;
      }
      jQuery.each(classes,function(index, el) {
        $("#"+el).addClass('selected');
      });
    }

  }

  function slider(prev = [], next = []){
    let nextSlider = $("#nextDiv").find('a');
    let prevSlider = $("#prevDiv").find('a');
    if(next.length <= 0 || prev.length <= 0){
      if(next.length <= 0){
        nextSlider.removeClass('activeSlider').addClass('inactiveSlider').prop('readonly',true).css('cursor','not-allowed');
      } 
      if(prev.length <= 0) {
        prevSlider.removeClass('activeSlider').addClass('inactiveSlider').prop('readonly',true).css('cursor','not-allowed');
      }
    }

    if(next.length > 0 || prev.length > 0){
      if(next.length){
        nextSlider.attr('href','{{url('client1/apply/')}}'+'/'+next[0]+'/'+next[1]+'/'+next[2]+'/'+( typeof(next[3]) != 'undefined' ? next[3] : '' )).addClass('activeSlider');
        if( typeof(next[4]) != 'undefined'  ) {
          nextSlider.text(next[4]+' »');
        }
      }
      if(prev.length){
        prevSlider.attr('href','{{url('client1/apply/')}}'+'/'+prev[0]+'/'+prev[1]+'/'+prev[2]+'/'+( typeof(prev[3]) != 'undefined' ? prev[3] : '' )).addClass('activeSlider');
      }
    }



  }

  @endif

  // var __ftAll = 0;
  // setInterval(function() {
  //   var w_h = window.innerHeight;
  //   var dif_h = document.getElementsByTagName('nav')[0].offsetHeight + document.getElementsByClassName('container')[0].offsetHeight + document.getElementsByTagName('nav')[1].offsetHeight + document.getElementById('_footBottom').offsetHeight;
  //    // + document.getElementById('_footBottom').offsetHeight
  //   var __ftCur = ((w_h > dif_h) ? ((w_h - dif_h)-2) : 0);
  //   if(__ftAll == __ftCur && __ftCur > 0) {
  //   } else {
  //     __ftAll = __ftCur;
  //     document.getElementById('_footBottom').style.marginTop = __ftAll + 'px';
  //   }
  // }, -1);

  // 1st param = less than
  function validateDateLessGreat(fromDateDom, toDateDom){
    var d1 = new Date(fromDateDom.val());
    var d2 = new Date(toDateDom.val());
    if(d2 <= d1){
      alert('Invalid Date. Please input proper date');
      toDateDom.val('');
    }
  }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>