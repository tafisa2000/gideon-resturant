@extends('admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Order</h4><br><br>

                            <!-- Order Form -->
                            <div class="row">
                                <!-- Invoice Number -->
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
                                                    data-image="{{ $sev->image_url }}">
                                                    {{ $sev->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Modifier Selection -->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Modifier Selection</label>
                                        <select name="modifier_id" id="modifier_id" class="form-select select2">
                                            <option selected>Choose Modifier</option>
                                            @foreach ($modifier as $mod)
                                                <option value="{{ $mod->id }}">{{ $mod->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Add More Button -->
                                <div class="col-md-2 align-self-center">
                                    <div class="mb-3">
                                        <button class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore">
                                            Add More
                                        </button>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div> <!-- end card-body -->

                        <!-- Order Items Table -->
                        <div class="card-body">
                            <form method="post" action="{{ route('order.store') }}">
                                @csrf
                                <table class="table table-bordered table-sm" style="border-color: #ddd;">
                                    <thead>
                                        <tr>
                                            <th width="15%">Image</th>
                                            <th width="25%">Name</th>
                                            <th width="25%">Modifier</th>
                                            <th width="15%">Cost</th>
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
                                </div><br>

                                <!-- Server and Table Selection -->
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Server Selection</label>
                                        <select name="user_id" id="user_id" class="form-select select2">
                                            <option value="">Select Server</option>
                                            @foreach ($server as $cust)
                                                <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

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
            <input type="hidden" name="modifier_id[]" value="@{{modifier_id}}">

            <!-- Display Image -->
            <td><img src="@{{ service_image }}" alt="Item Image" width="50" height="50"></td>

            <!-- Display Item Name -->
            <td>@{{ service_name }}</td>

            <!-- Display Modifier Name -->
            <td>@{{ server_name }}</td>

            <!-- Display Cost -->
            <td>@{{ server_cost }}</td>

            <!-- Action: Remove Button -->
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
                var server_id = $('#server_id').val();
                var server_name = $('#server_id').find('option:selected').text();

                // Fetch cost and image based on selected service
                var service_cost = $('#menu_item_id').find('option:selected').data('cost');
                var service_image = $('#menu_item_id').find('option:selected').data('image');

                // Construct the image URL using the asset helper
                var image_url = service_image ? '{{ asset('') }}' + service_image : '{{ asset('images/default-image.jpg') }}';

                // Validation
                if (date == '' || service_id == '' || server_id == '') {
                    $.notify("All fields are required", {
                        globalPosition: 'top right',
                        className: 'error'
                    });
                    return false;
                }

                // Compile the template
                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data = {
                    date: date,
                    invoice_no: invoice_no,
                    service_id: service_id,
                    service_name: service_name,
                    server_id: server_id,
                    server_name: server_name,
                    server_cost: service_cost,
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

            // Calculate total amount price
            function totalAmountPrice() {
                var sum = 0;
                $(".delete_add_more_item").each(function() {
                    var cost = $(this).find("td:eq(3)").text(); // Cost is the 4th column
                    if (!isNaN(cost) && cost.length != 0) {
                        sum += parseFloat(cost);
                    }
                });
                $('#estimated_amount').val(sum);
            }
        });
    </script>
@endsection
