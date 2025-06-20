@extends('admin.layout.main')

@section('content')

<script defer>
    function calculateSubtotal(row) {
        const price = parseFloat(row.querySelector('.price-input').value) || 0;
        const quantity = parseInt(row.querySelector('.quantity-input').value) || 0;
        const subtotal = price * quantity;
        row.querySelector('.subtotal-display').innerText = subtotal.toFixed(2);
        calculateTotal();
    }

    function calculateTotal() {
        let total = 0;
        document.querySelectorAll('.subtotal-display').forEach(div => {
            total += parseFloat(div.innerText) || 0;
        });
        document.getElementById('total-amount').innerText = total.toFixed(2);
    }

    function updateIndexes() {
        document.querySelectorAll('.item-row').forEach((row, index) => {
            row.dataset.index = index;
            row.querySelector('.product-id').name = `products[${index}][product_id]`;
            row.querySelector('.price-input').name = `products[${index}][price]`;
            row.querySelector('.quantity-input').name = `products[${index}][quantity]`;
        });
    }

    document.addEventListener('input', function (e) {
        if (e.target.matches('.barcode-input')) {
            const row = e.target.closest('.item-row');
            const barcode = e.target.value.trim();

            if (barcode.length >= 2) {
                fetch(`/product/barcode/${barcode}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.error) {
                            row.querySelector('.product-id').value = '';
                            row.querySelector('.product-name').value = '';
                            row.querySelector('.price-input').value = '';
                            row.querySelector('.subtotal-display').innerText = '0.00';
                            return;
                        }

                        row.querySelector('.product-id').value = data.id;
                        row.querySelector('.product-name').value = data.name;
                        row.querySelector('.price-input').value = data.price;
                        calculateSubtotal(row);
                    });
            }
        }

        if (e.target.matches('.quantity-input')) {
            const row = e.target.closest('.item-row');
            calculateSubtotal(row);
        }
    });

    document.addEventListener('click', function (e) {
        if (e.target.matches('.delete-row')) {
            const rows = document.querySelectorAll('.item-row');
            if (rows.length > 1) {
                e.target.closest('.item-row').remove();
                calculateTotal();
                updateIndexes();
            } else {
                alert('At least one item row is required.');
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('add-item').addEventListener('click', function () {
            const container = document.getElementById('items-container');
            const firstRow = container.querySelector('.item-row');
            const newRow = firstRow.cloneNode(true);

            newRow.querySelectorAll('input').forEach(input => {
                if (input.classList.contains('quantity-input')) {
                    input.value = 1;
                } else {
                    input.value = '';
                }
            });

            newRow.querySelector('.subtotal-display').innerText = '0.00';
            container.appendChild(newRow);
            updateIndexes();
        });

        updateIndexes();
        calculateTotal();
    });
</script>

<style>
    .subtotal-display {
        padding: 0.5rem;
        background-color: #f3f4f6;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        text-align: right;
    }
</style>

<h1 class="text-2xl font-bold text-gray-800 mb-6">Create New Order</h1>

<form action="{{ route('orders.store') }}" method="POST">
    @csrf

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white p-4 rounded-lg border">
            <h2 class="font-semibold text-lg mb-4">Client Info</h2>
            <div class="space-y-2">
                <div><strong>Name:</strong> {{ $defaultName }}</div>
                <div><strong>Phone:</strong> {{ $defaultPhone }}</div>
                <div><strong>Wilaya:</strong> {{ $defaultWilaya }}</div>
                <input type="hidden" name="customer_id" value="{{ $customerId }}">
            </div>
        </div>
    </div>

    <div id="items-container">
        <div class="item-row grid grid-cols-1 md:grid-cols-6 gap-4 mb-4" data-index="0">
            <div>
                <label class="text-sm text-gray-700">Barcode</label>
                <input type="text" class="barcode-input w-full px-3 py-2 border rounded-md" placeholder="Enter barcode">
                <input type="hidden" class="product-id" name="products[0][product_id]">
            </div>
            <div>
                <label class="text-sm text-gray-700">Product</label>
                <input type="text" class="product-name w-full px-3 py-2 border rounded-md bg-gray-100" readonly>
            </div>
            <div>
                <label class="text-sm text-gray-700">Price</label>
                <input type="text" class="price-input w-full px-3 py-2 border rounded-md bg-gray-100" name="products[0][price]" readonly>
            </div>
            <div>
                <label class="text-sm text-gray-700">Quantity</label>
                <input type="number" class="quantity-input w-full px-3 py-2 border rounded-md" name="products[0][quantity]" value="1" min="1">
            </div>
            <div>
                <label class="text-sm text-gray-700">Subtotal</label>
                <div class="subtotal-display">0.00</div>
            </div>
            <div class="flex items-end">
                <button type="button" class="delete-row px-3 py-2 bg-red-600 text-white rounded">Delete</button>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <button type="button" id="add-item" class="px-4 py-2 bg-blue-600 text-white rounded">Add Item</button>
    </div>

    <div class="text-right mt-6 text-lg font-semibold">
        Total Amount: <span id="total-amount">0.00</span> DZD
    </div>

    <div class="mt-6 text-right">
        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Submit Order</button>
    </div>
</form>

@endsection
