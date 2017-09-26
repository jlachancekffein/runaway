<?php

use App\Models\Tax;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ChangeTaxesTest extends \TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_save_taxes()
    {
        $user = factory(User::class)->create();
        $user->role = 'admin';
        $user->save();
        Auth::login($user);
    
        $this->post('/admin/taxes/save', [
            '_token' => csrf_token(),
            'id' => [1, 2, 3],
            'key' => [
                'gst',
                'qst',
                '',
            ],
            'percentage' => [
                0.05,
                0.09975,
                0,
            ]
        ]);

        $tax1 = Tax::find(1);
        $tax2 = Tax::find(2);
        $tax3 = Tax::find(3);

        $this->assertEquals('gst', $tax1->key);
        $this->assertEquals(0.05, $tax1->percentage);

        $this->assertEquals('qst', $tax2->key);
        $this->assertEquals('0.09975', $tax2->percentage);

        $this->assertEquals(null, $tax3->key);
        $this->assertEquals(null, $tax3->percentage);
    }
}
