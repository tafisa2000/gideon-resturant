@extends('admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- Page Title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="page-title text-primary">Order Details</h4>
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Orders</a></li>
                            <li class="breadcrumb-item active">Order Details</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- End Page Title -->

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-4 text-uppercase"><i class="mdi mdi-information-outline me-1"></i> Order Summary
                            </h5>
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Order No</label>
                                    <p class="text-dark fw-bold">{{ $order->order_no }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Table No</label>
                                    <p class="text-dark fw-bold">{{ $order->table->name }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Order Date</label>
                                    <p class="text-dark fw-bold">{{ $order->date }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Server</label>
                                    <p class="text-dark fw-bold">{{ $order->user->name }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Payment Status</label>
                                    <p class="text-{{ $order->status == 'Paid' ? 'success' : 'danger' }} fw-bold">
                                        {{ $order->status }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label"> Description</label>
                                    <p class="text-{{ $order->status == 'Paid' ? 'success' : 'danger' }} fw-bold">
                                        {{ $order->description }}</p>
                                </div>

                            </div>

                            <!-- Order Item Table -->
                            <div class="mt-4">
                                <h5 class="text-uppercase"><i class="mdi mdi-clipboard-list-outline me-1"></i> Order Items
                                </h5>
                                <table class="table table-bordered table-striped table-hover">
                                    <thead class="bg-primary text-white">
                                        <tr>
                                            <th>Image</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total (incl. VAT)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderItem as $item)
                                            <tr>
                                                <td><img src="{{ asset($item->menuItem->image_url) }}"
                                                        alt="{{ $item->menuItem->name }}" style="width:50px; height:40px;"
                                                        class="img-thumbnail"></td>
                                                <td>{{ $item->menuItem->name }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>${{ number_format($item->menuItem->price, 2) }}</td>
                                                <td>${{ number_format($item->quantity * $item->menuItem->price, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Order Total Section -->
                            <div class="mt-4 float-start">
                                <p><strong>Subtotal:</strong> <span
                                        class="float-end">${{ number_format($order->total_price, 2) }}</span></p>
                                <p><strong>VAT (21%):</strong> <span
                                        class="float-end">${{ number_format($order->total_price * 0.21, 2) }}</span></p>
                                <h4><strong>Total:</strong> ${{ number_format($order->total_price * 1.21, 2) }} USD</h4>
                            </div>

                            <!-- Complete Order Button -->
                            <div class="text-end mt-4">
                                {{ route('order.status.update') }}
                                <form method="post" action="{{ route('order.status.update') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $order->id }}">
                                    <button type="submit" class="btn btn-success waves-effect waves-light mt-2">
                                        <i class="mdi mdi-check-circle-outline"></i> Complete Order
                                    </button>
                                </form>
                            </div>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div> <!-- content -->
@endsection
