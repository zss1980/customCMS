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
    projectTitle: "Projec Title",
    projectCost: "n/a",
    projectDate: "pick a date",
    projectID: "n/a",
    imgCurrent: "../img/portfolio/cabin.png",
    categoryList: 'none',
    serverStatus: false,
    newProject: true,

    oldProjectDescription: "",
    oldProjectTitle:"",
    oldProjectCost: "",
    oldProjectDate: "",
    oldCategoryList: "",
    
    messageToServer:{
      projectDescription: '',
      projectTitle: '',
      projectCost: '',
      projectDate: '',
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
      this.oldProjectDescription = this.projectDescription;
      this.oldProjectTitle = this.projectTitle;
      this.oldProjectCost = this.projectCost;
      this.oldProjectDate = this.projectDate;
      this.oldCategoryList = this.categoryList;
      this.imgCurrent = document.getElementById('imgProj').src;
    },

    discardChanges: function(){
      this.projectDescription = this.oldProjectDescription;
      this.projectTitle = this.oldProjectTitle;
      this.projectCost = this.oldProjectCost;
      this.projectDate = this.oldProjectDate;
      this.categoryList = this.oldCategoryList;
      document.getElementById('imgProj').src=this.imgCurrent;
      this.serverStatus = false;
      
      if (this.newProject==true)
      {
        document.getElementById('btnApply').innerHTML = "Save project";
      } else {
        document.getElementById('btnApply').innerHTML = "Apply changes";
        document.getElementById('btnApply').style.display='inline';

      }
      
      document.getElementById('btnDis').innerHTML = "Discard changes";

    },

    applyChanges: function(){
      this.messageToServer.projectDescription = this.projectDescription;
      this.messageToServer.projectTitle = this.projectTitle;
      this.messageToServer.projectCost = this.projectCost;
      this.messageToServer.projectDate = this.projectDate;
      this.messageToServer.category = this.categoryList;
      this.messageToServer.image = this.imgCurrent;
      this.sendserver(this.messageToServer);
    },

    sendserver: function(postmessage){
     Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
      var sendStatus;
      sendStatus = this.$http.post('/admin/setProject', postmessage).then(function(response)
        {
          this.serverStatus = true;
          this.newProject = false;
          document.getElementById('btnApply').style.display='none';
          document.getElementById('btnDis').innerHTML = "Make changes";
          this.keepOld();

        }, function(response){
          console.log(response.data);
          
        });
    },

    getView: function () {
      this.$http.get('/admin/getView', {viewName: 'projview'}).then(function(response)
    {
      //this.$set('viewProperties', response.data);
      this.viewProperties = response.data;
      //console.log(response.data);
      //console.log (this.viewProperties[0].propertyName);
      for (index = 0, len = this.viewProperties.length; len>index; index++) {
        
        //console.log(this.viewProperties[index].propertyName);
        if (this.viewProperties[index].propertyName=="categoryCaption") {
            this.categoryCaption = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="dateCaption") {
            this.dateCaption = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="idCaption") {
            this.idCaption = this.viewProperties[index].propertyValue;
        }
        if (this.viewProperties[index].propertyName=="costCaption") {
            this.costCaption = this.viewProperties[index].propertyValue;
        }
         if (this.viewProperties[index].propertyName=="categoryList") {
            this.categoryList = this.viewProperties[index].propertyValue;
        }
         if (this.viewProperties[index].propertyName=="options") {
            this.options = JSON.parse(JSON.stringify(this.viewProperties[index].propertyValue));
        }
         

      }
      document.getElementById('btnApply').innerHTML = "Save project";
      this.keepOld();
    });
      

    },

    
	},
  

})
})