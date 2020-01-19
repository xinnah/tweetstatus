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
        <h4>Something wrong, please try again.</h4>
        <a class="btn btn-danger" :href="url+'/twitter-update'">Reload</a>
      </div>
      <div class="setup_success_section setup_section"v-if="completeBtn">
        <h4>You are successfully update your twitter.</h4>
        <a :href="url+'/twitter-dashboard'" class="btn btn-success">Go to your dashboard</a>
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
        followIds:[],
        followingIds:[],
        reloadBtn:false,
        completeBtn:false,
      }
    },
    
    props:['user'],
    components:{
      VueSlideBar
    },
    methods:{
      followUpdate(){
        this.sliderCustomzie.val = 2;
        setTimeout(() => {
          let getData = {
            type:'followers'
          };
          axios.post(this.url+'/twitter-update-removeids',getData).then( response=> {
            //console.log(response.data);
            if(response.data.result !== 'removeIdserror'){
              this.followersGetIds();
              this.reloadBtn = false;
            }else{
              this.reloadBtn = true;
            }
          });
        }, 5000);
      },
      followersGetIds(){
        this.sliderCustomzie.val = 5;
        setTimeout(() => {
          axios.get(this.url+'/twitter-setup-follower').then( response=> {
            if(response.data.result !== 'followererror'){
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
        }, 3000);
      },
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
                      self.followingUpdate();
                    }
                  }else{
                    //this.reloadBtn = true;
                  }
                });
              }, 5000);
          }(i));
        }
      },
      followingUpdate(){
        setTimeout(() => {
          this.sliderCustomzie.val = 52;
          let getData = {
            type:'following'
          };
          axios.post(this.url+'/twitter-update-removeids',getData).then( response=> {
            if(response.data.result !== 'removeIdserror'){
              this.reloadBtn = false;
              this.followingListGet();
            }else{
              this.reloadBtn = true;
            }
          });
        }, 3000);
      },
      followingListGet(){
        setTimeout(() => {
          this.sliderCustomzie.val = 53;
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
        }, 3000);
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
          axios.get(this.url+'/twitter-update-complete/manual').then( response=> {
            //console.log(response.data);
            if(response.data.result !== 'completeerror'){
              this.sliderCustomzie.val = 100;
              this.reloadBtn = false;
              window.location.href = this.url+'/twitter-dashboard';
            }else{
              this.reloadBtn = true;
            }
          });
        }, 2000);
        
      }
    },
    mounted() {
      this.sliderCustomzie.val = 2;
      this.followUpdate();      
    }
  }
</script>