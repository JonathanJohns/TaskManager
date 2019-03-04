<body>

    @yield('modals')
    <div class="wrapper">

        @include('admin.includes.body.sidebar')

        <div class="main-panel">

            @include('admin.includes.body.navbar')

            <div class="content">

                <div class="container-fluid">
                    @yield('content')
                   
                </div>
                 
            </div>
            @include('admin.includes.body.footer')
        </div>
    </div>
    
    
</body>
    