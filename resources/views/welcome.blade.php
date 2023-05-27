<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard | Ubold - Responsive Bootstrap 5 Admin Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/assets/backend/images/favicon.ico') }}">

        @include('backend.layouts.partials.style')
    </head>

    <body>

        <!-- Begin page --> 
        <div id="wrapper">
            @include('backend.layouts.partials.sidebar')


            <!-- ==============  Page Content Start ================= -->

            <div class="content-page">

                @include('backend.layouts.partials.navbar')

                <div class="content">

                    @yield('content')

                </div> 
                <!-- content -->

                @include('backend.layouts.partials.footer')

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->

        </div>
        <!-- END wrapper -->

        @include('backend.layouts.partials.setting')

        @include('backend.layouts.partials.script')
        

    </body>
</html>
