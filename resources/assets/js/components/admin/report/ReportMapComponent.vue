<template>
  <div class="map map-big" :id="mapName"></div>
</template>

<script>
export default {
  props: ['name'],
  data: function () {
    return {
      mapName: 'gmap',
      markerCoordinates: [],
      reportType: {},
      map: null,
      markers: [],
    }
  },
  mounted: function() {
    const element = document.getElementById(this.mapName)
    const options = {
      zoom: 12,
      mapTypeControl: false,
      center: {lat: 10.764237, lng: 106.689597}
    }
    this.map = new google.maps.Map(element, options);
    
    axios.get('/api/report-type')
    .then(response => {
        response.data.data.forEach((val) => {
            this.reportType[val.id] = {
              confirmed_icon: val.confirmed_icon,
              unconfirmed_icon: val.unconfirmed_icon
            };
        });
    });
    let infowindow = new google.maps.InfoWindow({
          content: `<hr>
            <button type="button" class="btn btn-primary confirm-report" data-report-id="1" data-report-type="1">Confirm</button>
            <button type="button" class="btn btn-danger">Delete</button>`
        });
    const marker = new google.maps.Marker({
        position: {lat: 10.7679190, lng: 106.6954960},
        map: this.map});
      marker.addListener('click',() => {
        infowindow.open(map, marker);
      });

  },
  destroyed: function () {
  },
  created: function () {
    // const socket = io('http://127.0.0.1:8000/');
    // socket.on('data', (data) => {
    //     //console.log(data);
    //     switch(data.type) {
    //         case 'add':
    //         case 'initial':
    //           this.markerCoordinates.push(data.new_val);
    //           console.log(this.markerCoordinates);
    //             break;
    //         case 'remove':
    //             break;
    //         case 'change':
    //             break;
    //     }
    // })
  }
};
</script>