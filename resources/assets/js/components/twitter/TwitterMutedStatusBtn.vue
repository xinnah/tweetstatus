<template>
    
	<div class="btn_section" :id="'muted'+uid">
        
        <popper v-if="muted === true" trigger="hover" :options="{ placement: 'top' }">
            <div class="popper">
              UnMute This User
            </div>
            <a @click="unMutedUser" slot="reference">
              <p class="twitter-muted-unmunted success new-label  EdgeButton EdgeButton--warning"><span class="align"><i class="fas fa-volume-up"></i></span></p>
            </a>
        </popper>
        <popper v-else trigger="hover" :options="{ placement: 'top' }">
            <div class="popper">
                Mute This User
            </div>
         
            <a @click="mutedUser" slot="reference">
                <p class="twitter-muted-unmuted success new-label EdgeButton EdgeButton--warning"><span class="align"><i class="fas fa-volume-off"></i></span></p>
            </a>
        </popper>
        <div v-if="loader && (uid === checkId)" class="loader-action-btn" id="loader-muted"><span><img :src="url+'/public/loader.gif'"></span></div>
	</div>
</template>

<script>
	export default {
		data() {

            return {
            	url:$("#base_url").val(),
            	loader:false,
            	checkId:'',
                muted:false

                
            }
        },
        http: {
	        headers: {
	            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	        }
	    },
      
        props:['uid','mutedIds'],
        methods:{
        	mutedUser(){
        		this.loader=true;
        		this.checkId = this.uid;
        		let getData ={
        			type:0,
        			id:this.uid
        		}
        		axios.post(this.url+'/twitter-user-mute',getData).then( response=> {
        			if(response.data.result === 'success'){
                        
        				this.muted = response.data.value;
        				this.loader=false;
        				this.checkId = '';
                        this.$notify({
                          group: 'notificationStatus',
                          title: 'Success',
                          text: "Successfully! Mute this user",
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
        	unMutedUser(){
        		this.loader=true;
        		this.checkId = this.uid;
        		let getData ={
        			type:1,
        			id:this.uid
        		}
        		axios.post(this.url+'/twitter-user-mute',getData).then( response=> {
                    
        			if(response.data.result === 'success'){
        				this.muted = response.data.value;
        				this.loader=false;
        				this.checkId = '';
                        this.$notify({
                          group: 'notificationStatus',
                          title: 'Success',
                          text: "Successfully! UnMute this user",
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
            this.mutedIds.forEach( (muteId)=>{
                if(parseInt(muteId) === parseInt(this.uid)){
                    flug = 1;
                }
            });
            if(flug === 1){
                this.muted = true;
            }else{
                this.muted = false;
            }
            
	    },
        
    }
</script>
<style>
.popper {
    width: 140px !important;
}
</style>