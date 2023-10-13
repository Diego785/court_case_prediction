@extends('my_views.layouts.official_layout')

@section('title', 'My Analysis Center')


@section('sidebar')
    @include('my_views.layouts.sidebar')
@endsection

{{-- @section('navbar')
    @include('my_views.layouts.navbar')
@endsection --}}


{{-- @section('content')
    @livewire('dashboard')
@endsection --}}
{{-- @section('action')
    <a href="{{ route('#') }}" class="hover:underline ">Another view</a>
@endsection --}}

{{-- @section('content')
    @livewire('alerts.main-alerts', ['id' => $id])
@endsection --}}

@section('css')
    @livewireStyles
@stop
@section('js')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop
