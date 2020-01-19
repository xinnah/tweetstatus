<template>
	<div>
    <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <div class="form-group">
          <label for="keyword" class="col-md-12 control-label">Keyword</label>
          <div class="col-md-12">
            <input id="keyword" v-model="keyword" type="text" class="form-control" @keyup.enter="searchKeyword" name="keyword" placeholder="Type keyword" required autofocus ref="search">
          </div>
        </div>
        <div class="form-group">
          <label for="max" class="col-md-12 control-label">Minimum Followers</label>
          <div class="col-md-12">
            <input id="max" type="number" v-model="minFollower" class="form-control" name="max" max="20" min="0" required autofocus>
          </div>
        </div>
        <div class="form-group">
          <label for="max" class="col-md-12 control-label">Minimum Tweets</label>
          <div class="col-md-12">
            <input id="max" type="number" v-model="minTweet" class="form-control" name="max" max="20" min="0" required autofocus>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <button type="button" @click="searchKeyword" class="btn btn-primary btn-sm" id="search-btn">
                  Search
              </button>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="row" v-if="autoFollow">
      <div class="col-sm-offset-10">
        <button class="btn btn-success pull-right" @click="autoFollowBtn">Auto follow</button>
      </div>
    </div> -->
    <div class="row" id="search_result">
      <div class="panel panel-info" style="width: 100%;" v-if="searchResultActive">
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
                <!-- <div class="loader-datatable" id="loader-table" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div> -->
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
        keyword:'',
        minFollower:10,
        minTweet:10,
        resultData:[],
        result:true,
        autoFollow:false,
        loaderData:false,
        mutedIds:[],
        blockIds:[],
        searchResultActive:false
      }
    },
    props:['type'],
    components:{
      follow, muted, followBackRate,blocked
    },
    methods:{
      setFocus: function() {
        this.$refs.search.focus();
      },
      searchKeyword(){
        this.searchResultActive = true;
        if(this.minFollower.length < 0){
          this.minFollower = 0;
        }
        if(this.minTweet.length < 0){
          this.minTweet = 0;
        }
        if(this.keyword !== null && this.keyword !== ''){
          this.loaderData = true;
          $('html, body').animate({
            scrollTop: $("#search_result").offset().top
          }, 2000);
          let getData = {
            keyword:this.keyword,
            minFollower:this.minFollower,
            minTweet:this.minTweet
          };
          
          axios.post(this.url+'/twitter-search-result',getData).then( response=> {
            console.log(response.data);
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
        }
        
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
    }
  }
</script>