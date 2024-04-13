@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <form action="{{ route('del.search') }}" method="get">
                    @csrf
                    <div class="input-group input-group" style="width: 250px;">

                        <input type="text"  name="query" value="" class="form-control float-right" placeholder="Recherche">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th width="60">ID</th>
                <th>Name</th>
                <th>Mail</th>
                <th>Date_suppression</th>
                <th>Type</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->usertype }}</td>
                <td>
                    <form action="{{ route('users.restore', $user->id) }}" method="POST">
                        @csrf
                        @method('get')
                        <button type="submit" class="btn btn-outline-primary">Restaurer</button>
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="card-footer clearfix">
    <ul class="pagination pagination m-0 float-right">
        {{ $users->appends(request()->input())->links() }}
    </ul>
</div>
@endsection
