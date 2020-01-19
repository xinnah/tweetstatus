<?php

Route::get('/', 'HomeController@index');
Route::get('plan', 'HomeController@plan');
Route::get('privacy-policy', 'HomeController@privacyPolicy');
Route::resource('users', 'UserController');
Route::post('/user-login', 'UserController@userLogin');
Route::post('/user-signup', 'UserController@userSignup');
Route::get('/premium/{typeName}/{packageName}/{cat}', 'TwitterAuthController@checkOutPremium');
Route::post('/check-user-purchase-package', 'PurchaseController@checkUserPurchase');
Route::post('/user-purchase-package', 'PurchaseController@purchase');

//twitter auth serction
Route::get('login/twitter', ['as' => 'twitter.login', 'uses' => 'TwitterAuthController@twitterLogin']);

Route::get('login/twitter/callback', ['as' => 'twitter.callback', 'uses' => 'TwitterAuthController@twitterCallback']);
Route::get('twitter-setup-user-update/{type}', 'TwitterAuthController@updateUserLogged');
Route::get('logout/twitter', 'TwitterAuthController@logout');
Route::get('twitter/error', ['as' => 'twitter.error', function(){
	return redirect()->back();
}]);



Auth::routes();
Route::group(['namespace' => 'Backend'], function(){
	Route::get('/dashboard', 'HomeController@index');
	
	Route::group(['middleware' => ['auth', 'admin']], function(){
		Route::resource('/role', 'RoleController');
		Route::resource('/admin', 'AdminController');
		Route::resource('/services', 'ServiceController');
		Route::resource('/plan-package', 'PlanPackageController');
		Route::resource('/faq', 'FAQController');
		Route::post('/plan-package-set', 'PlanPackageController@planSet');
		Route::post('/plan-package-set/{id}', 'PlanPackageController@planSetUpdate');
		Route::get('service-name-search', array('as'=>'service-name.response','uses'=>'ServiceController@serviveAjaxData'));
		//Route::resource('admin', 'AdminController');
	});
	// servcie admin
	Route::get('/twitter-users', 'ListOfUserController@twitter');
	//Route::get('/instagram-users', 'ListOfUserController@instagram');
	Route::post('twitter-users-access', 'ListOfUserController@twitterAccessUser');
});


Route::group(['middleware' => ['checkPurchase']], function(){
	Route::get('twitter-unfollowers', 'Backend\TwitterGetDataController@unfollowers');
	Route::get('twitter-followers', 'Backend\TwitterGetDataController@followers');
	Route::get('twitter-following', 'Backend\TwitterGetDataController@following');
	Route::get('twitter-non-followback', 'Backend\TwitterUrlController@nonFollowback');
	Route::get('twitter-i-dont-followback', 'Backend\TwitterUrlController@iDontFollowback');
	Route::get('twitter-search', 'Backend\TwitterUrlController@search');
	Route::get('twitter-muted', 'Backend\TwitterGetDataController@muted');
	Route::get('twitter-blocked', 'Backend\TwitterGetDataController@blocked');
	Route::get('twitter-joined', 'Backend\TwitterUrlController@joined');
	Route::get('twitter-friendship-check', 'Backend\TwitterUrlController@friendshipCheck');
});

Route::group(['middleware' => ['auth']], function(){
	Route::get('view-profile', 'Backend\ProfileController@index');
	Route::get('account-settings', 'Backend\ProfileController@settings');
	Route::get('edit-profile', 'Backend\ProfileController@edit');
	Route::post('update-profile', 'Backend\ProfileController@update');
	Route::get('change-password', 'Backend\ProfileController@cPass');
	Route::post('update-password', 'Backend\ProfileController@updatePass');

	Route::get('twitter-dashboard', 'TwitterAuthController@twitterHome');

	Route::get('instagram-dashboard', 'InstagramAuthController@home');
	
	Route::get('instagram-following', 'Backend\InstagramUrlController@following');
	Route::get('instagram-followers', 'Backend\InstagramUrlController@followers');
	Route::get('instagram-search', 'Backend\InstagramUrlController@search');
	Route::get('login/instagram', 'InstagramAuthController@login');
	Route::get('login/instagram/callback', ['as' => 'instagram.callback', 'uses' => 'InstagramAuthController@callback']);
	Route::get('logout/instagram', 'InstagramAuthController@logout');
	
});
Route::group(['middleware' => ['twitterAuth','auth']], function(){
	Route::get('twitter-setup', 'Backend\TwitterUrlController@setupTwitter');
	Route::get('check-sync-data', 'Backend\TwitterUrlController@checkSync');
	Route::get('twitter-update', 'Backend\TwitterUrlController@updateTwitter');
	Route::get('twitter-resynchronize-data', 'Backend\TwitterUrlController@resynchronize');
	
  //setup twitter
	Route::post('twitter-setup-dataIdlist', 'Backend\TwitterSetupController@dataIdList');
	Route::get('twitter-setup-follower', 'Backend\TwitterSetupController@follower');
	Route::get('twitter-setup-following', 'Backend\TwitterSetupController@following');

	Route::get('twitter-setup-complete', 'Backend\TwitterSetupController@setupComplete');
	//update twitter
	Route::post('twitter-update-removeids', 'Backend\TwitterSetupController@removeIds');
	Route::post('twitter-update-dataIdlist', 'Backend\TwitterSetupController@updateDataIdList');
	Route::get('twitter-update-complete/{type}', 'Backend\TwitterSetupController@updateComplete');
	
	Route::get('twitter-settings', 'TwitterAuthController@settings');
	Route::get('twitter-settings/{typeWise}', 'TwitterAuthController@settingsTypeWise');
	Route::post('twitter-auto-system-settings-setup', 'TwitterAuthController@autoSystemSetup');


	Route::get('twitter-follow-unfollow-setup', 'TwitterAuthController@followUnfollowSetup');
	Route::get('premium-account-set', 'TwitterAuthController@manualSettings');
	Route::post('premium-account-set-confirm', 'TwitterAuthController@manualSettingsConfirm');
	Route::post('twitter-user-settings-setup', 'TwitterAuthController@settingsSetup');
	//twitter get data result
	Route::post('twitter-get-load', 'Backend\TwitterGetDataController@getLoadWise');
	Route::post('twitter-get-nonfollowback', 'Backend\TwitterGetDataController@getNonfollowback');
	Route::post('twitter-search-result', 'Backend\TwitterGetDataController@search');
	Route::post('twitter-get-data', 'Backend\TwitterGetDataController@getData');
	Route::post('twitter-follow', 'Backend\TwitterGetDataController@postFollow');
	Route::post('twitter-check-user', 'Backend\TwitterGetDataController@checkUser');
	Route::post('twitter-check-friendship', 'Backend\TwitterGetDataController@checkFriendship');
	Route::post('twitter-user-mute', 'Backend\TwitterGetDataController@postMute');
	Route::post('twitter-user-block', 'Backend\TwitterGetDataController@postBlock');
	Route::get('twitter-muted-ids', 'Backend\TwitterGetDataController@mutedIds');
	Route::get('twitter-block-ids', 'Backend\TwitterGetDataController@blockIds');
	Route::post('twitter-tweets-hot-topics', 'Backend\TwitterGetDataController@tweets');

	Route::post('twitter-user-blacklist', 'Backend\TwitterWhiteBackListController@postBacklist');
	Route::post('twitter-user-whitelist', 'Backend\TwitterWhiteBackListController@postWhitelist');
	Route::get('twitter-whitelist', 'Backend\TwitterUrlController@whitelist');
	Route::get('twitter-blacklist', 'Backend\TwitterUrlController@blacklist');

	Route::get('twitter-following-message-setup', 'Backend\TwitterUrlController@followingMsg');
	Route::post('twitter-following-message-setup', 'Backend\TwitterUrlController@followingMsgSetup');
	//twitter schedule tweet section
	Route::resource('twitter-tweets', 'Backend\TwitterTweetController');
	Route::get('twitter-schedule-tweets', 'Backend\TwitterTweetController@schedule');
	// twitter premium plans section
	Route::get('twitter-plans', 'Backend\TwitterUrlController@plans'); 
	Route::get('plan-premium/{typeName}/{packageName}/{cat}', 'Backend\TwitterUrlController@premium'); 

	//keyword wise service for premium user section

	Route::get('twitter-keyword-wise/{type}', 'Backend\KeywordWiseServiceController@typeWise');

	//Route::get('twitter-keyword-wise-follow', 'Backend\KeywordWiseServiceController@followPage');
	Route::post('twitter-keyword-wise-follow-data', 'Backend\KeywordWiseServiceController@followResult');
	//Route::get('twitter-keyword-wise-unfollow', 'Backend\KeywordWiseServiceController@unFollowPage');
	Route::post('twitter-keyword-wise-unfollow-data', 'Backend\KeywordWiseServiceController@unfollowResult');
	Route::post('twitter-keyword-wise-retweet-data', 'Backend\KeywordWiseServiceController@retweetResult');

	Route::post('twitter-autofollow', 'Backend\KeywordWiseServiceController@autoFollow');
	Route::post('twitter-autounfollow', 'Backend\KeywordWiseServiceController@autoUnfollow');

	//activity report section
	Route::get('/twitter-user-daily-report/{pid}', 'Backend\TwitterActivityReportController@dailyReports');

	Route::post('/twitter-on-share', 'Backend\TwitterGetDataController@tweetShare');
	Route::get('/twitter-footer-action', 'Backend\TwitterGetDataController@footerAction');
	Route::get('user-invoice', 'Backend\HomeController@userInvoice');
});

