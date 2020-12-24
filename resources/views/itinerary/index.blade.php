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
        <table id="datatables" class="table table-striped table-bordered table-responsive">
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
                        <td class="text-nowrap">
                            <a class="text-dark" href="{{ route('itinerary.edit', $itinerary) }}">
                                {{ $itinerary->place_name }}
                            </a>
                        </td>
                        <td class="text-right text-nowrap">Rp. {{ number_format($itinerary->price, 0, ',', '.') }}</td>
                        <td class="text-nowrap">{{ $itinerary->categories->pluck('name')->join(', ') }}</td>
                        <td class="text-center text-nowrap">
                            <span class="bg-success rounded py-1 px-3">Published</span>
                        </td>
                        <td class="text-center text-nowrap">
                            <a class="btn btn-primary btn-sm" href="{{ route('itinerary.edit', $itinerary) }}">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>
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
