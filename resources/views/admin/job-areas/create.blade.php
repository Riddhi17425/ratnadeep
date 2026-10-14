@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Add Job Area</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('job-areas.store') }}" method="POST">
                @csrf
                @include('admin.job-areas._form')

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('job-areas.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
