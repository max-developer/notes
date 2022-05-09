@foreach(['success' => 'success', 'failed' => 'danger'] as $key => $variant)
    @if(Session::has($key))
        <div class="alert alert-{{$variant}}">{{Session::get($key)}}</div>
    @endif
@endforeach
