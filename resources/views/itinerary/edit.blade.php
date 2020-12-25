@extends('adminlte::page')

@section('title', 'Edit Premium Itinerary')

@section('content')
    <h1 class="title">
        <i class="fa fa-fw fa-pencil-alt"></i>
        {{ $itinerary->place_name }}
    </h1>
    <hr>
    <div class="row">
        <div class="col-lg-8">
            <section>
                <form id="itinerary-form" action="{{ route('itinerary.update', $itinerary) }}" method="POST">
                    @csrf
                    @method('PUT')
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
                                @foreach (\App\Category::all() as $category)
                                    <option
                                        {{ (bool) $category->itineraries->find($itinerary) ? 'selected=1' : '' }}
                                        value="{{ $category->name }}"
                                        >
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
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="custom-select" name="is_published" id="input-is_published">
                            <option {{ $category->is_published ? 'selected' : '' }} value="1">Publish</option>
                            <option {{ $category->is_published ? '' : 'selected' }} value="0">Draft</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="left">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-fw fa-globe"></i>
                                Update
                            </button>
                        </div>
                        <div class="right">
                            <button class="btn btn-outline-danger btn-sm">
                                <i class="fa fa-fw fa-trash"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <div class="col-lg-4">
            <section>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Status: </strong> {{ $itinerary->is_published ? 'Published' : 'Draft' }}
                    </li>
                    <li class="list-group-item">
                        <strong>View: </strong> Coming Soon
                    </li>
                    <li class="list-group-item">
                        <strong>Sold: </strong> Coming soon
                    </li>
                    <li class="list-group-item">
                        <strong>Created at: </strong> {{ $itinerary->created_at->diffForHumans() }}
                    </li>
                    <li class="list-group-item">
                        <strong>Updated at: </strong> {{ $itinerary->updated_at->diffForHumans() }}
                    </li>
                </ul>
            </section>
        </div>
    </div>
@endsection
