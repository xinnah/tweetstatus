<template>
	<div>
    <notifications position="bottom right" group="retweet"/>
    <div class="calender_show">
      <full-calendar :events="events" @eventClick="eventClick" @dayClick="dayClick"></full-calendar>
      <div style="display: none;" class="pop-outer">
          <div class="pop-inner">
            <div class="row">
              <div class="col-sm-10 no_padding">
                <div id="tweet-content"></div>
                <input type="hidden" id="tweet-id" value="">
              </div>
              <div class="col-sm-2">
                <div class="tweet-btn">
                  <button class="btn btn-danger btn-xs close_show tweet_model_btn"><i rel="tooltip" data-placement="top" title="Close" class="fas fa-times has-tip" data-container="body"></i></button>
                  <br>
                  <a @click="editTweet" class="btn btn-info btn-xs tweet_model_btn"><i rel="tooltip" data-placement="top" title="Edit tweet" class="fa fa-edit has-tip" data-container="body" aria-hidden="true"></i></a>
                  <br>
                  <button v-on:click="deleteTweet" class="btn btn-danger btn-xs tweet_model_btn"><i rel="tooltip" data-placement="top" title="Delete tweet" class="fa fa-trash has-tip" data-container="body" aria-hidden="true"></i></button>
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
	export default {
		data() {
    	return {
      	url:$("#base_url").val(),
      	events: [],
	      editable:true,
        datetimedata:''
      }
    },
    props:['events'],
    components:{
      'full-calendar': require('vue-fullcalendar'),
    },
    
    methods:{
      eventClick(e) {
        var time = moment(e.time, 'HH:mm:ss').format('h:mm A');
        $(".pop-outer").fadeIn("slow");
        $("#tweet-content").html('<h4>'+e.start+' '+time+'</h4><h4>'+e.content+'</h4>')
        $("#tweet-id").val(e.id);
      },
      dayClick(day){
        var selectDate = moment(day).format('YYYY-MM-DD');
        this.$root.$emit('getTweetDate', selectDate);
        var height = $(".show_travel_modal").height();
        $(".travel_dialog").css("min-height", "90px");
        $(".overlay-modal-calender").show();
        
        this.datetimedata = selectDate;
        $(".show_travel_modal").css("width", "225").animate({
            "opacity" : 1,
            height : "auto",
            width : "448"
        }, 600, function() {
            /*When animation is done show inside content*/
          $(".fade-box").show();
        });
        
      },
      editTweet(){
        var id = $("#tweet-id").val();
        window.location.href= this.url+'/twitter-tweets/'+id+'/edit';
      },
      deleteTweet(){
        var id = $("#tweet-id").val();
        if(confirm("Do You Sure Want To Delete This Data ?")){
          axios.delete(this.url+'/twitter-tweets/'+id).then( response=> {
            //
          });
          window.location.href= this.url+'/twitter-schedule-tweets';
        }
      },

    },
    mounted(){
    
    },
        
  }
</script>
<style>
.pop-outer {
      background-color: rgba(0, 0, 0, 0.5);
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index:1
  }
  .pop-inner {
      background-color: #fff;
      width: 300px;
      height: auto;
      padding: 25px;
      margin: 15% auto;
      text-align: center;
  }
</style>
