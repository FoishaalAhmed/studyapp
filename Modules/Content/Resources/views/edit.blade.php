@extends('backend.layouts.app')

@section('title', __('Update Content'))

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Update Content') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.contents.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Content') }}</a>
                        </p>
                        <form action="{{ route('admin.contents.update', $content->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="title" class="col-4 col-xl-2 offset-lg-1 col-form-label text-end">{{ __('Title') }}</label>
                                <div class="col-8 col-xl-7">
                                    <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title', $content->title) }}">
                                    @error('title')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category" class="col-4 col-xl-2 offset-lg-1 col-form-label text-end">{{ __('Category') }}</label>
                                <div class="col-8 col-xl-7">
                                    <input type="text" name="category" id="category" class="form-control" placeholder="{{ __('Category') }}" required="" value="{{ old('category', $content->category) }}">
                                    @error('category')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="text" class="col-4 col-xl-2 offset-lg-1 col-form-label text-end">{{ __('Text') }}</label>
                                <div class="col-8 col-xl-7">
                                    <textarea class="form-control" id="editor" name="text" placeholder="{{ __('Text') }}">{{ old('text', $content->text) }}</textarea>
                                    @error('text')
                                        <div class="invalid-feedback error">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.contents.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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

@section('js')
    <script src="https://cdn.ckeditor.com/4.5.7/full/ckeditor.js"></script>
    <script src="{{ asset('Modules/Content/Resources/assets/js/content.js') }}"></script>
@endsection