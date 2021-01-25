@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/trix.css')}}">
    <link rel="stylesheet" href="{{asset('css/desert.css')}}">
    
@endsection
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
            <div class="d-flex justify-content-between align-items-start">
                <h5 class="mb-3">
                    {{ucFirst($discussion->title)}}
                </h5>
                @auth
                    @if($discussion->closed!=1 && ($discussion->user_id == Auth::id() || $discussion->is_user_admin()) )
                        <a href="{{route('discussion.edit',$discussion->slug)}}" class="btn btn-primary btn-sm ml-2">Update</a>
                    @endif
                @endauth
            </div>
            <hr>
            <p style="word-break: break-word;hyphens:auto;">{!!$discussion->content!!}</p>
        </div>
    </div>
    <hr class="my-5">

    <h5>
        <div class=" text-dark mb-5">
            Answers <span class="text-muted">({{$discussion->replies->count()}})</span>
        </div>
    </h5>
@foreach(collect($discussion->replies)->sortByDesc('created_at') as $reply)
    <div class="card">
        <div class="card-header {{$reply->user_id==Auth::id()?'green':''}} d-flex align-items-center justify-content-between">
            {{--@if(false)
                <img src="" class="mr-3 img-fluid rounded-circle" style="min-width:2rem; height:2rem;"/>
            @else--}}
                <div class="mr-3 bg-primary text-white rounded-circle  d-flex align-items-center justify-content-center" style="min-width:2rem; height:2rem;">
                    {{ucFirst(substr($reply->user->name,0,2))}}
                </div>
            {{--@endif--}}
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
        <div class="card-body" style="">
            <p style="word-break:break-word;hyphens:auto;">{!!$reply->content!!}</p>
        </div>
        <div class="card-footer d-flex align-items-center">
                <?php
                $like='';
                $dislike='';?>
                @auth
                    @if($reply->liked() =='liked')
                        <?php $like = 'icon-active'?>
                    @elseif($reply->liked() =='disliked')
                        <?php $dislike = 'icon-active'?>
                    @else

                    @endif
                @endauth
                <div class="mr-4 d-flex align-items-center">
                    <form method="post" action="{{route('like',$reply->id)}}">
                        @csrf
                        <button type="submit" class="button-icon">
                            <svg class="icon-like {{$like}}">
                                <use xlink:href="{{asset('img/sprite.svg#icon-like')}}"></use>
                            </svg>
                        </button>&nbsp;
                    </form>
                    <span class="like_font_size">{{count($reply->likes->where('like','1'))}} {{count($reply->likes->where('like','1'))==0?'Like':Str::plural('Like',count($reply->likes->where('like','1')))}}</span>
                </div>
                <div class="d-flex align-items-center">
                    <form method="post" action="{{route('dislike',$reply->id)}}">
                        @csrf
                        <button type="submit" class="button-icon">
                            <svg class="icon-like icon-dislike {{$dislike}}">
                                <use xlink:href="{{asset('img/sprite.svg#icon-like')}}"></use>
                            </svg>
                        </button>&nbsp;
                    </form>
                    <span class="like_font_size">{{count($reply->likes->where('dislike','1'))}} {{count($reply->likes->where('dislike','1'))==0?'Dislike':Str::plural('Dislike',count($reply->likes->where('dislike','1')))}}</span>
                </div>                    



        </div>
    </div>
@endforeach
    <hr class="my-5">
    <div>
        <h5 class="mb-5">Your Answer</h5>
        <form method="post" action="{{route('reply.store',$discussion->id)}}" class="mb-5">
            @csrf
            <div class="form-group">
                <input id="text" type="hidden" name="content" >
                <trix-editor input="text" style="min-height:270px" class="form-control overflow-auto @error('content') border border-danger @enderror" placeholder="Type answer here..."></trix-editor>
                @error('content')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

@endsection
@section('script')
<script type="text/javascript" src="{{asset('js/prettify.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/trix.js')}}"></script>
    <script type="text/javascript">
        $('pre').addClass('prettyprint');
        $('pre').addClass('py-2');
        $('pre').addClass('linenums');
        document.addEventListener("trix-file-accept", event => {
            event.preventDefault()
        })
        addEventListener('load', function(event) { PR.prettyPrint(); }, false);
    </script>
@endsection
