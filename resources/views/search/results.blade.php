@extends('layouts.app')
@section('title','Search results')
@section('content')
<h2>Search results for: "{{ $q }}"</h2>

@if($results['medicines']->isEmpty() && $results['diseases']->isEmpty())
  <div class="alert alert-warning">No results found.</div>
@endif

@if($results['medicines']->isNotEmpty())
  <h3>Medicines</h3>
  <div class="row">
    @foreach($results['medicines'] as $m)
      <div class="col-md-4">
        <div class="card mb-3">
          <div class="card-body">
            <h5>{{ $m->name }}</h5>
            <p>{{ \Illuminate\Support\Str::limit($m->functions, 120) }}</p>
            <p>@foreach($m->diseases as $d) <span class="badge bg-info text-dark">{{ $d->name }}</span> @endforeach</p>
            <a href="{{ route('medicines.show', $m) }}" class="btn btn-sm btn-primary">View</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endif

@if($results['diseases']->isNotEmpty())
  <h3>Diseases / Problems</h3>
  @foreach($results['diseases'] as $d)
    <div class="mb-3">
      <h5>{{ $d->name }}</h5>
      <p>
        Recommended medicines:
        @foreach($d->medicines as $m)
          <a href="{{ route('medicines.show', $m) }}" class="badge bg-success text-white">{{ $m->name }}</a>
        @endforeach
      </p>
    </div>
  @endforeach
@endif

@endsection
