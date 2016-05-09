window.addEventListener('load', function () {
    // register modal component


    var vm = new Vue({
  el: '#app',
  data: {
    categoryCaption: "Category",
    dateCaption:"Date",
  	idCaption: "SKU#",
    costCaption: "Approx. cost: $",
    categoryList: 'none',
    options: [
      { text: 'Pick a category', value: 'none' },
      { text: 'bathroom', value: 'bathroom' },
      { text: 'kitchen', value: 'kitchen' },
      { text: 'basement', value: 'basement' }
    ],
    newOption: '',
    
    projectDescription:"Use this area of the page to describe your project. The icon above is part of a free icon set by Flat Icons. On their website, you can download their free set with 16 icons, or you can purchase the entire set with 146 icons for only $12!",
    oldCategoryCaption: "Category",
    oldDateCaption:"Date",
    oldIdCaption: "SKU#",
    oldCostCaption: "Approx. cost: $",
    oldCategoryList: 'none',
    oldOptions:[],

    messageToServer:{
      categoryCaption: '',
      dateCaption: '',
      idCaption: '',
      costCaption: '',
      categoryList: '',
      options: [],
      parent: 'projview'
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

    addOption: function () {
      var text = this.newOption.trim()
      if (text) {
        this.options.push({ text: text, value: text })
        this.option = ''
      }
    },
    removeOption: function (index) {
      this.options.splice(index, 1)
    },

    keepOld: function(){
      this.oldCategoryCaption = this.categoryCaption;
      this.oldDateCaption = this.dateCaption;
      this.oldIdCaption = this.idCaption;
      this.oldCostCaption = this.costCaption;
      this.oldCategoryList = this.categoryList;
      this.oldOptions = JSON.parse(JSON.stringify(this.options));
    },

    discardChanges: function(){
      this.categoryCaption = this.oldCategoryCaption;
      this.dateCaption = this.oldDateCaption;
      this.idCaption = this.oldIdCaption;
      this.costCaption = this.oldCostCaption;
      this.categoryList = this.oldCategoryList;
      this.options = JSON.parse(JSON.stringify(this.oldOptions));
    },

    applyChanges: function(){
      this.messageToServer.categoryCaption = this.categoryCaption;
      this.messageToServer.dateCaption = this.dateCaption;
      this.messageToServer.idCaption = this.idCaption;
      this.messageToServer.costCaption = this.costCaption;
      this.messageToServer.categoryList = this.categoryList;
      this.messageToServer.options = JSON.parse(JSON.stringify(this.options));
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
      this.keepOld();
    });
      

    },

    
	},
  

})
})