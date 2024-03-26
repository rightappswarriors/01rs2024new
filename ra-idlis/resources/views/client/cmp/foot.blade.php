<br><div id="_footBottom" class="footer-bottom">
  @include('client.cmp.sitemap')
  <div class="hideDiv">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="copyright">
            © 2018 All rights reserved
          </div>
        </div>
        <div class="col">
          <div class="design">
             <a href="#">Department of Health </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  var __ftAll = 0;
  setInterval(function() {
    var w_h = window.innerHeight;
    var dif_h = document.getElementsByTagName('nav')[0].offsetHeight + document.getElementsByClassName('container')[0].offsetHeight + (document.getElementById('_footBottom').offsetHeight);
     // + document.getElementById('_footBottom').offsetHeight
    var __ftCur = ((w_h > dif_h) ? ((w_h - dif_h)-2) : 0);
    if(__ftAll == __ftCur && __ftCur > 0) {
    } else {
      __ftAll = __ftCur;
      document.getElementById('_footBottom').style.marginTop = __ftAll + 'px';
    }
  }, -1);
</script>