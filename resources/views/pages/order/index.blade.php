@extends('adminlte::page')

@section('title', 'Orders')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-clock"></i> {{ $filter }}</h1>
    <hr>
    <section id="order">
        <div class="table-responsive">
            <table id="datatables" class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>Code</th>
                        <th class="text-nowrap">Thumb</th>
                        <th class="text-nowrap">Place name</th>
                        <th class="text-nowrap">Customer Name</th>
                        <th>Status</th>
                        <th class="text-nowrap">Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-center align-middle">
                                <a class="text-dark" href="{{ route('order.edit', $order) }}">
                                    {{ $order->code }}
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{ route('itinerary.edit', $order->itinerary) }}">
                                    <img class="img__featured" src="{{ $order->itinerary->featured_picture }}"
                                        alt="{{ $order->itinerary->place_name }}" />
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <a class="text-dark" href="{{ route('itinerary.edit', $order->itinerary) }}">
                                    {{ $order->itinerary->place_name }}
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                <a class="text-dark" href="{{ route('customer.edit', $order->customer) }}">
                                    {{ $order->customer->name }}
                                </a>
                            </td>
                            <td class="text-center align-middle">{{ $order->status_name }}</td>
                            <td class="text-center align-middle">{{ $order->created_at->diffForHumans() }}</td>
                            <td class="text-center align-middle">
                                <a class="btn btn-primary btn-sm" href="{{ route('order.edit', $order) }}" title="View">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
