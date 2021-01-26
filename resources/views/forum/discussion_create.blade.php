@extends('layouts.app')
@section('title',isset($discussion)?'Update Discussion':'Create Discussion')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/trix.css')}}">
@endsection
@section('content')
<div class="card">
    <h5>
        <div class="card-header text-center">
            {{isset($discussion)?'Discussion Update':'Discussion Create'}}
        </div>
    </h5>
    <div class="card-body">
        <form action="{{isset($discussion)?route('discussion.update',$discussion->slug):route('discussion.store')}}" method="post">
            @csrf
            @if(isset($discussion))
                @method('PUT')
            @endif
            <div class="form-group">
                <label>Title</label>
                <input type="text" {{isset($discussion)?'readonly':''}} placeholder="Title" name="title" class="form-control @error('title') border border-danger @enderror" value="{{isset($discussion)?$discussion->title:''}}">
                @error('title')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Category</label>
                <select {{isset($discussion)?'disabled=true':''}} class="form-control @error('channel') border border-danger @enderror" name="channel">
                    @if(isset($discussion))
                        @foreach($channels as $channel)
                        <?php $selected=''?>
                            @if($discussion->channel_id == $channel->id)
                                <?php $selected='selected';?>
                            @endif 
                            <option value="{{$channel->id}}" {{$selected}}>{{$channel->name}}</option>
                        @endforeach
                    @else
                        @foreach($channels as $channel)
                            <option value="{{$channel->id}}">{{$channel->name}}</option>
                        @endforeach
                    @endif
                </select>
                @error('channel')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group overflow-scroll">
                <label>Content</label>
                <input id="text" type="hidden" name="content" value="{{isset($discussion)?$discussion->content:old('content')}}">
                <trix-editor input="text" style="min-height:270px" class="form-control overflow-auto @error('content') border border-danger @enderror" placeholder="Content"></trix-editor>
                @error('content')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{isset($discussion)?'Update':'Create'}}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{asset('js/trix.js')}}"></script>
@endsection