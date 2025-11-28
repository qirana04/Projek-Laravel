@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Disease</h2>

    <form action="{{ route('diseases.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Disease Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
