<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\User;
use App\Models\History;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductDetail;
use Illuminate\Database\Seeder;
use Database\Seeders\CartSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\HistorySeeder;
use Illuminate\Database\Eloquent\Factories\Sequence;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Category::factory()->count(3)->create()->each(function ($category) {
            ProductDetail::factory()->count(5)->create(['category_id' => $category->id]);
        });

        // User::factory()->count(3)->state(new Sequence(
        //     ['role'=>1],
        //     ['role'=>2],
        // ))->create()->each(function ($user){

        //     History::factory()->state(new Sequence(
        //         ['paid'=>1],
        //     ))->create(['user_id'=>$user->id])->each(function ($history){

        //         Cart::factory()->count(3)->create(['history_id'=>$history->id])->each(function ($cart){

        //             Product::factory()->create(['cart_id'=>$cart->id]);

        //         });

        //     });

        // });

        $this->call([
            UserSeeder::class,
            HistorySeeder::class,
            CartSeeder::class,
        ]);
    }
}
