@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection
@if ($paginator->hasPages())
    <ul>
        @foreach ($elements as $element)
            @foreach ($element as $page => $url)
                <li class="active" aria-current="page"><a href="{{ $url }}"><span>{{ $page }}</span></a>
                </li>
            @endforeach
        @endforeach
    </ul>
@endif
