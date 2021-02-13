<div class="row partners">
    <div class="col-12">
        <h3>Партнеры</h3>
    </div>
    <div class="slick-slider">
        @foreach($partners as $k => $v)
            <div class="">
                <a href="{{route('partner')}}">
                    <img style="height: 120px" class="m-auto img-fluid" data-lazy="{{asset("/img/partners/$v->image")}}">
                </a>
            </div>
        @endforeach
    </div>
</div>