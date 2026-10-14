@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Add Content Item</h2>
    <p class="text-muted">{{ $config['page'] }} / {{ $config['label'] }}</p>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('page-items.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.page-items._form')

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('page-items.index', ['section' => $section]) }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
