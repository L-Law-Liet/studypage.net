@if(Session::has('flash_message'))
    <div class="container">
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
    </div>
@endif
@if(Session::has('error'))
    <div class="container">
        <div class="alert alert-danger">
            <h4>{{ trans('general.error') }}</h4>
            <p> {!! Session::get('error') !!} </p>
        </div>
    </div>
@endif
@if(Session::has('success'))
    <div class="container">
        <div class="alert alert-success">
            <h4>{{ trans('general.success') }}</h4>
            <p> {{ Session::get('success') }} </p>
        </div>
    </div>
@endif
@if ($errors->any())
    <div class="container">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif