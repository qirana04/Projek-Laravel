@extends('layouts.app')
@section('title',$medicine->name)
@section('content')
<h1>{{ $medicine->name }}</h1>
<p><strong>Functions:</strong><br> {!! nl2br(e($medicine->functions)) !!}</p>
<p><strong>Description:</strong><br> {!! nl2br(e($medicine->description)) !!}</p> 

<p>
  <strong>Related diseases:</strong><br>
  @foreach($medicine->diseases as $d) <span class="badge bg-info text-dark">{{ $d->name }}</span> @endforeach
</p>

<a href="{{ route('medicines.edit', $medicine) }}" class="btn btn-secondary">Edit</a>
<a href="{{ route('medicines.index') }}" class="btn btn-light">Back</a>
@endsection
