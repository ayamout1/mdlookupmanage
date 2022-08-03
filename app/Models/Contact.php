<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'contacts';

    public static $searchable = [
        'name',
        'website',
        'email',
        'address',
        'city',
        'state',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'website',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'zipcode',
        'vendor_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
