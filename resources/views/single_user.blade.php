@extends('layouts.app')
@section('content')

<a href="{{route('user.index')}}" class="btn btn-danger mb-5 d-inline-flex align-items-center justify-content-center">
    <svg class="icon icon-arrow-left2 mr-2">
        <use xlink:href="{{asset('img/sprite.svg#icon-arrow-left2')}}"></use>
    </svg>
    <span>Back</span>
</a>

<div class="row mb-3">
    <h5 class="col-auto">Name : <b>{{$user['name']}}</b></h5>
    <h5 class="col-auto">Discussions Count : <b>{{count($user->discussions)}}</b></h5>
    <h5 class="col-auto">Replies Count : <b>{{count($user->replies)}}</b></h5>
</div>
<div class="row gy-5 mb-3">
    <h5 class="col-auto">Account Creation Date : <b>{{$user['created_at']}}</b></h5>
    <h5 class="col-auto">Last Discussion Date : <b>{{$user['last_discussion_at']}}</b></h5>
    <h5 class="col-auto">Lasr Replied Date : <b>{{$user['last_reply_at']}}</b></h5>
</div>
<form class="form" action="{{route('user.update',$user['id'])}}" method="post">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control">
            <option value="writer" {{$user['role']=='writer'?'selected':''}}>
                Writer
            </option>
            <option value="admin" {{$user['role']=='admin'?'selected':''}}>
                Admin
            </option>
        </select>
    </div>

    <div class="form-group">
        <label>Discussion Status</label>
        <select name="discussion_status" class="form-control">
            <option value="0" {{$user['discussion_status']=='0'?'selected':''}}>
                0
            </option>
            <option value="1" {{$user['discussion_status']=='1'?'selected':''}}>
                1
            </option>
        </select>
    </div>

    <div class="form-group">
        <label>Reply Status</label>
        <select name="reply_status" class="form-control">
            <option value="0" {{$user['reply_status']=='0'?'selected':''}}>
                0
            </option>
            <option value="1" {{$user['reply_status']=='1'?'selected':''}}>
                1
            </option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>

@endsection