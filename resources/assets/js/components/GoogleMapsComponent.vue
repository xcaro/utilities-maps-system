<template>
  <div class="google-map" :id="mapName"></div>
</template>

<script>
export default {
  name: 'google-map',
  props: ['name'],
  data: function () {
  	//console.log(this.name);
    return {
      mapName: this.name + "-map",
    }
  },

  mounted: function() {
    const element = document.getElementById(this.mapName)
    const options = {
      zoom: 17,
      center: {lat: 10.764237, lng: 106.689597}
    }
    const map = new google.maps.Map(element, options);
  }
};
</script>
<style scoped>
.google-map {
  height: 100%;
}
</style>