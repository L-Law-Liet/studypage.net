@if (is_string($item))
    <li class="header">{{ $item }}</li>
@else
    @php
    $pattern = '/(\/add\/\d+|\/view\/\d+|\/add)/';
    @endphp
    <li class="{{ $item['class'] }} @if(isset($item['url'])) {{(substr(preg_replace($pattern, '', parse_url(url()->current(), PHP_URL_PATH)), 1) == $item['url'])?'active':''}} @endif
            @if(isset($item['submenu']) && isset($item['submenu'][0]['url']))
    @foreach($item['submenu'] as $i)
    @if(isset($i['url']))
    @if(substr(preg_replace($pattern, '', parse_url(url()->current(), PHP_URL_PATH)), 1) == $i['url'])
    {{$i['url']}}
            active
            @endif
    @elseif(isset($i['submenu'][0]['url']))
            @foreach($i['submenu'] as $j)
    @if(isset($j['url']))
    @if(substr(preg_replace($pattern, '', parse_url(url()->current(), PHP_URL_PATH)), 1) == $j['url'])
    {{$j['url']}}
            active
            @endif
    @endif
            @endforeach
    @endif
    @endforeach
@endif
            ">
        <a href="{{ $item['href'] }}"
           @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
        >
            @if(isset($item['icon']))
                <i class="fa fa-fw fa-{{$item['icon']}} text-{{$item['icon_color']}}"></i>
                @endif
{{--            ++{{substr(str_replace('/add', '', parse_url(url()->current(), PHP_URL_PATH)), 1)}}++--}}
{{--            --{{$item['url']??'**'}}----}}
{{--                {{substr(str_replace('/add', '', parse_url(url()->current(), PHP_URL_PATH)), 1)}}--}}
                <span style="white-space: break-spaces;">{{ $item['text'] }}</span>
                @if  (isset($item['submenu']))
                    <i class="fa fa-angle-left pull-right"></i>
                @endif
        </a>
        @if (isset($item['submenu']))
            <ul style="top: 0;" class="{{ $item['submenu_class'] }} font-size-09rem">
                @each('adminlte::partials.menu-item', $item['submenu'], 'item')
            </ul>
        @endif
    </li>
@endif
