<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{env('APP_NAME')}}  Tracking Console</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <style type="text/css">
        html, body {
            margin:0px;
            height:100%;
            background: #fff !important;
        }
        #map {
            height:100vh;
            width: 100%;
        }
        .trackerSection{
            display:grid;
            grid-template-columns: repeat(12,1fr);

        }
        .mapSection{
            grid-column: 1/10;
        }
        .detailsSection{
            height:100vh;
            width: 100%;
        }
        .detailsSection .footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color:white;
            color: #000;
            padding:35px;
            border:1px solid grey;
            text-align: center;
            border-radius: 15px;
        }
        .detailsSection .footer p {
            position: absolute;

        }
    </style>
</head>

<body>
<div class="">
<section class="trackerSection">
    <section class="mapSection">
        <div id="map"></div>
    </section>
    <section class="detailsSection">
        <h4>Some locationa</h4>
        <div class="footer">
            <p>sartjsjdjdjsjjsjdjd</p>
        </div>
    </section>
</section>

</div>

<script type="text/javascript">
    function initMap() {
        const myLatLng = { lat: 9.0820, lng: 8.6753 };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 5,
            center: myLatLng,
        });

        var locations =  <?php print  json_encode($locations); ?>

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));

        }
    }

    window.initMap = initMap;
</script>

<script type="text/javascript"
        src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>

</body>
</html>
