<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    public function test_get_primary_key()
    {
        $expected = 'id';
        $this->assertEquals(Product::getPrimaryKey(), $expected);
    }

    public function test_get_fillable_fields()
    {
        $expected = ['name', 'price', 'qty'];
        $this->assertEquals(Product::getFillableFields(), $expected);
    }
}
