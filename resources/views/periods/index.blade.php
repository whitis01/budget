@extends('layout')

@section('head')
    {!! Charts::assets() !!}
@stop

@section('content')
    <div>
        <nav class="sideBar">
            <h1>Archives</h1>
            <div class="mosaic">
                <div class="tabs">
                @foreach ($periods as $period)
                        <div class="tab" id="{{ $period->id }}"><a href="/periods/{{ $period->id }}">{{ $period->title }}</a></div>
                @endforeach
                </div>
            </div>

            <h3>Add New Period</h3>
            <form method="POST" action="/periods/">
                <div class="form-group">
                    Date:<input type="date" name="periodStart" value="{{ date('Y-m-d', (time()) - 21600)  }}" class="form-control"><br/>
                    Title:<input type="text" name="title" class="form-control" value="{{ date('F jS, Y', time() - 21600) }}">
                </div>
                <div class="form-group add-period">
                    <button type="submit" id="submit">Add Period</button>
                </div>
                {{ csrf_field() }}
            </form>
        </nav>
        <section class="chart">
            {!! $chart->render() !!}
        </section>
    </div>
@stop

@section('onload')
@stop
