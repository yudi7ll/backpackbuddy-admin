@extends('adminlte::page')

@section('title', 'Edit Customer')

@section('content')
    <h1 class="title">
        <i class="fa fa-fw fa-pencil-alt"></i>
        Edit Customer / {{ $customer->name }}
    </h1>
    <hr>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <section class="overflow-auto">
                <h3>Account</h3>
                <hr>
                <div class="row my-2">
                    <div class="col-6">Name</div>
                    <div class="col-6 text-nowrap">: {{ $customer->name }} </div>
                </div>
                <div class="row my-2">
                    <div class="col-6">Username</div>
                    <div class="col-6 text-nowrap">: {{ $customer->username }}</div>
                </div>
                <div class="row my-2">
                    <div class="col-6">Email</div>
                    <div class="col-6 text-nowrap">: {{ $customer->email }} </div>
                </div>
            </section>
            <section class="mt-4 overflow-auto">
                <h3>Privacy</h3>
                <hr>
                <div class="row my-2">
                    <div class="col-6 text-nowrap">ID.</div>
                    <div class="col-6 text-nowrap">: {{ $customer->customerInfo->identity }}</div>
                </div>
                <div class="row my-2">
                    <div class="col-6 text-nowrap">Telp.</div>
                    <div class="col-6 text-nowrap">: {{ $customer->customerInfo->telp }}</div>
                </div>
                <div class="row my-2">
                    <div class="col-6 text-nowrap">Address 1</div>
                    <div class="col-6 text-nowrap">: {{ $customer->customerInfo->address_1 }} </div>
                </div>
                <div class="row my-2">
                    <div class="col-6 text-nowrap">Address 2</div>
                    <div class="col-6 text-nowrap">: {{ $customer->customerInfo->address_2 }} </div>
                </div>
                <div class="row my-2">
                    <div class="col-6 text-nowrap">City</div>
                    <div class="col-6 text-nowrap">: {{ $customer->customerInfo->city }} </div>
                </div>
            </section>
        </div>
        <div class="col-lg-4">
            <section>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Purchasing count: </strong> {{ $customer->orders->count() }}
                    </li>
                    <li class="list-group-item">
                        <strong>Created at: </strong> {{ $customer->created_at->diffForHumans() }}
                    </li>
                    <li class="list-group-item">
                        <strong>Updated at: </strong> {{ $customer->updated_at->diffForHumans() }}
                    </li>
                </ul>
            </section>
        </div>
    </div>
    <div class="row">
        <div class="col mb-4">
            <section class="mt-4">
                <h3>Order from {{ $customer->name }}</h3>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="datatables">

                        <body>
                            <thead>
                                <th scope="col">No</th>
                                <th scope="col">Place Name</th>
                                <th scope="col">Status</th>
                                <th scope="col">Order Date</th>
                                <th scope="col">Action</th>
                            </thead>
                            <tbody>
                                @foreach ($customer->orders as $key => $order)
                                    <tr>
                                        <td class="text-center" scope="row">{{ $key + 1 }}</td>
                                        <td class="text-truncate">
                                            <a href="{{ route('order.edit', $order) }}">{{ $order->itinerary->place_name }}</a>
                                        </td>
                                        <td>{{ $order->status_name }}</td>
                                        <td>{{ $order->created_at->diffForHumans() }}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye fa-fw"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </body>
                    </table>
                </div>
            </section>
            <section class="mt-4">
                <h3>Review from {{ $customer->name }}</h3>
                <hr>
                <div class="table-responsive">
                    <table class="table table-stripped table-bordered" id="datatables2">
                        <thead>
                            <th>No</th>
                            <th>Place Name</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Posted at</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($customer->reviews as $key => $review)
                                <tr>
                                    <td class="text-center">{{ $key + 1 }}</td>
                                    <td>{{ $review->itinerary->place_name }}</td>
                                    <td>{{ $review->content }}</td>
                                    <td class="text-center">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="fas fa-fw fa-star text-warning"></i>
                                        @endfor
                                        @for ($i = 0; $i < 5 - $review->rating; $i++)
                                            <i class="far fa-fw fa-star"></i>
                                        @endfor
                                    </td>
                                    <td>{{ $review->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('review.show', $review) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-fw fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        async function deleteCustomerHandle(id) {
            const willDelete = await swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            if (willDelete) {
                try {
                    await axios.delete(`/customer/${id}`);
                    document.location.href = '/customer';
                } catch (e) {
                    await swal("Error! Something have been wrong!", {
                        icon: "error"
                    });
                }
            }
        };
    </script>
@endpush
