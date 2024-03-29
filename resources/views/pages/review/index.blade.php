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
                    <th class="text-center text-nowrap">Added at</th>
                </thead>
                <tbody>
                    @foreach ($reviews as $key => $review)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>
                                <a href="{{ route('customer.show', $review->customer) }}">
                                    {{ $review->customer->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('itinerary.edit', $review->itinerary) }}">
                                    {{ $review->itinerary->place_name }}
                                </a>
                            </td>
                            <td>
                                {{ $review->content }}
                            </td>
                            <td class="text-center">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fas fa-fw fa-star text-warning"></i>
                                @endfor
                                @for ($i = 0; $i < 5 - $review->rating; $i++)
                                    <i class="far fa-fw fa-star"></i>
                                @endfor
                            </td>
                            <td class="text-center">{{ $review->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@push('js')
    <script type="text/javascript">
        async function handleDelete(id) {
            const willDelete = await swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            if (willDelete) {
                try {
                    await axios.delete(`/review/${id}`);
                    document.location.href = '/review';
                } catch (e) {
                    await swal("Error! Something have been wrong!", {
                        icon: "error"
                    });
                }
            }
        };
    </script>
@endpush
