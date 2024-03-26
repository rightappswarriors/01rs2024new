   <style type="text/css">
      .pageloader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('{{asset("ra-idlis/public/img/pageloader.gif")}}') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;}
        #ERROR_MSG, #ERROR_MSG2{
            position: fixed;
            top: 78px; 
            right:3%;
            width: 36%;
            z-index: 9998;
        }
        #return-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: rgb(0, 0, 0);
            background: rgba(0, 0, 0, 0.7);
            width: 50px;
            height: 50px;
            display: block;
            text-decoration: none;
            -webkit-border-radius: 35px;
            -moz-border-radius: 35px;
            border-radius: 35px;
            display: none;
            -webkit-transition: all 0.3s linear;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        #return-to-top i {
            color: #fff;
            margin: 0;
            position: relative;
            left: 16px;
            top: 13px;
            font-size: 19px;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }
        #return-to-top:hover {
            background: rgba(0, 0, 0, 0.9);
        }
        #return-to-top:hover i {
            color: #fff;
            top: 5px;
        }
        div .short{
        font-weight:bold;
        color:#FF0000;
        font-size:larger;
        }
        div .weak{
            font-weight:bold;
            color:orange;
            font-size:larger;
        }
        div .good{
            font-weight:bold;
            color:#2D98F3;
            font-size:larger;
        }
        div .strong{
            font-weight:bold;
            color: limegreen;
            font-size:larger;
        }
        /*.footer-bottom {
            background: linear-gradient(to bottom left,#228B22, #84bd82);
            min-height: 30px;
            width: 100%;
        }*/
        /* Extra Things */
        body{background: #eee ;font-family: 'Open Sans', sans-serif;}h3{font-size: 30px; font-weight: 400;text-align: center;margin-top: 50px;}h3 i{color: #444;}

        /*
            RequestAssistance - Lloyd
        */
        .ra input, textarea{
            border: 0;
            padding: 5px;
            font-size: 20px;
            border-bottom: groove;
        }

        .ra-header .ra-header-logo img {
            height: 140px;
            width: 140px;
        }

        .ra-header .ra-header-title {
            font-family: Times New Roman;
            font-size: 30px;           
            text-align: center;
        }

        .ra-title {           
            font-family: arial;
            font-size: 25px;
            margin-top: 50px;
            text-align: center;
        }

        .ra-referenceno {           
            font-family: calibri;
            font-size: 17px;
            margin-top: 20px;
            text-align: right;
        }

        .ra-form {
            font-family: arial;
            font-size: 17px;
        }

        .ra-cb {
            margin: 0 0 0 200px;
        }

        .ra-roa {
            margin: 150px 0 0 0;
        }
        /*
            ra-atmedia - Lloyd
        */
        /*
            Assessment Tool - Lloyd
        */
        .at-tr-head {
            background-color: rgb(148,138,84);
        }

        .at-tr-head2 {
            background-color: rgb(214,227,188);
        }

        .at-tr-subhead {
            background-color: rgb(196,188,150);
        }        

        .at-td-mid {
            vertical-align: middle !important;
        }

        .at-td-blk {
            background-color: black;
        }

        .at-col-bal {
            width: 260px;
        }

        .at-col-bal-lg {
            width: 350px;
        }

        .at-col-bal-xlg {
            width: 450px;
        }

        .radcont {
            display: block;
            position: relative;
            padding-left: 35px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 22px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        /* Hide the browser's default radio button */
        .radcont input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        /* Create a custom radio button */
        .radchkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 25px;
            width: 25px;
            background-color: #eee;
            border-radius: 50%;
        }

        /* On mouse-over, add a grey background color */
        .radcont:hover input ~ .radchkmark {
            background-color: #ccc;
        }

        /* When the radio button is checked, add a blue background */
        .radcont input:checked ~ .radchkmark {
            background-color: #2196F3;
        }

        /* Create the indicator (the dot/circle - hidden when not checked) */
        .radchkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        /* Show the indicator (dot/circle) when checked */
        .radcont input:checked ~ .radchkmark:after {
            display: block;
        }

        /* Style the indicator (dot/circle) */
        .radcont .radchkmark:after {
            top: 9px;
            left: 9px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: white;
        }

        /* Customize the label (the container) */
        .chkcont {
          display: block;
          position: relative;
          padding-left: 35px;
          margin-bottom: 12px;
          cursor: pointer;
          font-size: 22px;
          -webkit-user-select: none;
          -moz-user-select: none;
          -ms-user-select: none;
          user-select: none;
        }

        /* Hide the browser's default checkbox */
        .chkcont input {
          position: absolute;
          opacity: 0;
          cursor: pointer;
          height: 0;
          width: 0;
        }

        /* Create a custom checkbox */
        .chk {
          position: absolute;
          top: 0;
          left: 0;
          height: 25px;
          width: 25px;
          background-color: #eee;
        }

        /* On mouse-over, add a grey background color */
        .chkcont:hover input ~ .chk {
          background-color: #ccc;
        }

        /* When the checkbox is checked, add a blue background */
        .chkcont input:checked ~ .chk {
          background-color: #2196F3;
        }

        /* Create the checkmark/indicator (hidden when not checked) */
        .chk:after {
          content: "";
          position: absolute;
          display: none;
        }

        /* Show the checkmark when checked */
        .chkcont input:checked ~ .chk:after {
          display: block;
        }

        /* Style the checkmark/indicator */
        .chkcont .chk:after {
          left: 9px;
          top: 5px;
          width: 5px;
          height: 10px;
          border: solid white;
          border-width: 0 3px 3px 0;
          -webkit-transform: rotate(45deg);
          -ms-transform: rotate(45deg);
          transform: rotate(45deg);
        }


        /* LOADER */
        .loader,
        .loader:before,
        .loader:after {
          border-radius: 50%;
          width: 2.5em;
          height: 2.5em;
          -webkit-animation-fill-mode: both;
          animation-fill-mode: both;
          -webkit-animation: load7 1.8s infinite ease-in-out;
          animation: load7 1.8s infinite ease-in-out;
        }
        .loader {
          color: #41d71c;
          font-size: 10px;
          margin: 80px auto;
          position: relative;
          text-indent: -9999em;
          -webkit-transform: translateZ(0);
          -ms-transform: translateZ(0);
          transform: translateZ(0);
          -webkit-animation-delay: -0.16s;
          animation-delay: -0.16s;
        }
        .loader:before,
        .loader:after {
          content: '';
          position: absolute;
          top: 0;
        }
        .loader:before {
          left: -3.5em;
          -webkit-animation-delay: -0.32s;
          animation-delay: -0.32s;
        }
        .loader:after {
          left: 3.5em;
        }
        @-webkit-keyframes load7 {
          0%,
          80%,
          100% {
            box-shadow: 0 2.5em 0 -1.3em;
          }
          40% {
            box-shadow: 0 2.5em 0 0;
          }
        }
        @keyframes load7 {
          0%,
          80%,
          100% {
            box-shadow: 0 2.5em 0 -1.3em;
          }
          40% {
            box-shadow: 0 2.5em 0 0;
          }
        }
        #LOADERSDIV {
            z-index: 999999999999;
            /*width: 100%;
            height: 100%;
            position:absolute;*/
            position:fixed;
            top: 50%;
            left: 50%;
            width:30em;
            height:18em;
            margin-top: -9em; /*set to a negative number 1/2 of your height*/
            margin-left: -15em;
            /*background-color: rgba(0,0,0,.5);*/
        }
        .parsley-errors-list {color:red;}
        @media print{
          #menu, #return-to-top, nav:first-child, div.sidebar, button{
            display: none!important;
          }
          div.content:first-child{
            display: none!important;
          }
        }
</style>