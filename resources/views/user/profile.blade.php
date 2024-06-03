@extends('partial.user.secondary.main')
@section('container')
    @livewire('Profile', ['user' => $user])
@endsection
