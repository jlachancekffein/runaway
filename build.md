`composer create-project laravel/laravel runway2doorway`
`cd runway2doorway`
`touch database/database.sqlite`

`php artisan serve`

`php artisan make:auth`
`php artisan serve`

`npm install`
Ajouter au fichier gulp `mix.version('css/app.css');`
Décommenter 
`gulp`
`gulp watch`

Remplacer le lien Register par `<button class="btn btn-primary navbar-btn" onclick="location.href='{{ url('/register') }}'">Get started</button>`

`composer require laravel/socialite`
`Laravel\Socialite\SocialiteServiceProvider::class,`
`'Socialite' => Laravel\Socialite\Facades\Socialite::class,`

