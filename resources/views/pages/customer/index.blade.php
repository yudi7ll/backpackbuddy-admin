@extends('adminlte::page')

@section('title', 'Customer')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-user"></i> Customer</h1>
    <hr />
    <section>
        <div class="table-responsive">
            <table id="datatables" class="table table-striped table-bordered">
                <thead>
                    <th class="text-center">No</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center text-nowrap">Purchasing Count</th>
                    <th class="text-center">Joined at</th>
                    <th class="text-center">Action</th>
                </thead>
                <tbody>
                    @foreach ($customers as $key => $customer)
                        <tr>
                            <td class="text-center">{{ $key + 1 }}</td>
                            <td class="text-center">
                                <a class="text-dark"
                                    href="{{ route('customer.edit', $customer) }}">{{ $customer['name'] }}</a>
                            </td>
                            <td class="text-center">
                                <a class="text-dark"
                                    href="{{ route('customer.edit', $customer) }}">{{ $customer['username'] }}</a>
                            </td>
                            <td class="text-center">
                                <a href="mailto:{{ $customer['email'] }}">{{ $customer['email'] }}</a>
                            </td>
                            <td class="text-center">Coming Soon</td>
                            <td class="text-center">{{ $customer['created_at']->diffForHumans() }}</td>
                            <td class="text-center text-nowrap align-middle">
                                <a class="btn btn-primary btn-sm" href="{{ route('customer.edit', $customer) }}"
                                    title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </a>
                                <form id="delete-form" class="d-inline-block m-0"
                                    action="{{ route('customer.destroy', $customer) }}" method="POST" title="Delete">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirm('Are you sure?') && $(this).parent().submit()"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection
