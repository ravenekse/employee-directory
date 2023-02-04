@extends('layouts.layout')

@section('content')
    @include('components.navbar')
    @include('components.sidebar')

    <div class="content-wrapper">
        <section class="content">
            @if(session('NOTIFICATION'))
                @php
                    $notification = (object) session('NOTIFICATION')
                @endphp
                <div class="alert alert-{{ $notification->type }} alert-dismissible fade show mt-2 mb-1" role="alert">
                    {{ $notification->message }}

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line" aria-hidden="true"></i>
                    </button>
                </div>
            @endif
            @yield('acp_content')
        </section>
    </div>
@endsection
