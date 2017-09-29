@extends('layout')

@section('head')
    <title>{{ $period->title }}</title>
    {!! Charts::assets() !!}
@stop
@section('content')
    <div class="clear-fix">
        <div class="sideBar">
            <div class="sideBar__section top"><h1>Accounts</h1></div>
            <div class="sideBar__section top">
        @foreach ($period->accounts as $account)
            <div class="sideBar__section form-group">
                <div class="account-container">
                    <div class="link-container">
                        <a href="/periods/{{$period->id}}/accounts/{{$account->id}}" class="color-neutral"> {{ $account->title }}</a>
                        <a id="{{ $account->id }}" href="/periods/{{$period->id}}/accounts/{{$account->id}}" class="{{ $account->getColor() == 'red' ? 'color-negative' : 'color-positive' }}" >${{ $account->getBalance() }}</a>
                    </div>
                    <div class="link-container-button">
                        <form method="POST" action="/periods/{{$period->id}}/accounts/{{$account->id}}">
                        {{ method_field('DELETE') }}
                          <button type="submit" class="trash"><img id="flag" src="/img/trash.png" width="15" height="15" class="delete"></button>

                        {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
            </div>
        <div class="form-group">
        <h2>Final Total <font color="{{$period->getMercurialColor()}}">${{ $period->getMercurialAmount() }} </font></h2>
        <h3>Add New Account</h3>
        <form method="POST" action="/periods/{{$period->id}}/accounts">

            Title:<div class="input-field"><select name="id" autofocus title="title">
                  @foreach ($accountCategories as $accountCategory)
                      <option value="{{ $accountCategory->id }}">{{ $accountCategory->name }}</option>
                  @endforeach
                </select></div>
            Balance:$<div class="input-field"><input type="number" step="0.01" maxlength="32" value='0.00' placeholder='0.00' name="balance"></div>

        <div class="form-group">
          <button type="submit">Add Account</button>
        </div>
        {{ csrf_field() }}
        </form>
        </div>
        </div>
        <div>
            <section class="chart">
            {!! $chart->render() !!}
        </section>
        </div>
    </div>
@stop
