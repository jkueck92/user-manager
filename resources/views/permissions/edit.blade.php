@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Edit permission</div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="post" action="{{ route('permissions.update', $permission->id) }}">
                    @method('PATCH')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input disabled type="text" class="form-control" name="name" value={{ $permission->name }} />
                    </div>


                    <a href="{{ route('permissions.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-outline-success">Save</button>
                </form>


            </div>
        </div>
    </div>
@endsection
