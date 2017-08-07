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
                            <div class="text" <?php if (!$enableTitle) echo 'style="display:none"'; ?>>
                                <p class="col-12 col-lg-6" id="title"><?= $this->getInput('title')->getValue(); ?></p>
                                <div class="col-12 col-lg-6"
                                     id="description"><?= $this->getEditor('description')->getValue(); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript"
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCSpN1O9PFMM2acjz66kGZ2H4sDHjsex-A&callback=initMap" async defer>
                </script>
                <div id="map"></div>
                <script type="text/javascript">
                    
                    console.log(123);
                    
                    var initMap = function() {
                        var london = {lat: <?= $latitude ?>, lng: <?= $longitude ?>};

                        var contentString =
                            '<div><strong> <?= $this->getEditor('address')->getValue(); ?> </strong></div><div> <?= $this->getEditor('subAddress')->getValue(); ?> </div>';

                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });

                        var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 12,
                                center: london,
                                disableDefaultUI: true,
                                scrollwheel: false,

                                styles: [
                                    {
                                        "elementType": "geometry",
                                        "stylers": [
                                            {
                                                "color": "#f5f5f5"
                                            }
                                        ]
                                    },
                                    {
                                        "elementType": "labels.icon",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "elementType": "labels.text.fill",
                                        "stylers": [
                                            {
                                                "color": "#616161"
                                            }
                                        ]
                                    },
                                    {
                                        "elementType": "labels.text.stroke",
                                        "stylers": [
                                            {
                                                "color": "#f5f5f5"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "administrative.land_parcel",
                                        "elementType": "labels",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "administrative.land_parcel",
                                        "elementType": "labels.text.fill",
                                        "stylers": [
                                            {
                                                "color": "#bdbdbd"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "poi",
                                        "elementType": "geometry",
                                        "stylers": [
                                            {
                                                "color": "#eeeeee"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "poi",
                                        "elementType": "labels.text",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "poi",
                                        "elementType": "labels.text.fill",
                                        "stylers": [
                                            {
                                                "color": "#757575"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "poi.business",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "poi.park",
                                        "elementType": "geometry",
                                        "stylers": [
                                            {
                                                "color": "#e5e5e5"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "poi.park",
                                        "elementType": "labels.text.fill",
                                        "stylers": [
                                            {
                                                "color": "#9e9e9e"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road",
                                        "elementType": "geometry",
                                        "stylers": [
                                            {
                                                "color": "#ffffff"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road",
                                        "elementType": "labels.icon",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road.arterial",
                                        "elementType": "labels",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road.arterial",
                                        "elementType": "labels.text.fill",
                                        "stylers": [
                                            {
                                                "color": "#757575"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road.highway",
                                        "elementType": "geometry",
                                        "stylers": [
                                            {
                                                "color": "#dadada"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road.highway",
                                        "elementType": "labels",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road.highway",
                                        "elementType": "labels.text.fill",
                                        "stylers": [
                                            {
                                                "color": "#616161"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road.local",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road.local",
                                        "elementType": "labels",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "road.local",
                                        "elementType": "labels.text.fill",
                                        "stylers": [
                                            {
                                                "color": "#9e9e9e"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "transit",
                                        "stylers": [
                                            {
                                                "visibility": "off"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "transit.line",
                                        "elementType": "geometry",
                                        "stylers": [
                                            {
                                                "color": "#e5e5e5"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "transit.station",
                                        "elementType": "geometry",
                                        "stylers": [
                                            {
                                                "color": "#eeeeee"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "water",
                                        "elementType": "geometry",
                                        "stylers": [
                                            {
                                                "color": "#c9c9c9"
                                            }
                                        ]
                                    },
                                    {
                                        "featureType": "water",
                                        "elementType": "labels.text.fill",
                                        "stylers": [
                                            {
                                                "color": "#9e9e9e"
                                            }
                                        ]
                                    }
                                ]
                            }
                        );

                        google.maps.event.addDomListener(window, "resize", function () {
                            var center = map.getCenter();
                            google.maps.event.trigger(map, "resize");
                            map.setCenter(center);
                        });
                        var pinSymbol = function () {
                            return {
                                path: 'M10,0A10,10,0,0,0,0,10c0,8,8,10,10,30,2-20,10-22,10-30A10,10,0,0,0,10,0Zm0,12.08A2.13,2.13,0,1,1,12.13,10,2.12,2.12,0,0,1,10,12.08Z',
                                fillColor: '#56c1a3',
                                fillOpacity: 1,
                                strokeWeight: 1,
                                strokeColor: '#56c1a3',
                                scale: 1,
                                scaledSize: new google.maps.Size(50, 85), // scaled size
                                origin: new google.maps.Point(0, 0), // origin
                                anchor: new google.maps.Point(10, 40), // anchor
                                size: new google.maps.Size(71, 71)

                            };
                        };

                        var marker = new google.maps.Marker({
                            position: london,
                            map: map,
                            icon: pinSymbol()
                        });
                        marker.addListener('click', function () {
                            infowindow.open(map, marker);
                        });

                    };
                    console.log(555);
                </script>

            </div>
        </div>
    </div>
</div>