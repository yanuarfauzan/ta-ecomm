@extends('partial.user.secondary.main')
@section('container')
    @if (count($usersCarts) > 0)
        @livewire('cart', ['usersCarts' => $usersCarts, 'user' => $user])
    @else
    <div class="container d-flex justify-content-center gap-4" style="width: 100%; height: 560px">
            <div class="d-flex flex-column align-items-center gap-2">
                <img src="{{ asset('oursvg/empty_cart.svg') }}" alt="" style="width: 400px; height: 400px;">
                <span>
                    <strong class="opacity-50"><h1>keranjang anda kosong</h1></strong>
                </span>
            </div>

    </div>
    @endif
@endsection
