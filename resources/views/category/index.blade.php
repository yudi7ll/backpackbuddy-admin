@extends('adminlte::page')

@section('title', 'Premium Itinerary')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-tags"></i> Categories</h1>
    <hr>
    <section>
        <button id="add-category" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#category-modal">
            <i class="fa fa-fw fa-plus"></i>
            Add New
        </button>
        <table id="datatables" class="table table-striped table-bordered table-responsive-xl">
            <thead>
                <tr class="text-center">
                    <th>No.</th>
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
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td class="text-center">{{ $category->itineraries()->count() }}</td>
                        <td>{{ $category->updated_at->diffForHumans() }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm" href="{{ route('category.edit', $category) }}" title="Edit">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>
                            <form id="delete-form" class="d-inline-block m-0" action="{{ route('category.destroy', $category) }}" method="POST" title="Delete">
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
    </section>
@endsection
@include('category.quick-add')

@if ($errors->any())
    @push('js')
        <script>
            $(document).ready(function() {
                $('#category-modal').modal('show');
            });
        </script>
    @endpush
@endif
