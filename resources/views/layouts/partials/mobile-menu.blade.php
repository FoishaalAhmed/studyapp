<ul class="mainmenu">
    <li><a href="{{ url('/') }}">{{ __('Home') }}</a></li>

    <li class="has-droupdown">
        @php
            $firstMcqFive = array_slice($mcqSubCategories, 0, 5);
            $secontMcqFive = array_slice($mcqSubCategories, 5, 5);
            $thirdMcqFive = array_slice($mcqSubCategories, 10, 5);
        @endphp
        <a href="javascript:;">{{ __('MCQ') }}</a>
        <ul class="mega-menu">
            <li>
                <ul class="submenu mega-sub-menu-01">
                    @foreach ($firstMcqFive as $mcqCategory)
                        <li>
                            <a href="{{ route('mcq.grid', ['category' => $mcqCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $mcqCategory['name']))]) }}">{{ $mcqCategory['name'] }}</a>
                        </li>
                    @endforeach

                </ul>
            </li>
            <li>
                <ul class="submenu mega-sub-menu-01">
                    @foreach ($secontMcqFive as $mcqCategory)
                        <li>
                            <a href="{{ route('mcq.grid', ['category' => $mcqCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $mcqCategory['name']))]) }}">{{ $mcqCategory['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <ul class="submenu mega-sub-menu-01">
                    @foreach ($thirdMcqFive as $mcqCategory)
                        <li>
                            <a href="{{ route('mcq.grid', ['category' => $mcqCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $mcqCategory['name']))]) }}">{{ $mcqCategory['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </li>

    <li class="has-droupdown">
        @php
            $firstFiveExams = array_slice($examCategories, 0, 5);
            $secontFiveExams = array_slice($examCategories, 5, 5);
            $thirdFiveExams = array_slice($examCategories, 10, 5);
        @endphp
        <a href="javascript:;">{{ __('Exams') }}</a>
        <ul class="mega-menu">
            <li>
                <ul class="submenu mega-sub-menu-01">
                    @foreach ($firstFiveExams as $examCategory)
                        <li>
                            <a href="{{ route('exams.grid', ['view' => 'grid','category' => $examCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $examCategory['name']))]) }}">{{ $examCategory['name'] }}</a> 
                        </li>
                    @endforeach

                </ul>
            </li>
            <li>
                <ul class="submenu mega-sub-menu-01">
                    @foreach ($secontFiveExams as $examCategory)
                        <li>
                            <a href="{{ route('exams.grid', ['view' => 'grid','category' => $examCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $examCategory['name']))]) }}">{{ $examCategory['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
            <li>
                <ul class="submenu mega-sub-menu-01">
                    @foreach ($thirdFiveExams as $examCategory)
                        <li>
                            <a href="{{ route('exams.grid', ['view' => 'grid','category' => $examCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $examCategory['name']))]) }}">{{ $examCategory['name'] }}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </li>

    @if (module('Ebook') && isActive('Ebook'))
        <li class="has-droupdown">
            <a href="javascript:;">{{ __('Ebook') }}</a>
            @php
                $firstFiveEbooks = array_slice($ebookSubCategories, 0, 5);
                $secontFiveEbooks = array_slice($ebookSubCategories, 5, 5);
                $thirdFiveEbooks = array_slice($ebookSubCategories, 10, 5);
            @endphp
            <ul class="mega-menu">
                <li>
                    <ul class="submenu mega-sub-menu-01">
                        @foreach ($firstFiveEbooks as $ebookCategory)
                            <li><a href="{{ route('ebooks.grid', ['category' => $ebookCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $ebookCategory['name']))]) }}">{{ $ebookCategory['name'] }}</a></li>
                        @endforeach

                    </ul>
                </li>
                <li>
                    <ul class="submenu mega-sub-menu-01">
                        @foreach ($secontFiveEbooks as $ebookCategory)
                            <li><a href="{{ route('ebooks.grid', ['category' => $ebookCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $ebookCategory['name']))]) }}">{{ $ebookCategory['name'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <ul class="submenu mega-sub-menu-01">
                        @foreach ($thirdFiveEbooks as $ebookCategory)
                            <li><a href="{{ route('ebooks.grid', ['category' => $ebookCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $ebookCategory['name']))]) }}">{{ $ebookCategory['name'] }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </li>
    @endif
    @if (module('LectureSheet') && isActive('LectureSheet'))
        <li class="has-droupdown">
            <a href="javascript:;">{{ __('Lecture Sheet') }}</a>
            @php
                $firstFiveSheets = array_slice($sheetSubCategories, 0, 5);
                $secontFiveSheets = array_slice($sheetSubCategories, 5, 5);
                $thirdFiveSheets = array_slice($sheetSubCategories, 10, 5);
            @endphp
            <ul class="mega-menu">
                <li>
                    <ul class="submenu mega-sub-menu-01">
                        @foreach ($firstFiveSheets as $sheetCategory)
                            <li>
                                <a href="{{ route('sheets.grid', ['category' => $sheetCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $sheetCategory['name']))]) }}">{{ $sheetCategory['name'] }}</a> 
                            </li>
                        @endforeach

                    </ul>
                </li>
                <li>
                    <ul class="submenu mega-sub-menu-01">
                        @foreach ($secontFiveSheets as $sheetCategory)
                            <li>
                                <a href="{{ route('sheets.grid', ['category' => $sheetCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $sheetCategory['name']))]) }}">{{ $sheetCategory['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <ul class="submenu mega-sub-menu-01">
                        @foreach ($thirdFiveSheets as $sheetCategory)
                            <li>
                                <a href="{{ route('sheets.grid', ['category' => $sheetCategory['id'], 'name' => strtolower(str_replace([' ', '&', '_'], '-', $sheetCategory['name']))]) }}">{{ $sheetCategory['name'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </li>
    @endif

    <li><a href="#">{{ __('Jobs') }}</a></li>

    <li><a href="">{{ __('Forums') }}</a></li>

    <li><a href="">{{ __('Blog') }}</a></li>

    <li class="has-droupdown"><a href="#">{{ __('About') }}</a>
        <ul class="submenu">

            <li><a href="">{{ __('About Us') }}</a></li>

            <li><a
                    href="">{{ __('Privacy Policy') }}</a>
            </li>

            <li><a
                    href="">{{ __('Terms & Conditions') }}</a>
            </li>

            <li><a href="">{{ __('FAQ') }}</a></li>

        </ul>
    </li>

    <li><a href="">{{ __('Contact') }}</a></li>

    <li><a href="">{{ __('Login') }}</a></li>

    <li><a href="">{{ __('Registration') }}</a></li>

</ul>