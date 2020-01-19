<template>
    
	<div class="btn_section">
        <popper trigger="hover" :options="{ placement: 'top' }">
            <div class="popper">
                Add Whitelist
            </div>
         
            <a @click="whitelistUser" slot="reference">
                <p class="twitter-whitelist-unwhitelist success new-label EdgeButton EdgeButton--info"><span class="align"><i class="fas fa-plus-circle"></i></span></p>
            </a>
        </popper>
        <div v-if="loader && (uid === checkId)" class="loader-action-btn" id="loader-whitelist"><span><img :src="url+'/public/loader.gif'"></span></div>
	</div>
</template>

<script>
	export default {
		data() {

            return {
            	url:$("#base_url").val(),
            	loader:false,
            	checkId:'',

                
            }
        },
        http: {
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    },
      
        props:['uid'],
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
                    this.checkId = '';
		        });
        	},

        },
        mounted(){
	    	 
	    },
        
    }
</script>
<style>
.popper {
    width: 140px !important;
}
</style>