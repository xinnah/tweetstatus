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
        <a class="btn btn-danger" :href="url+'/twitter-resynchronize-data'">Reload</a>
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
          val: 2,
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
        this.sliderCustomzie.val = 10;
        setTimeout(() => {
          let getData = {
            type:'followers'
          };
          this.sliderCustomzie.val = 15;
          axios.post(this.url+'/twitter-update-removeids',getData).then( response=> {
            //console.log(response.data);
            this.sliderCustomzie.val = 20;
            if(response.data.result !== 'error'){
              this.followingUpdate();
              this.reloadBtn = false;
            }else{
              this.reloadBtn = true;
            }
          });
        }, 1000);
      },
      
      followingUpdate(){
        setTimeout(() => {
          this.sliderCustomzie.val = 40;
          let getData = {
            type:'following'
          };
          axios.post(this.url+'/twitter-update-removeids',getData).then( response=> {
            this.sliderCustomzie.val = 50;
            if(response.data.result !== 'error'){
              this.successfullySetup();
              this.reloadBtn = false;
            }else{
              this.reloadBtn = true;
            }
          });
        }, 1000);
      },
      successfullySetup(){
        setTimeout(() => {
          this.sliderCustomzie.val = 80;
          axios.get(this.url+'/twitter-update-complete/auto').then( response=> {
            //console.log(response.data);
            if(response.data.result !== 'error'){
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
      this.sliderCustomzie.val = 5;
      this.followUpdate();   
    }
  }
</script>