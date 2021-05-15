<div id="gallery-modal" class="modal fade" aria-hidden="true" tabindex="-1" aria-labelledby="select-files">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title ml-auto" style="font-weight: 300;">Select Pictures</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="upload-error" class="my-4"></div>
                <form id="gallery-gallery-form" class="text-center d-block my-5" method="POST"
                    action="{{ route('media.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input id="gallery-gallery-upload-input" class="d-none" type="file" name="image" />
                    <button id="gallery-gallery-upload-btn" class="btn btn-outline-dark" type="button">
                        Upload new image
                    </button>
                </form>
                <hr>
                <div class="container">
                    <form id="gallery-media-display" class="media-display row" method="POST">
                        @foreach ($media as $m)
                            <div class="media-display__content col-12 col-sm-6 col-lg-3 p-2">
                                <input id="media-{{ $m->id }}" class="media-display__input d-none"
                                    type="checkbox" name="selected-image" value="{{ $m->id }}"
                                    data-src="{{ $m->thumbnail_url }}" />
                                <div class="media-display__image d-block overflow-hidden border rounded">
                                    <label for="media-{{ $m->id }}"
                                        class="media-display__input__label d-block m-0">
                                        <img class="img-fluid media-display__img" src="{{ $m->thumbnail_url }}"
                                            alt="{{ $m->alt }}" />
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button id="gallery-select-btn" class="btn btn-lg btn-primary" disabled type="button">Select</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="{{ asset('js/gallery-component.js') }}" async></script>
@endpush
