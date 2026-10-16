@extends('admin.layouts.master')
@section('content')
@php
    $isTextPage = $textPage !== null;
    $config = $isTextPage
        ? [
            'page' => data_get($textPages, (string) $textPage . '.label', 'Page'),
            'label' => 'Page Details',
            'image' => false,
            'description' => false,
            'contact' => false,
        ]
        : ($sections[(string) $section] ?? []);
    $pageContentTitle = $config['page'] . ' Content';
    $columnCount = 5 + (int) (bool) $config['image'] + (int) $config['description'] + (int) !empty($config['contact']);
@endphp
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>{{ $pageContentTitle }}</h2>
        @unless($isTextPage)
        <a href="{{ route('page-items.create', ['section' => $section]) }}" class="btn btn-primary">
            <i class="icofont-plus"></i> Add Content Item
        </a>
        @endunless
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('page-items.index') }}" method="GET">
                <label class="form-label" for="sectionSwitch">Choose page content</label>
                <select class="form-select" id="sectionSwitch" name="section" onchange="this.form.submit()">
                    @foreach($contentGroups as $pageName => $group)
                        <optgroup label="{{ $pageName }}">
                            @foreach($group['sections'] ?? [] as $key => $sectionConfig)
                                <option value="{{ $key }}" {{ $key === $section ? 'selected' : '' }}>{{ $sectionConfig['label'] }}</option>
                            @endforeach
                            @if(isset($group['text_page']))
                                <option value="text:{{ $group['text_page'] }}" {{ $section === 'text:' . $group['text_page'] ? 'selected' : '' }}>Page Details</option>
                            @endif
                        </optgroup>
                    @endforeach
                </select>
            </form>
            <small class="text-muted">
                @if($isTextPage)
                    Edit the page-wide text and images for {{ $config['page'] }}.
                @else
                    Manage {{ strtolower($config['label']) }} on the {{ $config['page'] }} page. Use display order to control their sequence.
                @endif
            </small>
        </div>
    </div>

    @if($isTextPage)
    <div class="card">
        <div class="card-body">
            <form action="{{ route('page-content.texts.update', $textPage) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach(data_get($textPages, (string) $textPage . '.fields', []) as $key => [$label, $type, $default])
                    @php $value = old($key, $textValues[$key] ?? $default); @endphp
                    <div class="mb-3">
                        <label class="form-label" for="page-text-{{ $key }}">{{ $label }}</label>
                        @if($type === 'textarea')
                            <textarea id="page-text-{{ $key }}" name="{{ $key }}" rows="{{ max(2, min(8, (int) ceil(strlen($default) / 110) + 1)) }}" class="form-control">{{ $value }}</textarea>
                        @elseif($type === 'image')
                            <input id="page-text-{{ $key }}" type="file" name="{{ $key }}" class="form-control">
                            <div class="mt-2 d-flex align-items-center gap-3">
                                <img src="{{ asset($textValues[$key] ?? $default) }}" alt="" height="70" class="rounded border">
                                @if(isset($textValues[$key]))
                                    <div class="form-check">
                                        <input type="checkbox" name="reset_{{ $key }}" value="1" class="form-check-input" id="reset_{{ $key }}">
                                        <label class="form-check-label" for="reset_{{ $key }}">Use the original image again</label>
                                    </div>
                                @endif
                            </div>
                        @else
                            <input id="page-text-{{ $key }}" type="text" name="{{ $key }}" class="form-control" value="{{ $value }}">
                        @endif
                        @error($key) <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                @endforeach
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="pageItemTable">
                <thead>
                    <tr>
                        <th>#</th>
                        @if($config['image'])<th>Image</th>@endif
                        <th>Title</th>
                        @if($config['description'])<th>{{ $config['description_label'] ?? 'Description' }}</th>@endif
                        @if(!empty($config['contact']))<th>Phone / Email</th>@endif
                        <th>Display order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $key => $item)
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
                    @empty
                    <tr>
                        <td colspan="{{ $columnCount }}" class="text-center text-muted">
                            No content items yet. Use “Add Content Item” to create the first one.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
    @unless($isTextPage)
    @include('admin.partials.crud-scripts', ['tableId' => 'pageItemTable', 'label' => 'item', 'base' => 'page-items'])
    @endunless
@endpush
