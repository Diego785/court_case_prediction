@extends('my_views.layouts.official_layout')

@section('title', 'My Analysis Center')


@section('sidebar')
    @include('my_views.layouts.sidebar')
@endsection

{{-- @section('navbar')
    @include('my_views.layouts.navbar')
@endsection --}}


@section('content')
    @livewire('caso', ['case_id' => $case->id])
@endsection
