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
                <div class="row mt-4">
                    <div class="col-12 col-md-6 col-lg-12">
                        <section>
                            <h4>Featured Picture</h4>
                            <hr>
                            <div id="featured-picture-preview" class="row mb-2"></div>
                            <button id="featured-picture-btn"
                                class="btn btn-outline-success @error('featured_picture') is-invalid @enderror"
                                type="button" data-toggle="modal" data-target="#gallery-modal" data-type="featured-picture">
                                Select Pictures
                            </button>
                            <div id="input-featured-picture"></div>

                            @error('featured_picture')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </section>
                    </div>
                    <div class="mt-4 mt-md-0 mt-lg-4 col-12 col-md-6 col-lg-12">
                        <section>
                            <h4>Gallery</h4>
                            <hr>
                            <div class="row mb-2" id="gallery-preview"></div>
                            <button id="gallery-btn"
                                class="btn btn-outline-success @error('galleries') is-invalid @enderror" type="button"
                                data-toggle="modal" data-target="#gallery-modal" data-type="gallery">
                                Select Pictures
                            </button>
                            <div id="input-gallery"></div>
                            @error('galleries')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <x-gallery />
@endsection
@push('js')
    <script charset="utf-8">
        function submitForm(isPublished) {
            $('input[name="is_published"]').attr('value', isPublished);
            $('#itinerary-form').submit();
        }

    </script>
@endpush
