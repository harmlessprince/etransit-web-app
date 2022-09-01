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
            background:linear-gradient(to right,  #e7efff , #fff);
            font-size: 16px;
            font-family: 'Courier New', Courier, monospace;
        }
        #map {
            height:100vh;
            width: 100%;
        }
        .trackerSection{
            display:grid;
            grid-template-columns: repeat(13,1fr);

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
            /*border:1px solid grey;*/

            /*border-radius: 15px;*/
        }
        .detailsSection{
            grid-column: 10/13;
            background:linear-gradient(to right,  #e7efff , #fff);

        }
        .detailsSection h6 ,  .detailsSection small{
            margin-left: 10px;
            margin-top: 20px;
        }
        .detailsSection small{
            color: #DC6513;
        }
        .detailsSection .footer{
            background:linear-gradient(to right,  #e7efff , #fff);
        }
        .detailsSection .footer p {
            position: absolute;

        }
        .detailsSection h6{
            margin-top: 20px;
        }
        .location_name , .location_time{
            margin-left: 20px;
        }
        #locations_box
        {
            margin-top: 40px;
            height: 80vh;
            overflow: scroll;


        }
        .location_inner_box{
            display: flex;
            box-shadow: 5px 5px 5px 5px  #e7efff;
            background:linear-gradient(to right,  #e7efff , #fff);
            padding:10px;
            margin-top:10px;
        }
        .orange_dot{
            background: #DC6513;
            width:10px;
            height:10px;
            border-radius: 50%;
            margin-left:10px;
            margin-top:9px;
        }

        @media screen and (max-width: 768px) {
            .trackerSection{
                display:flex;
                flex-direction: column;
            }

            #locations_box
            {
                margin-top: 40px;
                height: 20vh;
                overflow: scroll;
            }
            .detailsSection{
                height:50vh;
                width: 100%;
            }
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
        <div>
            <h6><b>Tracking ID</b></h6>
           <small><b>{{$tracker_id}}</b></small>
        </div>
        <div id="locations_box">
            @foreach($locations as $index =>  $location)
                <div class="location_inner_box">
                    <div class="orange_dot"></div>
                    <div>
                        <div class="location_name"><p><b>{{$location[0]}}</b></p></div>
                        <div class="location_time"><p><b>{{$location[3]}} - {{$location[4]}}</b></p></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="footer">
               <div >
                   <p><b>{{$trackedUser->user->full_name }} : {{$trackedUser->user->email}}</b></p>
               </div>
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
