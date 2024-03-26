      function loader(bool) {
        if(bool) {
          $('body').append("<div id='pageload'></div>");
        } else {
          $('#pageload').fadeOut(1000);
        }
      }