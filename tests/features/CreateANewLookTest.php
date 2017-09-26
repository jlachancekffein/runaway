<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateANewLookTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function admin_can_create_a_new_look()
    {
        $user = factory(\App\Models\User::class)->create();
        $user->role = 'admin';
        $user->save();
        Auth::login($user);
        $kitRequest = factory(App\Models\KitRequest::class)->create();

        $this->call('POST', '/admin/kits/create', [
            '_token' => csrf_token(),
            'kit_request_id' => $kitRequest->id,
            'product' => [
                'marker_x' => [0, 3],
                'marker_y' => [0, 7],
                'brand' => ['ACME', 'Cheikha'],
                'name' => ['Jeans', 'Shirt'],
                'regular_price' => [5000, 8000],
            ],
            'status' => 'draft',
        ], [], [
            'photo' => new \Illuminate\Http\UploadedFile(base_path('tests/image.jpg'), 'image.jpg', filesize(base_path('tests/image.jpg')), 'image/jpg', null, true)
        ]);

        $this->assertRedirectedTo('/admin/kits');
        $this->assertCount(1, $kitRequest->kit()->get());
        $this->assertCount(2, $kitRequest->kit->products()->get());
    }

}
