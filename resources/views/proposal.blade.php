@php
    $arr = $errors->prop->all()??[];
@endphp
<div class="row">
    <div class="col-md-10 offset-md-1 m-t-10">
        <form action={{ URL::action("IndexController@postProposal") }} method="POST">
            @csrf
            <div class="form-group row">
                <label class="col-md-4">Имя контактного лица*</label>
                <div class="col-md-8">
                    <input required type="text" name="contact_name" class="form-control" value="{{ old('contact_name')}}">
                </div>
                @if(end($arr) == 'Callback' && $errors->prop->first('contact_name'))<span class="offset-4  col-md-8 text-danger"><small>{{ $errors->prop->first('contact_name')}}</small></span>@endif
            </div>
            <div class="form-group row">
                <label class="col-md-4">Название учебного заведения*</label>
                <div class="col-md-8">
                    <input required type="text" name="university_name" class="form-control" value="{{ old('university_name')}}">
                </div>
                @if(end($arr) == 'Callback' && $errors->prop->first('university_name'))<span class="offset-4  col-md-8 text-danger"><small>{{ $errors->prop->first('university_name')}}</small></span>@endif
            </div>
            <div class="form-group row">
                <label class="col-md-4">Контактный телефон*</label>
                <div class="col-md-8">
                    <input required type="tel" name="contact_phone" class="phone_mask form-control"  value="{{old('contact_phone')}}">
                </div>
                @if(end($arr) == 'Callback' && $errors->prop->first('contact_phone'))<span class="offset-4  col-md-8 text-danger"><small>{{ $errors->prop->first('contact_phone')}}</small></span>@endif
            </div>
            <div class="form-group row">
                <label class="col-md-4">Электронная почта*</label>
                <div class="col-md-8">
                    <input required type="email" name="footerEmail" class="form-control" value="{{ old('footerEmail')}}">
                </div>
                @if(end($arr) == 'Callback' && $errors->prop->first('footerEmail'))<span class="offset-4  col-md-8 text-danger"><small>{{ $errors->prop->first('footerEmail')}}</small></span>@endif
            </div>
            <div class="clearfix">
                <div class="form-group m-md-auto mt-4 pt-md-0 pt-1">
                    <button class="btn col-md-4 col-xs-12 text-capitalize btn-primary-custom float-right">
                        Отправить
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
