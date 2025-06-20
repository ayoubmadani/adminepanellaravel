<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Category;
use App\Models\Discount;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = Discount::where('user_id', auth()->id())->paginate(10); // ✅ paginate وليس all()
        return view('admin.discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('admin.discount.create');
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
            'name' => 'required|string',
            'discount' => 'required|string',
            'description' => 'nullable|string',
            'dateBegin' => 'required|date',
            'dateFin' => 'required|date',
            'status' => 'required|string',
        ]);

        Discount::create([
            'name' => $request->name,
            'discount' => $request->discount,
            'description' => $request->description,
            'datebegin' => $request->dateBegin,
            'datefin' => $request->dateFin,
            'status' => $request->status === 'active' ? 1 : 0,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('discounts.index')->with('success', 'Discount added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        return view('admin.discounts.show', compact('discount'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        return view('admin.discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discount $discount)
    {
        $discount->update([
            'name' => $request->name,
            'discount' => $request->discount,
            'description' => $request->description,
            'datebegin' => $request->dateBegin,
            'datefin' => $request->dateFin,
            'status' => $request->status,
        ]);

        return redirect()->route('discounts.index')->with('success', 'Discount updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discounts.index')->with('success', 'Discount deleted successfully.');
    }
}


/*
GET 	    /discounts		            index               discounts.index
GET	        /discounts/create	        create	            discounts.create
POST	    /discounts		            store               discounts.store
GET	        /discounts/{id}	            show	            discounts.show
GET	        /discounts/{id}/edit	    edit	            discounts.edit
PUT/PATCH	/discounts/{id}	            update	            discounts.update
DELETE	    /discounts/{id}	            destroy	            discounts.destroy
*/
