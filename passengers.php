<?php 
include 'log_check.php' ;
include 'template/header.php' ;
require_once './libs/Drivers.php';
require_once './libs/Passenger.php';
$passenger = new Passenger();
$driver = new Drivers();
$passengerData = $passenger->getAllPassengers();
$driverData = $driver->getdriver();
$passenger_count = sizeof($passengerData);
$driver_count = sizeof($driverData);

?>
<body class="sticky-header" onload="initMap()">
  <section>
    <?php include 'template/sidebar.php' ?>
    <!-- main content start-->
    <div class="main-content">          
      <div id="page-wrapper">
        <h3 class="page-header">
          Passenger's
      </h3>
      <div class="">
          <div class="row">
            <?php
            foreach ($passengerData as $passenger) {
                $name = $passenger['name'];
                $id = $passenger['id'];
                $avatar = $passenger['avatar'];   
                ?>
                <div class="col-sm-3">
                   <div class="profile-card">
                      <!-- SIDEBAR USERPIC -->
                      <div class="profile-userpic">
                        <img src="assets/images/bg.jpg" class="img-responsive" alt="">
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                        <?=$name;?>
                      </div>
                      <div class="profile-usertitle-job">
                          Developer
                      </div>
                  </div>
                  <div class="profile-userbuttons">
                   <a href="passenger_view.php?id=<?=$id;?>"> 
                   <button type="button" class="btn btn-success btn-sm" style="width: 50%"> View </button>
                </div>
            </div>
        </div>
        <?php 
    }
    ?>

</div>

</div>
</div>

</div>
<!--body wrapper start-->
</div>
<!--body wrapper end-->
</div>
<!--footer section start-->
<footer>
  <p>Made with <i class="fa fa-heart" style="color:lightcoral"></i> CatchMyRide</p>
</footer>
<!--footer section end-->

<!-- main content end-->
</section>

</body>
</html>