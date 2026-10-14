<input type="hidden" name="section" value="{{ $section }}">

<div class="mb-3">
    <label class="form-label">Page section</label>
    <input type="text" class="form-control" value="{{ $config['page'] }} — {{ $config['label'] }}" disabled>
</div>

<div class="mb-3">
    <label class="form-label">Item title <span class="text-danger">*</span></label>
    <input type="text" name="title" class="form-control" value="{{ old('title', data_get($item ?? null, 'title', '')) }}">
    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
</div>

@if($config['description'])
    <div class="mb-3">
        <label class="form-label">{{ $config['description_label'] ?? 'Description' }}</label>
        <textarea name="description" rows="4" class="form-control">{{ old('description', data_get($item ?? null, 'description', '')) }}</textarea>
        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
@endif

@if(!empty($config['contact']))
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', data_get($item ?? null, 'phone', '')) }}">
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', data_get($item ?? null, 'email', '')) }}">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
@endif

@if($config['image'])
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">{{ $config['image'] === 'icon' ? 'Icon' : 'Image' }}</label>
            <input type="file" name="image" class="form-control">
            @if(!empty($config['image_hint']))<small class="text-muted">{{ $config['image_hint'] }}</small>@endif
            @if(data_get($item ?? null, 'image'))
                <div class="mt-2"><img src="{{ asset(data_get($item, 'image')) }}" alt="" width="120" class="rounded border p-1"></div>
            @endif
            @error('image') <small class="text-danger d-block">{{ $message }}</small> @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Alt image text</label>
            <input type="text" name="alt_image_text" class="form-control" value="{{ old('alt_image_text', data_get($item ?? null, 'alt_image_text', '')) }}">
            @error('alt_image_text') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
    </div>
@endif

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">Display order</label>
        <input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', data_get($item ?? null, 'sort_order', 0)) }}">
        @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="1" {{ old('status', data_get($item ?? null, 'status', 1)) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', data_get($item ?? null, 'status', 1)) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>
