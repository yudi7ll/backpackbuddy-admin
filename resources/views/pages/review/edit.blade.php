@extends('adminlte::page')

@section('title', 'Edit Review')

@section('content')
    <h1 class="title">
        <i class="fas fa-fw fa-star"></i>
        Edit Review from {{ $review->customer->name }}
    </h1>
    <hr>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <section>
                <form id="review-form" action="{{ route('review.update', $review) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $review->id }}" />
                    <div class="form-group">
                        <label for="input-rating" class="col-form-label">Rating:</label>
                        <input class="form-control @error('rating') is-invalid @enderror" type="number" name="rating" id="rating"
                            value="{{ old('rating', $review->rating) }}" required />

                        @error('rating')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-content" class="col-form-label">Content:</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content"
                            rows="10">{{ old('content', $review->content) }}</textarea>

                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="left">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-fw fa-save"></i>
                                Update
                            </button>
                        </div>
                        <div class="right">
                            <button type="button" onclick="handleDelete({{ $review->id }})"
                                class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-fw fa-trash"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <div class="col-lg-4">
            <section>
                <table class="table table-borderless mb-0">
                    <tbody>
                        <tr>
                            <th scope="col">Author</th>
                            <td class="text-right align-top" scope="col">:</td>
                            <td scope="col">
                                <a href="{{ route('customer.edit', $review->customer) }}">
                                    {{ $review->customer->name }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th scope="col">Itinerary</th>
                            <td class="text-right align-top" scope="col">:</td>
                            <td scope="col">
                                <a href="{{ route('itinerary.edit', $review->itinerary) }}">
                                    {{ $review->itinerary->place_name }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
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
