<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('products', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        if (Auth::guest()){
            return redirect()->back();
        }

        return view('add');
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
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:25000',
        ]);

        $product = Product::create([
            'product_name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'user_id' => Auth::id(),
        ]);

        
        if ($request->image != null){
            $img_name = time() . '-' . $request->name . '.' . $request->image->extension();
            $product->update(['image_name' => $img_name]);
            $request->image->move(public_path('storage/product_images'), $img_name);
        }

        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $user = User::find($product->user_id);

        return view('product_details', [
            'product' => $product,
            'user' => $user
        ]);
    }

    public function search(Request $request, $string)
    {
        $products = Product::where('product_name', 'like', '%' . $string . '%')->get();

        return view('products', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::guest()){
            return redirect()->back();
        }
        $product = Product::find($id);
        if (Auth::id() != $product->user_id){
            return redirect()->back();
        }
        return view('edit', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'nullable|mimes:jpg,png,jpeg|max:25000',
        ]);

        if ($request->image != null){
            $product = Product::find($id);
            $old_img = $product->image_name;
            if ($old_img != "default.png"){
                Storage::delete("public/product_images/" . $old_img);
            }
            $img_name = time() . '-' . $request->name . '.' . $request->image->extension();
            $product = Product::where('id', $id)->update(['image_name' => $img_name]);
            $request->image->move(public_path('storage/product_images'), $img_name);
        }

        $product = Product::where('id', $id)->update([
            'product_name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'user_id' => Auth::id(),
        ]);

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);


        $old_img = $product->image_name;
        if ($old_img != "default.png"){
            Storage::delete("public/product_images/" . $old_img);
        }
        $product->delete();

        return redirect('/products');
    }
}
