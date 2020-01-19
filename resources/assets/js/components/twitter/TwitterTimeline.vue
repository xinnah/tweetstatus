<template>
	<div>
		<div v-if="!checkLoad">
			<div v-for="(post) in posts" class="panel panel-default" style="margin-bottom:5px">
				<div class="panel-body">
					<vcl-facebook></vcl-facebook>
				</div>
			</div>
		</div>
		<div v-for="(post,index) in posts" v-if="checkLoad">
  	        
	        <div class="panel panel-default" style="margin-bottom:5px">
			  	<div v-if="post && post.retweeted_status" :class="'panel-body post_section_'+post.id" >
			    	<div class="single_post_top">
						<div class="user_profile">
					        <img :src="post.retweeted_status.user.profile_image_url">
					    </div>
					   	<div class="user_info font14">
					        <a class="userlink capitalize font20"><strong>{{post.retweeted_status.user.name}}</strong> </a> <span v-if="post.retweeted_status.user.verified===true" class="fa fa-stack" style="color: #1b95e0"><i class="fa fa-certificate fa-stack-2x"></i><i class="fa fa-check fa-stack-1x fa-inverse"></i></span> <span> @{{post.retweeted_status.user.screen_name}}</span>
					        . {{post.retweeted_status.created_at}}
					        <!-- <div v-if="post">
					        	<a :href="url+'/'" class="show_time">time</a>
					        </div>  -->
					    </div>
				    </div><!--  end top -->
				    <div v-if="post" :class="'single_post_body post-body'+post.id">
				      <div class="post_description" :id="'post-content-text'+post.id">
				        {{post.retweeted_status.text}}
				      </div>
						<div v-if="post.entities.media">
							
							<photo-grid :box-height="'250px'" :box-width="'100%'">
						      <img  v-for="(file, index) in post.entities.media" v-bind:src="file.media_url" />
						  	</photo-grid>
						</div>
				    </div><!-- end body -->
				    <hr>
				    <div class="single_post_bottom">
				      
				      <div class="like_comment_section">
				        <span><i class="fas fa-retweet"></i> retweets {{post.retweeted_status.retweet_count}}</span> &nbsp; | &nbsp; <span><i class="fas fa-heart"></i> favorites {{post.retweeted_status.favorite_count}}</span>
				        
				      </div>
				    </div>
				    
				</div>
				<div v-else :class="'panel-body post_section_'+post.id" >
			    	<div class="single_post_top">
						<div class="user_profile">
					        <img :src="post.user.profile_image_url">
					    </div>
					   	<div class="user_info font14">
					        <a class="userlink capitalize font20"><strong>{{post.user.name}}</strong> </a> <span v-if="post.user.verified===true" class="fa fa-stack" style="color: #1b95e0"><i class="fa fa-certificate fa-stack-2x"></i><i class="fa fa-check fa-stack-1x fa-inverse"></i></span> <span> @{{post.user.screen_name}}</span>
					        . {{post.created_at}}
					        <!-- <div v-if="post">
					        	<a :href="url+'/'" class="show_time">time</a>
					        </div>  -->
					    </div>
				    </div><!--  end top -->
				    <div v-if="post" :class="'single_post_body post-body'+post.id">
				      <div class="post_description" :id="'post-content-text'+post.id">
				        {{post.text}}
				      </div>
						<div v-if="post.entities.media">
							
							<photo-grid :box-height="'250px'" :box-width="'100%'">
						      <img  v-for="(file, index) in post.entities.media" v-bind:src="file.media_url" />
						  	</photo-grid>
						</div>
				    </div><!-- end body -->
				    <hr>
				    <div class="single_post_bottom">
				      
				      <div class="like_comment_section">
				        <span><i class="fas fa-retweet"></i> retweets {{post.retweet_count}}</span> &nbsp; | &nbsp; <span><i class="fas fa-heart"></i> favorites {{post.favorite_count}}</span>
				        
				      </div>
				    </div>
				    
				</div>
			</div>
  	        
  	    </div>
	</div>
</template>

<script>
	//loading 
	import { VclFacebook, VclInstagram } from 'vue-content-loading';
	//loading
	
	export default {

		props:['posts'],
        data() {

            return {
                url:$("#base_url").val(),
                 
                checkLoad:false,
                posts: [],
                
            }
        },
        
        methods:{
        	

            
        },
        
        
        components:{
        	VclFacebook,VclInstagram
        },
        

        mounted(){
        
        	setTimeout(() => {
		    	return this.checkLoad = true;
		    }, 2000); 
		    
	    }
    }
</script>
