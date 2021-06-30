<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductHistory;

class ProductObserver
{
   

    public function created(Product $product)
    {
        ProductHistory::create(['product_id'=>$product->id, 'qty'=>$product->qty]);
    }


    public function updated(Product $product)
    {
        ProductHistory::create(['product_id'=>$product->id, 'qty'=>$product->qty]);        
    }

   
}
