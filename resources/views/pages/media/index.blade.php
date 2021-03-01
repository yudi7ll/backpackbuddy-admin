@extends('adminlte::page')

@section('title', 'Media')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-photo-video"></i> Media</h1>
    <hr>
    <section>
        <button id="add-itinerary" class="btn btn-primary btn-sm mb-4" data-toggle="modal" data-target="#itinerary-modal">
            <i class="fa fa-fw fa-plus"></i>
            Quick Add
        </button>
        <div class="mx-2">
            <div class="row">
                @foreach ($media as $m)
                    <button class="btn col-3 p-2">
                        <div class="overflow-hidden">
                            <img class="media__img img-fluid" src="{{ $m->uri }}" alt="{{ $m->name }}" />
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
        </div>
    </section>
@endsection
