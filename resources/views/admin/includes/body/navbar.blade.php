<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
         <div class="navbar-header">
            {{-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> --}}
            <a class="navbar-brand" href="#">@yield('page_name')</a>
        </div> 
        <div class="collapse navbar-collapse">
            {{-- <ul class="nav navbar-nav navbar-left">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-dashboard"></i>
                        <p class="hidden-lg hidden-md">Dashboard</p>
                    </a>
                </li>
                <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-globe"></i>
                            <b class="caret hidden-lg hidden-md"></b>
                            <p class="hidden-lg hidden-md">
                                5 Notifications
                                <b class="caret"></b>
                            </p>
                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">Notification 1</a></li>
                        <li><a href="#">Notification 2</a></li>
                        <li><a href="#">Notification 3</a></li>
                        <li><a href="#">Notification 4</a></li>
                        <li><a href="#">Another notification</a></li>
                      </ul>
                </li>
                <li>
                   <a href="">
                        <i class="fa fa-search"></i>
                        <p class="hidden-lg hidden-md">Search</p>
                    </a>
                </li>
            </ul> --}}

            <ul class="nav navbar-nav navbar-right">
                
                <li class="dropdown">
                        
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <p><i class="pe-7s-user"></i>
                                {{Auth::user()->name}}
                                <b class="caret"></b>
                            </p>

                      </a>
                      <ul class="dropdown-menu">
                        <li><a href="#">View Profile</a></li>
                        <li><a href="#">View All Tasks</a></li>
                        <li class="divider"></li>
                        <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>
    
                             <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 @csrf
                             </form>
                        </li>
                      </ul>
                </li>
                
                <li>
                    
                            
                    
                </li>
                <li class="separator hidden-lg"></li>
            </ul>
        </div>
    </div>
</nav>