@extends('layouts.master')

@section('master.content')
    @php
        $defaultMajorVersion = '6.x';
    @endphp

    <div class="row mt-4">
        @include('pages.management._partials.index.vertical-tabs')
    </div>
@endsection
