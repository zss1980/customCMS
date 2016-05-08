window.addEventListener('load', function () {
    // register modal component


    var vm = new Vue({
  el: '#app',
  data: {
    aboutInfoLeft: "Freelancer is a free bootstrap theme created by Start Bootstrap. The download includes the complete source files including HTML, CSS, and JavaScript as well as optional LESS stylesheets for easy customization.",
    aboutInfoRight:"Whether you're a student looking to showcase your work, a professional looking to attract clients, or a graphic artist looking to share your projects, this template is the perfect starting point!",
  	oldAboutInfoLeft: "",
    oldAboutInfoRight: "",
    bgcolor: '18bc9c',
    oldBGcolor: '',
    downloadLink: '../../img/profile.png',
    downloadCaption: "Download Theme",
    oldDownloadLink:"",
    messageToServer:{
      aboutInfoLeft: '',
      aboutInfoRight: '',
      bgColor: '',
      downloadLink:'',
      downloadCaption: '',
      parent: 'about'
    },
    viewProperties:[],
  },

ready: function(){
  this.getView();
  //this.keepOld();
  
  	
  },

events: {
    
  },

  methods: {

    keepOld: function(){
      this.oldAboutInfoLeft = this.aboutInfoLeft;
      this.oldAboutInfoRight = this.aboutInfoRight;
      this.oldDownloadCaption = this.downloadCaption;
      this.oldBGcolor = this.bgcolor;
      this.oldDownloadLink = this.downloadLink;
    },

    discardChanges: function(){
      this.aboutInfoLeft  = this.oldAboutInfoLeft;
      this.aboutInfoRight = this.oldAboutInfoRight;
      this.downloadCaption = this.oldDownloadCaption;
      this.oldBGcolor = this.bgcolor;
      document.getElementById('objectLink').href = this.downloadLink;
      document.getElementById('newObject').value = '';
    },

    applyChanges: function(){
      this.messageToServer.aboutInfoLeft = this.aboutInfoLeft;
      this.messageToServer.aboutInfoRight = this.aboutInfoRight;
      this.messageToServer.bgColor = this.bgcolor;
      this.messageToServer.downloadCaption = this.downloadCaption;
      this.messageToServer.downloadLink = document.getElementById('objectLink').href;
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
      this.$http.get('/admin/getView', {viewName: 'about'}).then(function(response)
    {
      //this.$set('viewProperties', response.data);
      this.viewProperties = response.data;
      //console.log(response.data);
      //console.log (this.viewProperties[0].propertyName);
      for (index = 0, len = this.viewProperties.length; len>index; index++) {
        
        //console.log(this.viewProperties[index].propertyName);
        if (this.viewProperties[index].propertyName=="aboutInfoLeft") {
            this.aboutInfoLeft = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="aboutInfoRight") {
            this.aboutInfoRight = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="bgColor") {
            this.bgcolor = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="downloadCaption") {
            this.downloadCaption = this.viewProperties[index].propertyValue;
        }
         if (this.viewProperties[index].propertyName=="downloadLink") {
            this.downloadLink = this.viewProperties[index].propertyValue;
        }

       
      }
      this.keepOld();
    });
      

    },

    
	},
  

})
})