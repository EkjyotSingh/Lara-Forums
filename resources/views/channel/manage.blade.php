@extends('layouts.app')
@section('title',isset($channel)?'Edit Channel':'Add Channel')
@section('content')
<div class="card">
    <h5>
        <div class="card-header text-center">
            {{isset($channel)?'Edit Channel':'Add Channel'}}
        </div>
    </h5>
    <div class="card-body">
        <form action="{{isset($channel)?route('channel.update',$channel->id):route('channel.store')}}" method="post">
            @csrf
            @if(isset($channel))
                @method('PUT')
            @endif
            <div class="form-group">
                <label>Channel</label>
                <input type="text" placeholder="Channel Name" name="name" class="form-control @error('name') border border-danger @enderror"
                value="{{isset($channel)?$channel->name:''}}">
                @error('name')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">
                    {{isset($channel)?'Update Channel':'Add Channel'}}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection