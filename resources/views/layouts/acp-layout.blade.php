@extends('layouts.layout')

@section('content')
    @include('components.navbar')
    @include('components.sidebar')

    <div class="content-wrapper">
        <section class="content">
            @yield('acp_content')
        </section>
    </div>
@endsection
