@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Edit About Page Logo</h2>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('about-logos.update', $aboutLogo) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Name <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $aboutLogo->title) }}" required>
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Logo</label>
                    @if($aboutLogo->image)
                        <img src="{{ asset($aboutLogo->image) }}" alt="{{ $aboutLogo->alt_image_text ?: $aboutLogo->title }}" width="100" class="mb-2 d-block">
                    @endif
                    <input type="file" name="image" class="form-control" accept=".jpg,.jpeg,.png,.webp">
                    @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Alt Image Text</label>
                    <input type="text" name="alt_image_text" class="form-control" value="{{ old('alt_image_text', $aboutLogo->alt_image_text) }}">
                    @error('alt_image_text') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        <option value="1" {{ old('status', (string) $aboutLogo->status) === '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', (string) $aboutLogo->status) === '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('about-logos.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection
