@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Add Job Opening</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('job-openings.store') }}" method="POST">
                @csrf

                @include('admin.job-openings._form')

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('job-openings.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
