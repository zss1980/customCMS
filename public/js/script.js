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
  },

ready: function(){
  this.keepOld();
  	
  },

events: {
    
  },

  methods: {

    keepOld: function(){
      this.oldCompanyName = this.companyName;
      this.oldCompanyFeatures = this.companyFeatures;
      this.oldBGcolor = this.bgcolor;
    },

    discardChanges: function(){
      this.companyName = this.oldCompanyName;
      this.companyFeatures = this.oldCompanyFeatures;
      this.bgcolor = this.oldBGcolor;
    }




	},
  

})
})