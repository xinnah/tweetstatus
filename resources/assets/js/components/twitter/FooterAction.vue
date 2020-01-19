<template>
	<div class="footer-action-section">
		<span class="pull-right">
			<span v-if="!loader">{{action}} ({{action}}%)</span><span v-else><img :src="url+'/public/loader.gif'"></span> of ~ action used
		</span>

	</div>
</template>
<script>
	export default {
		data() {
	      return {
	      	url:$("#base_url").val(),
	      	loader:true,
	      	action:0
	      }
	    },
	    http: {
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    },
	      
	    methods:{
	    	
	    },
	    mounted(){
	    	axios.get(this.url+'/twitter-footer-action').then( response=> {
	    		//console.log(response.data);
    			this.action = response.data;
    			this.loader = false;
		    });
	    },
        
  }
</script>