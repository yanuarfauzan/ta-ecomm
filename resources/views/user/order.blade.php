@extends('partial.user.secondary.main')
@section('container')
    @livewire('Order', ['usersCarts' => $usersCarts, 'user' => $user, 'defaultUserAdress' => $defaultUserAdress, 'order' => $order])
    <script src="{{ asset('/ourjs/order.js') }}" data-navigate-track></script>

    <pre id="result-json"></pre>
@endsection
