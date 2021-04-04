
<div id="media-edit" class="container mb-3">
    <div class="row">
        <div class="col-12 col-lg-8">
            <img id="media-edit-img" class="img-fluid border w-100" src="{{ $media->url }}"
                alt="{{ $media->alt }}" />
        </div>
        <div class="col-12 col-lg-4 mt-3 mt-lg-0">
            <div class="form-group">
                <strong>File Size : </strong>
                <span id="filesize">{{ $media->file_size }}</span>
            </div>
            <div class="form-group">
                <label for="itinerary_count">Used by : </label>
                <span id="itinerary_count">{{ $media->itineraries()->count() }} {{ $media->itineraries()->count() > 1 ? 'Itineraries' : 'Itinerary' }}</span>
            </div>
            <div class="form-group">
                <label for="input-alt">Alt : </label>
                <input id="input-alt" class="form-control" type="text" name="alt"
                    value="{{ $media->alt }}" />
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button id="submit-btn" class="btn btn-primary" type="button" disabled>
                    <i class="fa fa-fw fa-save"></i>
                    Save
                </button>
                <button id="delete-btn" class="btn btn-danger" type="button">
                    <i class="fa fa-fw fa-trash"></i>
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    // enable submit btn when input changed
    $('input[name="alt"]').keyup(function(e) {
        $('#submit-btn').removeAttr('disabled');
    });

    // handle submit form
    $('#submit-btn').click(function(e) {
        e.preventDefault();
        const alt = $('input[name="alt"]').val();

        axios.put('/media/{{ $media->id }}', {
                alt
            })
            .then(() => $('#submit-btn').attr('disabled', 'disabled'));
    });

    // handle delete
    $('#delete-btn').click(function(e) {
        if (!confirm('Are you sure?')) {
            return;
        }

        axios.delete('/media/{{ $media->id }}')
            .then(() => document.location.reload());
    });

</script>
