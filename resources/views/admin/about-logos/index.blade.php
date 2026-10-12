@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>About Page Logos</h2>
        <a href="{{ route('about-logos.create') }}" class="btn btn-primary">
            <i class="icofont-plus"></i> Add Logo
        </a>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Logo</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aboutLogos as $aboutLogo)
                        <tr class="{{ $aboutLogo->trashed() ? 'table-light text-muted' : '' }}">
                            <td>{{ $aboutLogo->title }}</td>
                            <td>
                                @if($aboutLogo->image)
                                    <img src="{{ asset($aboutLogo->image) }}" alt="{{ $aboutLogo->alt_image_text ?: $aboutLogo->title }}" width="70">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($aboutLogo->trashed())
                                    <span class="badge bg-danger">Trashed</span>
                                @else
                                    {{ $aboutLogo->status ? 'Active' : 'Inactive' }}
                                @endif
                            </td>
                            <td>
                                @if($aboutLogo->trashed())
                                    <form action="{{ route('about-logos.restore', $aboutLogo->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                    <form action="{{ route('about-logos.force-delete', $aboutLogo->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Permanently delete this logo?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete Permanently</button>
                                    </form>
                                @else
                                    <a href="{{ route('about-logos.edit', $aboutLogo) }}" class="btn btn-sm btn-info">Edit</a>
                                    <form action="{{ route('about-logos.destroy', $aboutLogo) }}" method="POST" class="d-inline" onsubmit="return confirm('Move this logo to trash?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No logos available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
