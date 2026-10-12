@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="icofont-plus"></i> Add Product
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered" id="productTable">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Order</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                    <tr class="{{ $product->trashed() ? 'table-light text-muted' : '' }}">
                        <td>{{ $key + 1 }}</td>
                        <td>
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->alt_image_text }}" width="60" style="{{ $product->trashed() ? 'opacity:0.5' : '' }}">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            {{ $product->title }}
                            @if($product->hasDetail())
                                <span class="badge bg-info">Detail page</span>
                            @endif
                        </td>
                        <td>{{ $product->category->title ?? '—' }}</td>
                        <td>{{ $product->sort_order }}</td>
                        <td>@include('admin.partials.status-cell', ['model' => $product])</td>
                        <td>
                            @include('admin.partials.action-cell', [
                                'model' => $product,
                                'base' => 'products',
                                'title' => $product->title,
                                'viewRoute' => route('product.detail', $product->slug),
                            ])
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @include('admin.partials.crud-scripts', ['tableId' => 'productTable', 'label' => 'product', 'base' => 'products'])
@endpush
