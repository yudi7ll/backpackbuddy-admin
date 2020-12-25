<div class="modal fade" id="category-modal" tabindex="-1" aria-labelledby="category-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title" id="category-modal-label">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="category-form" action="{{ route('category.store') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="input-name" class="col-form-label">Category Name:</label>
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
                        <label for="input-slug" class="col-form-label">Category Slug</label>
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
            $('#category-form').submit();
        }
    </script>
@endpush
