@extends('layouts.app')
@section('content')
    <h5>
        <div class="card-header bg-dark text-white text-center">
            Notifications
        </div>
    </h5>
<ul class="list-group">
    @if($notifications->count()>0)
        @foreach($notifications as $notification)
            @if($notification->type=="App\\Notifications\\NewReplyAdded")
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Someone replied of your discussion:
                        <strong>{{$notification->data['discussion']['title']}}</strong>
                    </span>
                    <a class="btn btn-sm btn-primary ml-3" href="{{route('discussion.show',$notification->data['discussion']['slug'])}}">View discussion</a>
                </li>
            @endif
            @if($notification->type=="App\\Notifications\\WatcherNotify")
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Someone replied on the discussion:
                        <strong>{{$notification->data['discussion']['title']}}</strong> you were interested in
                    </span>
                    <a class="btn btn-sm btn-primary ml-3" href="{{route('discussion.show',$notification->data['discussion']['slug'])}}">View discussion</a>
                </li>
            @endif
            @if($notification->type=="App\\Notifications\\BestReply")
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Your reply on discussion
                        <strong>{{$notification->data['discussion']['title']}}</strong>
                        marked as best
                    </span>
                    <a class="btn btn-sm btn-primary ml-3" href="{{route('discussion.show',$notification->data['discussion']['slug'])}}">View discussion</a>
                </li>
            @endif
        @endforeach
    @else
        <h5 class="text-muted text-center mt-5">No Notifications</h5>
    @endif
</ul>
@endsection