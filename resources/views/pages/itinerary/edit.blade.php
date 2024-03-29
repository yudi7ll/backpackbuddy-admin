@extends('adminlte::page')

@section('title', 'Edit Itinerary')

@section('content')
    <h1 class="title">
        <i class="fa fa-fw fa-pencil-alt"></i>
        @if (!$itinerary->is_published)
            Draft -
        @endif
        {{ $itinerary->place_name }}
    </h1>
    <hr>
    <form id="itinerary-form" action="{{ route('itinerary.update', $itinerary) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <section>
                    <input type="hidden" name="id" value="{{ $itinerary->id }}" />
                    <div class="form-group">
                        <label for="input-place_name" class="col-form-label">Place Name:</label>
                        <input type="text" class="form-control @error('place_name') is-invalid @enderror" id="input-place_name" name="place_name" value="{{ old('place_name', $itinerary->place_name) }}" />

                        @error('place_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-category">Category:</label>
                        <div>
                            <select class="@error('categories') is-invalid @enderror" name="categories[]" id="input-category" multiple style="width: 100%;">
                                @foreach ($categories as $category)
                                    <option {{ (bool) $category->itineraries->find($itinerary) ? 'selected' : '' }} value="{{ $category->slug }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('categories')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-district">District:</label>
                        <div>
                            <select class="@error('districts') is-invalid @enderror" name="districts[]" id="input-district" multiple style="width: 100%;">
                                @foreach ($districts as $district)
                                    <option {{ (bool) $district->itineraries->find($itinerary) ? 'selected="selected"' : '' }} value="{{ $district->slug }}">
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('districts')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-price" class="col-form-label">Price:</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="input-price" name="price" value="{{ old('price', $itinerary->price) }}" />

                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-sale" class="col-form-label">Sale:</label>
                        <input type="text" class="form-control @error('sale') is-invalid @enderror" id="input-sale" name="sale" value="{{ old('sale', $itinerary->sale) }}" />

                        @error('sale')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-excerpt" class="col-form-label">Excerpt:</label>
                        <textarea class="form-control" id="input-excerpt" rows="3" name="excerpt">{{ old('excerpt', $itinerary->excerpt) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="input-description" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="input-description" rows="5" name="description">{{ old('description', $itinerary->description) }}</textarea>
                    </div>
                </section>
                <section class="mt-4">
                    <h4>Review</h4>
                    <hr>
                    <div class="table-responsive">
                        <table id="datatables" class="table table-striped table-bordered">
                            <thead>
                                <th class="text-center">No</th>
                                <th class="text-center text-nowrap">Customer Name</th>
                                <th class="text-center">Content</th>
                                <th class="text-center">Rating</th>
                                <th class="text-center text-nowrap">Added at</th>
                            </thead>
                            <tbody>
                                @foreach ($itinerary->reviews as $key => $review)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>
                                            <a class="text-dark field-hover" href="{{ route('customer.show', $review->customer) }}" title="Edit customer {{ $review->customer->name }}">
                                                {{ $review->customer->name }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $review->content }}
                                        </td>
                                        <td class="text-center">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                <i class="fas fa-fw fa-star text-warning"></i>
                                            @endfor
                                            @for ($i = 0; $i < 5 - $review->rating; $i++)
                                                <i class="far fa-fw fa-star"></i>
                                            @endfor
                                        </td>
                                        <td class="text-center text-nowrap">{{ $review->created_at->diffForHumans() }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            <div class="col-lg-4">
                <section>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <select class="custom-select" name="is_published" id="input-is_published">
                                <option {{ $itinerary->is_published ? 'selected' : '' }} value="1">Publish</option>
                                <option {{ $itinerary->is_published ? '' : 'selected' }} value="0">Draft</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-fw fa-save"></i>
                            Update
                        </button>
                    </div>
                </section>
                <section class="mt-4">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <strong>Visibility: </strong> {{ $itinerary->is_published ? 'Published' : 'Draft' }}
                        </li>
                        <li class="list-group-item">
                            <strong>View: </strong> {{ $itinerary->view }}
                        </li>
                        <li class="list-group-item">
                            <strong>Sold: </strong> {{ $itinerary->sold }}
                        </li>
                        <li class="list-group-item">
                            <strong>Created at: </strong> {{ $itinerary->created_at->diffForHumans() }}
                        </li>
                        <li class="list-group-item">
                            <strong>Updated at: </strong> {{ $itinerary->updated_at->diffForHumans() }}
                        </li>
                    </ul>
                </section>
                <section class="mt-4">
                    <h5 class="mb-3">Featured picture</h5>

                    <div id="featured-picture-preview">
                        <a href="{{ $itinerary->featured_picture }}" target="_blank">
                            <img class="img-fluid w-100" id="featured_picture-preview" src="{{ $itinerary->featured_picture_thumb }}" alt="{{ $itinerary->place_name }}" />
                        </a>
                    </div>
                    <div class="mt-3 d-flex justify-content-between">
                        <button id="featured-picture-btn" class="btn btn-outline-success @error('featured_picture') is-invalid @enderror" type="button" data-toggle="modal" data-target="#gallery-modal" data-type="featured-picture">
                            Change Picture
                        </button>
                    </div>
                    <div id="input-featured-picture"></div>
                </section>
                <section class="mt-4">
                    <h5 class="mb-3">Gallery</h5>
                    <div class="row px-2" id="gallery-preview">
                        @foreach ($itinerary->media as $media)
                            <a class="d-block col-6 px-2 mb-3" href="{{ $media->url }}" target="_blank">
                                <img class="img-fluid img--sm w-100" src="{{ $media->thumbnail_url }}" alt="{{ $media->name }}" />
                            </a>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-between">
                        <button id="gallery-btn" class="btn btn-outline-success @error('galleries') is-invalid @enderror" type="button" data-toggle="modal" data-target="#gallery-modal" data-type="gallery">
                            Change Pictures
                        </button>
                    </div>

                    <div id="input-gallery"></div>
                </section>
                <section class="mt-4">
                    <h5 class="text-danger">Danger Zone</h5>
                    <hr />
                    <button class="btn btn-outline-danger" onclick="deleteHandle('{{ $itinerary->id }}')" type="button">
                        <i class="fa fa-fw fa-trash"></i>
                        Delete
                    </button>
                </section>
            </div>
        </div>
    </form>
    <x-gallery />
@endsection
@push('js')
    <script charset="utf-8">
        $('#change-btn').on('click', () => $('#input-featured_picture').click());
        $('.action-image-btn').hide();

        // image preview
        $('#input-featured_picture').on('change', function(e) {
            const file = this.files[0];

            if (file) {
                $('.action-image-btn').show();
                // preview the image
                const reader = new FileReader();
                reader.onload = () => {
                    const result = reader.result;
                    $('#featured_picture-preview').attr('src', result);
                }

                reader.readAsDataURL(file);
            }
        });

        async function deleteHandle(id) {
            const willDelete = await swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            });

            if (willDelete) {
                try {
                    await axios.delete(`/itinerary/${id}`)
                    document.location.href = '/itinerary';
                } catch (e) {
                    await swal("Error! Something have been wrong!", {
                        icon: "error"
                    });
                }
            }
        };
    </script>
@endpush
