@extends('partial.user.secondary.main')
@section('container')
    @livewire('Order', [
        'usersCarts' => $usersCarts ?? [],
        'productBuyNow' => $productBuyNow ?? [],
        'user' => $user,
        'defaultUserAdress' => $defaultUserAdress,
        'order' => $order,
        'countBuyNow' => $countBuyNow ?? null,
        'variationBuyNow' => $variationBuyNow ?? [],
        'productVoucher' => $productVoucher,
        'userAddresses' => $userAddresses,
        'subTotal' => $totalPriceBuyNow
    ])
    <script src="{{ asset('/ourjs/order.js') }}" data-navigate-track></script>
@endsection
