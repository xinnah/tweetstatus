<template>
	<div>
    <notifications position="bottom right" group="settings"/>
    <div v-if="!loader">
      <div class="loader-datatable" id="loader-datatable"><img :src="url+'/public/loader-cycle.gif'"></div>
    </div>
    <div class="row" v-if="loader">
      <div class="headline-setting col-sm-6 col-sm-offset-3"><h4 class="text-center">{{user.name}}</h4></div>
      <hr>
      <div class="headline-setting col-sm-10 col-sm-offset-1"><a :href="url+'/twitter-settings'" type="button" class="btn btn-primary"><i class="fa fa-arrow-left"></i> back to Setting</a></div>
      <div class="col-sm-12">
        <div class=" panel-default">
          <div class="panel-body">
            <div class="form-group">
              <label for="keyword" class="col-sm-3 control-label"><br> Search keyword</label>
              <div class="col-sm-9">
                <b class="error_msg"><i  class="fas fa-success"></i> Your max keyword is {{hashtag}}</b>
                <input-tag v-model="search_keyword" limit="hashtag" placeholder="type keyword and press enter" autofocus></input-tag>

                <b v-if="keywordError" class="error_msg"><i  class="fas fa-exclamation-circle"></i> {{keywordMsg}}</b>
              </div>
            </div>
            
            <div class="form-group">
              <label for="location" class="col-md-3 control-label">Location</label>
              <div class="col-md-9">
                <gmap-autocomplete @place_changed="setPlace" v-model="location" class="form-control" id="location" placeholder="Type the location...">
                </gmap-autocomplete>
              </div>
            </div>
            <div class="form-group">
              <label for="avoid_account" class="col-sm-3 control-label">Avoid these accounts </label>
              <div class="col-sm-9">
                <input-tag v-model="avoid_account" id="avoid_account" placeholder="screen_name1, screen_name2" autofocus></input-tag>
              </div>
            </div>
            
            <div class="form-group">
              <div class="checkbox checkbox-css col-md-3">
                <input type="checkbox" id="ration" v-model="ratioStatus">
                <label for="ration" class="control-label">Followers / Following ratio</label>
              </div>
              <div class="col-md-8">
                <vue-slider :disabled="!ratioStatus" v-model="following_ratio" min="0" max="5" ></vue-slider>
              </div>
              <div class="col-sm-1 no_padding">
                {{following_ratio}} ( 0 to 5 star)
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox checkbox-css col-md-3 mt33">
                <input type="checkbox" id="following_count" v-model="followingCStatus" >
                <label for="following_count" class="control-label">Following count</label>
              </div>
              <div class="col-md-9">
                <vue-slider :disabled="!followingCStatus" ref="slider" v-model="followingValue" v-bind="optionsK"></vue-slider>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox checkbox-css col-md-3 mt33">
                <input type="checkbox" id="Followers_count" v-model="followerCStatus" >
                <label for="Followers_count" class="control-label">Followers count</label>
              </div>
              <div class="col-md-9">
                <vue-slider :disabled="!followerCStatus" ref="slider" v-model="followerValue" v-bind="optionsK"></vue-slider>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox checkbox-css col-md-3 mt33">
                <input type="checkbox" id="tweet_count" v-model="tweetCStatus" >
                <label for="tweet_count" class="control-label">Tweet count</label>
              </div>
              <div class="col-md-9">
                <vue-slider :disabled="!tweetCStatus" ref="slider" v-model="tweetValue" v-bind="optionsK"></vue-slider>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox checkbox-css col-md-3 mt6">
                <input type="checkbox" id="account_age" v-model="ageStatus" >
                <label for="account_age" class="control-label">Account age </label>
              </div>
              <div class="col-md-8">
                <vue-slider :disabled="!ageStatus" v-model="account_age" min="0" max="10" ></vue-slider>
              </div>
              <div class="col-sm-1 no_padding">
                {{account_age}} ( 0 to 10+ years)
              </div>
            </div>
          </div>
        </div>
        <div class="check_section" v-if="type === 'retweet-like-setup'">
          <div class="panel panel-default legend-panel">
            <div class="panel-body">
              <legend>Twitter Like</legend>
              <div class="form-group">
                <div class="checkbox checkbox-css col-md-3 mt6">
                  <input type="checkbox" id="twitter_like" v-model="likeStatus" >
                  <label for="twitter_like" class="control-label">Like (previously Favorite) </label>
                </div>
                <div class="col-md-8">
                  <vue-slider :disabled="!likeStatus" v-model="tweet_like" min="0" max="500" ></vue-slider>
                </div>
                <div class="col-sm-1 no_padding">
                  <b>( Upto {{tweet_like}} per day)</b>
                </div>
              </div>
              <div class="form-group">
                
                <div class="checkbox checkbox-css col-md-3 mt6">
                  <input type="checkbox" id="twitter_unlike" v-model="unlikeStatus" >
                  <label for="twitter_unlike" class="control-label">UnLike </label>
                </div>
                <div class="col-md-8">
                  <vue-slider :disabled="!unlikeStatus" v-model="tweet_unlike" min="0" max="24" ></vue-slider>
                </div>
                <div class="col-sm-1 no_padding">
                  <b>{{tweet_unlike}} Hours</b>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default legend-panel">
            <div class="panel-body">
              <legend>Twitter ReTweet</legend>
              <div class="form-group">
                <div class="checkbox checkbox-css col-md-3 mt6">
                  <input type="checkbox" id="retweet" v-model="retweetStatus" >
                  <label for="retweet" class="control-label">ReTweet </label>
                </div>
                <div class="col-md-8">
                  <vue-slider :disabled="!retweetStatus" v-model="retweet" min="0" max="500" ></vue-slider>
                </div>
                <div class="col-sm-1 no_padding">
                  <b>( Upto {{retweet}} per day)</b>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class="panel panel-default legend-panel">
          <div class="panel-body">
              <legend>Twitter Follow</legend>
              <div class="form-group">
                <div class="checkbox checkbox-css col-md-3 mt6">
                  <input type="checkbox" id="following_speed" v-model="followSpeedStatus" >
                  <label for="following_speed" class="control-label">Following Speed </label>
                </div>
                <div class="col-md-8">
                  <vue-slider :disabled="!followSpeedStatus" v-model="following_speed" min="0" max="100" ></vue-slider>
                </div>
                <div class="col-sm-1 no_padding">
                  <b>( Upto {{following_speed}} per day)</b>
                </div>
              </div>
              <div class="form-group">
                <div class="checkbox checkbox-css col-md-3 mt6">
                  <input type="checkbox" id="unfollow_after" v-model="unfollowAfterStatus" >
                  <label for="unfollow_after" class="control-label">UnFollow after </label>
                </div>
                <div class="col-md-8">
                  <vue-slider :disabled="!unfollowAfterStatus" v-model="unfollowValue" min="0" max="21" ></vue-slider>
                </div>
                <div class="col-sm-1 no_padding">
                  <b>( Upto {{unfollowValue}} per day)</b>
                </div>
              </div>
              <div class="form-group">
                <div class="switcher col-sm-12 no_padding">
                  <div class="col-sm-1">
                    <input type="checkbox" name="switcher_checkbox_1" id="switcher_checkbox_1" v-model="dont_unfollow" value="1">
                    <label for="switcher_checkbox_1"></label>
                  </div>
                 
                  <div class="col-sm-10 no_padding">
                    <h5 class="mt6">Don't UnFollow who are following me</h5>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="switcher switcher-success col-sm-12 no_padding">
                  <div class="col-sm-1">
                    <input type="checkbox" name="switcher_checkbox_2" id="switcher_checkbox_2" v-model="mute_following" value="1">
                    <label for="switcher_checkbox_2"></label>
                  </div>
                 
                  <div class="col-sm-10 no_padding">
                    <h5 class="mt6"> Mute after following</h5>
                  </div>
                </div>
              </div>
          </div>
        </div>
        
        <div class="form-group">
          <div class="switcher switcher-purple col-sm-12">
            <div class="col-sm-1">
              <input type="checkbox" name="switcher_checkbox_3" id="switcher_checkbox_3" v-model="admin_changeable" value="1">
              <label for="switcher_checkbox_3"></label>
            </div>
           
            <div class="col-sm-10 no_padding">
              <h5 class="mt6"> Allow TweetStatus team optimize your promotion. </h5>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="switcher switcher-danger col-sm-12">
            <div class="col-sm-1">
              <input type="checkbox" name="switcher_checkbox_4" id="switcher_checkbox_4" v-model="egg_profile" value="1">
              <label for="switcher_checkbox_4"></label>
            </div>
           
            <div class="col-sm-10 no_padding">
              <h5 class="mt6">  Avoid accounts with egg as profile picture. </h5>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="switcher switcher-warning col-sm-12">
            <div class="col-sm-1">
              <input type="checkbox" name="switcher_checkbox_5" id="switcher_checkbox_5" v-model="empty_bio" value="1">
              <label for="switcher_checkbox_5"></label>
            </div>
           
            <div class="col-sm-10 no_padding">
              <h5 class="mt6"> Avoid accounts with empty bio.  </h5>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="switcher col-sm-12">
            <div class="col-sm-1">
              <input type="checkbox" name="switcher_checkbox_6" id="switcher_checkbox_6" v-model="engage_follower" value="1">
              <label for="switcher_checkbox_6"></label>
            </div>
           
            <div class="col-sm-10 no_padding">
              <h5 class="mt6">  Don't engage my followers. </h5>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
            <a :href="url+'/twitter-settings'" type="button" class="btn btn-primary">
            Preview
            </a>
            <button type="button" @click="saveChange" class="btn btn-success">
            Save All
            </button>
          </div>
        </div>
      </div>
    </div>
    
    
	</div>
</template>

<script>
  import InputTag from 'vue-input-tag';
  import vueSlider from 'vue-slider-component';
  export default {
    data(){
      return {
        url:$("#base_url").val(),
        hashtag:'',
        search_keyword:[],
        location:'',
        avoid_account:'',
        ratioStatus:false,
        followingCStatus:false,
        followerCStatus:false,
        tweetCStatus:false,
        ageStatus:false,
        likeStatus:false,
        unlikeStatus:false,
        retweetStatus:false,
        followSpeedStatus:false,
        unfollowAfterStatus:false,
        mute_following:false,
        dont_unfollow:false,
        admin_changeable:true,
        egg_profile:false,
        empty_bio:false,
        engage_follower:false,
        followingValue: [
          0,
          40
        ],
        followerValue: [
          0,
          40
        ],
        following_ratio:0,
        account_age:0,
        following_speed:20,
        tweet_like:20,
        tweet_unlike:2,
        retweet:2,
        tweetValue: [
          0,
          5
        ],
        listedValue: [
          0,
          5
        ],
        unfollowValue:3,
        optionsK: {
          width: "100%",
          height: 8,
          dotSize: 20,
          min: 0,
          max: 100,
          disabled: false,
          show: true,
          tooltip: "always",
          formatter: "{value}K+",
          //enableCross: false,
          startAnimation:true,
          mergeFormatter: "{value1}K ~ ¥{value2}K+",
          tooltipDir: [
            "bottom",
            "top"
          ],
          piecewise: false,
          style: {
            "marginBottom": "30px",
            "marginTop": "30px"
          },
          bgStyle: {
            "backgroundColor": "#fff",
            "boxShadow": "inset 0.5px 0.5px 3px 1px rgba(0,0,0,.36)"
          },
          sliderStyle: [
            {
              "backgroundColor": "#f05b72"
            },
            {
              "backgroundColor": "#3498db"
            }
          ],
          tooltipStyle: [
            {
              "backgroundColor": "#f05b72",
              "borderColor": "#f05b72"
            },
            {
              "backgroundColor": "#3498db",
              "borderColor": "#3498db"
            }
          ],
          processStyle: {
            "backgroundImage": "-webkit-linear-gradient(left, #f05b72, #3498db)"
          }
        },
        keywordError:false,
        keywordMsg:'',
        loader:false
      }
    },
    props:['user','type','getdata', 'hashtag'],
    components:{
      InputTag, vueSlider, 
    },
    methods:{
      saveChange(){
        if(this.search_keyword.length > this.hashtag){
          this.$notify({
            group: 'settings',
            title: '<i class="fas fa-exclamation-circle"></i> Error',
            text: "Your keyword over the limit, please select max "+this.hashtag+" keyword",
            type:'error'
          });
        }else if(this.search_keyword.length !== 0){
          this.keywordError = false;
          this.keywordMsg = '';
          
          let getData = {
            search_keyword: JSON.stringify(this.search_keyword),
            location: this.location,
            avoid_account: JSON.stringify(this.avoid_account),
            following_ratio: this.ratioStatus+'-'+this.following_ratio,
            following_count: this.followingCStatus+'-'+JSON.stringify(this.followingValue),
            follower_count: this.followerCStatus+'-'+JSON.stringify(this.followerValue),
            tweet_count: this.tweetCStatus+'-'+JSON.stringify(this.tweetValue),
            account_age: this.ageStatus+'-'+this.account_age,
            like_daily: this.likeStatus+'-'+this.tweet_like,
            unlike_hourly: this.unlikeStatus+'-'+this.tweet_unlike,
            retweet_daily: this.retweetStatus+'-'+this.retweet,
            following_speed: this.followSpeedStatus+'-'+this.following_speed,
            unfollow_back: this.unfollowAfterStatus+'-'+this.unfollowValue,
            dont_unfollow: this.dont_unfollow,
            mute_following: this.mute_following,
            admin_changeable: this.admin_changeable,
            egg_profile: this.egg_profile,
            empty_bio: this.empty_bio,
            engage_follower: this.engage_follower,
            type:this.type
          };
          
          axios.post(this.url+'/twitter-auto-system-settings-setup',getData).then( response=> {
            console.log(response.data);
            if(response.data.status === 'success'){
              this.$notify({
                group: 'settings',
                title: '<i class="fa fa-check"></i> Successfully',
                text: response.data.value,
                type:'success'
              });
            }else{
              this.$notify({
                group: 'settings',
                title: '<i class="fas fa-exclamation-circle"></i> Error',
                text: response.data.value,
                type:'error'
              });
            }

          });
        }else{
          this.keywordError = true;
          this.keywordMsg = 'Keyword is required. type keyword and press enter';
          this.$notify({
            group: 'settings',
            title: '<i class="fas fa-exclamation-circle"></i> Error',
            text: "Keyword is required. type keyword and press enter",
            type:'error'
          });
        }
        
        
      },
      setPlace(place) {
        this.location = place.formatted_address;
      },
    },
    mounted() {
      setTimeout(() => {
        return this.loader = true;
      }, 2000); 
      
      if(this.getdata !== null){
        this.search_keyword = JSON.parse(this.getdata.search_keyword);
        this.location = this.getdata.location;
        this.avoid_account = JSON.parse(this.getdata.avoid_account);

        //following ration section
        var followingRation = this.getdata.following_ratio.split('-');
        this.ratioStatus = JSON.parse(followingRation[0]);
        this.following_ratio = JSON.parse(followingRation[1]);
        

        //following count section
        var followingCount = this.getdata.following_count.split('-');
        this.followingCStatus = JSON.parse(followingCount[0]);
        this.following_count = JSON.parse(followingCount[1]);

        //followers count section
        var followerCount = this.getdata.follower_count.split('-');
        this.followerCStatus = JSON.parse(followerCount[0]);
        this.follower_count = JSON.parse(followerCount[1]);

        //tweet count section
        var tweetCount = this.getdata.tweet_count.split('-');
        this.tweetCStatus = JSON.parse(tweetCount[0]);
        this.tweet_count = JSON.parse(tweetCount[1]);

        //account age section
        var accountAge = this.getdata.account_age.split('-');
        this.ageStatus = JSON.parse(accountAge[0]);
        this.account_age = JSON.parse(accountAge[1]);

        //tweet like section
        if(this.getdata.like_daily){
          var tweetLike = this.getdata.like_daily.split('-');
          this.likeStatus = JSON.parse(tweetLike[0]);
          this.like_daily = JSON.parse(tweetLike[1]);
        }

        //tweet unlike section
        if(this.getdata.unlike_hourly){
          var tweetUnLike = this.getdata.unlike_hourly.split('-');
          this.unlikeStatus = JSON.parse(tweetUnLike[0]);
          this.tweet_unlike = JSON.parse(tweetUnLike[1]);
        }

        //retweet section
        if(this.getdata.retweet_daily){
          var retweetDaily = this.getdata.retweet_daily.split('-');
          this.retweetStatus = JSON.parse(retweetDaily[0]);
          this.retweet = JSON.parse(retweetDaily[1]);
        }

        //following speed
        var followingSpeed = this.getdata.following_speed.split('-');
        this.followSpeedStatus = JSON.parse(followingSpeed[0]);
        this.following_speed = JSON.parse(followingSpeed[1]);

        //unfollow after or unfollow back
        var unfollowAfter = this.getdata.unfollow_back.split('-');
        this.unfollowAfterStatus = JSON.parse(unfollowAfter[0]);
        this.unfollow_after = JSON.parse(unfollowAfter[1]);

        this.dont_unfollow = this.getdata.dont_unfollow;
        this.mute_following = this.getdata.mute_following;
        this.admin_changeable = this.getdata.admin_changeable;
        this.egg_profile = this.getdata.egg_profile;
        this.empty_bio = this.getdata.empty_bio;
        this.engage_follower = this.getdata.engage_follower;
        
      }
      
      
    }
  }
</script>
<style>
  .new-tag{padding: 4px 4px 4px 10px !important;}
</style>