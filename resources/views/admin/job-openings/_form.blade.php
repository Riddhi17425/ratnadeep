@php
    $currentArea = data_get($jobOpening ?? null, 'area', '');
    $selectedArea = old('area', $currentArea);
@endphp

<div class="row">
    <div class="col-md-8 mb-3">
        <label class="form-label">Job title <span class="text-danger">*</span></label>
        <input type="text" name="title" class="form-control" value="{{ old('title', data_get($jobOpening ?? null, 'title', '')) }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Area (filter tab) <span class="text-danger">*</span></label>
        <select name="area" class="form-select" id="jobAreaSelect">
            <option value="" disabled {{ $selectedArea === '' ? 'selected' : '' }}>Select an area</option>
            @if($currentArea && !$areas->contains('name', $currentArea))
                <option value="{{ $currentArea }}" {{ $selectedArea === $currentArea ? 'selected' : '' }}>{{ $currentArea }} (inactive)</option>
            @endif
            @foreach($areas as $area)
                <option value="{{ $area->name }}" {{ $selectedArea === $area->name ? 'selected' : '' }}>{{ $area->name }}</option>
            @endforeach
        </select>
        @error('area') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Department</label>
        <input type="text" name="department" class="form-control" value="{{ old('department', data_get($jobOpening ?? null, 'department', '')) }}" placeholder="Quality & Testing Division">
        @error('department') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location" class="form-control" value="{{ old('location', data_get($jobOpening ?? null, 'location', '')) }}" placeholder="Chhatral Plant, Gujarat">
        @error('location') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Experience required</label>
        <input type="text" name="experience" class="form-control" value="{{ old('experience', data_get($jobOpening ?? null, 'experience', '')) }}" placeholder="3 – 6 Years in Seamless Steel / Pipe Testing">
        @error('experience') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Qualifications</label>
        <input type="text" name="qualification" class="form-control" value="{{ old('qualification', data_get($jobOpening ?? null, 'qualification', '')) }}" placeholder="B.E. / B.Tech in Metallurgy">
        @error('qualification') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Sort order</label>
        <input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', data_get($jobOpening ?? null, 'sort_order', 0)) }}">
        @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="1" {{ old('status', data_get($jobOpening ?? null, 'status', 1)) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', data_get($jobOpening ?? null, 'status', 1)) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>
