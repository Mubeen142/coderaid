@extends('wrapper')

@section('content')

<section class="flex h-screen justify-center items-center">
    @if($session->users()->count() == 0)
        @livewire('session-details', ['session' => $session])
    @else

    @endif
</section>

@endsection