<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset(getFavIcon()) }}">

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

        <!-- ========== End Page content ============ -->

        <!-- Top modal content -->
        <div id="delete-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-top">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="topModalLabel">{{ __('Confirm Delete') }}</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>{{ __('Are you sure you want to delete?') }}</h5>
                    </div>
                    <div class="modal-footer">
                        <form action="" method="post" id="delete-form">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ __('No') }}</button>
                            <button type="submit" class="btn btn-primary">{{ __('Yes') }}</button>
                        </form>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div>
    <!-- END wrapper -->

    @include('backend.layouts.partials.setting')

    @include('backend.layouts.partials.script')

</body>

</html>
