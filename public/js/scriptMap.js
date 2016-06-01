




window.addEventListener('load', function(){
    window.initMap = function(){
  vm.$emit('google.maps:init');
    console.log('fired message');
};


    var vm = new Vue({
  el: '#app',
  data: {
    setLocation: "Winnipeg, MB, Canada",
    pitch: 28,
    heading: 54.9,
    latitude: 49.8902011,
    longtitude:-97.1319283,
    zoom: 14,
    alpha: 0,
    beta: 0,
    gamma:0,
    alphaShift: 1,
    betaShift: 0,
    gammaShift: 0,

    oldSetLocation: -1,
    oldPitch: -1,
    oldHeading: -1,
    oldLatitude: -1,
    oldLongtitude: -1,
    oldZoom: -1,

    messageToServer:{
      setLocation: "Winnipeg, MB, Canada",
      pitch: 50,
      heading: 50,
      latitude: 49.8997541,
      longtitude:-97.1374937,
      zoom: 14,
      parent: 'map'
    },
    viewProperties:[],
  },

ready: function(){
  this.getView();
  $.getScript( "https://maps.googleapis.com/maps/api/js?key=AIzaSyBBwYO0mX3k4m9Y3vXAAgrYkZ0OPR3HJm8&signed_in=true&callback=initMap", function( data, textStatus, jqxhr ) {
  console.log( data ); // Data returned
  console.log( textStatus ); // Success
  console.log( jqxhr.status ); // 200
  console.log( "Load was performed." );
});
  
  
  //this.keepOld();
 
    
  },

events: {
  'google.maps:init': function(){

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: this.zoom,
    center: ({lat: this.latitude, lng: this.longtitude})
  });
  var panorama = new google.maps.StreetViewPanorama(
      document.getElementById('pano'), {
        position: ({lat: this.latitude, lng: this.longtitude}),
        pov: {
          heading: this.heading,
          pitch: this.pitch
        }
      });
  window.addEventListener('deviceorientation', function(event) {
  console.log(event.alpha + ' : ' + event.beta + ' : ' + event.gamma);
  //vm.$emit('phone_moved', event);
  
    if (event.alpha>1) {
    vm.heading += 0.001;
    //vm.alpha = event.alpha;
    panorama.setPov({
          heading: this.heading,
          pitch: this.pitch});
    alert('Est contakt');

  }
});

  map.setStreetView(panorama);
  
  panorama.addListener('pov_changed', function() {
      vm.pitch = panorama.getPov().pitch;
      vm.heading = panorama.getPov().heading;

  });

  map.addListener('zoom_changed', function() {
    vm.zoom = map.getZoom();
  });
  panorama.addListener('position_changed', function() {
    vm.latitude = panorama.getPosition().toJSON().lat;
    vm.longtitude = panorama.getPosition().toJSON().lng;
  });
  }, 

 /* 'phone_moved': function(event){
    
    vm.$emit('google.maps:init');
  }*/
  /*if (event.beta) {
    vm.pitch +=0.0001;
  }
  

  }*/
    
  },


  /*created: function(){
  vm.gmap = map;
  vm.gpanorama = panorama;
  
},*/

  methods: {

    geocodeAddress: function () {
  var geocoder = new google.maps.Geocoder();
  
  geocoder.geocode({'address': this.setLocation}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      vm.latitude = results[0].geometry.location.lat();
      vm.longtitude = results[0].geometry.location.lng();
      vm.$emit('google.maps:init');

      /*
      map.setCenter(results[0].geometry.location);
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location,
        animation:google.maps.Animation.BOUNCE
      });
      panorama.setPosition(results[0].geometry.location);
      map.setStreetView(panorama);
*/
      
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
    }
  });
},



    keepOld: function(){
      this.oldSetLocation = this.setLocation;
      this.oldPitch = this.pitch;
      this.oldHeading = this.heading;
      this.oldLatitude = this.latitude;
      this.oldLongtitude = this.longtitude;
      this.oldZoom = this.zoom;
      
    },

    discardChanges: function(){
      this.setLocation = this.oldSetLocation;
      this.pitch = this.oldPitch;
      this.heading = this.oldHeading;
      this.latitude = this.oldLatitude;
      this.longtitude = this.oldLongtitude;
      this.zoom = this.oldZoom;
      vm.$emit('google.maps:init');
    },

    applyChanges: function(map, panorama){

      this.messageToServer.setLocation = this.setLocation;
      this.messageToServer.pitch = this.pitch;
      this.messageToServer.heading = this.heading;
      this.messageToServer.latitude = this.latitude;
      this.messageToServer.longtitude = this.longtitude;
      this.messageToServer.zoom = this.zoom;
      this.sendserver(this.messageToServer);

    },

    sendserver: function(postmessage){
     Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
      var sendStatus;
      sendStatus = this.$http.post('/admin/setView', postmessage).then(function(response)
        {
          //alert('updated');
        }, function(response){
          console.log(response.data);

        });
    },

    getView: function () {
      this.$http.get('/admin/getView', {viewName: 'map'}).then(function(response)
    {
      //this.$set('viewProperties', response.data);
      this.viewProperties = response.data;
      //console.log(response.data);
      //console.log (this.viewProperties[0].propertyName);
      for (index = 0, len = this.viewProperties.length; len>index; index++) {
        
        //console.log(this.viewProperties[index].propertyName);
        if (this.viewProperties[index].propertyName=="setLocation") {
            this.setLocation = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="pitch") {
            this.pitch = parseFloat(this.viewProperties[index].propertyValue);
        }
        if (this.viewProperties[index].propertyName=="heading") {
            this.heading = parseFloat(this.viewProperties[index].propertyValue);
        }
        if (this.viewProperties[index].propertyName=="latitude") {
            this.latitude = parseFloat(this.viewProperties[index].propertyValue);
        }
         if (this.viewProperties[index].propertyName=="longtitude") {
            this.longtitude = parseFloat(this.viewProperties[index].propertyValue);
        }
         if (this.viewProperties[index].propertyName=="zoom") {
            this.zoom = parseFloat(this.viewProperties[index].propertyValue);
        }
         

      }
      //vm.$dispatch('google.maps:init');
      vm.keepOld();
    });
      

    },

    
  },
  
})
})

