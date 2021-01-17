
<div class="row">
    <div class="mobile-city col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div id="Ziti" class="city-teaser teaser teaser-rebrush teaser-with-headline" style="display: none;">
            <div id="ZitiHeader" class="teaser-headline">
                <h3 class="color-2D7ABF">ВУЗы в городах Казахстана</h3>
            </div>
            <div class="slide-teaser-slider-wrapper">
                <ul class="row pl-0 m-0 list-unstyled">
                    @foreach($cityslider as $k => $v)
                        <li class="col-md-6 col-lg-4 post-teaser">
                            <div class="teaser-inner">
                                <figure>
                                    <img height="470" width="470" data-lazy="/img/cities/{{$v->image}}">
                                </figure>
                                <div class="post-teaser-post-info">
                                    <div class="text">
                                        <h3><a class="outline-0" href="/city/view/{{ $v->id }}">{{$v->name_ru}}</a></h3>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>