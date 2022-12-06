@extends('admin.layout.app')
<style>
    #map {
        height:calc(100vh + 130px);
        width: 100%;
    }
</style>
@section('content')
    <div class="container-fluid">
        @toastr_css
        <div class="page-header">
            <div class="row">
                <div class="col-6">
                    <h3>{{env('APP_NAME')}}</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/admin/dashboard')}}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Tracking Console</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6>Next Of kin Name : {{$nextOfKin->full_name}}</h6>
                <h6>Next Of kin Email : {{$nextOfKin->email ?? 'nil'}}</h6>
                <h6>Next Of kin Phone Number : {{$nextOfKin->phone_number}}</h6>
                <h6>Created At : {{$nextOfKin->created_at->diffforhumans()}}</h6>
                <h6>Purpose Of Movement : {{$tracker->purpose_of_movement ?? null}}</h6>
                <h6>Tracking ID : {{$tracking_id}}</h6>
            </div>
        </div>
        <div class="card">
            <div class="card-body" >
                <div class="row">
                    <div class="col-md-9 col-lg-9 col-sm-9 col-xl-9">
                        <div id="map"></div>
                    </div>
                    <div class="col-md-3 col-lg-3 col-sm-3 col-xl-3" style="height: 800px;overflow: scroll;" >
                        @foreach($records as $record)
                            <div class="card">
                                <div class="card-body">
                                   <h6 style="color:orange;">{{$record->location}}</h6>
                                    <h6 class="text-success">Lat : {{$record->latitude}} - Long: {{$record->longitude}}</h6>
                                    <span class="text-danger">{{$record->created_at->diffforhumans()}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        function initMap() {
            const myLatLng = { lat: {{ $data['latitude'] ??  19.2901}}, lng: {{ $data['longitude'] ?? 26.818 }} };
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 12,
                center: myLatLng,
            });

            var locations =  <?php print  json_encode($locations); ?>

            var infowindow = new google.maps.InfoWindow();

            marker = new google.maps.Marker({
                position: new google.maps.LatLng({{ $data['latitude'] ??  19.2901}}, {{ $data['longitude'] ?? 26.818 }}),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent('{{ $data['location'] ??  'No location'}}');
                    infowindow.open(map, marker);
                }
            })(marker));
        }

        window.initMap = initMap;
    </script>

    <script type="text/javascript"
            src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&callback=initMap" ></script>
    <script>
        setInterval(function () {
            location.reload();
        }, 30000 * 2)
    </script>
@endsection
