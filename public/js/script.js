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
    messageToServer:{
      companyName: '',
      companyFeatures: '',
      bgColor: '',
      img: ''
    },
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
      document.getElementById('imgConstr').src=this.imgCurrent;
    },

    applyChanges: function(){
      this.messageToServer.companyName = this.companyName;
      this.messageToServer.companyFeatures = this.companyFeatures;
      this.messageToServer.bgColor = this.bgcolor;
      this.messageToServer.img = document.getElementById('imgConstr').src;
      
    }





	},
  

})
})