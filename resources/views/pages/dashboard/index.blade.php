@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="m-0 text-dark"><i class="fa fa-fw fa-tachometer-alt"></i> Dashboard</h1>
@stop

@section('content')
    <div class="alert alert-primary alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Selamat datang {{ Auth::user()->name }}</strong>
    </div>
    <div class="row">
        <x-chart icon="fa-shopping-cart">
            Pending Orders
            <h3 class="mt-2">{{ App\Order::where('status', 1)->count() }}</h3>
        </x-chart>
        <x-chart icon="fa-shopping-bag" bg="bg-info" class="mt-4 mt-sm-0">
            Daily Orders
            <h3 class="mt-2">{{ App\Order::whereDay('created_at', now()->day)->count() }}</h3>
        </x-chart>
        <x-chart icon="fa-hand-holding-usd" bg="bg-success" class="mt-4 mt-md-0">
            Daily Incomes
            <h3 class="mt-2 mr-0 text-nowrap">Rp. {{ number_format(App\Order::sum('price', 0, ',', '.')) }}</h3>
        </x-chart>
        </div>
    </div>
@stop
