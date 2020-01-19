<template>
	<div>
    <notifications position="bottom right" group="follow"/>
    <div v-if="!loader">
      <div class="loader-datatable" id="loader-datatable"><img :src="url+'/public/loader-cycle.gif'"></div>
    </div>
    <div class="row" v-if="resultData.length > 0 && loader">
      <div class="col-sm-offset-10">
        <button class="btn btn-success pull-right" @click="autoFollowBtn">Auto follow</button>
      </div>
    </div>
    <div class="row" v-if="loader">
      <div class="search_result_content_section" id="table-get-data">
        <table id="data-table" class="table table-striped table-bordered nowrap">
          <thead>
            <tr>
              <th>Name</th>
              <th>Followers</th>
              <th>Following</th>
              <th>Listed</th>
              <th width="20%">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="data in resultData" id="load-tdoby">
              <td>
                <div class="twitter-media row">
                  <div class="twitter_get_image col-sm-2">
                    <img class="" :src="data.profile_image_url">
                  </div>
                  <div class="twitter_get_content col-sm-10">
                    <a target="_blank" :href="'https://twitter.com/'+data.screen_name" class="">{{ data.name }}</a>
                    <br>
                    <span><a target="_blank" :href="'https://twitter.com/'+data.screen_name">@{{ data.screen_name }}</a></span>
                  </div>
                </div>
              </td>
              <td>{{ data.followers_count }}</td>
              <td>{{ data.friends_count }}</td>
              <td>{{ data.listed_count }}</td>
              <td>
                <div class="followbtn" :id="'btn'+data.id">
                  <div class="btn-group">
                    <follow :uid="data.id" :following="data.following"></follow>
                  </div>
                  <div :class="'loader-followbtn'+data.id" id="loader-follow-auto" style="display:none"><span><img :src="url+'/public/loader.gif'"></span></div>
                </div>
              </td>
            </tr>
            <tr v-if="noUser">
              <td colspan="100%"> <h5 class="text-center">No user found!</h5> </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
	</div>
</template>
<script>
  import follow from './../TwitterFollowBtn.vue';
  export default {
    data(){
      return {
        url:$("#base_url").val(),
        keyword:'',
        resultData:[],
        loader:false,
        noUser:false
      }
    },
    props:['user','tags','pageno'],
    components:{
      follow
    },
    methods:{
      autoFollowBtn(){
        this.resultData.forEach( (follow)=>{
          setTimeout(() => {
            if(follow.following === false){
              $(".loader-followbtn"+follow.id).css('display','block');
              let getData ={
                type:0,
                id:follow.id
              }
              axios.post(this.url+'/twitter-autofollow',getData).then( response=> {
                if(response.data.result === 'success'){
                  follow.following = response.data.value;
                  $(".loader-followbtn"+follow.id).css('display','none');
                } 
              });

            }
          }, 4000);
        });
      }
    },
    mounted() {
      setTimeout(() => {
        let tags = JSON.parse(this.tags);
        tags.forEach((tag)=>{
          let getData = {
            keyword:tag,
            pno:this.pageno
          };
          axios.post(this.url+'/twitter-keyword-wise-follow-data',getData).then( response=> {
            if(response.data.status === 'success'){
              response.data.result.forEach((result)=>{
                this.resultData.push(result);
              });
            }else{
              this.$notify({
                group: 'follow',
                title: '<i class="fas fa-exclamation-circle"></i> Error',
                text: response.data.result,
                type:'error'
              });
            }
            
          });
        });
        return this.loader = true;
        if(this.resultData.length === 0){
          this.noUser = true;
        }
      }, 4000); 
      
    }
  }
</script>