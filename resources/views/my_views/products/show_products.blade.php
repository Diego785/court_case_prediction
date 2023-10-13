@extends('my_views.layouts.official_layout')

@section('title')
    My Analysis Center
@endsection


@section('sidebar')
    @include('my_views.layouts.sidebar')
@endsection

@section('navbar')
    @include('my_views.layouts.navbar')
@endsection

{{-- @section('action')
    <a href="{{ route('#') }}" class="hover:underline ">Another view</a>
@endsection --}}

{{-- @section('content')
    @livewire('alerts.main-alerts', ['id' => $id])
@endsection --}}
