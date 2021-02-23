@extends('adminlte::page')

@section('title', 'Reviews')

@section('content')
    <h1 class="title"><i class="fas fa-fw fa-star"></i> Reviews</h1>
    <hr />
    <section>
        <div class="table-responsive">
            <table id="datatables" class="table table-striped table-bordered">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center text-nowrap">Customer Name</th>
                    <th class="text-center text-nowrap">Itinerary Name</th>
                    <th class="text-center">Content</th>
                    <th class="text-center">Rating</th>
                    <th class="text-center">Added at</th>
                    <th class="text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($reviews as $key => $review)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">
                                <a class="text-dark field-hover" href="{{ route('customer.edit', $review->customer) }}"
                                    title="Edit customer {{ $review->customer->name }}">
                                    {{ $review->customer->name }}
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="text-dark field-hover" href="{{ route('itinerary.edit', $review->itinerary) }}"
                                    title="Edit itinerary {{ $review->itinerary->place_name }}">
                                    {{ $review->itinerary->place_name }}
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="text-dark text-truncate d-inline-block"
                                    href="{{ route('review.edit', $review) }}" title="Edit this review"
                                    style="max-width: 250px;">
                                    {{ $review->content }}
                                </a>
                            </td>
                            <td class="text-center">{{ $review->rating }}</td>
                            <td class="text-center">{{ $review->created_at->diffForHumans() }}</td>
                            <td class="text-center text-nowrap align-middle">
                                <a class="btn btn-primary btn-sm" href="{{ route('review.edit', $review) }}"
                                    title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                                <button type="button" onclick="handleDelete({{ $review->id }})"
                                    class="btn btn-sm btn-danger">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
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
