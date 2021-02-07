
<div id="map" class="container">
    @if($map??'')
        @if(str_contains($map, ','))
            <div class="subnav">
                @php
                    $map = isset($map) ? $map : '';
                    $map = preg_split("/[ ][,]+/", $map);


                    $lastMap = $map[count($map)-1];
                    for ($i = 0; $i < count($map)-1; $i++){
                        switch (trim($map[$i])){
                            case 'Главная':
                        echo "<a class=\"underline\" href=\"/main\">$map[$i]</a>";
                                $path = '/';
                                break;
                            case 'Рейтинг':
                                echo "<span class='subnav-last-child'>$map[$i]</span>";
                                break;
                            case 'Навигатор':
                                echo "<span class='subnav-last-child'>$map[$i]</span>";
                                break;
                            case 'Результаты':
                            echo "<a class=\"underline\" href=\"".url()->previous()."\">$map[$i]</a>";
                                break;
                            case 'Калькулятор ЕНТ':
                        echo "<a class=\"underline\" href=\"".url('calculator-ent')."\">$map[$i]</a>";
                                break;
                            case 'Рейтинг ВУЗов':
                                echo "<span class='subnav-last-child'>$map[$i]</span>";
                                break;
                            case 'Рейтинг колледжей':
                                echo "<span class='subnav-last-child'>$map[$i]</span>";
                                break;
                                case 'Список колледжей':
                        echo "<a class=\"underline\" href=\"".url('qazaqstan/navigator/list/college')."\">$map[$i]</a>";
                                    break;
                                case 'Список ВУЗов':
                        echo "<a class=\"underline\" href=\"".url('qazaqstan/navigator/list/universities')."\">$map[$i]</a>";
                                    break;
                                    case $university->name_ru??true:

                                echo "<span class='subnav-last-child'>$map[$i]</span>";
                                        break;
                        }
                @endphp
                <img src="{{asset('img/faq-arrow-right.svg')}}">
                @php
                    }
                    echo "<span id='Subnav-LC' class='subnav-last-child'>$lastMap</span>";
                @endphp
            </div>
        @endif
    @else

        <div class="subnav pl-0">
            <a href="{{url()->previous()}}"><span><img class="mr-2" src="{{asset('img/arrow-left.svg')}}" alt=""></span>Вернуться к результатам поиска</a>
        </div>
    @endif
</div>
