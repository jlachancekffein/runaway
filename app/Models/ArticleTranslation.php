<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTranslation extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'seo_title',
        'seo_description',
        'seo_slug',
        'image',
        'content'
    ];

}
