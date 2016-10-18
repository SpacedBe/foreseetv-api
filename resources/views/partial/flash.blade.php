@if(Session::has('message'))
    <div class="row success">
        {{ Session::get('message') }}
    </div>
@endif

@if(Session::has('error'))
    <div class="row error">
        {{ Session::get('error') }}
    </div>
@endif