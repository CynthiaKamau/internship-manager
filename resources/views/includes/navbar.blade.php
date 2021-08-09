<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  d-flex  align-items-center">
            <a class="navbar-brand" href="{{ route('home') }}" data-toggle="tooltip" data-original-title="{{ setting('company_name') }}">
                @if (setting('company_logo'))
                <img alt="{{ setting('company_name') }}"
                    height="45"
                    class="navbar-brand-img"
                    src="{{ asset(setting('company_logo')) }}">
                @else
                {{ substr(setting('company_name'), 0, 15) }}...
                @endif
            </a>
            <div class=" ml-auto ">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ (request()->is('home*')) ? 'active' : '' }}" href="{{route('home')}}">
                            <i class="ni ni-shop text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    @can('update-settings')
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('settings*')) ? 'active' : '' }}" href="{{route('settings.index')}}">
                                <i class="ni ni-settings-gear-65 text-primary"></i>
                                <span class="nav-link-text">Manage Settings</span>
                            </a>
                        </li>
                    @endcan

                    @canany(['view-category', 'create-category'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('category*')) ? 'active' : '' }}" href="#navbar-category"  data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-category">
                                <i class="fas text-primary fa-list-alt"></i>
                                <span class="nav-link-text">Manage Category</span>
                            </a>
                            <div class="collapse" id="navbar-category">
                                <ul class="nav nav-sm flex-column">
                                 @can('view-category')
                                    <li class="nav-item">
                                        <a href="{{route('category.index')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">All Categories</span></a>
                                    </li>
                                    @endcan
                                    @can( 'create-category')
                                    <li class="nav-item">
                                        <a href="{{route('category.create')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">Add New Category</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>

                    @endcan

                    @canany(['view-department', 'create-department'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('department*')) ? 'active' : '' }}" href="#navbar-department"  data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-department">
                                <i class="fas text-primary fa-list-alt"></i>
                                <span class="nav-link-text">Manage Department</span>
                            </a>
                            <div class="collapse" id="navbar-department">
                                <ul class="nav nav-sm flex-column">
                                 @can('view-department')
                                    <li class="nav-item">
                                        <a href="{{route('department.index')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">All Departments</span></a>
                                    </li>
                                    @endcan
                                    @can( 'create-department')
                                    <li class="nav-item">
                                        <a href="{{route('department.create')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">Add New Department</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>

                    @endcan

                    @if (!empty(Auth::user()->profile->facility_id))
                    @canany(['view-facility-department', 'create-facility-department'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('facility_department*', $user ?? '')) ? 'active' : '' }}" href="#navbar-facility-department"  data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-facility-department">
                                <i class="fas text-primary fa-list-alt"></i>
                                <span class="nav-link-text">Manage Facility Department</span>
                            </a>
                            <div class="collapse" id="navbar-facility-department">
                                <ul class="nav nav-sm flex-column">
                                 @can('view-facility-department')
                                    <li class="nav-item">
                                        <a href="{{ route('facility_department.index') }}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">All Facility Departments</span></a>
                                    </li>
                                    @endcan
                                    @can( 'create-facility-department')
                                    <li class="nav-item">
                                        <a href="{{ route('facility_department.create') }}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">Add New Department</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>

                    @endcan
                    @endif

                    @canany(['view-checkins', 'create-checkins'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('checkins*')) ? 'active' : '' }}" href="#navbar-checkins"  data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-checkins">
                                <i class="fas text-primary fa-list-alt"></i>
                                <span class="nav-link-text">Manage Checkins</span>
                            </a>
                            <div class="collapse" id="navbar-checkins">
                                <ul class="nav nav-sm flex-column">
                                 @can('view-checkins')
                                    <li class="nav-item">
                                        <a href="{{route('checkins.index')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">All Checkins</span></a>
                                    </li>
                                    @endcan
                                    @can( 'create-checkins')
                                    <li class="nav-item">
                                        <a href="{{route('checkins.edit', $checkin ?? '')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">Add New Checkins</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>

                    @endcan

                    @canany(['view-students', 'create-students'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('students*')) ? 'active' : '' }}" href="#navbar-students"  data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-students">
                                <i class="fas text-primary fa-list-alt"></i>
                                <span class="nav-link-text">Manage Students</span>
                            </a>
                            <div class="collapse" id="navbar-students">
                                <ul class="nav nav-sm flex-column">
                                 @can('view-students')
                                    <li class="nav-item">
                                        <a href="{{route('students.index')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">All students</span></a>
                                    </li>
                                    @endcan
                                    @can('create-students')
                                    <li class="nav-item">
                                        <a href="{{route('students.edit', $student ?? '')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">Add New Student</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>

                    @endcan

                    @canany(['view-internships', 'create-internships'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('internships*')) ? 'active' : '' }}" href="#navbar-internships"  data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-internships">
                                <i class="fas text-primary fa-list-alt"></i>
                                <span class="nav-link-text">Manage Internships</span>
                            </a>
                            <div class="collapse" id="navbar-internships">
                                <ul class="nav nav-sm flex-column">
                                 @can('view-internships')
                                    <li class="nav-item">
                                        <a href="{{route('internships.index')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">All Internships</span></a>
                                    </li>
                                @endcan
                                @can('update-internships')
                                <li class="nav-item">
                                        <a href="{{route('internships.create')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">Add Internship</span></a>
                                    </li>
                                @endcan
                                </ul>
                            </div>
                        </li>

                    @endcan

                    @canany(['view-post', 'create-post'])

                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('post*')) ? 'active' : '' }}" href="#navbar-post"  data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-post">
                                <i class="fas text-primary fa-tasks"></i>
                                <span class="nav-link-text">Manage Resources</span>
                            </a>
                            <div class="collapse" id="navbar-post">
                                <ul class="nav nav-sm flex-column">
                                 @can('view-post')
                                    <li class="nav-item">
                                        <a href="{{route('post.index')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">All Resources</span></a>
                                    </li>
                                    @endcan
                                    @can( 'create-post')
                                    <li class="nav-item">
                                        <a href="{{route('post.create')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">Add New Resource</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan
                    @canany(['view-user', 'create-user'])

                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('users*')) ? 'active' : '' }}" href="#navbar-users"  data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-users">
                                <i class="fas text-primary fa-tasks"></i>
                                <span class="nav-link-text">Manage Users</span>
                            </a>
                            <div class="collapse" id="navbar-users">
                                <ul class="nav nav-sm flex-column">
                                 @can('view-user')
                                    <li class="nav-item">
                                        <a href="{{route('users.index')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">All Users</span></a>
                                    </li>
                                    @endcan
                                    @can( 'create-user')
                                    <li class="nav-item">
                                        <a href="{{route('users.create')}}" class="nav-link"><span class="sidenav-mini-icon">D </span><span class="sidenav-normal">Add New User</span></a>
                                    </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @canany(['view-permission', 'create-permission'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('permissions*')) ? 'active' : '' }}" href="{{route('permissions.index')}}">
                                <i class="fas fa-lock-open text-primary"></i>
                                <span class="nav-link-text">Manage Permissions</span>
                            </a>
                        </li>
                    @endcan
                    @canany(['view-role', 'create-role'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('roles*')) ? 'active' : '' }}" href="{{route('roles.index')}}">
                                <i class="fas fa-lock text-primary"></i>
                                <span class="nav-link-text">Manage Roles</span>
                            </a>
                        </li>
                    @endcan

                    @canany(['media'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('media*')) ? 'active' : '' }}" href="{{route('media.index')}}">
                                <i class="fas fa-images text-primary"></i>
                                <span class="nav-link-text">Manage Media</span>
                            </a>
                        </li>
                    @endcan
                    @canany(['view-activity-log'])
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('activity-log*')) ? 'active' : '' }}" href="{{route('activity-log.index')}}">
                                <i class="fas fa-history text-primary"></i>
                                <span class="nav-link-text">Activity Log</span>
                            </a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <hr class="my-3">
                    </li>
                    <li class="nav-item">
                            <a class="nav-link active active-pro" href="{{route('components')}}">
                                <i class="ni ni-send text-primary"></i>
                                <span class="nav-link-text">Components</span>
                            </a>
                        </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
