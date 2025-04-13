<ul class="side-nav">
    <li class="side-nav-title">Pool Tests</li>
    @forelse($pools as $pool)
        <li class="side-nav-item">
            <a href="{{ route('pool-tests.create', $pool->pool_id) }}" class="side-nav-link">
                <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
                <span class="menu-text"> {{ $pool->pool_name }} </span>
                <span class="badge bg-success rounded-pill">5</span>
            </a>
        </li>
    @empty
        <li class="side-nav-item">
        <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
            <span class="menu-text">No Pools Found</span>
        </li>
    @endforelse
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#waterMetersCollapse" aria-expanded="false" aria-controls="waterMetersCollapse" class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-gauge"></i></span>
            <span class="menu-text">Water Meters</span>
            <span class="menu-arrow"><i class="ti ti-chevron-down"></i></span>
        </a>
        <div class="collapse" id="waterMetersCollapse">
            <ul class="side-nav-second-level">
                @forelse($waterMeters as $meter)
                    <li class="side-nav-item">
                        <a href="{{ route('water-meter.readings.index', $meter->water_meter_id) }}" class="side-nav-link">
                            <span class="menu-text">{{ $meter->location }}</span>
                        </a>
                    </li>
                @empty
                    <li class="side-nav-item">
                        <span class="menu-text">No Water Meters Found</span>
                    </li>
                @endforelse
            </ul>
        </div>
    </li>
