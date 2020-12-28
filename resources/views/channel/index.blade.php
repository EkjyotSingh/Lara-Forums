@extends('layouts.app')
@section('content')
<div class="card">
    <h5>
        <div class="card-header text-center">
            Channels
        </div>
    </h5>
    
    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>
                            S.no
                        </th>
                        <th>
                           Name
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1?>
                    @foreach($channels as $channel)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$channel->name}}</td>
                            <td>
                                <a href="{{route('channel.edit',$channel->id)}}" class="btn btn-secondary">Edit</a>
                                <form action="{{route('channel.destroy',$channel->id)}}" method="post" class=" d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection