@php $j = $jobOpening ?? null; @endphp

<div class="row">
    <div class="col-md-8 mb-3">
        <label class="form-label">Job title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $j->title ?? '') }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Area (filter tab) <span class="text-danger">*</span></label>
        <select name="area" class="form-select">
            @foreach($areas as $area)
                <option value="{{ $area }}" {{ old('area', $j->area ?? '') == $area ? 'selected' : '' }}>{{ $area }}</option>
            @endforeach
            @if($j && !in_array($j->area, $areas))
                <option value="{{ $j->area }}" selected>{{ $j->area }}</option>
            @endif
        </select>
        @error('area') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Department</label>
        <input type="text" name="department" class="form-control" value="{{ old('department', $j->department ?? '') }}" placeholder="Quality & Testing Division">
        @error('department') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location" class="form-control" value="{{ old('location', $j->location ?? '') }}" placeholder="Chhatral Plant, Gujarat">
        @error('location') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Experience required</label>
        <input type="text" name="experience" class="form-control" value="{{ old('experience', $j->experience ?? '') }}" placeholder="3 – 6 Years in Seamless Steel / Pipe Testing">
        @error('experience') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Qualifications</label>
        <input type="text" name="qualification" class="form-control" value="{{ old('qualification', $j->qualification ?? '') }}" placeholder="B.E. / B.Tech in Metallurgy">
        @error('qualification') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Sort order</label>
        <input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', $j->sort_order ?? 0) }}">
        @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="1" {{ old('status', $j->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $j->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>
