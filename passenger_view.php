<?php 
include 'log_check.php' ;
include 'template/header.php' ;
require_once './libs/Passenger.php';
$passenger = new Passenger();
if(empty($_GET['id'])){
    header("Location:home.php");
}
$id = $_GET['id'];
$passengerData = $passenger->getPassengerDataById($id)[0];
$name = $passengerData['name'];
$mobile = $passengerData['mobile'];
$device_id = $passengerData['device_id'];
$fcm_id = $passengerData['fcm_id'];
$avatar = $passengerData['avatar'];
?>
<body class="sticky-header" onload="initMap()">
  <section>
    <?php include 'template/sidebar.php' ?>
    <!-- main content start-->
    <div class="main-content">			
      <div id="page-wrapper">
        <h3 class="page-header">
          Passenger Info
      </h3>
      <div class="">
 
    <div class="row profile">
        <div class="col-md-3 clear-padding-leftclear">
            <div class="profile-card">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?=$avatar;?>" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <??>
                    </div>
                    <div class="profile-usertitle-job">
                        <?=$name;?>
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
               <!--  <div class="profile-userbuttons">
                   <button type="button" class="btn btn-success btn-sm">Follow</button>
                   <button type="button" class="btn btn-danger btn-sm">Message</button>
               </div> -->
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active">
                            <a href="#">
                            <i class="fa fa-mobile"></i>
                            Mobile :  <?=$mobile?></a>
                        </li>
                         <li> <br></li>
                          <li> <br></li>
                           <li> </li>
                        <li>
                             <a href="actions/delete_passenger.php?id=<?= $id; ?>" onclick="javascript:if (!confirm('Are you sure to continue ?')) {
                                          return false;
                                      }">
                                                <button type="button" class="btn btn-danger btn-sm form-control">Delete </button>
                                            </a>
                        </li>
                      
                    </ul>
                </div>
              
            </div>
        </div>
        <div class="col-md-9 clear-padding-right">
            <div class="profile-content">
                <form class="" method="post" action="actions/send_push_message.php" style="padding-right: 30px;">
                   <h4>Message</h4>
                   <hr>
                   <label>Title</label>
                   <input type="hidden" name="id" value="<?=$id;?>">
                   <input type="hidden" name="type" value="passenger">
                   <input type="text" class="form-control" name="title" placeholder="Message title">
                   <br>
                    <label>Message Body</label>
                   <textarea class="form-control" name="message" placeholder="Message Body"> </textarea>
                   <br>
                   <button class="btn btn-primary" type="submit" style="width: 150px;">
                       <i  class="fa fa-send"></i> Send
                   </button>
               </form>
            </div>
        </div>
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