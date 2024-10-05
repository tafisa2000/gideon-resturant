@extends('admin_dashboard')

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Invoice</h4><br><br>

                            <div class="row">
                                <div class="col-md-1">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Inv No</label>
                                        <input class="form-control example-date-input" name="sale_no" type="text"
                                            value="{{ $sale_no }}" id="invoice_no" readonly
                                            style="background-color:#ddd">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Date</label>
                                        <input class="form-control example-date-input" value="{{ $date }}"
                                            name="date" type="date" id="date">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Menu</label>
                                        <select name="service_id" id="service_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">Select Menu</option>
                                            @foreach ($menu_item as $item)
                                                <option value="{{ $item->id }}" data-cost="{{ $item->price }}"
                                                    data-image="{{ $item->image_url }}">
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Modifier</label>
                                        <select name="server_id" id="server_id" class="form-select select2"
                                            aria-label="Default select example">
                                            <option selected="">Select Modifier</option>
                                            @foreach ($modifier as $mod)
                                                <option value="{{ $mod->id }}">{{ $mod->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label" style="margin-top:43px;"></label>
                                        <i class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore">
                                            Add More
                                        </i>
                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div> <!-- end card-body -->

                        <div class="card-body">
                            <form method="post" action="">
                                {{-- {{ route('sale.store') }} --}}
                                @csrf
                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                    <thead>
                                        <tr>
                                            <th width="15%">Image</th>
                                            <th width="15%">Name</th>
                                            <th width="15%">Modifier</th>
                                            <th width="15%">Cost</th>
                                            <th width="7%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addRow" class="addRow"></tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="4">Total Cost</td>
                                            <td>
                                                <input type="text" name="cost" value="0" id="estimated_amount"
                                                    class="form-control estimated_amount" readonly
                                                    style="background-color: #ddd;">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table><br>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea name="description" class="form-control" id="description" placeholder="Write Description Here"></textarea>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="">Server</label>
                                        <select name="customer_id" id="customer_id" class="form-select select2">
                                            <option value="">Select Server</option>
                                            @foreach ($server as $cust)
                                                <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                                            @endforeach
                                        </select><br>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="">Table</label>
                                        <select name="table_id" id="table_id" class="form-select select2">
                                            <option value="">Select Table</option>
                                            @foreach ($table as $table)
                                                <option value="{{ $table->id }}">{{ $table->name }}</option>
                                            @endforeach
                                        </select><br>
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="storeButton">Invoice Store</button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <!-- Handlebars Template -->
    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item" id="delete_add_more_item">
            <input type="hidden" name="date[]" value="@{{date}}">
            <input type="hidden" name="sale_no[]" value="@{{invoice_no}}">
            <input type="hidden" name="service_id[]" value="@{{service_id}}">
            <input type="hidden" name="server_id[]" value="@{{server_id}}">
            
            <!-- Display Image -->
            <td><img src="@{{ service_image }}" alt="Item Image" width="50" height="50"></td>
            
            <!-- Display Item Name -->
            <td>@{{ service_name }}</td>
            
            <!-- Display Modifier Name -->
            <td>@{{ server_name }}</td>
            
            <!-- Display Cost -->
            <td>@{{ server_cost }}</td>
            
            <!-- Action: Remove Button -->
            <td><i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i></td>
        </tr>
    </script>

    <!-- JavaScript Logic -->
    <script type="text/javascript">
        $(document).ready(function() {
            // Add event more
            $(document).on("click", ".addeventmore", function() {
                var date = $('#date').val();
                var invoice_no = $('#invoice_no').val();
                var service_id = $('#service_id').val();
                var service_name = $('#service_id').find('option:selected').text();
                var server_id = $('#server_id').val();
                var server_name = $('#server_id').find('option:selected').text();

                // Fetch cost and image based on selected service
                var service_cost = $('#service_id').find('option:selected').data('cost');
                var service_image = $('#service_id').find('option:selected').data('image');

                // Correct the image path if necessary
                var image_url = service_image ? '{{ asset('') }}' + service_image : '{{ asset('default-image.jpg') }}';

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
