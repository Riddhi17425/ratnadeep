@extends('admin.layouts.master')
@section('content')
<div class="body-wrapper">
    <h2>Edit Blog</h2>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category <span class="text-danger">*</span></label>
                        <input type="text" name="category" class="form-control" value="{{ old('category', $blog->category) }}" placeholder="e.g. Technology, Health, Finance">
                        @error('category') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Date <span class="text-danger">*</span></label>
                        <input type="date" name="date" class="form-control" value="{{ old('date', $blog->date?->format('Y-m-d')) }}">
                        @error('date') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}">
                    @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">URL Slug <span class="text-danger">*</span></label>
                    <input type="text" name="url" class="form-control" value="{{ old('url', $blog->url) }}">
                    @error('url') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Short Description <span class="text-danger">*</span></label>
                    <textarea name="short_description" class="form-control" rows="3">{{ old('short_description', $blog->short_description) }}</textarea>
                    @error('short_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Long Description <span class="text-danger">*</span></label>
                    <textarea name="long_description" id="long_description" class="form-control">{{ old('long_description', $blog->long_description) }}</textarea>
                    @error('long_description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Conclusion</label>
                    <textarea name="conclusion" id="conclusion" class="form-control">{{ old('conclusion', $blog->conclusion) }}</textarea>
                </div>

                <hr>
                <h5>Images</h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Front Image</label><br>
                        @if($blog->front_image)
                            <img src="{{ asset($blog->front_image) }}" width="80" class="mb-2 d-block">
                        @endif
                        <input type="file" name="front_image" class="form-control">
                        @error('front_image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Front Image Alt Text</label>
                        <input type="text" name="front_image_alt" class="form-control" value="{{ old('front_image_alt', $blog->front_image_alt) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Detail Image</label><br>
                        @if($blog->detail_image)
                            <img src="{{ asset($blog->detail_image) }}" width="80" class="mb-2 d-block">
                        @endif
                        <input type="file" name="detail_image" class="form-control">
                        @error('detail_image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Detail Image Alt Text</label>
                        <input type="text" name="detail_image_alt" class="form-control" value="{{ old('detail_image_alt', $blog->detail_image_alt) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image</label><br>
                       @if($blog->cta_image)
                            <img src="{{ asset($blog->cta_image) }}" width="80" class="mb-2 d-block">
                        @endif
                        <input type="file" name="cta_image" class="form-control">
                        @error('cta_image') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">CTA Image Alt Text</label>
                        <input type="text" name="cta_image_alt" class="form-control" value="{{ old('cta_image_alt', $blog->cta_image_alt) }}">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">CTA Link URL</label>
                    <input type="text" name="cta_link_url" class="form-control" value="{{ old('cta_link_url', $blog->cta_link_url) }}">
                </div>

                <hr>
                <h5>SEO</h5>

                <div class="mb-3">
                    <label class="form-label">Meta Title</label>
                    <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $blog->meta_title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Meta Description</label>
                    <textarea name="meta_description" class="form-control" rows="3">{{ old('meta_description', $blog->meta_description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Schema JSON</label>
                    <textarea name="schema_json" class="form-control" rows="5">{{ old('schema_json', $blog->schema_json) }}</textarea>
                    @error('schema_json') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <hr>
                <h5>FAQs</h5>

                <div id="faq-wrapper">
                    @php
                        $oldFaqs = old('faq_question') ? collect(old('faq_question'))->map(function($q, $i) {
                            return ['question' => $q, 'answer' => old('faq_answer')[$i] ?? ''];
                        }) : collect($blog->faqs ?: [['question' => '', 'answer' => '']]);
                    @endphp
                    @foreach($oldFaqs as $faq)
                    <div class="row faq-row mb-2">
                        <div class="col-md-5">
                            <input type="text" name="faq_question[]" class="form-control" placeholder="Question" value="{{ $faq['question'] ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="faq_answer[]" class="form-control" placeholder="Answer" value="{{ $faq['answer'] ?? '' }}">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger btn-sm remove-faq">X</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                <button type="button" id="add-faq" class="btn btn-secondary btn-sm mb-3">+ Add FAQ</button>

                <hr>

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('blogs.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#long_description').summernote({ height: 300 });
        $('#conclusion').summernote({ height: 200 });

        $('#add-faq').click(function () {
            var row = `
                <div class="row faq-row mb-2">
                    <div class="col-md-5">
                        <input type="text" name="faq_question[]" class="form-control" placeholder="Question">
                    </div>
                    <div class="col-md-6">
                        <input type="text" name="faq_answer[]" class="form-control" placeholder="Answer">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm remove-faq">X</button>
                    </div>
                </div>`;
            $('#faq-wrapper').append(row);
        });

        $(document).on('click', '.remove-faq', function () {
            $(this).closest('.faq-row').remove();
        });
    });
</script>
@endpush