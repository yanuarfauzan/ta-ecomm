@extends('partial.user.secondary.main')
@section('container')
    @livewire('product', ['usersCarts' => $usersCarts, 'user' => $user])
@endsection
