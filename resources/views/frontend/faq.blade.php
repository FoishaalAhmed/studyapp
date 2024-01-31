@extends('layouts.app')

@section('title', __('Faq'))
@section('content')
    <!-- Breadcrumb Area Start -->
    <div class="edu-breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-inner">
                <div class="page-title">
                    <h1 class="title">{{ __('Frequently Asked Questions') }}</h1>
                </div>
                <ul class="edu-breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('Home') }}</a></li>
                    <li class="separator"><i class="icon-angle-right"></i></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Frequently Asked Questions') }}</li>
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

    <!-- FAQ Area Start -->
    <section class="edu-section-gap faq-page-area">
        <div class="container">
            <div class="row">
                @php
                    $divider = round(count($faqs) / 2);
                    $firstHalf = array_slice($faqs, 0, $divider);
                    $secondHalf = array_slice($faqs, $divider);
                @endphp
                <div class="col-lg-6">
                    <div class="tab-content faq-page-tab-content" id="faq-accordion">
                        <div class="tab-pane fade show active" id="gn-ques" role="tabpanel">
                            <div class="faq-accordion">
                                <div class="accordion">
                                    @foreach ($firstHalf as $item)
                                        
                                    <div class="accordion-item">
                                        <h5 class="accordion-header">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#questionOne-<?= $loop->index + 1 ?>" aria-expanded="<?= $loop->index == 0 ? 'true' : '' ?>">
                                                {{ $item['question'] }}
                                            </button>
                                        </h5>
                                        <div id="questionOne-<?= $loop->index + 1 ?>" class="accordion-collapse collapse <?= $loop->index == 0 ? 'show' : '' ?>"
                                            data-bs-parent="#faq-accordion">
                                            <div class="accordion-body">
                                                <p>{{ $item['answer'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="tab-content faq-page-tab-content" id="faq-accordion">
                        <div class="tab-pane fade show active" id="gn-ques" role="tabpanel">
                            <div class="faq-accordion">
                                <div class="accordion">
                                    @foreach ($secondHalf as $item)
                                        <div class="accordion-item">
                                            <h5 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#questionTwo-<?= $loop->index + 1 ?>" aria-expanded="<?= $loop->index == 0 ? 'true' : '' ?>">
                                                    {{ $item['question'] }}
                                                </button>
                                            </h5>
                                            <div id="questionTwo-<?= $loop->index + 1 ?>" class="accordion-collapse collapse <?= $loop->index == 0 ? 'show' : '' ?>"
                                                data-bs-parent="#faq-accordion">
                                                <div class="accordion-body">
                                                    <p>{{ $item['answer'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>
@endsection
