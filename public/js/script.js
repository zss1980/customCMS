window.addEventListener('load', function () {
    // register modal component


    var vm = new Vue({
  el: '#app',
  data: {
    companyName: "ORANGE Renovations",
    companyFeatures:"delivering innovative, practical and sustainable solutions in the home renovations",
  	oldCompanyName: "",
    oldCompanyFeatures: "",
    bgcolor: '18bc9c',
    oldBGcolor: '',
    imgPrefix: 'img/',
    imgCurrent: 'img/profile.png',
    messageToServer:{
      companyName: '',
      companyFeatures: '',
      bgColor: '',
      img: '',
      parent: 'header'
    },
    viewProperties:[],
  },

ready: function(){
  this.getView();
  this.keepOld();
  
  	
  },

events: {
    
  },

  methods: {

    keepOld: function(){
      this.oldCompanyName = this.companyName;
      this.oldCompanyFeatures = this.companyFeatures;
      this.oldBGcolor = this.bgcolor;
      this.imgCurrent = document.getElementById('imgConstr').src;
    },

    discardChanges: function(){
      this.companyName = this.oldCompanyName;
      this.companyFeatures = this.oldCompanyFeatures;
      this.bgcolor = this.oldBGcolor;
      document.getElementById('imgConstr').src=this.imgCurrent;
    },

    applyChanges: function(){
      this.messageToServer.companyName = this.companyName;
      this.messageToServer.companyFeatures = this.companyFeatures;
      this.messageToServer.bgColor = this.bgcolor;
      this.messageToServer.img = document.getElementById('imgConstr').src;
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
      this.$http.get('/admin/getView', {viewName: 'header'}).then(function(response)
    {
      //this.$set('viewProperties', response.data);
      this.viewProperties = response.data;
      //console.log (this.viewProperties[0].propertyName);
      for (index = 0, len = this.viewProperties.length; len>index; index++) {
        
        //console.log(this.viewProperties[index].propertyName);
        if (this.viewProperties[index].propertyName=="companyName") {
            this.companyName = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="companyFeatures") {
            this.companyFeatures = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="bgColor") {
            this.bgcolor = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="img") {
            document.getElementById('imgConstr').src = this.viewProperties[index].propertyValue;
        }

       
      }
      this.keepOld();
    });
      

    },

    loadNew: function(){
      var index;
      var len;
      console.log (this.companyName);
      //alert(this.viewProperties[0]["companyName"]);
      
      console.log (vProperties[0]);
      for (index = 0, len = this.viewProperties.length; len>index; index++) {
        alert('got it');
        console.log(this.viewProperties[index].propertyName);
        if (this.viewProperties[index].propertyName=="companyName") {
          alert('got it');
          this.companyName = 'xxx';
        }
      }

      /*this.companyName = this.oldCompanyName;
      this.companyFeatures = this.oldCompanyFeatures;
      this.bgcolor = this.oldBGcolor;
      document.getElementById('imgConstr').src=this.imgCurrent;*/
    },





	},
  

})
})