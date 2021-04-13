@extends('adminlte::page')

@section('title')
    Order {{ $order->itinerary->place_name }}
@endsection

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-pencil-alt"></i> Order from {{ $order->customer->name }}</h1>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section>
                    {{ $order->itinerary->place_name }}
                </section>
            </div>
            <div class="col-lg-4">
                <section>
                    <h5>Status</h5>
                    <select class="form-select" aria-label="Change order status" name="status" multiple size="1">
                        <option {{ $order->status == 0 ?? 'selected' }} value="0">Failed</option>
                        <option {{ $order->status == 1 ?? 'selected' }} value="1">Pending Payment</option>
                        <option {{ $order->status == 2 ?? 'selected' }} value="2">Completed</option>
                    </select>
                </section>
            </div>
        </div>
    </div>
@endsection
