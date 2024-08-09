<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .invoice-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            margin: 0;
            color: #333;
        }

        .invoice-header img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .invoice-details,
        .invoice-footer {
            margin-bottom: 30px;
        }

        .invoice-details h3 {
            margin: 5px 0;
            color: #555;
        }

        .invoice-info {
            display: flex;
            justify-content: space-between;
        }

        .invoice-info div {
            width: 48%;
        }

        .invoice-product table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .invoice-product table,
        .invoice-product th,
        .invoice-product td {
            border: 1px solid #ddd;
        }

        .invoice-product th,
        .invoice-product td {
            padding: 10px;
            text-align: left;
        }

        .invoice-product img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }

        .invoice-footer {
            text-align: center;
            font-size: 12px;
            color: #888;
        }

    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <img src="path_to_your_logo.png" alt="Company Logo">
            <h1>Invoice</h1>
        </div>
        <div class="invoice-info">
            <div>
                <h3>Customer Name: {{ $order->name }}</h3>
                <h3>Customer Address: {{ $order->rec_address }}</h3>
                <h3>Phone: {{ $order->phone }}</h3>
            </div>
            <div>
                <h3>Invoice Number: {{ $order->invoice_number }}</h3>
                <h3>Invoice Date: {{ $order->date }}</h3>
                <h3>Due Date: {{ $order->due_date }}</h3>
            </div>
        </div>
        <div class="invoice-product">
            <table>
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Price</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $order->book->title }}</td>
                        <td>${{ $order->book->price }}</td>
                        <td><img src="/books/{{ $order->book->image }}" alt="Product Image"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice-footer">
            <p>Thank you for your purchase!</p>
            <p>Company Name | Company Address | Company Phone</p>
        </div>
    </div>
</body>
</html>
