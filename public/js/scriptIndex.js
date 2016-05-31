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
    mapOn: false,
    
  },

ready: function(){
  this.getView();
  $(".collapse").on('show.bs.collapse', function(){
    $('body').scrollTo('#map',{duration:'1000', offsetTop : '50'});
    });

  $(".collapse").on('click', function(){
    $(".collapse").collapse('toggle');
    });
 
  $.fn.scrollTo = function( target, options, callback ){
  if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
  var settings = $.extend({
    scrollTarget  : target,
    offsetTop     : 50,
    duration      : 500,
    easing        : 'swing'
  }, options);
  return this.each(function(){
    var scrollPane = $(this);
    var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
    var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
    scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
      if (typeof callback == 'function') { callback.call(this); }
    });
  });
}
 
  
  	
  },

events: {
    
  },

  methods: {
    mapSwitch: function(){
      if(this.mapOn) {
        this.mapOn = false;
      } else {
        this.mapOn = true;
      }
    },
    
    getView: function () {
      this.$http.get('/getView', {viewName: 'projview'}).then(function(response)
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