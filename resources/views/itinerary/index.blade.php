@extends('adminlte::page')

@section('title', 'Premium Itinerary')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-tasks"></i> Premium Itinerary</h1>
    <hr>
    <section>
        <button id="add-itinerary" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#itinerary-modal">
            <i class="fa fa-fw fa-plus"></i>
            Quick Add
        </button>
        <div class="table-responsive">
        <table id="datatables" class="table table-sm table-striped table-bordered">
            <thead>
                <tr class="text-center">
                    <th>NO&nbsp;</th>
                    <th class="text-nowrap">Thumb&nbsp;</th>
                    <th class="text-nowrap">Place name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>District</th>
                    <th class="text-nowrap">Updated at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($itineraries as $key => $itinerary)
                    <tr>
                        <td class="text-center align-middle">{{ $key+1 }}</td>
                        <td class="text-center align-middle">
                            <a href="{{ route('itinerary.edit', $itinerary) }}">
                                <img class="img__featured img-fluid" src="{{ $itinerary->featured_picture }}" alt="{{ $itinerary->place_name }}" />
                            </a>
                        </td>
                        <td class="text-nowrap align-middle">
                            <a class="text-dark" href="{{ route('itinerary.edit', $itinerary) }}">
                                @if (!$itinerary->is_published)
                                    <i class="fa fa-fw fa-file"></i>
                                    Draft -
                                @endif
                                {{ $itinerary->place_name }}
                            </a>
                        </td>
                        <td class="text-nowrap align-middle">
                            Rp. {{ number_format($itinerary->sale ? $itinerary->sale : $itinerary->price, 0, ',', '.') }}
                        </td>
                        <td class="align-middle">{{ $itinerary->categories->pluck('name')->join(', ') }}</td>
                        <td class="align-middle">{{ $itinerary->districts->pluck('name')->join(', ') }}</td>
                        <td class="text-nowrap align-middle">{{ $itinerary->updated_at->diffForHumans() }}</td>
                        <td class="text-center text-nowrap align-middle">
                            <a class="btn btn-primary btn-sm" href="{{ route('itinerary.edit', $itinerary) }}" title="Edit">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </a>
                            <button type="button" onclick="deleteHandle({{ $itinerary->id }})" class="btn btn-sm btn-danger">
                                <i class="fa fa-fw fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </section>
@endsection
@include('itinerary.quick-add')

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
    <script type="text/javascript">
        async function deleteHandle(id) {
            const willDelete = await swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            if (willDelete) {
                try {
                    await axios.delete(`/itinerary/${id}`)
                    document.location.reload();
                } catch(e) {
                    await swal("Error! Something have been wrong!", { icon: "error" });
                }
            }
        };
    </script>
@endpush
