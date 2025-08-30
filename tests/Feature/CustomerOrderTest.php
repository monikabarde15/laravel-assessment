<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;

class CustomerOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_customer_can_place_order()
    {
        $customer = Customer::factory()->create();
        $product = Product::factory()->create();

        // Use route() helper
        $response = $this->actingAs($customer, 'customer')->post(route('customer.orders.store'), [
            'items' => [
                ['product_id' => $product->id, 'qty' => 2],
            ]
        ]);

        $response->assertStatus(302);
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('orders', [
            'customer_id' => $customer->id,
            'status' => 'Pending',
        ]);

        $this->assertDatabaseHas('order_items', [
            'product_id' => $product->id,
            'qty' => 2,
        ]);
    }

    public function test_order_validation_fails_without_items()
    {
        $customer = Customer::factory()->create();

        // Use route() helper
        $response = $this->actingAs($customer, 'customer')->post(route('customer.orders.store'), [
            'items' => []
        ]);

        // ✅ Correct validation error for empty array
        $response->assertSessionHasErrors('items');
    }
}
