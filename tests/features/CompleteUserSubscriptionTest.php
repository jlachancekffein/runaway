<?php

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CompleteUserSubscriptionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function user_can_register()
    {
        $this->json('post', '/register', [
            '_token' => csrf_token(),
            'email' => 'jane@doe.com',
            'password' => 'mrjohn',
            'password_confirmation' => 'mrjohn',
            'name' => 'Jane Doe'
        ]);

        $this->assertEquals(1, User::where('email', 'jane@doe.com')->get()->count());
    }

    /** @test */
    public function user_can_complete_profile_questions()
    {
        $this->json('post', '/register', [
            '_token' => csrf_token(),
            'email' => 'jane@doe.com',
            'password' => 'mrjohn',
            'password_confirmation' => 'mrjohn',
        ]);

        $this->json('post', '/account/question/1', []);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/2');

        $this->json('post', '/account/question/2', [
            'preferences.hairColor' => 'blond-clair',
            'preferences.eyeColor' => 'vert',
            'preferences.skinColor' => 'f6e9da',
        ]);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/3');

        $this->json('post', '/account/question/3', [
            'preferences.bodyShape' => 'athletic'
        ]);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/4');

        $this->json('post', '/account/question/4', []);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/5');

        $this->json('post', '/account/question/5', [
            'preferences' => [
                'height' => '1',
                'weight' => '2',
                'weightUnit' => '3',
                'braBandSize' => '4',
                'braCupSize' => '5',
                'shoeSize' => '6',
                'pantsSize' => '7',
                'favoritePants' => '8',
                'shirtSize' => '9',
                'dressSize' => '10',
                'piercedEars' => '11',
            ]
        ]);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/6');

        $this->json('post', '/account/question/6', []);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/7');

        $this->json('post', '/account/question/7', []);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/8');

        $this->json('post', '/account/question/8', []);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/9');

        $this->json('post', '/account/question/9', []);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/10');

        $this->json('post', '/account/question/10', [
            'preferences' => [
                'name' => 'Jane Doe',
                'address' => '2020 test street',
                'city' => 'Test',
                'postal_code' => 'G1K3C8',
                'province' => 'quebec',
                'phone' => '4185221799',
                'contact_method' => 'Morse',
                'terms' => 'Yes',
                'birthday' => [
                    'year' => 1986,
                    'month' => 10,
                    'day' => 5,
                ],
            ],
        ]);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/11');

        $this->get('/account/profile');
        $this->assertResponseOk();
    }

    /** @test */
    public function force_new_user_to_complete_profile_questions()
    {
        $this->json('post', '/register', [
            '_token' => csrf_token(),
            'email' => 'jane@doe.com',
            'password' => 'mrjohn',
            'password_confirmation' => 'mrjohn',
            'name' => 'Jane Doe'
        ]);

        $this->get('/account/profile');

        $this->assertResponseStatus(302);
    }

    /** @test */
    public function force_incomplete_user_to_complete_profile_questions()
    {
        $this->json('post', '/register', [
            '_token' => csrf_token(),
            'email' => 'jane@doe.com',
            'password' => 'mrjohn',
            'password_confirmation' => 'mrjohn',
            'name' => 'Jane Doe'
        ]);
        $this->json('post', '/account/question/1', []);
        $this->assertResponseStatus(302);
        $this->assertRedirectedTo('/account/question/2');
        $this->json('post', '/account/question/2', [
            'preferences.hairColor' => 'blond-clair',
            'preferences.eyeColor' => 'vert',
            'preferences.skinColor' => 'f6e9da',
        ]);

        $this->get('/account/profile');

        $this->assertResponseStatus(302);
        $this->assertContains('/account/question/3', $this->response->headers->get('Location'));
    }

    /** @test */
    public function user_has_language()
    {
        $this->json('post', '/register', [
            '_token' => csrf_token(),
            'email' => 'jane@doe.com',
            'password' => 'mrjohn',
            'password_confirmation' => 'mrjohn',
        ], [
            'HTTP_ACCEPT_LANGUAGE' => 'en'
        ]);

        $user = User::where('email', 'jane@doe.com')->first();

        $this->assertEquals('en', $user->language);
    }

}
