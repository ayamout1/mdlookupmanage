<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Product_Vendor extends Pivot
{
    protected $table = 'product_vendor';

    public static function boot()
    {
        parent::boot();
        Product_Vendor::observe(new \App\Observers\Product_VendorActionObserver());
    }
}
