@extends('adminlte::page')

@section('title', 'Customer')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-user"></i> Customers</h1>
    <hr />
    <section>
        <div class="table-responsive">
            <table id="datatables" class="table table-striped table-bordered">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center text-nowrap">Joined at</th>
                    <th class="text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($customers as $key => $customer)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td>
                                <a class="text-dark" href="{{ route('customer.show', $customer) }}">{{ $customer['name'] }}</a>
                            </td>
                            <td>
                                <a class="text-dark" href="{{ route('customer.show', $customer) }}">{{ $customer['username'] }}</a>
                            </td>
                            <td>
                                <a href="mailto:{{ $customer['email'] }}">{{ $customer['email'] }}</a>
                            </td>
                            <td class="text-center">{{ $customer['created_at']->diffForHumans() }}</td>
                            <td class="text-center text-nowrap align-middle">
                                <a class="btn btn-primary btn-sm" href="{{ route('customer.show', $customer) }}" title="Edit">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
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
