<template>
	<div>
		<button type="button" @click="postTweetSection" class="btn btn-info modal-btn-home">Post a tweet</button>
		<eModal v-model='modal' ref='modal'></eModal>
	</div>
</template>

<script>
import {eModal} from 'vue-eagle-modal'
	export default {
		data() {
      return {
      	url:$("#base_url").val(),
      	modal:{
          title: 'Title',
          items: [
            {
              label: 'test',
              type:'text',
              name: 'e1',
              value: 'test'
            }
          ],
        }
      }
    },
    http: {
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
      
    props:['content'],
 	components: {eModal},
    methods:{
    	postTweetSection(){
    		let m = this.$modals.add({
			    title: 'Post Tweet',
			    theme: 'osx', // || mojave
			    items:[
		          {
		              //label: 'Bio',
		              name: 'content',
		              type: 'textarea',
		              value: this.content,
		          }
		      	],
			  });
			  m.open();
			  
			  m.onsave( (m) => {
			  	m.loading();
			  	setTimeout(() => {
			  		let getItems = m.getItems();
			  		let getData ={
		    			content: getItems[0].value
		    		}
		    		axios.post(this.url+'/twitter-tweets-hot-topics',getData).then( response=> {
		    			m.loaded();
			    		m.close();
			    		console.log(response.data);
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
			        });
			      	//console.log(m.formData())
			      	
			    },500)
			  })

    	},

    },
    mounted(){

    },
        
  }
</script>
<style>
.emodal {height: 250px !important;}
.emodal .content {margin: 0 !important;padding: 0;}
.emodal header {padding: 10px 20px;}
.emodal .wrap {height: 150px; margin:0}
</style>