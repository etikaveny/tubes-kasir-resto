<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ManagerProductRestrictionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_manager_can_view_product_list()
    {
        $manager = User::where('role', 'manager')->first();
        if (!$manager) {
            $manager = User::factory()->create(['role' => 'manager']);
        }

        $response = $this->actingAs($manager)->get(route('manager.products.index'));

        $response->assertStatus(200);
        $response->assertDontSee('Add New Product');
        $response->assertDontSee('Actions');
    }

    public function test_manager_cannot_create_product()
    {
        $manager = User::where('role', 'manager')->first();
        if (!$manager) {
            $manager = User::factory()->create(['role' => 'manager']);
        }

        $response = $this->actingAs($manager)->get(route('manager.products.create'));
        $response->assertStatus(403);
    }

    public function test_manager_cannot_store_product()
    {
        $manager = User::where('role', 'manager')->first();
        if (!$manager) {
            $manager = User::factory()->create(['role' => 'manager']);
        }

        $category = Category::first();
        if (!$category) {
            $category = Category::create([
                'name' => 'Test Cat',
                'slug' => 'test-cat'
            ]);
        }

        $response = $this->actingAs($manager)->post(route('manager.products.store'), [
            'name' => 'Should Fail',
            'category_id' => $category->id,
            'price' => 1000,
            'stock' => 10
        ]);

        $response->assertStatus(403);
    }

    public function test_manager_cannot_edit_product()
    {
        $manager = User::where('role', 'manager')->first();
        if (!$manager) {
            $manager = User::factory()->create(['role' => 'manager']);
        }

        $category = Category::first();
        if (!$category) {
            $category = Category::create([
                'name' => 'Test Cat',
                'slug' => 'test-cat'
            ]);
        }

        $product = Product::first();
        if (!$product) {
            $product = Product::create([
                'name' => 'P',
                'category_id' => $category->id,
                'price' => 10,
                'stock' => 10
            ]);
        }

        $response = $this->actingAs($manager)->get(route('manager.products.edit', $product));
        $response->assertStatus(403);
    }

    public function test_manager_cannot_update_product()
    {
        $manager = User::where('role', 'manager')->first();
        if (!$manager) {
            $manager = User::factory()->create(['role' => 'manager']);
        }

        $category = Category::first();
        if (!$category) {
            $category = Category::create([
                'name' => 'Test Cat',
                'slug' => 'test-cat'
            ]);
        }

        $product = Product::first();
        if (!$product) {
            $product = Product::create([
                'name' => 'P',
                'category_id' => $category->id,
                'price' => 10,
                'stock' => 10
            ]);
        }

        $response = $this->actingAs($manager)->put(route('manager.products.update', $product), [
            'name' => 'Updated Name',
            'category_id' => $product->category_id,
            'price' => 2000,
            'stock' => 20
        ]);

        $response->assertStatus(403);
    }

    public function test_manager_cannot_delete_product()
    {
        $manager = User::where('role', 'manager')->first();
        if (!$manager) {
            $manager = User::factory()->create(['role' => 'manager']);
        }

        $category = Category::first();
        if (!$category) {
            $category = Category::create([
                'name' => 'Test Cat',
                'slug' => 'test-cat'
            ]);
        }

        $product = Product::first();
        if (!$product) {
            $product = Product::create([
                'name' => 'PToBeDeleted',
                'category_id' => $category->id,
                'price' => 10,
                'stock' => 10
            ]);
        }

        $response = $this->actingAs($manager)->delete(route('manager.products.destroy', $product));
        $response->assertStatus(403);
    }

    public function test_admin_can_still_create_product()
    {
        $admin = User::where('role', 'admin')->first();
        if (!$admin) {
            $admin = User::factory()->create(['role' => 'admin']);
        }

        $response = $this->actingAs($admin)->get(route('manager.products.create'));
        $response->assertStatus(200);
    }
}
