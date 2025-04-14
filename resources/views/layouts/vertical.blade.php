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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Footer Scripts -->
    @include('layouts.partials.footer-scripts')

    <!-- Custom Scripts -->
    @stack('js')

    <!-- Manual Collapse Initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log('Initializing manual collapse');
            const toggles = document.querySelectorAll('[data-bs-toggle="collapse"]');
            console.log('Found toggles:', toggles.length);
            toggles.forEach(toggle => {
                const target = toggle.getAttribute('href');
                if (!target) {
                    console.error('Missing href attribute on toggle:', toggle.outerHTML);
                    return;
                }
                const collapseElement = document.querySelector(target);
                if (collapseElement) {
                    const newToggle = toggle.cloneNode(true);
                    toggle.parentNode.replaceChild(newToggle, toggle);
                    newToggle.classList.add('collapsed');
                    newToggle.setAttribute('aria-expanded', 'false');
                    newToggle.addEventListener('click', (e) => {
                        console.log('Toggling:', target);
                        const bsCollapse = new bootstrap.Collapse(collapseElement, { toggle: true });
                        newToggle.classList.toggle('collapsed');
                        newToggle.setAttribute('aria-expanded', !newToggle.classList.contains('collapsed'));
                        const arrow = newToggle.querySelector('.menu-arrow i');
                        console.log('Arrow class:', arrow ? arrow.className : 'No arrow found');
                        e.preventDefault();
                    });
                } else {
                    console.error('Collapse target not found for:', target);
                }
            });
        });
    </script>
</body>
</html>