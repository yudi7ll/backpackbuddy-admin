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
                                <input id="media-{{ $m->id }}" class="media-display__input d-none" type="checkbox"
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
                <button id="gallery-select-btn" class="btn btn-lg btn-primary" disabled type="button">Select</button>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script charset="utf-8">
        let targetElement;

        $('button[data-toggle="modal"]').on('click', function (e) {
            const type = e.target.dataset.type;
            targetElement = type;
            $('.media-display__input').attr('type', type == 'gallery' ? 'checkbox' : 'radio');
        });

        // trigger file input
        $('#gallery-gallery-upload-btn').click(function(e) {
            e.preventDefault();
            $('#gallery-gallery-upload-input').click();
        });

        // upload new image
        $('#gallery-gallery-upload-input').change(function(e) {
            e.preventDefault();

            const config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            }

            const formData = new FormData();
            formData.append('image', e.target.files[0]);

            axios.post('/media', formData, config)
                .then(res => $('#gallery-media-display').prepend(`
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
                `));
        });

        // enable select btn
        $('#gallery-media-display').change(function(e) {
            $('#gallery-select-btn').removeAttr('disabled');
        });

        function previewSelectedFeaturedPicture() {
            const selectedInput = $('input[name="selected-image"]:checked');

            let imgElements = '';
            let inputGallery = '';
            for (let i = 0; i < selectedInput.length; i++) {
                const id = selectedInput[i].value;
                const src = selectedInput[i].dataset.src;


                if (targetElement == 'gallery') {
                    imgElements += `<img class="gallery__thumbnail col-6 mb-3 px-2" src="${src}" alt="${id}" />`;
                    inputGallery += `<input type="hidden" name="galleries[]" multiple value="${id}" />`;
                } else {
                    imgElements += `<img class="img-fluid mb-3 h-100" src="${src}" alt="${id}" />`;
                    inputGallery += `<input type="hidden" name="featured_picture" value="${id}" />`;
                }

            }

            $(`#${targetElement}-preview`).html(imgElements);

            // update $target value
            $(`#input-${targetElement}`).html(inputGallery);
        }

        // select the image
        $('#gallery-select-btn').click(function(e) {
            $('#gallery-modal').modal('hide');
            previewSelectedFeaturedPicture();
        });

        // preview the image when already selected
        previewSelectedFeaturedPicture();
        console.log('gallery');

    </script>
@endpush