<template>
	<div class="follow_section" :id="'follow'+uid">
		<p v-if="muted === true" class="mutedBtn btnFollow">
	        <a @click="unMutedUser">
	          <p class="twitter-follow-unfollow success new-label  EdgeButton EdgeButton--warning"><span class="align"><i class="fas fa-volume-off"></i>  Muted</span></p>
	        </a>
        </p>
        <p v-else class="btnFollow">
	        <a @click="mutedUser">
	          <p class="twitter-follow-unfollow success new-label EdgeButton EdgeButton--danger"><span class="align"><i class="fas fa-volume-up"></i>  Unmuted</span></p>
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
      
        props:['uid','muted'],

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
        				this.checkId = '';
        			}
                    this.loader=false;
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
        				this.checkId = '';
        			}
                    this.loader=false;
		        });
        	}

        },
        mounted(){
	    	
		    
	    },
        
    }
</script>