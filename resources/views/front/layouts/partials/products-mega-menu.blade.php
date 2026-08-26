@php
$product_mega_ranges = [
    '1. Stainless Steel Seamless Straight & U Tubes',
    '2. Stainless Steel Seamless Pipes',
    '3. Stainless Steel Welded Straight & U Tubes',
    '4. Stainless Steel Welded Pipes',
    '5. Stainless Steel Instrumentation & Hydraulic Tubes',
    '6. Nickel Alloy Seamless Straight & U Tubes',
    '7. Low Fin Seamless Straight & U Tubes',
    '8. Carbon Steel Seamless Straight & U Tubes',
    '9. Carbon Steel Seamless Pipes',
    '10. Carbon Steel Seamless Precision Fuel Injection & Hydraulic Tubes & Pipes',
    '11. Low Alloy Steel Seamless Straight & U Tubes',
    '12. Low Alloy Carbon Steel Seamless Pipes',
];

$product_mega_ranges_col_one = array_slice($product_mega_ranges, 0, 6);
$product_mega_ranges_col_two = array_slice($product_mega_ranges, 6);

$product_mega_industries = [
    ['icon' => asset('frontend/assets/images/MegaMenu/icon-oil-gas.png'), 'label' => 'Oil & Gas'],
    ['icon' => asset('frontend/assets/images/MegaMenu/icon-shipbuilding.png'), 'label' => 'Shipbuilding'],
    ['icon' => asset('frontend/assets/images/MegaMenu/icon-chemical.png'), 'label' => 'Chemical'],
    ['icon' => asset('frontend/assets/images/MegaMenu/icon-power-plant.png'), 'label' => 'Power Plant'],
    ['icon' => asset('frontend/assets/images/MegaMenu/icon-automotive.png'), 'label' => 'Automotive'],
];
@endphp

<div class="products-mega-backdrop" id="productsMegaBackdrop" aria-hidden="true"></div>

<div class="products-mega-menu" id="productsMegaMenu" aria-hidden="true">
    <div class="products-mega-layout">
        <div class="products-mega-col products-mega-col-overview">
            <div class="products-mega-overview">
                <div class="products-mega-overview-top">
                    <div class="products-mega-badge">
                        <span class="products-mega-badge-dot" aria-hidden="true"></span>
                        Products Overview
                    </div>
                    <div class="products-mega-overview-copy">
                        <h2 class="products-mega-overview-title">Advanced Tubing Solutions</h2>
                        <p class="products-mega-overview-text">ASTM / ASME certified tubes and pipes engineered for critical industrial applications worldwide.</p>
                    </div>
                </div>
                <a href="{{ route('home') }}#products" class="com_btn_red">Explore All Products <span class="ms-2"><svg width="20" height="9" viewBox="0 0 20 9" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 0.75L18.75 4.5L15 8.25M18.75 4.5H0.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></span></a>
            </div>
        </div>

        <div class="products-mega-col products-mega-col-ranges">
            <div class="products-mega-ranges">
                <div class="products-mega-badge">
                    <span class="products-mega-badge-dot" aria-hidden="true"></span>
                    Product Ranges
                </div>
                <div class="products-mega-ranges-grid">
                    <ul class="products-mega-range-list">
                        @foreach ($product_mega_ranges_col_one as $item)
                            <li><a href="{{ route('home') }}#products">{{ $item }}</a></li>
                        @endforeach
                    </ul>
                    <div class="products-mega-ranges-divider" aria-hidden="true"></div>
                    <ul class="products-mega-range-list">
                        @foreach ($product_mega_ranges_col_two as $item)
                            <li><a href="{{ route('home') }}#products">{{ $item }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="products-mega-col products-mega-col-featured">
            <div class="products-mega-featured">
                <div class="products-mega-badge">
                    <span class="products-mega-badge-dot" aria-hidden="true"></span>
                    Featured
                </div>
                <div class="products-mega-featured-card">
                    <div class="products-mega-industries">
                        <div class="products-mega-industries-row products-mega-industries-row-top">
                            @foreach (array_slice($product_mega_industries, 0, 2) as $industry)
                                <div class="products-mega-industry">
                                    <img src="{{ $industry['icon'] }}" alt="{{ $industry['label'] }}" class="products-mega-industry-icon" width="56" height="56">
                                    <span class="products-mega-industry-label">{{ $industry['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="products-mega-industries-row products-mega-industries-row-bottom">
                            @foreach (array_slice($product_mega_industries, 2) as $industry)
                                <div class="products-mega-industry">
                                    <img src="{{ $industry['icon'] }}" alt="{{ $industry['label'] }}" class="products-mega-industry-icon" width="56" height="56">
                                    <span class="products-mega-industry-label">{{ $industry['label'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="products-mega-featured-footer">
                        <h3 class="products-mega-featured-heading">Global Industry Solutions</h3>
                        <p class="products-mega-featured-text">ASTM / ASME certified for Oil &amp; Gas, Power, and Chemical industries.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
