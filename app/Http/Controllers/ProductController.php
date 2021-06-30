<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductsRequest;
use App\Models\Product;

class ProductController extends Controller
{
    public function list(){
        $products = Product::all();
        if(is_null($products)){
            return response('', 204);
        }
        return response()->json($products);
    }

    public function show($id){
        $product = Product::find($id);
        if(is_null($product)){
            return response('', 204);
        }
        return response()->json($product);
    }


    public function history($id){
        $product = Product::with('history')->find($id);
        if(is_null($product)){
            return response('', 204);
        }
        return response()->json($product);
    }

    public function store(ProductRequest $request){        
        $data = $request->validated();
        $product = Product::create($data);
        if($product){
            return response()->json($product, 201);
        }
        return response('Failed to create product', 400);
    }

    public function update(ProductRequest $request){        
        $data = $request->validated();
        $product = Product::find($data['id']);
        $updated = $product->update($data);
        if($updated){
            return response()->json($product);
        }
        return response('Failed to create product', 400);
    }

    public function saveBatch(ProductsRequest $request){        
        $data = $request->validated();        
        $products = Product::upsert($data['products'], Product::getPrimaryKey(), Product::getFillableFields());        
        if($products){
            return response()->json("$products products have been saved", 200);
        }
        return response('Failed to save products batch', 400);
    }

    public function delete($id){
        $product = Product::find($id);
        if(is_null($product)){
            return response('Product not found', 400);
        }
        $product->delete();
        return response("Product deleted");
    }
}
