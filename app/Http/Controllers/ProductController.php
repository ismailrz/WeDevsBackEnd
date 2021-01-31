<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Validator;
class ProductController extends Controller
{
    public function get_products()
    {
        $products = Product::all();
        return response()->json(['products' => $products]);
    } 
    
    public function update_product(Request $request)
    {
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }

        $imageName = '';
        if(!empty($request->image)){
            $base64_image = $request->image; // your base64 encoded     
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = time().'.'.'png';   
             Storage::disk('local')->put('public/images/'.$imageName, base64_decode($file_data));
        }
        $product = Product::find($request->productId);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $imageName;
        if($product->update()){
            $result['response'] = 'success';
            $result['message'] = 'New Product update successfull';
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry! product update failed! Try again';
        }
         return response()->json($result);
    }
    public function create_product(Request $request)
    {
        $result['response'] = 'success';
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            $result['response'] = 'error';
            $result['message'] = $validator->errors();
            return response()->json($result);
        }

        $imageName = '';
        if(!empty($request->image)){
            $base64_image = $request->image; // your base64 encoded     
            @list($type, $file_data) = explode(';', $base64_image);
            @list(, $file_data) = explode(',', $file_data); 
            $imageName = time().'.'.'png';   
             Storage::disk('local')->put('public/images/'.$imageName, base64_decode($file_data));
        }
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->image = $imageName;
        if($product->save()){
            $result['response'] = 'success';
            $result['message'] = 'New Product added successfull';
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry! product create failed! Try again';
        }
         return response()->json($result);
    }
   
    public function delete_product($productId)
    {
        $product = Product::find($productId);
        if($product->delete()){
            $result['response'] = 'success';
            $result['message'] = 'Product delete successful';
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry! Product delete failed!';
        }
         return response()->json($result);
    }
    public function get_edit_product($productId)
    {
        $editProduct = Product::find($productId);
        if($editProduct){
            if($editProduct->image){
                $image = file_get_contents("./storage/images/".$editProduct->image);
                $encoded = base64_encode($image);
                $editProduct->image = 'data:image/jpeg;base64,'.$encoded;
            }
            $result['response'] = 'success';
            $result['editProduct'] = $editProduct;
        }else{
            $result['response'] = 'error';
            $result['message'] = 'Sorry! Product not Found!';
        }
         return response()->json($result);
    }
   
  
}
