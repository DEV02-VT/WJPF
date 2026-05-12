<?php
include_once("includes/header.php");
?>
<?php
include_once("includes/nav_base.php");
include_once("includes/functions_appointment.php");
?>
<div class="bgimg_6 parallax">
    <div class="caption" id="championships">
        <div class="row justify-content-center">
            <div class="col-11 col-md-9 col-lg-8 border text-center">
                <span class="capital">Calendar</span>
            </div>
        </div>
    </div>
</div>

<div class="text-block" >
    <div class="full_container">
        <div class="row justify-content-center" >
            <div class="col-12 mb-3" >
                <div class="event_map" id="map" ></div>
            </div>
            <?php
            echo display_future_appointments();
            ?>
        </div>

<!--        <ul class="nav nav-pills justify-content-center mt-3" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="list-tab" data-bs-toggle="tab" data-bs-target="#list" type="button" role="tab" aria-controls="list" aria-selected="true"><img class="tab_img" src="img/list.png"> List</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="map-tab" data-bs-toggle="tab" data-bs-target="#map" type="button" role="tab" aria-controls="map" aria-selected="true"><img class="tab_img" src="img/map2.png"> Map</button>
            </li>
        </ul>
        <div class="tab-content">
            <hr>
            <div class="tab-pane  active" id="list" role="tabpanel" aria-labelledby="list-tab" tabindex="0">
                <div class="row justify-content-center">
                    <?php
                    echo display_future_appointments();
                    ?>
                </div>
            </div>
            <div class="tab-pane" id="map" role="tabpanel" aria-labelledby="map-tab" tabindex="1">
                <div class="row justify-content-center" >
                    <div class="col-12" >
                        <div class="event_map" id="map" ></div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>



<?php
include_once("includes/footer.php");
echo get_appointment_coordinates(); ?>

<script src='js/maplibre/maplibre-gl.js'></script>
<script src="js/event_map.js"></script>


