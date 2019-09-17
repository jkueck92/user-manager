@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit user</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="post" action="{{ route('users.update', $user->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="firstname"><strong>Firstname</strong></label>
                        <input type="text" class="form-control" name="firstname" value={{ $user->firstname }} />
                    </div>

                    <div class="form-group">
                        <label for="lastname"><strong>Lastname</strong></label>
                        <input type="text" class="form-control" name="lastname" value={{ $user->lastname }} />
                    </div>

                    <div class="form-group">
                        <label for="email"><strong>Email</strong></label>
                        <input type="text" class="form-control" name="email" value={{ $user->email }} />
                    </div>

                    <div class="form-group">
                        <label><strong>Roles</strong></label>
                        @foreach($roles as $role)
                            <div class="form-check">
                                <input @if($user->hasRole($role)) checked @endif class="form-check-input" type="checkbox" id="role_checkbox_{{ $role->id }}" name="role_checkbox_{{ $role->id }}">
                                <label class="form-check-label" for="role_checkbox_{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <hr/>

                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-outline-success">Save</button>
                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger" type="submit">Delete</button>
                    </form>
                </form>


            </div>
        </div>
    </div>
@endsection
