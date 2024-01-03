<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div><script>document.write(new Date().getFullYear())</script> © Kewme - <a href="{{ url('/') }}" target="_blank">Kewme.com</a></div>
            </div>
            <div class="col-md-6">
                <div class="d-none d-md-flex gap-1 align-item-center justify-content-md-end footer-links">
                   <b>{{ __('Version') }}</b> {{ config('app.version') }}
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->