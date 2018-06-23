@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <form action="{{ route('admin.report.update', $report->id) }}" method="POST">
                @csrf
                {{ method_field('PUT') }}
            <div class="card-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="from-group">
                            <label>Type</label>
                            <select name="type" class="form-control">
                                @foreach($listType as $item)
                                    <option value="{{ $item->id }}" {{ $item->id === $report->type_id ? 'selected':'' }}>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Latitude</label>
                            <input type="text" placeholder="Enter Latitude" class="form-control" value="{{ $report->latitude }}">
                        </div>
                        <div class="form-group">
                            <label>Longitude</label>
                            <input type="text" placeholder="Enter Longitude" class="form-control" value="{{ $report->longitude }}">
                        </div>
                        <div class="form-group">
                            <label>Comment</label>
                            <textarea class="form-control" placeholder="Enter note here" name="comment">{{ $report->comment }}</textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success" type="submit">Edit</button>
                            <a href="{{ route('admin.report.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
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
            var myLatlng = new google.maps.LatLng({{ $report->latitude }}, {{ $report->longitude }});
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

            // if (navigator.geolocation) {
            //     navigator.geolocation.getCurrentPosition(function(position) {
            //         var pos = {
            //           lat: position.coords.latitude,
            //           lng: position.coords.longitude
            //         };
            //         console.log(pos);
            //     });
            // }

    });
</script>
@endsection
