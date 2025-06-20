<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;

use App\Models\OrderItem;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // جلب التصنيفات الخاصة بالمستخدم مع عدد المنتجات
        $categorys = Category::withCount('products')
            ->where('user_id', Auth::id())
            ->paginate(10);

        // إضافة الكمية المباعة لكل تصنيف
        foreach ($categorys as $category) {
            $category->total_quantity_sold = OrderItem::whereHas('product', function ($query) use ($category) {
                $query->where('category_id', $category->id);
            })->sum('quantity');
        }

        return view('admin.category.index', compact('categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        Category::create([
            'name' => $request->name,
            'status' => $request->status,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('categorys.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'tag' => 'nullable|string|max:255', // حسب وجوده في قاعدة البيانات
            'status' => 'nullable|string|max:255',
       ]);

        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->tag = $request->input('tag'); // فقط إذا كان عندك هذا الحقل
        $category->status = $request->input('status'); // فقط إذا كان عندك هذا الحقل
        $category->save();

        return redirect()->route('categorys.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->route('categorys.index')->with('success', 'Category deleted successfully.');
    }

}

/*
GET 	    /categorys		            index               categorys.index
GET	        /categorys/create	        create	            categorys.create
POST	    /categorys		            store               categorys.store
GET	        /categorys/{id}	            show	            categorys.show
GET	        /categorys/{id}/edit	    edit    	        categorys.edit
PUT/PATCH	/categorys/{id}	            update	            categorys.update
DELETE	    /categorys/{id}	            destroy	            categorys.destroy
*/
