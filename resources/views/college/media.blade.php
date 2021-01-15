<div class="cv-content"></div>
<div class="cv-media media-resources cv-content">
    ВИДЕО
    <div class="d-flex justify-content-between position-relative">

        <div class="slick-slider Autoplay w-100">
            @foreach($partners as $k => $v)
                <div class="">
                    <a href="{{$v->link}}" target="_blank">
                        <img style="width: 120px; height: 120px" class="m-auto img-fluid" src="{{asset("/img/partners/$v->image")}}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="cv-media media-resources cv-content">
    ГАЛЕРЕЯ
    <div class="d-flex justify-content-between position-relative">

        <div class="slick-slider Autoplay w-100">
            @foreach($partners as $k => $v)
                <div class="">
                    <a href="{{$v->link}}" target="_blank">
                        <img style="width: 120px; height: 120px" class="m-auto img-fluid" src="{{asset("/img/partners/$v->image")}}">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
