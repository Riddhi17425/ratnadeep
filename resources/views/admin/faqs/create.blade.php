@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Add FAQ</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('faqs.store') }}" method="POST">
                @csrf

                @include('admin.faqs._form')

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('faqs.index', ['page' => $page]) }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
