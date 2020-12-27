<div class="modal fade" id="district-modal" tabindex="-1" aria-labelledby="district-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content" id="district-form" action="{{ route('district.store') }}" method="POST">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="district-modal-label">Add New District</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="input-name" class="col-form-label">District Name:</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="input-name"
                            name="name"
                            value="{{ old('name') }}"
                            />

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-slug" class="col-form-label">District Slug</label>
                        <input
                            type="text"
                            class="form-control @error('slug') is-invalid @enderror"
                            id="input-slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            />

                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-outline-danger btn-sm mr-auto" data-dismiss="modal">
                    <i class="fa fa-fw fa-ban"></i>
                    Close
                </button>
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-fw fa-save"></i>
                    Save
                </button>
            </div>
        </form>
    </div>
</div>
