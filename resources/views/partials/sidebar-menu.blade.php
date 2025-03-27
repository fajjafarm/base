<ul class="side-nav">
    <li class="side-nav-title">Pool Tests</li>
    @forelse($pools as $pool)
        <li class="side-nav-item">
            <a href="{{ route('pool-tests.create', $pool->pool_id) }}" class="side-nav-link">
                <span class="menu-icon"><i class="ti ti-bar-chart"></i></span>
                <span class="menu-text"> {{ $pool->pool_name }} </span>
                <span class="badge bg-success rounded-pill">5</span>
            </a>
        </li>
    @empty
        <li class="side-nav-item">
        <span class="menu-icon"><i class="ti ti-bar-chart"></i></span>
            <span class="menu-text">No Pools Found</span>
        </li>
    @endforelse