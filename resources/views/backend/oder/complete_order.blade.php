@extends('admin_dashboard')

@section('admin')
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">

                            </ol>
                        </div>
                        <h4 class="page-title">Pending Orders</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">


                            <table id="basic-datatable" class="table dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Oder No</th>
                                        <th>Order Date</th>
                                        <th>Cost</th>
                                        <th>Table</th>
                                        <th>Server</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($orders as $key => $item)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $item->order_no }}</td>
                                            <td>{{ $item->date }}</td>
                                            <td>{{ $item->total_price }}</td>
                                            <td>{{ $item->table->name }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td> <span class="badge bg-danger">{{ $item->status }}</span> </td>
                                            <td>
                                                <a href="{{ route('sale.print', ['id' => $item->id]) }}"
                                                    class="btn btn-blue rounded-pill waves-effect waves-light">
                                                    PDF Invoice
                                                </a>
                                            </td>
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <!-- end row-->




        </div> <!-- container -->

    </div> <!-- content -->
@endsection
