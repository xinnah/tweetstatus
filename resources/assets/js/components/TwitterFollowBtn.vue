<template>
	<div class="btn_section" :id="'follow'+uid">
		<p v-if="following === true" class="followingBtn btnFollow">
	        <a @click="unfollowing">
	          <p class="twitter-follow-unfollow success new-label EdgeButton EdgeButton--success"><span class="align"><i class="fas fa-link"></i> Following</span></p>
	        </a>
        </p>
        <p v-else class="btnFollow">
	        <a @click="follow">
	          <p class="twitter-follow-unfollow success new-label EdgeButton EdgeButton--info"><span class="align"><i class="fas fa-user-plus"></i> Follow</span></p>
	        </a>
        </p>
        <div v-if="loader && (uid === checkId)" class="loader-action-btn" id="loader-follow"><span><img :src="url+'/public/loader.gif'"></span></div>
	</div>
</template>

<script>
	export default {
		data() {

      return {
      	url:$("#base_url").val(),
      	loader:false,
      	checkId:''
      }
    },
    http: {
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
      
    props:['uid','following'],

    methods:{
    	follow(){
    		this.loader=true;
    		this.checkId = this.uid;
    		let getData ={
    			type:0,
    			id:this.uid
    		}
    		axios.post(this.url+'/twitter-follow',getData).then( response=> {

    			if(response.data.result === 'success'){
                    
    				this.following = response.data.value;
    				
    				this.checkId = '';
            this.$notify({
              group: 'notificationStatus',
              title: 'Success',
              text: "Successfully! Following this user",
              type:'success'
            });
    			}else{
            this.$notify({
              group: 'notificationStatus',
              title: 'Error',
              text: response.data.value,
              type:'error'
            });
          }
          this.loader=false;
        });
    	},
    	unfollowing(){
    		this.loader=true;
    		this.checkId = this.uid;
    		let getData ={
    			type:1,
    			id:this.uid
    		}
    		axios.post(this.url+'/twitter-follow',getData).then( response=> {
                
    			if(response.data.result === 'success'){
    				this.following = response.data.value;
    				this.loader=false;
    				this.checkId = '';
            this.$notify({
              group: 'notificationStatus',
              title: 'Success',
              text: "Successfully! UnFollowing this user",
              type:'success'
            });
    			}else{
            this.$notify({
              group: 'notificationStatus',
              title: 'Error',
              text: "Something wrong, please try again.",
              type:'error'
            });
          }
        });
    	}

    },
    mounted(){
	    	  
	  },
        
  }
</script>