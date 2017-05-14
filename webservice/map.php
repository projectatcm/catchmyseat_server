<?php

function distance($lat1, $lon1, $lat2, $lon2, $unit) {
    /*
      This uses the ‘haversine’ formula to calculate the great-circle distance between two points – that is, the shortest distance over the earth’s surface – giving an ‘as-the-crow-flies’ distance between the points (ignoring any hills they fly over, of course!).
      Haversine formula:
      a = sin²(Δφ/2) + cos φ1 ⋅ cos φ2 ⋅ sin²(Δλ/2)
      c = 2 ⋅ atan2( √a, √(1−a) )
      d = R ⋅ c
      where 	φ is latitude, λ is longitude, R is earth’s radius (mean radius = 6,371km);
      note that angles need to be in radians to pass to trig functions!
     */
    $theta = $lon1 - $lon2;
    @$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

require_once '../libs/Drivers.php';
$driver = new Drivers();
$latitude = $_GET['lat'];
$longitde = $_GET['lng'];

$geo_data = $driver->getData("SELECT * FROM geo");
$data = array();
//        echo "($latitude,$longitde)";
foreach ($geo_data as $geo) {
    $driver_id = $geo['driver_id'];
    $driver_lat = $geo['latitude'];
    $driver_lng = $geo['longitude'];
    $driver_data = $driver->getDriverDataById($driver_id);
    if (empty($driver_data)) {
        continue;
    }
    // $driver_data[0]['photo'] = base64Image($driver_data[0]['photo']);
    $geo['distance'] = distance($latitude, $longitde, $driver_lat, $driver_lng, 'K');
    $geo['data'] = $driver_data[0];
    $data[] = $geo;
}
/*-----colors-----*/
$colors = array(
    "car" => array(
        "color" => "#6991FD",
        "icon" => "http://maps.google.com/mapfiles/ms/icons/blue-dot.png" 
    ),
    "auto" => array(
        "color" => "#FDF569",
        "icon" => "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png" 
    ),
    "me" => array(
        "color" => "#FB7064",
        "icon" => ""
    )
);
if (!empty($data)) {
    $response['data'] = $data;
    $response['status'] = "success";
    $response['message'] = "We found " . sizeof($data) . " drivers in your area";
} else {
    $response['message'] = "Sorry No drivers found !... we will update more";
}
?>
<html>
    <head>
        <script async defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDds0VWsapZWd-gXcHRHlHkS7sey3n76Uk&callback=initMap">
        </script>
        <script>
            function initMap() {
                var uluru = {lat: <?= $latitude ?>, lng: <?= $longitde ?>};
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 18,
                    center: uluru
                });
                var goldStar = {
          path: 'M 125,5 155,90 245,90 175,145 200,230 125,180 50,230 75,145 5,90 95,90 z',
          fillColor: 'yellow',
          fillOpacity: 0.8,
          scale: 1,
          strokeColor: 'gold',
          strokeWeight: 14
        };
                var marker = new google.maps.Marker({
                    position: uluru,
                    map: map
                });
                <?php foreach ($data as $d){
                    $distance = $d['distance'];
                    if($distance > 2){
                        continue;
                    }
                    ?>
                            
                    var marker = new google.maps.Marker({
                    position: {lat: <?= $d['latitude'] ?>, lng: <?= $d['longitude'] ?>},
                   title:"<?=$d['data']['name']?>",
                    <?php if($d['data']['vehicle_type'] == "Car"){?>
                    icon: '<?=$colors['car']['icon']?>',
                    <?php }else if($d['data']['vehicle_type'] == "Auto Rickshaw"){?>
                       icon: '<?=$colors['auto']['icon']?>',   
                    <?php }?>
                    map: map
                });
                            <?php
                }?>
            }
        </script>
    </head>
    <body class="sticky-header" onload="initMap()">
        <div id="map" style="width:100%; height:100%;"></div>
        <div class="map_info">
            <ul>
                <li class="car"><i style="background: <?=$colors['car']['color']?>;"></i> Car</li>
                <li class="auto"><i style="background: <?=$colors['auto']['color']?>"></i> Auto Riksaw</li>
                <li class="auto"><i style="background: <?=$colors['me']['color']?>"></i> You</li>
            </ul>
        </div>
        <style type="text/css">
            .map_info{
                width: 100%;
                background: rgba(255,255,255,0.9);
                position: fixed;
                bottom:0;
                padding: 8px 20px;
                left:0;right:0;
            }
            .map_info ul{
                margin: 0;
                padding:0;
                list-style: none;
            }
            .map_info ul li{
                font-size: 12px;
                float: left;
                                margin: 0 5px;

            }
            .map_info ul li i{
                width:12px;
                height:12px;
                margin-right: 5px;
                border-radius: 50%;
                display: inline-block;
            }
        </style>

    </body>
</html>