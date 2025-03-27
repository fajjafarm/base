<ul class="side-nav">
    <li class="side-nav-title">Thermal Suite Checks</li>
    @forelse($thermalSuites as $suite)
        <li class="side-nav-item">
            <a href="{{ route('thermal-suites.check', $suite->id) }}" class="side-nav-link">
                <span class="menu-icon"><i class="ti ti-thermometer"></i></span>
                <span class="menu-text"> {{ $suite->thermal_name }} </span>
                @if($suite->needsCheck())
                    <span class="badge bg-warning rounded-pill">Check Needed</span>
                @elseif($suite->isRecentAndOk())
                    <span class="badge bg-success rounded-pill"><i class="ti ti-check"></i></span>
                @endif
            </a>
        </li>
    @empty
        <li class="side-nav-item">
            <span class="menu-text">No thermal suites found</span>
        </li>
    @endforelse