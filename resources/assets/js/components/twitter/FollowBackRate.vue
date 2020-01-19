<template>
	<rate :length="5" :value="followRate" :readonly="true" />
</template>

<script>
	export default {
		data() {

            return {
            	url:$("#base_url").val(),   
            }
        },
        
        props:['follower','following'],
        computed: {
          followRate(){
            var result = 0;
            if(this.follower < this.following){
                return result = 5;
            }else{
                var data = Math.round(this.follower/this.following);
                result = 5 - data;
                return result; 
            }
            
          }

        },
        methods:{
        	

        },
        mounted(){
	    	
            
	    },
        
    }
</script>