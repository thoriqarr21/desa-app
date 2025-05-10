@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit User</h5>
                    <a class="btn btn-primary btn-sm" href="{{ route('users.index') }}">
                        <i class="fa fa-arrow-left"></i> Back
                    </a>
                </div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>Name:</strong></label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label"><strong>Username:</strong></label>
                            <input type="text" name="username" class="form-control" value="{{ $user->username }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label"><strong>Password:</strong></label>
                            <input type="password" name="password" class="form-control" placeholder="Leave blank if not changing">
                        </div>

                        <div class="mb-3">
                            <label for="confirm-password" class="form-label"><strong>Confirm Password:</strong></label>
                            <input type="password" name="confirm-password" class="form-control" placeholder="Leave blank if not changing">
                        </div>

                        <div class="mb-3">
                            <label for="roles" class="form-label"><strong>Role:</strong></label>
                            <select name="roles[]" class="form-control" required>
                                @foreach ($roles as $value => $label)
                                    <option value="{{ $value }}" {{ isset($userRole[$value]) ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                <i class="fa-solid fa-floppy-disk"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
