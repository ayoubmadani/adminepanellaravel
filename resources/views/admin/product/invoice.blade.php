<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Invoice</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #f5f5f5;
        }

        .codebar {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .nbcodebar {
            margin-top: 4px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h2>Product List with Barcode</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Barcode</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        <div class="codebar">
                            {!! DNS1D::getBarcodeHTML($product->codebar, 'C128', 2, 50) !!}
                            <div class="nbcodebar">{{ $product->codebar }}</div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
