@extends('template.master')

@section('top')
@endsection

@section('content')
    <h1>Selamat datang</h1>
    <p>{{auth('reseller')->user()->nama}}</p>
@endsection

@section('top')
@endsection
