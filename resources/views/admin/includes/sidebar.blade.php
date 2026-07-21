<div class="sidebar px-4 py-4 py-md-4 me-0">
    <div class="d-flex flex-column h-100">
        <a href="{{ route('dashboard') }}" class="mb-0 brand-icon">
            <span class="logo-icon"><i class="bi bi-mortarboard-fill fs-4"></i></span>
            <span class="logo-text">Ratnadeep</span>
        </a>
        <ul class="menu-list flex-grow-1 mt-3">
            <li>
                <a class="m-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="icofont-home fs-5"></i> <span>Dashboard</span>
                </a>
            </li>

            <li>
                
<a class="m-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">                <i class="icofont-listing-box fs-5"></i>
                <span>Categories</span>
            </a>
        </li>
        <li>
                <a class="m-link {{ request()->routeIs('banners.*') ? 'active' : '' }}" href="{{ route('banners.index') }}">
                    <i class="icofont-image fs-5"></i>
                    <span>Banners</span>
                </a>
            </li>

            <li>
    <a class="m-link {{ request()->routeIs('industries.*') ? 'active' : '' }}" href="{{ route('industries.index') }}">
        <i class="icofont-building-alt fs-5"></i>
        <span>Industries</span>
    </a>
</li>

        <li>
            <a class="m-link {{ request()->routeIs('upcoming-events.*') ? 'active' : '' }}" href="{{ route('upcoming-events.index') }}">
                <i class="icofont-calendar fs-5"></i>
                <span>Upcoming Events</span>
            </a>
        </li>

        <li>
            <a class="m-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">
                <i class="icofont-blogger fs-5"></i>
                <span>Blogs</span>
            </a>
        </li>

        <li>
            <a class="m-link {{ request()->routeIs('settings.*') ? 'active' : '' }}" href="{{ route('settings.edit') }}">
                <i class="icofont-gear fs-5"></i>
                <span>Settings</span>
            </a>
        </li>

        <li>
            <a class="m-link {{ request()->routeIs('certificates.*') ? 'active' : '' }}" href="{{ route('certificates.index') }}">
                <i class="icofont-certificate-alt-1 fs-5"></i>
                <span>Certificates</span>
            </a>
        </li>

        <li>
            <a class="m-link {{ request()->routeIs('manufacture-stages.*') ? 'active' : '' }}" href="{{ route('manufacture-stages.index') }}">
                <i class="icofont-industries-1 fs-5"></i>
                <span>Manufacture Stages</span>
            </a>
        </li>
            {{-- more modules get added here as we build them out --}}
        </ul>
        <button type="button" class="btn btn-link sidebar-mini-btn text-light">
            <span class="ms-2"><i class="icofont-bubble-right"></i></span>
        </button>
    </div>
</div>
