window.addEventListener('load', function () {
    // register modal component


    var vm = new Vue({
  el: '#app',
  data: {
    categoryCaption: "Category",
    dateCaption:"Date",
  	idCaption: "SKU#",
    costCaption: "Approx. cost: $",
    options: [
      { text: 'Pick a category', value: 'none' },
      { text: 'bathroom', value: 'bathroom' },
      { text: 'kitchen', value: 'kitchen' },
      { text: 'basement', value: 'basement' }
    ],
    
    projectDescription:"Use this area of the page to describe your project.",

    projectName: "Projec name",
    sectionPortfolioName: "Portfolio",
    sectionAboutName: "About",
    sectionContactName: "Contact me",
    imgLogo: "../icos/logo_f.png",

    categoryList: 'none',
    showServerResponse: false,
    newProject: true,

    oldProjectName: "",
    oldSectionPortfolioName:"",
    oldSectionAboutName: "",
    oldSectionContactName: "",
    oldImgLogo: "",
    
    messageToServer:{
      projectName: '',
      sectionPortfolioName: '',
      sectionContactName: '',
      sectionAboutName: '',
      image: '',
      parent: 'settings'
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
      this.oldProjectName = this.projectName;
      this.oldSectionPortfolioName = this.sectionPortfolioName;
      this.oldSectionAboutName = this.sectionAboutName;
      this.oldSectionContactName = this.sectionContactName;
      this.imgLogo = document.getElementById('imgLogo').src;
    },

    discardChanges: function(){
      this.projectName = this.oldProjectName;
      this.sectionPortfolioName = this.oldSectionPortfolioName;
      this.sectionAboutName = this.oldSectionAboutName;
      this.sectionContactName = this.oldSectionContactName;
      document.getElementById('imgLogo').src=this.imgLogo;
      this.serverStatus = false;
      
    },

    applyChanges: function(){
      this.messageToServer.projectName = this.projectName;
      this.messageToServer.sectionPortfolioName = this.sectionPortfolioName;
      this.messageToServer.sectionAboutName = this.sectionAboutName;
      this.messageToServer.sectionContactName = this.sectionContactName;
      this.messageToServer.image = document.getElementById('imgLogo').src;
      this.sendserver(this.messageToServer);
    },

    clearMessage: function(){
      this.showServerResponse = false;
    },

    sendserver: function(postmessage){
     Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
      var sendStatus;
      sendStatus = this.$http.post('/admin/setView', postmessage).then(function(response)
        {
          this.showServerResponse = true;
          this.keepOld();
          window.setTimeout(this.clearMessage, 5000);

        }, function(response){
          console.log(response.data);
          
        });
    },

    getView: function () {
      this.$http.get('/admin/getView', {viewName: 'settings'}).then(function(response)
    {
      //this.$set('viewProperties', response.data);
      this.viewProperties = response.data;
      //console.log(response.data);
      //console.log (this.viewProperties[0].propertyName);
      for (index = 0, len = this.viewProperties.length; len>index; index++) {
        
        //console.log(this.viewProperties[index].propertyName);
        if (this.viewProperties[index].propertyName=="projectName") {
            this.projectName = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="sectionPortfolioName") {
            this.sectionPortfolioName = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="sectionAboutName") {
            this.sectionAboutName = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="sectionContactName") {
            this.sectionContactName = this.viewProperties[index].propertyValue;
        }
         if (this.viewProperties[index].propertyName=="image") {
            document.getElementById('imgLogo').src = this.viewProperties[index].propertyValue;
        }
                 

      }
      
      this.keepOld();
    });
      

    },

    
	},
  

})
})