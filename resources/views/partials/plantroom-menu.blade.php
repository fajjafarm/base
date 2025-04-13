<!-- resources/views/partials/plantroom-menu.blade.php -->
<ul class="side-nav">
    <li class="side-nav-title">Plant Room</li>
    <li class="side-nav-item">
        <a data-bs-toggle="collapse" href="#sidebarBackwashes" 
           aria-expanded="false" aria-controls="sidebarBackwashes" 
           class="side-nav-link">
            <span class="menu-icon"><i class="ti ti-dashboard"></i></span>
            <span class="menu-text">Backwashing</span>
            <span class="menu-arrow"></span>
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
</ul>