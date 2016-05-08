window.addEventListener('load', function () {
    // register modal component


    var vm = new Vue({
  el: '#app',
  data: {
    footerLeftCaption: "Location",
    footerRightCaption:"Contact us",
  	footerCentreCaption: "Hours",
    footerLeftText: "123 Main Street<br>Winnipeg, MB, R1M 0A0, Canada",
    footerRightText:"+1.204.123.4567<br>info@oranger.com",
    footerCentreText: "Mon - Fri: 8:00am - 5:00pm<br>Weekends: By appointment",
    copyrightText: "Your Website 2016",
    oldCopyrightText: "",
    oldFooterCentreText: "",
    oldFooterLeftText: "",
    oldFooterRightText: "",
    oldFooterLeftCaption: "",
    oldFooterRightCaption:"",
    oldFooterCentreCaption: "",
    bgcolor: '2c3e50',
    oldBGcolor: '',
    bgcolorBottom: '233140',
    oldBGcolorBottom: '',
    downloadLink: '../../img/profile.png',
    downloadCaption: "Download Theme",
    oldDownloadLink:"",
    messageToServer:{
      footerLeftCaption: '',
      footerRightCaption: '',
      footerCentreCaption: '',
      footerLeftText: '',
      footerRightText: '',
      footerCentreText: '',
      copyrightText: '',
      bgColor: '',
      bgcolorBottom: '',
      parent: 'footer'
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
      this.oldFooterLeftText = this.footerLeftText;
      this.oldFooterRightText = this.footerRightText;
      this.oldFooterCentreText = this.footerCentreText;
      this.oldFooterLeftCaption = this.footerLeftCaption;
      this.oldFooterRightCaption = this.footerRightCaption;
      this.oldFooterCentreCaption = this.footerCentreCaption;
      this.oldBGcolor = this.bgcolor;
      this.oldBGcolorBottom = this.bgcolorBottom;
      this.oldCopyrightText = this.copyrightText;
    },

    discardChanges: function(){
      this.footerLeftText = this.oldFooterLeftText;
      this.footerRightText = this.oldFooterRightText;
      this.footerCentreText = this.oldFooterCentreText;
      this.footerLeftCaption = this.oldFooterLeftCaption;
      this.footerRightCaption = this.oldFooterRightCaption;
      this.footerCentreCaption = this.oldFooterCentreCaption;
      this.bgcolor = this.oldBGcolor;
      this.bgcolorBottom = this.oldBGcolorBottom;
      this.copyrightText = this.oldCopyrightText;
      document.getElementById('jscolorPicker').value = this.bgcolor;
      document.getElementById('jscolorPicker2').value=this.bgcolorBottom;
    },

    applyChanges: function(){
      this.messageToServer.footerLeftText = this.footerLeftText;
      this.messageToServer.footerRightText = this.footerRightText;
      this.messageToServer.footerCentreText = this.footerCentreText;
      this.messageToServer.footerLeftCaption = this.footerLeftCaption;
      this.messageToServer.footerRightCaption = this.footerRightCaption;
      this.messageToServer.footerCentreCaption = this.footerCentreCaption;
      this.messageToServer.bgcolor = this.bgcolor;
      this.messageToServer.bgcolorBottom = this.bgcolorBottom;
      this.messageToServer.copyrightText = this.copyrightText;
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
      this.$http.get('/admin/getView', {viewName: 'footer'}).then(function(response)
    {
      //this.$set('viewProperties', response.data);
      this.viewProperties = response.data;
      //console.log(response.data);
      //console.log (this.viewProperties[0].propertyName);
      for (index = 0, len = this.viewProperties.length; len>index; index++) {
        
        //console.log(this.viewProperties[index].propertyName);
        if (this.viewProperties[index].propertyName=="footerLeftText") {
            this.footerLeftText = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="footerRightText") {
            this.footerRightText = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="bgColor") {
            this.bgcolor = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="footerCentreText") {
            this.footerCentreText = this.viewProperties[index].propertyValue;
        }
         if (this.viewProperties[index].propertyName=="footerLeftCaption") {
            this.footerLeftCaption = this.viewProperties[index].propertyValue;
        }
         if (this.viewProperties[index].propertyName=="footerRightCaption") {
            this.footerRightCaption = this.viewProperties[index].propertyValue;
        }
         if (this.viewProperties[index].propertyName=="footerCentreCaption") {
            this.footerCentreCaption = this.viewProperties[index].propertyValue;
        }
         if (this.viewProperties[index].propertyName=="bgcolorBottom") {
            this.bgcolorBottom = this.viewProperties[index].propertyValue;
        }
         if (this.viewProperties[index].propertyName=="copyrightText") {
            this.copyrightText = this.viewProperties[index].propertyValue;
        }

      }
      this.keepOld();
    });
      

    },

    
	},
  

})
})