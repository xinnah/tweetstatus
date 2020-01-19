
require('./bootstrap');

import Vue from 'vue/dist/vue.min.js';
window.Vue = require('vue');

import PhotoGrid from 'vue-photo-grid';
 
Vue.use(PhotoGrid);

import Notifications from 'vue-notification';

Vue.use(Notifications)

import rate from 'vue-rate';
 
Vue.use(rate);
import * as VueGoogleMaps from 'vue2-google-maps';
Vue.use(VueGoogleMaps, {
    load: {
      key: 'AIzaSyCCALSYjrJyQ3R9ONak9nVMaAkOuRetWv4',
      v: '3',
      libraries: 'places', // This is required if you use the Autocomplete plugin
      // OR: libraries: 'places,drawing'
      // OR: libraries: 'places,drawing,visualization'
      // (as you require)
    }
});

import Datetime from 'vue-datetime'
// You need a specific loader for CSS files
import 'vue-datetime/dist/vue-datetime.css'
 
Vue.use(Datetime)

import HighchartsVue from "highcharts-vue";
// import Highcharts from "highcharts";
// import stockInit from "highcharts/modules/stock";

// stockInit(Highcharts);
Vue.use(HighchartsVue);
Vue.use(require('vue-moment'));

import 'vue-popperjs/dist/css/vue-popper.css';
Vue.component('Popper', require('vue-popperjs'));

import {EagleModal} from 'vue-eagle-modal'
Vue.use(EagleModal);
// import fullCalendar from 'vue-fullcalendar';
// Vue.use(fullCalendar);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


Vue.component('setup-twitter', require('./components/SetupTwitter.vue'));
Vue.component('update-twitter', require('./components/UpdateTwitter.vue'));
Vue.component('synchronizing', require('./components/twitter/Synchronizing.vue'));
Vue.component('twitter-get-data', require('./components/TwitterGetData.vue'));
Vue.component('twitter-get-load', require('./components/TwitterGetLoad.vue'));
Vue.component('twitter-search', require('./components/TwitterSearch.vue'));
Vue.component('twitter-nonfollowback', require('./components/TwitterNonFollowbackData.vue'));
Vue.component('twitter-mute-block', require('./components/TwitterMuteBlock.vue'));
Vue.component('twitter-whiteblack-list', require('./components/twitter/TwitterWhiteBlackList.vue'));
Vue.component('twitter-joined', require('./components/TwitterJoined.vue'));
Vue.component('twitter-timeline', require('./components/twitter/TwitterTimeline.vue'));
Vue.component('twitter-check-relation', require('./components/twitter/TwitterCheckRelation.vue'));
Vue.component('twitter-settings', require('./components/twitter/TwitterSettings.vue'));
Vue.component('twitter-service-follow', require('./components/twitter/TwitterServiceFollow.vue'));
Vue.component('twitter-service-unfollow', require('./components/twitter/TwitterServiceUnFollow.vue'));
Vue.component('twitter-service-retweet', require('./components/twitter/TwitterServiceRetweet.vue'));
Vue.component('post-a-tweet', require('./components/twitter/PostATweets.vue'));
Vue.component('daily-report-chart', require('./components/twitter/TwitterAutoDailyReport.vue'));
Vue.component('tweet-calendar', require('./components/twitter/TweetCalender.vue'));
Vue.component('twitter-update-btn', require('./components/twitter/UpdateBtn.vue'));
Vue.component('share-on-twitter', require('./components/twitter/TwitterOnShare.vue'));
Vue.component('footer-action', require('./components/twitter/FooterAction.vue'));

// front
Vue.component('front-checkout', require('./components/front/checkout.vue'));

const app = new Vue({
    el: '#app',
    data: {
      url:$("#base_url").val(),
      text:'back',
      datetimedata:''
        
    },
    http: {
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    },
    
    methods: {
      confirmSynchronous(){
        var pathUrl = this.url+'/public/loader-cycle.gif';
        $("#sncy-data").html('<img src="'+pathUrl+'" style="width: 30px;"> Checking if you can sync your data now...');
        setTimeout(()=>{
          axios.get(this.url+'/check-sync-data').then( response=> {
            
            if(response.data.status == 'success'){
              var result = '<div class="alert alert-success" role="alert">'+response.data.msg+'</div>';
              $("#update-btn-a").css('display', 'block');
            }else{
              var result = '<div class="alert alert-danger" role="alert">'+response.data.msg+'</div>';
            }
            $("#sncy-data").html(result);
          });
        }, 2000);
        
      }
        
    },
    mounted() {
      this.$root.$on('getTweetDate', (date) => {
        this.datetimedata = date
      })
    },
    
});
