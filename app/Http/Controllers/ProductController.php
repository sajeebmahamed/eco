<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Image;

class ProductController extends Controller
{
    function addproduct()
    {
      $all_products = Product::paginate(3);
      $deleted_products = Product::onlyTrashed()->get();
      $categories = Category::all();
      return view('Product.addproductview', compact('all_products','deleted_products', 'categories'));
      //return view('Product.addproductview');
    }
    function addproductinsert(Request $request)
    {
      $request-> validate([
        'category_id' => 'required',
        'product_name' => 'required',
        'product_des' => 'required',
        'product_price' => 'required|numeric',
        'product_quantity' => 'required|numeric',
        'alert_quantity' => 'required|numeric',
      ]);
      $last_inserted_id = Product::insertGetId([
        'category_id' => $request->category_id,
        'product_name' => $request->product_name,
        'product_des' => $request->product_des,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'alert_quantity' => $request -> alert_quantity,
        ]);
      if($request->hasFile('product_image'))
      {
        $photo_to_upload = $request -> product_image;
        $filename = $last_inserted_id.".".$photo_to_upload->getClientOriginalExtension();
        Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));
        Product::find($last_inserted_id)-> update([
          'product_image' => $filename
        ]);

      }
      return back()->with('status', 'Product Inserted Successful');
    }
    function deleteproduct($delete_product)
    {
      Product::where('id', '=', $delete_product)->delete();
      return back()->with('deletestatus', 'Product has been deleted');
    }
    function editproduct($product_id)
    {
      $single_product_info = Product::findOrFail($product_id);
      return view('Product.editproduct', compact('single_product_info'));
    }
      function editproductinsert(Request $request)
      {
        if($request->hasFile('product_image'))
        {
          if (Product::find($request->product_id)->product_image == 'noimgavailable.jpg') {
            $photo_to_upload = $request -> product_image;
            $filename = $request->product_id.".".$photo_to_upload->getClientOriginalExtension();
            Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));
            Product::find($request->product_id)-> update([
              'product_image' => $filename
            ]);
          }
          else {
            $delete_this_file = Product::find($request->product_id)->product_image;
            unlink(base_path('public/uploads/product_photos/'. $delete_this_file));
            $photo_to_upload = $request -> product_image;
            $filename = $request->product_id.".".$photo_to_upload->getClientOriginalExtension();
            Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));
            Product::find($request->product_id)-> update([
              'product_image' => $filename
            ]);
          }
        }
        // else {
        //   echo "nai";
        // }
          Product::find($request -> product_id)->update([
          'product_name' => $request->product_name,
          'product_des' => $request->product_des,
          'product_price' => $request->product_price,
          'product_quantity' => $request->product_quantity,
       ]);
       return back()->with('updatestatus', 'Product Updated Successful');
    }
    function restoreproduct($product_id)
    {
      Product::onlyTrashed()->where('id', '=', $product_id)->restore();
      return back();
    }
    function forcedeleteproduct($product_id)
    {
      // echo $product_id;
      $delete_this_file = Product::onlyTrashed()->find($product_id)->product_image;
      unlink(base_path('public/uploads/product_photos/'. $delete_this_file));
      Product::onlyTrashed()->find($product_id)->forceDelete();
      return back();
    }
}
