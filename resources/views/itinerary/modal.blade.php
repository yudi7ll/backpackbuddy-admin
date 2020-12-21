<div class="modal fade" id="itinerary-modal" tabindex="-1" aria-labelledby="itinerary-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="itinerary-modal-label">Add New Itinerary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itinerary-form" action="{{ route('itinerary.store') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="input-place_name" class="col-form-label">Place Name:</label>
                        <input type="text" class="form-control @error('place_name') is-invalid @enderror" id="input-place_name" name="place_name" value="{{ old('place_name') }}" />

                        @error('place_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-price" class="col-form-label">Price:</label>
                        <input type="text" class="form-control @error('price') is-invalid @enderror" id="input-price" name="price" value="{{ old('price') }}" />

                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-excerpt" class="col-form-label">Excerpt:</label>
                        <textarea class="form-control" id="input-excerpt" rows="3" name="excerpt">{{ old('excerpt') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="input-description" class="col-form-label">Description:</label>
                        <textarea class="form-control" id="input-description" rows="5" name="description">{{ old('description') }}</textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning mr-auto" onclick="confirm('Reset form?') && document.querySelector('form').reset()">
                    <i class="fa fa-fw fa-retweet"></i>
                    Reset
                </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-fw fa-ban"></i>
                    Close
                </button>
                <button type="submit" class="btn btn-primary" onclick="$('#itinerary-form').submit()">
                    <i class="fa fa-fw fa-save"></i>
                    Save
                </button>
            </div>
        </div>
    </div>
</div>
