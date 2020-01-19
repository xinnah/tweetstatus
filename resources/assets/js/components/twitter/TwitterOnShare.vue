<template>
	<div>
		<notifications position="bottom right" group="shareTweet"/>
		<p style="font-size: 18px"><strong>I've found {{ data }} new follower via tweetstatus.com</strong></p>
        <button class="btn btn-info" @click="shareTwitter" style="position:relative"><i class="fab fa-twitter"></i> <b id="shareBtn">Share on Twitter</b> <div v-if="loader" class="loader-action-btn" id="loader-follow"><span><img :src="url+'/public/loader.gif'"></span></div></button>
        
	</div>
</template>
<script>
	export default {
		data() {
	      return {
	      	url:$("#base_url").val(),
	      	loader:false
	      }
	    },
	    http: {
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    },
	      
	    props:['data'],
	    methods:{
	    	shareTwitter(){
	    		this.loader = true;
	    		let getData = {
	    			content: "I've found "+this.data+" new follower via tweetstatus.com  https://www.tweetstatus.com/"
	    		}
	    		axios.post(this.url+'/twitter-on-share',getData).then( response=> {
	    			if(response.data.type === 'success'){
	    				this.$notify({
			                group: 'shareTweet',
			                title: '<i class="fa fa-check"></i> Successfully',
			                text: response.data.value,
			                type:'success'
			            });
			            $("#shareBtn").html('Sent !');
	    			}
	    			this.loader = false;
			    });
	    	}
	    },
	    mounted(){

	    },
        
  }
</script>