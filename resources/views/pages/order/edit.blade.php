@extends('adminlte::page')

@section('title')
    Order {{ $order->itinerary->place_name }}
@endsection

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-eye"></i> Order {{ $order->code }} ({{ $order->status_name }})</h1>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section>
                    <h4>Order Details</h4>
                    <hr>
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <td>Order code</td>
                                <td>: {{ $order->code }}</td>
                            </tr>
                            <tr>
                                <td>Product</td>
                                <td>
                                    : <a href="{{ route('itinerary.edit', $order->itinerary) }}" target="_blank">{{ $order->itinerary->place_name }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>: Rp. {{ number_format($order->price, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>: {{ $order->status_name }}</td>
                            </tr>
                            <tr>
                                <td>Order created</td>
                                <td>: {{ $order->created_at->toDayDateTimeString() }}</td>
                            </tr>
                            <tr>
                                <td>Order completed</td>
                                <td>: {{ $order->completed_at }}</td>
                            </tr>
                            <tr>
                                <td>Last updated</td>
                                <td>: {{ $order->updated_at->toDayDateTimeString() }}</td>
                            </tr>
                        </tbody>
                    </table>
                </section>

                <section class="mt-4">
                    <h4>Customer Info</h4>
                    <hr>
                    <table class="table table-sm table-borderless">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>: <a href="{{ route('customer.edit', $order->customer) }}" target="_blank">{{ $order->customer->name }}</a></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td>: <a href="{{ route('customer.edit', $order->customer) }}" target="_blank">{{ $order->customer->username }}</a></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>: <a href="mailto://{{ $order->customer->email }}">{{ $order->customer->email }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>ID.</td>
                                <td>: {{ $order->customer->customerInfo->identity }}</td>
                            </tr>
                            <tr>
                                <td>Telp.</td>
                                <td>: {{ $order->customer->customerInfo->telp }}</td>
                            </tr>
                            <tr>
                                <td>Address 1</td>
                                <td>: {{ $order->customer->customerInfo->address_1 }}</td>
                            </tr>
                            <tr>
                                <td>Address 2</td>
                                <td>: {{ $order->customer->customerInfo->address_2 }}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>: {{ $order->customer->customerInfo->city }}</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </div>
            <div class="col-lg-4">
                <section>
                    <form action="{{ route('order.update', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $order->id }}">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" aria-label="Change order status" name="status">
                                <option {{ $order->status === 1 ? 'selected' : '' }} value="1">Pending Payment</option>
                                <option {{ $order->status === 4 ? 'selected' : '' }} value="4">Pending Confirm</option>
                                <option {{ $order->status === 2 ? 'selected' : '' }} value="2">Completed</option>
                                <option {{ $order->status === 3 ? 'selected' : '' }} value="3">Failed</option>
                            </select>
                        </div>
                        <button class="btn btn-primary w-100" type="submit">
                            <i class="fa fa-fw fa-save"></i>
                            Update
                        </button>
                    </form>
                </section>
                <section class="mt-4">
                    <h4>Payment Receipt</h4>
                    <hr>
                    @if ($order->receipt_uploaded_at)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>Uploaded At</div>
                            <div>: {{ $order->receipt_uploaded_at->diffForHumans() }}</div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ $order->receipt }}">
                                <img class="img-fluid" src="{{ $order->receipt }}" alt="Receipt Of Payment Order" />
                            </a>
                        </div>
                    @else
                        <div class="text-danger">No Receipt Uploaded</div>
                    @endif
                </section>
            </div>
        </div>
    </div>
@endsection
