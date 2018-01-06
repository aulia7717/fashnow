<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\Cart;

class ProductsController extends Controller
{
    public function index(){
      $products = Inventory::all();
      return view('post.index',['products'=>$products]);//products paling kiri merupakan nama file blade.php
     }

    public function showDetail($id)
    {
    $product = Inventory::find($id);
    if (request('quantity') >= 0 && request()->has('quantity') && $product->stock - request('quantity') >= 0){
      $quantity = request('quantity');
      $user_id = request('user_id');

      $cart = Cart::firstOrNew([
        'user_id' => $user_id,
        'inventory_id' => $id
      ]);
      $cart->quantity += request('quantity');
      $cart->save();
      $product->stock -= request('quantity');
      $product->save();
    }
    $product = Inventory::find($id);
      return view('post.product_details',['product'=>$product]);
    }

    public function calculate($id)
    {
      // dd(request());
      //
      //   $quantity = count($product->id);
      //    $product->quantity -= $quantity;
      // return view('post.product_details',['product'=>$product]);
    }

    public function showPerCategories()
    {
      // dd(request('category'));
      $category = request('category');
      $products = Inventory::where('category',$category)->get();
      // dd($products);
      return view('post.products',['products' => $products]);
    }

}
