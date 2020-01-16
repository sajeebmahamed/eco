<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Contact;
use Mail;
use App\Mail\ContactMessage;
class FrontendController extends Controller
{
    function index()
    {
      $products = Product::all();
      $categories = Category::all();
      return view('welcome', compact('products', 'categories'));
    }
    function productdetails($product_id)
    {
      $singleproductinfo = Product::find($product_id);
      $related_products = Product::where('id', '!=', $product_id)->where('category_id', $singleproductinfo->category_id)->get();
      return view('frontend.productdetails', compact('singleproductinfo', 'related_products'));
    }
    function categorywiseproduct($category_id)
    {
      $products = Product::where('category_id', $category_id)->get();
        return view('frontend/categorywiseproduct', compact('products'));
    }
    function contact()
    {
      return view('frontend.contact');
    }
    function contactinsert(Request $request)
    {
      // Contact::insert([
      //   'first_name' => $request->first_name,
      //   'last_name' => $request -> last_name,
      //   'subject' => $request -> subject,
      //   'message' => $request -> message,
      // ]);

      Contact::insert($request->except('_token'));
      $first_name = $request->first_name;
      $last_name = $request ->last_name;
      $message = $request->message;
      Mail::to('sajeebahamed6@gmail.com')->send(new ContactMessage($first_name,$last_name,$message));
      return redirect('/contact');
    }

}
