@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Create role</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="post" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name"><strong>Name</strong></label>
                        <input type="text" class="form-control" name="name" id="name" />
                    </div>
                    <div class="form-group">
                        <label><strong>Permissions</strong></label>
                        @foreach($permissions as $permission)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="permission_checkbox_{{ $permission->id }}" name="permission_checkbox_{{ $permission->id }}">
                                <label class="form-check-label" for="permission_checkbox_{{ $permission->id }}">
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr/>
                    <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">Back</a>
                    <button type="submit" class="btn btn-outline-success">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection
