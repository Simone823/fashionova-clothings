@extends('layouts.guest')

@section('metaTitle', 'Home')

@section('content')
    <section id='homepage'>
        {{-- hero --}}
        @include('components.guest.hero')

        <div class='container'>
            {{-- services --}}
            @include('components.guest.services')
        </div>
    </section>
@endsection