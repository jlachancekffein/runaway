<?php

function array_dot_reverse($arrayDot) {
    $array = array();
    foreach ($arrayDot as $key => $value) {
        array_set($array, $key, $value);
    }
    return $array;
}

function array_dot_merge() {
    $array = func_get_args();
    array_walk($array, 'array_dot');
    $array = call_user_func_array('array_merge', $array);
    array_walk($array, 'array_dot_reverse');
    return $array;
}

if (!function_exists('money_format')) {
    function money_format($format, $number) {
        // FRANÇAIS 1 234,56 $
        // ANGLAIS $1,234.56

        $number = str_replace(' ', '', $number);
        $number = round($number, 2);
        $number = number_format($number, 2);

        if (strpos($number, ',') !== false && strpos($number, '.') !== false) {
            $number = str_replace(',', '', $number);
        }

        if (App::getLocale() == 'fr') {
            $separator = ',';
            $number = str_replace('.', $separator, $number);
            $number_parts = explode($separator, $number);
            $number = strrev(wordwrap(strrev($number_parts[0]), 3, ' '));

            return $number . $separator . $number_parts[1] . '&nbsp;$';

        } else {
            $separator = '.';
            $number = str_replace(',', $separator, $number);
            $number_parts = explode($separator, $number);
            $number = strrev(wordwrap(strrev($number_parts[0]), 3, ',', true));

            return '$' . $number . $separator . $number_parts[1];
        }
    }
}

function format_phone($number) {
    $number = str_replace(array(' ', '-', '#'), '', $number);
    $count = strlen($number);

    if ($count >= 7 && $count < 10) {
        // 522-1799
        $number = substr_replace($number, '-', 3, 0);
    } else if ($count == 10) {
        // 418-522-1799
        $number = substr_replace($number, '-', 3, 0);
        $number = substr_replace($number, '-', 7, 0);
    } else if ($count > 10) {
        // 418-522-1799#560
        $number = substr_replace($number, '-', 3, 0);
        $number = substr_replace($number, '-', 7, 0);
        $number = substr_replace($number, '#', 10, 0);
    }

    return $number;
}


function resize($imagePath, $width, $height)
{
    $storageImagePath = str_replace('/storage', 'app/public', $imagePath);

    if (!$imagePath || file_exists($imagePath)) {
        return '';
    }

    $storageImageCachePath = str_replace('/storage', 'app/public/cache', $imagePath);
    $storageImageCachePathParts = pathinfo($storageImageCachePath);
    $storageImageCacheCroppedPath = $storageImageCachePathParts['dirname'] . '/' . $storageImageCachePathParts['filename'] . "-{$width}x{$height}." . $storageImageCachePathParts['extension'];

    Storage::makeDirectory(str_replace('app/', '', $storageImageCachePathParts['dirname']));

    if (!file_exists(storage_path($storageImageCacheCroppedPath))) {
        Image::make(storage_path($storageImagePath))->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save(storage_path($storageImageCacheCroppedPath));
    }

    return str_replace('app/public', '/storage', $storageImageCacheCroppedPath);
}


function crop($imagePath, $width, $height)
{
    $storageImagePath = str_replace('/storage', 'app/public', $imagePath);

    if (!$imagePath || !file_exists(storage_path($storageImagePath))) {
        return '';
    }

    $storageImageCachePath = str_replace('/storage', 'app/public/cache', $imagePath);
    $storageImageCachePathParts = pathinfo($storageImageCachePath);
    $storageImageCacheCroppedPath = $storageImageCachePathParts['dirname'] . '/' . $storageImageCachePathParts['filename'] . "-{$width}x{$height}." . $storageImageCachePathParts['extension'];

    Storage::makeDirectory(str_replace('app/', '', $storageImageCachePathParts['dirname']));

    if (!file_exists(storage_path($storageImageCacheCroppedPath))) {
        Image::make(storage_path($storageImagePath))->fit($width, $height)->save(storage_path($storageImageCacheCroppedPath));
    }

    return str_replace('app/public', '/storage', $storageImageCacheCroppedPath);
}


function get_season_from_date($date)
{
    $seasonDates = [
        '-12-21' => 'winter',
        '-09-21' => 'autumn',
        '-06-21' => 'summer',
        '-03-21' => 'spring',
        '-01-01' => 'winter'
    ];

    foreach ($seasonDates AS $monthAndDay => $seasonName) {
        if (strtotime($date) >= strtotime(date('Y', strtotime($date)) . $monthAndDay)) {
            return $seasonName;
        }
    }
}

function isolate_callback_with_language($language, $callback) {
    $currentUserLocale = App::getLocale();

    if (in_array($language, config('app.available_locales'))) {
        App::setLocale($language);
    }

    $callback();

    App::setLocale($currentUserLocale);
}