<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'vendors';

    public static $searchable = [
        'ranking',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'ranking',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public static function boot()
    {
        parent::boot();
        Vendor::observe(new \App\Observers\VendorActionObserver());
    }

    public function vendorAddresses()
    {
        return $this->hasMany(Address::class, 'vendor_id', 'id');
    }

    public function vendorContacts()
    {
        return $this->hasMany(Contact::class, 'vendor_id', 'id');
    }

    public function vendorNotes()
    {
        return $this->hasMany(Note::class, 'vendor_id', 'id');
    }

    public function vendorPreludeNumbers()
    {
        return $this->hasMany(PreludeNumber::class, 'vendor_id', 'id');
    }

    public function vendorVendorNumbers()
    {
        return $this->hasMany(VendorNumber::class, 'vendor_id', 'id');
    }

    public function vendorWarranties()
    {
        return $this->hasMany(Warranty::class, 'vendor_id', 'id');
    }

    public function vendorBrands()
    {
        return $this->belongsToMany(Brand::class);
    }

    public function vendorEngines()
    {
        return $this->belongsToMany(Engine::class);
    }

    public function vendorProducts()
    {
        return $this->belongsToMany(Product::class);
    }

    public function vendorServices()
    {
        return $this->belongsToMany(Service::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
