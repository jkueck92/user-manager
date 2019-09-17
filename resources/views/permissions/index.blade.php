@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Permissions</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                    <a href="{{ route('permissions.create') }}" class="btn btn-outline-success" style="margin-bottom: 10px;">Create</a>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <th scope="row">{{ $permission->id }}</th>
                                <td><a href="{{ route('permissions.edit', $permission->id) }}">{{ $permission->name }}</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
@endsection
