window.addEventListener('load', function () {
    // register modal component
Vue.component('editor', {
  template: '#editor-template',
  props: {
    show: {
      type: Boolean,
      required: true,
      twoWay: true    
    },
    showServerResponse: {
      type: Boolean,
      required: true,
      twoWay: false    
    },
    projectTitle: {
      type: String,
      required: true,
      twoWay: true
    },
    projectDescription: {
      type: String,
      required: true,
      twoWay: true
    },
    projectCost: {
      type: String,
      required: true,
      twoWay: true
    },
    projectDate: {
      type: String,
      required: true,
      twoWay: true
    },
    projectCategory: {
      type: String,
      required: true,
      twoWay: true
    },
    costCaption: {
      type: String,
      required: true,
      twoWay: true
    },
    categoryCaption: {
      type: String,
      required: true,
      twoWay: true
    },
    dateCaption: {
      type: String,
      required: true,
      twoWay: true
    },
    idCaption: {
      type: String,
      required: true,
      twoWay: true
    },
    options: {
      type: Array,
      required: true,
      twoWay: true
    },
    projectImage: {
      type:String,
      required: true,
      twoWay: true
    },
    projectID: {
      type:Number,
      required: true,
      twoWay: true
    },
  },
  methods: {
    applyChanges: function()
    {
      this.$parent.applyChanges();
      //this.$dispatch('modal-msg', title, issection, ispublished);
      //this.show=false;
    },
    discardChanges: function() {
      this.$parent.discardChanges();

    },
    clearMessage: function(){
      this.showServerResponse = false;
    }
  },

  events:{
    'changes-saved': function(responseStatus, isNew){
    
    if (responseStatus){
      if (!isNew){
        this.showServerResponse = true;
        this.$parent.projects[this.$parent.editedRecord].description = this.$parent.projectDescription;
        this.$parent.projects[this.$parent.editedRecord].title = this.$parent.projectTitle;
        this.$parent.projects[this.$parent.editedRecord].cost = this.$parent.projectCost;
        this.$parent.projects[this.$parent.editedRecord].date = this.$parent.projectDate;
        this.$parent.projects[this.$parent.editedRecord].category = this.$parent.projectCategory;
        this.$parent.projects[this.$parent.editedRecord].image = document.getElementById('imgProj').src;
        } else {
          this.showServerResponse = true;
          this.$parent.projects.push({id: this.$parent.projectID,
                                      title: this.$parent.projectTitle,
                                      description: this.$parent.projectDescription,
                                       cost: this.$parent.projectCost,
                                       date: this.$parent.projectDate,
                                       category: this.$parent.projectCategory,
                                       image: document.getElementById('imgProj').src});

        }
        window.setTimeout(this.clearMessage, 5000);

      } else {
        alert('Error!!Didn\'t change it!');

      }
    

  },
  }
})

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
    projectID: -1,
    imgCurrent: "../img/portfolio/cabin.png",
    projectCategory: 'none',
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

    showEditor: false,
    showServerResponse: false,
    testVar: "test",
    editedRecord: -1,
    viewProperties:[],
    viewResponse: "",

    projects: [],
    responseServer: false,
  },

ready: function(){
  this.getView();
  this.getAllProjects();

  $( "#datepicker" ).datepicker({
  dateFormat: "yy-mm-dd"
});

 $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

 $('form.ajax').on('submit', function(event){
            event.preventDefault();
            var filedata = new FormData();
            var f1 = $(this).find('input[type=file]')[0].files[0];
            filedata.append('imag', f1);
            

            

            if (f1) {
            var imagTarget = "imgProj";
            };

            $.ajax({
                type     : "POST",
                url      : $(this).attr('action'),
                data     : filedata,
                cache    : false,
                contentType: false,
                processData: false,
                success  : function(data) {
                
                  if (imagTarget)
                  {
                    document.getElementById(imagTarget).src = "../../img/"+data[1];
                  }

                    //document.getElementById("ajax-response").innerHTML = data[0];

                    
                }
            })

            return false;

        });
  
  	
  },

events: {

  'deleted-on-server': function(responseStatus, recordDelete){
    if (responseStatus){
        this.projects.$remove(recordDelete);
      } else {
        alert('Error!!Didn\'t delete it!');

      }
  },
  'changes-savedz': function(responseStatus){
    if (responseStatus){
        this.showServerResponce = true;

      } else {
        alert('Error!!Didn\'t delete it!');

      }
  },
    
  },

  methods: {

    addNewProject: function(){
      this.editorReset();
      document.getElementById('btnApply').innerHTML = "Save project";

    },

    keepOld: function(){
      this.oldProjectDescription = this.projectDescription;
      this.oldProjectTitle = this.projectTitle;
      this.oldProjectCost = this.projectCost;
      this.oldProjectDate = this.projectDate;
      this.oldProjectCategory = this.projectCategory;
      this.imgCurrent = document.getElementById('imgProj').src;
    },

    editRecord: function(indexRecord){
        this.editorSet(indexRecord);
        this.showEditor = true;

    },

    editorSet: function(indexRecord){
    
      this.projectTitle = this.projects[indexRecord].title;
      this.projectDescription = this.projects[indexRecord].description;
      this.projectCost = this.projects[indexRecord].cost;
      this.projectDate = this.projects[indexRecord].date;
      this.projectCategory = this.projects[indexRecord].category;
      this.imgCurrent = this.projects[indexRecord].image;
      this.projectID=this.projects[indexRecord].id;
      this.editedRecord = indexRecord;

    },

    deleteRecord: function(indexRecord){
      var recordDelete = this.projects[indexRecord];
      this.deleteServer(recordDelete);
      


    },

    editorReset: function(){
      this.projectTitle = "Projec Title";
      this.projectDescription = "Use this area of the page to describe your project.";
      this.projectCost = "n/a";
      this.projectDate = "pick a date";
      this.projectCategory = 'none';
      this.imgCurrent = '../img/portfolio/cabin.png';
      this.projectID=-1;
      this.editedRecord = -1;

    },

    discardChanges: function(){
      this.projectDescription = this.oldProjectDescription;
      this.projectTitle = this.oldProjectTitle;
      this.projectCost = this.oldProjectCost;
      this.projectDate = this.oldProjectDate;
      this.oldProjectCategory = this.projectCategory;
      document.getElementById('imgProj').src=this.imgCurrent;
      
    },

    applyChanges: function(){
      if (this.projectID!=-1){
        this.messageToServer.projectId = this.projectID;
      }
      this.messageToServer.projectDescription = this.projectDescription;
      this.messageToServer.projectTitle = this.projectTitle;
      this.messageToServer.projectCost = this.projectCost;
      this.messageToServer.projectDate = this.projectDate;
      this.messageToServer.category = this.projectCategory;
      this.messageToServer.image = document.getElementById('imgProj').src;
      this.sendserver(this.messageToServer);
    },

    sendserver: function(postmessage){
     Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
      var sendStatus;
      var responseStatus = false;
      sendStatus = this.$http.post('/admin/setProject', postmessage).then(function(response)
        {
          responseStatus = true;
          this.projectID=response.data.id;
          this.$broadcast('changes-saved', responseStatus, response.data.state);
          
          this.keepOld();

        }, function(response){
          console.log(response.data);
          
        });
    },


    deleteServer: function(recordDelete){
     Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('content');
      var sendStatus;
      var responseStatus = false;
      sendStatus = this.$http.post('/admin/destroyProject', recordDelete).then(function(response)
        {
          //alert('del');
          responseStatus = true;
          this.$dispatch('deleted-on-server', responseStatus, recordDelete);

        }, function(response){
          console.log(response.data);
          alert('not del');
          responseStatus = false;
          this.$dispatch('deleted-on-server', responseStatus, recordDelete);
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
      //
      this.keepOld();
    });
      

    },

    getAllProjects: function () {
      this.$http.get('/admin/admProjects').then(function(response)
    {
      this.$set('projects', response.data);
      //this. = response.data;
      
      

      //document.getElementById('btnApply').innerHTML = "Save project";
      //this.keepOld();
    });
      

    },


    
	},
  

})
})