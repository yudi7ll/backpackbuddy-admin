@extends('adminlte::page')

@section('title', 'Edit Premium Itinerary')

@section('content')
    <h1 class="title">
        <i class="fa fa-fw fa-pencil-alt"></i>
        {{ $itinerary->place_name }}
    </h1>
    <hr>
    <section class="bg-light">
        <form action="{{ route('itinerary.update', $itinerary) }}" method="POST">
            @csrf
            @method('PUT')
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
                <label for="input-excerpt" class="col-form-label">Excerpt:</label>
                <textarea class="form-control" id="input-excerpt" rows="3" name="excerpt">{{ old('excerpt', $itinerary->excerpt) }}</textarea>
            </div>
            <div class="form-group">
                <label for="input-description" class="col-form-label">Description:</label>
                <textarea class="form-control" id="input-description" rows="5" name="description">{{ old('description', $itinerary->description) }}</textarea>
            </div>
            <button class="btn btn-primary btn-sm">
                <i class="fa fa-fw fa-save"></i>
                Update
            </button>
        </form>
    </section>
@endsection
