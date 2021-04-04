@extends('adminlte::page')

@section('title', 'Media')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-photo-video"></i> Media</h1>
    <hr>
    <section id="media">
        <form id="media-form" action="{{ route('media.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" id="media-input" class="d-none" name="image" />
            <button id="add-itinerary" class="btn btn-primary @error('image') is-invalid @enderror"
                onclick="$('#media-input').click()" type="button">
                <i class="fa fa-fw fa-upload"></i>
                Upload
            </button>
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </form>
        <div class="mt-4 mx-2">
            <div class="row">
                @foreach ($media as $m)
                    <button class="media__btn btn col-12 col-sm-6 col-md-4 col-lg-3 p-2" data-id="{{ $m->id }}"
                        data-toggle="modal" data-target="#media-edit-modal" type="button">
                        <div class="overflow-hidden">
                            <img class="media-display__img img-fluid" src="{{ $m->thumbnail_url }}"
                                alt="{{ $m->name }}" />
                        </div>
                    </button>
                @endforeach
            </div>
        </div>
    </section>
    <div id="modal-wrapper" >
        <div id="media-edit-modal" class="modal fade" aria-hidden="true" tabindex="-1" aria-labelledby="select-files">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title ml-auto" style="font-weight: 300;">Media</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body"></div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script charset="utf-8">
        $('#media-input').change(function(e) {
            $('#media-form').submit();
        });

        // open modal
        $('.media__btn').click(function(e) {
            e.preventDefault();
            const id = this.dataset.id;

            if (id == $('#media-edit-modal-img').data('id')) {
                return;
            }

            const loading = `
                <div class="d-flex justify-content-center align-items-center" height: 200px">
                    <h3 class="font-weight-normal">Fetching data ...</h3>
                </div>
            `;

            $('.modal-body').html(loading).load(`/media/${id}/edit`);
        });

    </script>
@endpush
