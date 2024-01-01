@extends('backend.layouts.app')

@section('title', __('Update Quiz'))

@section('css')
    <link href="{{ asset('public/assets/backend/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    @include('alert')
                    <div class="card-body">
                        <h4 class="header-title">{{ __('Update Quiz') }}</h4>
                        <p class="text-muted font-13 mb-4 text-end mt-n4">
                            <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i class="fe-list"></i> {{ __('All Quiz') }}</a>
                        </p>
                        
                        <form action="{{ route('admin.quizzes.update', $quiz->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="row mb-3">
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Category') }}</label>
                                            <select class="form-control" name="category_id" id="category_id" data-toggle="select2" data-width="100%" required="">
                                                <option value="">{{ __('Select One') }}</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" {{ $category->id == $quiz->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('Title') }}" required="" value="{{ old('title', $quiz->title) }}">
                                            @error('title')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label class="form-label">{{ __('Status') }}</label>
                                            <select class="form-control" name="status" id="status" data-toggle="select2" data-width="100%" required="">

                                                <option value="Published" {{ 'Published' == $quiz->status ? 'selected' : '' }}>{{ __('Published') }}</option>
                                                <option value="In Review" {{ 'In Review' == $quiz->status ? 'selected' : '' }}>{{ __('In Review') }}</option>

                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <label for="name" class="form-label">{{ __('Type') }}</label>
                                            <select class="form-control" name="type" id="type" data-toggle="select2" data-width="100%" required="">
                                                <option value="Free" {{ 'Free' == $quiz->type ? 'selected' : '' }}>{{ __('Free') }}</option>
                                                <option value="Premium" {{ 'Premium' == $quiz->type ? 'selected' : '' }}>{{ __('Premium') }}</option>
                                            </select>
                                            @error('type')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-lg-4 mb-3" id="price-div" style="display:{{  $quiz->type != 'Premium' ? 'none' : '' }}">
                                            <label class="form-label">{{ __('Price') }}</label>
                                            <input type="text" name="price" id="price" class="form-control" placeholder="{{ __('Price') }}" value="{{ old('price', $quiz->price) }}">
                                            @error('price')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <label for="description" class="form-label">{{ __('Description') }}</label>
                                            <textarea class="form-control" id="editor" name="description" placeholder="{{ __('Description') }}">{{ old('description', $quiz->description) }}</textarea>
                                            @error('title')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="card card-border">
                                        <img class="card-img-top img-fluid" id="quiz-photo" src="{{ file_exists($quiz->photo) ? asset($quiz->photo) : asset('public/images/dummy/quiz.jpg') }}" alt="{{ __('Quiz Image') }}">
                                        <div class="card-body">
                                            <input type="file" name="photo" class="form-control" id="quiz-photo-input">
                                            @error('photo')
                                                <div class="invalid-feedback error">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <a href="{{ route('admin.quizzes.index') }}" class="btn btn-outline-danger waves-effect waves-light"><i class="fe-delete"></i> {{ __('Cancel') }}</a>
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
    <script src="{{ asset('public/assets/backend/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/assets/backend/js/pages/form-advanced.init.js') }}"></script>
    <script src="{{ asset('Modules/Quiz/Resources/assets/js/quiz.js') }}"></script>
@endsection