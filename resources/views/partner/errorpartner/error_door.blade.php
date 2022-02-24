<!-- Stored in resources/views/child.blade.php -->

@extends('layouts.errorpage')

@section('title', 'Page Title')


@section('content')
    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">

            {{ $message }}

        </div>
    </div>
    <!--end page wrapper -->
@endsection






