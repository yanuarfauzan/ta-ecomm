@extends('partial.user.secondary.main')
@section('container')
    @livewire('cart', ['usersCarts' => $usersCarts, 'user' => $user])
@endsection
