@extends('layouts.app')
@section('content')
<div class="card">
    <h5>
        <div class="card-header text-center">
            Discussion Create
        </div>
    </h5>
    <div class="card-body">
        <form action="{{route('discussion.store')}}" method="post">
            @csrf
            <div class="form-group">
                <label>Title</label>
                <input type="text" placeholder="Title" name="title" class="form-control @error('title') border border-danger @enderror">
                @error('title')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Category</label>
                <select class="form-control @error('channel') border border-danger @enderror" name="channel">
                    @foreach($channels as $channel)
                        <option value="{{$channel->id}}">{{$channel->name}}</option>
                    @endforeach
                </select>
                @error('channel')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="form-control @error('content') border border-danger @enderror"></textarea>
                @error('content')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection