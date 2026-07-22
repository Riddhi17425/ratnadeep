@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Edit Banner</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-select">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $banner->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $banner->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Short Note</label>
                    <input type="text" name="shortnote" class="form-control" value="{{ old('shortnote', $banner->shortnote) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $banner->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    @if($banner->image)
                        <img src="{{ asset($banner->image) }}" width="80" class="mb-2 d-block">
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Image Text</label>
                    <input type="text" name="alt_image_text" class="form-control" value="{{ old('alt_image_text', $banner->alt_image_text) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('banners.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#description').summernote({ height: 250 });
    });
</script>
@endpush