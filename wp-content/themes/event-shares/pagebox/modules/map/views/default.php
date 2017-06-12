<?php

/**
 * Use this for PhpStorm hints.
 * @var \Nurture\Pagebox\Module\Scope $this
 * @var \Nurture\EventShares\Module\Map $module
 */

$module = $this->getModule();
?>
<div class="<?= $module->getClass() ?>">
    <div class="container">
        <?= createTaskLink('EV-30') ?>
        <div class="row">
            <div class="col-lg-12" style="padding: 0px">
                <div id="map""></div>
                <script>
                    function initMap() {
                        var london = {lat: 51.5069479, lng: -0.1507966};

                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 12,
                            center: london,
                            disableDefaultUI: true,
                            scrollwheel: false,

                            styles: [{
                                "featureType" : "all",
                                "elementType" : "all",
                                "stylers" : [{"saturation" : -100}, {"gamma" : 0.8}]
                            }]
                        });

                        google.maps.event.addDomListener(window, "resize", function() {
                            var center = map.getCenter();
                            google.maps.event.trigger(map, "resize");
                            map.setCenter(center);
                        });

                        var marker = new google.maps.Marker({
                            position: london,
                            map: map
                        });


                    }
                </script>
                <script async defer
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSpN1O9PFMM2acjz66kGZ2H4sDHjsex-A&callback=initMap">
                </script>
                </body>
            </div>
        </div>
    </div>
</div>