@php
    $savedOverview = data_get($product ?? null, 'overview', []);
    $savedGrades = data_get($product ?? null, 'grades', []);
    $features = old('features', data_get($product ?? null, 'features', []));
    $specs = old('specs', data_get($product ?? null, 'specs', []));
    $overviewText = old('overview_text', $savedOverview ? implode("\n\n", $savedOverview) : '');
    $gradesText = old('grades_text', $savedGrades ? implode("\n", $savedGrades) : '');
    $selectedApplications = array_map('intval', old('industry_ids', data_get($product ?? null, 'industry_ids', [])));
@endphp

<h5 class="mb-3">Listing card</h5>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Title <span class="text-danger">*</span></label>
        <input type="text" name="title" id="product-title" class="form-control" value="{{ old('title', data_get($product ?? null, 'title', '')) }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Slug</label>
        <input type="text" name="slug" id="product-slug" class="form-control" value="{{ old('slug', data_get($product ?? null, 'slug', '')) }}" placeholder="Generated from title">
        @error('slug') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Category (material family) <span class="text-danger">*</span></label>
        <select name="category_id" class="form-select">
            <option value="">Select category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', data_get($product ?? null, 'category_id', '')) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
            @endforeach
        </select>
        @error('category_id') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Type (shown in the detail hero badge)</label>
        <input type="text" name="type" class="form-control" value="{{ old('type', data_get($product ?? null, 'type', '')) }}" placeholder="Seamless Pipes">
        @error('type') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Sort order</label>
        <input type="number" min="0" name="sort_order" class="form-control" value="{{ old('sort_order', data_get($product ?? null, 'sort_order', 0)) }}">
        @error('sort_order') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Wide card (spans 2 columns)</label>
        <select name="is_wide" class="form-select">
            <option value="0" {{ old('is_wide', data_get($product ?? null, 'is_wide', false) ? 1 : 0) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('is_wide', data_get($product ?? null, 'is_wide', false) ? 1 : 0) == 1 ? 'selected' : '' }}>Yes</option>
        </select>
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Summary</label>
        <textarea name="summary" rows="3" class="form-control product-rich-text">{{ old('summary', data_get($product ?? null, 'summary', '')) }}</textarea>
        @error('summary') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Card image</label>
        <input type="file" name="image" class="form-control">
        @if(data_get($product ?? null, 'image'))
            <img src="{{ asset(data_get($product, 'image')) }}" alt="" width="120" class="mt-2 rounded">
        @endif
        @error('image') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Alt image text</label>
        <input type="text" name="alt_image_text" class="form-control" value="{{ old('alt_image_text', data_get($product ?? null, 'alt_image_text', '')) }}">
        @error('alt_image_text') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

<hr>
<h5 class="mb-1">Detail page</h5>
<p class="text-muted">Leave the blocks below empty to show only the hero, overview and industries on the detail page.</p>
<div class="row">
    <div class="col-12 mb-3">
        <label class="form-label">Hero text</label>
        <textarea name="hero_text" rows="2" class="form-control product-rich-text">{{ old('hero_text', data_get($product ?? null, 'hero_text', '')) }}</textarea>
        @error('hero_text') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Hero banner image (optional)</label>
        <input type="file" name="hero_image" class="form-control">
        @if(data_get($product ?? null, 'hero_image'))
            <img src="{{ asset(data_get($product, 'hero_image')) }}" alt="" width="160" class="mt-2 rounded">
        @endif
        @error('hero_image') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Datasheet (PDF, optional)</label>
        <input type="file" name="datasheet" class="form-control" accept="application/pdf">
        @if(data_get($product ?? null, 'datasheet'))
            <a href="{{ asset(data_get($product, 'datasheet')) }}" target="_blank" class="d-inline-block mt-2">Current datasheet</a>
        @endif
        @error('datasheet') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Overview title</label>
        <input type="text" name="overview_title" class="form-control" value="{{ old('overview_title', data_get($product ?? null, 'overview_title', '')) }}">
        @error('overview_title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-12 mb-3">
        <label class="form-label">Overview paragraphs <small class="text-muted">(leave a blank line between paragraphs)</small></label>
        <textarea name="overview_text" rows="8" class="form-control product-rich-text">{{ $overviewText }}</textarea>
        @error('overview_text') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Overview image</label>
        <input type="file" name="overview_image" class="form-control">
        @if(data_get($product ?? null, 'overview_image'))
            <img src="{{ asset(data_get($product, 'overview_image')) }}" alt="" width="200" class="mt-2 rounded">
        @endif
        @error('overview_image') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

<div class="mb-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-label mb-0">Feature cards (01, 02 ...)</label>
        <button type="button" class="btn btn-sm btn-outline-primary" id="addFeature"><i class="icofont-plus"></i> Add feature</button>
    </div>
    <div id="featureRows">
        @foreach($features as $i => $feature)
            <div class="row g-2 mb-2 repeat-row">
                <div class="col-md-4"><input type="text" name="features[{{ $i }}][title]" class="form-control" placeholder="Title" value="{{ $feature['title'] ?? '' }}"></div>
                <div class="col-md-7"><textarea name="features[{{ $i }}][text]" class="form-control product-feature-description" placeholder="Description">{{ $feature['text'] ?? '' }}</textarea></div>
                <div class="col-md-1"><button type="button" class="btn btn-danger w-100 remove-row"><i class="icofont-trash"></i></button></div>
            </div>
        @endforeach
    </div>
</div>

<div class="mb-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <label class="form-label mb-0">Specification table rows</label>
        <button type="button" class="btn btn-sm btn-outline-primary" id="addSpec"><i class="icofont-plus"></i> Add row</button>
    </div>
    <div id="specRows">
        @foreach($specs as $i => $spec)
            <div class="row g-2 mb-2 repeat-row">
                <div class="col-md-3"><input type="text" name="specs[{{ $i }}][parameter]" class="form-control" placeholder="Parameter" value="{{ $spec['parameter'] ?? '' }}"></div>
                <div class="col-md-4"><input type="text" name="specs[{{ $i }}][value]" class="form-control" placeholder="Range / Value" value="{{ $spec['value'] ?? '' }}"></div>
                <div class="col-md-4"><input type="text" name="specs[{{ $i }}][notes]" class="form-control" placeholder="Notes" value="{{ $spec['notes'] ?? '' }}"></div>
                <div class="col-md-1"><button type="button" class="btn btn-danger w-100 remove-row"><i class="icofont-trash"></i></button></div>
            </div>
        @endforeach
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Grades <small class="text-muted">(one grade per line)</small></label>
    <textarea name="grades_text" rows="6" class="form-control">{{ $gradesText }}</textarea>
    @error('grades_text') <small class="text-danger">{{ $message }}</small> @enderror
</div>

<div class="mb-3">
    <label class="form-label">Application cards shown on the detail page <small class="text-muted">(from Page Content; none selected = first 4 active cards)</small></label>
    <select name="industry_ids[]" class="form-select" multiple size="6">
        @foreach($applications as $application)
            <option value="{{ $application->id }}" {{ in_array($application->id, $selectedApplications) ? 'selected' : '' }}>{{ $application->title }}</option>
        @endforeach
    </select>
    <small class="text-muted">Hold Ctrl / Cmd to select several. Cards follow the order of the Application Cards section in Page Content.</small>
    @error('industry_ids') <small class="text-danger d-block">{{ $message }}</small> @enderror
</div>

<hr>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Meta title</label>
        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', data_get($product ?? null, 'meta_title', '')) }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Meta description</label>
        <input type="text" name="meta_description" class="form-control" value="{{ old('meta_description', data_get($product ?? null, 'meta_description', '')) }}">
    </div>
    <div class="col-md-3 mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
            <option value="1" {{ old('status', data_get($product ?? null, 'status', 1)) == 1 ? 'selected' : '' }}>Active</option>
            <option value="0" {{ old('status', data_get($product ?? null, 'status', 1)) == 0 ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status') <small class="text-danger">{{ $message }}</small> @enderror
    </div>
</div>

@push('scripts')
<script>
    (function () {
        var featureIndex = {{ count($features) }};
        var specIndex = {{ count($specs) }};

        function row(html) {
            var wrap = document.createElement('div');
            wrap.className = 'row g-2 mb-2 repeat-row';
            wrap.innerHTML = html;
            return wrap;
        }

        document.getElementById('addFeature').addEventListener('click', function () {
            var featureRow = row(
                '<div class="col-md-4"><input type="text" name="features[' + featureIndex + '][title]" class="form-control" placeholder="Title"></div>' +
                '<div class="col-md-7"><textarea name="features[' + featureIndex + '][text]" class="form-control product-feature-description" placeholder="Description"></textarea></div>' +
                '<div class="col-md-1"><button type="button" class="btn btn-danger w-100 remove-row"><i class="icofont-trash"></i></button></div>'
            );
            document.getElementById('featureRows').appendChild(featureRow);
            $(featureRow).find('.product-feature-description').summernote({ height: 140 });
            featureIndex++;
        });

        document.getElementById('addSpec').addEventListener('click', function () {
            document.getElementById('specRows').appendChild(row(
                '<div class="col-md-3"><input type="text" name="specs[' + specIndex + '][parameter]" class="form-control" placeholder="Parameter"></div>' +
                '<div class="col-md-4"><input type="text" name="specs[' + specIndex + '][value]" class="form-control" placeholder="Range / Value"></div>' +
                '<div class="col-md-4"><input type="text" name="specs[' + specIndex + '][notes]" class="form-control" placeholder="Notes"></div>' +
                '<div class="col-md-1"><button type="button" class="btn btn-danger w-100 remove-row"><i class="icofont-trash"></i></button></div>'
            ));
            specIndex++;
        });

        document.addEventListener('click', function (e) {
            var btn = e.target.closest('.remove-row');
            if (btn) { btn.closest('.repeat-row').remove(); }
        });
    })();
</script>
<script>
$(function () {
    $('.product-rich-text').summernote({ height: 200 });
    $('.product-feature-description').summernote({ height: 140 });
});
</script>
@include('admin.partials.slug-generator', ['titleId' => 'product-title', 'slugId' => 'product-slug'])
@endpush
