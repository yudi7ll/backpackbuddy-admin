@extends('adminlte::page')

@section('title', 'Add New Itinerary')

@section('content')
    <h1 class="title">
        <i class="fa fa-fw fa-plus"></i>
        Add New Itinerary
    </h1>
    <hr>
    <form id="itinerary-form" action="{{ route('itinerary.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="row">
            <div class="col-lg-8">
                <section class="mb-4">
                    <input type="hidden" name="is_published" value="0" />
                    <div class="form-group">
                        <label for="input-place_name" class="col-form-label">Place Name:</label>
                        <input type="text" class="form-control @error('place_name') is-invalid @enderror"
                            id="input-place_name" name="place_name" value="{{ old('place_name') }}" />

                        @error('place_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-category">Category:</label>
                        <div>
                            <select class="@error('categories') is-invalid @enderror" name="categories[]"
                                id="input-category" multiple style="width: 100%;">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->slug }}">
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
                            <select class="@error('districts') is-invalid @enderror" name="districts[]" id="input-district"
                                multiple style="width: 100%;">
                                @foreach ($districts as $district)
                                    <option value="{{ $district->slug }}">
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
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="input-price"
                            name="price" value="{{ old('price') }}" />

                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-sale" class="col-form-label">Sale:</label>
                        <input type="text" class="form-control @error('sale') is-invalid @enderror" id="input-sale"
                            name="sale" value="{{ old('sale') }}" />

                        @error('sale')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-excerpt" class="col-form-label">Excerpt:</label>
                        <textarea class="form-control" id="input-excerpt" rows="3"
                            name="excerpt">{{ old('excerpt') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="input-description" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="input-description" rows="5"
                            name="description">{{ old('description') }}</textarea>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm" onclick="submitForm(0)">
                        <i class="fa fa-fw fa-save"></i>
                        Save Draft
                    </button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="submitForm(1)">
                        <i class="fa fa-fw fa-globe"></i>
                        Publish
                    </button>
                </section>
            </div>
            <div class="col-lg-4">
                <section class="d-flex align-items-center justify-content-between mb-3">
                    <button type="button" class="btn btn-secondary" onclick="submitForm(0)">
                        <i class="fa fa-fw fa-save"></i>
                        Save Draft
                    </button>
                    <button type="button" class="btn btn-primary" onclick="submitForm(1)">
                        <i class="fa fa-fw fa-globe"></i>
                        Publish
                    </button>
                </section>
                <section id="featured-picture" class="mb-3">
                    <h4>Featured Picture</h4>
                    <hr>
                    <img class="img-fluid mb-2" id="featured-preview" src="" />
                    <button id="input-featured_picture"
                        class="btn btn-outline-success @error('featured_picture') is-invalid @enderror" type="button"
                        data-toggle="modal" data-target="#gallery-modal">
                        Select Pictures
                    </button>

                    @error('featured_picture')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </section>
                <section>
                    <h4>Gallery</h4>
                    <hr>
                    <div class="row mb-2" id="gallery-preview"></div>
                    <input type="file" class="form-control-file @error('galleries') is-invalid @enderror" name="galleries[]"
                        id="input-gallery" multiple />
                    @error('galleries')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </section>
            </div>
        </div>
    </form>
    <div id="gallery">
        <x-gallery targetForm="itinerary-form" />
    </div>
@endsection
@push('js')
    <script>
        function submitForm(isPublished) {
            $('input[name="is_published"]').attr('value', isPublished);
            $('#itinerary-form').submit();
        }

        // Featured Picture Preview
        const featuredPreview = $('#featured-preview');
        const inputFeatured = $('#input-featured_picture');

        inputFeatured.on('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function() {
                    const result = reader.result;
                    featuredPreview.attr('src', result);
                }

                reader.readAsDataURL(file);
            }
        });

        // Image Gallery Preview
        $('#input-gallery').on('change', function() {
            const files = this.files;

            if (files) {
                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    const reader = new FileReader();
                    reader.onload = function() {
                        const result = reader.result;
                        const img = '<img class="img-fluid mb-2 px-1 col" src="' + reader.result +
                            '" style="min-width: 50%; object-fit: cover;">'
                        $(`#gallery-preview`).append(img, null);
                    }

                    reader.readAsDataURL(file);
                };
            }
        });

    </script>
@endpush
