@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>FAQs</h2>
        <a href="{{ route('faqs.create', ['page' => $page]) }}" class="btn btn-primary">
            <i class="icofont-plus"></i> Add FAQ
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <label class="form-label">Page</label>
            <select class="form-select" id="pageSwitch">
                @foreach($pages as $key => $name)
                    <option value="{{ route('faqs.index', ['page' => $key]) }}" {{ $key === $page ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="faqTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($faqs as $key => $faq)
                    <tr class="{{ $faq->trashed() ? 'table-light text-muted' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($faq->answer, 100) }}</td>
                        <td>{{ $faq->sort_order }}</td>
                        <td>@include('admin.partials.status-cell', ['model' => $faq])</td>
                        <td>@include('admin.partials.action-cell', ['model' => $faq, 'base' => 'faqs', 'title' => $faq->question])</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('admin.partials.crud-scripts', ['tableId' => 'faqTable', 'label' => 'FAQ', 'base' => 'faqs'])
    <script>
        document.getElementById('pageSwitch').addEventListener('change', function () {
            window.location.href = this.value;
        });
    </script>
@endpush
