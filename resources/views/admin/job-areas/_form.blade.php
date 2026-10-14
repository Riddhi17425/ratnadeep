@php $area = $jobArea ?? null; @endphp

<div class="mb-3">
    <label class="form-label" for="job-area-name">Area name <span class="text-danger">*</span></label>
    <input id="job-area-name" type="text" name="name" class="form-control" value="{{ old('name', data_get($area, 'name', '')) }}" required maxlength="255">
    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label" for="job-area-order">Sort order</label>
        <input id="job-area-order" type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', data_get($area, 'sort_order', 0)) }}">
        @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label" for="job-area-status">Status</label>
        <select id="job-area-status" name="status" class="form-select">
            <option value="1" {{ old('status', data_get($area, 'status', 1)) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', data_get($area, 'status', 1)) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>
