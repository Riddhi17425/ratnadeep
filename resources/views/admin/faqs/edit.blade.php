@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Edit FAQ</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('faqs.update', $faq->id) }}" method="POST">
                @csrf
                @method('PUT')

                @include('admin.faqs._form')

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('faqs.index', ['page' => $faq->page]) }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
