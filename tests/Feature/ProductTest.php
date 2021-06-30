<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Product;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public $productStructure = [
        'id',
        'name',
        'price',
        'qty',
        'created_at',
        'updated_at'
    ];

    public $productWithHistoryStructure = [
        'id',
        'name',
        'price',
        'qty',
        'created_at',
        'updated_at',
        'history'
    ];

    /* Database tests */ 

    public function test_can_be_persisted()
    {
        $product = Product::factory()->create();

        $this->assertDatabaseHas('products', ['id' => $product->id]);
    }

    public function test_can_be_deleted()
    {
        $product = Product::factory()->create();
        $product->delete();
        $this->assertSoftDeleted($product);
    }

    /* Routes/E2E tests */ 

    public function test_list_route()
    {
        $products = Product::factory()->count(3)->create();        
        $response = $this->get(route('products.list'));
        $expected = ['*' => $this->productStructure];
        $response->assertStatus(200)
                 ->assertJsonStructure($expected);
    }

    public function test_show_route()
    {
        //Default behavior
        $product = Product::factory()->create();        
        $response = $this->get(route('product.show', ['id' => $product->id]));
        $expected = $this->productStructure;
        $response->assertStatus(200)
                 ->assertJsonStructure($expected);

        // Invalid product
        $response = $this->get(route('product.show', ['id' => -1]));        
        $response->assertStatus(204);                 
    }

    public function test_history_route()
    {
        //Default behavior
        $product = Product::factory()->create();        
        $response = $this->get(route('product.history', ['id' => $product->id]));
        $expected = $this->productWithHistoryStructure;
        $response->assertStatus(200)
                 ->assertJsonStructure($expected);

        // Invalid product
        $response = $this->get(route('product.history', ['id' => -1]));        
        $response->assertStatus(204);                 
    }

    public function test_store_route()
    {
        //Default behavior
        $product = Product::factory()->make();               
        $response = $this->postJson(route('product.store'), $product->toArray());        
        $expected =  $this->productStructure;
        $response->assertStatus(201)
                 ->assertJsonStructure($expected);

        //Empty array
        $response = $this->postJson(route('product.store'), []);            
        $expected =  $this->productStructure;
        $response->assertStatus(422);          
        
        //Missing fields array
        $response = $this->postJson(route('product.store'), ['name' => 'Test Product']);            
        $expected =  $this->productStructure;
        $response->assertStatus(422); 
    }

    

    public function test_delete_route()
    {
        // Default behavior
        $product = Product::factory()->create();
        $response = $this->delete(route('product.delete', ['id' => $product->id]));
        $response->assertStatus(200);
        $product->refresh();
        $this->assertSoftDeleted($product);
        
        // Invalid product
        $response = $this->delete(route('product.delete', ['id' => -1]));
        $response->assertStatus(400);
    }

    public function test_save_batch_route()
    {
        $products = Product::factory()->count(3)->make();     
        
        $response = $this->postJson(route('products.batch'),['products' => $products]);                                
        $response->assertStatus(200);

        //Empty array
        $response = $this->postJson(route('products.batch'), []); 
        $response->assertStatus(422);          
        
        //Missing fields array
        $response = $this->postJson(route('products.batch'), array_merge($products->toArray(), [['name' => 'Test Product']]));                    
        $response->assertStatus(422);
    }
}
