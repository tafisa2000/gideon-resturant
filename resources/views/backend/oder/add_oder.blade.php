@extends('admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        /* General Styling */
        .page-content {
            padding: 20px;
            background-color: #f8f9fc;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-size: 24px;
            color: #007bff;
            font-weight: 600;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
        }

        .form-control,
        .form-select {
            border-radius: 6px;
            padding: 10px;
            border: 1px solid #ced4da;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }

        .btn-rounded {
            border-radius: 30px;
            padding: 8px 20px;
        }

        .btn-secondary,
        .btn-info {
            background-color: #007bff;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-secondary:hover,
        .btn-info:hover {
            background-color: #0056b3;
        }

        .table {
            background-color: #fff;
            border-radius: 6px;
            overflow: hidden;
        }

        .table thead {
            background-color: #007bff;
            color: #fff;
        }

        .table th,
        .table td {
            padding: 15px;
            vertical-align: middle;
        }

        .table td img {
            border-radius: 5px;
        }

        .estimated_amount {
            font-size: 18px;
            font-weight: bold;
        }

        #description {
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 10px;
            transition: border-color 0.3s ease;
        }

        #description:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Order</h4><br><br>

                            <!-- Order Form -->
                            <div class="row">
                                <!-- Order No -->
                                <div class="col-md-2">
                                    <div class="mb-3">
                                        <label class="form-label">Order No</label>
                                        <input class="form-control" name="order_no" type="text"
                                            value="{{ $order_no }}" id="invoice_no" readonly
                                            style="background-color: #ddd;">
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Date</label>
                                        <input class="form-control" name="date" type="date"
                                            value="{{ $date }}" id="date">
                                    </div>
                                </div>

                                <!-- Menu Selection -->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Menu Selection</label>
                                        <select name="menu_item_id" id="menu_item_id" class="form-select select2">
                                            <option selected>Choose Menu Item</option>
                                            @foreach ($menu_item as $sev)
                                                <option value="{{ $sev->id }}" data-cost="{{ $sev->price }}"
                                                    data-image="{{ $sev->image_url }}">{{ $sev->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Add More Button -->
                                <div class="col-md-2 align-self-center">
                                    <div class="mb-3">
                                        <button
                                            class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore">Add
                                            More</button>
                                    </div>
                                </div>
                            </div> <!-- end row -->

                            <!-- Order Items Table -->
                            <form method="post" action="{{ route('order.store') }}">
                                @csrf
                                <table class="table table-bordered table-sm" style="border-color: #ddd;">
                                    <thead>
                                        <tr>
                                            <th width="15%">Image</th>
                                            <th width="15%">Name</th>
                                            <th width="15%">Qty</th>
                                            <th width="15%">Cost</th>
                                            <th width="15%">Total</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addRow" class="addRow"></tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">Grand Total</td>
                                            <td>
                                                <input type="text" name="cost" value="0" id="estimated_amount"
                                                    class="form-control estimated_amount" readonly
                                                    style="background-color: #ddd;">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table><br>

                                <!-- Order Description -->
                                <div class="form-group">
                                    <textarea name="description" class="form-control" id="description" placeholder="Write description here"></textarea>
                                </div>

                                <div class="row">
                                    <!-- Server Selection -->
                                    <div class="col-md-3">
                                        <label>Server Selection</label>
                                        <select name="user_id" id="user_id" class="form-select select2">
                                            <option value="">Select Server</option>
                                            @foreach ($server as $cust)
                                                <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Table Selection -->
                                    <div class="col-md-3">
                                        <label>Table Selection</label>
                                        <select name="table_id" id="table_id" class="form-select select2">
                                            <option value="">Select Table</option>
                                            @foreach ($table as $cust)
                                                <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div><br>

                                <!-- Submit Button -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="storeButton">Submit Order</button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end container-fluid -->
    </div> <!-- end page-content -->

    <!-- Handlebars Template for Order Items -->
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item">
            <input type="hidden" name="date" value="@{{date}}">
            <input type="hidden" name="order_no" value="@{{invoice_no}}">
            <input type="hidden" name="menu_item_id[]" value="@{{menu_item_id}}">
            <td><img src="@{{ service_image }}" alt="Item Image" width="70" height="70"></td>
            <td>@{{ service_name }}</td>
            <td><input type="number" min="1" class="form-control selling_qty text-right" name="quantity[]" value="1"></td>
            <td>@{{ server_cost }}</td>
            <td class="cost_total">@{{ server_cost }}</td>
            <td><button class="btn btn-danger btn-sm removeeventmore">Remove</button></td>
        </tr>
    </script>

    <!-- JavaScript Logic -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Add event more
            $(document).on("click", ".addeventmore", function() {
                var date = $('#date').val();
                var invoice_no = $('#invoice_no').val();
                var service_id = $('#menu_item_id').val();
                var service_name = $('#menu_item_id').find('option:selected').text();
                var service_cost = parseFloat($('#menu_item_id').find('option:selected').data('cost'));
                var service_image = $('#menu_item_id').find('option:selected').data('image');
                var image_url = service_image ? '{{ asset('') }}' + service_image :
                    '{{ asset('images/default-image.jpg') }}';

                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data = {
                    date: date,
                    invoice_no: invoice_no,
                    menu_item_id: service_id,
                    service_name: service_name,
                    server_cost: service_cost.toFixed(2),
                    service_image: image_url
                };

                var html = template(data);
                $("#addRow").append(html);
                totalAmountPrice(); // Update total
            });

            // Remove event more
            $(document).on("click", ".removeeventmore", function() {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });

            // Update cost based on quantity input
            $(document).on('keyup click', '.selling_qty', function() {
                var qty = $(this).val();
                var cost = $(this).closest("tr").find("td:eq(3)").text();
                var total = qty * cost;
                $(this).closest("tr").find("td:eq(4)").text(total.toFixed(2));
                totalAmountPrice();
            });

            // Function to calculate total price
            function totalAmountPrice() {
                var sum = 0;
                $(".cost_total").each(function() {
                    var value = parseFloat($(this).text());
                    if (!isNaN(value)) {
                        sum += value;
                    }
                });
                $('#estimated_amount').val(sum.toFixed(2));
            }
        });
    </script>
@endsection
