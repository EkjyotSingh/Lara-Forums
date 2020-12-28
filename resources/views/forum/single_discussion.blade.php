@extends('layouts.app')

@section('content')
    <h4>
        <div class="card-header bg-dark text-white text-center">
            {{ucFirst($discussion->channel->name)}}
        </div>
    </h4>
    <div class="card mb-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-primary">{{ucFirst($discussion->user->name)}}</span>
                    &nbsp;&nbsp;&nbsp;
                    <span class="text-muted muted-size text-nowrap">asked {{$discussion->created_at->diffForHumans()}}</span>
                </div>

                @if($discussion->closed != 1)
                    @if(Auth::check() && (Auth::id() == $discussion->user_id))
                        <form method="post" action="{{route('discussion.closed',$discussion->id)}}">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-secondary btn-sm button-size">Mark as closed</button>
                        </form>
                    @endif
                @else
                    <a class="btn disabled  btn-sm btn-danger button-size">CLOSED</a>
                @endif

            </div>
        <div class="card-body">
            <h5 class="mb-3">
                {{ucFirst($discussion->title)}}
            </h5>
            <hr>
            <p>{{$discussion->content}}</p>
        </div>
        <div class="card-footer d-flex align-items-center">
        </div>
    </div>

    <h5>
        <div class=" text-dark">
            Answers
        </div>
    </h5>
@foreach($discussion->replies as $reply)
    <div class="card">
        <div class="card-header {{$reply->user_id==Auth::id()?'green':''}} d-flex align-items-center justify-content-between">
            @if(false)
                <img src="" class="mr-3 img-fluid rounded-circle" style="min-width:2rem; height:2rem;"/>
            @else
                <div class="mr-3 bg-primary text-white rounded-circle  d-flex align-items-center justify-content-center" style="min-width:2rem; height:2rem;">
                    {{ucFirst(substr($reply->user->name,0,2))}}
                </div>
            @endif
            <div class="d-flex justify-content-end  align-items-center flex-wrap">
                @if($discussion->is_best_answer())
                    @if(Auth::check() && (Auth::id() == $discussion->user_id))
                        <form method="post" class="d-inline mr-2" action="{{route('reply.best',[$reply->id,$discussion->id])}}">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-secondary btn-sm button-size">Mark as best</button>
                        </form>
                    @endif
                @else
                    @if($discussion->best_answer == $reply->id)
                        <span title="Best Reply">
                            <svg class="icon icon-checkmark">
                                <use xlink:href="{{asset('img/sprite.svg#icon-checkmark')}}"></use>
                            </svg>
                        </span>
                    @endif
                @endif
                <span class="text-primary ">{{$reply->user->name}}</span>
                &nbsp;&nbsp;&nbsp;
                <span class="text-muted  muted-size text-nowrap ml-auto">replied {{$reply->created_at->diffForHumans()}}</span>
            </div>
        </div>
        <div class="card-body">
            {{$reply->content}}
        </div>
        <div class="card-footer d-flex align-items-center">


                <div class="mr-4 d-flex align-items-center">
                    <form method="post" action="">
                        @csrf
                        <button type="submit" class="button-icon">
                            <svg class="icon-like">
                                <use xlink:href="{{asset('img/sprite.svg#icon-like')}}"></use>
                            </svg>
                        </button>&nbsp;
                    </form>
                    <span class="like_font_size">45 Likes</span>
                </div>
                <div class="d-flex align-items-center">
                    <form method="post" action="">
                        @csrf
                        <button type="submit" class="button-icon">
                            <svg class="icon-like icon-dislike">
                                <use xlink:href="{{asset('img/sprite.svg#icon-like')}}"></use>
                            </svg>
                        </button>&nbsp;
                    </form>
                    <span class="like_font_size">45 Dislikes</span>
                </div>                    



        </div>
    </div>
@endforeach
    <hr class="mt-5">
<h5 class="">Your Answer</h5>
<form method="post" action="{{route('reply.store',$discussion->id)}}" class="mb-5">
    @csrf
    <div class="form-group">
        <textarea class="form-control @error('content') border border-danger @enderror" placeholder="Type answer here..." name="content"></textarea>
    @error('content')
        <span class="text-danger">{{$message}}</span>
    @enderror
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-success">Submit</button>
    </div>
</form>

@endsection
