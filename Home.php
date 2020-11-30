<?php
  include 'PHP/database.php';
  date_default_timezone_set("Asia/Colombo");
  //$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>FindMyBus</title>

<style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
        margin-left:auto;
        margin-right:auto;
        margin-top:40px;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>


<!-- Bootstrap -->
<link rel="stylesheet" type="text/css"  href="css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="fonts/font-awesome/css/font-awesome.css">

<!-- Stylesheet
    ================================================== -->
<link rel="stylesheet" type="text/css"  href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/prettyPhoto.css">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800,600,300' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/modernizr.custom.js"></script>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
<div id="preloader">
  <div id="status"> <img src="img/preloader.gif" height="64" width="64" alt=""> </div>
</div>
<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse"> <i class="fa fa-bars"></i> </button>
      <a class="navbar-brand page-scroll" href="#page-top"> <i class="fa fa-bus"></i>FindMyBus</a> </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
      <ul class="nav navbar-nav">
        <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
        <li class="hidden"> <a href="#page-top"></a> </li>
        <li> <a class="page-scroll" href="#about">About</a> </li>
        <li> <a class="page-scroll" href="#services">Services</a> </li>

        <li> <a class="page-scroll" href="#contact">Contact</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container -->
</nav>

<!-- Header -->
<div id="intro">
  <div class="intro-body">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <h1>FindMy<span class="brand-heading">Bus</span></h1>
          <p class="intro-text" style="font-size:30px; letter-spacing: 14px;">NO MORE WAITING</p>
          <a href="#services" class="btn btn-default page-scroll">Find Now</a> </div>
      </div>
    </div>
  </div>
</div>

<!-- Services Section -->
<div id="services" class="text-center">
    
  <div class="container busForm">
        
      <form action="PHP/getdata.include.php" method="POST">
               <fieldset>
          <div class="formEle route">

              <select name="rootno" class="select-style" id="routeSelect" onchange="java_script_:show(this.options[this.selectedIndex].value)">
                <option value="none" selected>Choose Your Route</option>
                <option value="99" >99</option>
                  <option value="98">98</option>
                  <option value="64">64</option>
              </select>
          </div>
          <div class="formEle" id="colombo" style="display:none">
                  Your position
                  <select class="select-style2" name="userlocation" required>
                      <option value="Colombo" selected>Colombo</option>
                      <option value="Avissawella">Avissawella</option>
                      <option value="Rathnapura">Rathnapura</option>
                      <option value="Pelmadulla">Pelmadulla</option>
                      <option value="Balangoda">Balangoda</option>
                      <option value="Pambahinna" selected>Pambahinna</option>
                      <option value="Beragala">Beragla</option>
                      <option value="Bandarawela">Bandarawela</option>
                      <option value="Badulla">Badulla</option>
                  </select>
          </div>
          <div class="formEle" id="panadura" style="display:none">
            Your position
            <select class="select-style2">
                <option value="Panadura">Panadura</option>
                <option value="Horana">Horana</option>
                <option value="Rathnapura">Rathnapura</option>
                <option value="Pelmadulla">Pelmadulla</option>
                <option value="Balangoda">Balangoda</option>
                <option value="Pambahinna" selected>Pambahinna</option>
                <option value="Beragala">Beragla</option>
                <option value="Bandarawela">Bandarawela</option>
                <option value="Badulla">Badulla</option>
            </select>
    </div>

          <div class="formEle" id="directionCol" style="display:none">
              Direction :

              <select class="select-style2" name="direction">
                  <option value="Colombo">Toward Colombo</option>
                  <option value="Badulla">Toward Badulla</option>
              </select>


          </div>
          <div class="formEle" id="directionPan" style="display:none">
            Direction :
            <select class="select-style2">
                <option value="Panadura">Toward Panadura</option>
                  <option value="Badulla">Toward Badulla</option>
              </select>


        </div>
          <div id="submitButton" style="display:none">
           <button class="btn btn-success" type="submit">Submit</button>

            <button type="reset" class="btn btn-primary" onclick="hideall()">Reset</button>
          </div>
          </fieldset>


  </form>

  
  </div></div>
  <div class="bustime">
  <?php
              if(isset($_GET["busid1"])){
                $busid1=$_GET["busid1"];
                $town=$_GET["town"];
                $sql="SELECT chtime FROM $town WHERE busid='$busid1'";
                $result=$conn->query($sql);
                $raw=$result->fetch_assoc();
                $chtime=$raw['chtime'];
                $Time = strtotime("+50 minutes", strtotime($chtime));
                echo "<h3>". $busid1 . " checked ".$town." at " . $chtime . " and it will reach pambahinna approximately by ".date('h:i:s', $Time)."</h3>";
                
              }

              if(isset($_GET["busid2"])){
                $busid2=$_GET["busid2"];
                $town=$_GET["town"];

                $sql="SELECT chtime FROM $town WHERE busid='$busid2'";
                $result=$conn->query($sql);
                $raw=$result->fetch_assoc();
                $chtime=$raw['chtime'];
                $Time = strtotime("+50 minutes", strtotime($chtime));
                echo "<h3>". $busid2 . " checked ".$town." at " . $chtime . " and it will reach pambahinna approximately by ".date('h:i:s', $Time)."</h3>";
              }
              if(isset($_GET["busid3"])){
                $busid3=$_GET["busid3"];
                $town=$_GET["town"];

                $sql="SELECT chtime FROM $town WHERE busid='$busid3'";
                $result=$conn->query($sql);
                $raw=$result->fetch_assoc();
                $chtime=$raw['chtime'];
                $Time = strtotime("+50 minutes", strtotime($chtime));
                echo "<h3>". $busid3 . " checked ".$town." at " . $chtime . " and it will reach pambahinna approximately by ".date('h:i:s', $Time)."</h3>";
              }
              if(isset($_GET["busid4"])){
                $busid4=$_GET["busid4"];
                $town=$_GET["town"];

                $sql="SELECT chtime FROM $town WHERE busid='$busid4'";
                $result=$conn->query($sql);
                $raw=$result->fetch_assoc();
                $chtime=$raw['chtime'];
                $Time = strtotime("+50 minutes", strtotime($chtime));
                echo "<h3>". $busid4 . " checked ".$town." at " . $chtime . " and it will reach pambahinna approximately by ".date('h:i:s', $Time)."</h3>";
              }
              if(isset($_GET["busid5"])){
                $busid5=$_GET["busid5"];
                $town=$_GET["town"];

                $sql="SELECT chtime FROM $town WHERE busid='$busid5'";
                $result=$conn->query($sql);
                $raw=$result->fetch_assoc();
                $chtime=$raw['chtime'];
                $Time = strtotime("+50 minutes", strtotime($chtime));
                echo "<h3>". $busid5 . " checked ".$town." at " . $chtime . " and it will reach pambahinna approximately by ".date('h:i:s', $Time)."</h3>";
              }
              
            ?>
            

</div>

    
    <div id="map"></div>

    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 15
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('You Are Here');
            infoWindow.open(map);
            map.setCenter(pos);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWGj4I6Yx3M7Nk3u8AifNG6dtwwu-tlCQ&callback=initMap">
    </script>

<div id="map">
  <div class="container">

      <div id="map"></div>

        </div>


    </div>
  </div>
</div>
<!-- About Section -->
<div id="about">
  <div class="container">
    <div class="section-title text-center center">
      <h2>FIND MY BUS</h2>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-4"><img src="img/bus.png" class="img-responsive"></div>
      <div class="col-md-8">
        <div class="about-text">
          <h4>WELCOME</h4>
          <p>The tiresome waiting fora bus bus stop is over now! No more guessings
              about the whereabouts of the bus anymore. Find My Bus will tell you exactly where the bus is,
              and time it will be at Pambahinna!</p>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- Contact Section -->
<div id="contact" class="text-center">
  <div class="container">
    <div class="section-title center">
      <h2>Contact us</h2>
      <hr>
      <p>If you have any suggestions and critcisms please be kind to send your thoughts. Thank you!</p>
    </div>
    <div class="col-md-8 col-md-offset-2">
      <div class="col-md-4">
        <div class="contact-item"> <i class="fa fa-map-marker fa-2x"></i>
          <p>Sabaragamuwa University of Sri Lanka, P.B. 02, Belihuloya</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="contact-item"> <i class="fa fa-envelope-o fa-2x"></i>
          <p>sab@ac.lk</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="contact-item"> <i class="fa fa-phone fa-2x"></i>
          <p> +1 123 456 1234<br>
            +1 321 456 1234</p>
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
    <div class="col-md-8 col-md-offset-2">
      <h3>Leave us a message</h3>
      <form name="sentMessage" id="contactForm" novalidate>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="name" class="form-control" placeholder="Name" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="email" class="form-control" placeholder="Email" required="required">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" rows="4" placeholder="Message" required></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <div id="success"></div>
        <button type="submit" class="btn btn-default">Send Message</button>
      </form>
      <div class="social">
        <h3>Follow us</h3>
        <ul>
          <li><a href="#"><i class="fa fa-facebook"></i></a></li>
          <li><a href="#"><i class="fa fa-twitter"></i></a></li>
          <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
          <li><a href="#"><i class="fa fa-github"></i></a></li>
          <li><a href="#"><i class="fa fa-instagram"></i></a></li>
          <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div id="footer">
  <div class="container">
    <p>Copyright &copy; FindMyBus</p>
  </div>
</div>
<script type="text/javascript">


  var map,
      currentPositionMarker,
      mapCenter = new google.maps.LatLng(6.719782, 80.786021),
      map;

  function initializeMap()
  {
      map = new google.maps.Map(document.getElementById('map_canvas'), {
      zoom: 15,
      center: mapCenter,
      mapTypeId: google.maps.MapTypeId.ROADMAP
      });
  }

  function locError(error) {
      // the current position could not be located
      alert("The current position could not be found!");
  }

  function setCurrentPosition(pos) {
      currentPositionMarker = new google.maps.Marker({
          map: map,
          position: new google.maps.LatLng(
              pos.coords.latitude,
              pos.coords.longitude
          ),
          title: "Current Position"
      });
      map.panTo(new google.maps.LatLng(
              pos.coords.latitude,
              pos.coords.longitude
          ));
  }

  function displayAndWatch(position) {
      // set current position
      setCurrentPosition(position);
      // watch position
      watchCurrentPosition();
  }

  function watchCurrentPosition() {
      var positionTimer = navigator.geolocation.watchPosition(
          function (position) {
              setMarkerPosition(
                  currentPositionMarker,
                  position
              );
          });
  }

  function setMarkerPosition(marker, position) {
      marker.setPosition(
          new google.maps.LatLng(
              position.coords.latitude,
              position.coords.longitude)
      );
  }

  function initLocationProcedure() {
      initializeMap();
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(displayAndWatch, locError);
      } else {
          alert("Your browser does not support the Geolocation API");
      }
  }

  $(document).ready(function() {
      initLocationProcedure();
  });
  </script>

  <script>
  function startTime() {
      var today = new Date();
      var h = today.getHours();
      var m = today.getMinutes();
      var s = today.getSeconds();
      m = checkTime(m);
      s = checkTime(s);
      document.getElementById('txt').innerHTML =
      h + ":" + m + ":" + s;
      var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
      if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
      return i;
  }
  </script>
  <script>
      function show(aval) {
         if (aval == "99") {
         colombo.style.display='block';
         panadura.style.display='none';
         directionCol.style.display='block';
         directionPan.style.display='none';
         submitButton.style.display='block';
         Form.fileURL.focus();
         }
         else if(aval == "98"){
          panadura.style.display='block';
          colombo.style.display='none';
          directionPan.style.display='block';
          directionCol.style.display='none';
          submitButton.style.display='block';
          Form.fileURL.focus();

         }
         else{
         colombo.style.display='none';
         panadura.style.display='none';
         directionCol.style.display='none';
         directionPan.style.display='none';
         submitButton.style.display='none';
         }
       }


       function hideall() {
        colombo.style.display='none';
         panadura.style.display='none';
         directionCol.style.display='none';
         directionPan.style.display='none';
         submitButton.style.display='none';
       }
      </script>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script type="text/javascript" src="js/jquery.1.11.1.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/SmoothScroll.js"></script>
<script type="text/javascript" src="js/jquery.prettyPhoto.js"></script>
<script type="text/javascript" src="js/jquery.isotope.js"></script>
<script type="text/javascript" src="js/jquery.parallax.js"></script>
<script type="text/javascript" src="js/jqBootstrapValidation.js"></script>
<script type="text/javascript" src="js/contact_me.js"></script>

<!-- Javascripts
    ================================================== -->
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
