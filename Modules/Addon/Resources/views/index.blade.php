@extends('backend.layouts.app')

@section('title', __('All Addon'))
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-lg-12 order-lg-1 order-2">
                @foreach ($addons as $addon)
                    @if($addon->get('core')) @continue @endif
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="d-flex align-items-start">
                                        <img class="d-flex align-self-center me-3 rounded" src="{{ asset('Modules/'. $addon->getName(). '/Resources/assets/'.config($addon->get('alias') . '.' . 'thumbnail') ) }}" alt="{{ $addon->getName() }}" height="64" width="94">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="d-flex align-items-start">
                                        <div class="w-100">
                                            <h4 class="mt-0 mb-2 font-16">{{ $addon->getName() }}</h4>
                                            <a href="{{ route('admin.addons.switch-status', $addon->get('alias')) }}" class="waves-effect waves-light">{{ $addon->isEnabled() ? __('Deactivate') : __('Activate') }}</a>
                                            @if(Config( $addon->getLowerName() . '.options'))
                                                @foreach(Config( $addon->getLowerName() . '.options') as $option)
                                                    | <a href="{{ isset($option['url']) ? $option['url'] : '' }}" class="waves-effect waves-light" target="{{ isset($option['target']) ? $option['target'] : '' }}"> {{ isset($option['label']) ? $option['label'] : '' }}</a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="text-center">
                                        <h6 class="waves-effect waves-light">{{ $addon->get('description') }}
                                            <br/>
                                            {{ __('Version:') }} <b>{{ $addon->get('version', 0) }}</b>
                                        
                                        </h6>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div>
                    </div> <!-- end card-->
                @endforeach
            </div> <!-- end col -->
        </div>
        <!-- end row -->

    </div> <!-- container -->
@endsection
