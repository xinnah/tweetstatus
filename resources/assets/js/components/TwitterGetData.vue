<template>
	<div>
    <notification></notification>

    <table id="data-table" class="table table-striped table-bordered nowrap table-info" width="100%">
      <thead>
        <tr>
          <th>Name</th>
          <th>Followers</th>
          <th>Following</th>
          <th>Follow-Back Rate</th>
          <th width="30%">Action</th>
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
              <follow :uid="data.id_str" :following="data.following"></follow>
              <blocked :uid="data.id_str" :blockIds="blockIds"></blocked>
              <muted :uid="data.id_str" :mutedIds="mutedIds"></muted>
            </div>
          </td>
        </tr>
        <tr v-if="this.resultData.length===0 && !loaderData">
          <td colspan="100%"> <h5 class="text-center">No user found!</h5> </td>
        </tr>
      </tbody>
    </table>
	</div>
</template>
<script>
  import follow from './TwitterFollowBtn.vue';
  import muted from './twitter/TwitterMutedStatusBtn.vue';
  import blocked from './twitter/TwitterBlockedStatusBtn.vue';
  import followBackRate from './twitter/FollowBackRate.vue';
  import notification from './NotificationMsg.vue';
  export default {
    data(){
      return {
        url:$("#base_url").val(),
        resultData:[],
        loaderData:true,
        resultDataView:false,
        mutedIds:[],
        blockIds:[]
      }
    },
    
    props:['getids','type'],
    components:{
      follow, muted, followBackRate,blocked, notification
    },
    methods:{
      
      
      
    },
    mounted() {
      //muted list load
      axios.get(this.url+'/twitter-muted-ids').then( response=> {
        if(response.data !== 'error'){
          this.mutedIds = response.data.ids;
          
        }
      });
      //block list load
      axios.get(this.url+'/twitter-block-ids').then( response=> {
        if(response.data !== 'error'){
          this.blockIds = response.data.ids;
          //console.log(this.blockIds);
        }
      });
      // main data load
      setTimeout(() => {
        
        let getData = {
          type:this.type,
          getIds:this.getids.data,
        };
        
        var getUrl = '/twitter-get-data';
        
        axios.post(this.url+getUrl,getData).then( response=> {
          //console.log(response.data);
          if(response.data.result === 'success'){
            this.resultData = response.data.getResult;
            this.loaderData = false;
            this.resultDataView = true;
          }else{
            this.resultData = response.data.getResult;
            this.loaderData = false;
            this.resultDataView = true;
          }
          
          
        });
      }, 2000); 
      
    }
  }
</script>
