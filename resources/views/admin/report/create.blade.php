@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
        	<form action="{{ route('admin.reports.store') }}" method="POST">
                @csrf
        	<div class="card-content">
        		<div class="row">
                    <div class="col-md-12">
                        <div class="from-group">
                            <label>Type</label>
                            <select name="type" class="form-control">
                                @foreach($listType as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" placeholder="Enter Latitude" class="form-control" name="latitude">
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" placeholder="Enter Longitude" class="form-control" name="longitude">
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea class="form-control" placeholder="Enter note here" name="comment"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success">Create</button>
                            <a href="{{ route('admin.reports.index') }}"><button class="btn btn-danger">Cancel</button></a>
                        </div>
                    </div>
                </div>
        	</div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <div id="map" class="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        

    // Satellite Map
            var map = new google.maps.Map(document.getElementById('map'), {
                  center: {lat: 10.72, lng: 106.63},
                  zoom: 11
                });

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude
                    };

                    var myLatlng = new google.maps.LatLng(pos);
                    var mapOptions = {
                        zoom: 12,
                        scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
                        center: myLatlng,
                        // mapTypeId: google.maps.MapTypeId.SATELLITE
                    }

                    var map = new google.maps.Map(document.getElementById("map"), mapOptions);

                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        title:"Satellite Map!"
                    });

                    marker.setMap(map);

                    $('input[name=latitude]').val(pos.lat);
                    $('input[name=longitude]').val(pos.lng);
                });
            }

    });
</script>
@endsection
