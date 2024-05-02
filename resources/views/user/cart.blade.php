@extends('partial.user.secondary.main')
@section('container')
    @livewire('product', ['usersCarts' => $usersCarts])
@endsection
<script src="{{ asset('/ourjs/cart.js') }}"></script>
