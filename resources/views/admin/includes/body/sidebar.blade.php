<div class="sidebar" data-color="red" data-image="{{asset('assets/img/sidebar-3.jpg')}}">
    
    <!--

        Tip 1: you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple"
        Tip 2: you can also add an image using data-image tag

    -->

        <div class="sidebar-wrapper">
            <div class="logo">
                <a href="/dashboard" class="simple-text">
                    Task Manager
                </a>
            </div>

            <ul class="nav">
                <li class="@yield('dashboard_active')">
                    <a href="/dashboard">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                {{-- <li class="@yield('create_task_active')">
                    <a href="{{route('tasks.create')}}">
                        <i class="pe-7s-note"></i>
                        <p>Create Task</p>
                    </a>
                </li> --}}
                <li class="@yield('view_task_active')">
                    <a href="{{route('tasks.index')}}">
                        <i class="pe-7s-note2"></i>
                        <p>View Tasks</p>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>