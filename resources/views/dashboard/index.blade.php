@extends('dashboard.layouts.main')
@section('container')
    <h1>Hai {{ Auth::user()->name }}</h1>
@endsection