<template>
	<div class="follow_section" :id="'follow'+uid">
		<p v-if="blacklist === true" class="blacklistBtn btnFollow">
      <a @click="unblacklistUser">
        <p class="twitter-listed success new-label  EdgeButton EdgeButton--inverse"><span class="align"><i class="fas fa-minus-circle"></i>  Unblacklist</span></p>
      </a>
    </p>
    <p v-else class="btnFollow">
      <a @click="blacklistUser">
        <p class="twitter-listed success new-label EdgeButton EdgeButton--inverse"><span class="align"><i class="fas fa-plus-circle"></i>  blacklist</span></p>
      </a>
    </p>
    <div v-if="loader && (uid === checkId)" class="loader-datatable" id="loader-follow"><span><img :src="url+'/public/loader.gif'"></span></div>
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
      
    props:['uid','blacklist'],

    methods:{
    	blacklistUser(){
    		this.loader=true;
    		this.checkId = this.uid;
    		let getData ={
    			type:0,
    			twitter_id:this.uid
    		}
    		axios.post(this.url+'/twitter-user-blacklist',getData).then( response=> {
    			if(response.data.type === 'success'){
    				this.blacklist = true;
    				
    				this.checkId = '';
            this.$notify({
              group: 'notificationStatus',
              title: 'Success',
              text: response.data.value,
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
    	unblacklistUser(){
    		this.loader=true;
    		this.checkId = this.uid;
    		let getData ={
    			type:1,
    			twitter_id:this.uid
    		}
    		axios.post(this.url+'/twitter-user-blacklist',getData).then( response=> {
                
    			if(response.data.type === 'success'){
    				this.blacklist = false;
    				
    				this.checkId = '';
            this.$notify({
              group: 'notificationStatus',
              title: 'Success',
              text: response.data.value,
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
    	}

    },
    mounted(){
  	
    
    },
        
  }
</script>