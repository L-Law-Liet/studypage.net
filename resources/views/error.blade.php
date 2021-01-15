<div class="container">
    @if(Session::has('flash_message'))
        <div class="alert alert-info">
            {{ Session::get('flash_message') }}
        </div>
    @endif
    @if(Session::has('success'))
        <div class="alert alert-success">
            <p> {{ Session::get('success') }} </p>
        </div>
    @endif
    @if(Session::has('warning'))
        <div class="alert alert-warning">
            <p> {{ Session::get('warning') }} </p>
        </div>
    @endif

</div>
