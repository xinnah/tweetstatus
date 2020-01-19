<template>
	<div>
		<div class="overlay-modal overlay-modal-calender" style="margin-left: 0px; display: none;">
	      <div class="travel_dialog show_travel_modal">
	        <div class="fade-box-calender fade-box">
	          <div class="inner_gray clearfix">
	            <div class="inner_gray_text">
	            calender 
	            </div>
	            <div class="inner_gray_close_button">
	              <a href="#" class="close cancel_modal" role="button" title="Close">Close</a>
	            </div>
	          </div>
	          <div class="inner_body">
	            <div class="inner_body_content">
	              <div class="row">
	                <div class="form-group">
	                  <label for="Date" class="col-md-4 control-label">Schedule date</label>
	                  <div class="col-md-8 no_padding">
	                    <datetime
	                      type="datetime"
	                      v-model="datetimedata"
	                      value-zone="Asia/Dhaka"
	                      zone="Asia/Dhaka"
	                      :format="{ year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit' }"
	                      :phrases="{ok: 'Continue', cancel: 'Exit'}"
	                      use12-hour
	                      auto
	                      ></datetime>
	                  </div>
	                </div>
	                <input type="hidden" value="" name="currentDate">
	                <input type="hidden" value="" name="currentTime">
	                <div class="form-group">
	                  <label for="content" class="col-md-4 control-label">Content</label>
	                  <div class="col-md-8 no_padding">
	                    <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
	                  </div>
	                </div>
	                
	                <div class="form-group">
	                  <div class="col-md-6 col-md-offset-4">
	                    <button type="submit" class="btn btn-success btn-sm" id="search-btn" >
	                      Tweet
	                    </button>
	                  </div>
	                </div>
	                
	              </div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	</div>
</template>
<script>
  	import moment from 'moment';
  	import { Datetime } from 'vue-datetime';
	import 'vue-datetime/dist/vue-datetime.css'
	 

	export default {
		data() {
    	return {
      	url:$("#base_url").val(),
        datetimedata:''
      }
    },
    props:[],
    components:{
      datetime: Datetime
    },
    
    methods:{
      
    },
    mounted(){
    	
    },
        
  }
</script>
