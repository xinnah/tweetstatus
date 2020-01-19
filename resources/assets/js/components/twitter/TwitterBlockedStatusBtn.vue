<template>
    
	<div class="btn_section" :id="'block'+uid">
        
        <div v-if="block === true">
            <popper trigger="hover" :options="{ placement: 'top' }">
                <div class="popper">
                  UnBlock This User
                </div>
                <a @click="unblockUser" slot="reference">
                  <p class="twitter-block-unmunted success new-label  EdgeButton EdgeButton--danger"><span class="align"><i class="fas fa-unlock-alt"></i></span></p>
                </a>
            </popper>
            <a @click="unblockUser" class="unblocked-extra">
              <p class="twitter-block-unmunted success new-label  EdgeButton EdgeButton--danger"><span class="align"><i class="fas fa-unlock-alt"></i> &nbsp; UnBlock</span></p>
            </a>
        </div>
        <div v-else>
            <popper trigger="hover" :options="{ placement: 'top' }">
                <div class="popper">
                    Block This User
                </div>
             
                <a @click="blockUser" slot="reference">
                    <p class="twitter-block-unblock success new-label EdgeButton EdgeButton--danger"><span class="align"><i class="fas fa-ban"></i></span></p>
                </a>
            </popper>
        </div>
        <div v-if="loader && (uid === checkId)" class="loader-action-btn" id="loader-block"><span><img :src="url+'/public/loader.gif'"></span></div>
	</div>
</template>

<script>
	export default {
		data() {

            return {
            	url:$("#base_url").val(),
            	loader:false,
            	checkId:'',
                block:false

                
            }
        },
        http: {
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    },
      
        props:['uid','blockIds'],
        methods:{
        	blockUser(){
        		this.loader=true;
        		this.checkId = this.uid;
        		let getData ={
        			type:0,
        			id:this.uid
        		}
        		axios.post(this.url+'/twitter-user-block',getData).then( response=> {
                    
        			if(response.data.result === 'success'){
                        
        				this.block = response.data.value;
        				this.loader=false;
        				this.checkId = '';
                        this.$notify({
                          group: 'notificationStatus',
                          title: 'Success',
                          text: "Successfully! block this user",
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
        	},
        	unblockUser(){
        		this.loader=true;
        		this.checkId = this.uid;
        		let getData ={
        			type:1,
        			id:this.uid
        		}
        		axios.post(this.url+'/twitter-user-block',getData).then( response=> {
                    
        			if(response.data.result === 'success'){
        				this.block = response.data.value;
        				this.loader=false;
        				this.checkId = '';
                        this.$notify({
                          group: 'notificationStatus',
                          title: 'Success',
                          text: "Successfully! Unblock this user",
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
	    	var flug = 0;
            this.blockIds.forEach( (blockId)=>{
                if(parseInt(blockId) === parseInt(this.uid)){
                    flug = 1;
                }
            });
            if(flug === 1){
                this.block = true;
            }else{
                this.block = false;
            }
            
	    },
        
    }
</script>
<style>
.popper {
    width: 140px !important;
}
</style>