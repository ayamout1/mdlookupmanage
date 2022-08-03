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

    public function vendorAddresses()
    {
        return $this->hasMany(Address::class, 'vendor_id', 'id');
    }

    public function vendorContacts()
    {
        return $this->hasMany(Contact::class, 'vendor_id', 'id');
    }

    public function vendorBrands()
    {
        return $this->belongsToMany(Brand::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
