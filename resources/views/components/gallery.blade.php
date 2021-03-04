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
                <form id="media-upload" class="text-center d-block my-5" method="POST"
                    action="{{ route('media.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input id="media-upload-input" class="d-none" type="file" name="image" />
                    <button id="media-upload-btn" class="btn btn-outline-dark" type="button">
                        Upload new image
                    </button>
                </form>
                <hr>
                <div class="container">
                    <form id="media-display" class="row" method="POST">
                        @foreach ($media as $m)
                            <div class="col-12 col-sm-6 col-lg-3 p-2">
                                <div class="d-block overflow-hidden border">
                                    <input id="media-{{ $m->id }}" class="media__input d-none" type="radio"
                                        name="selected-image" value="{{ $m->id }}" />
                                    <label for="media-{{ $m->id }}" class="media__input__label d-block m-0">
                                        <img class="img-fluid media__img" src="{{ $m->uri }}"
                                            alt="{{ $m->alt }}" />
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        // trigger file input
        $('#media-upload-btn').click(function(e) {
            e.preventDefault();
            $('#media-upload-input').click();
        });

        // upload new image
        $('#media-upload-input').change(function(e) {
            e.preventDefault();

            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }

            const formData = new FormData();
            formData.append('image', e.target.files[0]);

            axios.post('/media', formData, config)
                .then(res => {
                    $('#media-display').prepend(`
                        <div class="col-12 col-sm-6 col-lg-3 p-2">
                            <div class="d-block overflow-hidden border">
                                <input id="media-${res.data.id}" class="media__input d-none" type="radio"
                                    name="selected-image" value="${res.data.id}" />
                                <label for="media-${res.data.id}" class="media__input__label d-block m-0">
                                    <img class="img-fluid media__img" src="${res.data.uri}"
                                        alt="${res.data.alt}" />
                                </label>
                            </div>
                        </div>
                    `);
                });
        });

    </script>
@endpush
