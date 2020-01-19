<template>
	<div>
    <div class="setup_section">
      <vue-slide-bar
        v-model="sliderCustomzie.val"
        :min="1"
        :max="100"
        :processStyle="sliderCustomzie.processStyle"
        :lineHeight="sliderCustomzie.lineHeight"
        :tooltipStyles="sliderCustomzie.tooltipStyles">
      </vue-slide-bar>
      <div class="setup_error_section setup_section" v-if="reloadBtn">
        <h4>Data rate limit, please wait 15 minute before try again.</h4>
        <a class="btn btn-danger" :href="url+'/twitter-setup'">Reload</a>
      </div>
      
    </div>
	</div>
</template>
<script>
  import VueSlideBar from 'vue-slide-bar'

  export default {
    data(){
      return {
        url:$("#base_url").val(),
        sliderCustomzie: {
          val: 1,
          lineHeight: 10,
          processStyle: { 
            backgroundColor: '#42b883' 
          },
          tooltipStyles: { 
            backgroundColor: '#42b883',
            borderColor: '#42b883' 
          }
        },
        load:1,
        followIds:[],
        followingIds:[],
        reloadBtn:false
      }
    },
    
    props:['user'],
    components:{
      VueSlideBar
    },
    methods:{
      followersList(){
        var itemShow = 30;
        var stopProcess = 46;
        if(this.followIds.length > itemShow){
          var perPage = 30;
          var followLength = (Math.round(this.followIds.length / perPage) + 1);
          var sliderVal = stopProcess / followLength;
          var processBarCheck = stopProcess + sliderVal;
        }else{
          var perPage = this.followIds.length;
          var followLength = 1;
          var sliderVal = stopProcess;
          var processBarCheck = stopProcess;
        }
        var followId = this.followIds;
        var public_path = this.url;
        var self = this;
        for (var i = 0; i < followLength; i++) {
          (function(n) {
              setTimeout(function(){
                let getData = {
                  type:'followers',
                  start:n,
                  pPage:perPage,
                  data:followId
                };
                
                axios.post(public_path+'/twitter-setup-dataIdlist',getData).then( response=> {
                  //console.log(response.data);
                  if(response.data === 'datasuccess'){
                    self.sliderCustomzie.val += sliderVal;
                    processBarCheck = parseFloat(processBarCheck) - parseFloat(sliderVal);
                    this.reloadBtn = false;
                    
                    if(getData.start + 1 === followLength){
                      self.followingListGet();
                    }
                  }else{
                    //this.reloadBtn = true;
                  }
                });
              }, 5000);
          }(i));
        }
      },
      followingListGet(){
        setTimeout(() => {
          this.sliderCustomzie.val = 52;
          axios.get(this.url+'/twitter-setup-following').then( response=> {
            if(response.data.result !== 'followingerror'){
              var datas = response.data.split('following');
              var followingData = datas[1].slice(1, -1);
              var arrayOfFollowing = followingData.split(',');
              //console.log(arrayOfFollow);
              this.followingIds = arrayOfFollowing;
              this.reloadBtn = false;
              this.followingList();
            }else{
              this.reloadBtn = true;
            }
          });
        }, 5000);
      },
      followingList(){
        var itemShow = 30;
        var stopProcess = 46;
        if(this.followingIds.length > itemShow){
          var perPage = 30;
          var followingLength = (Math.round(this.followingIds.length / perPage) + 1);
          var sliderVal = stopProcess / followingLength;
          var processBarCheck = stopProcess + sliderVal;
        }else{
          var perPage = this.followingIds.length;
          var followingLength = 1;
          var sliderVal = stopProcess;
          var processBarCheck = stopProcess;
        }
        var authTwitterId = this.user.id;
        var followingId = this.followingIds;
        var public_path = this.url;
        var self = this;
        for (var i = 0; i < followingLength; i++) {
          (function(n) {
              setTimeout(function(){
                let getFData = {
                  type:'following',
                  start:n,
                  pPage:perPage,
                  data:followingId,
                  authTwitterId:authTwitterId
                };
                
                axios.post(public_path+'/twitter-setup-dataIdlist',getFData).then( response=> {
                  // console.log(response.data);
                  if(response.data === 'datasuccess'){
                    if(self.sliderCustomzie.val > 99){
                      self.sliderCustomzie.val = 100;
                    }else{
                      self.sliderCustomzie.val += sliderVal;
                    }
                    processBarCheck = parseFloat(processBarCheck) - parseFloat(sliderVal);
                    //this.reloadBtn = false;
                    
                    if(getFData.start + 1 === followingLength){
                      self.successfullySetup();
                    }
                  }else{
                    //this.reloadBtn = true;
                  }
                });
              }, 5000);
          }(i));
        }
        
      },
      successfullySetup(){
        setTimeout(() => {
          axios.get(this.url+'/twitter-setup-complete').then( response=> {
            if(response.data.result !== 'completeerror'){
              this.sliderCustomzie.val = 100;
              this.reloadBtn = false;
              window.location.href = this.url+'/twitter-dashboard';
            }else{
              this.reloadBtn = true;
            }
          });
        }, 3000);
        
      }
    },
    mounted() {
      this.sliderCustomzie.val = 2;
      
      setTimeout(() => {
        axios.get(this.url+'/twitter-setup-follower').then( response=> {
          if(response.data.result !== 'followererror'){
            this.sliderCustomzie.val = 5;//followersList redirect
            var datas = response.data.split('follower');
            var followersData = datas[1].slice(1, -1);
            var arrayOfFollow = followersData.split(',');
            //console.log(arrayOfFollow);
            this.followIds = arrayOfFollow;
            this.reloadBtn = false;
            this.followersList();
          }else{
            this.reloadBtn = true;
          }
          
        });
      }, 2000);

           
    }
  }
</script>