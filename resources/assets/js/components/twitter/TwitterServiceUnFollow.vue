<template>
	<div>
    <notifications position="bottom right" group="unfollow"/>
    <div v-if="!loader">
      <div class="loader-datatable" id="loader-datatable"><img :src="url+'/public/loader-cycle.gif'"></div>
    </div>
    <div class="row" v-if="resultData.length > 0 && loader">
      <div class="col-sm-offset-10">
        <button class="btn btn-success pull-right" @click="autoUnFollowBtn">Auto unfollow</button>
      </div>
    </div>
		<div class="search_result_content_section" id="table-get-data" v-if="loader">
      <table id="data-table" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>Name</th>
            <th width="20%">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="data in resultData" id="load-tdoby">
            <td>
              <div class="twitter-media row">
                <div class="twitter_get_content col-sm-10">
                  <a target="_blank" :href="'https://twitter.com/'+data.screen_name" class="">{{ data.name }}</a>
                  <br>
                  <span><a target="_blank" :href="'https://twitter.com/'+data.screen_name">@{{ data.screen_name }}</a></span>
                </div>
              </div>
            </td>
            
            <td>
              <follow :uid="data.id" :following="data.following"></follow>
              <div :class="'loader-followbtn'+data.id" id="loader-follow-auto" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div>
            </td>
          </tr>
          <tr v-if="resultData.length===0 && loader">
            <td colspan="100%"> <h5 class="text-center">No user found!</h5> </td>
          </tr>
        </tbody>
      </table>
    </div>

	</div>
</template>
<script>
  import follow from './../TwitterFollowBtn.vue';
  export default {
    data(){
      return {
        url:$("#base_url").val(),
        resultData:[],
        loader:false
        
      }
    },
    props:['user','unfollowlist'],
    components:{
      follow
    },
    
    methods:{
      autoUnFollowBtn(){
        this.resultData.forEach( (follow)=>{
          if(follow.following === true){
            $(".loader-followbtn"+follow.id).css('display','block');
            let getData ={
              type:1,
              id:follow.id
            }
            axios.post(this.url+'/twitter-autounfollow',getData).then( response=> {
              if(response.data.result === 'success'){
                follow.following = response.data.value;
                $(".loader-followbtn"+follow.id).css('display','none');
              } 
            });

          }
        });
      }
      
      
    },
    mounted() {
      setTimeout(() => {
        let getData = {
          unfollowlist:this.unfollowlist
        };
        axios.post(this.url+'/twitter-keyword-wise-unfollow-data',getData).then( response=> {
          
          if(response.data.status === 'success'){
            this.resultData = response.data.result;
          }else{
            this.$notify({
              group: 'unfollow',
              title: '<i class="fas fa-exclamation-circle"></i> Error',
              text: response.data.result,
              type:'error'
            });
          }
          
        });
        return this.loader = true;
      }, 4000); 
    }
  }
</script>