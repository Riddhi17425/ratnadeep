{{-- FAQ accordion shared by packaging / inspection / applications. Needs $faqs and $page (config/page_texts key) --}}
@if($faqs->isNotEmpty())
<section class="inner-section inner-section--last">
    <div class="container">
        <div class="faq-grid">
            <div class="inner-badge-wrap inner-badge-wrap--left">
                <div class="section-badge">
                    <span class="badge-dot purple-dot"></span>
                    {{ pt($page . '.faq_badge') }}
                </div>
                <h2 class="section-title inner-title">{{ pt($page . '.faq_title') }}</h2>
                <p class="inner-lead inner-lead--sm">{{ pt($page . '.faq_text') }}</p>
            </div>
            <div class="faq-list" data-exclusive="{{ in_array($page, ['applications', 'packaging', 'inspection'], true) ? 'true' : 'false' }}">
                @foreach($faqs as $faq)
                    <div class="faq-item {{ $loop->first ? 'is-open' : '' }}">
                        <button type="button" class="faq-question" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                            <span>{{ $faq->question }}</span>
                            <span class="faq-icon"><svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.5L6 6.5L11 1.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </button>
                        <div class="faq-answer">{{ $faq->answer }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
