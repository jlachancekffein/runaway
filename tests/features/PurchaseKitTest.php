<?php

use App\Models\Address;
use App\Models\Province;
use App\Models\Tax;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PurchaseKitTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_purchase_a_look()
    {
        $user = factory(\App\Models\User::class)->create();
        factory(\App\Models\Address::class)->create([
            'address_id' => 0,
            'customer_id' => $user->id,
            'province' => 'ontario',
        ]);
        factory(\App\Models\Address::class)->create([
            'address_id' => 1,
            'customer_id' => $user->id,
            'province' => 'quebec',
        ]);

        Auth::login($user);
        $kit = factory(\App\Models\Kit::class)->create();
        $products = factory(\App\Models\Product::class, 5)->create([
            'kit_id' => $kit->id,
            'regular_price' => 1200
        ]);
        Province::where('key', 'ontario')->first()->taxes()->save(new Tax([
            'key' => 'hst',
            'percentage' => 0.13
        ]));
        $this->assertEmpty(session('cart'));

        $this->json('post', '/account/kits/' . $kit->id, [
            '_token' => csrf_token(),
            'express_shipping' => 1,
            'shipping_address' => 0,
            'billing_address' => 'contact',
            'product' => [
                1 => 0,
                2 => 0,
                3 => 1,
                4 => 0,
                5 => 1,
            ],
        ]);

        $this->assertNotEmpty(session('cart'));
        $this->assertArraySubset([
            'kitId' => $kit->id,
            'products' => [3, 5],
            'subtotal' => 2400,
            'express_shipping' => 50,
            'taxes' => ['hst' => 318.5],
            'total' => 2768.5,
            'shipping_address' => 0,
            'billing_address' => 'contact'
        ], session('cart'));
    }

    /** @test */
    public function can_purchase_maximum_5_items()
    {
        $user = factory(\App\Models\User::class)->create();
        factory(\App\Models\Address::class)->create([
            'address_id' => 0,
            'customer_id' => $user->id,
            'province' => 'ontario',
        ]);
        Auth::login($user);
        $kit = factory(\App\Models\Kit::class)->create([
            'status' => 'pending',
            'customer_id' => $user->id,
        ]);
        $products = factory(\App\Models\Product::class, 6)->create([
            'kit_id' => $kit->id,
            'regular_price' => 1200
        ]);
        Province::where('key', 'ontario')->first()->taxes()->save(new Tax([
            'key' => 'hst',
            'percentage' => 0.13
        ]));

        $this->json('post', '/account/kits/' . $kit->id, [
            '_token' => csrf_token(),
            'express_shipping' => 1,
            'shipping_address' => 0,
            'billing_address' => 'contact',
            'product' => [
                1 => 1,
                2 => 1,
                3 => 1,
                4 => 1,
                5 => 1,
                6 => 1,
            ],
        ], [
            'HTTP_ACCEPT_LANGUAGE' => 'fr'
        ]);

        $this->visit('/account/kits/' . $kit->id);

        $this->assertEmpty(session('cart'));
        $this->see('Vous ne pouvez pas acheter plus de 5 items.');
    }
}
