<?php
include 'log_check.php';
include 'template/header.php';
require_once './libs/Drivers.php';
$drivers = new Drivers();
if (empty($_GET['id'])) {
    header("Location:home.php");
}
$id = $_GET['id'];
$data = $drivers->getdriver($id)[0];
$name = $data['name'];
$mobile = $data['mobile'];

$device_id = $data['device_id'];
$fcm_id = $data['fcm_id'];
$avatar = $data['avatar'];
$status = $data['status'];
$rc_book = $data['rc_book'];
$licence = $data['licence'];
$vehicle_image = $data['vehicle_image'];
$vehicle_type = $data['vehicle_type'];
$vehicle_name = $data['vehicle_name'];
$vehicle_no = $data['vehicle_no'];

$location = $drivers->getLocation($id);
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
                                    <img src="<?= $avatar; ?>" class="img-responsive" alt="">
                                </div>
                                <!-- END SIDEBAR USERPIC -->
                                <!-- SIDEBAR USER TITLE -->
                                <div class="profile-usertitle">

                                    <div class="profile-usertitle-job">
                                        <h4><strong> <?= $name; ?></strong>
                                        <br><br>
                                        <?php if ($status == 1): ?>
                                                <label
                                                    style="font-size:12px; padding:10px;background: #5a88ff;padding:5px 8px; color:#f5f5f5;; font-weight: bold"
                                                    >Not Active</t>
<?php endif; ?>
<?php if ($status == 2): ?>
                                                <label
                                                    style="font-size:12px; padding:10px; background: #32ae7f;padding:5px 8px; color:#f5f5f5;; font-weight: bold"
                                                    >Active now</label>
<?php endif; ?>
<?php if ($status == 3): ?>
                                                <label
                                                    style="font-size:12px; padding:10px;background: #262626;padding:5px 8px; color:#e9b330;; font-weight: bold"
                                                    >Hired Now</label>
<?php endif; ?>
                                        </h4>
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
                                                Mobile :  <?= $mobile ?></a>
                                        </li>
                                        <li> <br></li>
                                        <li> <br></li>
                                        <li> </li>
<?php if ($status == 0): ?>
                                            <li>
                                                <a href="actions/accept_driver.php?id=<?= $id; ?>">
                                                    <button type="button" class="btn btn-success btn-sm form-control">Accept Driver </button>
                                                </a>
                                            </li>
<?php else: ?>
                                            <li>
                                                <a href="actions/reject_driver.php?id=<?= $id; ?>">
                                                    <button type="button" style="background: #e9b330" class="btn btn-default btn-sm form-control">Reject Driver </button>
                                                </a>
                                            </li>

<?php endif; ?>
                                        <li>
                                            <a href="actions/delete_driver.php?id=<?= $id; ?>" onclick="javascript:if (!confirm('Are you sure to continue ?')) {
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
                                <h4>About Vehicle</h4>
                                <hr>

                                <table class="table table-responsive">
                                    <tr>
                                        <td width='150'>Vehicle type</td>
                                        <td width='10'>:</td>
                                        <td><strong><?= $vehicle_type ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td width='150'>Vehicle Name</td>
                                        <td width='10'>:</td>
                                        <td><strong><?= $vehicle_name ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td width='150'>Vehicle Number</td>
                                        <td width='10'>:</td>
                                        <td><strong><?= $vehicle_no ?></strong></td>
                                    </tr>
                                </table>
                                <div>
                                    <h4>Licence</h4>
                                    <hr>
                                    <img src="<?= $licence ?>" height="300px" style="object-fit: cover;">
                                </div>
                                <br />
                                <div>
                                    <h4>RC Book</h4>
                                    <hr>
                                    <img src="<?= $rc_book ?>" height="300px" style="object-fit: cover;">
                                </div>
                                <br />
                                <div>
                                    <h4>Vehicle Image</h4>
                                    <hr>
                                    <img src="<?= $vehicle_image ?>" height="300px" style="object-fit: cover;">
                                </div>
                                <?php if (!empty($location)) {
                                    $latitude  = $location[0]['latitude'];
                                    $longitude = $location[0]['longitude'];
                                    ?>
                                    <div>
                                        <script>
                                            function initMap() {
                                                var uluru = {lat: <?=$latitude?>, lng: <?=$longitude?>};
                                                var map = new google.maps.Map(document.getElementById('map'), {
                                                    zoom: 14,
                                                    center: uluru
                                                });
                                                var marker = new google.maps.Marker({
                                                    position: uluru,
                                                    map: map
                                                });
                                            }
                                        </script>
                                        <h4>Location</h4>
                                        <hr />
                                        <div id="map" style="width:500px; height:500px;"></div>
                                    </div>
                                <?php } ?>
                                <hr>

                <form class="" method="post" action="actions/send_push_message.php" style="padding-right: 30px;">
                   <h4>Message</h4>
                   <hr>
                   <label>Title</label>
                   <input type="hidden" name="id" value="<?=$id;?>">
                   <input type="hidden" name="type" value="driver">
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

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDds0VWsapZWd-gXcHRHlHkS7sey3n76Uk&callback=initMap">
</script>
</body>
</html>
