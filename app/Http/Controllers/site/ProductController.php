<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        return view('site.product.index');
    }

    public function barcode($codebar)
    {
        $product = Product::where('codebar', $codebar)->first();
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        return response()->json([
            'name' => $product->name,
            'price' => $product->price,
            'stock' => $product->stock,
            'image' => asset('storage/' . $product->image),
            'codebar' => $product->codebar,
        ]);
    }
}
