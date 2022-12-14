<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Brand_Vendor extends Pivot
{

    protected $table = 'brand_vendor';

    public static function boot()
    {
        parent::boot();
        Brand_Vendor::observe(new \App\Observers\Brand_VendorActionObserver());
    }

}
