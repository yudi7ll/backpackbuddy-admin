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
                <div class="media text-center my-5">
                    <form id="media-form" class="media text-center d-block" method="POST"
                        action="{{ route('media.store') }}" enctype="multipart/form-data">
                        @csrf
                        <input id="media-input" class="d-none" type="file" name="image" />
                        <button id="media-upload-btn" class="btn btn-outline-dark" type="button">
                            Upload new image
                        </button>
                        <label for="media-upload-btn" style="font-weight: normal;">or Drag n Drop here</label>
                    </form>
                </div>
                <hr>
                <div class="container">
                    <div id="media-display" class="row">
                        @foreach ($media as $m)
                            <div class="col-12 col-sm-6 col-lg-3 p-2">
                                <a href="javascript:void" class="d-block overflow-hidden border">
                                    <img class="img-fluid media__img" src="{{ $m->uri }}"
                                        alt="{{ $m->alt }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        $('#media-upload-btn').click(function(e) {
            e.preventDefault();
            $('#media-input').click();
        });

        $('#media-input').change(function(e) {
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
                            <a href="javascript:void" class="d-block overflow-hidden border">
                                <img class="img-fluid media__img" src="${res.data.uri}"
                                    alt="${res.data.alt}">
                            </a>
                        </div>
                    `)
                });
        });

    </script>
@endpush
