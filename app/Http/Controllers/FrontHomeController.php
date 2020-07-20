<?php

namespace App\Http\Controllers;

use App\Product;
use App\Rate;
use App\Order;
use App\Order_items;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FrontHomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(9)->get();

        return view('frontend.index', compact('products'));
    }
    public function addToCart(Product $product)
    {
        //session()->pull('cart');
        $cart = $product->id;

        session()->push('cart', $cart);


        return redirect()->back()->refresh()->with('status', 'You have added product to shopping cart');
    }
    public function removeFromCart(Product $product)
    {
        $cart = (session()->get('cart'));
        (session()->pull('cart'));

        unset($cart[array_search($product->id, array_unique($cart))]);


        session()->put('cart', $cart);


        return redirect()->back()->refresh()->with('status', 'You have removed product from shopping cart');
    }
    public function cart()
    {
        if (session()->get('cart') != null) {
            $cart = session()->get('cart');
            $quanitity = array_count_values($cart);
            $ids = array_unique($cart);
            $products = Product::whereIn('id', $ids)->latest()->get();
            $rates = Rate::where('name', 'USD')->first();
            $rate = $rates->rate;

            return view('frontend.cart', compact('products', 'ids', 'quanitity', 'rate'));
        } else {
            $rate = 0;
            return view('frontend.cart', compact('rate'));
        }
    }
    public function checkout()
    {
        if (session()->get('cart', '') == null) {
            return redirect()->route('front.home');
        } else {
            $cart = session()->get('cart');
            $quanitity = array_count_values($cart);
            $ids = array_unique($cart);
            $products = Product::whereIn('id', $ids)->latest()->get();
            $rates = Rate::where('name', 'USD')->first();
            $rate = $rates->rate;
            return view('frontend.checkout', compact('products', 'ids', 'quanitity', 'rate'));
        }
    }
    public function saveorder(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'address' => 'required',
            'email' => 'required'

        ]);

        $cart = session()->get('cart');
        $quanitity = array_count_values($cart);
        $ids = array_unique($cart);
        $products = Product::whereIn('id', $ids)->latest()->get();
        $total = 0;
        foreach ($products as $product) {
            foreach ($ids as $key => $id) {
                if ($product->id == $id) {
                    $total = $product->price * $quanitity[$id];
                }
            }
        }
        $total = $product->price * $quanitity[$id];
        if(isset(Auth()->user()->id)){

        $order = Order::create([
            'name' => request('name'),
            'address' => request('address'),
            'email' => request('email'),
            'price' => $total,
            'user' => Auth()->user()->id

        ]);
        }
        else{
            $order = Order::create([
                'name' => request('name'),
                'address' => request('address'),
                'email' => request('email'),
                'price' => $total,
                'user' => null

            ]);
        }



        $orderItems = [];
        foreach ($products as $product) {
            foreach ($ids as $key => $id) {
                if ($product->id == $id) {

                    $orderItems[] = [
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'quantity' => $quanitity[$id],
                        'price'=>$product->price,
                        'created_at'=>Carbon::now()->toDateTimeString(),
                        'updated_at'=>Carbon::now()->toDateTimeString(),

                    ];
                }
            }
        }
            Order_items::insert($orderItems);
            session()->forget('cart');
return redirect()->route('front.home')->with('ordercomplete','Thank you for your order');
    }
    public function history()
    {
            $products=DB::table('orders')->where('orders.user',Auth()->user()->id)->
            join('order_items','order_items.id','=','orders.id')->
            join('products', 'products.id', '=', 'product_id')
            ->select('products.id','products.image','products.name','description','order_items.price','order_items.quantity')            ->get();
            $rates = Rate::where('name', 'USD')->first();
            $products->collect($products);
            $rate = $rates->rate;
            return view('frontend.history', compact('products','rate'));
    }
}
