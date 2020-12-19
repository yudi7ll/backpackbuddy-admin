@extends('adminlte::page')

@section('title', 'Premium Itinerary')

@section('content')
    <h1><i class="fa fa-fw fa-star"></i> Premium Itinerary</h1>
    <hr>
    <section>
        <button id="add-itinerary" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#itinerary-modal">
            <i class="fa fa-fw fa-plus"></i>
            Add New
        </button>
        <table id="datatables" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Place Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itineraries as $itinerary)
                    <tr>
                        <td>{{ $itinerary->place_name }}</td>
                        <td class="text-right">Rp. {{ number_format($itinerary->price, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <span class="bg-success rounded py-1 px-3">Published</span>
                        </td>
                        <td class="text-right">
                            <button class="btn btn-sm btn-primary">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                            <button class="btn btn-sm btn-danger">
                                <i class="fa fa-fw fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <div class="modal fade" id="itinerary-modal" tabindex="-1" aria-labelledby="itinerary-modal-label" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itinerary-modal-label">Add New Itinerary</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="itinerary-form" action="{{ route('itinerary.store') }}" method="POST">
                        @csrf
                        <input type="hidden" id="input-id" name="id">
                        <div class="form-group">
                            <label for="place-name" class="col-form-label">Place Name:</label>
                            <input type="text" class="form-control @error('place_name') is-invalid @enderror" id="place-name" name="place_name" value="{{ old('place_name') }}" />

                            @error('place_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price" class="col-form-label">Price:</label>
                            <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" />

                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="excerpt" class="col-form-label">Excerpt:</label>
                            <textarea class="form-control" id="excerpt" rows="3" name="excerpt">{{ old('excerpt') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control" id="description" rows="5" name="description">{{ old('description') }}</textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-fw fa-ban"></i>
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" onclick="$('#itinerary-form').submit()">
                        <i class="fa fa-fw fa-save"></i>
                        Save
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@error('*')
    @push('js')
        <script>
            $(document).ready(function() {
                $('#itinerary-modal').modal('show');
            });
        </script>
    @endpush
@enderror
@push('js')
    <script>
        $(document).ready(function () {
            $('#datatables').DataTable();
        });

        $('#itinerary-modal').on('show.bs.modal', function (e) {
            const button = $(e.relatedTarget)
            const id = button.data('id');
            const modal = $(this)

            modal.find('#input-id').val(id)
        });
    </script>
@endpush
