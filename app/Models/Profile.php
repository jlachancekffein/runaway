<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected static $styles = [
        // 'active-wear',
        // 'sexy',
        'classique',
        'cocktail',
        'casual',
        'corporatif',
        'fashion',
        'sport-chic',
        'glamour',
        'sportif',
        'chic-event',
        'golf',
    ];

    protected static $hairColors = [
        'blond-pale', 'blond-brun-pale',
        'brun-pale', 'chatain',
        'blond-clair', 'blond',
        'blond-orange', 'orange',
        'blond-brun', 'brun',
        'brun-rouge', 'brun-fonce',
        'rouge-pale', 'mauve-pale',
        'mauve-fonce', 'brun-tres-fonce',
        'bleu', 'rouge',
        'noir', 'noir-pale',
        'blanc-jaune', 'blanc',
        'gris-clair', 'gris'
    ];

    protected static $eyeColors = [
        'vert',
        'brun-pale',
        'brun',
        'vert-fonce',
        'bleu-pale',
        'bleu-fonce',
        'gris',
        'vert-clair'
    ];
    
    protected static $skinColors = [
        'f6e9da',
        'e9d3c1',
        'e8cbba',
        'e0c9af',
        'e7caab',
        'd4b5a1',
        'dab9a6',
        'ceb198',
        'ab896c',
        'a98268',
        '6c503b',
        '5c4637'
    ];
    
    protected static $bodyShapes = [
        'athletic',
        'rectangle',
        'apple',
        'pear',
        'hourglass'
    ];
    
    protected static $weightUnits = [
        'livres',
        'kilos'
    ];
    
    protected static $favoritePants = [
        'taille-haute',
        'taille-basse',
        'les-deux'
    ];
    
    protected static $excludedSkirts = [
        'short',
        'cigarette',
        'long'
    ];
    
    protected static $excludedPants = [
        'capri',
        'three-quarter',
        'skinny',
        'palazzo',
        'bootcut',
        'boyfriend',
        'straight-cut'
    ];
    
    protected static $excludedTops = [
        'sleeveless-camisoles',
        'camisoles-short-sleeves'
    ];
    
    protected static $excludedNecks = [
        'turtleneck',
        'v-neck',
        'round-neck'
    ];
    
    protected static $excludedClothes = [
        'one-piece'
    ];
    
    protected static $excludedColors = [
        '990022', 'd90016', 'e24d4a', 'f5b5a6',
        'd89598', 'f6cbd4', '62762d', '8db91c',
        'ced535', 'fee21d', 'ffe58c', 'ffffff',
        '0d626c', '239eaf', '4db39a', 'aed6b2',
        '90cdd8', 'c2dbf0', '161357', '174981',
        '2869c1', '5b006f', '9d6ea7', 'e3c6dd',
        '000000', '76003e', '4e201c', '6e372e',
        'be7849', 'caa08d', 'e55d13', 'd80068',
        'cf9d08', '746761', 'e3d8cb', 'd0d1d4'
    ];
    
    protected static $favoritePatterns = [
        'leopard',
        'polkaDots',
        'princeOfWales',
        'handstooth',
        'snake',
    ];
    
    protected static $favoriteAccessories = [
        'keyHolder',
        'braceletsNecklaces',
        'scarves',
        'belts',
        'handbagsWallets',
        'sunglasses',
        'hats',
        'rings',
        'earrings',
        'shoes',
    ];
    
    protected static $favoriteClothes = [
        'amples',
        'droits',
        'cintres'
    ];
    
    protected static $brands = [
//        'marie-saint-pierre',
        'margittes',
        'marc-cain',
        'laurel',
        'luisa-cerano',
        'betty-barclay',
        'riani',
        // 'georges-rech',
        'rafaello-rossi',
        'samoon',
    ];
    
    public static function getStyles() {
        return self::$styles;
    }
    
    public static function getHairColors() {
        return self::$hairColors;
    }
    
    public static function getEyeColors() {
        return self::$eyeColors;
    }
    
    public static function getSkinColors() {
        return self::$skinColors;
    }
    
    public static function getBodyShapes() {
        return self::$bodyShapes;
    }
    
    public static function getWeightUnits() {
        return self::$weightUnits;
    }
    
    public static function getFavoritePants() {
        return self::$favoritePants;
    }
    
    public static function getExcludedSkirts() {
        return self::$excludedSkirts;
    }
    
    public static function getExcludedPants() {
        return self::$excludedPants;
    }
    
    public static function getExcludedTops() {
        return self::$excludedTops;
    }
    
    public static function getExcludedNecks() {
        return self::$excludedNecks;
    }
    
    public static function getExcludedClothes() {
        return self::$excludedClothes;
    }
    
    public static function getExcludedColors() {
        return self::$excludedColors;
    }
    
    public static function getFavoritePatterns() {
        return self::$favoritePatterns;
    }
    
    public static function getFavoriteAccessories() {
        return self::$favoriteAccessories;
    }
    
    public static function getFavoriteColors() {
        return array_reverse(self::getExcludedColors());
    }
    
    public static function getFavoriteClothes() {
        return self::$favoriteClothes;
    }
    
    public static function getBrands() {
        return self::$brands;
    }
}
