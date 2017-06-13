<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\Map $module
 */

$module = $this->getModule();
$latitude = $this->getInput('latitude')->getValue();
$longitude = $this->getInput('longitude')->getValue();
$enableTitle = $this->getInput('enableTitle')->getValue();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container-fluid">
        <?= createTaskLink('EV-30') ?>
        <div class="row">
            <div class="col-lg-12" style="padding: 0px">
                <div class="text-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="text" <?php if (!$enableTitle) echo 'style="display:none"'; ?>>
                                    <p class="col-6" id="title"><?= $this->getInput('title')->getValue(); ?></p>
                                    <div class="col-6"
                                         id="description"><?= $this->getEditor('description')->getValue(); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="map"></div>
                <script>
                    function initMap() {
                        var london = {lat: <?= $latitude ?>, lng: <?= $longitude ?>};

                        var contentString =
                            '<div> <?= $this->getEditor('address')->getValue(); ?> </div>';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 12,
                            center: london,
                            disableDefaultUI: true,
                            scrollwheel: false,

                            styles: [{
                                "featureType": "all",
                                "elementType": "all",
                                "stylers": [{"saturation": -100}, {"gamma": 0.8}]
                            }]
                        });

                        google.maps.event.addDomListener(window, "resize", function () {
                            var center = map.getCenter();
                            google.maps.event.trigger(map, "resize");
                            map.setCenter(center);
                        });

                        var marker = new google.maps.Marker({
                            position: london,
                            map: map
                        });
                        marker.addListener('click', function() {
                            infowindow.open(map, marker);
                        });

                    }
                </script>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSpN1O9PFMM2acjz66kGZ2H4sDHjsex-A&callback=initMap">
                </script>
            </div>
        </div>
    </div>
</div>