@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show User</h2>
            </div>
            <div class="pull-right mb-3">
                <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $user->name }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $user->email }}
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Role:</strong>
                @if (!empty($user->getRoleNames()))
                    @foreach ($user->getRoleNames() as $v)
                        <p>{{ $v }}</p>
                    @endforeach
                @endif
            </div>
        </div>

    </div>
</div>

@endsection