@extends('layouts.app')

@section('title', __('Contact Us'))
@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="edu-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ __('Contact Us') }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Contact Us') }}</li>
                </ul>
            </div>
        </div>
        <ul class="shape-group">
            <li class="shape-1">
                <span></span>
            </li>
            <li class="shape-2 scene"><img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="shape"></li>
            <li class="shape-3 scene"><img data-depth="-2" src="{{ asset('public/assets/frontend/images/about/shape-15.png') }}" alt="shape"></li>
            <li class="shape-4">
                <span></span>
            </li>
            <li class="shape-5 scene"><img data-depth="2" src="{{ asset('public/assets/frontend/images/about/shape-07.png') }}" alt="shape"></li>
        </ul>
    </div>

    <!-- Contact Me Area Start -->
    <section class="contact-us-area">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-4 col-lg-6">
                    <div class="contact-us-info">
                        <h3 class="heading-title">{{ __('We\'re Always Eager to Hear From You!') }}</h3>
                        <ul class="address-list">
                            <li>
                                <h5 class="title">{{ __('Address') }}</h5>
                                <p>{{ $contact->address }}</p>
                            </li>
                            <li>
                                <h5 class="title">{{ __('Email') }}</h5>
                                <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                            </li>
                            <li>
                                <h5 class="title">{{ __('Phone') }}</h5>
                                <p><a href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a></p>
                            </li>
                        </ul>
                        <ul class="social-share">
                            <li><a href="{{ $contact->facebook }}"><i class="icon-facebook"></i></a></li>
                            <li><a href="{{ $contact->instagram }}"><i class="icon-instagram"></i></a></li>
                            <li><a href="{{ $contact->twitter }}"><i class="icon-twitter"></i></a></li>
                            <li><a href="{{ $contact->linkedin }}"><i class="icon-linkedin2"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="offset-xl-2 col-lg-6">
                    <div class="contact-form form-style-2">
                        <div class="section-title">
                            <h4 class="title">{{ __('Get In Touch') }}</h4>
                            <p>{{ __('Fill out this form if you have any query.') }}</p>
                        </div>
                        <span id="form_output"></span>
                        <form class="rnt-contact-form rwt-dynamic-form" id="contact-form" method="POST">
                            @csrf
                            <div class="row row--10">
                                <div class="form-group col-12">
                                    <input type="text" name="name" id="contact-name" placeholder="{{ __('Your name*') }}" required="true">
                                </div>
                                <div class="form-group col-12">
                                    <input type="email" name="email" id="contact-email" placeholder="{{ __('Enter your email*') }}" required="true">
                                </div>
                                <div class="form-group col-12">
                                    <input type="tel" name="phone" id="contact-phone" placeholder="{{ __('Phone number*') }}" required="true">
                                </div>
                                <div class="form-group col-12">
                                    <input type="tel" name="subject" id="contact-subject" placeholder="{{ __('Message subject*') }}" required="true">
                                </div>
                                <div class="form-group col-12">
                                    <textarea name="message" id="contact-message" cols="30" rows="4" placeholder="{{ __('Your message*') }}" required="true"></textarea>
                                </div>
                                <div class="form-group col-12">
                                    <button class="rn-btn edu-btn btn-medium" name="submit" type="submit">{{ __('Submit Message') }} <i class="icon-4"></i></button>
                                </div>
                            </div>
                        </form>
                        <ul class="shape-group">
                            <li class="shape-1 scene"><img data-depth="1" src="{{ asset('public/assets/frontend/images/about/shape-13.png') }}" alt="Shape"></li>
                            <li class="shape-2 scene"><img data-depth="-1" src="{{ asset('public/assets/frontend/images/counterup/shape-02.png') }}" alt="Shape"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Google Map Area Start -->
    <div class="google-map-area">
        <div class="mapouter">
            <div class="gmap_canvas">
                <iframe id="gmap_canvas"
                    src="<?= $contact->map ?>"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            });

            $('#contact-form').submit(function(event) {

                event.preventDefault();
                var formData = $('#contact-form').serialize();
                
                $.ajax({
                    url: '{{ route('queries.store') }}',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(data) {
                        if (data.errors.length > 0) {
                            var errorHtml = '';
                            for (var count = 0; count < data.errors.length; count++) {
                                errorHtml += '<div class="alert alert-danger">' + data.errors[
                                    count] + '</div>';
                            }
                            $('#form_output').html(errorHtml);
                        } else {
                            $('#form_output').html(data.success);
                            $('#contact-form')[0].reset();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
