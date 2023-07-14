<?php

namespace App\Models;

use App\pop_up;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends  Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;


    protected $softDelete = true;

    protected $table = "products";
    protected  $primaryKey = 'product_id';
    protected $appends = ['image'];


    public function getDescAttribute()
    {
        if ((app()->getLocale() == 'ar' && empty($this->description)) || app()->getLocale() == 'en') {
            return $this->description_english;
        } else {
            return $this->description;
        }
    }
    public function productImages()
    {
        return $this->hasMany(ProductImages::class, 'product_id');
    }
    public function branches()
    {
        return $this->belongsToMany(Branch::class, BranchProduct::class, 'product_id', 'branch_id');
    }

    public function getFimageAttribute()
    {
        return url($this->getFirstMediaUrl('product'));
    }
    public function getImageAttribute()
    {
        return url($this->getFirstMediaUrl('product', 'thumb'));
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'category_id');
    }
    public function registerMediaConversions(Media $Media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width('500')
            ->height('500');
    }
    public static function generateUuID()
    {
        /**
         * @var collection $duplicate
         */

        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $rand = '';
        foreach (array_rand($seed, 8) as $k)
            $rand .= $seed[$k];
        $duplicate = Product::query()->where('SKU', $rand)->get();
        if ($duplicate->isNotEmpty())
            return Product::generateWalletID();
        return $rand;
    }
}
