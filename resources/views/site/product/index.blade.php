<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Product by Barcode</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-gray-100 via-white to-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-xl p-8 max-w-md w-full">
        <h1 class="text-2xl font-bold text-center text-gray-800 mb-6">
            Search Product by Barcode
        </h1>

        <input type="text" id="barcode-input"
            placeholder="Enter barcode..."
            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mb-4"
        >

        <div id="not-found" class="text-red-600 text-center font-semibold hidden mb-2">
            Product not found.
        </div>

        <div id="product-details" class="hidden text-center">
            <img id="product-image" class="mx-auto h-40 object-contain rounded mb-4" alt="Product Image" />
            <p class="mb-1"><strong>Name:</strong> <span id="product-name" class="text-blue-700"></span></p>
            <p class="mb-1"><strong>Price:</strong> <span id="product-price"></span> DZD</p>
            <p class="mb-1"><strong>Stock:</strong> <span id="product-stock"></span></p>
            <p class="mb-1"><strong>Barcode:</strong> <span id="product-codebar" class="font-mono text-sm"></span></p>
        </div>
    </div>

    {{-- JavaScript --}}
    <script>
        let timeout;
        document.getElementById('barcode-input').addEventListener('input', function () {
            clearTimeout(timeout);
            const barcode = this.value.trim();

            timeout = setTimeout(() => {
                if (barcode.length >= 3) {
                    fetch(`/product/barcode/${barcode}`)
                        .then(res => {
                            if (!res.ok) throw new Error('Not Found');
                            return res.json();
                        })
                        .then(data => {
                            document.getElementById('not-found').classList.add('hidden');
                            document.getElementById('product-details').classList.remove('hidden');
                            document.getElementById('product-name').textContent = data.name;
                            document.getElementById('product-price').textContent = data.price;
                            document.getElementById('product-stock').textContent = data.stock;
                            document.getElementById('product-codebar').textContent = data.codebar;
                            document.getElementById('product-image').src = data.image;
                        })
                        .catch(() => {
                            document.getElementById('product-details').classList.add('hidden');
                            document.getElementById('not-found').classList.remove('hidden');
                        });
                }
            }, 400);
        });
    </script>
</body>
</html>
