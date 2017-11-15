@extends('layouts.master')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/plugins/clockpicker/clockpicker.css') }}">
@endsection

@section('content')

    <ol class="breadcrumb breadcrumb-2">
        <li><a href="{{route('home')}}">Home </a></li>
        <li><a href="{{ route('vacations.index') }}">Vacations</a></li>
        <li class="active"><strong style="font-family: zona_probold; font-size: 28px ">{{ $vacation->name }}</strong></li>
    </ol><!-- End of order list-->

    <div class="form-group">
        <label for="name">Name</label>
        <p>{{ $vacation->name }}</p>
    </div>


@endsection
