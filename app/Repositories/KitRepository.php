<?php

namespace App\Repositories;

use App\Models\Kit;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class KitRepository
{

    public static function insert(array $data)
    {
        if (!empty($data['photo'])) {
            $data['photo'] = self::storeKitPhotoAndGetFileName($data['photo']);
        } else {
            unset($data['photo']);
        }

        $products = [];
        if (!empty($data['product'])) {
            $products = self::getProductsFromArray($data['product']);
        }
        unset($data['product']);
        
        $data['expire_at'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', time()) . '+2 Weekdays'));
        
        $kit = Kit::create($data);
        
        if (count($products)) {
            $kit->products()->saveMany($products);
        }

        return $kit;
    }

    public static function insertDraft(array $data)
    {
        $data['status'] = 'draft';
        return self::insert($data);
    }

    public static function update($kitId, array $data)
    {
        if (!empty($data['photo'])) {
            $data['photo'] = self::storeKitPhotoAndGetFileName($data['photo']);
        } else {
            unset($data['photo']);
        }

        $products = [];
        if (!empty($data['product'])) {
            $products = self::getProductsFromArray($data['product']);
        }
        unset($data['product']);
        
        
        $kit = Kit::findOrFail($kitId);

        if (isset($data['kit_request_id'])) {
            $kit->kit_request_id = $data['kit_request_id'];
        }

        if (!empty($data['photo'])) {
            $kit->photo = $data['photo'];
        }

        $kit->customer_id = $data['customer_id'];
        $kit->status = $data['status'];
        $kit->expire_at = $data['expire_at'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s', time()) . '+2 Weekdays'));
        $kit->save();

        if (count($products)) {
            $kit->products()->saveMany($products);
        }

        return $kit;
    }

    public static function updateDraft($kitId, array $data)
    {
        $data['status'] = 'draft';
        return self::update($kitId, $data);
    }

    public static function hasPhoto($kitId)
    {
        return !empty(Kit::find($kitId)->photo);
    }

    private static function getProductsFromArray(array $data)
    {
        $products = [];

        for ($i = 0; $i < count($data['name']); $i++) {
            $productArray = [
                'name' => isset($data['name'][$i]) ? $data['name'][$i] : '',
                'brand' => isset($data['brand'][$i]) ? $data['brand'][$i] : '',
                'regular_price' => isset($data['regular_price'][$i]) ? $data['regular_price'][$i] : null,
                'reduced_price' => isset($data['reduced_price'][$i]) ? $data['reduced_price'][$i] : null,
                'marker_x' => isset($data['marker_x'][$i]) ? $data['marker_x'][$i] : null,
                'marker_y' => isset($data['marker_y'][$i]) ? $data['marker_y'][$i] : null,
            ];

            if (!empty($data['id'][$i])) {
                $product = Product::findOrFail($data['id'][$i]);
                $product->update($productArray);
            } else {
                $products[] = new Product($productArray);
            }
        }

        return $products;
    }

    private static function storeKitPhotoAndGetFileName(UploadedFile $uploadedFile)
    {
        $filename = 'kits/' . str_random(20) . '.' . $uploadedFile->getClientOriginalExtension();
        Storage::disk('public')->put($filename, File::get($uploadedFile));
        return $filename;
    }

}