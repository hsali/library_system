@if (session('status'))
    <div class="alert alert-{{session("status","success")}}" role="alert">
        {{ session('status') }} ! {{ session("message") }}
    </div>
@endif
