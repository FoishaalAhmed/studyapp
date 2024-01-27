@extends('backend.layouts.app')

@section('title', __('Mcq'))
@section('content')
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title"> <span class="span">|</span> {{ __('Mcq') }}</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                @php
                    $colorArray = ['primary', 'meta', 'sayn'];
                    $titleColor = ['#6658dd', '#F89F93', '#8DE2EF'];
                    $x = 0;
                @endphp

                @foreach ($mcqs as $item)
                    @php
                        $x++;
                        $progress = isset($item->marks) && !empty($item->marks) ? round(($item->marks->right_answer * 100) / $item->questions_count) : 0;
                    @endphp

                    <div class="col-lg-4">
                        <div class="card border-primary border mb-3">
                            <div class="card-header">
                                <h4 class="card-title"><a href="{{ route('user.mcq.read', [$item->id, strtolower(str_replace([' ', '_', '&'], '-', $item->title))]) }}">{{ $item->title }}</a></h4>
                                <p class="mb-0">{{ __('Total Question') }} : {{ $item->questions_count }}</p>
                            </div>
                            <hr class="hrm-0">
                            <div class="card-body">
                                <p class="card-text"><b style="color: {{ $titleColor[$x % 3] }}">{{ $progress . '%' }}</b> {{ __('completed with success') }}</p>
                                <div class="progress mb-2">
                                    <div class="progress-bar bg-{{ $colorArray[$x % 3] }}" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- end row-->
            {{ $mcqs->links('backend.pagination') }}

        </div> <!-- container -->

    </div> <!-- content -->
@endsection