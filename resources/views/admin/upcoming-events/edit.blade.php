@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Edit Upcoming Event</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('upcoming-events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" id="short_description" class="form-control">{{ old('short_description', $event->short_description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date From</label>
                        <input type="date" name="date_from" class="form-control" value="{{ old('date_from', $event->date_from?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date To</label>
                        <input type="date" name="date_to" class="form-control" value="{{ old('date_to', $event->date_to?->format('Y-m-d')) }}">
                        @error('date_to') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Reference</label>
                    <input type="text" name="reference" class="form-control" value="{{ old('reference', $event->reference) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Icon</label><br>
                    @if($event->icon)
                        <img src="{{ asset('storage/'.$event->icon) }}" width="60" class="mb-2 d-block">
                    @endif
                    <input type="file" name="icon" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Icon Text</label>
                    <input type="text" name="alt_icon_text" class="form-control" value="{{ old('alt_icon_text', $event->alt_icon_text) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Video</label><br>
                    @if($event->video)
                        <video width="200" controls class="mb-2 d-block">
                            <source src="{{ asset('storage/'.$event->video) }}">
                        </video>
                    @endif
                    <input type="file" name="video" class="form-control" accept="video/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alt Video Text</label>
                    <input type="text" name="alt_video_text" class="form-control" value="{{ old('alt_video_text', $event->alt_video_text) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ $event->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $event->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
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