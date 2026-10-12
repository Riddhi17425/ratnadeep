@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Add Product</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @include('admin.products._form')

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
