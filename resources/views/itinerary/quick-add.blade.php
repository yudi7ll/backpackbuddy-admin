<div class="modal fade" id="itinerary-modal" tabindex="-1" aria-labelledby="itinerary-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="itinerary-modal-label">Add New Itinerary</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="itinerary-form" action="{{ route('itinerary.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="is_published" value="0" />
                    <div class="form-group">
                        <label for="input-place_name" class="col-form-label">Place Name:</label>
                        <input
                            type="text"
                            class="form-control @error('place_name') is-invalid @enderror"
                            id="input-place_name"
                            name="place_name"
                            value="{{ old('place_name') }}"
                            />

                        @error('place_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-category">Category:</label>
                        <div>
                            <select class="@error('categories') is-invalid @enderror" name="categories[]" id="input-category" multiple style="width: 100%;">
                                @foreach (\App\Category::all() as $category)
                                    <option value="{{ $category->name }}">
                                    {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('categories')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="input-price" class="col-form-label">Price:</label>
                        <input
                            type="text"
                            class="form-control @error('price') is-invalid @enderror"
                            id="input-price"
                            name="price"
                            value="{{ old('price') }}"
                        />

                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-sale" class="col-form-label">Sale:</label>
                        <input
                            type="text"
                            class="form-control @error('sale') is-invalid @enderror"
                            id="input-sale"
                            name="sale"
                            value="{{ old('sale') }}"
                        />

                        @error('sale')
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
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-danger btn-sm mr-auto" data-dismiss="modal">
                    <i class="fa fa-fw fa-ban"></i>
                    Close
                </button>
                <button type="button" class="btn btn-secondary btn-sm" onclick="submitForm(0)">
                    <i class="fa fa-fw fa-save"></i>
                    Draft
                </button>
                <button type="button" class="btn btn-primary btn-sm" onclick="submitForm(1)">
                    <i class="fa fa-fw fa-globe"></i>
                    Publish
                </button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        function submitForm(isPublished) {
            $('input[name="is_published"]').attr('value', isPublished);
            $('#itinerary-form').submit();
        }
    </script>
@endpush
