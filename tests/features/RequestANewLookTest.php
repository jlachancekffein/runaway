<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RequestANewLookTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_view_page_request_a_new_look()
    {
        Auth::login(factory(User::class)->create([
            'email' => 'jane@doe.net'
        ]));

        $this->get('/account/kit-request');

        $this->assertResponseOk();
    }

    /** @test */
    public function user_can_request_a_new_look()
    {
        $user = factory(User::class)->create([
            'email' => 'jane@doe.net'
        ]);
        Auth::login($user);
        $this->assertEquals(0, $user->kitRequests()->count());

        $this->json('post', '/account/kit-request', [
            '_token' => csrf_token(),
            'name' => 'New suit',
            'budget' => 300
        ]);

        $this->assertEquals(1, User::where('email', 'jane@doe.net')->first()->kitRequests()->count());
    }
}
