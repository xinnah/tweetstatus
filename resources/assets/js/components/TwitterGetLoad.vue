<template>
	<div>
    <notification></notification>
    
    <div v-if="loaderData" class="loader-datatable" id="loader-datatable"><img :src="url+'/public/loader-cycle.gif'"></div>

		<div class="content_section" id="table-get-data" style="display:none">
      <table id="data-table" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>Name</th>
            <th>Followers</th>
            <th>Following</th>
            <th>Follow-Back Rate</th>
            <th width="33%">Action</th>
          </tr>
        </thead>
        <tbody>
          
          <tr v-for="data in resultData" id="load-tdoby">
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
                <backlist v-if="type === 'i-dont-followback'" :uid="data.id_str"></backlist>
                <whitelist v-if="type === 'non-followback'" :uid="data.id_str"></whitelist>
              </div>
            </td>
          </tr>
          
        </tbody>
      </table>
      <div class="row">
        <div class="loader-datatable">
          <div class="next_load" v-if="next">
            <a @click="moreLoad" class="btn btn-info" aria-label="Next">
              <span sr-only="true">&raquo;</span>
              <span aria-hidden="true">Next</span>
            </a>
          </div>
          <div class="loader-datatable" id="loader-table" v-if="moreLoadBtn"><img :src="url+'/public/loader.gif'"></div>
        </div>
      </div>
        
    </div>

	</div>
</template>
<script>
  import follow from './TwitterFollowBtn.vue';
  import muted from './twitter/TwitterMutedStatusBtn.vue';
  import blocked from './twitter/TwitterBlockedStatusBtn.vue';
  import followBackRate from './twitter/FollowBackRate.vue';
  import backlist from './twitter/BacklistStatusBtn.vue';
  import whitelist from './twitter/WhitelistStatusBtn.vue';
  import notification from './NotificationMsg.vue';
  export default {
    data(){
      return {
        url:$("#base_url").val(),
        resultData:[],
        paginate:0,
        pageNo:1,
        perpage:80,
        loaderData:true,
        moreLoadBtn:false,
        next:false,
        mutedIds:[],
        blockIds:[]
      }
    },
    props:['type'],
    components:{
      follow, muted, followBackRate, blocked, backlist, whitelist, notification
    },
    methods:{
      moreLoad(){
        let getData = {
          type:this.type,
          start:this.pageNo + 1,
          perPage:this.perpage,
        };
        var getUrl = '/twitter-get-load';
        this.next = false;
        this.moreLoadBtn = true;
        axios.post(this.url+getUrl,getData).then( response=> {
          if(response.data.result === 'success'){
            response.data.getResult.forEach( (resultData)=>{
              this.resultData.push(resultData);
            });
            if(response.data.getResult.length > 0){
              this.next = true;
            }
            this.moreLoadBtn = false;
            $("#table-get-data").css('display','block');
            this.pageNo = this.pageNo + 1;
          }
            
        });
      }
      
      
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
      setTimeout(() => {
        let getData = {
          type:this.type,
          start:1,
          perPage:this.perpage,
        };
        var getUrl = '/twitter-get-load';
        
        axios.post(this.url+getUrl,getData).then( response=> {
          //console.log(response.data);
          if(response.data.result === 'success'){
            this.resultData = response.data.getResult;
            if(response.data.getResult.length > 0){
              this.next = true;
            }
            this.loaderData = false;
            $("#table-get-data").css('display','block');
            this.pageNo = 1;

          }
            
        });
      }, 2000); 
    }
  }
</script>