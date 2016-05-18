window.addEventListener('load', function () {
    // register modal component


    var vm = new Vue({
  el: '#app',
  data: {
    siteEmailMessage:"You have received a new message from your website contact form.",
    siteEmail: "szautkin@gmail.com",
    serverStatus: false,
    
    oldSiteEmailMessage: "",
    oldSiteEmail:"",
        
    messageToServer:{
      siteEmailMessage: '',
      siteEmail: '',
      parent: 'contacts'
    },
    viewProperties:[],
    viewResponse: "",
  },

ready: function(){
  this.getView();
  //this.keepOld();
  
  	
  },

events: {
    
  },

  methods: {

    keepOld: function(){
      this.oldSiteEmailMessage = this.siteEmailMessage;
      this.oldSiteEmail = this.siteEmail;
      
    },

    clearMessage: function(){
     this.serverStatus = false;
      
    },


    discardChanges: function(){
      this.siteEmailMessage = this.oldSiteEmailMessage;
      this.siteEmail = this.oldSiteEmail;
      this.serverStatus = false;
      
    },

    applyChanges: function(){
      this.messageToServer.siteEmailMessage = this.siteEmailMessage;
      this.messageToServer.siteEmail = this.siteEmail;
      this.sendserver(this.messageToServer);
    },

    sendserver: function(postmessage){
     Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
      var sendStatus;
      sendStatus = this.$http.post('/admin/setView', postmessage).then(function(response)
        {
          this.serverStatus = true;
          
          this.keepOld();
          window.setTimeout(this.clearMessage, 5000);

        }, function(response){
          console.log(response.data);
          
        });
    },

    getView: function () {
      this.$http.get('/admin/getView', {viewName: 'contacts'}).then(function(response)
    {
      //this.$set('viewProperties', response.data);
      this.viewProperties = response.data;
      //console.log(response.data);
      //console.log (this.viewProperties[0].propertyName);
      for (index = 0, len = this.viewProperties.length; len>index; index++) {
        
        //console.log(this.viewProperties[index].propertyName);
        if (this.viewProperties[index].propertyName=="siteEmailMessage") {
            this.siteEmailMessage = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="siteEmail") {
            this.siteEmail = this.viewProperties[index].propertyValue;
        }
        }
      this.keepOld();
    });
      

    },

    
	},
  

})
})