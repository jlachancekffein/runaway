<?php

namespace App\Models;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    use Translatable;

    public $translatedAttributes = [
        'title',
        'description',
        'seo_title',
        'seo_description',
        'seo_slug',
        'image',
        'content'
    ];

    protected $fillable = [
        'status',
        'section',
        'publication_date'
    ];

    public function getPublicationYear()
    {
        return substr($this->publication_date, 0, 4);
    }

    public function getPublicationSeason()
    {
        return get_season_from_date($this->publication_date);
    }

}
