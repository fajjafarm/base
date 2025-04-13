<!DOCTYPE html>
<html @yield('html-attribute')>

<head>
    @include('layouts.partials.title-meta')

    @include('layouts.partials.head-css')
</head>

<body>

    <div class="wrapper">

        @include('layouts.partials.sidenav')
        @include('layouts.partials.topbar')


        <div class="page-content">
            <div class="page-container">

                @yield('content')

            </div>
            @include('layouts.partials.footer')
        </div>

    </div>

    @include('layouts.partials.customizer')

    @include('layouts.partials.footer-scripts')
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('js')
