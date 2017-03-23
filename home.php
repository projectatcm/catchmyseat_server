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
<body class="sticky-header"  onload="initMap()">
    <section>
      <?php include 'template/sidebar.php' ?>

        <!-- main content start-->
        <div class="main-content">			
            <div id="page-wrapper">
                   <div class="graphs">
                    <div class="col_1">
                        <div class="col-md-3 widget widget1">
                            <div class="r3_counter_box">
                                <i class="fa fa-mail-forward"></i>
                                <div class="stats">
                                    <h5><?= $passenger_count?></h5>
                                    <div class="grow">
                                        <p>Passengers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 widget widget1">
                            <div class="r3_counter_box">
                                <i class="fa fa-users"></i>
                                <div class="stats">
                                    <h5><?= $driver_count;?></h5>
                                    <div class="grow grow1">
                                        <p>Drivers</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 widget widget1">
                            <div class="r3_counter_box">
                                <i class="fa fa-eye"></i>
                                <div class="stats">
                                    <h5>70 </h5>
                                    <div class="grow grow3">
                                        <p>Request</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 widget">
                            <div class="r3_counter_box">
                                <i class="fa fa-usd"></i>
                                <div class="stats">
                                    <h5>50</h5>
                                    <div class="grow grow2">
                                        <p>Rejected</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="row">
                        
                    <div class="col-md-8">
                        <div class="activity_box">
                            <h3>New Registrations</h3>
                            <div class="scrollbar scrollbar1" id="style-2">
                            <?php 

for($i=0;$i<5;$i++){
    
                            ?>
                                <div class="activity-row">
                                    <div class="col-xs-2 activity-img"><img src='<?=$passengerData[$i]['avatar']?>' class="img-responsive" alt=""/></div>
                                    <div class="col-xs-8 activity-desc">
                                        <h5><a href="#"><?=$passengerData[$i]['name']?></a></h5>
                                        <p><?=$passengerData[$i]['mobile']?></p>
                                    </div>
                                    <div class="clearfix"> </div>
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                            <div class="switch-right-grid">
                                <div class="switch-right-grid1">
                                    <h3>TODAYS STATS</h3>
                                    <p>Duis aute irure dolor in reprehenderit.</p>
                                    <ul>
                                        <li>Earning: $400 USD</li>
                                        <li>Items Sold: 20 Items</li>
                                        <li>Last Hour Sales: $34 USD</li>
                                         <li>Last Hour Sales: $34 USD</li>
                                          <li>Last Hour Sales: $34 USD</li>
                                           <li>Last Hour Sales: $34 USD</li>
                                    </ul>
                                    
                                </div>
                            </div>
                      
                        <div class="clearfix"></div>
                
                    </div>
                    <div class="clearfix"> </div>
                </div>  
                </div>
             

                <!-- switches -->
                <div class="switches">
                    
                </div>
                <!-- //switches -->
            
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