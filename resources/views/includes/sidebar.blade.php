
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{route('dashboard')}}"><i class="fa fa-home"></i> Home </a>

            </li>

                @if(auth()->user()->hasPermission('users-read'))
            <li><a href="{{route('users.index')}}"><i class="fa fa-user"></i> Users </a>
            @endif
            @if(auth()->user()->hasPermission('departments-read'))

            <li><a href="{{route('departments.index')}}"><i class="fa fa-table"></i> Departments </a>
            @endif
            @if(auth()->user()->hasPermission('tasks-read'))

            <li><a href="{{route('tasks.index')}}"><i class="fa fa-plus-square"></i> Tasks </a>
            @endif

        </ul>
    </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->

<!-- /menu footer buttons -->


