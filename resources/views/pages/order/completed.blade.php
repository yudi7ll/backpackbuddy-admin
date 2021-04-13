@extends('adminlte::page')

@section('title', 'Completed Orders')

@section('content')
    <h1 class="title mt-5"><i class="fa fa-fw fa-check"></i> Completed Orders</h1>
    <hr>
    <section>
        <div class="table-responsive">
            <table id="datatables" class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th class="text-nowrap">Thumb</th>
                        <th class="text-nowrap">Place name</th>
                        <th>Customer Name</th>
                        <th>Status</th>
                        <th class="text-nowrap">Order Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($completedOrders as $key => $order)
                        <tr>
                            <td class="text-center align-middle">{{ $key + 1 }}</td>
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
                            <td class="text-center align-middle">
                                @switch($order->status)
                                    @case(0)
                                        {{ 'Failed' }}
                                        @break
                                    @case(1)
                                        {{ 'Pending Payment' }}
                                        @break
                                    @case(2)
                                        {{ 'Completed' }}
                                        @break
                                @endswitch
                            </td>
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
