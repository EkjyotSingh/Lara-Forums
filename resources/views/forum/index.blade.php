@extends('layouts.app')
@section('title')
    @if(request()->query('channel'))
        {{ucFirst(request()->query('channel'))}}
    
    @elseif(request()->query('mydiscussions'))
        My Discussions
    @else
        Forum Discussions
    
    @endif
@endsection
@section('content')
    <h4>
        <div class="card-header bg-dark text-white text-center">
            @if(request()->query('channel'))
                {{ucFirst(request()->query('channel'))}}
            @else
                Discussions
            @endif
        </div>
    </h4>
    @foreach($discussions as $discussion)
        <div class="card" style="">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div>
                        <span class="text-primary ">{{ucFirst($discussion->user->name)}}</span>
                        &nbsp;&nbsp;&nbsp;
                        <span class="text-muted muted-size mr-1 text-nowrap">asked {{$discussion->created_at->diffForHumans()}}</span>
                    </div>
                    <div class=" d-flex">
                        @if($discussion->closed != 1)
                            @if(Auth::check() && (Auth::id() == $discussion->user_id))
                                <form method="post" action="{{route('discussion.closed',$discussion->id)}}">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-secondary btn-sm button-size">Mark as closed</button>
                                </form>
                            @endif
                        @else
                            <a class="btn disabled btn-sm btn-danger button-size">CLOSED</a>
                        @endif
                        <a href="{{route('discussion.show',$discussion->slug)}}" class="btn btn-sm btn-outline-secondary ml-3 button-size align-self-center" >View</a>
                    </div>
                </div>
            <div class="card-body">
                <h5 class="">
                    {{ucFirst($discussion->title)}}
                </h5>
                <p class="" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;word-break: break-word;hyphens:auto;">{{$discussion->content}}</p>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <span>{{$discussion->replies->count()}}&nbsp;Replies</span>
                <div class="d-flex justify-content-end align-items-center flex-wrap">
                    <a href="{{route('forum').'?channel='.$discussion->channel->slug}}" class="text-primary">channel:&nbsp;{{$discussion->channel->name}}</a>
                    @if($discussion->is_being_watched($discussion->id))
                        <form action="{{route('watch.create',$discussion->id)}}" method="post">
                            @csrf
                            <button title="Notify if any activity happens on this discussion" class="btn btn-sm btn-primary button-size ml-3  text-nowrap" type="submit">Notify Me</button>
                        </form>
                    @else
                        <form action="{{route('watch.destroy',$discussion->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button title="No further notifications related to this discussion" class="btn btn-sm btn-primary button-size ml-3  text-nowrap"type="submit">Unsubscribe</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    <div class="mt-5 text-center">
        {{$discussions->appends(['channel'=>request()->query('channel'),'mydiscussions'=>request()->query('mydiscussions')])->links()}}
    </div>
@endsection

