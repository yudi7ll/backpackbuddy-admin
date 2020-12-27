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
