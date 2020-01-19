<template>
	<div>
    <notifications position="bottom right" group="retweet"/>
    <div v-if="!loader">
      <div class="loader-datatable" id="loader-datatable"><img :src="url+'/public/loader-cycle.gif'"></div>
    </div>
    <div class="row" v-if="resultData.length > 0 && loader">
      <div class="col-sm-offset-10">
        <button class="btn btn-success pull-right" @click="autoRetweetBtn">Auto retweet</button>
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
          <tr v-if="noData">
            <td colspan="100%"> <h5 class="text-center">No retweet found!</h5> </td>
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
        loader:false,
        noData:false,
        
      }
    },
    props:['user','keyword', 'limit', 'pageno'],
    components:{
      follow
    },
    
    methods:{
      autoRetweetBtn(){
        this.resultData.forEach( (follow)=>{
          if(follow.following === true){
            $(".loader-followbtn"+follow.id).css('display','block');
            let getData ={
              type:1,
              id:follow.id
            }
            axios.post(this.url+'/twitter-autoretweet',getData).then( response=> {
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
      if(this.limit !== 0){
        setTimeout(() => {
          let keyword = JSON.parse(this.keyword);
          keyword.forEach((tag)=>{
            let getData = {
              keyword:tag,
              pno:this.pageno
            };
            axios.post(this.url+'/twitter-keyword-wise-retweet-data',getData).then( response=> {
              console.log(response.data);
              // if(response.data.status === 'success'){
              //   response.data.result.forEach((result)=>{
              //     this.resultData.push(result);
              //   });
              // }else{
              //   this.$notify({
              //     group: 'follow',
              //     title: '<i class="fas fa-exclamation-circle"></i> Error',
              //     text: response.data.result,
              //     type:'error'
              //   });
              // }
              
            });
          });
          return this.loader = true;
          if(this.resultData.length === 0){
            this.noData = true;
          }
          return this.loader = true;
        }, 4000);  
      }else{
        return this.loader = true;
        return this.noData = true;
      }
    }
  }
</script>