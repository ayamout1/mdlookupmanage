<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Engine_Vendor extends Pivot
{
    protected $table = 'engine_vendor';

    public static function boot()
    {
        parent::boot();
        Engine_Vendor::observe(new \App\Observers\Engine_VendorActionObserver());
    }
}
