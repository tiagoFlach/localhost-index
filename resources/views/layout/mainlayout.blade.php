<!DOCTYPE html>
<html lang="en">

<head>

    @include('layout.partials.head')

</head>
<body id="page-top">
    
    <!-- Page Wrapper -->
    <div id="wrapper">

        @include('layout.partials.nav')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                @include('layout.partials.topbar')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @include('layout.partials.page-heading')

                    @include('layout.partials.top-cards')

                    @yield('page-content')

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
                
            @include('layout.partials.footer')
        
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    @include('layout.partials.scroll')    

    @include('layout.partials.footer-scripts')

</body>
</html>