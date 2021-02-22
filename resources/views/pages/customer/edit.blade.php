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
                <h3>Account</h3>
                <hr>
                <form id="customer-form" action="{{ route('customer.update', $customer) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $customer->id }}" />
                    <div class="form-group">
                        <label for="input-name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="input-name"
                            name="name" value="{{ old('name', $customer->name) }}" />

                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-username" class="col-form-label">Username: </label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" id="input-username"
                            name="username" value="{{ old('username', $customer->username) }}">

                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-email" class="col-form-label">Email: </label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="input-email"
                            name="email" value="{{ old('email', $customer->email) }}">

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
                    </div>
                </form>
            </section>
            <section class="mt-4">
                <h3>Privacy</h3>
                <hr>
                <form id="customer-form" action="{{ route('customer.update-info', $customer) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $customer->id }}" />
                    <div class="form-group">
                        <label for="input-address_1" class="col-form-label">Adress 1: </label>
                        <input type="text" class="form-control @error('address_1') is-invalid @enderror"
                            id="input-address_1" name="address_1"
                             value="{{ old('address_1', isset($customer->customerInfo) ? $customer->customerInfo->address_1 : '') }}">

                        @error('address_1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-address_2" class="col-form-label">Adress 2 (Optional): </label>
                        <input type="text" class="form-control @error('address_2') is-invalid @enderror"
                            id="input-address_2" name="address_2"
                             value="{{ old('address_2', isset($customer->customerInfo) ? $customer->customerInfo->address_2 : '') }}">

                        @error('address_2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-postcode" class="col-form-label">Post Code: </label>
                        <input type="text" class="form-control @error('postcode') is-invalid @enderror"
                            id="input-postcode" name="postcode"
                             value="{{ old('postcode', isset($customer->customerInfo) ? $customer->customerInfo->postcode : '') }}">

                        @error('postcode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-city" class="col-form-label">City: </label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror"
                            id="input-city" name="city"
                             value="{{ old('city', isset($customer->customerInfo) ? $customer->customerInfo->city : '') }}">

                        @error('city')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-identity" class="col-form-label">Identity: </label>
                        <input type="text" class="form-control @error('identity') is-invalid @enderror"
                            id="input-identity" name="identity"
                             value="{{ old('identity', isset($customer->customerInfo) ? $customer->customerInfo->identity : '') }}"
                             placeholder="KTP/Passport/Visa">

                        @error('identity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-telp" class="col-form-label">Telp. : </label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror"
                            id="input-telp" name="telp"
                             value="{{ old('telp', isset($customer->customerInfo) ? $customer->customerInfo->telp : '') }}">

                        @error('telp')
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
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="input-password" name="password">

                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="input-password_confirmation" class="col-form-label">Confirm New Password: </label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="input-password_confirmation" name="password_confirmation">

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
            <section class="mt-4">
                <h4 class="text-danger">Danger Zone</h4>
                <hr>
                <button class="btn btn-outline-danger" type="button" onclick="deleteCustomerHandle({{ $customer->id }})">
                    Delete this account permanently
                </button>
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
                } catch (e) {
                    await swal("Error! Something have been wrong!", {
                        icon: "error"
                    });
                }
            }
        };
    </script>
@endpush
