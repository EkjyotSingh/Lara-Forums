@extends('layouts.app')
@section('content')
<h3 class="mb-5">
    Registered Users
</h3>
<div class="table-responsive">
    <table class="table table-hover text-center">
        <thead class="table-dark">
            <tr class="">
                <th>S.No</th>
                <th>Name</th>
                <th>Role</th>
                <th>Discussion Status</th>
                <th>Reply Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $i=1;?>
            @foreach($users as $user)
                <tr onclick="user({{$user['id']}})" style="cursor:pointer;">
                    <td>{{$i}}</td>
                    <td>{{$user['name']}}</td>
                    <td>{{$user['role']}}</td>
                    <td>{{$user['discussion_status']}}</td>
                    <td>{{$user['reply_status']}}</td>
                </tr>
                <form method="post" class="none user_form{{$user['id']}}" action="{{route('user.show',$user['id'])}}">@csrf</form>
                <?php $i++;?>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('script')
<script>
    function user(id){
        $(`.user_form${id}`).submit();
    }
    </script>
@endsection