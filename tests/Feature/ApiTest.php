<?php

namespace Tests\Feature;

use App\Models\Category;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_register()
    {
        $response = $this->postJson('/api/user/store', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(201)->assertJsonStructure(['token', 'user']);
    }

    public function test_user_can_login()
    {
        $user = User::factory()->create([
            'password' => bcrypt('password123')
        ]);

        $response = $this->postJson('/api/login', [
            'email' => $user->email,
            'password' => 'password123',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['token']);
    }

    public function test_user_can_create_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->postJson('/api/store', [
            'product_name' => 'Test Product',
            'description' => 'This is a test product',
            'price' => 100,
            'stock' => 10,
            'category_id' => 3,
        ]);

        $response->assertStatus(201)->assertJsonStructure(['data' => ['id', 'product_name', 'description']]);
    }

    public function test_user_can_view_products()
    {
        Product::factory()->count(5)->create();
        
        $response = $this->getJson('/api/product');
        $response->assertStatus(200)->assertJsonStructure(['data']);
    }

    public function test_user_can_update_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user);
        $category = Category::create(['name'=>'Electronics']);
        $product = Product::factory()->create([
                        'category_id' => fn() => $category->id
        ]);

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
                                ])->putJson("/api/update/{$product->id}", [
                                    'product_name' => 'Fridge',
                                    'description' => 'Some description',
                                    'stock'       => 5,
                                    'price'       => 500000,
                                    'category_id' => 1
                                ]);

        $response->assertStatus(200)->assertJsonStructure(['data']);
    }

    public function test_user_can_delete_product()
    {
        $user = User::factory()->create();
        $token = JWTAuth::fromUser($user); // Generate a valid JWT token

        $product = Product::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->deleteJson("/api/delete/{$product->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Product deleted successfully']);
    }
}
