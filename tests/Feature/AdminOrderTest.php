<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Order;
use App\Models\Admin;
use App\Models\Customer;
use App\Notifications\OrderStatusUpdated;
use Illuminate\Support\Facades\Notification;

class AdminOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_update_order_status_and_notify_customer()
    {
        Notification::fake();

        // ✅ Create admin user
        $admin = Admin::factory()->create();

        $customer = Customer::factory()->create();
        $order = Order::factory()->create([
            'customer_id' => $customer->id,
            'status' => 'Pending',
        ]);

        // ✅ Use correct route and method
        $response = $this->actingAs($admin, 'admin')->patch(route('admin.orders.updateStatus', $order->id), [
            'status' => 'Shipped',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'Shipped',
        ]);

        Notification::assertSentTo(
            [$customer],
            OrderStatusUpdated::class
        );
    }
}
