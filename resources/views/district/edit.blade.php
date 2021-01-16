@extends('adminlte::page')

@section('title', 'Edit Premium District')

@section('content')
    <h1 class="title">
        <i class="fa fa-fw fa-pencil-alt"></i>
        {{ $district->name }}
    </h1>
    <hr>
    <div class="row">
        <div class="col-lg-8">
            <section>
                <form id="district-form" action="{{ route('district.update', $district) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $district->id }}" />
                    <div class="form-group">
                        <label for="input-name" class="col-form-label">District Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="input-name" name="name" value="{{ old('name', $district->name) }}" />

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-slug" class="col-form-label">District Slug:</label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="input-slug" name="slug" value="{{ old('slug', $district->slug) }}" />

                        @error('slug')
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
                            <button type="button" onclick="deleteDistrictHandle({{ $district->id }})" class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-fw fa-trash"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </form>
            </section>

            <section class="my-4">
                <h4>Itineraries of {{ $district->name }}</h4>


                <table id="datatables" class="table table-striped table-bordered table-responsive-xl">
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th class="text-nowrap">Picture</th>
                            <th class="text-nowrap">Place Name</th>
                            <th class="text-nowrap">Last Updated</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($district->itineraries->all() as $key => $itinerary)
                            <tr>
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="text-center">
                                    <img class="img__featured img-fluid" src="{{ $itinerary->featured_picture }}" alt="{{ $itinerary->place_name }}" />
                                </td>
                                <td>
                                    <a class="text-dark" href="{{ route('itinerary.edit', $itinerary) }}">
                                        {{ $itinerary->place_name }}
                                    </a>
                                </td>
                                <td class="text-center">{{ $itinerary->updated_at->diffForHumans() }}</td>
                                <td class="text-nowrap text-center">
                                    <a class="btn btn-primary btn-sm" href="{{ route('itinerary.edit', $itinerary) }}" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                    <button type="button" onclick="deleteHandle('itinerary', {{ $itinerary->id }})" class="btn btn-sm btn-danger">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </section>
        </div>
        <div class="col-lg-4">
            <section>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Itinerary count: </strong> {{ $district->itineraries->count() }}
                    </li>
                    <li class="list-group-item">
                        <strong>Created at: </strong> {{ $district->created_at->diffForHumans() }}
                    </li>
                    <li class="list-group-item">
                        <strong>Updated at: </strong> {{ $district->updated_at->diffForHumans() }}
                    </li>
                </ul>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        async function deleteItineraryHandle(id) {
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

        async function deleteDistrictHandle(id) {
            const willDelete = await swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            if (willDelete) {
                try {
                    await axios.delete(`/district/${id}`);
                    document.location.href = '/district';
                } catch(e) {
                    await swal("Error! Something have been wrong!", { icon: "error" });
                }
            }
        };
    </script>
@endpush
