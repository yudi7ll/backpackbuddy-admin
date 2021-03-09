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
                <form id="gallery-form" class="text-center d-block my-5" method="POST"
                    action="{{ route('media.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input id="gallery-upload-input" class="d-none" type="file" name="image" />
                    <button id="gallery-upload-btn" class="btn btn-outline-dark" type="button">
                        Upload new image
                    </button>
                </form>
                <hr>
                <div class="container">
                    <form id="media-display" class="media-display row" method="POST">
                        @foreach ($media as $m)
                            <div class="media-display__content col-12 col-sm-6 col-lg-3 p-2">
                                <input id="media-{{ $m->id }}" class="media-display__input d-none" type="radio"
                                    name="selected-image" value="{{ $m->id }}"
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
                <button id="gallery-select-btn" class="btn btn-lg btn-primary" disabled>Select</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        // trigger file input
        $('#gallery-upload-btn').click(function(e) {
            e.preventDefault();
            $('#gallery-upload-input').click();
        });

        // upload new image
        $('#gallery-upload-input').change(function(e) {
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
                                <div class="media-display__content col-12 col-sm-6 col-lg-3 p-2">
                                    <input id="media-${res.data.id}" class="media-display__input d-none" type="radio"
                                        name="selected-image" value="${res.data.id}"
                                        data-src="${res.data.thumbnail_url}" />
                                    <div class="media-display__image d-block overflow-hidden border rounded">
                                        <label for="media-${res.data.id}" class="media-display__input__label d-block m-0">
                                            <img class="img-fluid media-display__img" src="${res.data.thumbnail_url}"
                                                alt="${res.data.alt}" />
                                        </label>
                                    </div>
                                </div>
                            `);
                });
        });

        // enable gallery-select
        $('.media-display__input').change(function(e) {
            $('#gallery-select-btn').removeAttr('disabled');
        });

        // select the image
        $('#gallery-select-btn').click(function(e) {
            $('.modal').modal('hide');
            const selectedInput = $('input[name="selected-image"]:checked');
            const id = selectedInput.val();
            const src = selectedInput.data('src')

            // update $targetInput value
            $('input[name="{{ $targetInput }}"]').val(id);
            // update $targetInput preview src
            $('#{{ $targetInput }}-preview').attr('src', src);
        });

    </script>
@endpush
