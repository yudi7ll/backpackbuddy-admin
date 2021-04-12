@extends('adminlte::page')

@section('title', 'Media')

@section('content')
    <h1 class="title"><i class="fa fa-fw fa-chart-line"></i> Order</h1>
    <hr>
    <section id="order">
        <div class="table-responsive">
            <table id="datatables" class="table table-striped table-bordered">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th class="text-nowrap">Thumb</th>
                        <th class="text-nowrap">Place name</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>District</th>
                        <th class="text-nowrap">Updated at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $key => $order)
                        <tr>
                            <td class="text-center align-middle">{{ $key + 1 }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

@endsection
