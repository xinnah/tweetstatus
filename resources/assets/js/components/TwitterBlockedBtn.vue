<template>
	<div class="follow_section" :id="'follow'+uid">
		<p v-if="blocked === true" class="blockedBtn btnFollow">
	        <a @click="unBlockedUser">
	          <p class="twitter-follow-unfollow success new-label  EdgeButton EdgeButton--danger"><span class="align"><i class="fas fa-ban"></i> Blocked</span></p>
	        </a>
        </p>
        <p v-else class="btnFollow">
	        <a @click="blockedUser">
	          <p class="twitter-follow-unfollow success new-label EdgeButton EdgeButton--success"><span class="align"><i class="fas fa-unlock-alt"></i> Unblocked</span></p>
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
      
        props:['uid','blocked'],

        methods:{
        	blockedUser(){
        		this.loader=true;
        		this.checkId = this.uid;
        		let getData ={
        			type:0,
        			id:this.uid
        		}
        		axios.post(this.url+'/twitter-user-block',getData).then( response=> {
        			if(response.data.result === 'success'){
                        
        				this.blocked = response.data.value;
        				
        				this.checkId = '';
        			}
                    this.loader=false;
		        });
        	},
        	unBlockedUser(){
        		this.loader=true;
        		this.checkId = this.uid;
        		let getData ={
        			type:1,
        			id:this.uid
        		}
        		axios.post(this.url+'/twitter-user-block',getData).then( response=> {
                    
        			if(response.data.result === 'success'){
        				this.blocked = response.data.value;
        				
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