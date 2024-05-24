@extends('wrapper')

@section('content')

<section class="flex h-screen justify-center items-center">
    @livewire('raid-session', ['session' => $session])
</section>

@endsection