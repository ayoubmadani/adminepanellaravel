<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice #ORD-{{ $order->id_order_items }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9fafb;
            color: #111827;
            padding: 2rem;
        }

        .invoice-box {
            max-width: 900px;
            margin: auto;
            padding: 2rem;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .logo {
            max-width: 140px;
            margin-bottom: 1rem;
        }

        h2 {
            margin-top: 0;
            font-size: 1.25rem;
            color: #1f2937;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }

        table th, table td {
            text-align: left;
            padding: 12px;
            font-size: 14px;
            border-bottom: 1px solid #e5e7eb;
        }

        table th {
            background-color: #f3f4f6;
            color: #374151;
            font-weight: 600;
        }

        .total {
            font-weight: bold;
            color: #111827;
            border-top: 2px solid #d1d5db;
        }

        .text-right {
            text-align: right;
        }

        .no-print {
            margin-top: 2rem;
            text-align: center;
        }

        @media print {
            .no-print {
                display: none !important;
            }

            body {
                background: white;
                color: black;
                padding: 0;
            }

            .invoice-box {
                box-shadow: none;
                margin: 0;
                padding: 0;
                border-radius: 0;
            }
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table>
            <tr>
                <td>
                    <img src="{{ asset('logo.png') }}" alt="Logo" class="logo">
                </td>
                <td class="text-right">
                    <strong>Invoice #: </strong>ORD-{{ $order->id_order_items }}<br>
                    <strong>Date: </strong>{{ $order->created_at->format('Y-m-d') }}<br>
                    <strong>Status: </strong>{{ ucfirst($order->status) }}
                </td>
            </tr>
        </table>

        <table>
            <tr>
                <td>
                    <h2>Customer Info</h2>
                    <p>
                        {{ $order->customer->name }}<br>
                        {{ $order->customer->phone }}<br>
                        {{ $order->customer->address }}
                    </p>
                </td>
                <td class="text-right">
                    <h2>Sold by</h2>
                    <p>{{ $order->user->name ?? 'Admin' }}</p>
                </td>
            </tr>
        </table>

        <h2>Order Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price (DZD)</th>
                    <th>Qty</th>
                    <th>Subtotal (DZD)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'N/A' }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                @endforeach
                <tr class="total">
                    <td colspan="3" class="text-right">Total</td>
                    <td>{{ number_format($order->amount, 2) }} DZD</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 2rem; color: #6b7280; font-size: 14px; text-align: center;">
            Thank you for your purchase!
        </div>
    </div>

    <div class="no-print">
        <button onclick="window.print()"
            style="
                background-color: #22c55e;
                color: white;
                padding: 12px 24px;
                font-size: 16px;
                border: none;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                display: inline-flex;
                align-items: center;
                gap: 8px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            "
            onmouseover="this.style.backgroundColor='#16a34a'"
            onmouseout="this.style.backgroundColor='#22c55e'">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M6 9V2h12v7M6 18h12v4H6v-4zM6 14h12a2 2 0 002-2v-2a2 2 0 00-2-2H6a2 2 0 00-2 2v2a2 2 0 002 2z" />
            </svg>
            Print Invoice
        </button>
    </div>
</body>

</html>
