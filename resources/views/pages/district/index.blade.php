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
                            <td class="text-center">{{ $district->updated_at->diffForHumans() }}</td>
                            <td class="text-nowrap text-center">
                                <a class="btn btn-primary btn-sm" href="{{ route('district.edit', $district) }}"
                                    title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                                <div class="d-inline-block m-0">
                                    <button type="button" onclick="deleteHandle({{ $district->id }})"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
@include('pages.district.quick-add')

@push('js')
    <script type="text/javascript">
        async function deleteHandle(id) {
            const willDelete = await swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            if (willDelete) {
                try {
                    await axios.delete(`/district/${id}`);
                    document.location.href = '/district';
                } catch (e) {
                    await swal("Error! Something have been wrong!", {
                        icon: "error"
                    });
                }
            }
        };

    </script>
@endpush

@if ($errors->any())
    @push('js')
        <script>
            $(document).ready(function() {
                $('#district-modal').modal('show');
            });

        </script>
    @endpush
@endif
