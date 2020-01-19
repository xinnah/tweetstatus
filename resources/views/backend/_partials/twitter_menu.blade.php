@if(Session::has('sidebar'))
	@php
		$getSidebar = Session::get('sidebar');
		$unfollowers = $getSidebar->unfollowers;
		$followers = $getSidebar->followers_new;
		$following = $getSidebar->following_new;
		$blocked = $getSidebar->blocked;
		$muted = $getSidebar->muted;
		$whitelist = $getSidebar->whitelist;
		$blacklist = $getSidebar->blacklist;

	@endphp
@else
	@php
		$unfollowers = 0;
		$followers = 0;
		$following = 0;
		$blocked = 0;
		$muted = 0;
		$whitelist = 0;
		$blacklist = 0;
	@endphp
@endif

<li class="has-sub {{ Request::is('twitter-unfollowers') ? 'active' : '' }}"><a href="{{URL::to('/twitter-unfollowers')}}"><span class="badge badge-danger pull-right">{{$unfollowers}} new</span><i rel="tooltip" data-placement="left" title="Followers" class="fas fa-unlink badge-icon"></i><span>Unfollowers</span></a></li>

<li class="has-sub {{ Request::is('twitter-followers') ? 'active' : '' }}"><a href="{{URL::to('/twitter-followers')}}"><span class="badge badge-success pull-right">{{ $followers }} new</span><i rel="tooltip" data-placement="left" title="Followers" class="fas fa-users badge-icon"></i><span>Followers</span></a></li>

<li class="has-sub {{ Request::is('twitter-following') ? 'active' : '' }}"><a href="{{URL::to('/twitter-following')}}"><span class="badge badge-info pull-right">{{ $following }} new</span><i rel="tooltip" data-placement="left" title="Following" class="fas fa-user-plus badge-icon"></i> <span>Following</span></a></li>

<li class="has-sub {{ Request::is('twitter-non-followback') ? 'active' : '' }}"><a href="{{URL::to('/twitter-non-followback')}}"><i rel="tooltip" data-placement="left" title="Non-Followback" class="fas fa-user-times badge-icon"></i> <span>Non-Followback</span></a></li>

<li class="has-sub {{ Request::is('twitter-i-dont-followback') ? 'active' : '' }}"><a href="{{URL::to('/twitter-i-dont-followback')}}"><i rel="tooltip" data-placement="left" title="I-don't Followback" class="fas fa-user-slash badge-icon"></i> <span>I-don't Followback</span></a></li>

<li class="has-sub {{ Request::is('twitter-search') ? 'active' : '' }}"><a href="{{URL::to('/twitter-search')}}"><i rel="tooltip" data-placement="left" title="Search follower" class="fas fa-search-plus badge-icon"></i> <span>Search follower</span></a></li>

<li class="has-sub {{ Request::is('twitter-muted') ? 'active' : '' }}"><a href="{{URL::to('/twitter-muted')}}"><span class="badge badge-warning pull-right">{{ $muted }}</span><i rel="tooltip" data-placement="left" title="Muted" class="fas fa-volume-off badge-icon"></i> <span>Muted</span></a></li>

<li class="has-sub {{ Request::is('twitter-blocked') ? 'active' : '' }}"><a href="{{URL::to('/twitter-blocked')}}"><span class="badge badge-primary pull-right">{{ $blocked }}</span><i rel="tooltip" data-placement="left" title="Blocked" class="fas fa-ban badge-icon"></i> <span>Blocked</span></a></li>

<li class="has-sub {{ Request::is('twitter-tweets') || Request::is('twitter-schedule-tweets') ? 'active' : '' }}"><a href="{{URL::to('/twitter-schedule-tweets')}}"><i  rel="tooltip" data-placement="left" title="Schedule tweets"class="fab fa-twitter badge-icon"></i> <span>Schedule tweets</span></a></li>

<li class="has-sub {{ Request::is('twitter-friendship-check') ? 'active' : '' }}"><a href="{{URL::to('/twitter-friendship-check')}}"><i rel="tooltip" data-placement="left" title="Friendship Check" class="fas fa-hand-peace badge-icon"></i> <span>Friendship Check</span></a></li>

<li class="has-sub {{ Request::is('twitter-joined') ? 'active' : '' }}"><a href="{{URL::to('/twitter-joined')}}"><i rel="tooltip" data-placement="left" title="When joined" class="fas fa-clock badge-icon"></i><span>When joined</span></a></li>

<li class="has-sub {{ Request::is('twitter-whitelist') ? 'active' : '' }}"><a href="{{URL::to('/twitter-whitelist')}}"><span class="badge badge-indigo pull-right">{{ $whitelist }}</span><i rel="tooltip" data-placement="left" title="Whitelist" class="fas fa-list-alt badge-icon"></i> <span>Whitelist</span></a></li>

<li class="has-sub {{ Request::is('twitter-blacklist') ? 'active' : '' }}"><a href="{{URL::to('/twitter-blacklist')}}"><span class="badge badge-purple pull-right">{{ $blacklist }}</span><i rel="tooltip" data-placement="left" title="Blacklist" class="fas fa-list-ul badge-icon"></i> <span>Blacklist</span></a></li>

<li class="has-sub {{ Request::is('twitter-following-message-setup') ? 'active' : '' }}"><a href="{{URL::to('/twitter-following-message-setup')}}"><i rel="tooltip" data-placement="left" title="User following message setup" class="fas fa-envelope badge-icon"></i> <span>User following message</span></a></li>

{{-- <li class="has-sub {{ Request::is('twitter-update') ? 'active' : '' }}"><a href="{{URL::to('/twitter-update')}}" onclick="return confirmSynchronous();"><i rel="tooltip" data-placement="left" title="Update your data" class="fas fa-sync-alt badge-icon"></i> <span>Update your data</span></a></li> --}}

<li class="has-sub {{ Request::is('twitter-update') ? 'active' : '' }}">
	<a href="javascript:;" class="trendTopic" v-on:click="confirmSynchronous" data-toggle="modal" data-target="#update-synco-data"><i rel="tooltip" data-placement="left" title="Update your data" class="fas fa-sync-alt badge-icon"></i> <span>Update your data</span></a>
</li>

{{-- <li class="has-sub {{ Request::is('twitter-update') ? 'active' : '' }}"><twitter-update-btn></twitter-update-btn></li> --}}
<!-- <li class="has-sub {{ Request::is('twitter-settings') ? 'active' : '' }}"><a href="{{URL::to('/twitter-settings')}}"><i class="fas fa-cogs"></i> <span> <span>settings</span></span></a></li> -->