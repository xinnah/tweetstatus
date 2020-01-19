<template>
	<div class="follow_section" :id="'follow'+uid">
		<p v-if="whitelist === true" class="whitelistBtn btnFollow">
	        <a @click="unWhitelistUser">
	          <p class="twitter-listed success new-label  EdgeButton EdgeButton--info"><span class="align"><i class="fas fa-minus-circle"></i>  UnWhitelist</span></p>
	        </a>
        </p>
        <p v-else class="btnFollow">
	        <a @click="whitelistUser">
	          <p class="twitter-listed success new-label EdgeButton EdgeButton--info"><span class="align"><i class="fas fa-plus-circle"></i>  Whitelist</span></p>
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
      
        props:['uid','whitelist'],

        methods:{
        	whitelistUser(){
        		this.loader=true;
        		this.checkId = this.uid;
        		let getData ={
        			type:0,
        			twitter_id:this.uid
        		}
        		axios.post(this.url+'/twitter-user-whitelist',getData).then( response=> {
        			if(response.data.type === 'success'){
        				this.whitelist = true;
        				
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
        	unWhitelistUser(){
        		this.loader=true;
        		this.checkId = this.uid;
        		let getData ={
        			type:1,
        			twitter_id:this.uid
        		}
        		axios.post(this.url+'/twitter-user-whitelist',getData).then( response=> {
                    
        			if(response.data.type === 'success'){
        				this.whitelist = false;
        				this.loader=false;
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
		        });
        	}

        },
        mounted(){
	    	
		    
	    },
        
    }
</script>