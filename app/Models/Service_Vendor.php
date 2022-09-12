<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Service_Vendor extends Pivot
{
    protected $table = 'service_vendor';

    public static function boot()
    {
        parent::boot();
        Service_Vendor::observe(new \App\Observers\Service_VendorActionObserver());
    }
}
