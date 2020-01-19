<template>
	<div>
    <notification></notification>

    <div v-if="loaderData" class="loader-datatable" id="loader-datatable"><img :src="url+'/public/loader-cycle.gif'"></div>

		<div class="content_section" id="table-get-data" style="display:none">
      <table id="data-table" class="table table-striped table-bordered nowrap">
        <thead>
          <tr>
            <th>Name</th>
            <th width="30%">Action</th>
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
            
            <td class="text-right table-buttons">
              <div class="btn-group">
                <follow :uid="data.id" :following="data.following"></follow>
                <whitelist :uid="data.id"></whitelist>
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
  import whitelist from './twitter/WhitelistStatusBtn.vue';
  import notification from './NotificationMsg.vue';
  export default {
    data(){
      return {
        url:$("#base_url").val(),
        resultData:[],
        paginate:0,
        loaderData:true,
        moreLoadBtn:false,
        pageNo:1,
        perpage:90,
        next:false
      }
    },
    components:{
      follow, whitelist, notification
    },
    methods:{
      moreLoad(){
        let getData = {
          start:this.pageNo + 1,
          perPage:this.perpage,
        };
        var getUrl = '/twitter-get-nonfollowback';
        this.next = false;
        this.moreLoadBtn = true;
        axios.post(this.url+getUrl,getData).then( response=> {
          
          if(response.data){
            response.data.result.forEach( (resultData)=>{
              this.resultData.push(resultData);

            });
            
            if(response.data.result.length > 0){
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
      if(this.url){
        let getData = {
          start:1,
          perPage:this.perpage,
        };
        var getUrl = '/twitter-get-nonfollowback';
        
        axios.post(this.url+getUrl,getData).then( response=> {
          if(response.data){
            this.resultData = response.data.result;
            if(response.data.result.length > 0){
              this.next = true;
            }
            this.loaderData = false;
            $("#table-get-data").css('display','block');
          }
            
        });
      }
    }
  }
</script>