@include('admin.includes.headerUrl')
<div id="ebazar-layout" class="theme-blue">
    @include('admin.includes.sidebar')
    <div class="main px-lg-4 px-md-4">
        @include('admin.includes.main-header')
        @include('admin.includes.toast')
        @yield('content')
    </div>
</div>
@include('admin.includes.footer')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('scripts')
</body>
</html>
