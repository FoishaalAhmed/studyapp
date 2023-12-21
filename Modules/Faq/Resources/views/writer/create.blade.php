@extends('backend.layouts.app')

@section('title', __('New Faq'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('New Faq') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('writer.faqs.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Faq') }}</a>
                        </p>
                        <form action="{{ route('writer.faqs.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="question" class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Question') }}</label>
                                <div class="col-8 col-xl-4">
                                    <input type="text" name="question" id="question" class="form-control" placeholder="{{ __('Question') }}" required="" value="{{ old('question') }}">
                                    @error('question')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-3">
                                <label for="answer" class="col-4 col-xl-2 offset-lg-3 col-form-label text-end">{{ __('Answer') }}</label>
                                <div class="col-8 col-xl-4">
                                    <textarea name="answer" id="answer" class="form-control" placeholder="{{ __('Answer') }}" required="" rows="5">{{ old('answer') }}</textarea>
                                    @error('answer')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('writer.faqs.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
                                    <button type="submit" class="btn btn-outline-success waves-effect waves-light"><i class="fe-plus-circle"></i> {{ __('Submit') }}</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div>
        <!-- end row-->

    </div> <!-- container -->
@endsection