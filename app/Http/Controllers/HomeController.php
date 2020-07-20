<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Rate;
use App\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rules\Exists;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::with('editor')->latest()->limit(5)->get();
        $products = Product::with('editor')->latest()->limit(5)->get();
        $rate = Rate::first();
        $users = User::latest()->limit(5)->get();
        if (empty($rate)) {
            $rate = 'Unknown';
        } else {
            $rate = $rate->rate;
        }
        return view('backend/home', compact('categories', 'products', 'rate', 'users'));
    }
    public function rates()
    {
        $response = Http::get('https://api.exchangeratesapi.io/latest');
        $response = json_decode($response->getBody());
        if (Rate::count() == 0) {
            $rate = Rate::create([
                'name' => 'USD',
                'rate' => $response->rates->USD,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id

            ]);
        } else {
            $rate = Rate::where('name', 'USD')->update([
                'name' => 'USD',
                'rate' => $response->rates->USD,
                'created_by' => auth()->user()->id,
                'updated_by' => auth()->user()->id,
            ]);
        }
        return redirect()->route('home')->with('status', 'Rate added!');
    }



    public function setadmin(User $user)
    {
        $n_user = User::where('role', 1)->count();
        if (auth()->user()->role == 1) {
            if ($user->role == 0) {
                $user->update([
                    'role' => '1'
                ]);
                return redirect()->route('home')->with('status', 'User added as admin!');
            } elseif ($n_user > 1 && $user->role == 1) {
                $user->update([
                    'role' => '0'
                ]);
                return redirect()->route('home')->with('status', 'User removed as admin!');
            } else {
                return redirect()->back()->withErrors('Only this user is admin!');
            }
        }
    }
}
