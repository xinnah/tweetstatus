<template>
	<div>
    <div class="row" id="search_result">
      <div class="panel panel-info" style="width: 100%;">
        <div class="panel-heading">Recent Results for {{keyword}}</div>
        <div class="panel-body">
          <div class="search_result_content_section" id="table-get-data" v-if="result">
            <table id="data-table" class="table table-striped table-bordered nowrap">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Followers</th>
                  <th>Following</th>
                  <th>Follow-Back Rate</th>
                  <th width="28%">Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="loaderData">
                  <td colspan="100%"><div class="loader-datatable" id="loader-datatable"><img :src="url+'/public/loader-cycle.gif'"></div></td>
                </tr>
                <tr v-for="data in resultData" id="load-tdoby" v-if="!loaderData">
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
                      <follow :uid="data.id" :following="data.following"></follow>
                      <blocked :uid="data.id" :blockIds="blockIds"></blocked>
                      <muted :uid="data.id" :mutedIds="mutedIds"></muted>
                    </div>
                  </td>
                </tr>
                <tr v-if="this.resultData.length===0 && !loaderData">
                  <td colspan="100%"> <h5 class="text-center">No user found!</h5> </td>
                </tr>
              </tbody>
            </table>
          </div>
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
  export default {
    data(){
      return {
        url:$("#base_url").val(),
        resultData:[],
        result:true,
        autoFollow:false,
        loaderData:true,
        mutedIds:[],
        blockIds:[],
        //searchResultActive:true
      }
    },
    props:['keyword', 'location', 'minfollower', 'mintweets'],
    components:{
      follow, muted, followBackRate,blocked
    },
    methods:{
      setFocus: function() {
        this.$refs.search.focus();
      },
      searchKeyword(){
        let getData = {
          keyword:this.keyword,
          location:this.location,
          minFollower:this.minfollower,
          minTweet:this.mintweets
        };
        
        axios.post(this.url+'/twitter-search-result',getData).then( response=> {
          
          if(response.data.type === 'success'){
            if(response.data.value.length > 0){
              this.resultData = response.data.value;
              this.autoFollow = true;
            }else{
              this.autoFollow = false;
            }
            this.loaderData = false;
          }
            
        });
        
        
      },
      autoFollowBtn(){
        this.resultData.forEach( (follow)=>{
          if(follow.following === false){
            $(".loader-followbtn"+follow.id).css('display','block');
            let getData ={
              type:0,
              id:follow.id
            }
            axios.post(this.url+'/twitter-follow',getData).then( response=> {
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
      $('html, body').animate({
        scrollTop: $("#search_result").offset().top
      }, 2000);
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

      //
      this.searchKeyword();
    }
  }
</script>