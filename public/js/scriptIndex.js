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
    
  },

ready: function(){
  this.getView();
 
  
  	
  },

events: {
    
  },

  methods: {
    
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
      
    });
      

    },

    
	},
  

})
})