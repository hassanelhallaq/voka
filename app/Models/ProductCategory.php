<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model implements HasMedia
{


    protected $table = "product_categories";
    protected  $primaryKey = 'category_id';
    use SoftDeletes;
    use InteractsWithMedia;



    public function branch()
    {
        return $this->hasManyThrough(BranchProduct::class, Product::class, 'category_id', 'product_id');
    }

    public function Product()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
    public function getImageAttribute()
    {
        if (!empty($this->meal_image)) {
            return  url('uploads/' . $this->meal_image);
        } elseif ($this->category_show_Type == null || $this->category_show_Type == 'text') {

            return null;
        } elseif ($this->category_show_Type == null || $this->category_show_Type == 'image' || $this->meal_image == 'imageAndText') {
            return  url($this->getFirstMediaUrl('category', 'thumb'));
        }
    }

    public function getNameAttribute()
    {
        if (request()->header('Language') != null && request()->header('Language') == 'en') {
            return $this->category_name_english;
        } else {
            return $this->category_name;
        }
        if ((app()->getLocale() == 'ar' && empty($this->category_name)) || app()->getLocale() == 'en') {
            return $this->category_name_english;
        } else {
            return $this->category_name;
        }
    }
}
