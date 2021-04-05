@extends('adminlte::page')

@section('title', 'Categories')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-tags"></i> Categories</h1>
    <hr>
    <section>
        <button id="add-category" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#category-modal">
            <i class="fa fa-fw fa-plus"></i>
            Add New
        </button>
        <div class="table-responsive">
            <table id="datatables" class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th class="text-nowrap">Category Name</th>
                        <th class="text-nowrap">Category Slug</th>
                        <th class="text-nowrap">Itinerary Count</th>
                        <th class="text-nowrap">Added at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $key => $category)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">
                                <a class="text-dark" href="{{ route('category.edit', $category) }}">
                                    {{ $category->name }}
                                </a>
                            </td>
                            <td class="text-center">{{ $category->slug }}</td>
                            <td class="text-center">{{ $category->itineraries()->count() }}</td>
                            <td class="text-center">{{ $category->updated_at->diffForHumans() }}</td>
                            <td class="text-nowrap text-center">
                                <a class="btn btn-primary btn-sm" href="{{ route('category.edit', $category) }}"
                                    title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                                <div class="d-inline-block m-0">
                                    <button type="button" onclick="deleteCategoryHandle({{ $category->id }})"
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
@include('pages.category.quick-add')

@push('js')
    <script>
        async function deleteCategoryHandle(id) {
            const willDelete = await swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            if (willDelete) {
                try {
                    await axios.delete(`/category/${id}`);
                    document.location.href = '/category';
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
                $('#category-modal').modal('show');
            });

        </script>
    @endpush
@endif
