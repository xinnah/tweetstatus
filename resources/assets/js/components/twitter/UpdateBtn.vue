<template>
	
	<div>
		<img :src="url+'/public/loader-cycle.gif'" style="width: 30px;"> Checking if you can sync your data now...
	</div>
		
	
</template>

<script>
	export default {
		data() {
	      return {
	      	url:$("#base_url").val(),
	      }
	    },
	    http: {
	      headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    },
	    methods:{
	    	confirmSynchronous(){

	    	},
	    },
	    mounted(){
	    	console.log('hello');
	    },
        
  	}
</script>
<style>
.emodal {height: 250px !important;}
.emodal .content {margin: 0 !important;padding: 0;}
.emodal header {padding: 10px 20px;}
.emodal .wrap {height: 150px; margin:0}
</style>