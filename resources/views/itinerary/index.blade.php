@extends('adminlte::page')

@section('title', 'Premium Itinerary')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-star"></i> Premium Itinerary</h1>
    <hr>
    <section>
        <button id="add-itinerary" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#itinerary-modal">
            <i class="fa fa-fw fa-plus"></i>
            Add New
        </button>
        <table id="datatables" class="table table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>Place Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itineraries as $itinerary)
                    <tr>
                        <td>{{ $itinerary->place_name }}</td>
                        <td class="text-right">Rp. {{ number_format($itinerary->price, 0, ',', '.') }}</td>
                        <td>{{ $itinerary->categories->pluck('name')->join(', ') }}</td>
                        <td class="text-center">
                            <span class="bg-success rounded py-1 px-3">Published</span>
                        </td>
                        <td class="text-center">
                            <button type="button" id="edit-btn" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#itinerary-modal" data-action="{{ route('itinerary.update', $itinerary->id) }}">
                                <input type="hidden" id="input-place_name" value="{{ $itinerary->place_name }}" />
                                <input type="hidden" id="input-price" value="{{ $itinerary->price }}" />
                                <input type="hidden" id="input-excerpt" value="{{ $itinerary->excerpt }}" />
                                <input type="hidden" id="input-description" value="{{ $itinerary->description }}" />
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                            <form id="delete-form" class="d-inline-block m-0" action="{{ route('itinerary.destroy', $itinerary->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirm('Are you sure?') && $('#delete-form').submit()" class="btn btn-sm btn-danger">
                                    <i class="fa fa-fw fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
@include('itinerary.modal')

@if ($errors->any())
    @push('js')
        <script>
            $(document).ready(function() {
                $('#itinerary-modal').modal('show');
            });
        </script>
    @endpush
@endif
@push('js')
    <script>
        // datatables
        $(document).ready(function () {
            $('#datatables').DataTable();
        });

        // edit data
        $('#itinerary-modal').on('show.bs.modal', function (e) {
            const allInput = $(e.relatedTarget).find('input');
            const modal = $(this);

            // insert all hidden input to modal
            [].forEach.call(allInput, item => {
                modal.find(`#${item.id}`).val(item.value);
            });

            // change action form
            if (allInput.length) {
                $('#itinerary-form').attr('action', $(e.relatedTarget).data('action'))
                $('input[name="_method"]').val('PUT')
            } else {
                $('#itinerary-form').attr('action', '/itinerary');
                $('input[name="_method"]').val('POST')
            }
        });
    </script>
@endpush
