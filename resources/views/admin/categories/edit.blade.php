@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Edit Category</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $category->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="shortdescription" class="form-control" rows="3">{{ old('shortdescription', $category->shortdescription) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="metatitle" class="form-control" value="{{ old('metatitle', $category->metatitle) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="metadescription" class="form-control" rows="3">{{ old('metadescription', $category->metadescription) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    @if($category->image)
                        <img src="{{ asset($category->image) }}" width="80" class="mb-2 d-block">
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Image Text</label>
                    <input type="text" name="alt_image_text" class="form-control" value="{{ old('alt_image_text', $category->alt_image_text) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $category->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $category->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
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