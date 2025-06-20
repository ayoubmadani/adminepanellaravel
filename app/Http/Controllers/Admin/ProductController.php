<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;

use Barryvdh\DomPDF\Facade\Pdf;
use Milon\Barcode\Facades\DNS1D;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::query()->with('category')->where('user_id',Auth::id());

        $query->where('user_id', auth()->id()); // تحديد المستخدم أولاً

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('codebar', 'like', '%' . $request->search . '%');
            });
        }


        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->paginate(10);
        $categories = Category::all(); // For select options

        return view('admin.product.index', compact('products', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $discounts = Discount::all()->where('user_id',Auth::id());
        $categories = Category::all()->where('user_id',Auth::id());
        return view('admin.product.create', compact('categories','discounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'buyprice' => 'required|numeric',
            'stock' => 'required|integer',
            'status' => 'required|in:0,1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'codebar' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);


        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName(); // optional
            $extension = $request->file('image')->getClientOriginalExtension();
            $filename = 'product_' . time() . '.' . $extension;

            $imagePath = $request->file('image')->storeAs('products', $filename, 'public');
        }

        Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'price' => $request->price,
            'buyprice' => $request->buyprice,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'discount_id' => $request->discount_id,
            'status' => $request->status,
            'image' => $imagePath ?? '', // ✅ هنا تم تصحيح الاسم
            'description' => $request->description,
            'codebar' => $request->codebar,
            'tags' => $request->tags,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with(['category', 'discount'])->find($id);

        if (!$product) {
            return redirect()->route('products.index')  ->with('error', 'Product not found.');
        }

        return view('admin.product.show', compact('product'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $discounts = Discount::all();

        return view('admin.product.edit', compact('product', 'categories', 'discounts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'buyprice' => 'nullable|numeric',
            'stock' => 'required|integer',
            'status' => 'required|in:0,1', // 0=Active, 1=Inactive
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable|string',
            'codebar' => 'nullable|string|max:255',
            'tags' => 'nullable|string|max:255',
        ]);

        // إذا تم رفع صورة جديدة، خزّنها واحذف القديمة إن وُجدت
        if ($request->hasFile('image')) {
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        // تحديث باقي الحقول
        $product->name = $request->name;
        $product->brand = $request->brand;
        $product->price = $request->price;
        $product->buyprice = $request->buyprice;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        $product->discount_id = $request->discount_id;
        $product->status = $request->status;
        $product->description = $request->description;
        $product->codebar = $request->codebar;
        $product->tags = $request->tags;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // حذف الصورة من التخزين إذا وُجدت
        if ($product->image && \Storage::exists('public/' . $product->image)) {
            \Storage::delete('public/' . $product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }



    public function invoice()
    {
        $products = Product::where('user_id', auth()->id())->get();
        $pdf = PDF::loadView('admin.product.invoice', compact('products'));
        return $pdf->stream('products_invoice.pdf');
    }
}


/*
GET 	    /products		            index               products.index
GET	        /products/create	        create	            products.create
POST	    /products		            store               products.store
GET	        /products/{id}	            show	            products.show
GET	        /products/{id}/edit	        edit	            products.edit
PUT/PATCH	/products/{id}	            update	            products.update
DELETE	    /products/{id}	            destroy	            products.destroy
*/
