@if(count($getTopics) > 0)
	<div class="panel panel-warning">
		<div class="panel-heading">
      <h3 class="panel-title">Hot topics</h3>
    </div>
    <div class="panel-body">
    	<div class="recent-activity">  
    		<?php $i = 0; ?>
    		@foreach($getTopics as $topic)  
    		<?php 
					$i++;
					if($i < 57){
				 ?>                          
        <!-- Start recent activity item -->
        <div class="recent-activity-item recent-activity-lilac ">
          <div class="recent-activity-badge">
              <span class="recent-activity-badge-userpic"></span>
          </div>
          <div class="recent-activity-body">
            <div class="recent-activity-body-head">
              <div class="recent-activity-body-head-caption">
                <h3 class="recent-activity-body-title">
                	<a href="javascript:;" class="trendTopic"  data-toggle="modal" data-target="#topic{{$i}}">#{{$topic['name']}}</a>
                </h3>
								<!-- Modal -->
								<div class="modal fade" id="topic{{$i}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header modal-info">
								        <h5 class="modal-title" id="exampleModalLabel">#{{$topic['name']}}</h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <!-- <span aria-hidden="true">&times;</span> -->
								        </button>
								      </div>
								      <div class="modal-body">
								      	<?php $content = '#'.$topic['name']; ?>
								      	<post-a-tweet data-dismiss="modal" aria-label="Close" :content="{{json_encode($content)}}"></post-a-tweet>
								      	<br>
								      	{!! Form::open(array('url' => 'twitter-search','class'=>'form-horizontal','method'=>'GET','files'=>'true')) !!}
								      	<input type="hidden" name="do-search" value="x">
								      	<input type="hidden" name="keyword" value="{{$topic['name']}}">
								      	<input type="hidden" name="minfollower" value="10">
								      	<input type="hidden" name="mintweets" value="10">
								      	{!! csrf_field() !!}
								        <button type="submit" class="btn btn-warning modal-btn-home">Search Followers</button>
								        {!! Form::close(); !!}
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								      </div>
								    </div>
								  </div>
								</div>
              </div>
            </div>
            <div class="recent-activity-body-content">
              <p>
                  {{$topic['woeid']}} woeid.
              </p>
            </div>
          </div>
        </div>
        <!-- End recent activity item -->
        <?php } ?>
				@endforeach
      </div>
    </div>
	</div>
	
@endif