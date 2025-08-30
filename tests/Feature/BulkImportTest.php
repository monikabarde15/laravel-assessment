<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Admin;
use App\Models\Product;
use Illuminate\Http\UploadedFile;

class BulkImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_import_products_csv()
    {
        $admin = Admin::factory()->create();

        $csv = UploadedFile::fake()->createWithContent('products.csv', "name,price\nProduct1,100\nProduct2,200");

        $response = $this->actingAs($admin, 'admin')->post('/admin/products/import', [
            'csv_file' => $csv,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('products', ['name' => 'Product1']);
        $this->assertDatabaseHas('products', ['name' => 'Product2']);
    }
}
