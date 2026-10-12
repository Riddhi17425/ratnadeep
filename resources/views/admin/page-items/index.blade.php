@extends('admin.layouts.master')
@section('content')
@php $config = $sections[$section]; @endphp
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Page Content</h2>
        <a href="{{ route('page-items.create', ['section' => $section]) }}" class="btn btn-primary">
            <i class="icofont-plus"></i> Add Item
        </a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('page-items.index') }}" method="GET">
                <label class="form-label" for="sectionSwitch">Block</label>
                <select class="form-select" id="sectionSwitch" name="section" onchange="this.form.submit()">
                    @foreach(collect($sections)->groupBy('page', true) as $pageName => $group)
                        <optgroup label="{{ $pageName }}">
                            @foreach($group as $key => $sectionConfig)
                                <option value="{{ $key }}" {{ $key === $section ? 'selected' : '' }}>{{ $sectionConfig['label'] }}</option>
                            @endforeach
                        </optgroup>
                    @endforeach
                </select>
            </form>
            <small class="text-muted">Items appear on the {{ $config['page'] }} page in the order given by "Order".</small>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="pageItemTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        @if($config['image'])<th>Image</th>@endif
                        <th>Title</th>
                        @if($config['description'])<th>{{ $config['description_label'] ?? 'Description' }}</th>@endif
                        @if(!empty($config['contact']))<th>Phone / Email</th>@endif
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $key => $item)
                    <tr class="{{ $item->trashed() ? 'table-light text-muted' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        @if($config['image'])
                            <td>
                                @if($item->image)
                                    <img src="{{ asset($item->image) }}" alt="{{ $item->alt_image_text }}" width="50" style="{{ $item->trashed() ? 'opacity:0.5' : '' }}">
                                @else
                                    N/A
                                @endif
                            </td>
                        @endif
                        <td>{{ $item->title }}</td>
                        @if($config['description'])<td>{{ \Illuminate\Support\Str::limit($item->description, 90) }}</td>@endif
                        @if(!empty($config['contact']))<td>{{ $item->phone }}<br><small>{{ $item->email }}</small></td>@endif
                        <td>{{ $item->sort_order }}</td>
                        <td>@include('admin.partials.status-cell', ['model' => $item])</td>
                        <td>@include('admin.partials.action-cell', ['model' => $item, 'base' => 'page-items', 'title' => $item->title])</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('admin.partials.crud-scripts', ['tableId' => 'pageItemTable', 'label' => 'item', 'base' => 'page-items'])
@endpush
