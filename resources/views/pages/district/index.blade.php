@extends('adminlte::page')

@section('title', 'Districts')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-map-marker-alt"></i> Districts</h1>
    <hr>
    <section>
        <button id="add-district" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#district-modal">
            <i class="fa fa-fw fa-plus"></i>
            Add New
        </button>
        <div class="table-responsive">
            <table id="datatables" class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th class="text-nowrap">District Name</th>
                        <th class="text-nowrap">District Slug</th>
                        <th class="text-nowrap">Itinerary Count</th>
                        <th class="text-nowrap">Added at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($districts as $key => $district)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>
                                <a class="text-dark" href="{{ route('district.edit', $district) }}">
                                    {{ $district->name }}
                                </a>
                            </td>
                            <td>{{ $district->slug }}</td>
                            <td class="text-center">{{ $district->itineraries()->count() }}</td>
                            <td>{{ $district->updated_at->diffForHumans() }}</td>
                            <td class="text-nowrap text-center">
                                <a class="btn btn-primary btn-sm" href="{{ route('district.edit', $district) }}" title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                                <form id="delete-form" class="d-inline-block m-0" action="{{ route('district.destroy', $district) }}" method="POST" title="Delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirm('Are you sure?') && $(this).parent().submit()" class="btn btn-sm btn-danger">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@include('pages.district.quick-add')

@if ($errors->any())
    @push('js')
        <script>
            $(document).ready(function() {
                $('#district-modal').modal('show');
            });
        </script>
    @endpush
@endif
