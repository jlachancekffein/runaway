<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostANewBlogTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function admin_can_see_the_blog_form()
    {
        $user = factory(\App\Models\User::class)->create();
        $user->role = 'admin';
        $user->save();
        Auth::login($user);

        $this->visit('/admin/articles/blog/create')
             ->see('Blog');
    }

    /** @test */
    public function admin_can_post_a_new_blog()
    {
        $user = factory(\App\Models\User::class)->create();
        $user->role = 'admin';
        $user->save();
        Auth::login($user);

        $this->json('post', '/admin/articles/blog', [
            'status' => 'draft',
            'section' => 'blog',
            'fr' => [
                'title' => 'Orange est le nouveau noir',
                'image' => 'tests/image.jpg',
            ],
            'en' => [
                'title' => 'Orange is the new black',
                'image' => 'tests/image.jpg',
            ]
        ]);

        $this->assertResponseOk();
    }

}
