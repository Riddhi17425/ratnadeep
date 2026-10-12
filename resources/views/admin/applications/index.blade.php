@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Applications Page</h2>
        <a href="{{ route('applications') }}" target="_blank" class="btn btn-outline-primary">
            <i class="icofont-external-link"></i> View page
        </a>
    </div>
    <p class="text-muted">Everything shown on the Applications page is edited from here. Changes appear on the website immediately.</p>

    <div class="row">
        @foreach($blocks as $block)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <i class="{{ $block['icon'] }} fs-2 text-primary"></i>
                            <div>
                                <h5 class="mb-0">{{ $block['title'] }}</h5>
                                <small class="text-muted">{{ $block['count'] }} {{ $block['count_label'] ?? 'items' }}</small>
                            </div>
                        </div>
                        <p class="text-muted flex-grow-1">{{ $block['text'] }}</p>
                        <div class="d-flex gap-2">
                            <a href="{{ $block['list'] }}" class="btn btn-primary btn-sm"><i class="icofont-edit"></i> {{ $block['add'] ? 'Manage' : 'Edit' }}</a>
                            @if($block['add'])
                                <a href="{{ $block['add'] }}" class="btn btn-outline-secondary btn-sm"><i class="icofont-plus"></i> Add new</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
