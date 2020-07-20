<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('author', 'editor')->get();
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('backend.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'name' => 'required|min:3|max:60',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:6144'

        ]);

        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $ext = $request->file('image')->getClientOriginalExtension();
            $name = basename($name, '.' . $ext);
            $product = Product::create([
                'name' => request('name'),
                'description' => request('description'),
                'price' => request('price'),
                'category' => request('category'),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'image' => $name
            ]);
            $name = $name . '.jpg';

            $img = \Image::make($request->file('image'))->resize(300, 200)->save(public_path('/uploads/products/' . $name));
            /**Dodati jos jednu velicinu 640x videti na Pixa bay. Ispred ove iznad dodati thumbnail */
        }
        return redirect()->route('product.index')->with('status', 'Product added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::latest()->get();
        return view('backend.product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        request()->validate([
            'name' => 'required|min:3|max:60',
            'description' => 'required',
            'price' => 'required|numeric',
            'category' => 'required|exists:categories,id',
            'image' => 'image|mimes:jpeg,png,jpg|max:6144'

        ]);

        if ($request->hasFile('image')) {
            $name = $request->file('image')->getClientOriginalName();
            $ext = $request->file('image')->getClientOriginalExtension();
            $name = basename($name, '.' . $ext);
            $products = Product::get();
            $count = 0;
            foreach ($products as $base_product) {
                if ($base_product->image == $product->image) {
                    $count++;
                }
            }
            if ($count == 1) {
                $old_path = public_path('/uploads/products/' . $product->image . '.jpg');
                File::delete($old_path);
            }


            $product->update([
                'name' => request('name'),
                'description' => request('description'),
                'price' => request('price'),
                'category' => request('category'),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                'image' => $name
            ]);
            $name = $name . '.jpg';

            $img = \Image::make($request->file('image'))->resize(300, 200)->save(public_path('/uploads/products/' . $name));
        } else {
            $product->update([
                'name' => request('name'),
                'description' => request('description'),
                'price' => request('price'),
                'category' => request('category'),
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
            ]);
        }
        return redirect()->route('product.index')->with('status', 'Product updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $path = public_path('/uploads/products/' . $product->image . '.jpg');
        $products = Product::latest()->get();
        $count = 0;

        foreach ($products as  $product_base) {

            if ($product_base->image == $product->image) {
                $count++;
            }
        }
        if (file_exists($path) && $count == 1) {
            File::delete($path);
        }
        $product->delete();


        return redirect()->route('product.index')->with('status', 'Product deleted!');
    }
}
