@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Add Item</h2>

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
