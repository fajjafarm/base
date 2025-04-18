<ul class="side-nav">
    <li class="side-nav-title">Plant Room & Water Meters</li>

    <!-- Backwashing -->
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarBackwashes" 
           aria-expanded="false" aria-controls="sidebarBackwashes" 
           class="side-nav-link collapsed">
            <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
            <span class="menu-text">Backwashing</span>
            <span class="menu-arrow"><i class="ti ti-chevron-down"></i></span>
        </a>
        @if($plantrooms->isNotEmpty())
            <div class="collapse" id="sidebarBackwashes">
                <ul class="sub-menu">
                    @foreach($plantrooms as $plantroom)
                        <li class="side-nav-item">
                            <a href="{{ route('backwashes.index', $plantroom->plantroom_id) }}" class="side-nav-link">
                                <span class="menu-text">{{ $plantroom->plantroom_name }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </li>

    <!-- Water Meter Readings -->
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarWaterMeters" 
           aria-expanded="false" aria-controls="sidebarWaterMeters" 
           class="side-nav-link collapsed">
            <span class="menu-icon"><i class="ti ti-gauge"></i></span>
            <span class="menu-text">Water Meter Readings</span>
            <span class="menu-arrow"><i class="ti ti-chevron-down"></i></span>
        </a>
        @if($waterMeters->isNotEmpty())
            <div class="collapse" id="sidebarWaterMeters">
                <ul class="sub-menu">
                    @foreach($waterMeters as $meter)
                        <li class="side-nav-item">
                            <a href="{{ route('water-meter.readings.index', $meter->water_meter_id) }}" class="side-nav-link">
                                <span class="menu-text">{{ $meter->location }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </li>
</ul>