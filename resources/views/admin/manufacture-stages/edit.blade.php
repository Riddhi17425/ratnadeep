@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Edit Manufacture Stage</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('manufacture-stages.update', $manufactureStage->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $manufactureStage->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $manufactureStage->subtitle) }}">
                    @error('subtitle') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control">{{ old('description', $manufactureStage->description) }}</textarea>
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    @if($manufactureStage->image)
                        <img src="{{ asset($manufactureStage->image) }}" width="80" class="mb-2 d-block">
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Image Text</label>
                    <input type="text" name="alt_image_text" class="form-control" value="{{ old('alt_image_text', $manufactureStage->alt_image_text) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $manufactureStage->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $manufactureStage->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('manufacture-stages.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#description').summernote({ height: 200 });
    });
</script>
@endpush