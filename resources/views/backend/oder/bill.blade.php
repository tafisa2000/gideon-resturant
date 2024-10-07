<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant and Bar Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        .receipt {
            max-width: 400px;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header h2 {
            margin: 5px 0;
            font-size: 24px;
            color: #333;
        }

        .receipt-header p {
            font-size: 12px;
            color: #666;
        }

        hr {
            border: none;
            border-top: 1px dashed #ddd;
            margin: 10px 0;
        }

        .receipt-body p {
            font-size: 14px;
            margin-bottom: 8px;
            color: #555;
        }

        table {
            width: 100%;
            font-size: 14px;
            margin-bottom: 15px;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        table th {
            background-color: #f8f8f8;
            font-weight: bold;
            color: #555;
        }

        .total {
            font-weight: bold;
            font-size: 16px;
            margin-top: 10px;
            display: flex;
            justify-content: space-between;
        }

        .receipt-footer {
            text-align: center;
            font-size: 13px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <div class="receipt-header">
            <h2>Bio Restaurant</h2>
            <p>Tabata, Block B, Plot No 937</p>
            <p>Phone: (555) 123-4567</p>
            <p>Date: {{ date('Y-m-d H:i:s') }}</p>
        </div>

        <hr>

        <div class="receipt-body">
            <p>
                <strong>Order:</strong> {{ $order->order_no }}<br>
                <strong>Table:</strong> {{ $order->table->name }}<br>
                <strong>Server:</strong> {{ $order->user->name }}
            </p>

            <hr>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderItem as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->menuItem->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->menuItem->price, 2) }}</td>
                            <td>{{ number_format($item->quantity * $item->menuItem->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr>

            <div class="total">
                <span>Total:</span>
                <span>Tsh {{ number_format($order->total_price, 2) }}/=</span>
            </div>
            <div class="total">
                <span>Tax (0%):</span>
                <span>Tsh 0/=</span>
            </div>
            <div class="total">
                <span>Grand Total:</span>
                <span>Tsh {{ number_format($order->total_price, 2) }}/=</span>
            </div>
        </div>

        <hr>

        <div class="receipt-footer">
            <p>Thank you for dining with us!</p>
            <p>Visit again soon.</p>
        </div>
    </div>
</body>

</html>
