@extends('layout')
@section('head')
    {!! Charts::assets() !!}
    <title>{{ $period->title }}</title>
@stop

@section('content')
    {!! $chart->render() !!}
@stop
