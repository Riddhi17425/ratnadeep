@php $f = $faq ?? null; @endphp

<div class="mb-3">
    <label class="form-label">Page <span class="text-danger">*</span></label>
    <select name="page" class="form-select">
        @foreach($pages as $key => $name)
            <option value="{{ $key }}" {{ old('page', $f->page ?? ($page ?? '')) == $key ? 'selected' : '' }}>{{ $name }}</option>
        @endforeach
    </select>
    @error('page') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Question <span class="text-danger">*</span></label>
    <input type="text" name="question" class="form-control" value="{{ old('question', $f->question ?? '') }}">
    @error('question') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Answer <span class="text-danger">*</span></label>
    <textarea name="answer" rows="5" class="form-control">{{ old('answer', $f->answer ?? '') }}</textarea>
    @error('answer') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <label class="form-label">Sort order</label>
        <input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', $f->sort_order ?? 0) }}">
        @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="1" {{ old('status', $f->status ?? 1) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', $f->status ?? 1) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>
