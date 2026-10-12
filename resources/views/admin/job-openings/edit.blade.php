@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Edit Job Opening</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('job-openings.update', $jobOpening->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.job-openings._form')

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('job-openings.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
