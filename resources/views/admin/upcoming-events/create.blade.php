@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Add Upcoming Event</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('upcoming-events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title') }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" id="short_description" class="form-control">{{ old('short_description') }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date From</label>
                        <input type="date" name="date_from" class="form-control" value="{{ old('date_from') }}">
                        @error('date_from') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date To</label>
                        <input type="date" name="date_to" class="form-control" value="{{ old('date_to') }}">
                        @error('date_to') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Reference</label>
                    <input type="text" name="reference" class="form-control" value="{{ old('reference') }}" placeholder="Link or reference text">
                    @error('reference') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Icon</label>
                    <input type="file" name="icon" class="form-control">
                    @error('icon') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Icon Text</label>
                    <input type="text" name="alt_icon_text" class="form-control" value="{{ old('alt_icon_text') }}">
                    @error('alt_icon_text') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Video</label>
                    <input type="file" name="video" class="form-control" accept="video/*">
                    @error('video') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Video Text</label>
                    <input type="text" name="alt_video_text" class="form-control" value="{{ old('alt_video_text') }}">
                    @error('alt_video_text') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('upcoming-events.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#short_description').summernote({ height: 150 });
    });
</script>
@endpush