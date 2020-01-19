 @extends('backend.layouts.app') 
 @section('content')

<!-- begin #content -->
<div id="content" class="content">

  <ol class="breadcrumb pull-right">
      <li><a href="javascript:;">Dashboard</a></li>
      <li class="active">Admin</li>
  </ol>
  <h1 class="page-header"><small>List of twitter users page</h1>
  <hr>
  <!-- start row -->
  <div class="row">
    <div class="col-sm-12">
      <!-- begin panel -->
      <div class="panel panel-inverse">
        <div class="panel-heading">
            <div class="panel-heading-btn">
              <!-- <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
              <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a> -->
            </div>
            <h4 class="panel-title">Users</h4>
        </div>

        <div class="panel-body">
        	<div class="admin_list_section">
             <table id="data-table" class="table table-striped table-bordered nowrap" width="100%">
              <thead>
                <tr>
                  <th>SL.</th>
                  <th>User email</th>
                  <th>Twitter id</th>
                  <th>Twitter name</th>
                  <th>Screen name</th>
                  <th>Profile image</th>
                  <th>Start date</th>
                  <th>End date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $i=0; ?>
                @foreach($getUser as $user)
                @if($user->Plans->plan_category == 3)
                <tr>
                  <td>{{++$i}}</td>
                  <td>{{$user->users->email}}</td>
                  <td>{{$user->account_id}}</td>
                  <td>{{$user->twitter_user->name}}</td>
                  <td>{{$user->twitter_user->screen_name}}</td>
                  <td><img src="{{$user->twitter_user->profile_image}}" alt="{{$user->twitter_user->name}}" style="width: 20%"></td>
                  <td>{{$user->start_date}}</td>
                  <td>{{$user->end_date}}</td>
                  <td>
                    <?php $twitterId = $user->twitter_user->twitter_id; ?>
                    {!! Form::open(array('url'=> ["twitter-users-access"],'method'=>'POST','class'=>'form')) !!} 
                    {{ Form::hidden('twitter_id',$twitterId) }}
                    {{ Form::hidden('token',$user->twitter_user->token)}}
                    {{ Form::hidden('secret',$user->twitter_user->secret)}}
                    {{ Form::hidden('screen_name',$user->twitter_user->screen_name)}}
                    {{ Form::hidden('user_id',$user->users->id)}}
                    <button type="submit" onclick="return confirmAccess();" class="btn btn-danger btn-sm">
                        Access
                    </button>
                    {!! Form::close() !!}
                  </td>
                </tr>
                @endif
                @endforeach
              </tbody>
            </table>
            <div class="pagination">
              {{ $getUser->links() }}
            </div>
          </div>
        </div>
      </div>
      <!-- end panel -->
    </div>
  </div>
  <!-- end row -->
</div>
<!-- end #content -->
@push('js')
  <script>
    function confirmAccess(){
        
        return confirm("Do You Sure Want To Access this user ?");
    }
  </script>
@endpush
@endsection