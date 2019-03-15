<div class="sidebar" data-color="red" data-image="{{asset('assets/img/sidebar-4.jpg')}}">
    
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="/dashboard" class="simple-text">
                    Eco-Task
                </a>
            </div>

            <ul class="nav">
                @can('super-admin', Auth::user()->roles)
                <li class="@yield('dashboard_active')">
                    <a href="/dashboard">
                        <i class="pe-7s-graph"></i>
                        <p>Admin</p>
                    </a>
                </li>
                @endcan
                {{-- <li class="@yield('create_task_active')">
                    <a href="{{route('tasks.create')}}">
                        <i class="pe-7s-note"></i>
                        <p>Create Task</p>
                    </a>
                </li> --}}
                @cannot('super-admin', Auth::user()->roles)
                <li class="@yield('view_task_active')">
                    <a href="{{route('tasks.index')}}">
                        <i class="pe-7s-note2"></i>
                        <p>Tasks</p>
                    </a>
                </li>
                @endcannot
                @can('super-admin', Auth::user()->roles)
                <li class="@yield('settings_active')">
                    <a href="{{ route('settings')  }}">
                        <i class="pe-7s-settings"></i>
                        <p>Settings</p>
                    </a>
                </li>
                @endcan
                
            </ul>
        </div>
    </div>