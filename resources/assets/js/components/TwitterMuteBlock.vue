<template>
	<div>
    
    <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
      <thead>
        <tr>
          <th>Name</th>
          <th>Followers</th>
          <th>Following</th>
          <th>Follow-Back Rate</th>
          <th width="18%">Action</th>
        </tr>
      </thead>
      <tbody>
        <tr v-if="loaderData">
          <td colspan="5"><div class="loader-datatable" id="loader-datatable"><img :src="url+'/public/loader-cycle.gif'"></div></td>
        </tr>
        <tr v-for="data in resultData" v-if="resultDataView">
          <td>
            <div class="twitter-media row">
              <div class="twitter_get_image col-sm-3">
                <img class="" :src="data.profile_image_url">
              </div>
              <div class="twitter_get_content col-sm-9">
                <a target="_blank" :href="'https://twitter.com/'+data.screen_name" class="">{{ data.name }}</a>
                <br>
                <span><a target="_blank" :href="'https://twitter.com/'+data.screen_name">@{{ data.screen_name }}</a></span>
              </div>
            </div>
          </td>
          <td>{{ data.followers_count }}</td>
          <td>{{ data.friends_count }}</td>
          <td>
            <followBackRate :follower="data.followers_count" :following="data.friends_count"></followBackRate>
          </td>
          <td class="text-right table-buttons">
              <div class="btn-group">
                <muted v-if="type === 'muted'" :uid="data.id_str" :muted="muted"></muted>
                <blocked v-if="type === 'blocked'" :uid="data.id_str" :blocked="blocked"></blocked>
              </div>
          </td>
        </tr>
        <tr v-if="this.getids.ids.length===0">
          <td colspan="100%"> <h5 class="text-center">No user found!</h5> </td>
        </tr>
      </tbody>
    </table>
		

	</div>
</template>
<script>
  import muted from './TwitterMutedBtn.vue';
  import blocked from './TwitterBlockedBtn.vue';
  import followBackRate from './twitter/FollowBackRate.vue';
  export default {
    data(){
      return {
        url:$("#base_url").val(),
        blocked:true,
        muted:true,
        resultData:[],
        loaderData:true,
        resultDataView:false,
      }
    },
    props:['getids','type'],
    components:{
      muted, blocked, followBackRate
    },
    methods:{
      
      
      
    },
    mounted() {
      if(this.getids.ids.length > 0){
        let getData = {
          type:this.type,
          getIds:this.getids,
        };
        
        var getUrl = '/twitter-get-data';
        
        axios.post(this.url+getUrl,getData).then( response=> {
          
          if(response.data.result === 'success'){
            this.resultData = response.data.getResult;
            this.loaderData = false;
            this.resultDataView = true;
          }
          
            
        });
      }else{
        this.resultData = [];
        this.loaderData = false;
        this.resultDataView = true;
      }
    }
  }
</script>