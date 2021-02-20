@extends('adminlte::page')

@section('title', 'Edit Customer')

@section('content')
    <h1 class="title">
        <i class="fa fa-fw fa-pencil-alt"></i>
        Edit Customer / {{ $customer->name }}
    </h1>
    <hr>
    <div class="row">
        <div class="col-lg-8 mb-4">
            <section>
                <form id="customer-form" action="{{ route('customer.update', $customer) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $customer->id }}" />
                    <div class="form-group">
                        <label for="input-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="input-name" name="name" value="{{ old('name', $customer->name) }}" />

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-username" class="col-form-label">Username: </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="input-username" name="username" value="{{ old('username', $customer->username) }}">

                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-email" class="col-form-label">Email: </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="input-email" name="email" value="{{ old('email', $customer->email) }}">

                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="left">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-fw fa-save"></i>
                                Update
                            </button>
                        </div>
                        <div class="right">
                            <button type="button" onclick="deleteCustomerHandle({{ $customer->id }})" class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-fw fa-trash"></i>
                                Delete
                            </button>
                        </div>
                    </div>
                </form>
            </section>
            <section class="mt-4">
                <h4>Change Password</h4>
                <hr>
                <form action="{{ route('customer.update-password', $customer) }}" method="POST">
                    @csrf
                    @method("PUT")
                    <div class="form-group">
                        <label for="input-password" class="col-form-label">New Password: </label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="input-password" name="password">

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-password_confirmation" class="col-form-label">Confirm New Password: </label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="input-password_confirmation" name="password_confirmation">

                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="left">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-fw fa-save"></i>
                                Update Password
                            </button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <div class="col-lg-4">
            <section>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>Purchasing count: </strong> Coming Soon
                    </li>
                    <li class="list-group-item">
                        <strong>Created at: </strong> {{ $customer->created_at->diffForHumans() }}
                    </li>
                    <li class="list-group-item">
                        <strong>Updated at: </strong> {{ $customer->updated_at->diffForHumans() }}
                    </li>
                </ul>
            </section>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        async function deleteCustomerHandle(id) {
            const willDelete = await swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })

            if (willDelete) {
                try {
                    await axios.delete(`/customer/${id}`);
                    document.location.href = '/customer';
                } catch(e) {
                    await swal("Error! Something have been wrong!", { icon: "error" });
                }
            }
        };
    </script>
@endpush
