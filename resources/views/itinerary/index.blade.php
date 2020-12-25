@extends('adminlte::page')

@section('title', 'Premium Itinerary')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-star"></i> Premium Itinerary</h1>
    <hr>
    <section>
        <button id="add-itinerary" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#itinerary-modal">
            <i class="fa fa-fw fa-plus"></i>
            Quick Add
        </button>
        <table id="datatables" class="table table-striped table-bordered table-responsive-xl">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
                    <th>Place name</th>
                    <th>Price</th>
                    <th>Sale</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itineraries as $key => $itinerary)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td class="text-nowrap">
                            <a class="text-dark" href="{{ route('itinerary.edit', $itinerary) }}">
                                {{ $itinerary->place_name }}
                            </a>
                        </td>
                        <td class="text-right text-nowrap">
                            Rp. {{ number_format($itinerary->sale ? $itinerary->sale : $itinerary->price, 0, ',', '.') }}
                        </td>
                        <td class="text-center text-nowrap">
                            {{ $itinerary->sale ? 'Yes' : 'No' }}
                        </td>
                        <td>{{ $itinerary->categories->pluck('name')->join(', ') }}</td>
                        <td class="text-center text-nowrap">
                            @if ($itinerary->is_published)
                                <small class="bg-success rounded py-1 px-3">Published</small>
                            @else
                                <small class="bg-secondary rounded py-1 px-3">Draft</small>
                            @endif
                        </td>
                        <td class="text-nowrap">{{ $itinerary->updated_at->diffForHumans() }}</td>
                        <td class="text-center text-nowrap">
                            <button class="btn btn-info btn-sm text-white" title="Quick view">
                                <i class="fa fa-fw fa-eye"></i>
                            </button>
                            <a class="btn btn-primary btn-sm" href="{{ route('itinerary.edit', $itinerary) }}" title="Edit">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>
                            <form id="delete-form" class="d-inline-block m-0" action="{{ route('itinerary.destroy', $itinerary->id) }}" method="POST" title="Delete">
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
