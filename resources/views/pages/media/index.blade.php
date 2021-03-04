@extends('adminlte::page')

@section('title', 'Media')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-photo-video"></i> Media</h1>
    <hr>
    <section>
        <form id="media-form" action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" id="media-input" class="d-none" name="image" />
            <button id="add-itinerary" class="btn btn-primary mb-4" onclick="$('#media-input').click()" type="button">
                <i class="fa fa-fw fa-upload"></i>
                Upload
            </button>
        </form>
        <div class="mx-2">
            <div class="row">
                @foreach ($media as $m)
                    <button id="media-list" class="btn col-12 col-sm-6 col-md-4 col-lg-3 p-2">
                        <div class="overflow-hidden">
                            <img class="media__img img-fluid" src="{{ $m->uri }}" alt="{{ $m->name }}" />
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script>
        $('#media-input').change(function(e) {
            $('#media-form').submit();
        });

    </script>
@endpush
