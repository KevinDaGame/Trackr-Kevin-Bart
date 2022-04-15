{{--<div class="flex justify-center pt-8 sm:justify-start sm:pt-0">--}}
{{--    @foreach($available_locales as $locale_name => $available_locale)--}}
{{--        @if($available_locale === $current_locale)--}}
{{--            <span class="ml-2 mr-2 text-white">{{ $locale_name }}</span>--}}
{{--        @else--}}
{{--            <a class="ml-1 underline ml-2 mr-2 text-white-50" href="language/{{ $available_locale }}">--}}
{{--                <span>{{ $locale_name }}</span>--}}
{{--            </a>--}}
{{--        @endif--}}
{{--    @endforeach--}}
{{--</div>--}}
<div class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{__('Language')}}</a>
    <div class="nav-item dropdown-menu">

        @foreach($available_locales as $locale_name => $available_locale)
            @if($available_locale === $current_locale)
                <span class="dropdown-item">{{__($locale_name)}}</span>
            @else
                <a class="dropdown-item" href="language/{{ $available_locale }}">
                    <span class="underline ">{{__($locale_name)}}</span>
                </a>
            @endif
        @endforeach
    </div>
</div>
